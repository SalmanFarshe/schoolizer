<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['student']); // only students
?>
<?php $active_page = 'attendance-report.php'; ?>
<?php include("backend/path.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Attendance Report | Schoolizer</title>
  <?php require_once("includes/link.php"); ?>
  <style>
    .report-card { border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,.05); margin-bottom: 20px; }
    .status-present { color: green; font-weight: 600; }
    .status-absent { color: red; font-weight: 600; }
    .summary-card { border-radius: 12px; padding: 20px; color: #fff; text-align: center; }
    .summary-card h3 { margin: 0; font-size: 2rem; }
    .summary-card p { margin: 0; font-size: 1rem; }
  </style>
</head>
<body>
  <?php require_once("includes/sidebar.php"); ?>

  <div class="main-content p-4">
    <div class="container">
      <h1 class="h3 mb-4">Attendance Report</h1>

      <!-- Filter Form -->
      <div class="mb-4">
        <form class="row g-2">
          <div class="col-md-4">
            <select class="form-select">
              <option selected>Select Class</option>
              <option value="10A">10 - A</option>
              <option value="9B">9 - B</option>
            </select>
          </div>
          <div class="col-md-4">
            <select class="form-select">
              <option selected>Select Month</option>
              <option value="sep">September</option>
              <option value="oct">October</option>
            </select>
          </div>
          <div class="col-md-4">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
          </div>
        </form>
      </div>

      <!-- Summary Cards -->
      <div class="row mb-4">
        <div class="col-md-4 mb-3">
          <div class="summary-card bg-success">
            <h3>85%</h3>
            <p>Overall Attendance</p>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="summary-card bg-primary">
            <h3>90%</h3>
            <p>Present Classes</p>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="summary-card bg-danger">
            <h3>10%</h3>
            <p>Absent Classes</p>
          </div>
        </div>
      </div>

      <!-- Attendance Table -->
      <div class="report-card card p-3">
        <div class="table-responsive">
          <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-dark">
              <tr>
                <th>Subject</th>
                <th>Total Classes</th>
                <th>Classes Present</th>
                <th>Classes Absent</th>
                <th>% Present</th>
                <th>% Absent</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Math</td>
                <td>20</td>
                <td class="status-present">18</td>
                <td class="status-absent">2</td>
                <td class="status-present">90%</td>
                <td class="status-absent">10%</td>
              </tr>
              <tr>
                <td>English</td>
                <td>18</td>
                <td class="status-present">15</td>
                <td class="status-absent">3</td>
                <td class="status-present">83%</td>
                <td class="status-absent">17%</td>
              </tr>
              <tr>
                <td>Physics</td>
                <td>15</td>
                <td class="status-present">12</td>
                <td class="status-absent">3</td>
                <td class="status-present">80%</td>
                <td class="status-absent">20%</td>
              </tr>
              <tr>
                <td>Chemistry</td>
                <td>16</td>
                <td class="status-present">14</td>
                <td class="status-absent">2</td>
                <td class="status-present">87%</td>
                <td class="status-absent">13%</td>
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
