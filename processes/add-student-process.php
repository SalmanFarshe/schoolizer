<?php
require('../backend/config/config.php');
require('../backend/config/auth.php');
restrict_page(['admin']); // Only admin can add

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Trim all inputs
    $name   = trim($_POST['student_name']);
    $roll   = trim($_POST['roll']);
    $class  = trim($_POST['class']);
    $email  = trim($_POST['email']);
    $father = trim($_POST['father_name']);
    $mother = trim($_POST['mother_name']);
    $cgpa   = trim($_POST['cgpa']);

    // Generate student_id automatically
    $result = $conn->query("SELECT COUNT(*) AS total FROM students");
    $row = $result->fetch_assoc();
    $student_id = 'STU' . str_pad($row['total'] + 1, 3, '0', STR_PAD_LEFT);

    // Prepare insert statement
    $stmt = $conn->prepare("INSERT INTO students (student_id, roll, name, class, email, father_name, mother_name, cgpa) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if(!$stmt){
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssssss", $student_id, $roll, $name, $class, $email, $father, $mother, $cgpa);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Student added successfully!";
    } else {
        $_SESSION['error'] = "Error adding student: " . $stmt->error;
    }

    header("Location: ../student-list.php");
}
