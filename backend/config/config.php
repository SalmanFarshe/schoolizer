<?php
// Database configuration
$host = "localhost";
$user = "root";        // change if needed
$pass = "";            // change if your MySQL has password
$db   = "schoolizer";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8mb4");
?>