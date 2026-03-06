<?php
$pageTitle = 'Manage Users — INES UniStack';
require_once __DIR__ . '/../shared/header.php';
?>
<div class="dashboard-wrapper">
  <aside class="sidebar">
    <nav class="sidebar-nav">
      <a href="<?= BASE_URL ?>/admin/dashboard.php">📊 Overview</a>
      <a href="<?= BASE_URL ?>/admin/users.php" class="active">👥 Users</a>
      <a href="<?= BASE_URL ?>/admin/posts.php">📋 All Posts</a>
      <a href="<?= BASE_URL ?>/admin/reports.php">🚩 Reports</a>
      <a href="<?= BASE_URL ?>/logout.php">🚪 Logout</a>
    </nav>
  </aside>

  <div class="dashboard-main">
    <h1>👥 User Management</h1>
    <div class="card">
      <div class="table-wrapper">
        <table class="data-table">
          <thead>
            <tr><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Joined</th><th>Actions</th></tr>
          </thead>
          <tbody>
            <?php foreach ($users as $u): ?>
            <tr>
              <td><?= h($u['full_name']) ?></td>
              <td><?= h($u['email']) ?></td>
              <td><span class="role-badge role-<?= h($u['role']) ?>"><?= ucfirst(h($u['role'])) ?></span></td>
              <td><span class="status-badge <?= $u['is_active'] ? 'status-approved' : 'status-rejected' ?>"><?= $u['is_active'] ? 'Active' : 'Inactive' ?></span></td>
              <td><?= date('M j, Y', strtotime($u['created_at'])) ?></td>
              <td>
                <button class="btn btn-xs btn-primary" onclick="openEditModal(<?= $u['id'] ?>, '<?= h($u['role']) ?>', <?= $u['is_active'] ?>)">Edit</button>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal-overlay" id="editModal" style="display:none;">
  <div class="modal-box">
    <h3>Edit User</h3>
    <form method="POST" id="editForm" action="">
      <div class="form-group">
        <label>Role</label>
        <select name="role" id="editRole" class="form-control">
          <option value="student">Student</option>
          <option value="moderator">Moderator</option>
          <option value="admin">Admin</option>
        </select>
      </div>
      <div class="form-group">
        <label>Account Status</label>
        <select name="is_active" id="editActive" class="form-control">
          <option value="1">Active</option>
          <option value="0">Inactive (Suspended)</option>
        </select>
      </div>
      <div class="modal-actions">
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <button type="button" class="btn btn-secondary" onclick="document.getElementById('editModal').style.display='none'">Cancel</button>
      </div>
    </form>
  </div>
</div>

<script>
function openEditModal(userId, role, isActive) {
  document.getElementById('editForm').action = '<?= BASE_URL ?>/admin/update_user.php?id=' + userId;
  document.getElementById('editRole').value   = role;
  document.getElementById('editActive').value = isActive;
  document.getElementById('editModal').style.display = 'flex';
}
</script>
<?php require_once __DIR__ . '/../shared/footer.php'; ?>
