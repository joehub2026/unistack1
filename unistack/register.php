<?php
require_once __DIR__ . '/app/config/db.php';
require_once __DIR__ . '/app/config/auth.php';
require_once __DIR__ . '/app/controllers/AuthController.php';

startSession();
if (isLoggedIn()) { header('Location: ' . BASE_URL . '/board.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    AuthController::register();
} else {
    AuthController::showRegister();
}
