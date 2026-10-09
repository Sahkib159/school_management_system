# School Management System

A PHP and MySQL web application for managing student records and reviewing school fee settings. The project was created as an academic system-analysis-and-design project.

## Features

- Register and sign in to an account.
- View the academic portal after signing in.
- Add, view, edit, and delete student records.
- Review tuition, laboratory, and student activity fees, change the amounts, and see the total update in the browser.
- Save fee settings to the database.

## Built with

- PHP
- MySQL or MariaDB
- HTML, CSS, and vanilla JavaScript
- Apache (XAMPP is suitable for local development)

## Requirements

- PHP 7.4 or newer with the `mysqli` extension enabled
- MySQL or MariaDB
- Apache or another PHP-capable web server
- Git (to clone the repository)

## Run locally with XAMPP

1. Start **Apache** and **MySQL** from the XAMPP Control Panel.
2. Clone this repository into XAMPP's `htdocs` folder:

   ```powershell
   cd C:\xampp\htdocs
   git clone https://github.com/Sahkib159/school_management_system.git
   ```

3. Create and populate the database:
   - Open [phpMyAdmin](http://localhost/phpmyadmin).
   - Create a database named `school_db`, or use the database creation statement in the SQL file.
   - Select `school_db`, choose **Import**, and import [`school_db.sql`](./school_db.sql).

4. Add the role and fee-settings schema used by the registration and fee pages. In phpMyAdmin, open the database's **SQL** tab and run:

   ```sql
   USE school_db;

   ALTER TABLE users
       ADD COLUMN role VARCHAR(20) NOT NULL DEFAULT 'Teacher';

   CREATE TABLE IF NOT EXISTS fee_settings (
       id INT AUTO_INCREMENT PRIMARY KEY,
       fee_name VARCHAR(50) NOT NULL UNIQUE,
       amount DECIMAL(10, 2) NOT NULL
   );

   INSERT INTO fee_settings (fee_name, amount) VALUES
       ('tuition_fee', 15000.00),
       ('lab_fee', 2500.00),
       ('activity_fee', 1000.00)
   ON DUPLICATE KEY UPDATE amount = VALUES(amount);
   ```

   These are one-time setup steps for a fresh import. If `users.role` already exists, omit the `ALTER TABLE` statement.

5. Check the connection settings in [`db.php`](./db.php). The defaults expect a local MySQL server at `localhost`, user `root`, an empty password, and database `school_db`. Update these values if your local MySQL configuration differs.
6. Open [http://localhost/school_management_system/register.php](http://localhost/school_management_system/register.php), create an account, and choose **Administrator** if you want to use the fee-settings page.
7. Sign in at [http://localhost/school_management_system/login.php](http://localhost/school_management_system/login.php).

## Project structure

```text
school_management_system/
├── CSS/
│   ├── loginstyle.css
│   ├── registerstyle.css
│   └── style.css
├── images/
│   ├── Campus.jpeg
│   ├── lab.jpg
│   └── library.jpg
├── checkout.php        # Fee summary and fee-setting updates
├── dashboard.php       # Student list and student creation/deletion
├── db.php              # MySQL connection
├── delete_student.php  # Student deletion endpoint
├── edit_student.php    # Student record editing
├── home.php            # Signed-in landing page
├── login.php           # Sign-in
├── logout.php          # Sign-out
├── register.php        # Account registration
└── school_db.sql       # Initial database schema
```

## Notes

- Import `school_db.sql` into a **fresh** database. The extra SQL above adds schema required by the current application but not included in that file yet.
- This project is an academic prototype, not production-ready software. Do not expose it to the public internet or use it to store real student or account data without a security review and appropriate hardening.
- The source references some CSS and image paths with different letter casing from the corresponding repository names. Windows XAMPP generally tolerates this; case-sensitive hosts (such as many Linux servers) may not. Check and make those paths consistent before deploying there.
- No open-source license is currently included. Add a license file if you intend to grant reuse or distribution permissions.

## Author

**Sahkib Ahad Chowdhury**

System Analysis and Design (CSE307)

Independent University, Bangladesh (IUB)
