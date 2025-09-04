<?php
require('../backend/config/auth.php');
restrict_page(['admin']);
require('../backend/config/config.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_id = $_POST['class_id'];
    $day = $_POST['day'];
    $subject_id = $_POST['subject_id'];
    $teacher_id = $_POST['teacher_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $stmt = $conn->prepare("INSERT INTO class_routine (class_id, day, subject_id, teacher_id, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isiiss", $class_id, $day, $subject_id, $teacher_id, $start_time, $end_time);

    if($stmt->execute()) {
        header("Location: ../routine.php");
        exit();
    } else {
        header("Location: ../routine.php");
        exit();
    }
} else {
    header("Location: ../routine.php");
    exit();
}
?>
