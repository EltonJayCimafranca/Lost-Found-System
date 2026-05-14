<?php
    session_start();
    include '../includes/connect.php';

    $user_id = $_SESSION['user_id'];

    $query = "
    SELECT cr.*, i.item_name
    FROM claim_requests cr
    JOIN items i ON cr.item_id = i.id
    WHERE cr.user_id = '$user_id'
    ORDER BY cr.date_requested DESC";

    $result = mysqli_query($connection, $query);
?>
<link rel="stylesheet" href="../assets/css/history.css?v=2">
<link rel="stylesheet" href="../assets/css/sidebar.css?v=7">
<link rel="stylesheet" href="../assets/css/dashboard.css?v=1">
<div class="layout">

    <!-- SIDEBAR-->
     <?php include '../includes/sidebar.php'?>
    <div class="right">

        <!-- HEADER -->
        <?php include '../includes/dashboardheader.php'; ?>

        <!-- CONTENT -->
        <main class="main-content">
            <h2>Claim History</h2>

            <div class="history-container">

            <?php while($row = mysqli_fetch_assoc($result)) : ?>

                <div class="history-card">

                    <h3><?php echo $row['item_name']; ?></h3>

                    <p>Status: 
                        <?php $status = strtolower($row['claim_status']); ?>
                        <span class="status <?php echo $status; ?>">
                            <?php echo $row['claim_status']; ?>
                        </span>
                    </p>

                    <p>Requested: <?php echo $row['date_requested']; ?></p>
                    <p>Approved: <?php echo $row['date_approved'] ?? 'Not yet'; ?></p>
                    
                </div>

            <?php endwhile; ?>

</div>
        </main>
    </div>
</div>    