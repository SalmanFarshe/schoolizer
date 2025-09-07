<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['teacher']);

// Handle AJAX requests
if(isset($_POST['action'])) {
    $action = $_POST['action'];

    // 1. Fetch students
    if($action == 'fetch_students' && isset($_POST['class_id'])) {
        $class_id = intval($_POST['class_id']);
        $students = mysqli_query($conn, "SELECT * FROM students WHERE class_id='$class_id' ORDER BY roll ASC");
        $data = [];
        while($row = mysqli_fetch_assoc($students)) {
            $data[] = $row;
        }
        echo json_encode($data);
        exit;
    }

    // 2. Save attendance
    if($action == 'save_attendance' && isset($_POST['class_id'], $_POST['attendance'])) {
        $class_id = intval($_POST['class_id']);
        $attendance = json_decode($_POST['attendance'], true);

        foreach($attendance as $student_id => $status) {
            $student_id = mysqli_real_escape_string($conn, $student_id);
            $status = mysqli_real_escape_string($conn, $status);
            mysqli_query($conn, "INSERT INTO student_attendance (student_id, class_id, status, date)
                VALUES ('$student_id', '$class_id', '$status', CURDATE())
                ON DUPLICATE KEY UPDATE status='$status'");
        }
        echo json_encode(['success' => true]);
        exit;
    }
}

// Fetch all classes for dropdown
$classQuery = mysqli_query($conn, "SELECT * FROM classes ORDER BY class_name, section");
$classes = mysqli_fetch_all($classQuery, MYSQLI_ASSOC);

?>
<?php $active_page = 'attendence.php'; ?>
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
      <div class="col-md-6">
        <label class="form-label">Class / Section</label>
        <select class="form-select" id="classSelect">
            <option selected>Select Class</option>
            <?php foreach($classes as $cls): ?>
                <option value="<?= $cls['id'] ?>"><?= $cls['class_name'] ?> - <?= $cls['section'] ?></option>
            <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-6 d-flex align-items-end">
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
        <tbody id="attendanceTableBody"></tbody>
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
const loadStudentsBtn = document.getElementById('loadStudentsBtn');
const attendanceCard = document.getElementById('attendanceCard');
const attendanceTableBody = document.getElementById('attendanceTableBody');
const classSelect = document.getElementById('classSelect');

loadStudentsBtn.addEventListener('click', () => {
    const classId = classSelect.value;
    if(classId === "Select Class") { alert("Please select a class"); return; }

    attendanceTableBody.innerHTML = '<tr><td colspan="5">Loading...</td></tr>';

    fetch('', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `action=fetch_students&class_id=${classId}`
    })
    .then(res => res.json())
    .then(data => {
        attendanceTableBody.innerHTML = '';
        if(data.length === 0){
            attendanceTableBody.innerHTML = '<tr><td colspan="5">No students found</td></tr>';
        } else {
            data.forEach(student => {
                const row = document.createElement('tr');
                row.innerHTML = `
                  <td>${student.student_id}</td>
                  <td>${student.name}</td>
                  <td><input type="radio" name="status_${student.student_id}" value="Present" checked></td>
                  <td><input type="radio" name="status_${student.student_id}" value="Absent"></td>
                  <td><input type="radio" name="status_${student.student_id}" value="Late"></td>
                `;
                attendanceTableBody.appendChild(row);
            });
        }
        attendanceCard.style.display = 'block';
    });
});

// Submit attendance
document.getElementById('attendanceForm').addEventListener('submit', function(e){
    e.preventDefault();
    const classId = classSelect.value;
    const attendance = {};

    document.querySelectorAll('tbody tr').forEach(row => {
        const studentId = row.cells[0].innerText;
        const status = row.querySelector(`input[name="status_${studentId}"]:checked`).value;
        attendance[studentId] = status;
    });

    fetch('', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `action=save_attendance&class_id=${classId}&attendance=${encodeURIComponent(JSON.stringify(attendance))}`
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) alert('Attendance saved successfully!');
        else alert('Error saving attendance');
    });
});
</script>
</body>
</html>
