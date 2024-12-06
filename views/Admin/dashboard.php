<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /index.php?controller=Admin&action=login");
    exit;
}
?>

<h1>Chào mừng, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
<a href="/index.php?controller=Admin&action=logout">Đăng xuất</a>