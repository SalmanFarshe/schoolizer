<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['student']); // only students
?>
<?php $active_page = 'admit-card-download.php'; ?>
<?php include("backend/path.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admit Card Request | Schoolizer</title>
  <?php require_once("includes/link.php"); ?>
  <style>
    .card-shadow { border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,.05); margin-bottom: 20px; }
  </style>
</head>
<body>
  <?php require_once("includes/sidebar.php"); ?>

  <div class="main-content p-4">
    <div class="container">
      <h1 class="h3 mb-4">Admit Card Download Request</h1>

      <!-- Request Form -->
      <div class="card card-shadow p-4 mb-4">
        <form>
          <div class="mb-3">
            <label class="form-label">Select Exam</label>
            <select class="form-select" required>
              <option selected disabled>Select Exam</option>
              <option value="midterm">Midterm Exam</option>
              <option value="final">Final Exam</option>
              <option value="quiz1">Quiz 1</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Class</label>
            <input type="text" class="form-control" value="10 - A" readonly>
          </div>

          <div class="mb-3">
            <label class="form-label">Student Name</label>
            <input type="text" class="form-control" value="John Doe" readonly>
          </div>

          <div class="mb-3">
            <label class="form-label">Roll Number</label>
            <input type="text" class="form-control" value="STU120" readonly>
          </div>

          <button type="submit" class="btn btn-primary">Request Admit Card</button>
        </form>
      </div>

      <!-- Previous Requests Table -->
      <div class="card card-shadow p-3">
        <h5 class="mb-3">Previous Requests</h5>
        <div class="table-responsive">
          <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
              <tr>
                <th>Exam</th>
                <th>Request Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Midterm Exam</td>
                <td>01 Sep 2025</td>
                <td><span class="text-success">Approved</span></td>
                <td><button class="btn btn-sm btn-primary">Download</button></td>
              </tr>
              <tr>
                <td>Quiz 1</td>
                <td>10 Aug 2025</td>
                <td><span class="text-warning">Pending</span></td>
                <td><button class="btn btn-sm btn-secondary" disabled>Download</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
