<?php
$pageTitle = 'Login — INES UniStack';
require_once __DIR__ . '/header.php';
?>
<div class="auth-wrapper">
  <div class="auth-card">
    <div class="auth-brand">
      <div class="auth-icon">📚</div>
      <h1>INES UniStack</h1>
      <p>Campus Marketplace & Notice Board</p>
    </div>

    <form method="POST" action="<?= BASE_URL ?>/login.php" novalidate>
      <div class="form-group">
        <label for="email">School Email</label>
        <input type="email" id="email" name="email" placeholder="yourname@ines.ac.rw" required autocomplete="email">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
      </div>
      <button type="submit" class="btn btn-primary btn-full">Login →</button>
    </form>

    <p class="auth-switch">Don't have an account? <a href="<?= BASE_URL ?>/register.php">Register here</a></p>

    <div class="demo-creds">
      <p><strong>Demo credentials:</strong></p>
      <p>Admin: admin@ines.ac.rw / password</p>
      <p>Mod: moderator@ines.ac.rw / password</p>
      <p>Student: student@ines.ac.rw / password</p>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/footer.php'; ?>
