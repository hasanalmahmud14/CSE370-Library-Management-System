<section class="card">
  <div class="card-header">
    <h2>Admin Dashboard</h2>
    <p>Welcome back, <?php echo htmlspecialchars($_SESSION['admin_name'] ?? 'Admin', ENT_QUOTES, 'UTF-8'); ?>.</p>
  </div>
  <div class="hero-actions">
    <a class="btn primary" href="<?php echo url('/admin/books'); ?>">Manage Books</a>
    <a class="btn ghost" href="<?php echo url('/admin/users'); ?>">Manage Users</a>
  </div>
  <div class="grid">
    <div class="panel">
      <h3>Inventory</h3>
      <p>Review the book catalog and ensure availability.</p>
    </div>
    <div class="panel">
      <h3>Users</h3>
      <p>Track sign-ups, manage accounts, and support readers.</p>
    </div>
    <div class="panel">
      <h3>Reports</h3>
      <p>Monitor library activity and borrowing trends.</p>
    </div>
  </div>
</section>
