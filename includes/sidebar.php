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

    <a href="../pages/dashboard.php" class="icon_container">
        <img src="../assets/images/dashboard.png" class="sidebar_icon">
        <span class="icon_text">Dashboard</span>
    </a>

    <a href="../pages/viewrecords.php?view=my" class="icon_container">
        <img src="../assets/images/package.png" class="sidebar_icon">
        <span class="icon_text">My Items</span>
    </a>

    <a href="../pages/index.php" class="icon_container">
        <img src="../assets/images/chart.png" class="sidebar_icon">
        <span class="icon_text">Report Item</span>
    </a>

    <a href="../pages/viewrecords.php?view=all" class="icon_container">
        <img src="../assets/images/eye.png" class="sidebar_icon">
        <span class="icon_text">View Records</span>
    </a>

    <a href="../pages/claimrequest.php" class="icon_container">
        <img src="../assets/images/request.png" class="sidebar_icon">
        <span class="icon_text">Claim Requests</span>
    </a>

    <a href="../pages/claimhistory.php" class="icon_container">
        <img src="../assets/images/history.png" class="sidebar_icon">
        <span class="icon_text">Claim History</span>
    </a>

    <a href="../pages/statushistory.php" class="icon_container">
        <img src="../assets/images/status.png" class="sidebar_icon">
        <span class="icon_text">Status History</span>
    </a>

    <div class="sidebar_bottom">
        <a href="../auth/logout.php" class="icon_container">
            <img src="../assets/images/logout.png" class="sidebar_icon">
            <span class="icon_text">Log Out</span>
        </a>
    </div>

</aside>