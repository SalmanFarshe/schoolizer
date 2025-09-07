<?php
require('../backend/config/config.php');
require('../backend/config/auth.php');
restrict_page(['admin']);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $exam_id   = intval($_POST['exam_id']);
    $exam_name = mysqli_real_escape_string($conn, $_POST['exam_name']);
    $class_id  = intval($_POST['exam_class']);
    $exam_date = $_POST['exam_date'];
    $duration  = mysqli_real_escape_string($conn, $_POST['exam_duration']);
    $subjects  = $_POST['exam_subjects'];

    // Update exam
    $updateExam = "UPDATE exams SET exam_name='$exam_name', class_id=$class_id, exam_date='$exam_date', duration='$duration' WHERE id=$exam_id";
    mysqli_query($conn, $updateExam);

    // Remove old subjects
    mysqli_query($conn, "DELETE FROM exam_subjects WHERE exam_id=$exam_id");

    // Insert new subjects
    foreach($subjects as $sub_id){
        $sub_id = intval($sub_id);
        mysqli_query($conn, "INSERT INTO exam_subjects (exam_id, subject_id) VALUES ($exam_id, $sub_id)");
    }

    header("Location: ../exams.php?success=Exam updated successfully");
    exit;
}
