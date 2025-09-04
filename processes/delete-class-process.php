<?php
require('../backend/config/config.php');
require('../backend/config/auth.php');
restrict_page(['admin']); // Only admin can delete

if(isset($_POST['class_id'])){
    $class_id = $_POST['class_id'];

    $stmt = $conn->prepare("DELETE FROM classes WHERE class_id=?");
    if(!$stmt){
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $class_id);

    if($stmt->execute()){
        $_SESSION['success'] = "Class deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting class: " . $stmt->error;
    }

    header("Location: ../class-list.php");
}
?>
