<?php
session_start();

?>

<link rel="stylesheet" href="../assets/css/dashboard.css?v=3">

<div class="layout">

    <!-- SIDEBAR-->
     <?php include '../includes/sidebar.php'?>
    <div class="right">

        <!-- HEADER -->
        <?php include '../includes/dashboardheader.php'; ?>

        <!-- CONTENT -->
        <main class="main-content">
            <h1>Welcome back, <?php echo explode(' ', $_SESSION['fullname'])[0]; ?>!</h1>
            <p>Here's what's happening with your items today    </p>
        </main>

    </div>
</div>

<script src="../assets/js/sidebar.js"></script>