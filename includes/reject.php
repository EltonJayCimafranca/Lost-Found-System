<?php
include '../includes/connect.php';

$claim_id = $_GET['id'] ?? null;

if(!$claim_id) {
    die("Invalid Report");
}

mysqli_query($connection, "
    UPDATE claim_requests 
    SET claim_status='Rejected'
    WHERE claim_id='$claim_id'
");

/* 4. (OPTIONAL) status history */
mysqli_query($connection, 
$insert_history = "
    INSERT INTO status_history 
    (entity_type, entity_id, old_status, new_status, date_changed)
    VALUES
    ('Claim', '$claim_id', 'Pending', 'Rejected', NOW())
");

header("Location: ../pages/claimrequest.php");
exit();
?>