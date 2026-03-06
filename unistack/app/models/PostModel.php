<?php
// ============================================================
// UniStack — Post Model
// ============================================================
require_once __DIR__ . '/../config/db.php';

class PostModel {

    public static function create(int $userId, string $title, string $desc, string $type, ?float $price): int|false {
        $db = getDB();
        $stmt = $db->prepare(
            'INSERT INTO posts (user_id, title, description, post_type, price) VALUES (?, ?, ?, ?, ?)'
        );
        $stmt->bind_param('isssd', $userId, $title, $desc, $type, $price);
        $stmt->execute();
        $id = $stmt->insert_id ?: false;
        $stmt->close();
        $db->close();
        return $id;
    }

    public static function findById(int $id): ?array {
        $db = getDB();
        $stmt = $db->prepare(
            'SELECT p.*, u.full_name AS author_name, u.email AS author_email
             FROM posts p JOIN users u ON p.user_id = u.id
             WHERE p.id = ? LIMIT 1'
        );
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $db->close();
        return $row ?: null;
    }

    public static function getApproved(string $type = '', string $search = '', int $page = 1, int $perPage = 20): array {
        $db = getDB();
        $offset = ($page - 1) * $perPage;
        $status = 'approved';
        $search = "%{$search}%";

        if ($type) {
            $stmt = $db->prepare(
                'SELECT p.*, u.full_name AS author_name FROM posts p JOIN users u ON p.user_id = u.id
                 WHERE p.status = ? AND p.post_type = ? AND (p.title LIKE ? OR p.description LIKE ?)
                 ORDER BY p.created_at DESC LIMIT ? OFFSET ?'
            );
            $stmt->bind_param('ssssii', $status, $type, $search, $search, $perPage, $offset);
        } else {
            $stmt = $db->prepare(
                'SELECT p.*, u.full_name AS author_name FROM posts p JOIN users u ON p.user_id = u.id
                 WHERE p.status = ? AND (p.title LIKE ? OR p.description LIKE ?)
                 ORDER BY p.created_at DESC LIMIT ? OFFSET ?'
            );
            $stmt->bind_param('sssii', $status, $search, $search, $perPage, $offset);
        }
        $stmt->execute();
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $db->close();
        return $rows;
    }

    public static function getApprovedSince(string $datetime): array {
        $db = getDB();
        $status = 'approved';
        $stmt = $db->prepare(
            'SELECT p.id, p.title, p.post_type, p.created_at, u.full_name AS author_name
             FROM posts p JOIN users u ON p.user_id = u.id
             WHERE p.status = ? AND p.created_at > ?
             ORDER BY p.created_at DESC LIMIT 10'
        );
        $stmt->bind_param('ss', $status, $datetime);
        $stmt->execute();
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $db->close();
        return $rows;
    }

    public static function getByUser(int $userId): array {
        $db = getDB();
        $stmt = $db->prepare(
            'SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC'
        );
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $db->close();
        return $rows;
    }

    public static function getPending(): array {
        $db = getDB();
        $stmt = $db->prepare(
            'SELECT p.*, u.full_name AS author_name, u.email AS author_email
             FROM posts p JOIN users u ON p.user_id = u.id
             WHERE p.status = "pending" ORDER BY p.created_at ASC'
        );
        $stmt->execute();
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $db->close();
        return $rows;
    }

    public static function updateStatus(int $id, string $status, int $reviewerId): bool {
        $db = getDB();
        $stmt = $db->prepare(
            'UPDATE posts SET status = ?, reviewed_by = ?, reviewed_at = NOW() WHERE id = ?'
        );
        $stmt->bind_param('sii', $status, $reviewerId, $id);
        $stmt->execute();
        $ok = $stmt->affected_rows > 0;
        $stmt->close();
        $db->close();
        return $ok;
    }

    public static function update(int $id, string $title, string $desc, string $type, ?float $price, int $userId): bool {
        $db = getDB();
        $status = 'pending'; // Re-submit for approval on edit
        $stmt = $db->prepare(
            'UPDATE posts SET title=?, description=?, post_type=?, price=?, status=? WHERE id=? AND user_id=?'
        );
        $stmt->bind_param('sssdsii', $title, $desc, $type, $price, $status, $id, $userId);
        $stmt->execute();
        $ok = $stmt->affected_rows > 0;
        $stmt->close();
        $db->close();
        return $ok;
    }

    public static function delete(int $id, int $userId): bool {
        $db = getDB();
        $stmt = $db->prepare('DELETE FROM posts WHERE id = ? AND user_id = ?');
        $stmt->bind_param('ii', $id, $userId);
        $stmt->execute();
        $ok = $stmt->affected_rows > 0;
        $stmt->close();
        $db->close();
        return $ok;
    }

    public static function getAll(): array {
        $db = getDB();
        $result = $db->query(
            'SELECT p.*, u.full_name AS author_name FROM posts p JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC'
        );
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $db->close();
        return $rows;
    }

    public static function countByUserAndStatus(int $userId): array {
        $db = getDB();
        $stmt = $db->prepare(
            'SELECT status, COUNT(*) as cnt FROM posts WHERE user_id = ? GROUP BY status'
        );
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $db->close();
        $counts = ['pending' => 0, 'approved' => 0, 'rejected' => 0];
        foreach ($rows as $row) {
            $counts[$row['status']] = (int) $row['cnt'];
        }
        return $counts;
    }
}
