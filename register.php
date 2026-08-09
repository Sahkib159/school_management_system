<?php
include 'db.php';

if(isset($_POST['register'])){

    // Adjusted to capture 'username' instead of 'fullname' to match the database table
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(username,email,password)
            VALUES('$username','$email','$password')";

    if(mysqli_query($conn,$sql)){
        header("Location: login.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register - School Management System</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/registerstyle.css">
</head>
<body>

<!-- Top Bar -->
<div class="top-bar">
    <h1>School Management System</h1>
</div>

<!-- Center Card -->
<div class="auth-container">
    <div class="auth-box">
        <h2>Create your account</h2>
        <p>Please fill in the details to register</p>

        <form method="POST">
            <!-- Updated input name to username -->
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" name="register">Register →</button>
        </form>

        <p class="bottom-text">
            Already have an account?
            <a href="login.php">Login</a>
        </p>
    </div>
</div>

</body>
</html>