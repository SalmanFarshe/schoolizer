<?php
  require('backend/config/config.php');
  require('backend/config/auth.php');
  restrict_page(['teacher']); 
?>
<?php $active_page = 'mark-submission.php'; ?>
<?php include("backend/path.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Submit Marks | Schoolizer</title>
  <?php require_once("includes/link.php"); ?>
</head>
<body>
  <?php require_once("includes/sidebar.php"); ?>

  <div class="main-content p-4">
    <div class="container">

      <!-- Page Heading -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Submit Marks</h1>
        <button class="btn button" data-bs-toggle="modal" data-bs-target="#submitMarksModal">
          <i class="bi bi-plus-circle me-1"></i> Add Marks
        </button>
      </div>

      <!-- Marks Filter -->
      <div class="card mb-4">
        <div class="card-header bg-dark text-white">Filter Students</div>
        <div class="card-body">
          <form class="row g-3">
            <div class="col-md-3">
              <label class="form-label">Class</label>
              <select class="form-select" name="class_select" required>
                <option value="" selected>Select Class</option>
                <option value="10A">Class 10 - A</option>
                <option value="10B">Class 10 - B</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label">Subject</label>
              <select class="form-select" name="subject_select" required>
                <option value="" selected>Select Subject</option>
                <option value="math">Mathematics</option>
                <option value="physics">Physics</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label">Exam</label>
              <select class="form-select" name="exam_select" required>
                <option value="" selected>Select Exam</option>
                <option value="midterm">Mid Term</option>
                <option value="final">Final</option>
              </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
              <button type="submit" class="btn btn-primary w-100">Load Students</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Student Marks Table -->
      <div class="card">
        <div class="card-header bg-dark text-white">Students</div>
        <div class="card-body table-responsive">
          <table class="table table-striped table-bordered align-middle text-center">
            <thead class="table-dark">
              <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>MCS</th>
                <th>CQ</th>
                <th>Quiz</th>
                <th>Attendance</th>
                <th>Total Marks</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example Student Row -->
              <tr>
                <td>STU120</td>
                <td>John Doe</td>
                <td><input type="number" class="form-control" min="0" max="20" placeholder="MCS"></td>
                <td><input type="number" class="form-control" min="0" max="30" placeholder="CQ"></td>
                <td><input type="number" class="form-control" min="0" max="10" placeholder="Quiz"></td>
                <td><input type="number" class="form-control" min="0" max="5" placeholder="Attendance"></td>
                <td>0</td>
                <td>
                  <button class="btn btn-success btn-sm">Submit</button>
                </td>
              </tr>
              <tr>
                <td>STU121</td>
                <td>Jane Smith</td>
                <td><input type="number" class="form-control" min="0" max="20" placeholder="MCS"></td>
                <td><input type="number" class="form-control" min="0" max="30" placeholder="CQ"></td>
                <td><input type="number" class="form-control" min="0" max="10" placeholder="Quiz"></td>
                <td><input type="number" class="form-control" min="0" max="5" placeholder="Attendance"></td>
                <td>0</td>
                <td>
                  <button class="btn btn-success btn-sm">Submit</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>

  <!-- Optional: Add Marks Modal -->
  <div class="modal fade zoom-in" id="submitMarksModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title">Add / Update Marks</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p class="text-muted">You can also add marks for multiple students at once here.</p>
          <!-- Placeholder for modal content -->
          <form>
            <div class="row g-3">
              <div class="col-md-4">
                <label class="form-label">Student</label>
                <select class="form-select">
                  <option>Select Student</option>
                  <option>John Doe</option>
                  <option>Jane Smith</option>
                </select>
              </div>
              <div class="col-md-2">
                <label class="form-label">MCS</label>
                <input type="number" class="form-control" min="0" max="20">
              </div>
              <div class="col-md-2">
                <label class="form-label">CQ</label>
                <input type="number" class="form-control" min="0" max="30">
              </div>
              <div class="col-md-2">
                <label class="form-label">Quiz</label>
                <input type="number" class="form-control" min="0" max="10">
              </div>
              <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-success w-100">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
