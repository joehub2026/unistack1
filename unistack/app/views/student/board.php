<?php
$pageTitle = 'Notice Board — INES UniStack';
require_once __DIR__ . '/../shared/header.php';

$typeLabels = ['for_sale' => '🛒 For Sale', 'housing' => '🏠 Housing', 'announcement' => '📢 Announcement'];
$currentType   = $_GET['type']   ?? '';
$currentSearch = $_GET['search'] ?? '';
?>

<div class="board-wrapper">
  <div class="board-header">
    <h1>📋 Campus Notice Board</h1>
    <span class="poll-indicator" id="pollIndicator">Live</span>
  </div>

  <!-- Search + Filter Bar -->
  <form method="GET" action="<?= BASE_URL ?>/board.php" class="board-controls">
    <div class="search-bar">
      <input type="text" name="search" value="<?= h($currentSearch) ?>" placeholder="Search posts...">
      <button type="submit" class="btn btn-primary">Search</button>
      <?php if ($currentSearch): ?>
        <a href="<?= BASE_URL ?>/board.php" class="btn btn-secondary">Clear</a>
      <?php endif; ?>
    </div>
    <div class="type-filters">
      <a href="<?= BASE_URL ?>/board.php<?= $currentSearch ? '?search='.urlencode($currentSearch) : '' ?>"
         class="filter-btn <?= !$currentType ? 'active' : '' ?>">All</a>
      <a href="<?= BASE_URL ?>/board.php?type=for_sale<?= $currentSearch ? '&search='.urlencode($currentSearch) : '' ?>"
         class="filter-btn <?= $currentType === 'for_sale' ? 'active' : '' ?>">🛒 For Sale</a>
      <a href="<?= BASE_URL ?>/board.php?type=housing<?= $currentSearch ? '&search='.urlencode($currentSearch) : '' ?>"
         class="filter-btn <?= $currentType === 'housing' ? 'active' : '' ?>">🏠 Housing</a>
      <a href="<?= BASE_URL ?>/board.php?type=announcement<?= $currentSearch ? '&search='.urlencode($currentSearch) : '' ?>"
         class="filter-btn <?= $currentType === 'announcement' ? 'active' : '' ?>">📢 Announcement</a>
    </div>
  </form>

  <!-- Posts Grid -->
  <div class="posts-grid" id="postsGrid">
    <?php if (empty($posts)): ?>
      <div class="empty-state">
        <div class="empty-icon">📭</div>
        <p>No posts found. <?= $currentSearch ? 'Try a different search.' : 'Be the first to post!' ?></p>
        <?php if (currentUser()['role'] === 'student' || currentUser()['role'] === 'admin'): ?>
          <a href="<?= BASE_URL ?>/post/create.php" class="btn btn-primary">+ Create Post</a>
        <?php endif; ?>
      </div>
    <?php else: ?>
      <?php foreach ($posts as $post): ?>
        <div class="post-card" data-type="<?= h($post['post_type']) ?>">
          <div class="post-card-header">
            <span class="post-type-badge type-<?= h($post['post_type']) ?>">
              <?= $typeLabels[$post['post_type']] ?? h($post['post_type']) ?>
            </span>
            <?php if (!empty($post['price'])): ?>
              <span class="post-price"><?= number_format($post['price'], 0) ?> RWF</span>
            <?php endif; ?>
          </div>
          <h3 class="post-title"><?= h($post['title']) ?></h3>
          <p class="post-excerpt"><?= h(mb_substr($post['description'], 0, 120)) ?>...</p>
          <div class="post-meta">
            <span>👤 <?= h($post['author_name']) ?></span>
            <span>🕐 <?= date('M j, g:ia', strtotime($post['created_at'])) ?></span>
          </div>
          <div class="post-actions">
            <a href="<?= BASE_URL ?>/post/view.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-primary">View</a>
            <?php if (currentUser()['id'] !== $post['user_id']): ?>
              <button class="btn btn-sm btn-danger" onclick="openReportModal(<?= $post['id'] ?>)">🚩 Flag</button>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<!-- Report Modal -->
<div class="modal-overlay" id="reportModal" style="display:none;">
  <div class="modal-box">
    <h3>🚩 Report Post</h3>
    <p>Please describe why this post should be reviewed:</p>
    <form method="POST" id="reportForm" action="">
      <textarea name="reason" rows="3" placeholder="e.g. This appears to be a scam..." required class="form-control"></textarea>
      <div class="modal-actions">
        <button type="submit" class="btn btn-danger">Submit Report</button>
        <button type="button" class="btn btn-secondary" onclick="closeReportModal()">Cancel</button>
      </div>
    </form>
  </div>
</div>

<script>
// ── Report Modal ──────────────────────────────────────
function openReportModal(postId) {
  document.getElementById('reportForm').action = '<?= BASE_URL ?>/post/report.php?id=' + postId;
  document.getElementById('reportModal').style.display = 'flex';
}
function closeReportModal() {
  document.getElementById('reportModal').style.display = 'none';
}
document.getElementById('reportModal').addEventListener('click', function(e) {
  if (e.target === this) closeReportModal();
});

// ── JS Polling — simulated real-time (every 10s) ──────
let lastCheck = new Date().toISOString().slice(0, 19).replace('T', ' ');
const indicator = document.getElementById('pollIndicator');

function pollForNew() {
  fetch('<?= BASE_URL ?>/api/poll.php?since=' + encodeURIComponent(lastCheck))
    .then(r => r.json())
    .then(data => {
      lastCheck = data.time;
      if (data.posts && data.posts.length > 0) {
        indicator.textContent = '🟢 ' + data.posts.length + ' new post(s)';
        indicator.classList.add('updated');
        setTimeout(() => {
          indicator.textContent = 'Live';
          indicator.classList.remove('updated');
        }, 5000);
      }
    })
    .catch(() => { indicator.textContent = '⚪ Offline'; });
}

setInterval(pollForNew, 10000);
</script>

<?php require_once __DIR__ . '/../shared/footer.php'; ?>
