<?php
session_start();

// Check if the user is logged in. If not, send them back to the login page.
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home - School Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .hero-section {
            text-align: center;
            padding: 50px 20px;
            background-color: #f4f4f9;
            margin: 20px auto;
            max-width: 900px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .hero-section h2 { color: #333; font-size: 32px; }
        .hero-section p { color: #666; font-size: 18px; margin-bottom: 20px; }
        .nav-cards { display: flex; justify-content: center; gap: 20px; margin-top: 30px; }
        .card { padding: 20px; background: #fff; border: 1px solid #ddd; border-radius: 8px; width: 200px; text-decoration: none; color: #333; font-weight: bold; transition: 0.3s; }
        .card:hover { background: #e0e0e0; }
    </style>
</head>
<body>

<!-- ================= NAVBAR ================= -->
<div class="navbar">
    <div class="logo">School Management System</div>
    <ul class="menu">
        <li style="color:white; font-weight:bold; font-size:24px;">
            <?php if(isset($_SESSION['username'])): ?>
                Hi, <?php echo $_SESSION['username']; ?>
            <?php endif; ?>
        </li>
        <li><a href="home.php">Home</a></li>
        <li><a href="dashboard.php">Students</a></li>
        <li><a href="checkout.php">Fees</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<!-- ================= HERO SECTION ================= -->
<div class="hero-section">
    <h2>Welcome to the Academic Portal</h2>
    <p>Manage student enrollments, records, and administrative tasks efficiently.</p>
    
    <!-- Campus image embedded here -->
    <img src="images/campus.jpg" alt="Campus View" style="width:100%; max-height: 400px; object-fit: cover; border-radius: 8px; margin-bottom: 20px;">

    <div class="nav-cards">
        <a href="dashboard.php" class="card">Manage Students ➔</a>
        <a href="checkout.php" class="card">Fee Checkout ➔</a>
    </div>
</div>

</body>
</html>