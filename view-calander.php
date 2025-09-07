<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['teacher', 'student']); // accessible by both
$active_page = 'view-calander.php';
include("backend/path.php");

// Fetch month-wise holidays dynamically from academic_events table
$holidaysQuery = "
    SELECT event_name, event_date 
    FROM academic_events 
    WHERE event_type = 'Holiday'
    ORDER BY event_date ASC
";
$holidaysResult = mysqli_query($conn, $holidaysQuery);

$academic_holidays = [];
while($row = mysqli_fetch_assoc($holidaysResult)) {
    $month = date('F', strtotime($row['event_date']));
    $academic_holidays[$month][] = [
        'date' => date('d M', strtotime($row['event_date'])),
        'name' => $row['event_name']
    ];
}

// Fetch upcoming exams and events dynamically
$eventsQuery = "
    SELECT event_name, event_date, event_class, event_type 
    FROM academic_events 
    WHERE event_type IN ('Exam', 'Activity') AND event_date >= CURDATE()
    ORDER BY event_date ASC
";
$eventsResult = mysqli_query($conn, $eventsQuery);
$upcoming_events = [];
while($row = mysqli_fetch_assoc($eventsResult)) {
    $upcoming_events[] = [
        'name' => $row['event_name'],
        'date' => date('d M', strtotime($row['event_date'])),
        'class' => $row['event_class']
    ];
}
?>

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
              if(!empty($academic_holidays)){
                  foreach($academic_holidays as $month => $holidays){
                      echo "<tr>";
                      echo "<td>$month</td>";
                      echo "<td>".count($holidays)."</td>";
                      echo "<td>";
                      foreach($holidays as $h){
                          echo "<span class='holiday'>{$h['date']} - {$h['name']}</span><br>";
                      }
                      echo "</td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='3'>No holidays found.</td></tr>";
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
              if(!empty($upcoming_events)){
                  foreach($upcoming_events as $event){
                      echo "<tr>";
                      echo "<td>{$event['name']}</td>";
                      echo "<td>{$event['date']}</td>";
                      echo "<td>{$event['class']}</td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='3'>No upcoming exams or events.</td></tr>";
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
