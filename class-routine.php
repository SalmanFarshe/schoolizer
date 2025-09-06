<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['student']); // only students
?>
<?php $active_page = 'class-routine.php'; ?>
<?php include("backend/path.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Class Routine | Schoolizer</title>
  <?php require_once("includes/link.php"); ?>
  <style>
    .routine-card { border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,.05); margin-bottom: 20px; }
    .routine-table th, .routine-table td { vertical-align: middle; }
  </style>
</head>
<body>
  <?php require_once("includes/sidebar.php"); ?>

  <div class="main-content p-4">
    <div class="container">
      <h1 class="h3 mb-4">My Class Routine</h1>

      <div class="routine-card card p-3">
        <h5 class="mb-3">Weekly Routine</h5>
        <div class="table-responsive">
          <table class="table table-bordered table-striped routine-table text-center align-middle">
            <thead class="table-dark">
              <tr>
                <th>Time</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example static routine -->
              <tr>
                <td>08:00 - 08:45</td>
                <td>Math</td>
                <td>English</td>
                <td>Physics</td>
                <td>Chemistry</td>
                <td>Biology</td>
              </tr>
              <tr>
                <td>08:50 - 09:35</td>
                <td>English</td>
                <td>Math</td>
                <td>Chemistry</td>
                <td>Physics</td>
                <td>History</td>
              </tr>
              <tr>
                <td>09:40 - 10:25</td>
                <td>Physics</td>
                <td>Biology</td>
                <td>Math</td>
                <td>English</td>
                <td>Geography</td>
              </tr>
              <tr>
                <td>10:30 - 11:15</td>
                <td>Chemistry</td>
                <td>Computer</td>
                <td>English</td>
                <td>Math</td>
                <td>Physics</td>
              </tr>
              <tr>
                <td>11:20 - 12:05</td>
                <td>Biology</td>
                <td>History</td>
                <td>Computer</td>
                <td>Geography</td>
                <td>Math</td>
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
