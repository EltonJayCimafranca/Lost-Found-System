
<?php
    include '../includes/connect.php';

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        //NEXT
        $sql = "DELETE FROM items WHERE id = '$id'";

        if(mysqli_query($connection, $sql)) {
            header("location: ../pages/viewrecords.php");
            exit();
        }
        else {
            echo "Error in deleting the record", mysqli_error($connection);
        }
    }
?>
