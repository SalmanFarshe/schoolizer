<?php
    // Only admin can access
    require('backend/config/auth.php');
    restrict_page(['admin', 'teacher']);
  $active_page = 'student-list.php'; 
  include("backend/path.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students List | Schoolizer</title>
  <?php require_once("includes/link.php") ?>
</head>
<body>
  <?php require_once("includes/sidebar.php"); ?>

  <!-- Main Content -->
  <div class="main-content p-4">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Students List</h1>
        <!-- Add Student Button -->
        <button type="button" class="btn button" data-bs-toggle="modal" data-bs-target="#addStudentModal">
          <i class="bi bi-plus-circle me-1"></i> Add Student
        </button>
      </div>
      <p class="text-muted">Below is the list of all students.</p>

      <!-- Students Table -->
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle text-center">
          <thead class="table-dark">
            <tr>
              <th>Student ID</th>
              <th>Roll</th>
              <th>Name</th>
              <th>Class</th>
              <th>Father's Name</th>
              <th>Mother's Name</th>
              <th>CGPA</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Example Row 1 -->
            <tr>
              <td>STU001</td>
              <td>01</td>
              <td>John Doe</td>
              <td>10</td>
              <td>Michael Doe</td>
              <td>Sarah Doe</td>
              <td>3.85</td>
              <td class="d-flex justify-content-center gap-1">
                <!-- View Button -->
                <button class="btn btn-primary btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#viewModal"
                        data-id="STU001"
                        data-name="John Doe"
                        data-class="10"
                        data-roll="01"
                        data-cgpa="3.85"
                        data-father="Michael Doe"
                        data-mother="Sarah Doe"
                        title="View">
                  <i class="bi bi-eye"></i>
                </button>
                <!-- Edit Button -->
                <button class="btn btn-warning btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editModal"
                        data-id="STU001"
                        data-name="John Doe"
                        data-class="10"
                        data-roll="01"
                        title="Edit">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <!-- Delete Button -->
                <button class="btn btn-danger btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteModal"
                        data-id="STU001"
                        data-name="John Doe"
                        title="Delete">
                  <i class="bi bi-trash"></i>
                </button>
                <!-- Download Button -->
                <button class="btn btn-success btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#downloadModal"
                        data-id="STU001"
                        data-name="John Doe"
                        title="Download">
                  <i class="bi bi-download"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Modals -->

      <!-- View Modal -->
      <div class="modal fade" id="viewModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white">
              <h5 class="modal-title">Student Result Card</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <h4 id="viewName">Name: </h4>
              <p><b>Class:</b> <span id="viewClass"></span></p>
              <p><b>Roll:</b> <span id="viewRoll"></span></p>
              <p><b>Father’s Name:</b> <span id="viewFather"></span></p>
              <p><b>Mother’s Name:</b> <span id="viewMother"></span></p>
              <p><b>CGPA:</b> <span id="viewCgpa"></span></p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button class="btn btn-success">Download PDF</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Edit Modal -->
      <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark text-dark">
              <h5 class="modal-title">Edit Student</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form id="editForm">
                <input type="hidden" id="editId" name="student_id">
                <div class="mb-3">
                  <label class="form-label">Student Name</label>
                  <input type="text" class="form-control" id="editName" name="student_name">
                </div>
                <div class="mb-3">
                  <label class="form-label">Roll</label>
                  <input type="text" class="form-control" id="editRoll" name="student_roll">
                </div>
                <div class="mb-3">
                  <label class="form-label">Class</label>
                  <input type="text" class="form-control" id="editClass" name="student_class">
                </div>
                <div class="text-end">
                  <button type="submit" class="btn btn-success">Save Changes</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Delete Modal -->
      <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white">
              <h5 class="modal-title">Delete Student</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete <b id="deleteName"></b>?</p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
              <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Download Modal -->
      <div class="modal fade" id="downloadModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white">
              <h5 class="modal-title">Download Student Report</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p>Download report for <b id="downloadName"></b>.</p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success">Download PDF</button>
              <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Add Student Modal -->
      <div class="modal fade zoom-in" id="addStudentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white">
              <h5 class="modal-title">Add Student</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form action="add-student-process.php" method="POST">
                <div class="mb-3">
                  <label class="form-label">Student Name</label>
                  <input type="text" class="form-control" name="student_name" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Roll Number</label>
                  <input type="text" class="form-control" name="student_roll" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Class</label>
                  <input type="text" class="form-control" name="student_class" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" name="student_email">
                </div>
                <div class="text-end">
                  <button type="submit" class="btn btn-success">Save</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script>
    // View Modal
    var viewModal = document.getElementById('viewModal');
    viewModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      document.getElementById('viewName').innerText = "Name: " + button.dataset.name;
      document.getElementById('viewClass').innerText = button.dataset.class;
      document.getElementById('viewRoll').innerText = button.dataset.roll;
      document.getElementById('viewFather').innerText = button.dataset.father;
      document.getElementById('viewMother').innerText = button.dataset.mother;
      document.getElementById('viewCgpa').innerText = button.dataset.cgpa;
    });

    // Edit Modal
    var editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      document.getElementById('editId').value = button.dataset.id;
      document.getElementById('editName').value = button.dataset.name;
      document.getElementById('editRoll').value = button.dataset.roll;
      document.getElementById('editClass').value = button.dataset.class;
    });

    // Delete Modal
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      document.getElementById('deleteName').innerText = button.dataset.name;
    });

    // Download Modal
    var downloadModal = document.getElementById('downloadModal');
    downloadModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      document.getElementById('downloadName').innerText = button.dataset.name;
    });
  </script>
</body>
</html>
