<?php
require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/../app/config/auth.php';
require_once __DIR__ . '/../app/controllers/PostController.php';
$id = (int)($_GET['id'] ?? 0);
if (!$id) { header('Location: ' . BASE_URL . '/dashboard.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') PostController::update($id);
else PostController::showEdit($id);
