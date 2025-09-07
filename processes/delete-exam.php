<?php
require('../backend/config/config.php');
require('../backend/config/auth.php');
restrict_page(['admin']);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $exam_id = intval($_POST['exam_id']);

    // Delete exam subjects first
    mysqli_query($conn, "DELETE FROM exam_subjects WHERE exam_id=$exam_id");

    // Delete exam
    mysqli_query($conn, "DELETE FROM exams WHERE id=$exam_id");

    header("Location: ../exams.php?success=Exam deleted successfully");
    exit;
}
