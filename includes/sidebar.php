<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
} ?>

<aside class="sidebar" id="sidebar">

    <button class="toggle-btn" id="toggleBtn">
        <img src="../assets/images/menu.png" id="menuBtn">
        <div class="logo">
            <h2>CITUFind</h2>
            <h3>Lost & Found System</h3>
        </div>
    </button>

    <a href="../pages/dashboard.php">Dashboard</a>

    <a href="../pages/index.php">Report an Item</a>
    <a href="../pages/viewrecords.php">My Submissions</a>
    <a href="../pages/index.php">Claim History</a>

    <a href="../auth/settings.php">Settings</a>

    <div class="sidebar_bottom">
        <a href="../auth/logout.php">Log Out</a>
    </div>

</aside>