<?php $active_page = 'exams.php'; ?>
<?php include("backend/path.php"); ?>
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
        <!-- Example Row -->
        <tr>
          <td>EX001</td>
          <td>Midterm Exam</td>
          <td>10</td>
          <td>Math, English</td>
          <td>2025-09-20</td>
          <td>2 Hours</td>
          <td class="d-flex justify-content-center gap-1">
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewExamModal" title="View">
              <i class="bi bi-eye"></i>
            </button>
            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editExamModal" title="Edit">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteExamModal" title="Delete">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
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
  <form id="addExamForm">
    <div class="mb-3">
      <label class="form-label">Exam Name</label>
      <input type="text" class="form-control" name="exam_name" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Class</label>
      <select class="form-select" name="exam_class" required>
        <option value="">Select Class</option>
        <option value="10">10</option>
        <option value="9">9</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Subjects</label>
      <select class="form-select" name="exam_subjects[]" multiple required>
        <option value="Math">Math</option>
        <option value="English">English</option>
        <option value="Physics">Physics</option>
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

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
