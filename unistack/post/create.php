<?php
// post/create.php
require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/../app/config/auth.php';
require_once __DIR__ . '/../app/controllers/PostController.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') PostController::create();
else PostController::showCreate();
