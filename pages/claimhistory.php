<?php
    session_start();
    include '../includes/connect.php';

    if(!isset($_SESSION['user_id'])) {
        die("User not logged in."); 
    }

    $user_id = $_SESSION['user_id'] ;

    $query = "
    SELECT cr.*, i.item_name
    FROM claim_requests cr
    INNER JOIN items i ON cr.item_id = i.id
    WHERE cr.user_id = '$user_id'
    ORDER BY cr.date_requested DESC";

    $result = mysqli_query($connection, $query);
?>
<link rel="stylesheet" href="../assets/css/sidebar.css?v=9">
<link rel="stylesheet" href="../assets/css/dashboard.css?v=8">
<link rel="stylesheet" href="../assets/css/table.css?v=2"> <!-- Keep this for the status badge colors -->
<link rel="stylesheet" href="../assets/css/history.css?v=6">

<div class="layout">
    <!-- SIDEBAR -->
    <?php include '../includes/sidebar.php'?>

    <div class="right">
        <!-- HEADER -->
        <?php include '../includes/dashboardheader.php'; ?>

        <!-- CONTENT -->
        <main class="main-content">
            <!-- Consistent Header alignment -->
            <div class="filter_container">
                <h2>MY CLAIM HISTORY</h2>
            </div>

            <div class="history-grid-wrapper">
                <div class="history-container">
                    <?php while($row = mysqli_fetch_assoc($result)) : ?>
                        <div class="history-card">
                            <div class="card-header">
                                <h3><?php echo $row['item_name']; ?></h3>
                                <?php $status = strtolower($row['claim_status']); ?>
                                <span class="status <?php echo $status; ?>">
                                    <?php echo ucfirst($row['claim_status']); ?>
                                </span>
                            </div>

                            <div class="card-body">
                                <div class="info-row">
                                    <span class="label">Requested:</span>
                                    <span class="value"><?php echo date('M d, Y', strtotime($row['date_requested'])); ?></span>
                                </div>
                                <div class="info-row">
                                    <span class="label">Approved:</span>
                                    <span class="value"><?php echo $row['date_approved'] ? date('M d, Y', strtotime($row['date_approved'])) : 'Not yet'; ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </main>
    </div>
</div>    
<script src="../assets/js/sidebar.js"></script>