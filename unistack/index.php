<?php
require_once __DIR__ . '/app/config/db.php';
require_once __DIR__ . '/app/config/auth.php';

startSession();
if (isLoggedIn()) {
    $role = currentUser()['role'];
    header('Location: ' . BASE_URL . ($role === 'admin' ? '/admin/dashboard.php' : ($role === 'moderator' ? '/moderator/dashboard.php' : '/board.php')));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INES UniStack — Campus Marketplace & Notice Board</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">
</head>
<body class="landing-body">

<nav class="navbar">
  <div class="nav-container">
    <a href="<?= BASE_URL ?>/" class="nav-brand">
      <span class="nav-logo">++</span>
      <span>INES <strong>UniStack</strong></span>
    </a>
    <div class="nav-links">
      <a href="<?= BASE_URL ?>/login.php">Login</a>
      <a href="<?= BASE_URL ?>/register.php" class="btn-nav-cta">Register Free</a>
    </div>
  </div>
</nav>

<section class="hero">
  <div class="hero-inner">
    <div class="hero-badge">🎓 INES-Ruhengeri Campus</div>
    <h1 class="hero-title">Buy, Sell & Share<br>Safely on Campus</h1>
    <p class="hero-subtitle">
      The official INES digital marketplace and notice board.<br>
      No more lost WhatsApp posts. No more scams. Just a safe student community.
    </p>
    <div class="hero-cta">
      <a href="<?= BASE_URL ?>/register.php" class="btn btn-accent btn-lg">Get Started →</a>
      <a href="<?= BASE_URL ?>/login.php" class="btn btn-outline btn-lg">Login</a>
    </div>
  </div>
</section>

<section class="features">
  <div class="container">
    <h2>Everything your campus needs</h2>
    <div class="features-grid">
      <div class="feature-card">
        <div class="feature-icon">🛒</div>
        <h3>Marketplace</h3>
        <p>Buy and sell books, electronics, and more — with verified INES student sellers only.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">🏠</div>
        <h3>Housing Board</h3>
        <p>Find rooms and accommodation near campus from trusted community members.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">📢</div>
        <h3>Announcements</h3>
        <p>Stay up to date with events, study groups, lost items, and campus notices.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon">🛡</div>
        <h3>Moderated & Safe</h3>
        <p>Every post is reviewed before going live. Flag suspicious content instantly.</p>
      </div>
    </div>
  </div>
</section>

<footer class="site-footer">
  <div class="footer-inner">
    <span>© <?= date('Y') ?> INES UniStack</span>
    <span>Institut d'Enseignement Supérieur de Ruhengeri, Rwanda</span>
  </div>
</footer>

</body>
</html>
