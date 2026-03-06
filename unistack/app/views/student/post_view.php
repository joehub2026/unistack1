<?php
$pageTitle = h($post['title']) . ' — INES UniStack';
require_once __DIR__ . '/../shared/header.php';
$typeLabels = ['for_sale' => '🛒 For Sale', 'housing' => '🏠 Housing', 'announcement' => '📢 Announcement'];
$me = currentUser();
?>

<div class="post-detail-wrapper">
  <div class="post-detail-card">
    <div class="post-detail-header">
      <span class="post-type-badge type-<?= h($post['post_type']) ?>">
        <?= $typeLabels[$post['post_type']] ?? h($post['post_type']) ?>
      </span>
      <span class="status-badge status-<?= h($post['status']) ?>"><?= ucfirst(h($post['status'])) ?></span>
    </div>

    <h1><?= h($post['title']) ?></h1>

    <?php if ($post['price']): ?>
      <div class="post-detail-price"><?= number_format($post['price'], 0) ?> RWF</div>
    <?php endif; ?>

    <div class="post-meta">
      <span>👤 <?= h($post['author_name']) ?></span>
      <span>✉ <?= h($post['author_email']) ?></span>
      <span>📅 <?= date('F j, Y \a\t g:ia', strtotime($post['created_at'])) ?></span>
    </div>

    <div class="post-detail-body">
      <?= nl2br(h($post['description'])) ?>
    </div>

    <div class="post-detail-actions">
      <a href="<?= BASE_URL ?>/board.php" class="btn btn-secondary">← Back to Board</a>

      <?php if ($me['id'] == $post['user_id']): ?>
        <a href="<?= BASE_URL ?>/post/edit.php?id=<?= $post['id'] ?>" class="btn btn-primary">Edit</a>
        <form method="POST" action="<?= BASE_URL ?>/post/delete.php?id=<?= $post['id'] ?>" style="display:inline;"
              onsubmit="return confirm('Delete this post permanently?')">
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      <?php elseif ($post['status'] === 'approved'): ?>
        <button class="btn btn-danger" onclick="document.getElementById('reportSection').style.display='block'">🚩 Report Post</button>
      <?php endif; ?>

      <?php if (in_array($me['role'], ['moderator', 'admin'])): ?>
        <form method="POST" action="<?= BASE_URL ?>/moderator/approve.php?id=<?= $post['id'] ?>" style="display:inline;">
          <button type="submit" class="btn btn-success">✅ Approve</button>
        </form>
        <form method="POST" action="<?= BASE_URL ?>/moderator/reject.php?id=<?= $post['id'] ?>" style="display:inline;">
          <button type="submit" class="btn btn-danger">❌ Reject</button>
        </form>
      <?php endif; ?>
    </div>

    <!-- Report form (hidden by default) -->
    <div id="reportSection" style="display:none;" class="report-section">
      <h3>🚩 Report this post</h3>
      <form method="POST" action="<?= BASE_URL ?>/post/report.php?id=<?= $post['id'] ?>">
        <div class="form-group">
          <label>Reason for reporting:</label>
          <textarea name="reason" rows="3" required placeholder="Describe the issue (scam, spam, inappropriate content)..." class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-danger">Submit Report</button>
        <button type="button" class="btn btn-secondary" onclick="document.getElementById('reportSection').style.display='none'">Cancel</button>
      </form>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
