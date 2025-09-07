<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['student']); // only students

$student_id = $_SESSION['user_id']; // logged-in student
$active_page = 'attendance-report.php';
include("backend/path.php");

// Fetch subjects and attendance for this student
$subjectsQuery = "
    SELECT sub.id AS subject_id, sub.subject_name, c.class_name
    FROM students s
    LEFT JOIN classes c ON s.class_id = c.id
    LEFT JOIN subjects sub ON sub.class_id = c.id
    WHERE s.student_id = '$student_id'";
$subjectsResult = mysqli_query($conn, $subjectsQuery);
$attendanceData = [];

$totalClasses = 0;
$totalPresent = 0;

while ($sub = mysqli_fetch_assoc($subjectsResult)) {
    $subject_id = $sub['subject_id'];
    
    // Get attendance counts
    $attQuery = "SELECT 
                    COUNT(*) AS total_classes,
                    SUM(status='Present') AS present_count,
                    SUM(status='Absent') AS absent_count
                 FROM student_attendance
                 WHERE student_id='$student_id' AND class_id=(SELECT class_id FROM subjects WHERE id='$subject_id')";
    $attResult = mysqli_query($conn, $attQuery);
    $att = mysqli_fetch_assoc($attResult);

    $attendanceData[] = [
        'subject' => $sub['subject_name'],
        'total' => (int)$att['total_classes'],
        'present' => (int)$att['present_count'],
        'absent' => (int)$att['absent_count']
    ];

    $totalClasses += (int)$att['total_classes'];
    $totalPresent += (int)$att['present_count'];
}

$totalAbsent = $totalClasses - $totalPresent;
$overallPercent = $totalClasses > 0 ? round(($totalPresent / $totalClasses) * 100) : 0;
$absentPercent = 100 - $overallPercent;
?>

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

      <!-- Summary Cards -->
      <div class="row mb-4">
        <div class="col-md-4 mb-3">
          <div class="summary-card bg-success">
            <h3><?= $overallPercent ?>%</h3>
            <p>Overall Attendance</p>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="summary-card bg-primary">
            <h3><?= $totalPresent ?></h3>
            <p>Classes Present</p>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="summary-card bg-danger">
            <h3><?= $totalAbsent ?></h3>
            <p>Classes Absent</p>
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
              <?php if(!empty($attendanceData)): ?>
                <?php foreach($attendanceData as $att): 
                  $percentPresent = $att['total']>0 ? round(($att['present']/$att['total'])*100) : 0;
                  $percentAbsent = 100 - $percentPresent;
                ?>
                  <tr>
                    <td><?= htmlspecialchars($att['subject']) ?></td>
                    <td><?= $att['total'] ?></td>
                    <td class="status-present"><?= $att['present'] ?></td>
                    <td class="status-absent"><?= $att['absent'] ?></td>
                    <td class="status-present"><?= $percentPresent ?>%</td>
                    <td class="status-absent"><?= $percentAbsent ?>%</td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="6">No attendance data available.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
