<?php
session_start();
require("backend/config/config.php"); // mysqli $conn

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = isset($_POST['userrole']) ? trim($_POST['userrole']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if ($role !== '' && $password !== '') {
        $pass_md5 = md5($password);

        // If you truly log in by role only, this matches that pattern.
        // (Better: add username/email input, but keeping your current UX.)
        $stmt = $conn->prepare("SELECT * FROM users WHERE role = ? AND password = ? LIMIT 1");
        if (!$stmt) {
            $_SESSION['error'] = "DB error: " . $conn->error;
            header("Location: index.php"); exit;
        }
        $stmt->bind_param("ss", $role, $pass_md5);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res && $res->num_rows === 1) {
            $user = $res->fetch_assoc();
            // Store both the string user_id (admin/teacher/student) and numeric id if you want
            $_SESSION['user_id']  = $user['user_id']; // 'admin' | 'teacher' | 'student'
            $_SESSION['uid']      = $user['id'];      // numeric PK (optional)
            $_SESSION['username'] = $user['username'];
            $_SESSION['role']     = $user['role'];

            header("Location: dashboard.php"); 
            exit;
        } else {
            $_SESSION['error'] = "Invalid role or password!";
            header("Location: index.php"); exit;
        }
    } else {
        $_SESSION['error'] = "All fields are required!";
        header("Location: index.php"); exit;
    }
}
