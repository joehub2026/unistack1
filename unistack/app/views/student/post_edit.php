<?php
$pageTitle = 'Edit Post — INES UniStack';
require_once __DIR__ . '/../shared/header.php';
?>
<div class="form-page-wrapper">
  <div class="form-card">
    <h1>✏️ Edit Post</h1>
    <p class="form-subtitle">Editing will re-submit your post for moderator approval.</p>

    <form method="POST" action="<?= BASE_URL ?>/post/edit.php?id=<?= $post['id'] ?>" novalidate>

      <div class="form-group">
        <label>Post Type *</label>
        <div class="type-selector">
          <?php foreach (['for_sale' => '🛒 For Sale', 'housing' => '🏠 Housing', 'announcement' => '📢 Announcement'] as $val => $label): ?>
          <label class="type-option <?= $post['post_type'] === $val ? 'selected' : '' ?>">
            <input type="radio" name="post_type" value="<?= $val ?>" <?= $post['post_type'] === $val ? 'checked' : '' ?> required>
            <span class="type-option-inner"><?= $label ?></span>
          </label>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="form-group">
        <label for="title">Title *</label>
        <input type="text" id="title" name="title" value="<?= h($post['title']) ?>" required maxlength="200">
      </div>

      <div class="form-group">
        <label for="price">Price (RWF)</label>
        <input type="number" id="price" name="price" value="<?= h($post['price'] ?? '') ?>" min="0">
      </div>

      <div class="form-group">
        <label for="description">Description *</label>
        <textarea id="description" name="description" rows="5" required maxlength="2000"><?= h($post['description']) ?></textarea>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save & Re-Submit →</button>
        <a href="<?= BASE_URL ?>/dashboard.php" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</div>
<?php require_once __DIR__ . '/../shared/footer.php'; ?>
