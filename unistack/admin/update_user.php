<?php
// admin/update_user.php
require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/../app/config/auth.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';
$id = (int)($_GET['id'] ?? 0);
if ($id && $_SERVER['REQUEST_METHOD'] === 'POST') AdminController::updateUser($id);
else { header('Location: ' . BASE_URL . '/admin/users.php'); exit; }
