<?php
require('../backend/config/auth.php');
restrict_page(['admin']);
require('../backend/config/config.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['routine_id'];
    $class_id = $_POST['class_id'];
    $day = $_POST['day'];
    $subject_id = $_POST['subject_id'];
    $teacher_id = $_POST['teacher_id'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $stmt = $conn->prepare("UPDATE class_routine SET class_id=?, day=?, subject_id=?, teacher_id=?, start_time=?, end_time=? WHERE id=?");
    $stmt->bind_param("isiissi", $class_id, $day, $subject_id, $teacher_id, $start_time, $end_time, $id);

    if($stmt->execute()){
        header("Location: ../routine.php?success=Routine updated successfully");
        exit();
    } else {
        header("Location: ../routine.php?error=" . urlencode($stmt->error));
        exit();
    }
}else{
    header("Location: ../routine.php");
    exit();
}
?>
