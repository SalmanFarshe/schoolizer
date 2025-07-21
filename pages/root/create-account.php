<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up - Schoolizer</title>
  <?php
    include("../../tem_parts/link.php");
  ?>
</head>
<body>
<div class="container bg-dark d-flex justify-content-center align-items-center min-vh-100">
  <div class="card shadow-lg p-4" style="max-width: 450px; width: 100%; border-radius: 1rem;">
    <div class="text-center mb-4">
      <h2 class="fw-bold text-primary">School<span class="text-danger">izer</span></h2>
      <p class="text-muted">Create your account to get started</p>
    </div>
    <form action="#" method="POST">
      <div class="mb-3">
        <label for="fullname" class="form-label">Full Name</label>
        <input type="text" id="fullname" name="fullname" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" id="email" name="email" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control" required>
      </div>
      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary">Sign Up</button>
      </div>
      <p class="text-center small">
        Already have an account?
        <a href="../../index.php" class="text-decoration-none">Login here</a>
      </p>
    </form>
  </div>
</div>
<?php
    include("../../tem_parts/link-js.php");
?>
</body>
</html>
 