<?php
require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/../app/config/auth.php';
require_once __DIR__ . '/../app/controllers/PostController.php';
$id = (int)($_GET['id'] ?? 0);
if (!$id || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/board.php'); exit;
}
PostController::report($id);
