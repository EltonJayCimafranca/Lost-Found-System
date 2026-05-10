<?php
include '../includes/connect.php';

session_start();

if(isset($_POST['btnSubmit'])) {

    $user_id = $_SESSION['user_id'];

    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $date_reported = $_POST['date_reported'];
    $status = $_POST['status'];

    // image upload 
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    if (!empty($image)) {
        move_uploaded_file($tmp, "../uploads/" . $image);
    }

    $sql = "INSERT INTO items(
                user_id,
                item_name,
                description,
                category,
                location,
                date_reported,
                status,
                image
            )
            VALUES(
                '$user_id',
                '$item_name',
                '$description',
                '$category',
                '$location',
                '$date_reported',
                '$status',
                '$image'
            )";

    mysqli_query($connection, $sql);

    header("location: ../pages/dashboard.php");
    exit();
}
?>