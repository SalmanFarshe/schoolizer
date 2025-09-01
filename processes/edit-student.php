<?php
require('../backend/config/config.php');
require('../backend/config/auth.php');
restrict_page(['admin']); // Only admin can edit

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $student_id = $_POST['student_id'];
    $name       = trim($_POST['student_name']);
    $roll       = trim($_POST['roll']);
    $class      = trim($_POST['class']);
    $email      = trim($_POST['email']);
    $father     = trim($_POST['father_name']);
    $mother     = trim($_POST['mother_name']);
    $cgpa       = trim($_POST['cgpa']);

    $stmt = $conn->prepare("UPDATE students SET name=?, roll=?, class=?, email=?, father_name=?, mother_name=?, cgpa=? WHERE student_id=?");
    if(!$stmt){
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssssss", $name, $roll, $class, $email, $father, $mother, $cgpa, $student_id);

    if($stmt->execute()){
        $_SESSION['success'] = "Student updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating student: " . $stmt->error;
    }

    header("Location: ../student-list.php");
}
?>
