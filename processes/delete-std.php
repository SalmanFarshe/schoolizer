<?php
require('../backend/config/config.php');
require('../backend/config/auth.php');
restrict_page(['admin']); // Only admin can delete

if(isset($_POST['student_id'])){
    $student_id = $_POST['student_id'];

    $stmt = $conn->prepare("DELETE FROM students WHERE student_id = ?");
    if(!$stmt){
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $student_id);

    if($stmt->execute()){
        $_SESSION['success'] = "Student deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting student: " . $stmt->error;
    }

    header("Location: ../student-list.php");
}
?>
