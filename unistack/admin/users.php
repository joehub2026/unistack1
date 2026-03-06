<?php
// admin/users.php
require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/../app/config/auth.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';
AdminController::showUsers();
