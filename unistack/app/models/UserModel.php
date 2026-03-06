<?php
// ============================================================
// UniStack — User Model
// ============================================================
require_once __DIR__ . '/../config/db.php';

class UserModel {

    public static function findByEmail(string $email): ?array {
        $db = getDB();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $db->close();
        return $result ?: null;
    }

    public static function findById(int $id): ?array {
        $db = getDB();
        $stmt = $db->prepare('SELECT id, full_name, email, role, is_active, created_at FROM users WHERE id = ? LIMIT 1');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        $db->close();
        return $result ?: null;
    }

    public static function create(string $fullName, string $email, string $password): int|false {
        $db = getDB();
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $db->prepare('INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, "student")');
        $stmt->bind_param('sss', $fullName, $email, $hash);
        $stmt->execute();
        $id = $stmt->insert_id ?: false;
        $stmt->close();
        $db->close();
        return $id;
    }

    public static function getAll(): array {
        $db = getDB();
        $result = $db->query('SELECT id, full_name, email, role, is_active, created_at FROM users ORDER BY created_at DESC');
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $db->close();
        return $rows;
    }

    public static function updateRole(int $id, string $role): bool {
        $db = getDB();
        $stmt = $db->prepare('UPDATE users SET role = ? WHERE id = ?');
        $stmt->bind_param('si', $role, $id);
        $stmt->execute();
        $ok = $stmt->affected_rows > 0;
        $stmt->close();
        $db->close();
        return $ok;
    }

    public static function setActive(int $id, int $active): bool {
        $db = getDB();
        $stmt = $db->prepare('UPDATE users SET is_active = ? WHERE id = ?');
        $stmt->bind_param('ii', $active, $id);
        $stmt->execute();
        $ok = $stmt->affected_rows > 0;
        $stmt->close();
        $db->close();
        return $ok;
    }
}
