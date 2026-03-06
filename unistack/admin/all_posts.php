<?php
// This file is called from AdminController::showPosts()
// It needs the $posts variable injected. We redirect to the controller.
require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/../app/config/auth.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';
AdminController::showPosts();
