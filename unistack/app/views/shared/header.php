<?php
// app/views/shared/header.php
require_once __DIR__ . '/../../config/auth.php';
$user  = currentUser();
$flash = getFlash();
$role  = $user['role'] ?? 'guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?? 'INES UniStack' ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">
</head>
<body>

<nav class="navbar">
  <div class="nav-container">
    <a href="<?= BASE_URL ?>/board.php" class="nav-brand">
      <span class="nav-logo">📚</span>
      <span>INES <strong>UniStack</strong></span>
    </a>
    <?php if ($user): ?>
    <div class="nav-links">
      <a href="<?= BASE_URL ?>/board.php">📋 Board</a>
      <?php if ($role === 'student'): ?>
        <a href="<?= BASE_URL ?>/dashboard.php">My Dashboard</a>
        <a href="<?= BASE_URL ?>/post/create.php" class="btn-nav-cta">+ New Post</a>
      <?php elseif ($role === 'moderator'): ?>
        <a href="<?= BASE_URL ?>/moderator/dashboard.php">Mod Panel</a>
      <?php elseif ($role === 'admin'): ?>
        <a href="<?= BASE_URL ?>/admin/dashboard.php">Admin Panel</a>
        <a href="<?= BASE_URL ?>/post/create.php" class="btn-nav-cta">+ New Post</a>
      <?php endif; ?>
      <span class="nav-user">👤 <?= h($user['full_name']) ?></span>
      <a href="<?= BASE_URL ?>/logout.php" class="nav-logout">Logout</a>
    </div>
    <button class="nav-hamburger" id="navToggle">☰</button>
    <?php else: ?>
    <div class="nav-links">
      <a href="<?= BASE_URL ?>/login.php">Login</a>
      <a href="<?= BASE_URL ?>/register.php" class="btn-nav-cta">Register</a>
    </div>
    <?php endif; ?>
  </div>
</nav>

<main class="main-content">
<?php if ($flash): ?>
  <div class="flash flash-<?= h($flash['type']) ?>">
    <?= h($flash['message']) ?>
  </div>
<?php endif; ?>
