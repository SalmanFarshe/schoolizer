<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}

// Function to restrict page by role
function restrict_page($allowed_roles = []) {
    if (!in_array($_SESSION['role'], $allowed_roles)) {
        // Optional: show message or just redirect
        header("Location: index.php");
        exit();
    }
}