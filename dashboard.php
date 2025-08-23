<?php $active_page = 'dashboard.php'; ?>
<?php include("backend/path.php"); ?>
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

  <h1 class="h3 mb-4">Dashboard</h1>

  <!-- Quick Stats Cards -->
  <div class="row mb-4">
    <div class="col-md-3 mb-3">
      <div class="card text-white bg-primary">
        <div class="card-body text-center">
          <h5>Total Students</h5>
          <h2>120</h2>
          <i class="bi bi-people-fill fs-2"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card text-white bg-success">
        <div class="card-body text-center">
          <h5>Total Teachers</h5>
          <h2>25</h2>
          <i class="bi bi-person-badge-fill fs-2"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card text-white bg-warning">
        <div class="card-body text-center">
          <h5>Total Classes</h5>
          <h2>10</h2>
          <i class="bi bi-journal-bookmark-fill fs-2"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <div class="card text-white bg-danger">
        <div class="card-body text-center">
          <h5>Total Subjects</h5>
          <h2>35</h2>
          <i class="bi bi-book-fill fs-2"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Links -->
  <div class="mb-4">
    <h5>Quick Actions</h5>
    <div class="d-flex gap-2 flex-wrap">
      <a href="student-list.php" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Add Student</a>
      <a href="teachers.php" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Add Teacher</a>
      <a href="class-list.php" class="btn btn-warning"><i class="bi bi-plus-circle me-1"></i> Add Class</a>
      <a href="subjects.php" class="btn btn-danger"><i class="bi bi-plus-circle me-1"></i> Add Subject</a>
    </div>
  </div>

  <!-- Recent Activity Table -->
  <div class="card mb-4">
    <div class="card-header bg-dark text-white">Recent Students</div>
    <div class="card-body table-responsive">
      <table class="table table-striped table-bordered align-middle text-center">
        <thead class="table-dark">
          <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Class</th>
            <th>Roll</th>
            <th>CGPA</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>STU120</td>
            <td>John Doe</td>
            <td>10</td>
            <td>12</td>
            <td>3.85</td>
          </tr>
          <tr>
            <td>STU119</td>
            <td>Jane Smith</td>
            <td>9</td>
            <td>07</td>
            <td>3.75</td>
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
