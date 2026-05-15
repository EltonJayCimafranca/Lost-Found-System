<?php
session_start();
include '../includes/connect.php';
?>

<link rel="stylesheet" href="../assets/css/sidebar.css?v=9">
<link rel="stylesheet" href="../assets/css/dashboard.css?v=8">
<link rel="stylesheet" href="../assets/css/table.css?v=2">
<link rel="stylesheet" href="../assets/css/adminreport.css?v=4">

<div class="layout">
    <!-- SIDEBAR -->
    <?php include '../includes/sidebar.php'?>

    <div class="right">
        <!-- HEADER -->
        <?php include '../includes/dashboardheader.php'; ?>

        <!-- CONTENT -->
        <main class="main-content">
            
            <?php
                // Filter Logic
                $status_filter = $_GET['status'] ?? 'all';
                $where = "";

                if ($status_filter != 'all') {
                    // We filter by the Item's status (Lost/Found/Claimed)
                    $where = "WHERE i.status = '$status_filter'";
                }

                $query = "
                    SELECT
                        i.item_name,
                        i.status AS item_status,
                        i.location,
                        cr.claim_id,
                        cr.claim_status,
                        cr.date_requested
                    FROM claim_requests cr
                    RIGHT JOIN items i ON cr.item_id = i.id
                    $where
                    ORDER BY i.item_name ASC";

                $result = mysqli_query($connection, $query);
            ?>

            <!-- Header and Filter Box -->
            <div class="filter_container">
                <h2>ITEMS & CLAIMS REPORT</h2>
                
                <div class="filter-box">
                    <a href="?status=all" class="filter-btn <?= $status_filter=='all' ? 'active' : '' ?>">All Items</a>
                    <a href="?status=lost" class="filter-btn <?= $status_filter=='lost' ? 'active' : '' ?>">Lost</a>
                    <a href="?status=found" class="filter-btn <?= $status_filter=='found' ? 'active' : '' ?>">Found</a>
                    <a href="?status=claimed" class="filter-btn <?= $status_filter=='claimed' ? 'active' : '' ?>">Claimed</a>
                </div>
            </div>

            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Item Status</th>
                            <th>Location</th>
                            <th>Claim ID</th>
                            <th>Claim Status</th>
                            <th>Date Requested</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        <?php if(mysqli_num_rows($result) > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td style="font-weight: 600; color: #333;"><?php echo $row['item_name']; ?></td>
                                <td>
                                    <span class="status <?php echo strtolower($row['item_status']); ?>">
                                        <?php echo ucfirst($row['item_status']); ?>
                                    </span>
                                </td>
                                <td><?php echo $row['location']; ?></td>
                                <td style="font-family: monospace; font-weight: bold;">
                                    <?php echo $row['claim_id'] ?? '<span class="empty">-</span>'; ?>
                                </td>
                                <td>
                                    <?php if ($row['claim_status']) : ?>
                                        <span class="status <?php echo strtolower($row['claim_status']); ?>">
                                            <?php echo ucfirst($row['claim_status']); ?>
                                        </span>
                                    <?php else : ?>
                                        <span class="status-empty">No Claim Request</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php 
                                        echo ($row['date_requested']) 
                                        ? date('M d, Y', strtotime($row['date_requested'])) 
                                        : '<span class="empty">-</span>'; 
                                    ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align:center; padding: 30px; color: #999;">No items found for this category.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>  
<script src="../assets/js/sidebar.js"></script>