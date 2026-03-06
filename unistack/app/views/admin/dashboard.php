<?php
$pageTitle = 'Admin Panel — INES UniStack';
require_once __DIR__ . '/../shared/header.php';

$totalUsers    = count($users);
$totalPosts    = count($posts);
$pendingPosts  = count(array_filter($posts, fn($p) => $p['status'] === 'pending'));
$approvedPosts = count(array_filter($posts, fn($p) => $p['status'] === 'approved'));
$openReports   = count(array_filter($reports, fn($r) => $r['status'] === 'open'));
?>

<div class="dashboard-wrapper">
  <aside class="sidebar">
    <div class="sidebar-user">
      <div class="avatar">⚙️</div>
      <div>
        <strong><?= h($user['full_name']) ?></strong>
        <span class="role-badge role-admin">Admin</span>
      </div>
    </div>
    <nav class="sidebar-nav">
      <a href="<?= BASE_URL ?>/admin/dashboard.php" class="active">📊 Overview</a>
      <a href="<?= BASE_URL ?>/admin/users.php">👥 Users</a>
      <a href="<?= BASE_URL ?>/admin/posts.php">📋 All Posts</a>
      <a href="<?= BASE_URL ?>/admin/reports.php">🚩 Reports</a>
      <a href="<?= BASE_URL ?>/moderator/dashboard.php">🛡 Mod Queue</a>
      <a href="<?= BASE_URL ?>/board.php">📋 Board</a>
      <a href="<?= BASE_URL ?>/logout.php">🚪 Logout</a>
    </nav>
  </aside>

  <div class="dashboard-main">
    <h1>Admin Overview</h1>

    <div class="stats-row stats-row-5">
      <div class="stat-card">
        <div class="stat-number"><?= $totalUsers ?></div>
        <div class="stat-label">👥 Total Users</div>
      </div>
      <div class="stat-card">
        <div class="stat-number"><?= $totalPosts ?></div>
        <div class="stat-label">📋 Total Posts</div>
      </div>
      <div class="stat-card stat-green">
        <div class="stat-number"><?= $approvedPosts ?></div>
        <div class="stat-label">✅ Live Posts</div>
      </div>
      <div class="stat-card stat-yellow">
        <div class="stat-number"><?= $pendingPosts ?></div>
        <div class="stat-label">⏳ Pending</div>
      </div>
      <div class="stat-card stat-red">
        <div class="stat-number"><?= $openReports ?></div>
        <div class="stat-label">🚩 Open Reports</div>
      </div>
    </div>

    <!-- Recent Users -->
    <div class="card">
      <div class="card-header">
        <h2>👥 Recent Users</h2>
        <a href="<?= BASE_URL ?>/admin/users.php" class="btn btn-secondary btn-sm">View All</a>
      </div>
      <div class="table-wrapper">
        <table class="data-table">
          <thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Joined</th></tr></thead>
          <tbody>
            <?php foreach (array_slice($users, 0, 5) as $u): ?>
            <tr>
              <td><?= h($u['full_name']) ?></td>
              <td><?= h($u['email']) ?></td>
              <td><span class="role-badge role-<?= h($u['role']) ?>"><?= ucfirst(h($u['role'])) ?></span></td>
              <td><span class="status-badge <?= $u['is_active'] ? 'status-approved' : 'status-rejected' ?>"><?= $u['is_active'] ? 'Active' : 'Inactive' ?></span></td>
              <td><?= date('M j, Y', strtotime($u['created_at'])) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Recent Posts -->
    <div class="card">
      <div class="card-header">
        <h2>📋 Recent Posts</h2>
        <a href="<?= BASE_URL ?>/admin/posts.php" class="btn btn-secondary btn-sm">View All</a>
      </div>
      <div class="table-wrapper">
        <table class="data-table">
          <thead><tr><th>Title</th><th>Type</th><th>Author</th><th>Status</th><th>Date</th></tr></thead>
          <tbody>
            <?php foreach (array_slice($posts, 0, 5) as $post): ?>
            <tr>
              <td><?= h($post['title']) ?></td>
              <td><?= h($post['post_type']) ?></td>
              <td><?= h($post['author_name']) ?></td>
              <td><span class="status-badge status-<?= h($post['status']) ?>"><?= ucfirst(h($post['status'])) ?></span></td>
              <td><?= date('M j, Y', strtotime($post['created_at'])) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
