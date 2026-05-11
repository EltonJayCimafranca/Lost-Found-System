<?php    
include '../includes/connect.php'; 
session_start();

    if(isset($_POST['btnLogin'])){

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // FIX: search fullname OR email (better)
        $sql = "SELECT * FROM user WHERE fullname='$username' OR email='$username'";
        $result = mysqli_query($connection, $sql);

        if(mysqli_num_rows($result) == 0){
            header("location: ../auth/login.php");
        } else {

            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row['password'])){

                $_SESSION['user_id'] = $row['id'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['user_type'] = $row['user_type'];

                if($row['user_type'] == "student"){
                    header("location: ../pages/dashboard.php");
                }
                else if($row['user_type'] == "faculty"){
                    header("location: ../pages/dashboard.php");
                }
                else{
                    header("location: ../pages/dashboard.php");
                }

                exit();

            } else {
                echo "<script>alert('Incorrect password');</script>";
            }
        }
    }
?>
<?php require_once '../includes/header.php';?>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/login.css?v=4">

<div class="container">
    <div class="message_container">

        <section id="back">
            <a href="../pages/landingPage.php"> <h2 class = "icon">➜ </h2> Back to home</a>
        </section>
        <section id="title">
            <div id="iconBox"><img src="../assets/images/package.png" class="white-icon"></img></div>
            <div class="box">
                <h2>CITUFind</h2>
                <h3>Lost & Found System</h3>
            </div>
        </section>

        <section id="message">
            <h2>Welcome Back!</h2>
            <h3>Sign in to continue helping your campus community recover lost items.</h3>
        </section>

        <section id="track">
            <div class="c_icon"><img src="../assets/images/package.png" class="icon_color"></img></div>
            <div class="m_cards">
                <h3>Track Your Items</h3>
                <p>Monitor all your reported items in one place</p>
            </div>
        </section>
        <section id="notif">
            <div class="c_icon"><img src="../assets/images/mail.png" class="icon_color"></img></div>
            <div class="m_cards">
                <h3>Get Notifications</h3>
                <p>Monitor all your reported items in one place</p>
            </div>
        </section>
    </div>
    
    
    <form id="loginForm" method="post">
        <h2 class="title">Log in</h2>
        <h3 class="subtitle">Enter your credentials to continue</h3>

        <label>Email or Username</label><br>
        <input type="text" name="username" placeholder="Email or Username"><br>

        <label>Password</label><br> 
		<input type="password" name="password" placeholder="Password"><br>

        <label class="checkbox">
            <input type="checkbox">
            <span class="checkmark"></span>
            Remember me 
        </label>
       
        <button type="submit" name="btnLogin" value="Login">Login</button>
        <div class="divider">
            <span>or continue with</span>
        </div>
        <div class="acc_container">
            <div class="card">Google</div>
            <div class="card">GitHub</div>
        </div>
		<p>Don't have an account?<a href="../auth/register.php" class="su_btn"> Sign up</a></p>
    </form> 

<script src="../assets/js/login.js?v=2"></script>
