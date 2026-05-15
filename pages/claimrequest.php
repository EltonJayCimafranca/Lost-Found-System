<?php
    session_start();
    include '../includes/connect.php';

    $item = null;
    if (isset($_GET['id'])) {
        $item_id = $_GET['id'];
        $query = "SELECT * FROM items WHERE id='$item_id'";
        $result = mysqli_query($connection, $query);
        $item = mysqli_fetch_assoc($result);
    }
?>

<link rel="stylesheet" href="../assets/css/sidebar.css?v=9">
<link rel="stylesheet" href="../assets/css/dashboard.css?v=8">
<link rel="stylesheet" href="../assets/css/table.css?v=2"> <!-- For status colors -->
<link rel="stylesheet" href="../assets/css/request.css?v=10">

<div class="layout">
    <!-- SIDEBAR -->
    <?php include '../includes/sidebar.php'?>

    <div class="right">
        <!-- HEADER -->
        <?php include '../includes/dashboardheader.php'; ?>

        <main class="main-content">
            
            <?php if ($item): ?>
                <!-- FORM SECTION: WHEN CLAIMING AN ITEM -->
                <div class="filter_container">
                    <h2>CLAIM ITEM</h2>
                </div>

                <div class="content-wrapper">
                    <div class="claim-form-card">
                        <div class="card-header">
                            <h3><?php echo ucfirst($item['item_name']); ?></h3>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <label>Proof Description</label>
                                <textarea name="proof_description" placeholder="Describe unique features or proof of ownership..." required></textarea>
                                <button type="submit" name="btnClaim" class="btn-primary-gradient">Submit Claim</button>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($_POST['btnClaim'])) {
                    $user_id = $_SESSION['user_id'];
                    $proof = mysqli_real_escape_string($connection, $_POST['proof_description']);
                    $insert = "INSERT INTO claim_requests (item_id, user_id, proof_description, claim_status) VALUES ('$item_id', '$user_id', '$proof', 'Pending')";
                    mysqli_query($connection, $insert);
                    echo "<script>window.location.href='../pages/claimhistory.php';</script>";
                    exit();
                }
                ?>

            <?php else: ?>
                <!-- LIST SECTION: MANAGEMENT VIEW (CARDS) -->
                <div class="filter_container">
                    <h2>CLAIM REQUESTS MANAGEMENT</h2>
                </div>

                <div class="history-grid-wrapper">
                    <div class="history-container">
                        <?php
                        $query = "
                            SELECT cr.claim_id, 
                                   u.fullname, 
                                   i.item_name, 
                                   cr.proof_description, 
                                   cr.claim_status, 
                                   cr.date_requested
                            FROM claim_requests cr
                            INNER JOIN user u ON cr.user_id = u.id
                            INNER JOIN items i ON cr.item_id = i.id;
                        ";
                        $result = mysqli_query($connection, $query);
                        
                        while($row = mysqli_fetch_assoc($result)) : 
                            $status = strtolower($row['claim_status']);
                        ?>
                            <div class="history-card">
                                <div class="card-header">
                                    <h3><?php echo $row['item_name']; ?></h3>
                                    <span class="status <?php echo $status; ?>">
                                        <?php echo ucfirst($row['claim_status']); ?>
                                    </span>
                                </div>

                                <div class="card-body">
                                    <div class="info-row">
                                        <span class="label">Claimant:</span>
                                        <span class="value"><?php echo $row['fullname']; ?></span>
                                    </div>
                                    <div class="info-row description-row">
                                        <span class="label">Proof:</span>
                                        <p class="desc-text"><?php echo $row['proof_description']; ?></p>
                                    </div>
                                    <div class="info-row">
                                        <span class="label">Date:</span>
                                        <span class="value"><?php echo date('M d, Y', strtotime($row['date_requested'])); ?></span>
                                    </div>

                                    <?php if($row['claim_status'] == "Pending") : ?>
                                        <div class="action-buttons">
                                            <a class="btn-action btn-approve" href="../includes/approve.php?id=<?php echo $row['claim_id']; ?>">Approve</a>
                                            <a class="btn-action btn-reject" href="../includes/reject.php?id=<?php echo $row['claim_id']; ?>">Reject</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>        
<script src="../assets/js/sidebar.js"></script>