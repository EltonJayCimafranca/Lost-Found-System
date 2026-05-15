<?php    
    session_start();
    include '../includes/connect.php';

    $view = $_GET['view'] ?? 'all';

    if ($view == 'my') {
        $user_id = $_SESSION['user_id'];
        $query = "SELECT items.*, user.fullname, user.user_type FROM items 
                  LEFT JOIN user ON items.user_id = user.id 
                  WHERE items.user_id = '$user_id'";
    } else {
        $query = "SELECT items.*, user.fullname, user.user_type FROM items 
                  LEFT JOIN user ON items.user_id = user.id";
    }
    $resultset = mysqli_query($connection, $query);
?>

<link rel="stylesheet" href="../assets/css/sidebar.css?v=9">
<link rel="stylesheet" href="../assets/css/dashboard.css?v=8">
<link rel="stylesheet" href="../assets/css/table.css?v=2">
<link rel="stylesheet" href="../assets/css/viewrecords.css?v=10">

<div class="layout">
    <!-- SIDEBAR -->
    <?php include '../includes/sidebar.php'; ?>

    <div class="right">
        <!-- HEADER -->
        <?php include '../includes/dashboardheader.php'; ?>

        <main class="main-content">
            <div class="filter_container">
                <h2>LOST & FOUND RECORDS</h2>
                
                <div class="filter-flex-header">
                    <div class="filter-box">
                        <a href="?view=all" class="filter-btn <?= $view=='all' ? 'active' : '' ?>">All Items</a>
                        <a href="?view=my" class="filter-btn <?= $view=='my' ? 'active' : '' ?>">My Reports</a>
                    </div>
                    
                    <a href="../pages/index.php" class="btn-report-add">+ Report New Item</a>
                </div>
            </div>

            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Reporter</th>
                            <th>Item Name</th>
                            <th>Location</th>
                            <th>Date Reported</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($resultset)) { ?>
                            <tr>
                                <td>
                                    <div class="reporter-info">
                                        <span class="r-name"><?php echo $row['fullname'] ?? 'Unknown'; ?></span>
                                        <span class="r-type"><?php echo $row['user_type'] ?? '-'; ?></span>
                                    </div>
                                </td>
                                <td><span class="item-bold"><?php echo $row['item_name']; ?></span></td>
                                <td><?php echo $row['location']; ?></td>
                                <td><?php echo date('M d, Y', strtotime($row['date_reported'])); ?></td>

                                <td>
                                    <span class="status <?php echo strtolower($row['status']); ?>">
                                        <?php echo ucfirst($row['status']); ?>
                                    </span>
                                </td>

                                <td>
                                    <?php if($row['image']): ?>
                                        <img src="../uploads/<?php echo $row['image']; ?>" class="img-preview" onclick="window.open(this.src)">
                                    <?php else: ?>
                                        <span class="no-img">No Image</span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <div class="action-btn-container">
                                        <a class="btn-table-action btn-update" href="../includes/update.php?id=<?php echo $row['id']; ?>">Update</a>
                                        <a class="btn-table-action btn-delete" href="../includes/delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<script src="../assets/js/sidebar.js"></script>