<?php
// Database configuration
$host = "localhost";
// $user = "salmanfarshe_schoolizerr";        // change if needed
$user = "root";        // change if needed
// $pass = "schoolizerr@2025";            // change if your MySQL has password
$pass = "";            // change if your MySQL has password
$db   = "salmanfarshe_schoolizerr";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8mb4");
?>