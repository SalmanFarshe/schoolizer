<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['admin']);
$active_page = 'routine.php';
include("backend/path.php");

// Fetch dynamic data
$classes = $conn->query("SELECT * FROM classes ORDER BY class_name ASC");
$teachers = $conn->query("SELECT * FROM teachers ORDER BY name ASC");

// Fetch subjects with class names
$subjects = [];
$subjectRes = $conn->query("SELECT s.*, c.class_name FROM subjects s LEFT JOIN classes c ON s.class_id=c.id ORDER BY c.class_name, s.subject_name");
while($s = $subjectRes->fetch_assoc()){
    $subjects[] = $s;
}

// Fetch class routine with joins
$routineRes = $conn->query("
    SELECT r.*, c.class_name, s.subject_name, t.name AS teacher_name
    FROM class_routine r
    LEFT JOIN classes c ON r.class_id=c.id
    LEFT JOIN subjects s ON r.subject_id=s.id
    LEFT JOIN teachers t ON r.teacher_id=t.id
    ORDER BY c.class_name, FIELD(r.day,'Monday','Tuesday','Wednesday','Thursday','Friday'), r.start_time
");
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
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#addRoutineModal">
      <i class="bi bi-plus-circle me-1"></i> Add Routine
    </button>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-hover table-bordered text-center align-middle">
      <thead class="table-dark">
        <tr>
          <th>Class</th>
          <th>Day</th>
          <th>Subject</th>
          <th>Teacher</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if($routineRes->num_rows > 0): ?>
          <?php while($row = $routineRes->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['class_name']) ?></td>
              <td><?= htmlspecialchars($row['day']) ?></td>
              <td><?= htmlspecialchars($row['subject_name']) ?></td>
              <td><?= htmlspecialchars($row['teacher_name']) ?></td>
              <td><?= htmlspecialchars(date("h:i A", strtotime($row['start_time']))) ?></td>
              <td><?= htmlspecialchars(date("h:i A", strtotime($row['end_time']))) ?></td>
              <td class="d-flex justify-content-center gap-1">
                <button class="btn btn-warning btn-sm editRoutineBtn" 
                      data-bs-toggle="modal" data-bs-target="#editRoutineModal"
                      data-id="<?= $row['id'] ?>"
                      data-class="<?= $row['class_id'] ?>"
                      data-day="<?= $row['day'] ?>"
                      data-subject="<?= $row['subject_id'] ?>"
                      data-teacher="<?= $row['teacher_id'] ?>"
                      data-start="<?= $row['start_time'] ?>"
                      data-end="<?= $row['end_time'] ?>"
                      title="Edit">
                <i class="bi bi-pencil-square"></i>
              </button>

               <!-- Delete Button -->
                <button class="btn btn-danger btn-sm deleteRoutineBtn" 
                        data-bs-toggle="modal" data-bs-target="#deleteRoutineModal"
                        data-id="<?= $row['id'] ?>"
                        data-class="<?= htmlspecialchars($row['class_name']) ?>"
                        data-day="<?= $row['day'] ?>"
                        data-subject="<?= htmlspecialchars($row['subject_name']) ?>"
                        title="Delete">
                    <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="7">No routine found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
</div>

<!-- Add Routine Modal -->
<div class="modal fade" id="addRoutineModal" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">
<div class="modal-header bg-dark text-white">
  <h5 class="modal-title">Add Class Routine</h5>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
  <form id="addRoutineForm" method="post" action="processes/add-routine-process.php">

    <!-- Class -->
    <div class="mb-3">
      <label class="form-label">Class</label>
      <select class="form-select" name="class_id" required>
        <option value="">Select Class</option>
        <?php while($c = $classes->fetch_assoc()): ?>
          <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['class_name']) ?> <?= $c['section'] ? '(' . htmlspecialchars($c['section']) . ')' : '' ?></option>
        <?php endwhile; ?>
      </select>
    </div>

    <!-- Day -->
    <div class="mb-3">
      <label class="form-label">Day</label>
      <select class="form-select" name="day" required>
        <option value="">Select Day</option>
        <?php 
        $days = ['Monday','Tuesday','Wednesday','Thursday','Friday'];
        foreach($days as $day): ?>
          <option value="<?= $day ?>"><?= $day ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Subject -->
    <div class="mb-3">
      <label class="form-label">Subject</label>
      <select class="form-select" name="subject_id" required>
        <option value="">Select Subject</option>
        <?php foreach($subjects as $sub): ?>
          <option value="<?= $sub['id'] ?>" data-class="<?= $sub['class_id'] ?>">
            <?= htmlspecialchars($sub['subject_name']) ?> (<?= htmlspecialchars($sub['class_name']) ?>)
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Teacher -->
    <div class="mb-3">
      <label class="form-label">Teacher</label>
      <select class="form-select" name="teacher_id" required>
        <option value="">Select Teacher</option>
        <?php while($t = $teachers->fetch_assoc()): ?>
          <option value="<?= $t['id'] ?>"><?= htmlspecialchars($t['name']) ?></option>
        <?php endwhile; ?>
      </select>
    </div>

    <!-- Start & End Time -->
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Start Time</label>
        <input type="time" class="form-control" name="start_time" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">End Time</label>
        <input type="time" class="form-control" name="end_time" required>
      </div>
    </div>

    <div class="text-end mt-3">
      <button type="submit" class="btn btn-success">Add Routine</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    </div>

  </form>
