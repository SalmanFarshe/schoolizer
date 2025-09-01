<?php
require('../backend/config/config.php');
require('../backend/config/auth.php');
restrict_page(['admin']); // Only admin can delete

if(isset($_POST['teacher_id'])){
    $teacher_id = $_POST['teacher_id'];

    $stmt = $conn->prepare("DELETE FROM teachers WHERE teacher_id=?");
    if(!$stmt){
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $teacher_id);

    if($stmt->execute()){
        $_SESSION['success'] = "Teacher deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting teacher: " . $stmt->error;
    }

    header("Location: ../teachers.php");
}
?>
