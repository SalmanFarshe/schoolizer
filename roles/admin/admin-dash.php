<?php
require('backend/config/config.php');

// Get total stats
$total_students = $conn->query("SELECT COUNT(*) AS count FROM students")->fetch_assoc()['count'];
$total_teachers = $conn->query("SELECT COUNT(*) AS count FROM teachers")->fetch_assoc()['count'];
$total_classes  = $conn->query("SELECT COUNT(*) AS count FROM classes")->fetch_assoc()['count'];
// $total_subjects = $conn->query("SELECT COUNT(*) AS count FROM subjects")->fetch_assoc()['count'];

// Get recent students (last 5 by id)
$recent_students = $conn->query("SELECT student_id, name, class, roll, cgpa FROM students ORDER BY id DESC LIMIT 5");
?>

<!-- Quick Stats Cards -->
<div class="row mb-4">
  <div class="col-md-3 mb-3">
    <div class="card text-white bg-primary">
      <div class="card-body text-center">
        <i class="bi bi-people-fill fs-2"></i>
        <h2><?= $total_students ?></h2>
        <h5>Total Students</h5>
      </div>
    </div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card text-white bg-success">
      <div class="card-body text-center">
        <i class="bi bi-person-badge-fill fs-2"></i>
        <h2><?= $total_teachers ?></h2>
        <h5>Total Teachers</h5>
      </div>
    </div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card text-white bg-warning">
      <div class="card-body text-center">
        <i class="bi bi-journal-bookmark-fill fs-2"></i>
        <h2><?= $total_classes ?></h2>
        <h5>Total Classes</h5>
      </div>
    </div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card text-white bg-danger">
      <div class="card-body text-center">
        <i class="bi bi-book-fill fs-2"></i>
        <h2><?= $total_subjects ?></h2>
        <h5>Total Subjects</h5>
      </div>
    </div>
  </div>
</div>

<!-- Quick Links -->
<div class="mb-4">
  <h5>Quick Actions</h5>
  <div class="d-flex gap-2 flex-wrap">
    <a href="student-list.php" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Add Student</a>
    <a href="teachers.php" class="btn btn-success"><i class="bi bi-plus-circle me-1"></i> Add Teacher</a>
    <a href="class-list.php" class="btn btn-warning"><i class="bi bi-plus-circle me-1"></i> Add Class</a>
    <a href="subjects.php" class="btn btn-danger"><i class="bi bi-plus-circle me-1"></i> Add Subject</a>
  </div>
</div>

<!-- Recent Activity Table -->
<div class="card mb-4">
  <div class="card-header bg-dark text-white">Recent Students</div>
  <div class="card-body table-responsive">
    <table class="table table-striped table-bordered align-middle text-center">
      <thead class="table-dark">
        <tr>
          <th>Student ID</th>
          <th>Name</th>
          <th>Class</th>
          <th>Roll</th>
          <th>CGPA</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($recent_students->num_rows > 0): ?>
          <?php while($row = $recent_students->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['student_id']) ?></td>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td><?= htmlspecialchars($row['class']) ?></td>
              <td><?= htmlspecialchars($row['roll']) ?></td>
              <td><?= htmlspecialchars($row['cgpa']) ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="5">No students found</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
