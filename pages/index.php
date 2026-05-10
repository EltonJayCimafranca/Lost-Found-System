<?php    
    include '../includes/connect.php';
    //include 'readrecords.php';   
    require_once '../includes/header.php'; 
?>
  
<link rel="stylesheet" href="../assets/css/dashboard.css?v=4">
<div id="container">
    <form action="../includes/create.php" method="POST" enctype="multipart/form-data">
        <h2>Report Item</h2>

        <label>Item Name <span>*</span></label><br>
        <input type="text" name="item_name" placeholder="Item Name" required><br>

        <label>Description <span>*</span></label><br>
        <textarea name="description" placeholder="Description" required></textarea><br>
        
        <label>Category <span>*</span></label><br>
        <select name="category" required>
            <option class="blank" value="" disabled selected>---</option>
            <option value="Electronics">Electronics</option>
            <option value="Wallet">Wallet</option>
            <option value="ID">ID</option>
            <option value="Bag">Bag</option>
            <option value="Others">Others</option>
        </select><br>
        
        <label>Location <span>*</span></label><br>
        <input type="text" name="location" placeholder="Enter location" required><br>

        <label>Date<span>*</span></label><br>
        <input type="date" name="date_reported" required><br>

        <label>Status <span>*</span></label><br>
        <select name="status" required>
            <option class="blank" value="" disabled selected>---</option>
            <option value="lost">Lost</option>
            <option value="found">Found</option>
            <option value="claimed">Claimed</option>
        </select><br>

        <label>Item Image</label><br>
        <input type="file" name="image"><br>

        <button type="submit" name="btnSubmit" class="btn">
            Submit
        </button>
    </form>
</div>


<?php require_once '../includes/footer.php'; ?>