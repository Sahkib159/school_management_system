<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$message = "";

// Check if admin submitted updated fees
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_fees'])) {
    $tuition = floatval($_POST['tuition_fee']);
    $lab = floatval($_POST['lab_fee']);
    $activity = floatval($_POST['activity_fee']);

    // Update fees in database
    $stmt1 = $conn->prepare("UPDATE fee_settings SET amount = ? WHERE fee_name = 'tuition_fee'");
    $stmt1->bind_param("d", $tuition);
    $stmt1->execute();

    $stmt2 = $conn->prepare("UPDATE fee_settings SET amount = ? WHERE fee_name = 'lab_fee'");
    $stmt2->bind_param("d", $lab);
    $stmt2->execute();

    $stmt3 = $conn->prepare("UPDATE fee_settings SET amount = ? WHERE fee_name = 'activity_fee'");
    $stmt3->bind_param("d", $activity);
    $stmt3->execute();

    $message = "Fee values updated and saved successfully!";
}

// Fetch current fee rates from database
$fees = [];
$result = $conn->query("SELECT fee_name, amount FROM fee_settings");
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        $fees[$row['fee_name']] = $row['amount'];
    }
}

// Fallback defaults if table was empty
$tuition_val = isset($fees['tuition_fee']) ? $fees['tuition_fee'] : 15000;
$lab_val = isset($fees['lab_fee']) ? $fees['lab_fee'] : 2500;
$activity_val = isset($fees['activity_fee']) ? $fees['activity_fee'] : 1000;
$grand_total = $tuition_val + $lab_val + $activity_val;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fee Checkout - School Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .checkout-container { max-width: 600px; margin: 40px auto; padding: 30px; background: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .checkout-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .checkout-table th, .checkout-table td { border-bottom: 1px solid #ddd; padding: 12px 10px; text-align: left; }
        .total-row { font-weight: bold; font-size: 18px; }
        .lab-image { width: 100%; max-height: 250px; object-fit: cover; border-radius: 8px; margin-bottom: 20px; }
        .fee-input {
            width: 130px;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 15px;
        }
        .fee-input:focus {
            outline: none;
            border-color: #007bff;
        }
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 24px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .alert-success {
            padding: 10px 15px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 4px;
            margin-bottom: 15px;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>

<!-- ================= NAVBAR ================= -->
<div class="navbar">
    <div class="logo">School Management System</div>
    <ul class="menu">
        <li style="color:white; font-weight:bold; font-size:24px;">
            <?php if(isset($_SESSION['username'])): ?>
                Hi, <?php echo htmlspecialchars($_SESSION['username']); ?>
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
    <p>Admin Mode: Modify breakdown amounts if necessary. Changes are saved automatically when confirmed.</p>

    <?php if(!empty($message)): ?>
        <div class="alert-success"><?php echo $message; ?></div>
    <?php endif; ?>

    <!-- Lab image embedded here -->
    <img src="images/lab.jpg" alt="Engineering Laboratory" class="lab-image">

    <form method="POST" action="checkout.php">
        <table class="checkout-table">
            <tr>
                <th>Fee Type</th>
                <th>Amount (BDT)</th>
            </tr>
            <tr>
                <td>Tuition Fee</td>
                <td>
                    <input type="number" name="tuition_fee" class="fee-input" value="<?php echo htmlspecialchars($tuition_val); ?>" min="0" step="100" required>
                </td>
            </tr>
            <tr>
                <td>Lab Fee</td>
                <td>
                    <input type="number" name="lab_fee" class="fee-input" value="<?php echo htmlspecialchars($lab_val); ?>" min="0" step="50" required>
                </td>
            </tr>
            <tr>
                <td>Student Activity Fee</td>
                <td>
                    <input type="number" name="activity_fee" class="fee-input" value="<?php echo htmlspecialchars($activity_val); ?>" min="0" step="50" required>
                </td>
            </tr>
            <tr class="total-row">
                <td>Grand Total</td>
                <td><span id="grandTotal"><?php echo number_format($grand_total, 2); ?></span> BDT</td>
            </tr>
        </table>

        <div style="text-align: center;">
            <button type="submit" name="save_fees" class="btn">Save & Confirm Fee</button>
        </div>
    </form>
</div>

<script>
    const feeInputs = document.querySelectorAll('.fee-input');
    const grandTotalSpan = document.getElementById('grandTotal');

    function calculateTotal() {
        let total = 0;
        feeInputs.forEach(input => {
            const val = parseFloat(input.value) || 0;
            total += val;
        });
        grandTotalSpan.innerText = total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    feeInputs.forEach(input => {
        input.addEventListener('input', calculateTotal);
    });
</script>

</body>
</html>