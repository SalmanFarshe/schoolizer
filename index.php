<?php
  require("backend/config/config.php");
  require("backend/config/create_tables.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Schoolizer</title>
  <?php
    include("includes/link.php");
  ?>
</head>
<body>
<div class="sign-up-container container-fluid"> 
  <div class="row">
    <div class="sign-up-left col-md-6 d-flex align-items-center justify-content-center">
      <div class="p-3 sign-up-left-inside text-center text-white mb-4 w-75">
        <h1 class="">Welcome Back!</h1>
        <p class="lead">
          Log in to manage your school efficiently.<br>
          <span class="fw-bold">Join thousands of educators and students already using Schoolizer!</span>
        </p>
      </div>
    </div>
    <div style="height: 100vh; background: linear-gradient(to bottom right, rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.58));" class="col-md-6 d-flex align-items-center justify-content-center">
      <div class="p-5">
        <div class="text-center">
          <img src="assets/images/logo/schoolizer-logo.png" alt="Schoolizer Logo" class="sign-up-logo img-fluid mb-3" style="width: 100px;">
          <p class="text-white">Login to your account</p>
        </div>
        <form method="POST" action="login-process.php">
            <?php if(isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

          <div class="row">
            <div class="col-md-12 mb-3">
              <label for="userrole" class="form-label text-white">Role</label>
              <select name="userrole" id="userrole" class="form-select" required>
                <option value="">Select your role</option>
                <option value="admin">Admin</option>
                <option value="teacher">Teacher</option>
                <option value="student">Student</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label text-white">Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>
          </div>
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
          <p class="text-center small text-info">
            Don't have an account?
            <a href="create-account.php" class="text-decoration-none">Create Account</a>
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