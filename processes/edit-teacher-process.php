<?php
require('../backend/config/config.php');
require('../backend/config/auth.php');
restrict_page(['admin']); // Only admin can edit

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $teacher_id = $_POST['teacher_id'];
    $name       = trim($_POST['teacher_name']);
    $department = trim($_POST['department']);
    $email      = trim($_POST['email']);
    $phone      = trim($_POST['phone']);

    $stmt = $conn->prepare("UPDATE teachers SET name=?, department=?, email=?, phone=? WHERE teacher_id=?");
    if(!$stmt){
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssss", $name, $department, $email, $phone, $teacher_id);

    if($stmt->execute()){
        $_SESSION['success'] = "Teacher updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating teacher: " . $stmt->error;
    }

    header("Location: ../teachers.php");
}
?>
