<section class="card">
  <div class="card-header">
    <h2>User Login</h2>
    <p>Access your personal library space.</p>
  </div>
  <form method="post" action="<?php echo url('/login'); ?>" class="form">
    <?php echo csrf_field(); ?>
    <label>
      User ID
      <input type="text" name="UserID" required>
    </label>
    <label>
      Password
      <input type="password" name="Password" required>
    </label>
    <button class="btn primary" type="submit">Log In</button>
  </form>
  <p class="meta">New here? <a href="<?php echo url('/register'); ?>">Create an account</a>.</p>
</section>