</div>
</div>
</div>
</div>

<!-- Edit Routine Modal -->
<div class="modal fade" id="editRoutineModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg">

      <!-- Modal Header -->
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-pencil-square me-2"></i> Edit Class Routine
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <form id="editRoutineForm" action="processes/edit-routine-process.php" method="POST">
          <!-- Hidden ID -->
          <input type="hidden" name="routine_id" id="editRoutineID">

          <div class="mb-3">
            <label class="form-label">Class</label>
            <select class="form-select" name="class_id" id="editClass" required>
              <option value="">Select Class</option>
              <?php
              $classes = $conn->query("SELECT id, class_name, section FROM classes ORDER BY class_name ASC");
              while ($row = $classes->fetch_assoc()):
              ?>
                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['class_name'] . ($row['section'] ? " ({$row['section']})" : "")) ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Day</label>
            <select class="form-select" name="day" id="editDay" required>
              <option value="">Select Day</option>
              <?php foreach(['Monday','Tuesday','Wednesday','Thursday','Friday'] as $d): ?>
                <option value="<?= $d ?>"><?= $d ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Subject</label>
            <select class="form-select" name="subject_id" id="editSubject" required>
              <option value="">Select Subject</option>
              <?php
              $subjects = $conn->query("SELECT id, subject_name FROM subjects ORDER BY subject_name ASC");
              while ($row = $subjects->fetch_assoc()):
              ?>
                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['subject_name']) ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Teacher</label>
            <select class="form-select" name="teacher_id" id="editTeacher" required>
              <option value="">Select Teacher</option>
              <?php
              $teachers = $conn->query("SELECT id, name FROM teachers ORDER BY name ASC");
              while ($row = $teachers->fetch_assoc()):
              ?>
                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
              <?php endwhile; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Start Time</label>
            <input type="time" class="form-control" name="start_time" id="editStartTime" required>
          </div>

          <div class="mb-3">
            <label class="form-label">End Time</label>
            <input type="time" class="form-control" name="end_time" id="editEndTime" required>
          </div>

          <div class="text-end">
            <button type="submit" class="btn btn-warning px-4">Update Routine</button>
            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- Delete Routine Modal -->
<div class="modal fade" id="deleteRoutineModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg">

      <!-- Modal Header -->
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-trash me-2"></i> Delete Class Routine
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <p>Are you sure you want to delete the routine for <b id="deleteRoutineInfo">-</b>?</p>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <form id="deleteRoutineForm" action="processes/delete-routine-process.php" method="POST">
          <input type="hidden" name="routine_id" id="deleteRoutineID">
          <button type="submit" class="btn btn-danger px-4">Yes, Delete</button>
          <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancel</button>
        </form>
      </div>

    </div>
  </div>
</div>
<script>
const deleteButtons = document.querySelectorAll('.deleteRoutineBtn');
deleteButtons.forEach(btn => {
  btn.addEventListener('click', () => {
    const routineID = btn.dataset.id;
    const className = btn.dataset.class;
    const day = btn.dataset.day;
    const subject = btn.dataset.subject;

    document.getElementById('deleteRoutineID').value = routineID;
    document.getElementById('deleteRoutineInfo').textContent = `${className} - ${subject} on ${day}`;
  });
});
</script>

<script>
const editButtons = document.querySelectorAll('.editRoutineBtn');
editButtons.forEach(btn => {
  btn.addEventListener('click', () => {
    const routineID = btn.dataset.id;
    const classID = btn.dataset.class;
    const day = btn.dataset.day;
    const subjectID = btn.dataset.subject;
    const teacherID = btn.dataset.teacher;
    const startTime = btn.dataset.start;
    const endTime = btn.dataset.end;

    document.getElementById('editRoutineID').value = routineID;
    document.getElementById('editClass').value = classID;
    document.getElementById('editDay').value = day;
    document.getElementById('editSubject').value = subjectID;
    document.getElementById('editTeacher').value = teacherID;
    document.getElementById('editStartTime').value = startTime;
    document.getElementById('editEndTime').value = endTime;
  });
});
</script>


<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
