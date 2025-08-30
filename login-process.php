<?php
session_start();
require("backend/config/config.php"); // database connection

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['userrole'];
    $password = $_POST['password'];

    if (!empty($role) && !empty($password)) {
        // Prepare query to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE role = ? AND password = MD5(?)");
        $stmt->bind_param("ss", $role, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: dashboard.php");
                exit();
            } elseif ($user['role'] === 'teacher') {
                header("Location: teacher-dash.php");
                exit();
            } elseif ($user['role'] === 'student') {
                header("Location: student-dash.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Invalid role or password!";
                header("Location: index.php");
            exit();
        }
    } else {
        $error = "All fields are required!";
    }
}
?>
