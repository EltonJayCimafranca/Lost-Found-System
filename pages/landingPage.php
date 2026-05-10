

<?php 
    session_start();
?>


<!DOCTYPE html>
<html>
    
<head>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/landingPage.css?v=3">
    <title>Landing Page</title>
</head>


<body>
     <?php include '../includes/header.php'; ?>

    <div class="content">
        <div class="badge">24/7 Item Recovery</div>

        <h1>Never Lose Your</h1>
        <h1 class="coloredText">Belonging Again</h1>
        <h2>The smartest way to recover lost items on campus. Connect 
            with fellow students and staff to reunite with your belongings quickly and securely.</h2>
        <a href="../auth/login.php" class="btn">Get Started</a>
    </div>
    
    <?php include '../includes/footer.php'; ?>
</body>
</html>