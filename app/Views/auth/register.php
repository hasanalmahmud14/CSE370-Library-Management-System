<section class="card">
  <div class="card-header">
    <h2>Create Account</h2>
    <p>Join the library and start exploring.</p>
  </div>
  <form method="post" action="<?php echo url('/register'); ?>" class="form">
    <?php echo csrf_field(); ?>
    <label>
      Name
      <input type="text" name="Username" required>
    </label>
    <label>
      User ID
      <input type="text" name="UserID" required>
    </label>
    <label>
      Email
      <input type="email" name="Email" required>
    </label>
    <label>
      Password
      <input type="password" name="Password" required>
    </label>
    <button class="btn primary" type="submit">Sign Up</button>
  </form>
  <p class="meta">Already have an account? <a href="<?php echo url('/login'); ?>">Log in</a>.</p>
</section>
