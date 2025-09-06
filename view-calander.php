<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['teacher', 'student']); // accessible by both
?>
<?php $active_page = 'view-calander.php'; ?>
<?php include("backend/path.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Academic Calendar | Schoolizer</title>
  <?php require_once("includes/link.php"); ?>
  <style>
    .holiday { color: red; font-weight: 600; }
    .calendar-card { border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,.05); margin-bottom: 20px; }
    .calendar-card table { margin-bottom: 0; }
  </style>
</head>
<body>
  <?php require_once("includes/sidebar.php"); ?>

  <div class="main-content p-4">
    <div class="container">
      <h1 class="h3 mb-4">Academic Calendar</h1>

      <!-- Month-wise Holidays -->
      <div class="calendar-card card p-3">
        <h5 class="mb-3">Month-wise Holidays</h5>
        <div class="table-responsive">
          <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-dark">
              <tr>
                <th>Month</th>
                <th>No. of Holidays</th>
                <th>Dates & Holidays</th>
              </tr>
            </thead>
            <tbody>
              <?php
                // Example dynamic data from admin (replace with DB fetch)
                $academic_holidays = [
                  'January' => [
                    ['date'=>'01 Jan', 'name'=>'New Year'],
                    ['date'=>'25 Jan', 'name'=>'National Day'],
                    ['date'=>'30 Jan', 'name'=>'Teacher\'s Day']
                  ],
                  'February' => [
                    ['date'=>'10 Feb', 'name'=>'Science Day'],
                    ['date'=>'21 Feb', 'name'=>'Language Day']
                  ],
                  'March' => [
                    ['date'=>'17 Mar', 'name'=>'Annual Sports Day']
                  ]
                ];

                foreach($academic_holidays as $month => $holidays) {
                  echo "<tr>";
                  echo "<td>$month</td>";
                  echo "<td>".count($holidays)."</td>";
                  echo "<td>";
                  foreach($holidays as $h) {
                    echo "<span class='holiday'>{$h['date']} - {$h['name']}</span><br>";
                  }
                  echo "</td>";
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Upcoming Exams / Events -->
      <div class="calendar-card card p-3">
        <h5 class="mb-3">Upcoming Exams & Events</h5>
        <div class="table-responsive">
          <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-dark">
              <tr>
                <th>Event Name</th>
                <th>Date</th>
                <th>Class / Section</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $upcoming_events = [
                  ['name'=>'Midterm Exam', 'date'=>'15 Sep', 'class'=>'10 - A'],
                  ['name'=>'Quiz 1', 'date'=>'20 Sep', 'class'=>'9 - B'],
                  ['name'=>'Annual Function', 'date'=>'01 Oct', 'class'=>'All Classes']
                ];

                foreach($upcoming_events as $event) {
                  echo "<tr>";
                  echo "<td>{$event['name']}</td>";
                  echo "<td>{$event['date']}</td>";
                  echo "<td>{$event['class']}</td>";
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
