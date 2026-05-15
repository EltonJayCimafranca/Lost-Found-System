<?php
    session_start();
    include '../includes/connect.php';

    $query = "SELECT * FROM items ORDER BY id DESC";
    $result = mysqli_query($connection, $query);
?>
 <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/sidebar.css?v=9">
<link rel="stylesheet" href="../assets/css/dashboard.css?v=6">
<div class="layout">

    <!-- SIDEBAR-->
     <?php include '../includes/sidebar.php'?>
    <div class="right">
        <!-- HEADER -->
        <?php include '../includes/dashboardheader.php'; ?>

        <!-- CONTENT -->
        <main class="main-content">
            <h1>
                Welcome back, 
                <span class="user">
                <?php 
                    echo isset($_SESSION['fullname']) 
                    ? explode(' ', $_SESSION['fullname'])[0] 
                    : 'User'; 
                ?>!</span>
            </h1>
            <p>Here's what's happening with your items today</p>

            <div id="option_bar">
                <div class="search_container">
                    <img src="../assets/images/search.png" class="search_icon">
                    <input type="text" placeholder="Search for lost or found items..." class="search_input" >
                </div>
                <div id="right_side">
                    <div id="filter">
                        <img src="../assets/images/filter.png" class="filter_icon">
                        Filter
                    </div>
                    <a href="../pages/index.php" id="report_bar">+ Report Item</a>
                </div>
            </div>

                <h2>Recent Lost Items</h2>
                <div class="items-container">
                <?php 
                    $lostQuery = "SELECT * FROM items WHERE status ='lost' ORDER BY id DESC";
                    $lostResult = mysqli_query($connection, $lostQuery);

                    while($row = mysqli_fetch_assoc($lostResult)) :
                ?>

                    <div class="item-card">
                        <div class="img_container">
                            <?php if (!empty($row['image'])): ?>
                                <img src="../uploads/<?php echo $row['image']; ?>" class="img_display">
                            <?php else: ?>
                                <img src="../assets/images/no_image.jpg" class="img_display">
                            <?php endif; ?>
                        </div>

                        <div class="card-content">
                            <div class = "item-name_container">
                                <h3 class="item_name"><?php echo ucfirst($row['item_name']); ?></h3>
                                <div class="status"> <?php echo ucfirst($row['status']); ?></div>
                            </div>

                            <p class="description"> <?php echo $row['description']; ?></p>

                            <p class="card_details"><img src="../assets/images/date.png" class="card_icon"> 
                                <span class="text"><?php echo $row['date_reported']; ?></span>
                            </p>
                            <p class="card_details"><img src="../assets/images/pin.png" class="card_icon"> 
                                <span><?php echo $row['location']; ?></span>
                            </p>

                            <a href="../pages/viewrecords.php?id=<?php echo $row['id']; ?>" class="view_btn">
                                View Details
                            </a>
                        </div>

                    </div>

                <?php endwhile; ?>

                </div>



                <!-- FOUND ITEMS -->
                <h2>Recent Found Items</h2>

                <div class="items-container">

                <?php 
                    $foundQuery = "SELECT * FROM items WHERE status='found' ORDER BY id DESC";
                    $foundResult = mysqli_query($connection, $foundQuery);

                    while($row = mysqli_fetch_assoc($foundResult)) :
                ?>

                    <div class="item-card">
                        <div class="img_container">
                            <?php if (!empty($row['image'])): ?>
                                <img src="../uploads/<?php echo $row['image']; ?>" class="img_display">
                            <?php else: ?>
                                <img src="../assets/images/no_image.jpg" class="img_display">
                            <?php endif; ?>
                        </div>
                                
                        <div class="card-content">
                            <div class ="item-name_container">
                                <h3 class="item_name"><?php echo ucfirst($row['item_name']); ?></h3>
                                <div class="claim_status">
                                    <?php 
                                        $status = strtolower($row['status']);
                                        if ($status == "claimed") {
                                            echo "Pending";
                                        } elseif ($status == "found") {
                                            echo "Unclaimed";
                                        } else {
                                            echo ucfirst($status);
                                        }
                                    ?>
                                </div>
                            </div>

                            <p class="description"> <?php echo $row['description']; ?></p>


                            <p class="card_details"><img src="../assets/images/date.png" class="card_icon"> 
                                <span class="text"><?php echo $row['date_reported']; ?></span>
                            </p>
                            <p class="card_details"><img src="../assets/images/pin.png" class="card_icon"> 
                                <span><?php echo $row['location']; ?></span>
                            </p>
                            <a href="../pages/claimrequest.php?id=<?php echo $row['id']; ?>" class="claim_btn">
                                Claim Item
                            </a>
                        </div>
                    </div>

                <?php endwhile; ?>

                </div>    
        </main>
    </div>
</div>

<script src="../assets/js/sidebar.js"></script>