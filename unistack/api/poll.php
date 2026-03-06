<?php
// api/poll.php — Returns new approved posts since given timestamp
require_once __DIR__ . '/../app/config/db.php';
require_once __DIR__ . '/../app/config/auth.php';
require_once __DIR__ . '/../app/models/PostModel.php';

startSession();
if (!isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

header('Content-Type: application/json');
$since = $_GET['since'] ?? date('Y-m-d H:i:s', strtotime('-10 seconds'));
$posts = PostModel::getApprovedSince($since);
echo json_encode(['posts' => $posts, 'time' => date('Y-m-d H:i:s')]);
