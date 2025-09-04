<?php
require('../backend/config/config.php');
require('../backend/config/auth.php');
restrict_page(['admin']); // Only admin can edit

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $student_id = $_POST['student_id'];
    $name       = trim($_POST['student_name']);
    $roll       = trim($_POST['roll']);
    $class_id   = intval($_POST['class_id']); // updated to class_id
    $email      = trim($_POST['email']);
    $father     = trim($_POST['father_name']);
    $mother     = trim($_POST['mother_name']);
    $cgpa       = trim($_POST['cgpa']);

    // Optional: validate that class_id exists
    $class_check = $conn->prepare("SELECT id FROM classes WHERE id=?");
    $class_check->bind_param("i", $class_id);
    $class_check->execute();
    $class_check->store_result();
    if($class_check->num_rows === 0){
        $_SESSION['error'] = "Selected class does not exist.";
        header("Location: ../student-list.php");
        exit();
    }
    $class_check->close();

    $stmt = $conn->prepare("UPDATE students SET name=?, roll=?, class_id=?, email=?, father_name=?, mother_name=?, cgpa=? WHERE student_id=?");
    if(!$stmt){
        die("Prepare failed: " . $conn->error);
    }
$stmt->bind_param("ssisssss", $name, $roll, $class_id, $email, $father, $mother, $cgpa, $student_id);

    if($stmt->execute()){
        $_SESSION['success'] = "Student updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating student: " . $stmt->error;
    }

    header("Location: ../student-list.php");
    exit();
}
?>
