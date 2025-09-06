<?php
require_once("config.php");

// Helper function
function executeQuery($conn, $query, $tableName) {
    $sql = mysqli_query($conn, $query);
    if (!$sql) {
        echo "Error creating table `$tableName`: " . mysqli_error($conn) . "<br>";
    }
}

// 1. Users
$sql_users = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(50) UNIQUE NOT NULL,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','teacher','student') NOT NULL
);";
executeQuery($conn, $sql_users, "users");

// 2. User Profile (depends on users)
$sql_user_profile = "
CREATE TABLE IF NOT EXISTS user_profile (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(50) NOT NULL,
    designation VARCHAR(100) DEFAULT NULL,
    profile_pic VARCHAR(255) DEFAULT 'default.png',
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);";
executeQuery($conn, $sql_user_profile, "user_profile");

// 3. Teachers
$sql_teachers = "
CREATE TABLE IF NOT EXISTS teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    teacher_id VARCHAR(50) UNIQUE NOT NULL,
    name VARCHAR(100) NOT NULL,
    department VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20)
);";
executeQuery($conn, $sql_teachers, "teachers");

// 4. Classes
$sql_classes = "
CREATE TABLE IF NOT EXISTS classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_id VARCHAR(50) UNIQUE NOT NULL,
    class_name VARCHAR(100) NOT NULL,
    section VARCHAR(50),
    room_no VARCHAR(50),
    teacher_in_charge VARCHAR(100),
    num_students INT DEFAULT 0
);";
executeQuery($conn, $sql_classes, "classes");

// 5. Students (depends on classes)
$sql_students = "
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(50) UNIQUE NOT NULL,
    roll VARCHAR(10),
    class_id INT,
    name VARCHAR(100) NOT NULL,
    father_name VARCHAR(100),
    mother_name VARCHAR(100),
    email VARCHAR(100),
    cgpa DECIMAL(3,2) DEFAULT 0.00,
    FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE SET NULL
);";
executeQuery($conn, $sql_students, "students");

// 6. Subjects (depends on classes)
$sql_subjects = "
CREATE TABLE IF NOT EXISTS subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(100) NOT NULL,
    class_id INT NOT NULL,
    FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE
);";
executeQuery($conn, $sql_subjects, "subjects");

// 7. Notices
$sql_notices = "
CREATE TABLE IF NOT EXISTS notices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    notice_date DATE NOT NULL,
    audience ENUM('All','Students','Teachers') NOT NULL
);";
executeQuery($conn, $sql_notices, "notices");

// 8. Academic Events
$sql_academic_events = "
CREATE TABLE IF NOT EXISTS academic_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255) NOT NULL,
    event_date DATE NOT NULL,
    event_type ENUM('Exam', 'Holiday', 'Activity') NOT NULL,
    event_class VARCHAR(50) NOT NULL DEFAULT 'All',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);";
executeQuery($conn, $sql_academic_events, "academic_events");

// 9. Settings
$sql_settings = "
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    school_name VARCHAR(255) NOT NULL,
    school_address VARCHAR(255) NOT NULL,
    school_phone VARCHAR(50) NOT NULL,
    school_email VARCHAR(100) NOT NULL,
    school_logo VARCHAR(255) DEFAULT NULL,
    primary_color VARCHAR(10) DEFAULT '#175B8C',
    secondary_color VARCHAR(10) DEFAULT '#F24515',
    favicon VARCHAR(255) DEFAULT NULL,
    two_factor TINYINT(1) DEFAULT 0,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);";
executeQuery($conn, $sql_settings, "settings");

// 10. Class Routine (depends on classes, subjects, teachers)
$sql_class_routine = "
CREATE TABLE IF NOT EXISTS class_routine (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_id INT NOT NULL,
    day ENUM('Monday','Tuesday','Wednesday','Thursday','Friday') NOT NULL,
    subject_id INT NOT NULL,
    teacher_id INT NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE,
    FOREIGN KEY (teacher_id) REFERENCES teachers(id) ON DELETE CASCADE
);";
executeQuery($conn, $sql_class_routine, "class_routine");

mysqli_close($conn);
?>
