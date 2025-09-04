<?php
session_start();
require('../backend/config/config.php');
require('../backend/config/auth.php');

// Only admin or teacher can add subject (adjust roles if needed)
restrict_page(['admin', 'teacher']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $subject_name = trim($_POST['subject_name']);
    $class_id     = intval($_POST['subject_class']);

    // Validate inputs
    if (empty($subject_name) || empty($class_id)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../subjects.php");
        exit();
    }

    // Check if class exists
    $class_check = $conn->prepare("SELECT id FROM classes WHERE id = ?");
    $class_check->bind_param("i", $class_id);
    $class_check->execute();
    $class_check->store_result();
    if ($class_check->num_rows === 0) {
        $_SESSION['error'] = "Selected class does not exist.";
        header("Location: ../subjects.php");
        exit();
    }
    $class_check->close();

    // Insert subject
    $stmt = $conn->prepare("INSERT INTO subjects (subject_name, class_id) VALUES (?, ?)");
    $stmt->bind_param("si", $subject_name, $class_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Subject added successfully!";
    } else {
        $_SESSION['error'] = "Error adding subject: " . $stmt->error;
    }

    $stmt->close();
    header("Location: ../subjects.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: ../subjects.php");
    exit();
}
