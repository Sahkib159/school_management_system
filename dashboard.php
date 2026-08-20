<?php
session_start();
include 'db.php';

// Check if user is logged in
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

/* =======================
   ADD NEW STUDENT (CREATE)
======================= */
if(isset($_POST['add_student'])){
    $student_id = $_POST['student_id'];
    $full_name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $class_id = $_POST['class_id'];

    $sql = "INSERT INTO students (student_id, full_name, gender, class_id) 
            VALUES ('$student_id', '$full_name', '$gender', '$class_id')";
    
    if(mysqli_query($conn, $sql)){
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Error adding student: " . mysqli_error($conn);
    }
}

/* =======================
   DELETE STUDENT (DELETE)
======================= */
if(isset($_GET['delete'])){
    $del_id = $_GET['delete'];
    
    $sql = "DELETE FROM students WHERE student_id = '$del_id'";
    mysqli_query($conn, $sql);
    
    header("Location: dashboard.php");
    exit();
}

/* =======================
   FETCH STUDENTS (READ)
======================= */
$result = mysqli_query($conn, "SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - School Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .admin-container { max-width: 900px; margin: 40px auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        .form-group input, .form-group select { width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; }
        .action-btn { padding: 5px 10px; color: white; text-decoration: none; border-radius: 4px; margin-right: 5px; }
        .edit-btn { background-color: #4CAF50; }
        .del-btn { background-color: #f44336; }
    </style>
</head>

<body>

<!-- ================= NAVBAR ================= -->
<div class="navbar">
    <div class="logo">School Management System</div>

    <!-- CHANGED: Updated the menu so it includes Home, Students, Fees, and Logout -->
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

<h1 class="page-title">Student Management</h1>

<div class="admin-container">
    
    <!-- ================= ADD STUDENT FORM ================= -->
    <h2 class="cart-title">Add New Student</h2>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    
    <form method="POST" style="margin-bottom: 40px;">
        <div class="form-group">
            <input type="text" name="student_id" placeholder="Student ID (e.g., S001)" required>
        </div>
        <div class="form-group">
            <input type="text" name="full_name" placeholder="Full Name" required>
        </div>
        <div class="form-group">
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="form-group">
            <input type="number" name="class_id" placeholder="Class ID (e.g., 10)" required>
        </div>
        <button class="btn" type="submit" name="add_student">Add Student</button>
    </form>

    <!-- ================= STUDENT RECORDS TABLE ================= -->
    <h2 class="cart-title">Enrolled Students</h2>

    <table class="cart-table" style="width: 100%; text-align: left;">
        <tr>
            <th>Student ID</th>
            <th>Full Name</th>
            <th>Gender</th>
            <th>Class ID</th>
            <th>Actions</th>
        </tr>

        <?php 
        if(mysqli_num_rows($result) > 0):
            while($row = mysqli_fetch_assoc($result)): 
        ?>
        <tr>
            <td><?php echo $row['student_id']; ?></td>
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['gender']; ?></td>
            <td><?php echo $row['class_id']; ?></td>
            <td>
                <a href="edit_student.php?id=<?php echo $row['student_id']; ?>" class="action-btn edit-btn">Edit</a>
                <a href="dashboard.php?delete=<?php echo $row['student_id']; ?>" class="action-btn del-btn" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
            </td>
        </tr>
        <?php 
            endwhile; 
        else: 
        ?>
        <tr>
            <td colspan="5" style="text-align: center;">No students found in the database.</td>
        </tr>
        <?php endif; ?>

    </table>

</div>

<!-- ================= FOOTER ================= -->
<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-left">
            <h3></h3>
            <p></p>
            <p></p>
        </div>
        <div class="footer-right">
            <h3></h3>
        </div>
    </div>
</footer>

</body>
</html>