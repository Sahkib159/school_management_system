-- Database Configuration for School Management System
-- --------------------------------------------------------

-- Create the database if it doesn't already exist
CREATE DATABASE IF NOT EXISTS school_db;
USE school_db;

-- --------------------------------------------------------

-- Table structure for table `users`
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL
);

-- --------------------------------------------------------

-- Table structure for table `students`
CREATE TABLE `students` (
  `student_id` VARCHAR(20) PRIMARY KEY,
  `full_name` VARCHAR(100) NOT NULL,
  `gender` VARCHAR(10),
  `class_id` INT
);

-- --------------------------------------------------------

-- Optional: Insert a default admin user (Password is '12345')
INSERT INTO `users` (`username`, `email`, `password`) VALUES
('admin', 'admin@school.edu', '$2y$10$eM/1K9H5H./V5H.l5H.l5u');