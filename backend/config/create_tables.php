<?php
    require_once("config.php");

    // Helper function to execute SQL and handle errors
    function executeQuery($connection, $query, $tableName) {
        $sql = mysqli_query($connection, $query);
        if (!$sql) {
            echo "Error creating table `$tableName`: " . mysqli_error($connection) . "<br>";
        } else {
            // echo "Table `$tableName` created successfully.";
        }
    }

    // SQL to create `students` table
    $sql_students = "
    CREATE TABLE IF NOT EXISTS students (
        student_id VARCHAR(20) PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        father_name VARCHAR(100) NOT NULL,
        mother_name VARCHAR(100) NOT NULL,
        class VARCHAR(50) NOT NULL,
        group_name VARCHAR(50),
        roll INT NOT NULL
    );";
    executeQuery($connection, $sql_students, "students");
    
    $users = "
    CREATE TABLE IF NOT EXISTS users (
        user_id VARCHAR(20) PRIMARY KEY,
        user_name VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'teacher', 'student') NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );";
    executeQuery($connection, $users, "users");

    // SQL to create `subjects` table
    $sql_subjects = "
    CREATE TABLE IF NOT EXISTS subjects (
        subject_id INT AUTO_INCREMENT PRIMARY KEY,
        subject_name VARCHAR(100) NOT NULL UNIQUE
    );";
    executeQuery($connection, $sql_subjects, "subjects");

    // SQL to create `marks` table
    $sql_marks = "
    CREATE TABLE IF NOT EXISTS marks (
        mark_id INT AUTO_INCREMENT PRIMARY KEY,
        student_id VARCHAR(20) NOT NULL,
        subject_id INT NOT NULL,
        cq_marks DECIMAL(5, 2) NOT NULL,
        mcq_marks DECIMAL(5, 2) NOT NULL,
        total_marks DECIMAL(5, 2) GENERATED ALWAYS AS (cq_marks + mcq_marks) STORED,
        FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE,
        FOREIGN KEY (subject_id) REFERENCES subjects(subject_id) ON DELETE CASCADE
    );";
    executeQuery($connection, $sql_marks, "marks");

    // SQL to populate `subjects` table with predefined subjects
    $sql_populate_subjects = "
    INSERT IGNORE INTO subjects (subject_name) VALUES
    ('Bangla'), ('English'), ('Math'), ('Religion'), 
    ('History'), ('Science'), ('ICT'), 
    ('Wellbeing'), ('Life and Livelihood'), ('Art & Culture');
    ";
    executeQuery($connection, $sql_populate_subjects, "subjects population");
    
    // grade table
    $sql_grade = "
    CREATE TABLE IF NOT EXISTS grades (
        grade_id INT AUTO_INCREMENT PRIMARY KEY,
        grade_range_start INT NOT NULL,
        grade_range_end INT NOT NULL,
        grade VARCHAR(10) NOT NULL,
        gpa DECIMAL(2, 1) NOT NULL
        );";
    executeQuery($connection, $sql_grade , "grades");
    
    // insert data into grades table
    $sql_insert_grades = "
    INSERT INTO grades (grade_range_start, grade_range_end, grade, gpa) VALUES
    (80, 100, 'A+', 5),
    (70, 79, 'A', 4),
    (60, 69, 'A-', 3.5),
    (50, 59, 'B', 3),
    (40, 49, 'C', 2),
    (33, 39, 'D', 1);";
    executeQuery($connection, $sql_insert_grades, "grades data");

    // Close the connection
    mysqli_close($connection);
?>