<?php 
// Only student can access
require('backend/config/auth.php');
restrict_page(['student']);

$active_page = 'student-dashboard.php'; 
include("backend/path.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Dashboard | Schoolizer</title>
<?php require_once("includes/link.php"); ?>
</head>
<body>
<?php require_once("includes/sidebar.php"); ?>

<div class="main-content p-4">
<div class="container">

  <h1 class="h3 mb-4">Dashboard</h1>

  <!-- Quick Stats Cards -->
  <div class="row mb-4">
    <div class="col-md-3 mb-3">
      <div class="card text-white bg-primary">
        <div class="card-body text-center">
          <h5>Enrolled Classes</h5>
          <h2>5</h2>
          <i class="bi bi-journal-bookmark-fill fs-2"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card text-white bg-success">
        <div class="card-body text-center">
          <h5>Completed Subjects</h5>
          <h2>12</h2>
          <i class="bi bi-book-fill fs-2"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card text-white bg-warning">
        <div class="card-body text-center">
          <h5>Attendance</h5>
          <h2>92%</h2>
          <i class="bi bi-check2-square fs-2"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card text-white bg-danger">
        <div class="card-body text-center">
          <h5>Pending Quizzes</h5>
          <h2>3</h2>
          <i class="bi bi-question-circle fs-2"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Actions -->
  <div class="mb-4">
    <h5>Quick Actions</h5>
    <div class="d-flex gap-2 flex-wrap">
      <a href="results.php" class="btn btn-primary"><i class="bi bi-poll me-1"></i> View Results</a>
      <a href="routine.php" class="btn btn-success"><i class="bi bi-calendar2-week me-1"></i> View Routine</a>
      <a href="notes.php" class="btn btn-warning"><i class="bi bi-sticky-note me-1"></i> View Notes</a>
      <a href="quiz.php" class="btn btn-danger"><i class="bi bi-question-circle me-1"></i> Attempt Quiz</a>
      <a href="ledger.php" class="btn btn-info"><i class="bi bi-journal-text me-1"></i> Ledger</a>
    </div>
  </div>

  <!-- Recent Activity Table -->
  <div class="card mb-4">
    <div class="card-header bg-dark text-white">Recent Notices</div>
    <div class="card-body table-responsive">
      <table class="table table-striped table-bordered align-middle text-center">
        <thead class="table-dark">
          <tr>
            <th>Date</th>
            <th>Notice</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>2025-08-31</td>
            <td>Upcoming final exams schedule released.</td>
          </tr>
          <tr>
            <td>2025-08-30</td>
            <td>Holiday for national festival declared.</td>
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
