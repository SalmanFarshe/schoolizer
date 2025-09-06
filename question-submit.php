<?php
  require('backend/config/config.php');
  require('backend/config/auth.php');
  restrict_page(['teacher']); 
?>
<?php $active_page = 'question-submit.php'; ?>
<?php include("backend/path.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Submit Questions | Schoolizer</title>
  <?php require_once("includes/link.php"); ?>
</head>
<body>
  <?php require_once("includes/sidebar.php"); ?>

  <div class="main-content p-4">
    <div class="container">

      <!-- Page Heading -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Submit Questions</h1>
        <button class="btn button" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
          <i class="bi bi-plus-circle me-1"></i> Add Question
        </button>
      </div>

      <!-- Filter Form -->
      <div class="card mb-4">
        <div class="card-header bg-dark text-white">Select Exam / Class / Subject</div>
        <div class="card-body">
          <form class="row g-3">
            <div class="col-md-3">
              <label class="form-label">Exam</label>
              <select class="form-select" name="exam_select" required>
                <option value="" selected>Select Exam</option>
                <option value="midterm">Mid Term</option>
                <option value="final">Final</option>
              </select>
            </div>
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
            <div class="col-md-3 d-flex align-items-end">
              <button type="submit" class="btn btn-primary w-100">Load Questions</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Questions Table -->
      <div class="card">
        <div class="card-header bg-dark text-white">Questions</div>
        <div class="card-body table-responsive">
          <table class="table table-striped table-bordered align-middle text-center">
            <thead class="table-dark">
              <tr>
                <th>Question ID</th>
                <th>Question Text</th>
                <th>Marks</th>
                <th>Type</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- Example Row -->
              <tr>
                <td>Q001</td>
                <td>What is the formula for area of circle?</td>
                <td>5</td>
                <td>MCQ</td>
                <td>
                  <button class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></button>
                  <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
              <tr>
                <td>Q002</td>
                <td>Explain Newton's second law of motion.</td>
                <td>10</td>
                <td>Descriptive</td>
                <td>
                  <button class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></button>
                  <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>

  <!-- Add Question Modal -->
  <div class="modal fade zoom-in" id="addQuestionModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title">Add Question</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label class="form-label">Exam</label>
              <select class="form-select" required>
                <option value="" selected>Select Exam</option>
                <option value="midterm">Mid Term</option>
                <option value="final">Final</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Class</label>
              <select class="form-select" required>
                <option value="" selected>Select Class</option>
                <option value="10A">Class 10 - A</option>
                <option value="10B">Class 10 - B</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Subject</label>
              <select class="form-select" required>
                <option value="" selected>Select Subject</option>
                <option value="math">Mathematics</option>
                <option value="physics">Physics</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Question Text</label>
              <textarea class="form-control" rows="3" placeholder="Enter question here..." required></textarea>
            </div>
            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label">Marks</label>
                <input type="number" class="form-control" min="0" placeholder="Marks" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Question Type</label>
                <select class="form-select" required>
                  <option value="" selected>Select Type</option>
                  <option value="mcq">MCQ</option>
                  <option value="descriptive">Descriptive</option>
                  <option value="truefalse">True/False</option>
                </select>
              </div>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-success">Submit Question</button>
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
