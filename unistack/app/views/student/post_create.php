<?php
$pageTitle = 'Create Post — INES UniStack';
require_once __DIR__ . '/../shared/header.php';
?>

<div class="form-page-wrapper">
  <div class="form-card">
    <h1>📝 Create New Post</h1>
    <p class="form-subtitle">Your post will be reviewed by a moderator before going live.</p>

    <form method="POST" action="<?= BASE_URL ?>/post/create.php" novalidate id="postForm">

      <div class="form-group">
        <label for="post_type">Post Type *</label>
        <div class="type-selector" id="typeSelector">
          <label class="type-option">
            <input type="radio" name="post_type" value="for_sale" required>
            <span class="type-option-inner">🛒<br><strong>For Sale</strong><small>Sell your items</small></span>
          </label>
          <label class="type-option">
            <input type="radio" name="post_type" value="housing">
            <span class="type-option-inner">🏠<br><strong>Housing</strong><small>Room / accommodation</small></span>
          </label>
          <label class="type-option">
            <input type="radio" name="post_type" value="announcement">
            <span class="type-option-inner">📢<br><strong>Announcement</strong><small>Events, notices</small></span>
          </label>
        </div>
      </div>

      <div class="form-group">
        <label for="title">Title *</label>
        <input type="text" id="title" name="title" placeholder="e.g. HP Laptop for Sale" required maxlength="200">
      </div>

      <div class="form-group" id="priceGroup" style="display:none;">
        <label for="price">Price (RWF)</label>
        <input type="number" id="price" name="price" placeholder="e.g. 250000" min="0">
        <small class="field-hint">Leave blank if negotiable</small>
      </div>

      <div class="form-group">
        <label for="description">Description *</label>
        <textarea id="description" name="description" rows="5"
          placeholder="Provide details about your post..." required maxlength="2000"></textarea>
        <small class="char-count" id="charCount">0 / 2000</small>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-primary">Submit for Approval →</button>
        <a href="<?= BASE_URL ?>/dashboard.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>

<script>
// Show price field only for "For Sale"
document.querySelectorAll('input[name="post_type"]').forEach(radio => {
  radio.addEventListener('change', function() {
    document.getElementById('priceGroup').style.display =
      this.value === 'for_sale' || this.value === 'housing' ? 'block' : 'none';

    // Highlight selected type
    document.querySelectorAll('.type-option').forEach(el => el.classList.remove('selected'));
    this.closest('.type-option').classList.add('selected');
  });
});

// Character counter
document.getElementById('description').addEventListener('input', function() {
  document.getElementById('charCount').textContent = this.value.length + ' / 2000';
});
</script>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
