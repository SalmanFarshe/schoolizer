<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['admin']); 

$active_page = 'exams.php';
include("backend/path.php");

// Fetch all classes
$classesQuery = mysqli_query($conn, "SELECT * FROM `classes` ORDER BY class_name, section");
if(!$classesQuery) die("Classes Query Failed: " . mysqli_error($conn));
$classes = mysqli_fetch_all($classesQuery, MYSQLI_ASSOC);

// Fetch all subjects
$subjectsQuery = mysqli_query($conn, "SELECT * FROM `subjects` ORDER BY subject_name");
if(!$subjectsQuery) die("Subjects Query Failed: " . mysqli_error($conn));
$subjects = mysqli_fetch_all($subjectsQuery, MYSQLI_ASSOC);

// Fetch all exams with class name
$examsQuery = mysqli_query($conn, "
    SELECT e.id, e.exam_name, e.class_id, e.exam_date, e.duration, c.class_name, c.section
    FROM `exams` e
    JOIN `classes` c ON e.class_id = c.id
    ORDER BY e.id DESC
");
if(!$examsQuery) die("Exams Query Failed: " . mysqli_error($conn));
$exams = mysqli_fetch_all($examsQuery, MYSQLI_ASSOC);

// Function to get subjects for an exam
function getExamSubjects($conn, $exam_id){
    $query = mysqli_query($conn, "
        SELECT s.subject_name 
        FROM exam_subjects es 
        JOIN subjects s ON es.subject_id=s.id 
        WHERE es.exam_id='$exam_id'
    ");
    if(!$query) return [];
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
    return array_column($result, 'subject_name');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Exam Management | Schoolizer</title>
<?php require_once("includes/link.php"); ?>
</head>
<body>
<?php require_once("includes/sidebar.php"); ?>

<div class="main-content p-4">
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Exams</h1>
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#addExamModal">
      <i class="bi bi-plus-circle me-1"></i> Add Exam
    </button>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-hover table-bordered text-center align-middle">
      <thead class="table-dark">
        <tr>
          <th>Exam ID</th>
          <th>Exam Name</th>
          <th>Class</th>
          <th>Subjects</th>
          <th>Date</th>
          <th>Duration</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
<?php foreach($exams as $exam):
    $subjectNames = implode(', ', getExamSubjects($conn, $exam['id']));
?>
<tr>
    <td><?= $exam['id'] ?></td>
    <td><?= $exam['exam_name'] ?></td>
    <td><?= $exam['class_name'].' - '.$exam['section'] ?></td>
    <td><?= $subjectNames ?></td>
    <td><?= $exam['exam_date'] ?></td>
    <td><?= $exam['duration'] ?></td>
    <td class="d-flex justify-content-center gap-1">
        <button class="btn btn-primary btn-sm editExamBtn" 
            data-id="<?= $exam['id'] ?>" 
            data-name="<?= $exam['exam_name'] ?>" 
            data-class="<?= $exam['class_id'] ?>" 
            data-subjects="<?= $subjectNames ?>" 
            data-date="<?= $exam['exam_date'] ?>" 
            data-duration="<?= $exam['duration'] ?>" 
            data-bs-toggle="modal" data-bs-target="#editExamModal" 
            title="Edit">
            <i class="bi bi-pencil-square"></i>
        </button>
        <button class="btn btn-danger btn-sm deleteExamBtn" 
            data-id="<?= $exam['id'] ?>" 
            data-bs-toggle="modal" data-bs-target="#deleteExamModal" 
            title="Delete">
            <i class="bi bi-trash"></i>
        </button>
    </td>
</tr>
<?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
</div>

<!-- Add Exam Modal -->
<div class="modal fade" id="addExamModal" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">
<div class="modal-header bg-dark text-white">
  <h5 class="modal-title">Add Exam</h5>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
  <form id="addExamForm" method="POST" action="processes/add-exam.php">
    <div class="mb-3">
      <label class="form-label">Exam Name</label>
      <input type="text" class="form-control" name="exam_name" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Class</label>
      <select class="form-select" name="exam_class" required>
        <option value="">Select Class</option>
        <?php foreach($classes as $cls): ?>
          <option value="<?= $cls['id'] ?>"><?= $cls['class_name'].' - '.$cls['section'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Subjects</label>
      <select class="form-select" name="exam_subjects[]" multiple required>
        <?php foreach($subjects as $sub): ?>
            <option value="<?= $sub['id'] ?>"><?= $sub['subject_name'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Date</label>
      <input type="date" class="form-control" name="exam_date" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Duration</label>
      <input type="text" class="form-control" name="exam_duration" placeholder="e.g., 2 Hours" required>
    </div>
    <div class="text-end">
      <button type="submit" class="btn btn-success">Add Exam</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    </div>
  </form>
</div>
</div>
</div>
</div>

<!-- Edit Exam Modal -->
<div class="modal fade" id="editExamModal" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">
<div class="modal-header bg-dark text-white">
  <h5 class="modal-title">Edit Exam</h5>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
  <form id="editExamForm" method="POST" action="processes/edit-exam.php">
    <input type="hidden" name="exam_id" id="edit_exam_id">
    <div class="mb-3">
      <label class="form-label">Exam Name</label>
      <input type="text" class="form-control" name="exam_name" id="edit_exam_name" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Class</label>
      <select class="form-select" name="exam_class" id="edit_exam_class" required>
        <?php foreach($classes as $cls): ?>
          <option value="<?= $cls['id'] ?>"><?= $cls['class_name'].' - '.$cls['section'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Subjects</label>
      <select class="form-select" name="exam_subjects[]" id="edit_exam_subjects" multiple required>
        <?php foreach($subjects as $sub): ?>
            <option value="<?= $sub['id'] ?>"><?= $sub['subject_name'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Date</label>
      <input type="date" class="form-control" name="exam_date" id="edit_exam_date" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Duration</label>
      <input type="text" class="form-control" name="exam_duration" id="edit_exam_duration" required>
    </div>
    <div class="text-end">
      <button type="submit" class="btn btn-success">Update Exam</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    </div>
  </form>
</div>
</div>
</div>
</div>

<!-- Delete Exam Modal -->
<div class="modal fade" id="deleteExamModal" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
<div class="modal-header bg-dark text-white">
  <h5 class="modal-title">Delete Exam</h5>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
  <p>Are you sure you want to delete this exam?</p>
  <form method="POST" action="processes/delete-exam.php">
    <input type="hidden" name="exam_id" id="delete_exam_id">
    <div class="text-end">
      <button type="submit" class="btn btn-danger">Delete</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    </div>
  </form>
</div>
</div>
</div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
    // Fill Edit Modal
    document.querySelectorAll('.editExamBtn').forEach(btn=>{
        btn.addEventListener('click', function(){
            document.getElementById('edit_exam_id').value = this.dataset.id;
            document.getElementById('edit_exam_name').value = this.dataset.name;
            document.getElementById('edit_exam_class').value = this.dataset.class;
            document.getElementById('edit_exam_date').value = this.dataset.date;
            document.getElementById('edit_exam_duration').value = this.dataset.duration;

            let subjects = this.dataset.subjects.split(',').map(s => s.trim());
            let select = document.getElementById('edit_exam_subjects');
            Array.from(select.options).forEach(opt=>{
                opt.selected = subjects.includes(opt.text);
            });
        });
    });

    // Fill Delete Modal
    document.querySelectorAll('.deleteExamBtn').forEach(btn=>{
        btn.addEventListener('click', function(){
            document.getElementById('delete_exam_id').value = this.dataset.id;
        });
    });
});
</script>
</body>
</html>
