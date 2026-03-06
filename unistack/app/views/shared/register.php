<?php
$pageTitle = 'Register — INES UniStack';
require_once __DIR__ . '/header.php';
?>
<div class="auth-wrapper">
  <div class="auth-card">
    <div class="auth-brand">
      <div class="auth-icon">📚</div>
      <h1>Create Account</h1>
      <p>INES students only — use your school email</p>
    </div>

    <form method="POST" action="<?= BASE_URL ?>/register.php" novalidate id="registerForm">
      <div class="form-group">
        <label for="full_name">Full Name</label>
        <input type="text" id="full_name" name="full_name" placeholder="e.g. Jean Pierre Habimana" required>
      </div>
      <div class="form-group">
        <label for="email">School Email</label>
        <input type="email" id="email" name="email" placeholder="yourname@ines.ac.rw" required>
        <small class="field-hint">Must end in @ines.ac.rw</small>
        <span class="email-validation-msg" id="emailMsg"></span>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Min 6 characters" required>
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Repeat password" required>
      </div>
      <button type="submit" class="btn btn-primary btn-full">Create Account →</button>
    </form>

    <p class="auth-switch">Already have an account? <a href="<?= BASE_URL ?>/login.php">Login</a></p>
  </div>
</div>

<script>
// Client-side email validation
document.getElementById('email').addEventListener('input', function() {
  const msg = document.getElementById('emailMsg');
  if (this.value && !this.value.endsWith('@ines.ac.rw')) {
    msg.textContent = '⚠ Must use @ines.ac.rw email';
    msg.className = 'email-validation-msg error';
  } else if (this.value.endsWith('@ines.ac.rw')) {
    msg.textContent = '✓ Valid school email';
    msg.className = 'email-validation-msg success';
  } else {
    msg.textContent = '';
  }
});
</script>
<?php require_once __DIR__ . '/footer.php'; ?>
