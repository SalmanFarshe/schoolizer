<?php
require('../backend/config/config.php');
require('../backend/config/auth.php');

// Only admin can add class
restrict_page(['admin']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $class_name   = trim($_POST['class_name']);
    $section      = trim($_POST['section']);
    $teacher_id   = intval($_POST['teacher_id']);
    $room_no      = trim($_POST['room_no']);
    $num_students = !empty($_POST['num_students']) ? intval($_POST['num_students']) : 0;

    // Generate unique class_id
    $result = $conn->query("SELECT COUNT(*) AS total FROM classes");
    $row = $result->fetch_assoc();
    $class_id = 'CLS' . str_pad($row['total'] + 1, 3, '0', STR_PAD_LEFT);

    // Get teacher name from teachers table
    $teacher_name = null;
    $teacher_stmt = $conn->prepare("SELECT name FROM teachers WHERE id = ?");
    $teacher_stmt->bind_param("i", $teacher_id);
    $teacher_stmt->execute();
    $teacher_stmt->bind_result($teacher_name);
    $teacher_stmt->fetch();
    $teacher_stmt->close();

    if (!$teacher_name) {
        $_SESSION['error'] = "Invalid teacher selected!";
        header("Location: ../class-list.php");
        exit();
    }

    // ✅ Insert class into DB (now including room_no)
    $stmt = $conn->prepare("
        INSERT INTO classes 
        (class_id, class_name, section, room_no, teacher_in_charge, num_students) 
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssssi", $class_id, $class_name, $section, $room_no, $teacher_name, $num_students);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Class added successfully!";
    } else {
        $_SESSION['error'] = "Error adding class: " . $stmt->error;
    }

    $stmt->close();
    header("Location: ../class-list.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: ../class-list.php");
    exit();
}
