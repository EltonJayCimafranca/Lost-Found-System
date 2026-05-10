<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <link rel="stylesheet" href="../assets/css/main.css">
    <div class="navBox">
        <div class="logo">
            <h2>CITUFind</h2>
            <h3>Lost and Found System</h3>
        </div>
        <nav>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="../pages/dashboard.php">Dashboard</a>
                <a href="../pages/index.php">Activity</a>
                <a href="../auth/logout.php">Logout</a>
            <?php else: ?>
                <a href="../auth/login.php">Login</a>
                <a href="../auth/register.php">Register</a>
            <?php endif; ?>
        </nav>
    </div>
</header>