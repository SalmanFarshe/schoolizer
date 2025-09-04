<?php
session_start();
require('../backend/config/config.php');
require('../backend/config/auth.php');

// Only admin or teacher can edit subjects
restrict_page(['admin', 'teacher']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject_id   = intval($_POST['subject_id']);
    $subject_name = trim($_POST['subject_name']);
    $class_id     = intval($_POST['subject_class']);

    // Validate
    if (empty($subject_name) || empty($class_id)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../subjects.php");
        exit();
    }

    // Check class exists
    $stmt_check = $conn->prepare("SELECT id FROM classes WHERE id = ?");
    $stmt_check->bind_param("i", $class_id);
    $stmt_check->execute();
    $stmt_check->store_result();
    if ($stmt_check->num_rows === 0) {
        $_SESSION['error'] = "Selected class does not exist.";
        $stmt_check->close();
        header("Location: ../subjects.php");
        exit();
    }
    $stmt_check->close();

    // Update subject
    $stmt = $conn->prepare("UPDATE subjects SET subject_name = ?, class_id = ? WHERE id = ?");
    $stmt->bind_param("sii", $subject_name, $class_id, $subject_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Subject updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating subject: " . $stmt->error;
    }

    $stmt->close();
    header("Location: ../subjects.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: ../subjects.php");
    exit();
}
