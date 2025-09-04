<?php
require('../backend/config/config.php');
require('../backend/config/auth.php');
restrict_page(['admin']); // Only admin can add

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Trim all inputs
    $name     = trim($_POST['student_name']);
    $roll     = trim($_POST['roll']);
    $class_id = intval($_POST['class_id']); // updated to class_id
    $email    = trim($_POST['email']);
    $father   = trim($_POST['father_name']);
    $mother   = trim($_POST['mother_name']);
    $cgpa     = trim($_POST['cgpa']);

    // Validate that class_id exists
    $class_check = $conn->prepare("SELECT id FROM classes WHERE id=?");
    $class_check->bind_param("i", $class_id);
    $class_check->execute();
    $class_check->store_result();
    if ($class_check->num_rows === 0) {
        $_SESSION['error'] = "Selected class does not exist.";
        header("Location: ../student-list.php");
        exit();
    }
    $class_check->close();

    // Generate student_id automatically
    $result = $conn->query("SELECT COUNT(*) AS total FROM students");
    $row = $result->fetch_assoc();
    $student_id = 'STU' . str_pad($row['total'] + 1, 3, '0', STR_PAD_LEFT);

    // Prepare insert statement
    $stmt = $conn->prepare("INSERT INTO students (student_id, roll, name, class_id, email, father_name, mother_name, cgpa) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssissss", $student_id, $roll, $name, $class_id, $email, $father, $mother, $cgpa);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Student added successfully!";
    } else {
        $_SESSION['error'] = "Error adding student: " . $stmt->error;
    }

    $stmt->close();
    header("Location: ../student-list.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: ../student-list.php");
    exit();
}
