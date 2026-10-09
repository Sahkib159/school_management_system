Markdown
# 🏫 School Management System

> A lightweight, web-based school administration and record-keeping platform designed to streamline student admissions, academic record management, and dynamic fee processing.

[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](#)
[![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](#)
[![Apache](https://img.shields.io/badge/Server-Apache-D22128?style=for-the-badge&logo=apache&logoColor=white)](#)
[![License](https://img.shields.io/badge/License-Academic%20Use-brightgreen?style=for-the-badge)](#)

---

## 📖 Overview

The **School Management System** transitions traditional, error-prone paper registers and manual ledger records into a centralized digital portal. It provides role-authenticated access for administrative personnel to manage student profiles, monitor student records, and dynamically adjust, calculate, and persist fee breakdowns prior to checkout confirmation.

---

## ✨ Features

- **🔐 Session & Authentication Management:** Secure login and logout mechanism to protect administrative routes and maintain session integrity.
- **👨‍🎓 Student Records Dashboard:** Centralized directory interface for viewing, managing, and tracking enrolled students.
- **💳 Dynamic Fee Configuration & Checkout:**
  - Configurable fee categories including **Tuition Fee**, **Laboratory Fee**, and **Student Activity Fee**.
  - Real-time client-side total calculation via JavaScript event listeners.
  - Persistent server-side database storage to retain custom administrative fee overrides across sessions.
- **🖥️ Responsive Administrative Interface:** Clean layout powered by pure CSS with structured data tables, modern cards, and intuitive navigation.

---

## 🛠️ Technology Stack

| Layer | Technology |
| :--- | :--- |
| **Frontend** | HTML5, CSS3, Modern Vanilla JavaScript (DOM & Events) |
| **Backend** | PHP (Procedural & Object-Oriented with Prepared Statements) |
| **Database** | MySQL / MariaDB |
| **Local Environment** | XAMPP / WampServer / LAMP Stack (Apache Server) |

---

## 📂 Project Architecture

```text
school_management_system/
│
├── css/
│   └── style.css            # Global stylesheet & design rules
├── images/
│   └── lab.jpg              # Asset banners and interface media
├── db.php                   # MySQL database connector ($conn)
├── login.php                # Authentication gate & login view
├── logout.php               # Session destruction & redirect
├── home.php                 # Administrative landing dashboard
├── dashboard.php            # Student record directory & listings
├── checkout.php             # Fee checkout summary & dynamic adjustments
└── README.md                # Project documentation
🚀 Getting Started
Follow these instructions to set up and run the project locally on your machine.

1. Prerequisites
Ensure you have the following installed:

XAMPP (recommended) or any local server stack containing Apache, PHP 7.4+, and MySQL.

Git.

2. Clone the Repository
Clone the repository into your local server root directory (htdocs for XAMPP):

Bash
# Navigate to XAMPP htdocs directory
cd C:/xampp/htdocs/

# Clone this repository
git clone [https://github.com/Sahkib159/school_management_system.git](https://github.com/Sahkib159/school_management_system.git)
3. Database Setup
Start Apache and MySQL from your XAMPP Control Panel.

Open your web browser and go to: http://localhost/phpmyadmin.

Create a new database named: school_db.

Click on the SQL tab and execute the following queries:

SQL
CREATE DATABASE IF NOT EXISTS school_db;
USE school_db;

-- 1. Table for administrative users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Table for persistent dynamic fee configurations
CREATE TABLE IF NOT EXISTS fee_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fee_name VARCHAR(50) NOT NULL UNIQUE,
    amount DECIMAL(10, 2) NOT NULL
);

-- 3. Seed initial fee structure
INSERT INTO fee_settings (fee_name, amount) VALUES 
('tuition_fee', 15000.00),
('lab_fee', 2500.00),
('activity_fee', 1000.00)
ON DUPLICATE KEY UPDATE amount = VALUES(amount);
4. Verify Database Credentials
Open db.php in your code editor and verify that your local database credentials match:

PHP
<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "school_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection failed: " . $conn->connect_error);
}
?>
5. Launch the Application
Open your web browser and navigate to:

Plaintext
http://localhost/school_management_system/login.php
🔒 Security Practices
SQL Injection Prevention: Uses MySQLi parameterized prepared statements (bind_param) for data updates.

XSS Mitigation: Sanitizes dynamic outputs rendered in HTML using htmlspecialchars().

Type-Safe Parsing: Floating-point casts (floatval) applied to all numerical values submitted via checkout inputs.

Access Control: Enforces authenticated session checks ($_SESSION['user_id']) before displaying protected admin pages.

👥 Authors & Academic Context
Course Context: System Analysis and Design (CSE307)

Author: Sahkib Ahad Chowdhury

Institution: Independent University, Bangladesh (IUB)