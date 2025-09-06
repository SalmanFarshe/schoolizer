<?php
session_start();
require('../backend/config/config.php');
require('../backend/config/auth.php');

// Only admin or teacher can delete
restrict_page(['admin', 'teacher']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject_id = intval($_POST['subject_id']);

    $stmt = $conn->prepare("DELETE FROM subjects WHERE id = ?");
    $stmt->bind_param("i", $subject_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Subject deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting subject: " . $stmt->error;
    }

    $stmt->close();
    header("Location: ../subjects.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: ../subjects.php");
    exit();
}
