<?php $active_page = 'report.php'; ?>
<?php include("backend/path.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reports & Analysis | Schoolizer</title>
<?php require_once("includes/link.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<?php require_once("includes/sidebar.php"); ?>

<div class="main-content p-4">
<div class="container">
  <h1 class="h3 mb-4">Reports & Analysis</h1>

  <!-- Filters -->
  <div class="row mb-3">
    <div class="col-md-3 mb-2">
      <input type="text" class="form-control" id="searchInput" placeholder="Search by Name/ID">
    </div>
    <div class="col-md-3 mb-2">
      <select class="form-select" id="filterClass">
        <option value="">All Classes</option>
        <option value="9">Class 9</option>
        <option value="10">Class 10</option>
      </select>
    </div>
    <div class="col-md-3 mb-2">
      <select class="form-select" id="filterRole">
        <option value="">All Roles</option>
        <option value="Student">Student</option>
        <option value="Teacher">Teacher</option>
      </select>
    </div>
    <div class="col-md-3 mb-2 text-end">
      <button class="btn btn-success" onclick="exportReport('pdf')"><i class="bi bi-file-earmark-pdf"></i> Export PDF</button>
      <button class="btn btn-primary" onclick="exportReport('excel')"><i class="bi bi-file-earmark-spreadsheet"></i> Export Excel</button>
    </div>
  </div>

  <!-- Report Table -->
  <div class="table-responsive mb-4">
    <table class="table table-striped table-hover table-bordered text-center align-middle" id="reportTable">
      <thead class="table-dark">
        <tr>
          <th>Name</th>
          <th>Role</th>
          <th>Class</th>
          <th>ID Number</th>
          <th>CGPA</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>John Doe</td>
          <td>Student</td>
          <td>10</td>
          <td>STU001</td>
          <td>3.85</td>
        </tr>
        <tr>
          <td>Jane Smith</td>
          <td>Student</td>
          <td>10</td>
          <td>STU002</td>
          <td>3.65</td>
        </tr>
        <tr>
          <td>Ali Khan</td>
          <td>Student</td>
          <td>9</td>
          <td>STU003</td>
          <td>3.90</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Charts / Analysis -->
  <div class="row">
    <div class="col-md-6 mb-4">
      <canvas id="cgpaChart"></canvas>
    </div>
    <div class="col-md-6 mb-4">
      <canvas id="classDistributionChart"></canvas>
    </div>
  </div>
</div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
// Search and Filter
const searchInput = document.getElementById('searchInput');
const filterClass = document.getElementById('filterClass');
const filterRole = document.getElementById('filterRole');
const table = document.getElementById('reportTable').getElementsByTagName('tbody')[0];

function filterTable() {
  const search = searchInput.value.toLowerCase();
  const classFilter = filterClass.value;
  const roleFilter = filterRole.value;

  for (let row of table.rows) {
    const name = row.cells[0].innerText.toLowerCase();
    const role = row.cells[1].innerText;
    const cls = row.cells[2].innerText;
    row.style.display = (name.includes(search) &&
                         (classFilter === "" || cls === classFilter) &&
                         (roleFilter === "" || role === roleFilter)) ? "" : "none";
  }
}

searchInput.addEventListener('input', filterTable);
filterClass.addEventListener('change', filterTable);
filterRole.addEventListener('change', filterTable);

// Export (dummy)
function exportReport(type) {
  alert(`Exporting report as ${type.toUpperCase()} (this is demo functionality)`);
}

// Charts
const cgpaChart = new Chart(document.getElementById('cgpaChart'), {
  type: 'bar',
  data: {
    labels: ['Class 9', 'Class 10'],
    datasets: [{
      label: 'Average CGPA',
      data: [3.90, 3.75],
      backgroundColor: ['#175B8C','#F24515']
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { display: false } },
    scales: { y: { beginAtZero: true, max: 4 } }
  }
});

const classDistributionChart = new Chart(document.getElementById('classDistributionChart'), {
  type: 'pie',
  data: {
    labels: ['Class 9', 'Class 10'],
    datasets: [{
      label: 'Student Count',
      data: [30, 25],
      backgroundColor: ['#F24515','#175B8C']
    }]
  }
});
</script>
</body>
</html>
