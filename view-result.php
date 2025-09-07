<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['student']); // only students

$student_id = $_SESSION['user_id']; // logged-in student
$active_page = 'view-result.php';
include("backend/path.php");

// Get filters
$year = isset($_GET['year']) ? intval($_GET['year']) : '';
$exam = isset($_GET['exam']) ? mysqli_real_escape_string($conn, $_GET['exam']) : '';

// Build SQL query dynamically
$sql = "SELECT m.exam_type, s.subject_name, m.mcs, m.cq, m.quiz, m.attendance, m.total_marks
        FROM marks m
        JOIN subjects s ON s.id = m.subject_id
        WHERE m.student_id = '$student_id'";

if ($exam !== '') {
    $sql .= " AND m.exam_type = '$exam'";
}

// Optionally filter by year (assuming you have a `created_at` column)
if ($year !== '') {
    $sql .= " AND YEAR(m.created_at) = $year";
}

$sql .= " ORDER BY m.created_at DESC";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}
$results = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

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

      <!-- Filter Form -->
      <div class="card p-3 mb-4">
        <h5>Filter Results</h5>
        <form method="GET" class="row g-3">
          <div class="col-md-4">
            <label class="form-label">Year</label>
            <select name="year" class="form-select">
              <option value="" <?= $year==''?'selected':'' ?>>All Years</option>
              <?php
                // Generate dynamic years from marks table
                $yearsQuery = mysqli_query($conn, "SELECT DISTINCT YEAR(created_at) AS yr FROM marks WHERE student_id='$student_id' ORDER BY yr DESC");
                while ($y = mysqli_fetch_assoc($yearsQuery)) {
                    $selected = $year==$y['yr']?'selected':'';
                    echo "<option value='{$y['yr']}' $selected>{$y['yr']}</option>";
                }
              ?>
            </select>
          </div>
          <div class="col-md-4">
            <label class="form-label">Exam</label>
            <select name="exam" class="form-select">
              <option value="" <?= $exam==''?'selected':'' ?>>All Exams</option>
              <?php
                $examTypes = ['midterm','final','other']; // Or fetch dynamically from marks table
                foreach($examTypes as $e){
                    $selected = $exam==$e?'selected':'';
                    echo "<option value='$e' $selected>".ucfirst($e)."</option>";
                }
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
              <?php if(!empty($results)): ?>
                <?php foreach($results as $res): 
                  $total = $res['mcs']+$res['cq']+$res['quiz']+$res['attendance'];
                  $grade = $total >= 90 ? 'A+' : ($total >= 80 ? 'A' : ($total >=70 ? 'B' : ($total>=60?'C':'F')));
                ?>
                  <tr>
                    <td><?= ucfirst($res['exam_type']); ?></td>
                    <td><?= htmlspecialchars($res['subject_name']); ?></td>
                    <td><?= $res['mcs']; ?></td>
                    <td><?= $res['cq']; ?></td>
                    <td><?= $res['quiz']; ?></td>
                    <td><?= $res['attendance']; ?></td>
                    <td><?= $total; ?></td>
                    <td><?= $grade; ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="8">No results found.</td></tr>
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
