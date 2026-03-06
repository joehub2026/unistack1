<?php
// ============================================================
// UniStack — Report (Flag) Model
// ============================================================
require_once __DIR__ . '/../config/db.php';

class ReportModel {

    public static function create(int $postId, int $reportedBy, string $reason): bool {
        $db = getDB();
        $stmt = $db->prepare(
            'INSERT INTO reports (post_id, reported_by, reason) VALUES (?, ?, ?)'
        );
        $stmt->bind_param('iis', $postId, $reportedBy, $reason);
        $stmt->execute();
        $ok = $stmt->insert_id > 0;
        $stmt->close();
        $db->close();
        return $ok;
    }

    public static function getOpen(): array {
        $db = getDB();
        $result = $db->query(
            'SELECT r.*, p.title AS post_title, p.post_type, u.full_name AS reporter_name
             FROM reports r
             JOIN posts p ON r.post_id = p.id
             JOIN users u ON r.reported_by = u.id
             WHERE r.status = "open"
             ORDER BY r.created_at ASC'
        );
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $db->close();
        return $rows;
    }

    public static function updateStatus(int $id, string $status, int $actionedBy): bool {
        $db = getDB();
        $stmt = $db->prepare(
            'UPDATE reports SET status = ?, actioned_by = ?, actioned_at = NOW() WHERE id = ?'
        );
        $stmt->bind_param('sii', $status, $actionedBy, $id);
        $stmt->execute();
        $ok = $stmt->affected_rows > 0;
        $stmt->close();
        $db->close();
        return $ok;
    }

    public static function getAll(): array {
        $db = getDB();
        $result = $db->query(
            'SELECT r.*, p.title AS post_title, u.full_name AS reporter_name
             FROM reports r
             JOIN posts p ON r.post_id = p.id
             JOIN users u ON r.reported_by = u.id
             ORDER BY r.created_at DESC'
        );
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $db->close();
        return $rows;
    }
}
