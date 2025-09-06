<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['student']); // only students

$student_id = $_SESSION['user_id']; // assuming logged-in student

$active_page = 'view-result.php';
?>
<?php include("backend/path.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Results | Schoolizer</title>
  <?php require_once("includes/link.php"); ?>
</head>
<body>
  <?php require_once("includes/sidebar.php"); ?>

  <div class="main-content p-4">
    <div class="container">
      <h1 class="h3 mb-4">My Results</h1>

      <!-- Filter by Year / Exam -->
      <div class="card p-3 mb-4">
        <h5>Filter Results</h5>
        <form method="GET" class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Year</label>
            <select name="year" class="form-select">
              <option value="" selected>All Years</option>
              <?php
                // Example dynamic years
                $years = [2025, 2024, 2023];
                foreach($years as $y) echo "<option value='$y'>$y</option>";
              ?>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Exam</label>
            <select name="exam" class="form-select">
              <option value="" selected>All Exams</option>
              <?php
                $exams = ['Midterm', 'Final', 'Quiz 1', 'Quiz 2'];
                foreach($exams as $e) echo "<option value='$e'>$e</option>";
              ?>
            </select>
          </div>
          <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
          </div>
        </form>
      </div>

      <!-- Results Table -->
      <div class="card p-3">
        <h5>Recent Results</h5>
        <div class="table-responsive">
          <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-dark">
              <tr>
                <th>Exam</th>
                <th>Subject</th>
                <th>MCQ</th>
                <th>CQ</th>
                <th>Quiz</th>
                <th>Attendance</th>
                <th>Total Marks</th>
                <th>Grade</th>
              </tr>
            </thead>
            <tbody>
              <?php
                // Example data (replace with DB query)
                $results = [
                  ['exam'=>'Midterm','subject'=>'Math','mcq'=>15,'cq'=>20,'quiz'=>5,'attendance'=>5],
                  ['exam'=>'Midterm','subject'=>'English','mcq'=>10,'cq'=>15,'quiz'=>8,'attendance'=>5],
                  ['exam'=>'Final','subject'=>'Math','mcq'=>18,'cq'=>22,'quiz'=>6,'attendance'=>5],
                  ['exam'=>'Final','subject'=>'English','mcq'=>12,'cq'=>18,'quiz'=>7,'attendance'=>5],
                ];

                foreach($results as $res){
                  $total = $res['mcq']+$res['cq']+$res['quiz']+$res['attendance'];
                  // Simple grade calculation
                  $grade = $total >= 90 ? 'A+' : ($total >= 80 ? 'A' : ($total >=70 ? 'B' : ($total>=60?'C':'F')));
                  echo "<tr>";
                  echo "<td>{$res['exam']}</td>";
                  echo "<td>{$res['subject']}</td>";
                  echo "<td>{$res['mcq']}</td>";
                  echo "<td>{$res['cq']}</td>";
                  echo "<td>{$res['quiz']}</td>";
                  echo "<td>{$res['attendance']}</td>";
                  echo "<td>$total</td>";
                  echo "<td>$grade</td>";
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
