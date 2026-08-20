<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fee Checkout - School Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .checkout-container { max-width: 600px; margin: 40px auto; padding: 30px; background: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .checkout-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .checkout-table th, .checkout-table td { border-bottom: 1px solid #ddd; padding: 10px; text-align: left; }
        .total-row { font-weight: bold; font-size: 18px; }
        /* Styling for the lab image */
        .lab-image { width: 100%; max-height: 250px; object-fit: cover; border-radius: 8px; margin-bottom: 20px; }
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

<div class="checkout-container">
    <h2 class="cart-title">Fee Checkout Summary</h2>
    <p>Verify the fee breakdown below before recording the student's payment.</p>

    <!-- Lab image embedded here -->
    <img src="images/lab.jpg" alt="Engineering Laboratory" class="lab-image">

    <table class="checkout-table">
        <tr>
            <th>Fee Type</th>
            <th>Amount (BDT)</th>
        </tr>
        <tr>
            <td>Tuition Fee</td>
            <td>15,000</td>
        </tr>
        <tr>
            <td>Lab Fee</td>
            <td>2,500</td>
        </tr>
        <tr>
            <td>Student Activity Fee</td>
            <td>1,000</td>
        </tr>
        <tr class="total-row">
            <td>Grand Total</td>
            <td>18,500</td>
        </tr>
    </table>

    <div style="text-align: center;">
        <button class="btn" onclick="alert('Payment Gateway Integration Pending. This is a mock checkout.')">Confirm Payment</button>
    </div>
</div>

</body>
</html>