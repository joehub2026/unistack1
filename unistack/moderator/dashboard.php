<?php
// moderator/dashboard.php
require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/../app/config/auth.php';
require_once __DIR__ . '/../app/controllers/ModeratorController.php';
ModeratorController::showDashboard();
