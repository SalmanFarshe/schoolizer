<?php include("../backend/path.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School Admin Dashboard</title>
  <?php require_once("../tem_parts/link.php")?>
</head>
<body>
    <?php
        require_once("../tem_parts/sidebar.php")
    ?>
<!-- Main Content -->
  <div class="main-content text-center">
    <h1>Teachers List</h1>
    <p>Below is the list of students in Class Six.</p>

    <!-- Table for Students -->
    <div class="table-responsive mx-auto">
      <table class="table table-striped table-bordered text-center">
        <thead>
          <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Remark</th>
            <th>Result</th>
            <th>CGPA</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- Example Student Data -->
          <tr>
            <td>101</td>
            <td>John Doe</td>
            <td>Excellent Performance</td>
            <td>A+</td>
            <td>3.9</td>
            <td>
              <a href="result.php?student_id=101" class="btn btn-primary btn-sm">View Result</a>
            </td>
          </tr>
          <tr>
            <td>102</td>
            <td>Jane Smith</td>
            <td>Good Performance</td>
            <td>A</td>
            <td>3.7</td>
            <td>
              <a href="result.php?student_id=102" class="btn btn-primary btn-sm">View Result</a>
            </td>
          </tr>
          <tr>
            <td>103</td>
            <td>Michael Johnson</td>
            <td>Needs Improvement</td>
            <td>C</td>
            <td>2.3</td>
            <td>
              <a href="result.php?student_id=103" class="btn btn-primary btn-sm">View Result</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
