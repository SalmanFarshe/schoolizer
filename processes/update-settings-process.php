<?php
require('../backend/config/auth.php');
restrict_page(['admin']);
require_once("../backend/config/config.php");

// Start processing form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Sanitize inputs
    $school_name     = $conn->real_escape_string($_POST['school_name']);
    $school_address  = $conn->real_escape_string($_POST['school_address']);
    $school_phone    = $conn->real_escape_string($_POST['school_phone']);
    $school_email    = $conn->real_escape_string($_POST['school_email']);
    $primary_color   = $_POST['primary_color'] ?? '#175B8C';
    $secondary_color = $_POST['secondary_color'] ?? '#F24515';
    $two_factor      = isset($_POST['two_factor']) ? (int)$_POST['two_factor'] : 0;
    $admin_pass      = $_POST['admin_pass'] ?? '';

    // Handle file uploads
    $uploads_dir = '../assets/images/uploads/';
    $school_logo = '';
    $favicon     = '';

    if (!empty($_FILES['school_logo']['name'])) {
        $tmp_name   = $_FILES['school_logo']['tmp_name'];
        $school_logo = time() . '_' . basename($_FILES['school_logo']['name']);
        move_uploaded_file($tmp_name, $uploads_dir . $school_logo);
    }

    if (!empty($_FILES['favicon']['name'])) {
        $tmp_name = $_FILES['favicon']['tmp_name'];
        $favicon  = time() . '_' . basename($_FILES['favicon']['name']);
        move_uploaded_file($tmp_name, $uploads_dir . $favicon);
    }

    // Check if settings already exist
    $check_sql = "SELECT id FROM settings LIMIT 1";
    $check_res = $conn->query($check_sql);

    if ($check_res && $check_res->num_rows > 0) {
        // Update existing row
        $update_sql = "UPDATE settings SET
            school_name    = '$school_name',
            school_address = '$school_address',
            school_phone   = '$school_phone',
            school_email   = '$school_email',
            primary_color  = '$primary_color',
            secondary_color= '$secondary_color',
            two_factor     = $two_factor";

        if ($school_logo) {
            $update_sql .= ", school_logo = '$school_logo'";
        }
        if ($favicon) {
            $update_sql .= ", favicon = '$favicon'";
        }

        $conn->query($update_sql);
    } else {
        // Insert new row
        $insert_sql = "INSERT INTO settings
            (school_name, school_address, school_phone, school_email, primary_color, secondary_color, two_factor, school_logo, favicon)
            VALUES
            ('$school_name', '$school_address', '$school_phone', '$school_email', '$primary_color', '$secondary_color', $two_factor, '$school_logo', '$favicon')";
        $conn->query($insert_sql);
    }

    // Update admin password if provided (using MD5)
    if (!empty($admin_pass)) {
        $new_pass_md5 = md5($admin_pass);
        $user_id = $_SESSION['user_id']; // 'admin' / 'teacher' / 'student'
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE user_id = ?");
        $stmt->bind_param("ss", $new_pass_md5, $user_id);
        $stmt->execute();
    }

    // Redirect back with success
    header("Location: ../settings.php");
    exit;
}
?>
