<?php
require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/../app/config/auth.php';
require_once __DIR__ . '/../app/controllers/ModeratorController.php';
$id     = (int)($_GET['id'] ?? 0);
$action = $_GET['action'] ?? '';
if ($id && $_SERVER['REQUEST_METHOD'] === 'POST') ModeratorController::actionReport($id, $action);
else { header('Location: ' . BASE_URL . '/moderator/dashboard.php'); exit; }
