<?php
include '../includes/connect.php';
require_once '../includes/header.php';

if (isset($_POST['btnRegister'])) {

    $fullname = $_POST['fullname'];

    $email = $_POST['email'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$type = $_POST['usertype'] ?? null;

    // 1. INSERT INTO user table
    $sql = "INSERT INTO user (fullname, email, password, user_type)
            VALUES ('$fullname', '$email', '$password', '$type')";

    if (mysqli_query($connection, $sql)) {

        $user_id = mysqli_insert_id($connection);

        // 2. insert into role table
        if ($type == "student") {
            mysqli_query($connection, "INSERT INTO tblstudent(user_id) VALUES('$user_id')");
        } 
        else if ($type == "faculty") {
            mysqli_query($connection, "INSERT INTO tblfaculty(user_id) VALUES('$user_id')");
        } 
        else if ($type == "staff") {
            mysqli_query($connection, "INSERT INTO tblstaff(user_id) VALUES('$user_id')");
        }

    } else {
        echo "❌ Error: " . mysqli_error($connection);
    }

    header("Location: ../auth/login.php");
    exit();
}
?>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/register.css?v=3">

<div class="container">

    <!-- LEFT MESSAGE (same as login) -->
    <div class="message_container">
        <section id="back">
            <a href="../pages/landingPage.php"> <h2 class = "icon">➜ </h2> Back to home</a>
        </section>
        <section id="title">
            <div id="iconBox">
                <img src="../assets/images/package.png" class="white-icon">
            </div>
            <div class="box">
                <h2>CITUFind</h2>
                <h3>Lost & Found System</h3>
            </div>
        </section>

        <section id="message">
            <h2>Create Account</h2>
            <h3>Join the system and help your campus recover lost items easily.</h3>
        </section>

        <section id="track">
            <div class="c_icon">
                <img src="../assets/images/package.png">
            </div>
            <div class="m_cards">
                <h3>Report Items</h3>
                <p>Submit lost or found items quickly</p>
            </div>
        </section>

        <section id="notif">
            <div class="c_icon">
                <img src="../assets/images/mail.png">
            </div>
            <div class="m_cards">
                <h3>Stay Updated</h3>
                <p>Receive updates about your reports</p>
            </div>
        </section>

    </div>

    <!-- REGISTER FORM -->
    <form id="signupForm" method="post">

        <h2 class="title">Register</h2>
        <h3 class="subtitle">Fill in your details to create an account</h3>

        <label>Fullname</label>
        <input type="text" placeholder="Fullname" name="fullname" required>

        <label>Email</label>
        <input type="text" placeholder="Email" name="email" required>

        <label>Password</label>
        <input type="password" placeholder="Password" name="password" required>

        <label>User Type</label>
        <select name="usertype">
            <option>---</option>
            <option value="student">Student</option>
            <option value="faculty">Faculty</option>
            <option value="staff">Staff</option>
        </select>

        <label class="checkbox">
            <input type="checkbox">
            <span class="checkmark"></span>
            I agree to the <span>Term of Service</span> and <span>Privacy Policy</span>
        </label>

        <button type="submit" name="btnRegister">Create Account</button>
        <div class="divider">
            <span>or sign up with</span>
        </div>
        <div class="acc_container">
            <div class="card">Google</div>
            <div class="card">GitHub</div>
        </div>
        <p>
            Already have an account?
            <a href="../auth/login.php" class="su_btn">Login</a>
        </p>
    </form>
</div>
<script src="../assets/js/signup.js?v=2"></script>
