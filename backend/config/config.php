<?php
    $server_name = 'localhost';
    $dbusername = 'salmanfarshe_schoolizer';
    // $dbusername = 'root';
    $dbpassword = 'schoolizer@2025';
    // $dbpassword = '';
    $dbname = 'salmanfarshe_schoolizer';
    // $dbname = 'schoolizerdb';

    global $connection;
    $connection = mysqli_connect($server_name, $dbusername, $dbpassword);
    if (!$connection) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    $db_selected = mysqli_select_db($connection, $dbname);
    if (!$db_selected) {
        $create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
        if (!mysqli_query($connection, $create_db)) {
            die("Error creating database: " . mysqli_error($connection));
        }
    }
    $connection = mysqli_connect($server_name, $dbusername, $dbpassword, $dbname);
    if (!$connection) {
        die('Error reconnecting to the new database: ' . mysqli_connect_error());
    }
?>
