<?php    
include '../includes/connect.php';

$resultset = mysqli_query($connection, "SELECT * FROM items");
?>

<link rel="stylesheet" href="../assets/css/dashboard.css?v=3">
<link rel="stylesheet" href="../assets/css/viewrecords.css?v=5">

<div class="layout">
    <!-- SIDEBAR -->
    <?php include '../includes/sidebar.php'; ?>

    <!-- RIGHT SIDE -->
    <div class="right">
        <!-- HEADER -->
        <?php include '../includes/dashboardheader.php'; ?>

        <!-- CONTENT -->
        <main class="main-content">
            <div class="container">
                <h2>LOST & FOUND ITEMS</h2>
                <table class="item-table">
                    <thead>
                        <tr class="content">
                            <th>ID</th>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($resultset)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['item_name']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td><?php echo $row['date_reported']; ?></td>

                            <td>
                                <span class="status <?php echo $row['status']; ?>">
                                    <?php echo ucfirst($row['status']); ?>
                                </span>
                            </td>

                            <td>
                                <img src="../uploads/<?php echo $row['image']; ?>" class="img-preview">
                            </td>   

                            <td class="actions">
                                <a class="btn-update" href="../includes/update.php?id=<?php echo $row['id']; ?>">Update</a>
                                <a class="btn-delete" href="../includes/delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="reportBtn">
                    <a href="../pages/index.php" class="btn">+ Report new item</a>
                </div>  
            </div>
        </main>
    </div>
</div>



<script src="../assets/js/sidebar.js"></script>