<?php
$pageTitle = 'All Posts — INES UniStack';
require_once __DIR__ . '/../app/config/auth.php';
require_once __DIR__ . '/../app/views/shared/header.php';
$typeLabels = ['for_sale' => '🛒 For Sale', 'housing' => '🏠 Housing', 'announcement' => '📢 Announcement'];
?>
<div class="dashboard-wrapper">
  <aside class="sidebar">
    <nav class="sidebar-nav">
      <a href="<?= BASE_URL ?>/admin/dashboard.php">📊 Overview</a>
      <a href="<?= BASE_URL ?>/admin/users.php">👥 Users</a>
      <a href="<?= BASE_URL ?>/admin/posts.php" class="active">📋 All Posts</a>
      <a href="<?= BASE_URL ?>/admin/reports.php">🚩 Reports</a>
      <a href="<?= BASE_URL ?>/logout.php">🚪 Logout</a>
    </nav>
  </aside>
  <div class="dashboard-main">
    <h1>📋 All Posts</h1>
    <div class="card">
      <div class="table-wrapper">
        <table class="data-table">
          <thead><tr><th>Title</th><th>Type</th><th>Author</th><th>Status</th><th>Date</th><th>Actions</th></tr></thead>
          <tbody>
            <?php foreach ($posts as $post): ?>
            <tr>
              <td><?= h($post['title']) ?></td>
              <td><?= $typeLabels[$post['post_type']] ?? h($post['post_type']) ?></td>
              <td><?= h($post['author_name']) ?></td>
              <td><span class="status-badge status-<?= h($post['status']) ?>"><?= ucfirst(h($post['status'])) ?></span></td>
              <td><?= date('M j, Y', strtotime($post['created_at'])) ?></td>
              <td>
                <a href="<?= BASE_URL ?>/post/view.php?id=<?= $post['id'] ?>" class="btn btn-xs btn-secondary">View</a>
                <?php if ($post['status'] === 'pending'): ?>
                  <form method="POST" action="<?= BASE_URL ?>/moderator/approve.php?id=<?= $post['id'] ?>" style="display:inline;">
                    <button class="btn btn-xs btn-success">Approve</button>
                  </form>
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../app/views/shared/footer.php'; ?>
