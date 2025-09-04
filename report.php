<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['admin']);
$active_page = 'report.php';
include("backend/path.php");

// KPIs
$totalStudents = $conn->query("SELECT COUNT(*) as total FROM students")->fetch_assoc()['total'];
$totalTeachers = $conn->query("SELECT COUNT(*) as total FROM teachers")->fetch_assoc()['total'];
$avgCGPA = $conn->query("SELECT AVG(cgpa) as avg_cgpa FROM students")->fetch_assoc()['avg_cgpa'];
$totalClasses = $conn->query("SELECT COUNT(*) as total FROM classes")->fetch_assoc()['total'];

// Charts Data
$cgpaData = $conn->query("
  SELECT c.class_name, AVG(s.cgpa) as avg_cgpa
  FROM students s
  LEFT JOIN classes c ON s.class_id = c.class_id
  GROUP BY s.class_id
");
$cgpaLabels = [];
$cgpaValues = [];
while($c = $cgpaData->fetch_assoc()){
    $cgpaLabels[] = $c['class_name'];
    $cgpaValues[] = round($c['avg_cgpa'], 2);
}

$studentCountData = $conn->query("
  SELECT c.class_name, COUNT(s.student_id) as student_count
  FROM students s
  LEFT JOIN classes c ON s.class_id = c.class_id
  GROUP BY s.class_id
");
$studentCountLabels = [];
$studentCountValues = [];
while($s = $studentCountData->fetch_assoc()){
    $studentCountLabels[] = $s['class_name'];
    $studentCountValues[] = $s['student_count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reports & Analysis | Schoolizer</title>
<?php require_once("includes/link.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
  .kpi-card {
    border-radius: 12px;
    padding: 20px;
    color: #fff;
  }
  .kpi-icon {
    font-size: 2rem;
  }
</style>
</head>
<body>
<?php require_once("includes/sidebar.php"); ?>

<div class="main-content p-4">
  <div class="container">

    <h1 class="h3 mb-4">Reports & Analysis</h1>

    <!-- KPI Cards -->
    <div class="row mb-4">
      <div class="col-md-3 mb-3">
        <div class="kpi-card bg-primary d-flex justify-content-between align-items-center shadow">
          <div>
            <h5>Total Students</h5>
            <h3><?= $totalStudents ?></h3>
          </div>
          <i class="bi bi-people-fill kpi-icon"></i>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="kpi-card bg-danger d-flex justify-content-between align-items-center shadow">
          <div>
            <h5>Total Teachers</h5>
            <h3><?= $totalTeachers ?></h3>
          </div>
          <i class="bi bi-person-badge kpi-icon"></i>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="kpi-card bg-success d-flex justify-content-between align-items-center shadow">
          <div>
            <h5>Average CGPA</h5>
            <h3><?= round($avgCGPA,2) ?></h3>
          </div>
          <i class="bi bi-bar-chart kpi-icon"></i>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="kpi-card bg-warning d-flex justify-content-between align-items-center shadow">
          <div>
            <h5>Total Classes</h5>
            <h3><?= $totalClasses ?></h3>
          </div>
          <i class="bi bi-building kpi-icon"></i>
        </div>
      </div>
    </div>
<?php
// Fetch total students per class
$classStudentsRes = $conn->query("
    SELECT c.class_name, COUNT(s.student_id) as student_count
    FROM classes c
    LEFT JOIN students s ON s.class_id = c.class_id
    GROUP BY c.class_id
");
$classStudents = [];
while($row = $classStudentsRes->fetch_assoc()){
    $classStudents[$row['class_name']] = $row['student_count'];
}
?>
<!-- After main KPI Cards -->
<div class="row mb-4">
  <div class="col-12">
    <h4 class="mb-3">Students per Class</h4>
  </div>
  <?php foreach($classStudents as $className => $count): ?>
    <div class="col-md-3 mb-3">
      <div class="kpi-card bg-info d-flex justify-content-between align-items-center shadow">
        <div>
          <h6><?= htmlspecialchars($className) ?></h6>
          <h4><?= $count ?></h4>
        </div>
        <i class="bi bi-people-fill kpi-icon"></i>
      </div>
    </div>
  <?php endforeach; ?>
</div>

    <!-- Charts -->
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="card shadow">
          <div class="card-header bg-primary text-white">
            Average CGPA per Class
          </div>
          <div class="card-body">
            <canvas id="cgpaChart"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="card shadow">
          <div class="card-header bg-danger text-white">
            Student Distribution per Class
          </div>
          <div class="card-body">
            <canvas id="classDistributionChart"></canvas>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
const cgpaChart = new Chart(document.getElementById('cgpaChart'), {
  type: 'bar',
  data: {
    labels: <?= json_encode($cgpaLabels) ?>,
    datasets: [{
      label: 'Average CGPA',
      data: <?= json_encode($cgpaValues) ?>,
      backgroundColor: ['#175B8C','#F24515','#28a745','#ffc107','#6f42c1']
    }]
  },
  options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, max: 4 } } }
});

const classDistributionChart = new Chart(document.getElementById('classDistributionChart'), {
  type: 'pie',
  data: {
    labels: <?= json_encode($studentCountLabels) ?>,
    datasets: [{
      label: 'Student Count',
      data: <?= json_encode($studentCountValues) ?>,
      backgroundColor: ['#F24515','#175B8C','#28a745','#ffc107','#6f42c1']
    }]
  },
  options: { responsive: true }
});
</script>
</body>
</html>
