<?php
session_start();
require("backend/config/config.php"); // mysqli $conn

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up - Schoolizer</title>
  <?php
    include("includes/link.php");
  ?>
</head>
<body>
<div class="sign-up-container container-fluid"> 
  <div class="row">
    <div class="sign-up-left col-md-6 d-flex align-items-center justify-content-center">
      <div class="p-3 sign-up-left-inside text-center text-white mb-4 w-75">
        <h1 class="">Welcome to Schoolizer</h1>
        <p class="lead">
          Create your account to manage your school efficiently.
          <br>
          <span class="fw-bold">Join thousands of educators and students already using Schoolizer!</span>
        </p>
      </div>
    </div>
    <div style="height: 100vh; background: linear-gradient(to bottom right, rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.58));" class="col-md-6 d-flex align-items-center justify-content-center">
      <div class="p-5">
        <div class="text-center">
          <img src="assets/images/logo/schoolizer-logo.png" alt="Schoolizer Logo" class="sign-up-logo img-fluid mb-3" style="width: 100px;">
          <p class="text-white">Create your account to get started</p>
        </div>
        <form action="processes/register-process.php" method="POST">
          <div class="row">
            <!-- select role teacher or student  -->
            <div class="col-md-12 mb-3">
              <label for="role" class="form-label text-white">Role</label>
              <select id="role" name="role" class="form-select" required>
                <option value="">Select your role</option>
                <option value="teacher">Teacher</option>
                <option value="student">Student</option>
              </select>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="email" class="form-label text-white">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mb-3">
                <label for="id_num" class="form-label text-white">ID(Student/Teacher)</label>
                <input type="text" id="id_num" name="id_num" class="form-control" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label text-white">Password</label>
              <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
              <label for="confirm_password" class="form-label text-white">Confirm Password</label>
              <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
          </div>
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">Sign Up</button>
          </div>
          <p class="text-center small text-info">
            Already have an account?
            <a href="index.php" class="text-decoration-none">Login here</a>
          </p>
        </form>
      </div>
    </div>
    </div>
  </div>    


<?php
    include("includes/link-js.php");
?>
</body>
</html>
 