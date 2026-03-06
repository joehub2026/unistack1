<?php
$pageTitle = 'My Dashboard — INES UniStack';
require_once __DIR__ . '/../shared/header.php';
$typeLabels = ['for_sale' => '🛒 For Sale', 'housing' => '🏠 Housing', 'announcement' => '📢 Announcement'];
?>

<div class="dashboard-wrapper">
  <aside class="sidebar">
    <div class="sidebar-user">
      <div class="avatar">👤</div>
      <div>
        <strong><?= h($user['full_name']) ?></strong>
        <small><?= h($user['email']) ?></small>
        <span class="role-badge role-student">Student</span>
      </div>
    </div>
    <nav class="sidebar-nav">
      <a href="<?= BASE_URL ?>/dashboard.php" class="active">📊 My Dashboard</a>
      <a href="<?= BASE_URL ?>/post/create.php">➕ New Post</a>
      <a href="<?= BASE_URL ?>/board.php">📋 Notice Board</a>
      <a href="<?= BASE_URL ?>/logout.php">🚪 Logout</a>
    </nav>
  </aside>

  <div class="dashboard-main">
    <h1>My Dashboard</h1>

    <!-- Stats Row -->
    <div class="stats-row">
      <div class="stat-card">
        <div class="stat-number"><?= array_sum($counts) ?></div>
        <div class="stat-label">Total Posts</div>
      </div>
      <div class="stat-card stat-green">
        <div class="stat-number"><?= $counts['approved'] ?></div>
        <div class="stat-label">✅ Approved</div>
      </div>
      <div class="stat-card stat-yellow">
        <div class="stat-number"><?= $counts['pending'] ?></div>
        <div class="stat-label">⏳ Pending</div>
      </div>
      <div class="stat-card stat-red">
        <div class="stat-number"><?= $counts['rejected'] ?></div>
        <div class="stat-label">❌ Rejected</div>
      </div>
    </div>

    <!-- Posts Table -->
    <div class="card">
      <div class="card-header">
        <h2>My Posts</h2>
        <a href="<?= BASE_URL ?>/post/create.php" class="btn btn-primary btn-sm">+ New Post</a>
      </div>

      <?php if (empty($posts)): ?>
        <div class="empty-state">
          <p>You haven't posted anything yet.</p>
          <a href="<?= BASE_URL ?>/post/create.php" class="btn btn-primary">Create your first post</a>
        </div>
      <?php else: ?>
        <div class="table-wrapper">
          <table class="data-table">
            <thead>
              <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($posts as $post): ?>
              <tr>
                <td><?= h($post['title']) ?></td>
                <td><?= $typeLabels[$post['post_type']] ?? h($post['post_type']) ?></td>
                <td><span class="status-badge status-<?= h($post['status']) ?>"><?= ucfirst($post['status']) ?></span></td>
                <td><?= date('M j, Y', strtotime($post['created_at'])) ?></td>
                <td class="actions-cell">
                  <a href="<?= BASE_URL ?>/post/view.php?id=<?= $post['id'] ?>" class="btn btn-xs btn-secondary">View</a>
                  <?php if (in_array($post['status'], ['pending', 'rejected'])): ?>
                    <a href="<?= BASE_URL ?>/post/edit.php?id=<?= $post['id'] ?>" class="btn btn-xs btn-primary">Edit</a>
                  <?php endif; ?>
                  <form method="POST" action="<?= BASE_URL ?>/post/delete.php?id=<?= $post['id'] ?>" style="display:inline;"
                        onsubmit="return confirm('Delete this post?')">
                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
