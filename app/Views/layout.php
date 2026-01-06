<?php
use App\Core\Session;

$flashError = Session::flash('error');
$flashSuccess = Session::flash('success');
$flashInfo = Session::flash('info');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($title ?? config('app.name'), ENT_QUOTES, 'UTF-8'); ?></title>
  <link rel="stylesheet" href="<?php echo asset('style.css'); ?>">
</head>
<body>
  <header class="site-header">
    <div class="brand">
      <a href="<?php echo url('/'); ?>">Library System</a>
      <span>Knowledge in motion</span>
    </div>
    <nav class="main-nav">
      <a href="<?php echo url('/'); ?>">Home</a>
      <a href="<?php echo url('/books'); ?>">Books</a>
      <?php if (is_user()): ?>
        <a href="<?php echo url('/profile'); ?>">Profile</a>
        <a href="<?php echo url('/cart'); ?>">Cart</a>
        <a class="pill" href="<?php echo url('/logout'); ?>">Logout</a>
      <?php elseif (is_admin()): ?>
        <a class="pill" href="<?php echo url('/logout'); ?>">Logout</a>
      <?php else: ?>
        <a href="<?php echo url('/login'); ?>">User Login</a>
        <a href="<?php echo url('/register'); ?>">Sign Up</a>
      <?php endif; ?>
      <?php if (is_admin()): ?>
        <a class="pill" href="<?php echo url('/admin'); ?>">Admin</a>
      <?php else: ?>
        <a class="pill" href="<?php echo url('/admin/login'); ?>">Admin</a>
      <?php endif; ?>
    </nav>
  </header>

  <main class="page">
    <?php if ($flashError): ?>
      <div class="notice error"><?php echo htmlspecialchars($flashError, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>
    <?php if ($flashSuccess): ?>
      <div class="notice success"><?php echo htmlspecialchars($flashSuccess, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>
    <?php if ($flashInfo): ?>
      <div class="notice info"><?php echo htmlspecialchars($flashInfo, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <?php require $viewFile; ?>
  </main>

  <footer class="site-footer">
    <div>
      <strong>Contact:</strong> info@onlinelibrary.com | +1-234-567-890
    </div>
    <div>
      <a href="<?php echo url('/'); ?>">Home</a>
      <a href="<?php echo url('/books'); ?>">Books</a>
      <a href="<?php echo url('/login'); ?>">User Login</a>
      <a href="<?php echo url('/admin/login'); ?>">Admin Login</a>
    </div>
    <div>Copyright 2024 Online Library Management System.</div>
  </footer>
</body>
</html>
