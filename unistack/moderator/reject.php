<?php
require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/../app/config/auth.php';
require_once __DIR__ . '/../app/controllers/ModeratorController.php';
$id = (int)($_GET['id'] ?? 0);
if ($id && $_SERVER['REQUEST_METHOD'] === 'POST') ModeratorController::reject($id);
else { header('Location: ' . BASE_URL . '/moderator/dashboard.php'); exit; }
