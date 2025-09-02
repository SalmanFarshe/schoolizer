<?php
require('../backend/config/config.php');
require('../backend/config/auth.php');
restrict_page(['admin']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name       = trim($_POST['teacher_name']);
    $department = trim($_POST['department']);
    $email      = trim($_POST['email']);
    $phone      = trim($_POST['phone']);

    // Generate teacher_id safely using MAX(id)
    $result = $conn->query("SELECT MAX(id) AS max_id FROM teachers");
    $row = $result->fetch_assoc();
    $next_id = $row['max_id'] + 1;
    $teacher_id = 'TEA' . str_pad($next_id, 3, '0', STR_PAD_LEFT);

    $stmt = $conn->prepare("INSERT INTO teachers (teacher_id, name, department, email, phone) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) die("Prepare failed: " . $conn->error);

    $stmt->bind_param("sssss", $teacher_id, $name, $department, $email, $phone);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Teacher added successfully!";
    } else {
        $_SESSION['error'] = "Error adding teacher: " . $stmt->error;
    }

    header("Location: ../teachers.php");
    exit();
}
?>
