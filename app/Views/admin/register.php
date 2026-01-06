<section class="card">
  <div class="card-header">
    <h2>Admin Registration</h2>
    <p>Create a secure admin profile.</p>
  </div>
  <form method="post" action="<?php echo url('/admin/register'); ?>" class="form">
    <?php echo csrf_field(); ?>
    <label>
      Name
      <input type="text" name="Adminname" required>
    </label>
    <label>
      Admin ID
      <input type="text" name="Admin_id" required>
    </label>
    <label>
      Email
      <input type="email" name="Email" required>
    </label>
    <label>
      Password
      <input type="password" name="Password" required>
    </label>
    <button class="btn primary" type="submit">Create Admin</button>
  </form>
  <p class="meta">Already admin? <a href="<?php echo url('/admin/login'); ?>">Log in</a>.</p>
</section>
