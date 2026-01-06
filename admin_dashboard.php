<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
  <div class="logo">
    <h1>ONLINE LIBRARY MANAGEMENT SYSTEM</h1>
  </div>
  <nav>
    <ul>
      <li><a href="books.php">BOOKS</a></li>
      <li><a href="logout.php">LOGOUT</a></li>
    </ul>
  </nav>
</header>

<section>
  <div class="content-card">
    <h2>Admin Dashboard</h2>
    <p>Welcome, admin. Manage library content and users from here.</p>
  </div>
</section>
</body>
</html>
