<?php
require('../backend/config/config.php');
require('../backend/config/auth.php');
restrict_page(['teacher']); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class_id   = intval($_POST['class_id']);
    $subject_id = intval($_POST['subject_id']);
    $exam_type  = mysqli_real_escape_string($conn, $_POST['exam_type']);

    $mcs        = $_POST['mcs'] ?? [];
    $cq         = $_POST['cq'] ?? [];
    $quiz       = $_POST['quiz'] ?? [];
    $attendance = $_POST['attendance'] ?? [];

    foreach ($mcs as $student_id => $mcs_marks) {
        $student_id = mysqli_real_escape_string($conn, $student_id);
        $mcs_marks  = intval($mcs_marks);
        $cq_marks   = intval($cq[$student_id] ?? 0);
        $quiz_marks = intval($quiz[$student_id] ?? 0);
        $att_marks  = intval($attendance[$student_id] ?? 0);

        // Check if record already exists for this student + exam_type + class + subject
        $check = mysqli_query($conn, "
            SELECT id FROM marks 
            WHERE student_id='$student_id' 
            AND class_id='$class_id' 
            AND subject_id='$subject_id' 
            AND exam_type='$exam_type'
        ");

        if (mysqli_num_rows($check) > 0) {
            // Update marks
            mysqli_query($conn, "
                UPDATE marks 
                SET mcs='$mcs_marks', cq='$cq_marks', quiz='$quiz_marks', attendance='$att_marks' 
                WHERE student_id='$student_id' 
                AND class_id='$class_id' 
                AND subject_id='$subject_id' 
                AND exam_type='$exam_type'
            ");
        } else {
            // Insert new marks
            mysqli_query($conn, "
                INSERT INTO marks (student_id, class_id, subject_id, exam_type, mcs, cq, quiz, attendance) 
                VALUES ('$student_id', '$class_id', '$subject_id', '$exam_type', '$mcs_marks', '$cq_marks', '$quiz_marks', '$att_marks')
            ");
        }
    }

    // Redirect with success flag
    header("Location: ../mark-submission.php?success=1");
    exit;
} else {
    header("Location: ../mark-submission.php");
    exit;
}
