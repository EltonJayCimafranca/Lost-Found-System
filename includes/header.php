<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
    <link rel="stylesheet" href="../assets/css/main.css?v=3">

    <div class="navBox">
        <!-- ALWAYS SHOW LOGO -->
        <div class="logo">
            <h2>CITUFind</h2>
            <h3>Lost and Found System</h3>
        </div>
        <nav>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="../auth/login.php">Login</a>
                <a href="../auth/register.php">Register</a>
             <?php endif; ?>
        </nav>
    </div>
</header>