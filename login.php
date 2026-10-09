<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)==1){

        $user = mysqli_fetch_assoc($result);

        if(password_verify($password,$user['password'])){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            // Capture the role from the database and save it to the session
            $_SESSION['role'] = $user['role']; 

            // Redirects to home.php
            header("Location: home.php");
            exit();
        }
    }

    $error = "Invalid email or password!";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login - School Management System</title>

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/loginstyle.css">
</head>

<body>

<!-- TOP HEADER -->
<div class="top-bar">
    <h1>School Management System</h1>
</div>

<!-- LOGIN CENTER -->
<div class="login-container">

    <div class="login-box">

        <h2>Sign in to your account</h2>
        <p>Please enter your email and password to log in.</p>

        <?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

        <form method="POST">

            <input type="email" name="email" placeholder="Enter your email:" required>

            <div>
                <input type="password" name="password" placeholder="Password" required>
                <a class="forgot" href="#">I forgot my password</a>
            </div>

            <button type="submit" name="login">Login ➜</button>

    <p style="text-align:center; margin-top:15px;">
         Don't have an account? 
        <a href="register.php">Register</a>
    </p>

        </form>

    </div>

</div>

</body>
</html>