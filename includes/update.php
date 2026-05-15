<?php
include '../includes/connect.php';

$id = $_GET['id'];

$sql = "SELECT * FROM items WHERE id='$id'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['btnUpdate'])) {    

    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $date_reported = $_POST['date_reported'];
    $status = $_POST['status'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    if (!empty($image)) {
        move_uploaded_file($tmp, "../uploads/" . $image);

        $updateQuery = "UPDATE items SET
            item_name='$item_name',
            description='$description',
            category='$category',
            location='$location',
            date_reported='$date_reported',
            status='$status',
            image='$image'
            WHERE id='$id'";
    } 
    else {
        $updateQuery = "UPDATE items SET
            item_name='$item_name',
            description='$description',
            category='$category',
            location='$location',
            date_reported='$date_reported',
            status='$status'
            WHERE id='$id'";
    }

    mysqli_query($connection, $updateQuery);
    header("Location: ../pages/viewrecords.php");
    exit();
}
?>

<?php require_once '../includes/header.php'; ?>
<link rel="stylesheet" href="../assets/css/dashboard.css?v=1">


<div id="container">
    
    <form method="POST" enctype="multipart/form-data">
        <h2>Update Item</h2>
        <label>Item Name</label><br>
        <input type="text" name="item_name" value="<?php echo $row['item_name']; ?>">
        <br>

        <label>Description</label><br>
        <textarea name="description"><?php echo $row['description']; ?></textarea>
        <br>

        <label>Category</label><br>
        <select name="category">
            <option>---</option>
            <option value="Electronics"
                <?php if($row['category'] == 'Electronics') echo 'selected'; ?>>
                Electronics
            </option>

            <option value="Wallet"
                <?php if($row['category'] == 'Wallet') echo 'selected'; ?>>
                Wallet
            </option>

            <option value="ID"
                <?php if($row['category'] == 'ID') echo 'selected'; ?>>
                ID
            </option>

            <option value="Bag"
                <?php if($row['category'] == 'Bag') echo 'selected'; ?>>
                Bag
            </option>

            <option value="Others"
                <?php if($row['category'] == 'Others') echo 'selected'; ?>>
                Others
            </option>
        </select>
        <br>

        <label>Location</label><br>
        <input type="text" name="location" value="<?php echo $row['location']; ?>">
        <br>

        <label>Date Reported</label><br>
        <input type="date" name="date_reported" value="<?php echo $row['date_reported']; ?>">
        <br>

        <label>Status</label><br>
        <select name="status">
            <option value="lost" <?php if($row['status']=='lost') echo 'selected'; ?>>Lost</option>
            <option value="found" <?php if($row['status']=='found') echo 'selected'; ?>>Found</option>
            <option value="claimed" <?php if($row['status']=='claimed') echo 'selected'; ?>>Claimed</option>
        </select>
        <br>

        <label>Image</label><br>
        <input type="file" name="image">

        <button type="submit" name="btnUpdate" class="btn">Update Item</button>

    </form>
</div>

<?php require_once '../includes/footer.php'; ?>