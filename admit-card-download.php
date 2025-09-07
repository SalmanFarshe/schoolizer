<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['student']); // only students
$active_page = 'admit-card-download.php';
include("backend/path.php");

// Check session
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);

// Fetch logged-in student info
$studentQuery = "
    SELECT s.student_id, s.roll, s.name, c.class_name, c.section 
    FROM students s
    LEFT JOIN classes c ON s.class_id = c.id
    INNER JOIN users u ON u.user_id = s.student_id
    WHERE u.user_id = '$user_id' LIMIT 1
";
$studentResult = mysqli_query($conn, $studentQuery);

if (!$studentResult) {
    die("SQL Error: " . mysqli_error($conn));
}

$student = mysqli_fetch_assoc($studentResult);

// Fallback if no student found
if (!$student) {
    $student = [
        'student_id' => '',
        'roll' => '',
        'name' => '',
        'class_name' => '',
        'section' => ''
    ];
}

// Handle form submission
$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($student['student_id'])) {
    $exam = mysqli_real_escape_string($conn, $_POST['exam']);
    $student_id = $student['student_id'];

    $insert = "INSERT INTO admit_card_requests (student_id, exam_name, status) 
               VALUES ('$student_id', '$exam', 'Pending')";
    if (mysqli_query($conn, $insert)) {
        $msg = "Request submitted successfully!";
    } else {
        $msg = "Error: " . mysqli_error($conn);
    }
}

// Fetch previous requests
$requests = [];
if (!empty($student['student_id'])) {
    $requestsQuery = "SELECT * FROM admit_card_requests WHERE student_id = '{$student['student_id']}' ORDER BY request_date DESC";
    $requestsResult = mysqli_query($conn, $requestsQuery);
    if ($requestsResult) {
        $requests = mysqli_fetch_all($requestsResult, MYSQLI_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admit Card Request | Schoolizer</title>
  <?php require_once("includes/link.php"); ?>
  <style>
    .card-shadow { border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,.05); margin-bottom: 20px; }
  </style>
</head>
<body>
  <?php require_once("includes/sidebar.php"); ?>

  <div class="main-content p-4">
    <div class="container">
      <h1 class="h3 mb-4">Admit Card Download Request</h1>

      <?php if (!empty($msg)): ?>
        <div class="alert alert-info"><?= htmlspecialchars($msg); ?></div>
      <?php endif; ?>

      <!-- Request Form -->
      <div class="card card-shadow p-4 mb-4">
        <?php if (empty($student['student_id'])): ?>
          <div class="alert alert-danger">No student record found for your account.</div>
        <?php else: ?>
          <form method="POST">
            <div class="mb-3">
              <label class="form-label">Select Exam</label>
              <select name="exam" class="form-select" required>
                <option selected disabled>Select Exam</option>
                <option value="Midterm Exam">Midterm Exam</option>
                <option value="Final Exam">Final Exam</option>
                <option value="Quiz 1">Quiz 1</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Class</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($student['class_name'] . ' - ' . $student['section']); ?>" readonly>
            </div>

            <div class="mb-3">
              <label class="form-label">Student Name</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($student['name']); ?>" readonly>
            </div>

            <div class="mb-3">
              <label class="form-label">Roll Number</label>
              <input type="text" class="form-control" value="<?= htmlspecialchars($student['roll']); ?>" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Request Admit Card</button>
          </form>
        <?php endif; ?>
      </div>

      <!-- Previous Requests Table -->
      <div class="card card-shadow p-3">
        <h5 class="mb-3">Previous Requests</h5>
        <div class="table-responsive">
          <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
              <tr>
                <th>Exam</th>
                <th>Request Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($requests)): ?>
                <?php foreach($requests as $row): ?>
                  <tr>
                    <td><?= htmlspecialchars($row['exam_name']); ?></td>
                    <td><?= date("d M Y", strtotime($row['request_date'])); ?></td>
                    <td>
                      <?php if ($row['status'] == 'Approved'): ?>
                        <span class="text-success">Approved</span>
                      <?php elseif ($row['status'] == 'Rejected'): ?>
                        <span class="text-danger">Rejected</span>
                      <?php else: ?>
                        <span class="text-warning">Pending</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <?php if ($row['status'] == 'Approved'): ?>
                        <a href="download_admit.php?id=<?= (int)$row['id']; ?>" class="btn btn-sm btn-primary">Download</a>
                      <?php else: ?>
                        <button class="btn btn-sm btn-secondary" disabled>Download</button>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="4">No requests yet.</td></tr>
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
