<?php
  require('backend/config/config.php');
  require('backend/config/auth.php');
  restrict_page(['teacher']);
?>
<?php $active_page = 'attendence.php'; ?>
<?php include("backend/path.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Attendance | Schoolizer</title>
  <?php require_once("includes/link.php"); ?>
</head>
<body>
  <?php require_once("includes/sidebar.php"); ?>

  <div class="main-content p-4">
    <div class="container">
      <h1 class="h3 mb-4">Take Attendance</h1>

      <!-- Select Class / Section -->
      <div class="card mb-4">
        <div class="card-header bg-dark text-white">Select Class / Section</div>
        <div class="card-body">
          <form class="row g-3" id="attendanceFilterForm">
            <div class="col-md-4">
              <label class="form-label">Class</label>
              <select class="form-select" id="classSelect">
                <option selected>Select Class</option>
                <option value="10">Class 10</option>
                <option value="9">Class 9</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Section</label>
              <select class="form-select" id="sectionSelect">
                <option selected>Select Section</option>
                <option value="A">A</option>
                <option value="B">B</option>
              </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
              <button type="button" class="btn btn-primary w-100" id="loadStudentsBtn">Load Students</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Attendance Table -->
      <div class="card" id="attendanceCard" style="display:none;">
        <div class="card-header bg-dark text-white">Attendance</div>
        <div class="card-body table-responsive">
          <form id="attendanceForm">
            <table class="table table-bordered table-striped text-center align-middle">
              <thead class="table-dark">
                <tr>
                  <th>Student ID</th>
                  <th>Name</th>
                  <th>Present</th>
                  <th>Absent</th>
                  <th>Late</th>
                </tr>
              </thead>
              <tbody id="attendanceTableBody">
                <!-- Dynamically loaded students will appear here -->
              </tbody>
            </table>
            <div class="text-end mt-3">
              <button type="submit" class="btn btn-success">Submit Attendance</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script>
    const studentsData = [
      { id: 'STU101', name: 'John Doe' },
      { id: 'STU102', name: 'Jane Smith' },
      { id: 'STU103', name: 'Alice Johnson' },
      { id: 'STU104', name: 'Bob Brown' },
    ];

    const loadStudentsBtn = document.getElementById('loadStudentsBtn');
    const attendanceCard = document.getElementById('attendanceCard');
    const attendanceTableBody = document.getElementById('attendanceTableBody');

    loadStudentsBtn.addEventListener('click', () => {
      // Clear existing rows
      attendanceTableBody.innerHTML = '';

      // Load students (replace this with dynamic backend fetch later)
      studentsData.forEach(student => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${student.id}</td>
          <td>${student.name}</td>
          <td><input type="radio" name="status_${student.id}" value="Present" checked></td>
          <td><input type="radio" name="status_${student.id}" value="Absent"></td>
          <td><input type="radio" name="status_${student.id}" value="Late"></td>
        `;
        attendanceTableBody.appendChild(row);
      });

      attendanceCard.style.display = 'block';
    });

    // Handle form submit
    document.getElementById('attendanceForm').addEventListener('submit', function(e){
      e.preventDefault();
      alert('Attendance submitted successfully!');
      // Here you can collect the data and send it to backend via AJAX
    });
  </script>
</body>
</html>
