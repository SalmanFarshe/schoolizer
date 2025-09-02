<?php 
  $active_page = 'class-list.php'; 
  
  // Only admin can access
  require('backend/config/auth.php');
  restrict_page(['admin']);

  include("backend/path.php");
  require('backend/config/config.php');

  // Fetch all classes
  $classes = $conn->query("SELECT * FROM classes ORDER BY id DESC");
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
            <?php if ($classes->num_rows > 0): ?>
              <?php while($row = $classes->fetch_assoc()): ?>
                <tr>
                  <td><?= htmlspecialchars($row['class_id']) ?></td>
                  <td><?= htmlspecialchars($row['class_name']) ?></td>
                  <td><?= htmlspecialchars($row['section']) ?></td>
                  <td><?= htmlspecialchars($row['teacher_in_charge']) ?></td>
                  <td><?= htmlspecialchars($row['num_students']) ?></td>
                  <td class="d-flex justify-content-center gap-1">
                    <!-- View -->
                    <button class="btn btn-primary btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#viewClassModal"
                            data-id="<?= $row['class_id'] ?>"
                            data-name="<?= $row['class_name'] ?>"
                            data-section="<?= $row['section'] ?>"
                            data-teacher="<?= $row['teacher_in_charge'] ?>"
                            data-students="<?= $row['num_students'] ?>"
                            title="View">
                      <i class="bi bi-eye"></i>
                    </button>
                    <!-- Edit -->
                    <button class="btn btn-warning btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editClassModal"
                            data-id="<?= $row['class_id'] ?>"
                            data-name="<?= $row['class_name'] ?>"
                            data-section="<?= $row['section'] ?>"
                            data-teacher="<?= $row['teacher_in_charge'] ?>"
                            data-students="<?= $row['num_students'] ?>"
                            title="Edit">
                      <i class="bi bi-pencil-square"></i>
                    </button>
                    <!-- Delete -->
                    <button class="btn btn-danger btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#deleteClassModal"
                            data-id="<?= $row['class_id'] ?>"
                            data-name="<?= $row['class_name'] ?>"
                            title="Delete">
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="6">No classes found</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

<!-- Add Class Modal -->
<div class="modal fade" id="addClassModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-3 shadow-lg">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Add New Class</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form action="backend/classes/add-class.php" method="POST">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Class Name</label>
            <input type="text" class="form-control" name="class_name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Section</label>
            <input type="text" class="form-control" name="section">
          </div>
          <div class="mb-3">
            <label class="form-label">Assign Teacher</label>
            <select class="form-select" name="teacher_id" required>
              <option value="" disabled selected>Select teacher</option>
              <?php
                // Load teachers from teachers table
                $result = $conn->query("SELECT id, name FROM teachers");
                while($row = $result->fetch_assoc()) {
                  echo "<option value='".$row['id']."'>".$row['name']."</option>";
                }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Room Number</label>
            <input type="text" class="form-control" name="room_no">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Class</button>
        </div>
      </form>
    </div>
  </div>
</div>


  <!-- View Class Modal -->
  <div class="modal fade" id="viewClassModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-3 shadow-lg">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title">View Class</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p><strong>Class Name:</strong> <span id="viewClassName"></span></p>
          <p><strong>Section:</strong> <span id="viewClassSection"></span></p>
          <p><strong>Teacher:</strong> <span id="viewClassTeacher"></span></p>
          <p><strong>Students:</strong> <span id="viewClassStudents"></span></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Class Modal -->
  <div class="modal fade" id="editClassModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-3 shadow-lg">
        <div class="modal-header bg-warning text-dark">
          <h5 class="modal-title">Edit Class</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <form action="backend/classes/edit-class.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="class_id" id="editClassId">
            <div class="mb-3">
              <label class="form-label">Class Name</label>
              <input type="text" class="form-control" name="class_name" id="editClassName" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Section</label>
              <input type="text" class="form-control" name="section" id="editClassSection">
            </div>
            <div class="mb-3">
              <label class="form-label">Teacher</label>
              <input type="text" class="form-control" name="teacher" id="editClassTeacher">
            </div>
            <div class="mb-3">
              <label class="form-label">Students</label>
              <input type="number" class="form-control" name="num_students" id="editClassStudents">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-warning">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete Class Modal -->
  <div class="modal fade" id="deleteClassModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-3 shadow-lg">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Delete Class</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="backend/classes/delete-class.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="class_id" id="deleteClassId">
            <p>Are you sure you want to delete <strong id="deleteClassName"></strong>?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script>
    // View
    var viewClassModal = document.getElementById('viewClassModal');
    viewClassModal.addEventListener('show.bs.modal', function(event){
      var button = event.relatedTarget;
      document.getElementById('viewClassName').innerText = button.dataset.name;
      document.getElementById('viewClassSection').innerText = button.dataset.section;
      document.getElementById('viewClassTeacher').innerText = button.dataset.teacher;
      document.getElementById('viewClassStudents').innerText = button.dataset.students;
    });

    // Edit
    var editClassModal = document.getElementById('editClassModal');
    editClassModal.addEventListener('show.bs.modal', function(event){
      var button = event.relatedTarget;
      document.getElementById('editClassId').value = button.dataset.id;
      document.getElementById('editClassName').value = button.dataset.name;
      document.getElementById('editClassSection').value = button.dataset.section;
      document.getElementById('editClassTeacher').value = button.dataset.teacher;
      document.getElementById('editClassStudents').value = button.dataset.students;
    });

    // Delete
    var deleteClassModal = document.getElementById('deleteClassModal');
    deleteClassModal.addEventListener('show.bs.modal', function(event){
      var button = event.relatedTarget;
      document.getElementById('deleteClassId').value = button.dataset.id;
      document.getElementById('deleteClassName').innerText = button.dataset.name;
    });
  </script>
</body>
</html>
