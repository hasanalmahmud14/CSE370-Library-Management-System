<section class="card">
  <div class="card-header">
    <h2>Admin Login</h2>
    <p>Manage the library securely.</p>
  </div>
  <form method="post" action="<?php echo url('/admin/login'); ?>" class="form">
    <?php echo csrf_field(); ?>
    <label>
      Admin ID
      <input type="text" name="Admin_id" required>
    </label>
    <label>
      Password
      <input type="password" name="Password" required>
    </label>
    <button class="btn primary" type="submit">Log In</button>
  </form>
  <p class="meta">Need an admin account? <a href="<?php echo url('/admin/register'); ?>">Register</a>.</p>
</section>
