<?php
// ============================================================
// UniStack — Post Controller
// ============================================================
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/auth.php';
require_once __DIR__ . '/../models/PostModel.php';
require_once __DIR__ . '/../models/ReportModel.php';

class PostController {

    public static function showBoard(): void {
        requireLogin();
        $type   = $_GET['type']   ?? '';
        $search = $_GET['search'] ?? '';
        $page   = max(1, (int)($_GET['page'] ?? 1));
        $posts  = PostModel::getApproved($type, $search, $page);
        require_once __DIR__ . '/../views/student/board.php';
    }

    public static function showCreate(): void {
        requireRole('student', 'admin');
        require_once __DIR__ . '/../views/student/post_create.php';
    }

    public static function create(): void {
        requireRole('student', 'admin');
        $user  = currentUser();
        $title = trim($_POST['title'] ?? '');
        $desc  = trim($_POST['description'] ?? '');
        $type  = $_POST['post_type'] ?? '';
        $price = !empty($_POST['price']) ? (float)$_POST['price'] : null;
        $validTypes = ['for_sale', 'housing', 'announcement'];

        if (!$title || !$desc || !in_array($type, $validTypes, true)) {
            setFlash('error', 'Please fill in all required fields.');
            header('Location: ' . BASE_URL . '/post/create.php');
            exit;
        }

        $id = PostModel::create($user['id'], $title, $desc, $type, $price);
        if ($id) {
            setFlash('success', 'Post submitted! It will appear after moderator approval.');
            header('Location: ' . BASE_URL . '/dashboard.php');
        } else {
            setFlash('error', 'Failed to submit post. Try again.');
            header('Location: ' . BASE_URL . '/post/create.php');
        }
        exit;
    }

    public static function showView(int $id): void {
        requireLogin();
        $post = PostModel::findById($id);
        if (!$post) {
            header('Location: ' . BASE_URL . '/404.php');
            exit;
        }
        require_once __DIR__ . '/../views/student/post_view.php';
    }

    public static function showEdit(int $id): void {
        requireLogin();
        $user = currentUser();
        $post = PostModel::findById($id);
        if (!$post || ($post['user_id'] != $user['id'] && $user['role'] !== 'admin')) {
            header('Location: ' . BASE_URL . '/403.php');
            exit;
        }
        require_once __DIR__ . '/../views/student/post_edit.php';
    }

    public static function update(int $id): void {
        requireLogin();
        $user  = currentUser();
        $post  = PostModel::findById($id);
        if (!$post || ($post['user_id'] != $user['id'] && $user['role'] !== 'admin')) {
            header('Location: ' . BASE_URL . '/403.php');
            exit;
        }
        $title = trim($_POST['title'] ?? '');
        $desc  = trim($_POST['description'] ?? '');
        $type  = $_POST['post_type'] ?? '';
        $price = !empty($_POST['price']) ? (float)$_POST['price'] : null;

        PostModel::update($id, $title, $desc, $type, $price, $post['user_id']);
        setFlash('success', 'Post updated and re-submitted for approval.');
        header('Location: ' . BASE_URL . '/dashboard.php');
        exit;
    }

    public static function delete(int $id): void {
        requireLogin();
        $user = currentUser();
        PostModel::delete($id, $user['id']);
        setFlash('success', 'Post deleted.');
        header('Location: ' . BASE_URL . '/dashboard.php');
        exit;
    }

    public static function showDashboard(): void {
        requireRole('student');
        $user   = currentUser();
        $posts  = PostModel::getByUser($user['id']);
        $counts = PostModel::countByUserAndStatus($user['id']);
        require_once __DIR__ . '/../views/student/dashboard.php';
    }

    public static function report(int $postId): void {
        requireRole('student');
        $user   = currentUser();
        $reason = trim($_POST['reason'] ?? '');
        if (!$reason) {
            setFlash('error', 'Please provide a reason for the report.');
            header('Location: ' . BASE_URL . '/post/view.php?id=' . $postId);
            exit;
        }
        ReportModel::create($postId, $user['id'], $reason);
        setFlash('success', 'Report submitted. Our moderators will review it shortly.');
        header('Location: ' . BASE_URL . '/board.php');
        exit;
    }

    // JSON endpoint for JS polling
    public static function pollNew(): void {
        requireLogin();
        header('Content-Type: application/json');
        $since = $_GET['since'] ?? date('Y-m-d H:i:s', strtotime('-10 seconds'));
        $posts = PostModel::getApprovedSince($since);
        echo json_encode(['posts' => $posts, 'time' => date('Y-m-d H:i:s')]);
        exit;
    }
}
