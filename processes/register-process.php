<?php
session_start();
require("../backend/config/config.php"); // mysqli $conn

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get POST values safely
    $username = trim($_POST['email'] ?? '');       // email as username
    $password = trim($_POST['password'] ?? '');
    $confirm  = trim($_POST['confirm_password'] ?? '');
    $role     = trim($_POST['role'] ?? '');
    $user_id  = trim($_POST['id_num'] ?? '');     // student/teacher ID

    // Validate fields
    if ($username === '' || $password === '' || $confirm === '' || $role === '' || $user_id === '') {
        $_SESSION['error'] = "All fields are required!";
        header("Location: ../create-account.php"); exit;
    }

    if ($password !== $confirm) {
        $_SESSION['error'] = "Passwords do not match!";
        header("Location: ../create-account.php"); exit;
    }

    // Validate role
    $isValid = false;
    if ($role === 'student') {
        $check = $conn->prepare("SELECT id FROM students WHERE student_id = ? LIMIT 1");
        $check->bind_param("s", $user_id);
        $check->execute();
        $result = $check->get_result();
        if ($result && $result->num_rows > 0) $isValid = true;
    } elseif ($role === 'teacher') {
        $check = $conn->prepare("SELECT id FROM teachers WHERE teacher_id = ? LIMIT 1");
        $check->bind_param("s", $user_id);
        $check->execute();
        $result = $check->get_result();
        if ($result && $result->num_rows > 0) $isValid = true;
    } elseif ($role === 'admin') {
        $_SESSION['error'] = "Admin accounts must be created by system administrator!";
        header("Location: ../create-account.php"); exit;
    }

    if (!$isValid) {
        $_SESSION['error'] = "You are not a valid $role!";
        header("Location: ../create-account.php"); exit;
    }

    // Check if already registered
    $checkUser = $conn->prepare("SELECT id FROM users WHERE user_id = ? LIMIT 1");
    $checkUser->bind_param("s", $user_id);
    $checkUser->execute();
    $res = $checkUser->get_result();
    if ($res && $res->num_rows > 0) {
        $_SESSION['error'] = "This $role is already registered!";
        header("Location: ../create-account.php"); exit;
    }

    // Hash password using md5
    $pass_md5 = md5($password);

    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (user_id, username, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $user_id, $username, $pass_md5, $role);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful! You can now login.";
        header("Location: ../index.php"); exit;
    } else {
        $_SESSION['error'] = "Database error: " . $stmt->error;
        header("Location: ../create-account.php"); exit;
    }

} else {
    $_SESSION['error'] = "Invalid request method!";
    header("Location: ../create-account.php"); exit;
}
?>
