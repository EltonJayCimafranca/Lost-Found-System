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

<link rel="stylesheet" href="../assets/css/sidebar.css?v=7">
<link rel="stylesheet" href="../assets/css/dashboard.css?v=1">
<link rel="stylesheet" href="../assets/css/request.css?v=5">
<div class="layout">

    <!-- SIDEBAR-->
     <?php include '../includes/sidebar.php'?>
    <div class="right">
        <!-- HEADER -->
        <?php include '../includes/dashboardheader.php'; ?>

        <!-- CONTENT -->
        <main class="main-content">
            <!--CLAIM ITEM-->
            
            <?php if ($item): ?>
                <h2>Claim Item</h2>
                <h3><?php echo $item['item_name']; ?></h3>

                <div class="claim-form-card">
                    <form method="POST">
                        <label>Proof Description</label>
                        <textarea name="proof_description" placeholder="Describe your proof..." required></textarea>

                        <button type="submit" name="btnClaim" class="btn-primary">
                            Submit Claim
                        </button>
                    </form>
                </div>
            <?php endif; ?>

            <?php
            if (isset($_POST['btnClaim'])) {
                $user_id = $_SESSION['user_id'];
                $proof = $_POST['proof_description'];

                $insert = "INSERT INTO claim_requests
                (item_id, user_id, proof_description, claim_status)
                VALUES
                ('$item_id', '$user_id', '$proof', 'Pending')";

                mysqli_query($connection, $insert);

                header("Location: ../pages/claimhistory.php");
                exit();
            }
            ?>
            <!--CLAIM REQUEST-->
            <?php
            if (!$item) {

                $query = "
                    SELECT cr.*, i.item_name
                    FROM claim_requests cr
                    JOIN items i ON cr.item_id = i.id
                    ORDER BY cr.date_requested DESC
                ";

                $result = mysqli_query($connection, $query);
            ?>
            <h2>Claim Requests</h2>

            <?php while($row = mysqli_fetch_assoc($result)) : ?>

                <div class="claim-card">

                    <h3><?php echo $row['item_name']; ?></h3>

                    <p>
                        Description: 
                        <?php echo $row['proof_description']; ?></p>

                    <?php
                        $status = strtolower($row['claim_status']);
                        ?>

                        <p>
                            Status:
                            <span class="status <?php echo $status; ?>">
                                <?php echo $row['claim_status']; ?>
                            </span>
                        </p>
                    <p>Date: <?php echo $row['date_requested']; ?></p>

                    <?php if($row['claim_status'] == "Pending") { ?>
                        <div class="action-buttons">
                            <a class="btn-approve" href="../includes/approve.php?id=<?php echo $row['claim_id']; ?>">Approve</a>
                            <a class="btn-reject" href="../includes/reject.php?id=<?php echo $row['claim_id']; ?>">Reject</a>
                        </div>
                    <?php } ?>  

                </div>

            <?php endwhile; ?>

            <?php } ?>
        </main>
    </div>
</div>        
