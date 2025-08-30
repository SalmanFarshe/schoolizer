<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['admin']); // Only admin can add

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['student_name'];
    $roll = $_POST['student_roll'];
    $class = $_POST['student_class'];
    $email = $_POST['student_email'];

    // Generate student_id automatically
    $stmt = $conn->query("SELECT COUNT(*) AS total FROM students");
    $row = $stmt->fetch_assoc();
    $student_id = 'STU' . str_pad($row['total'] + 1, 3, '0', STR_PAD_LEFT);

    $stmt = $conn->prepare("INSERT INTO students (student_id, roll, name, class, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $student_id, $roll, $name, $class, $email);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Student added successfully!";
    } else {
        $_SESSION['error'] = "Error adding student.";
    }

    header("Location: student-list.php");
}
