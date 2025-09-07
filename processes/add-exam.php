<?php
require('../backend/config/config.php');
require('../backend/config/auth.php');

// Only admin can add exams
restrict_page(['admin']);

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $exam_name = mysqli_real_escape_string($conn, $_POST['exam_name']);
    $class_id  = intval($_POST['exam_class']);
    $exam_date = $_POST['exam_date'];
    $duration  = mysqli_real_escape_string($conn, $_POST['exam_duration']);
    $subjects  = $_POST['exam_subjects']; // Array of subject IDs

    // Insert exam into exams table
    $insertExam = "INSERT INTO exams (exam_name, class_id, exam_date, duration) 
                   VALUES ('$exam_name', $class_id, '$exam_date', '$duration')";

    if(mysqli_query($conn, $insertExam)){
        $exam_id = mysqli_insert_id($conn);

        // Insert exam subjects
        foreach($subjects as $sub_id){
            $sub_id = intval($sub_id);
            mysqli_query($conn, "INSERT INTO exam_subjects (exam_id, subject_id) VALUES ($exam_id, $sub_id)");
        }

        // Redirect or return success
        header("Location: ../exams.php?success=Exam added successfully");
        exit;
    } else {
        die("Insert Exam Failed: ".mysqli_error($conn));
    }
} else {
    die("Invalid Request Method");
}
