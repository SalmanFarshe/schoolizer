<?php 
  // Only admin can access
  require('backend/config/auth.php');
  restrict_page(['admin', 'teacher', 'student']);

  $active_page = 'dashboard.php'; 
  include("backend/path.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard | Schoolizer</title>
<?php require_once("includes/link.php"); ?>
</head>
<body>
<?php require_once("includes/sidebar.php"); ?>

<div class="main-content p-4">
  <div class="container">
    <h1 class="h3 mb-4">
      <?php
        if($_SESSION['role'] === 'admin')
          echo "Admin Dashboard";
        elseif($_SESSION['role'] === 'teacher')
          echo "Teacher Dashboard";
        elseif($_SESSION['role'] === 'student')
          echo "Student Dashboard";
      ?>
    </h1>
    <?php
      if($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'teacher' && $_SESSION['role'] === 'student'){
        include('roles/student/std-dash.php');
      }

      if($_SESSION['role'] === 'admin' && $_SESSION['role'] !== 'teacher' && $_SESSION['role'] !== 'student'){
        include('roles/admin/admin-dash.php');
      }
      if($_SESSION['role'] !== 'admin' && $_SESSION['role'] === 'teacher' && $_SESSION['role'] !== 'student'){
        include('roles/teacher/teacher-dash.php');
      }
    ?>
  </div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
