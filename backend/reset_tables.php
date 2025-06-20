<?php
include("path.php");
include("config/config.php");

try {
    // Disable foreign key checks
    mysqli_query($connection, "SET FOREIGN_KEY_CHECKS = 0");

    // Truncate tables
    $query_reset_marks = "TRUNCATE TABLE marks";
    $query_reset_students = "TRUNCATE TABLE students";

    if (mysqli_query($connection, $query_reset_marks) && mysqli_query($connection, $query_reset_students)) {
        echo "<script>
            alert('Database have been reset successfully.');
            window.location.href = '../pages/dashboard.php';
        </script>";
    } else {
        throw new Exception("Error resetting data tables: " . mysqli_error($connection));
    }

    // Re-enable foreign key checks
    mysqli_query($connection, "SET FOREIGN_KEY_CHECKS = 1");
} catch (Exception $e) {
    // Handle exceptions
    echo "<script>
        alert('" . $e->getMessage() . "');
        window.location.href = '../pages/dashboard.php';
    </script>";
}
?>