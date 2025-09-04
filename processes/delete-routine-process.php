<?php
require('../backend/config/auth.php');
restrict_page(['admin']);
require('../backend/config/config.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['routine_id'];

    $stmt = $conn->prepare("DELETE FROM class_routine WHERE id=?");
    $stmt->bind_param("i", $id);

    if($stmt->execute()){
        header("Location: ../routine.php?success=Routine deleted successfully");
        exit();
    } else {
        header("Location: ../routine.php?error=" . urlencode($stmt->error));
        exit();
    }
}else{
    header("Location: ../routine.php");
    exit();
}
?>
