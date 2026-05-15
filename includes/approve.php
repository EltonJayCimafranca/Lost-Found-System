<?php
session_start();
include '../includes/connect.php';

$claim_id = $_GET['id'] ?? null;

if (!$claim_id) {
    die("Invalid request");
}

/* GET DATA FROM THE CLAIM_REQUEST */
$query = "SELECT * FROM claim_requests WHERE claim_id='$claim_id'";
$result = mysqli_query($connection, $query);
$claim = mysqli_fetch_assoc($result);

if (!$claim) {
    die("Claim not found");
}

$item_id = $claim['item_id'];

/* CLAIM STATUS GET UPDATED */
$update_claim = "UPDATE claim_requests SET claim_status ='Approved', date_approved=NOW() WHERE claim_id= '$claim_id'";
mysqli_query($connection, $update_claim);

/* UPDATES THE ITEM STATUS*/
$update_item = "
    UPDATE items SET status='claimed' WHERE id = '$item_id'";
mysqli_query($connection, $update_item);

/* 4. ALSO UPDATES THE STATUS HISTORY WHEN ITEMS GET UPDATED */
$insert_history = "INSERT INTO status_history (entity_type, entity_id, old_status, new_status, date_changed)
                   VALUES('Claim', '$claim_id', 'Pending', 'Approved', NOW())";
mysqli_query($connection, $insert_history);

header("Location: ../pages/claimrequest.php");
exit();
?>