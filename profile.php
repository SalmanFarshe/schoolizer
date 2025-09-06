<?php
  // Only teachers (or admin if you prefer) can access
  require('backend/config/config.php');
  require('backend/config/auth.php');
  restrict_page(['teacher', 'student']); 
?>
<?php $active_page = 'profile.php'; ?>
<?php include("backend/path.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Profile | Schoolizer</title>
  <?php require_once("includes/link.php"); ?>
</head>
<body>
  <?php require_once("includes/sidebar.php"); ?>

  <div class="main-content p-4">
    <div class="container">

      <!-- Page Heading -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Teacher Profile</h1>
        <button class="btn button" data-bs-toggle="modal" data-bs-target="#editProfileModal">
          <i class="bi bi-pencil-square me-1"></i> Edit Profile
        </button>
      </div>

      <!-- Profile Card -->
      <div class="card shadow mb-4">
        <div class="card-body text-center">
          <img src="assets/images/teacher-avatar.png" alt="Teacher" class="rounded-circle mb-3" style="width:120px; height:120px; object-fit:cover;">
          <h3 class="mb-0">John Doe</h3>
          <p class="text-muted">Mathematics Teacher</p>
        </div>
      </div>

      <!-- Profile Details -->
      <div class="card">
        <div class="card-header bg-dark text-white">Profile Details</div>
        <div class="card-body">
          <table class="table table-bordered align-middle">
            <tbody>
              <tr>
                <th class="bg-light" style="width: 200px;">Teacher ID</th>
                <td>TEA001</td>
              </tr>
              <tr>
                <th class="bg-light">Full Name</th>
                <td>John Doe</td>
              </tr>
              <tr>
                <th class="bg-light">Email</th>
                <td>john.doe@example.com</td>
              </tr>
              <tr>
                <th class="bg-light">Phone</th>
                <td>+880123456789</td>
              </tr>
              <tr>
                <th class="bg-light">Assigned Class</th>
                <td>Class 10 - Section A</td>
              </tr>
              <tr>
                <th class="bg-light">Subjects</th>
                <td>Mathematics, Physics</td>
              </tr>
              <tr>
                <th class="bg-light">Address</th>
                <td>Dhaka, Bangladesh</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>

  <!-- Edit Profile Modal -->
  <div class="modal fade zoom-in" id="editProfileModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title">Edit Profile</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="processes/edit-teacher-profile-process.php">
            <div class="mb-3">
              <label class="form-label">Full Name</label>
              <input type="text" class="form-control" name="teacher_name" value="John Doe" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="teacher_email" value="john.doe@example.com" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Phone</label>
              <input type="text" class="form-control" name="teacher_phone" value="+880123456789" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Address</label>
              <textarea class="form-control" name="teacher_address" rows="2" required>Dhaka, Bangladesh</textarea>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-success">Save Changes</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
