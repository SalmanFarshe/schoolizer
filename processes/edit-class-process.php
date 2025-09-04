<?php
session_start();
require('../backend/config/config.php');
require('../backend/config/auth.php');
restrict_page(['admin']); // only admin

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_id     = trim($_POST['class_id']);
    $class_name   = trim($_POST['class_name']);
    $section      = trim($_POST['section']);
    $room_no      = trim($_POST['room_no']);
    $teacher_id   = intval($_POST['teacher_id']);
    $num_students = ($_POST['num_students'] === '' ? null : (int)$_POST['num_students']);

    // Resolve teacher name from teachers table
    $teacher_name = null;
    $stmtT = $conn->prepare("SELECT name FROM teachers WHERE id = ?");
    if ($stmtT) {
        $stmtT->bind_param("i", $teacher_id);
        $stmtT->execute();
        $stmtT->bind_result($teacher_name);
        $stmtT->fetch();
        $stmtT->close();
    }

    if (!$teacher_name) {
        $_SESSION['error'] = "Invalid teacher selected.";
        header("Location: ../class-list.php");
        exit;
    }

    $stmt = $conn->prepare("
        UPDATE classes
        SET class_name = ?, section = ?, room_no = ?, teacher_in_charge = ?, num_students = ?
        WHERE class_id = ?
    ");
    if (!$stmt) {
        $_SESSION['error'] = "Prepare failed: " . $conn->error;
        header("Location: ../class-list.php");
        exit;
    }

    // num_students may be NULL
    if ($num_students === null) {
        // pass NULL by using i (int) with null? mysqli requires special handling -> use bind with s and pass null? Easiest: cast to NULL via set to null and use types "sss s s" won't work
        // So we’ll pass as int but default to 0 if empty. If you truly want NULL, change column to allow NULL and use dynamic query. For now, keep int:
        $num_students = 0;
    }

    $stmt->bind_param("ssssis", $class_name, $section, $room_no, $teacher_name, $num_students, $class_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Class updated successfully!";
    } else {
        $_SESSION['error'] = "Failed to update class: " . $stmt->error;
    }
    $stmt->close();

    header("Location: ../class-list.php");
    exit;
}

$_SESSION['error'] = "Invalid request method.";
header("Location: ../class-list.php");
exit;
