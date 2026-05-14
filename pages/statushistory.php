<?php
    session_start();
    include '../includes/connect.php';

    $query = "SELECT * FROM status_history";
    $result = mysqli_query($connection, $query);
?>

<link rel="stylesheet" href="../assets/css/statushistory.css?v=2">
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
            <h1>Status History</h1>

            <table class="status-table">
                <thead>
                    <tr>
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
                    <?php 
                        $item_name = "Unknown";

                        if ($row['entity_type'] == 'Claim') {

                            $id = $row['entity_id'];

                            $query = "SELECT item_id FROM claim_requests WHERE claim_id = '$id'";

                            $result = mysqli_query($connection, $query);
                            $claim = mysqli_fetch_assoc($result);

                            if ($claim) {
                                $item_id = $claim['item_id'];

                                $itemQuery = "SELECT item_name FROM items WHERE id = '$item_id'";
                                $itemResult = mysqli_query($connection, $itemQuery);
                                $itemData = mysqli_fetch_assoc($itemResult);

                                if ($itemData) {
                                    $item_name = $itemData['item_name'];
                                }
                            }
                        }
                        ?>
                    <tr>
                        <td><?php echo $item_name; ?></td>
                        <td><?php echo $row['entity_type']; ?></td>
                        <td><?php echo $row['entity_id']; ?></td>
                        <td><?php echo $row['old_status']; ?></td>
                        <td><?php echo $row['new_status']; ?></td>
                        <td><?php echo $row['date_changed']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>        