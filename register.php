<?php
include 'db.php';

if(isset($_POST['register'])){

    // Adjusted to capture 'username' instead of 'fullname' to match the database table
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // Capture the newly added role from the form
    $role = $_POST['role']; 

    // Updated SQL query to include the role column
    $sql = "INSERT INTO users(username,email,password,role)
            VALUES('$username','$email','$password','$role')";

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

            <!-- New Role Dropdown -->
            <select name="role" required>
                <option value="" disabled selected>Select Role</option>
                <option value="Admin">Administrator</option>
                <option value="Teacher">Teacher</option>
            </select>

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