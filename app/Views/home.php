<section class="hero">
  <div class="hero-content stagger">
    <p class="eyebrow">Online Library Management System</p>
    <h1>Read smarter. Borrow faster. Learn deeper.</h1>
    <p class="lead">A modern library experience that keeps your reading history, favorites, and cart in one place.</p>
    <div class="hero-actions">
      <a class="btn primary" href="<?php echo url('/books'); ?>">Browse Books</a>
      <?php if (!is_user()): ?>
        <a class="btn ghost" href="<?php echo url('/register'); ?>">Create Account</a>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="features">
  <div class="feature-card stagger">
    <h3>Curated Catalog</h3>
    <p>Explore books with quick add-to-cart actions and clean inventory views.</p>
  </div>
  <div class="feature-card stagger">
    <h3>Personal Dashboard</h3>
    <p>Track your borrow history and manage your reading queue in one view.</p>
  </div>
  <div class="feature-card stagger">
    <h3>Admin Control</h3>
    <p>Secure admin access for managing users and books with clear insights.</p>
  </div>
</section>
