🎓 School Management Database System
A robust, web-based database application designed to streamline academic administrative tasks. This system was developed as a comprehensive mini-project for the CSE 303 Database Management course (Summer 2026), focusing on advanced relational database design, data integrity, and secure web integration.

🚀 Key Features
Secure User Authentication: Implements PHP sessions and password_hash() (bcrypt) to ensure safe administrator registration and login flows.

Dynamic Student Management: Provides full CRUD (Create, Read, Update, Delete) functionality to seamlessly enroll students, edit records, and manage academic data via an intuitive dashboard.

Automated Data Integrity (SQL Triggers):

Pre-validation: Blocks attendance entries for inactive students.

Auto-Calculation: Dynamically recalculates a student's GPA upon modification of their marks.

Audit Logging: Automatically archives deleted examination records into a secure log table with exact timestamps.

Advanced Database Architecture: Built using entity-relationship modeling and normalized up to the Third Normal Form (3NF) to eliminate data redundancy.

Fee Processing Module: Features a checkout interface to calculate and verify pending semester fees before updating payment statuses.

🛠️ Tech Stack
Frontend: HTML5, Custom CSS

Backend: PHP

Database: MySQL (XAMPP environment)

Database Concepts Applied: RAID 4 Recovery mechanisms, B-Tree and B+ Tree Hashing/Indexing, and Relational Mapping.

💡 About the Project
This system was designed to translate complex database theories into a functional, real-world application. From structuring the initial ER Diagram to establishing foreign key constraints and deploying backend logic, the project serves as a complete bridge between frontend interfaces and reliable backend storage.
