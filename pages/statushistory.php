<?php
    session_start();
    include '../includes/connect.php';

    $query = "
        SELECT 
            sh.history_id,
            u.fullname,
            i.item_name,
            sh.entity_type,
            sh.entity_id,
            sh.old_status,
            sh.new_status,
            sh.date_changed
        FROM status_history sh
        INNER JOIN claim_requests cr 
            ON sh.entity_id = cr.claim_id
            AND sh.entity_type = 'Claim'
        INNER JOIN user u 
            ON cr.user_id = u.id
        INNER JOIN items i 
            ON cr.item_id = i.id
        ORDER BY sh.date_changed DESC
    ";

    $result = mysqli_query($connection, $query);
?>

<link rel="stylesheet" href="../assets/css/sidebar.css?v=9">
<link rel="stylesheet" href="../assets/css/dashboard.css?v=8">
<link rel="stylesheet" href="../assets/css/table.css?v=2">
<link rel="stylesheet" href="../assets/css/statushistory.css?v=7">

<div class="layout">
    <!-- SIDEBAR -->
    <?php include '../includes/sidebar.php'; ?>

    <div class="right">
        <!-- HEADER -->
        <?php include '../includes/dashboardheader.php'; ?>

        <!-- CONTENT -->
        <main class="main-content">
            <!-- Consistent Header Container -->
            <div class="filter_container">
                <h2>STATUS HISTORY REPORT</h2>
            </div>

            <!-- Table Wrapper for Scrollability and Padding -->
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Claimant</th>
                            <th>Item Name</th>
                            <th>Type</th>
                            <th>ID</th>
                            <th>Old Status</th>
                            <th>New Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['fullname']; ?></td>
                            <td><?php echo $row['item_name']; ?></td>
                            <td><?php echo $row['entity_type']; ?></td>
                            <td><?php echo $row['entity_id']; ?></td>
                            <td>
                                <span class="status <?php echo strtolower($row['old_status']); ?>">
                                    <?php echo $row['old_status']; ?>
                                </span>
                            </td>
                            <td>
                                <span class="status <?php echo strtolower($row['new_status']); ?>">
                                    <?php echo $row['new_status']; ?>
                                </span>
                            </td>
                            <td><?php echo date('M d, Y h:i A', strtotime($row['date_changed'])); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>        
<script src="../assets/js/sidebar.js"></script>