# 🏫 School Management Database System

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

A robust, web-based academic portal designed to streamline administrative tasks. This system was developed as a comprehensive mini-project for the CSE303 Database Management course at Independent University, Bangladesh (Summer 2026), focusing on advanced relational database design and secure web integration.

---

## 🚀 Core Features

*   **Secure Authentication:** Features encrypted administrator registration and login flows using PHP sessions and bcrypt password hashing.
*   **Dynamic Student Dashboard:** Full CRUD functionality to seamlessly enroll students, edit records, and manage data via an intuitive interface.
*   **Automated Database Triggers:**
    *   *Pre-validation:* Automatically blocks attendance entries for inactive students.
    *   *Auto-Calculation:* Dynamically recalculates a student's GPA upon modification of their marks.
    *   *Audit Logging:* Archives deleted examination records into a secure log table with exact timestamps.
*   **Fee Processing Module:** Calculates and verifies pending semester fees before updating payment statuses.

## 🛠️ Tech Stack & Database Architecture

*   **Frontend:** HTML5, CSS3 (Custom Styling)
*   **Backend:** PHP
*   **Database:** MySQL (XAMPP Environment)
*   **Architecture Details:** 
    *   Normalized up to the Third Normal Form (3NF) to eliminate data redundancy.
    *   Designed with considerations for RAID 4 Recovery mechanisms.
    *   Optimized with B-Tree and B+ Tree Hashing/Indexing for efficient data retrieval.

## 👥 Project Team

*   Sahkib Ahad Chowdhury (2310626)
*   Adiba Rahman Mim (2311124)
*   Syeda Karima Kashmin (2311971)
*   Most. Tanaka Anta Alam (2310364)
*   Naila Noushin (2221869)
*   Nabila Sharin Anonna (2221487)

> **Note:** To run this project locally, clone the repository, place it in your `htdocs` folder, and import the included `school_db.sql` file into phpMyAdmin using XAMPP.
