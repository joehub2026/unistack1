<?php
$pageTitle = 'Reports — INES UniStack';
require_once __DIR__ . '/../app/config/auth.php';
require_once __DIR__ . '/../app/views/shared/header.php';
?>
<div class="dashboard-wrapper">
  <aside class="sidebar">
    <nav class="sidebar-nav">
      <a href="<?= BASE_URL ?>/admin/dashboard.php">📊 Overview</a>
      <a href="<?= BASE_URL ?>/admin/users.php">👥 Users</a>
      <a href="<?= BASE_URL ?>/admin/all_posts.php">📋 All Posts</a>
      <a href="<?= BASE_URL ?>/admin/reports.php" class="active">🚩 Reports</a>
      <a href="<?= BASE_URL ?>/logout.php">🚪 Logout</a>
    </nav>
  </aside>
  <div class="dashboard-main">
    <h1>🚩 All Reports</h1>
    <div class="card">
      <div class="table-wrapper">
        <table class="data-table">
          <thead><tr><th>Post</th><th>Reported By</th><th>Reason</th><th>Status</th><th>Date</th></tr></thead>
          <tbody>
            <?php foreach ($reports as $r): ?>
            <tr>
              <td><?= h($r['post_title']) ?></td>
              <td><?= h($r['reporter_name']) ?></td>
              <td><?= h(mb_substr($r['reason'], 0, 80)) ?></td>
              <td><span class="status-badge status-<?= $r['status'] === 'open' ? 'pending' : 'approved' ?>"><?= ucfirst(h($r['status'])) ?></span></td>
              <td><?= date('M j, Y', strtotime($r['created_at'])) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../app/views/shared/footer.php'; ?>
