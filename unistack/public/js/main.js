// ============================================================
// UniStack — Main JavaScript
// ============================================================

// ── Mobile Navigation Toggle ──────────────────────────────────
const navToggle = document.getElementById('navToggle');
const navLinks  = document.querySelector('.nav-links');
if (navToggle && navLinks) {
  navToggle.addEventListener('click', () => {
    navLinks.classList.toggle('open');
  });
}

// ── Auto-dismiss flash messages ───────────────────────────────
const flash = document.querySelector('.flash');
if (flash) {
  setTimeout(() => {
    flash.style.transition = 'opacity .5s';
    flash.style.opacity = '0';
    setTimeout(() => flash.remove(), 500);
  }, 4000);
}

// ── Form validation helpers ───────────────────────────────────
const registerForm = document.getElementById('registerForm');
if (registerForm) {
  registerForm.addEventListener('submit', function(e) {
    const email = this.querySelector('#email').value;
    const pass  = this.querySelector('#password').value;
    const conf  = this.querySelector('#confirm_password').value;

    if (!email.endsWith('@ines.ac.rw')) {
      e.preventDefault();
      alert('Please use your INES school email ending in @ines.ac.rw');
      return;
    }
    if (pass !== conf) {
      e.preventDefault();
      alert('Passwords do not match.');
      return;
    }
    if (pass.length < 6) {
      e.preventDefault();
      alert('Password must be at least 6 characters.');
    }
  });
}

// ── Post form type-selector keyboard accessibility ────────────
document.querySelectorAll('.type-option').forEach(label => {
  label.addEventListener('keydown', e => {
    if (e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      label.querySelector('input[type="radio"]').click();
    }
  });
  label.setAttribute('tabindex', '0');
});
