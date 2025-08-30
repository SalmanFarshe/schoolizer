<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['admin']); // Only admin can add

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['teacher_name'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Generate teacher_id automatically
    $stmt = $conn->query("SELECT COUNT(*) AS total FROM teachers");
    $row = $stmt->fetch_assoc();
    $teacher_id = 'TEA' . str_pad($row['total'] + 1, 3, '0', STR_PAD_LEFT);

    $stmt = $conn->prepare("INSERT INTO teachers (teacher_id, name, department, email, phone) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $teacher_id, $name, $department, $email, $phone);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Teacher added successfully!";
    } else {
        $_SESSION['error'] = "Error adding teacher.";
    }

    header("Location: teachers.php");
}
