<?php
// ============================================================
// UniStack — Database Configuration
// ============================================================
define('DB_HOST', 'localhost');
define('DB_USER', 'root');       // Change for production
define('DB_PASS', '');           // Change for production
define('DB_NAME', 'unistack_db');
define('BASE_URL', 'http://localhost/unistack');

function getDB(): mysqli {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }
    $conn->set_charset('utf8mb4');
    return $conn;
}
