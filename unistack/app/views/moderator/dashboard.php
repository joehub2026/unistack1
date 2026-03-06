<?php
$pageTitle = 'Moderator Panel — INES UniStack';
require_once __DIR__ . '/../shared/header.php';
$typeLabels = ['for_sale' => '🛒 For Sale', 'housing' => '🏠 Housing', 'announcement' => '📢 Announcement'];
?>

<div class="dashboard-wrapper">
  <aside class="sidebar">
    <div class="sidebar-user">
      <div class="avatar">🛡</div>
      <div>
        <strong><?= h($user['full_name']) ?></strong>
        <span class="role-badge role-moderator">Moderator</span>
      </div>
    </div>
    <nav class="sidebar-nav">
      <a href="<?= BASE_URL ?>/moderator/dashboard.php" class="active">⏳ Pending Queue</a>
      <a href="<?= BASE_URL ?>/board.php">📋 Notice Board</a>
      <a href="<?= BASE_URL ?>/logout.php">🚪 Logout</a>
    </nav>
  </aside>

  <div class="dashboard-main">
    <h1>Moderation Panel</h1>

    <div class="stats-row">
      <div class="stat-card stat-yellow">
        <div class="stat-number"><?= count($pending) ?></div>
        <div class="stat-label">⏳ Awaiting Approval</div>
      </div>
      <div class="stat-card stat-red">
        <div class="stat-number"><?= count($flagged) ?></div>
        <div class="stat-label">🚩 Open Reports</div>
      </div>
    </div>

    <!-- Pending Posts -->
    <div class="card">
      <div class="card-header"><h2>⏳ Pending Posts</h2></div>
      <?php if (empty($pending)): ?>
        <div class="empty-state"><p>🎉 No posts awaiting approval!</p></div>
      <?php else: ?>
        <?php foreach ($pending as $post): ?>
        <div class="mod-post-item">
          <div class="mod-post-meta">
            <span class="post-type-badge type-<?= h($post['post_type']) ?>"><?= $typeLabels[$post['post_type']] ?></span>
            <span class="mod-author">👤 <?= h($post['author_name']) ?> (<?= h($post['author_email']) ?>)</span>
            <span class="mod-date">📅 <?= date('M j, g:ia', strtotime($post['created_at'])) ?></span>
          </div>
          <h3><?= h($post['title']) ?></h3>
          <?php if ($post['price']): ?>
            <span class="post-price"><?= number_format($post['price'], 0) ?> RWF</span>
          <?php endif; ?>
          <p><?= h(mb_substr($post['description'], 0, 200)) ?>...</p>
          <div class="mod-actions">
            <form method="POST" action="<?= BASE_URL ?>/moderator/approve.php?id=<?= $post['id'] ?>" style="display:inline;">
              <button type="submit" class="btn btn-success">✅ Approve</button>
            </form>
            <form method="POST" action="<?= BASE_URL ?>/moderator/reject.php?id=<?= $post['id'] ?>" style="display:inline;">
              <button type="submit" class="btn btn-danger">❌ Reject</button>
            </form>
            <a href="<?= BASE_URL ?>/post/view.php?id=<?= $post['id'] ?>" class="btn btn-secondary btn-sm">Full View</a>
          </div>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- Flagged Reports -->
    <div class="card">
      <div class="card-header"><h2>🚩 Open Reports</h2></div>
      <?php if (empty($flagged)): ?>
        <div class="empty-state"><p>No open reports.</p></div>
      <?php else: ?>
        <?php foreach ($flagged as $report): ?>
        <div class="mod-post-item mod-report">
          <div class="mod-post-meta">
            <strong>Post: <?= h($report['post_title']) ?></strong>
            <span class="post-type-badge type-<?= h($report['post_type']) ?>"><?= $typeLabels[$report['post_type']] ?? '' ?></span>
          </div>
          <p><strong>Reported by:</strong> <?= h($report['reporter_name']) ?></p>
          <p><strong>Reason:</strong> <?= h($report['reason']) ?></p>
          <p><small>📅 <?= date('M j, g:ia', strtotime($report['created_at'])) ?></small></p>
          <div class="mod-actions">
            <form method="POST" action="<?= BASE_URL ?>/moderator/report_action.php?id=<?= $report['id'] ?>&action=reviewed" style="display:inline;">
              <button type="submit" class="btn btn-warning btn-sm">Mark Reviewed</button>
            </form>
            <form method="POST" action="<?= BASE_URL ?>/moderator/report_action.php?id=<?= $report['id'] ?>&action=dismissed" style="display:inline;">
              <button type="submit" class="btn btn-secondary btn-sm">Dismiss</button>
            </form>
            <a href="<?= BASE_URL ?>/post/view.php?id=<?= $report['post_id'] ?>" class="btn btn-secondary btn-sm">View Post</a>
          </div>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
