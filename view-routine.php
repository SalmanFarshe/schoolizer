<?php
  require('backend/config/config.php');
  require('backend/config/auth.php');
  restrict_page(['admin','teacher']); 
?>
<?php $active_page = 'view-routine.php'; ?>
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
        <?php if($_SESSION['role'] === 'admin'): ?>
          <button class="btn button" data-bs-toggle="modal" data-bs-target="#addRoutineModal">
            <i class="bi bi-plus-circle me-1"></i> Add Routine
          </button>
        <?php endif; ?>
      </div>

      <!-- Filter Routine -->
      <div class="card mb-4">
        <div class="card-header bg-dark text-white">Select Class / Section</div>
        <div class="card-body">
          <form class="row g-3">
            <div class="col-md-4">
              <label class="form-label">Class</label>
              <select class="form-select" name="class_select">
                <option selected>Select Class</option>
                <option value="10">Class 10</option>
                <option value="9">Class 9</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Section</label>
              <select class="form-select" name="section_select">
                <option selected>Select Section</option>
                <option value="A">A</option>
                <option value="B">B</option>
              </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
              <button type="submit" class="btn btn-primary w-100">Load Routine</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Routine Table -->
      <div class="card">
        <div class="card-header bg-dark text-white">Routine</div>
        <div class="card-body table-responsive">
          <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
              <tr>
                <th>Day / Time</th>
                <th>08:00-09:00</th>
                <th>09:00-10:00</th>
                <th>10:00-11:00</th>
                <th>11:00-12:00</th>
                <th>12:00-01:00</th>
                <th>01:00-02:00</th>
                <th>02:00-03:00</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Monday</td>
                <td>Math</td>
                <td>Physics</td>
                <td>Chemistry</td>
                <td>English</td>
                <td>Break</td>
                <td>Biology</td>
                <td>History</td>
              </tr>
              <tr>
                <td>Tuesday</td>
                <td>English</td>
                <td>Math</td>
                <td>Physics</td>
                <td>Chemistry</td>
                <td>Break</td>
                <td>Biology</td>
                <td>Geography</td>
              </tr>
              <tr>
                <td>Wednesday</td>
                <td>History</td>
                <td>Math</td>
                <td>Physics</td>
                <td>English</td>
                <td>Break</td>
                <td>Chemistry</td>
                <td>Biology</td>
              </tr>
              <!-- Add more days -->
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>

  <!-- Add Routine Modal (Admin Only) -->
  <?php if($_SESSION['role'] === 'admin'): ?>
  <div class="modal fade zoom-in" id="addRoutineModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title">Add / Edit Routine</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="row g-3 mb-3">
              <div class="col-md-4">
                <label class="form-label">Class</label>
                <select class="form-select">
                  <option value="" selected>Select Class</option>
                  <option value="10">Class 10</option>
                  <option value="9">Class 9</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">Section</label>
                <select class="form-select">
                  <option value="" selected>Select Section</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">Day</label>
                <select class="form-select">
                  <option value="" selected>Select Day</option>
                  <option value="Monday">Monday</option>
                  <option value="Tuesday">Tuesday</option>
                  <option value="Wednesday">Wednesday</option>
                  <option value="Thursday">Thursday</option>
                  <option value="Friday">Friday</option>
                </select>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Time Slots</label>
              <div class="row g-2">
                <div class="col-md-3">
                  <input type="text" class="form-control" placeholder="08:00-09:00">
                </div>
                <div class="col-md-3">
                  <input type="text" class="form-control" placeholder="09:00-10:00">
                </div>
                <div class="col-md-3">
                  <input type="text" class="form-control" placeholder="10:00-11:00">
                </div>
                <div class="col-md-3">
                  <input type="text" class="form-control" placeholder="11:00-12:00">
                </div>
                <div class="col-md-3 mt-2">
                  <input type="text" class="form-control" placeholder="12:00-01:00">
                </div>
                <div class="col-md-3 mt-2">
                  <input type="text" class="form-control" placeholder="01:00-02:00">
                </div>
                <div class="col-md-3 mt-2">
                  <input type="text" class="form-control" placeholder="02:00-03:00">
                </div>
              </div>
            </div>

            <div class="text-end">
              <button type="submit" class="btn btn-success">Save Routine</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
