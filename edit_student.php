<?php
session_start();
include 'db.php';

// Secure the page
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

// 1. Fetch existing student data based on the ID in the URL
if(isset($_GET['id'])){
    $edit_id = $_GET['id'];
    $fetch_sql = "SELECT * FROM students WHERE student_id = '$edit_id'";
    $result = mysqli_query($conn, $fetch_sql);
    
    // If the student exists, store their data in an array
    if(mysqli_num_rows($result) > 0){
        $student = mysqli_fetch_assoc($result);
    } else {
        header("Location: dashboard.php");
        exit();
    }
}

// 2. Handle the form submission to update the record
if(isset($_POST['update_student'])){
    $student_id = $_POST['student_id'];
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $class_id = $_POST['class_id'];

    // Update query
    $update_sql = "UPDATE students 
                   SET full_name = '$full_name', gender = '$gender', class_id = '$class_id' 
                   WHERE student_id = '$student_id'";
    
    if(mysqli_query($conn, $update_sql)){
        // Redirect back to dashboard upon success
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Error updating student: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student - School Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .admin-container { 
            max-width: 600px; 
            margin: 40px auto; 
            padding: 20px; 
            background: #fff; 
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
        }
        .form-group { margin-bottom: 15px; }
        .form-group input, .form-group select { 
            width: 100%; 
            padding: 10px; 
            margin-top: 5px; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
        }
    </style>
</head>

<body>

<!-- ================= NAVBAR ================= -->
<div class="navbar">
    <div class="logo">School Management System</div>
    <ul class="menu">
        <li><a href="home.php">Home</a></li>
        <li><a href="dashboard.php">Students</a></li>
        <li><a href="checkout.php">Fees</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<h1 class="page-title">Edit Student Record</h1>

<div class="admin-container">
    
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    
    <!-- ================= EDIT STUDENT FORM ================= -->
    <form method="POST">
        
        <div class="form-group">
            <label>Student ID (Cannot be changed)</label>
            <!-- Made readonly because changing the primary key can break relationships -->
            <input type="text" name="student_id" value="<?php echo $student['student_id']; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="full_name" value="<?php echo $student['full_name']; ?>" required>
        </div>

        <div class="form-group">
            <label>Gender</label>
            <select name="gender" required>
                <option value="Male" <?php if($student['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if($student['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                <option value="Other" <?php if($student['gender'] == 'Other') echo 'selected'; ?>>Other</option>
            </select>
        </div>

        <div class="form-group">
            <label>Class ID</label>
            <input type="number" name="class_id" value="<?php echo $student['class_id']; ?>" required>
        </div>

        <button class="btn" type="submit" name="update_student" style="width: 100%; margin-top: 10px;">Update Student</button>
        <div style="text-align: center; margin-top: 15px;">
            <a href="dashboard.php" style="color: #666; text-decoration: none;">Cancel and return to Dashboard</a>
        </div>
    </form>

</div>

</body>
</html>