<?php
    require_once("config.php");

    // Helper function to execute SQL and handle errors
    function executeQuery($conn, $query, $tableName) {
        $sql = mysqli_query($conn, $query);
        if (!$sql) {
            echo "Error creating table `$tableName`: " . mysqli_error($conn) . "<br>";
        } else {
            // echo "Table `$tableName` created successfully.";
        }
    }

    // SQL to create `users` table
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

    // SQL to create `teachers` table
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

    // SQL to create `students` table
    $sql_students = "
        CREATE TABLE IF NOT EXISTS students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        student_id VARCHAR(50) UNIQUE NOT NULL,
        roll VARCHAR(10),
        name VARCHAR(100) NOT NULL,
        class VARCHAR(50) NOT NULL,
        father_name VARCHAR(100),
        mother_name VARCHAR(100),
        email VARCHAR(100),
        cgpa DECIMAL(3,2) DEFAULT 0.00
    );";
    executeQuery($conn, $sql_students, "students");

    // Close the connection
    mysqli_close($conn);
?>