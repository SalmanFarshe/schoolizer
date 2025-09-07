<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['admin','teacher','student']); 

$active_page = 'view-routine.php';
include("backend/path.php");

$role = $_SESSION['role'];
$user_id = $_SESSION['user_id'];
$class_id = $_GET['class_id'] ?? null;

if ($role === 'admin') {
    $query = "SELECT cr.*, s.subject_name, t.name AS teacher_name, c.class_name
              FROM class_routine cr
              JOIN subjects s ON cr.subject_id = s.id
              JOIN teachers t ON cr.teacher_id = t.id
              JOIN classes c ON cr.class_id = c.id";
    if ($class_id) {
        $query .= " WHERE cr.class_id = " . intval($class_id);
    }
} elseif ($role === 'teacher') {
    $query = "SELECT cr.*, s.subject_name, t.name AS teacher_name, c.class_name
              FROM class_routine cr
              JOIN subjects s ON cr.subject_id = s.id
              JOIN teachers t ON cr.teacher_id = t.id
              JOIN classes c ON cr.class_id = c.id
              WHERE cr.teacher_id = " . intval($user_id);
} elseif ($role === 'student') {
    $stmt = $conn->prepare("SELECT class_id FROM students WHERE student_id=?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $stmt->bind_result($student_class_id);
    $stmt->fetch();
    $stmt->close();

    $query = "SELECT cr.*, s.subject_name, t.name AS teacher_name, c.class_name
              FROM class_routine cr
              JOIN subjects s ON cr.subject_id = s.id
              JOIN teachers t ON cr.teacher_id = t.id
              JOIN classes c ON cr.class_id = c.id
              WHERE cr.class_id = " . intval($student_class_id);
}

$result = $conn->query($query);
$routines = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Class Routine | Schoolizer</title>
<?php require_once("includes/link.php"); ?>
</head>
<body>
<?php require_once("includes/sidebar.php"); ?>

<div class="main-content p-4">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1 class="h3">Class Routine</h1>
      <?php if($role === 'admin'): ?>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoutineModal">
          <i class="bi bi-plus-circle me-1"></i> Add Routine
        </button>
      <?php endif; ?>
    </div>

    <div class="card">
      <div class="card-header bg-dark text-white">Routine</div>
      <div class="card-body table-responsive">
        <table class="table table-bordered text-center align-middle">
          <thead class="table-dark">
            <tr>
              <th>Day</th>
              <th>Class</th>
              <th>Subject</th>
              <th>Teacher</th>
              <th>Start</th>
              <th>End</th>
              <?php if($role === 'admin'): ?><th>Action</th><?php endif; ?>
            </tr>
          </thead>
          <tbody>
            <?php if($routines): ?>
              <?php foreach($routines as $r): ?>
                <tr>
                  <td><?= htmlspecialchars($r['day']) ?></td>
                  <td><?= htmlspecialchars($r['class_name']) ?></td>
                  <td><?= htmlspecialchars($r['subject_name']) ?></td>
                  <td><?= htmlspecialchars($r['teacher_name']) ?></td>
                  <td><?= htmlspecialchars($r['start_time']) ?></td>
                  <td><?= htmlspecialchars($r['end_time']) ?></td>
                  <?php if($role === 'admin'): ?>
                    <td>
                      <a href="backend/delete_routine.php?id=<?= $r['id'] ?>" 
                         class="btn btn-danger btn-sm"
                         onclick="return confirm('Delete this routine?')">Delete</a>
                    </td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr><td colspan="<?= ($role==='admin')?7:6 ?>">No routine found</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<!-- Add Routine Modal (Admin Only) -->
<?php if($role === 'admin'): ?>
<div class="modal fade" id="addRoutineModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" action="backend/save_routine.php">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title">Add Routine</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3 mb-3">
            <div class="col-md-4">
              <label class="form-label">Class</label>
              <select class="form-select" name="class_id" required>
                <option value="">Select Class</option>
                <?php
                $classRes = $conn->query("SELECT * FROM classes");
                while($c = $classRes->fetch_assoc()):
                ?>
                  <option value="<?= $c['id'] ?>"><?= $c['class_name'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Subject</label>
              <select class="form-select" name="subject_id" required>
                <option value="">Select Subject</option>
                <?php
                $subjectRes = $conn->query("SELECT * FROM subjects");
                while($s = $subjectRes->fetch_assoc()):
                ?>
                  <option value="<?= $s['id'] ?>"><?= $s['subject_name'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Teacher</label>
              <select class="form-select" name="teacher_id" required>
                <option value="">Select Teacher</option>
                <?php
                $teacherRes = $conn->query("SELECT * FROM teachers");
                while($t = $teacherRes->fetch_assoc()):
                ?>
                  <option value="<?= $t['id'] ?>"><?= $t['name'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-4">
              <label class="form-label">Day</label>
              <select class="form-select" name="day" required>
                <option value="">Select Day</option>
                <option>Monday</option>
                <option>Tuesday</option>
                <option>Wednesday</option>
                <option>Thursday</option>
                <option>Friday</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Start Time</label>
              <input type="time" name="start_time" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">End Time</label>
              <input type="time" name="end_time" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save Routine</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endif; ?>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
