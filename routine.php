<?php $active_page = 'routine.php'; ?>
<?php include("backend/path.php"); ?>
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
        <!-- Example Row -->
        <tr>
          <td>10</td>
          <td>Monday</td>
          <td>Math</td>
          <td>Mr. John</td>
          <td>09:00 AM</td>
          <td>09:45 AM</td>
          <td class="d-flex justify-content-center gap-1">
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewRoutineModal" title="View">
              <i class="bi bi-eye"></i>
            </button>
            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editRoutineModal" title="Edit">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteRoutineModal" title="Delete">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
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
  <form id="addRoutineForm">
    <div class="mb-3">
      <label class="form-label">Class</label>
      <select class="form-select" name="class" required>
        <option value="">Select Class</option>
        <option value="10">10</option>
        <option value="9">9</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Day</label>
      <select class="form-select" name="day" required>
        <option value="">Select Day</option>
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Subject</label>
      <select class="form-select" name="subject" required>
        <option value="">Select Subject</option>
        <option value="Math">Math</option>
        <option value="English">English</option>
        <option value="Physics">Physics</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Teacher</label>
      <input type="text" class="form-control" name="teacher" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Start Time</label>
      <input type="time" class="form-control" name="start_time" required>
    </div>
    <div class="mb-3">
      <label class="form-label">End Time</label>
      <input type="time" class="form-control" name="end_time" required>
    </div>
    <div class="text-end">
      <button type="submit" class="btn btn-success">Add Routine</button>
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
