<?php
// ============================================================
// UniStack — Moderator Controller
// ============================================================
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../models/PostModel.php';
require_once __DIR__ . '/../models/ReportModel.php';

class ModeratorController {

    public static function showDashboard(): void {
        requireRole('moderator', 'admin');
        $pending = PostModel::getPending();
        $flagged = ReportModel::getOpen();
        require_once __DIR__ . '/../views/moderator/dashboard.php';
    }

    public static function approve(int $postId): void {
        requireRole('moderator', 'admin');
        $user = currentUser();
        PostModel::updateStatus($postId, 'approved', $user['id']);
        setFlash('success', 'Post approved and is now live.');
        header('Location: ' . BASE_URL . '/moderator/dashboard.php');
        exit;
    }

    public static function reject(int $postId): void {
        requireRole('moderator', 'admin');
        $user = currentUser();
        PostModel::updateStatus($postId, 'rejected', $user['id']);
        setFlash('success', 'Post rejected.');
        header('Location: ' . BASE_URL . '/moderator/dashboard.php');
        exit;
    }

    public static function actionReport(int $reportId, string $action): void {
        requireRole('moderator', 'admin');
        $user = currentUser();
        $validActions = ['reviewed', 'dismissed'];
        if (!in_array($action, $validActions, true)) {
            header('Location: ' . BASE_URL . '/moderator/dashboard.php');
            exit;
        }
        ReportModel::updateStatus($reportId, $action, $user['id']);
        setFlash('success', 'Report marked as ' . $action . '.');
        header('Location: ' . BASE_URL . '/moderator/dashboard.php');
        exit;
    }
}
