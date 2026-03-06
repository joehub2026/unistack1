<?php
// ============================================================
// UniStack — Admin Controller
// ============================================================
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../models/PostModel.php';
require_once __DIR__ . '/../models/ReportModel.php';

class AdminController {

    public static function showDashboard(): void {
        requireRole('admin');
        $users   = UserModel::getAll();
        $posts   = PostModel::getAll();
        $reports = ReportModel::getAll();
        require_once __DIR__ . '/../views/admin/dashboard.php';
    }

    public static function showUsers(): void {
        requireRole('admin');
        $users = UserModel::getAll();
        require_once __DIR__ . '/../views/admin/users.php';
    }

    public static function updateUser(int $id): void {
        requireRole('admin');
        $role     = $_POST['role']      ?? '';
        $isActive = (int)($_POST['is_active'] ?? 1);
        $validRoles = ['student', 'moderator', 'admin'];

        if (in_array($role, $validRoles, true)) {
            UserModel::updateRole($id, $role);
        }
        UserModel::setActive($id, $isActive);
        setFlash('success', 'User updated.');
        header('Location: ' . BASE_URL . '/admin/users.php');
        exit;
    }

    public static function showPosts(): void {
        requireRole('admin');
        $posts = PostModel::getAll();
        require_once __DIR__ . '/../views/admin/posts.php';
    }

    public static function showReports(): void {
        requireRole('admin');
        $reports = ReportModel::getAll();
        require_once __DIR__ . '/../views/admin/reports.php';
    }
}
