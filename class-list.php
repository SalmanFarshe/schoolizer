<?php 
  $active_page = 'class-list.php'; 
  
  // Only admin can access
  require('backend/config/auth.php');
  restrict_page(['admin']);

  include("backend/path.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Classes | Schoolizer</title>
  <?php require_once("includes/link.php"); ?>
</head>
<body>
  <?php require_once("includes/sidebar.php"); ?>

  <!-- Main Content -->
  <div class="main-content p-4">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">School Classes</h1>
        <!-- Add Class Button -->
        <button type="button" class="btn button" data-bs-toggle="modal" data-bs-target="#addClassModal">
          <i class="bi bi-plus-circle me-1"></i> Add Class
        </button>
      </div>
      <p class="text-muted">Below is the list of all classes in the school.</p>

      <!-- Classes Table -->
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle text-center">
          <thead class="table-dark">
            <tr>
              <th>Class ID</th>
              <th>Class Name</th>
              <th>Section</th>
              <th>Teacher In Charge</th>
              <th>Number of Students</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Example Row 1 -->
            <tr>
              <td>CLS001</td>
              <td>10</td>
              <td>A</td>
              <td>Mr. John Smith</td>
              <td>45</td>
              <td class="d-flex justify-content-center gap-1">
                <button class="btn btn-primary btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#viewClassModal"
                        data-id="CLS001"
                        data-name="10"
                        data-section="A"
                        data-teacher="Mr. John Smith"
                        data-students="45"
                        title="View">
                  <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-warning btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editClassModal"
                        data-id="CLS001"
                        data-name="10"
                        data-section="A"
                        data-teacher="Mr. John Smith"
                        data-students="45"
                        title="Edit">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button class="btn btn-danger btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteClassModal"
                        data-id="CLS001"
                        data-name="10"
                        title="Delete">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>

            <!-- Example Row 2 -->
            <tr>
              <td>CLS002</td>
              <td>10</td>
              <td>B</td>
              <td>Ms. Jane Doe</td>
              <td>42</td>
              <td class="d-flex justify-content-center gap-1">
                <button class="btn btn-primary btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#viewClassModal"
                        data-id="CLS002"
                        data-name="10"
                        data-section="B"
                        data-teacher="Ms. Jane Doe"
                        data-students="42"
                        title="View">
                  <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-warning btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editClassModal"
                        data-id="CLS002"
                        data-name="10"
                        data-section="B"
                        data-teacher="Ms. Jane Doe"
                        data-students="42"
                        title="Edit">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button class="btn btn-danger btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteClassModal"
                        data-id="CLS002"
                        data-name="10"
                        title="Delete">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Modals -->

      <!-- Add Class Modal -->
      <div class="modal fade zoom-in" id="addClassModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white">
              <h5 class="modal-title">Add New Class</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form action="add-class-process.php" method="POST">
                <div class="mb-3">
                  <label class="form-label">Class Name</label>
                  <input type="text" class="form-control" name="class_name" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Section</label>
                  <input type="text" class="form-control" name="section">
                </div>
                <div class="mb-3">
                  <label class="form-label">Teacher In Charge</label>
                  <input type="text" class="form-control" name="teacher_in_charge">
                </div>
                <div class="mb-3">
                  <label class="form-label">Number of Students</label>
                  <input type="number" class="form-control" name="num_students">
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

      <!-- View Class Modal -->
      <div class="modal fade" id="viewClassModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white">
              <h5 class="modal-title">Class Details</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <h4 id="viewClassName">Class: </h4>
              <p><b>Section:</b> <span id="viewClassSection"></span></p>
              <p><b>Teacher In Charge:</b> <span id="viewClassTeacher"></span></p>
              <p><b>Number of Students:</b> <span id="viewClassStudents"></span></p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Edit Class Modal -->
      <div class="modal fade" id="editClassModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
              <h5 class="modal-title">Edit Class</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form id="editClassForm">
                <input type="hidden" id="editClassId" name="class_id">
                <div class="mb-3">
                  <label class="form-label">Class Name</label>
                  <input type="text" class="form-control" id="editClassName" name="class_name">
                </div>
                <div class="mb-3">
                  <label class="form-label">Section</label>
                  <input type="text" class="form-control" id="editClassSection" name="section">
                </div>
                <div class="mb-3">
                  <label class="form-label">Teacher In Charge</label>
                  <input type="text" class="form-control" id="editClassTeacher" name="teacher_in_charge">
                </div>
                <div class="mb-3">
                  <label class="form-label">Number of Students</label>
                  <input type="number" class="form-control" id="editClassStudents" name="num_students">
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

      <!-- Delete Class Modal -->
      <div class="modal fade" id="deleteClassModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title">Delete Class</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete class <b id="deleteClassName"></b>?</p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-danger" id="confirmDeleteClassBtn">Yes, Delete</button>
              <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script>
    // View Class Modal
    var viewClassModal = document.getElementById('viewClassModal');
    viewClassModal.addEventListener('show.bs.modal', function(event){
      var button = event.relatedTarget;
      document.getElementById('viewClassName').innerText = "Class: " + button.dataset.name;
      document.getElementById('viewClassSection').innerText = button.dataset.section;
      document.getElementById('viewClassTeacher').innerText = button.dataset.teacher;
      document.getElementById('viewClassStudents').innerText = button.dataset.students;
    });

    // Edit Class Modal
    var editClassModal = document.getElementById('editClassModal');
    editClassModal.addEventListener('show.bs.modal', function(event){
      var button = event.relatedTarget;
      document.getElementById('editClassId').value = button.dataset.id;
      document.getElementById('editClassName').value = button.dataset.name;
      document.getElementById('editClassSection').value = button.dataset.section;
      document.getElementById('editClassTeacher').value = button.dataset.teacher;
      document.getElementById('editClassStudents').value = button.dataset.students;
    });

    // Delete Class Modal
    var deleteClassModal = document.getElementById('deleteClassModal');
    deleteClassModal.addEventListener('show.bs.modal', function(event){
      var button = event.relatedTarget;
      document.getElementById('deleteClassName').innerText = button.dataset.name;
    });
  </script>
</body>
</html>
