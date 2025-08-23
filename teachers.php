<?php $active_page = 'teachers.php'; ?>
<?php include("backend/path.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teachers List | Schoolizer</title>
  <?php require_once("includes/link.php") ?>
</head>
<body>
  <?php require_once("includes/sidebar.php"); ?>

  <!-- Main Content -->
  <div class="main-content p-4">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Teachers List</h1>
        <!-- Add Teacher Button -->
        <button type="button" class="btn button" data-bs-toggle="modal" data-bs-target="#addTeacherModal">
          <i class="bi bi-plus-circle me-1"></i> Add Teacher
        </button>
      </div>
      <p class="text-muted">Below is the list of all teachers.</p>

      <!-- Teachers Table -->
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle text-center">
          <thead class="table-dark">
            <tr>
              <th>Teacher ID</th>
              <th>Name</th>
              <th>Department</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Example Row 1 -->
            <tr>
              <td>TEA001</td>
              <td>Mr. John Smith</td>
              <td>Computer Science</td>
              <td>john.smith@example.com</td>
              <td>+880123456789</td>
              <td class="d-flex justify-content-center gap-1">
                <button class="btn btn-primary btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#viewTeacherModal"
                        data-id="TEA001"
                        data-name="Mr. John Smith"
                        data-department="Computer Science"
                        data-email="john.smith@example.com"
                        data-phone="+880123456789"
                        title="View">
                  <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-warning btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editTeacherModal"
                        data-id="TEA001"
                        data-name="Mr. John Smith"
                        data-department="Computer Science"
                        data-email="john.smith@example.com"
                        data-phone="+880123456789"
                        title="Edit">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button class="btn btn-danger btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteTeacherModal"
                        data-id="TEA001"
                        data-name="Mr. John Smith"
                        title="Delete">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>

            <!-- Example Row 2 -->
            <tr>
              <td>TEA002</td>
              <td>Ms. Jane Doe</td>
              <td>Mathematics</td>
              <td>jane.doe@example.com</td>
              <td>+880987654321</td>
              <td class="d-flex justify-content-center gap-1">
                <button class="btn btn-primary btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#viewTeacherModal"
                        data-id="TEA002"
                        data-name="Ms. Jane Doe"
                        data-department="Mathematics"
                        data-email="jane.doe@example.com"
                        data-phone="+880987654321"
                        title="View">
                  <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-warning btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editTeacherModal"
                        data-id="TEA002"
                        data-name="Ms. Jane Doe"
                        data-department="Mathematics"
                        data-email="jane.doe@example.com"
                        data-phone="+880987654321"
                        title="Edit">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button class="btn btn-danger btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteTeacherModal"
                        data-id="TEA002"
                        data-name="Ms. Jane Doe"
                        title="Delete">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
            <!-- Example Row 2 -->
            <tr>
              <td>TEA002</td>
              <td>Ms. Jane Doe</td>
              <td>Mathematics</td>
              <td>jane.doe@example.com</td>
              <td>+880987654321</td>
              <td class="d-flex justify-content-center gap-1">
                <button class="btn btn-primary btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#viewTeacherModal"
                        data-id="TEA002"
                        data-name="Ms. Jane Doe"
                        data-department="Mathematics"
                        data-email="jane.doe@example.com"
                        data-phone="+880987654321"
                        title="View">
                  <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-warning btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editTeacherModal"
                        data-id="TEA002"
                        data-name="Ms. Jane Doe"
                        data-department="Mathematics"
                        data-email="jane.doe@example.com"
                        data-phone="+880987654321"
                        title="Edit">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button class="btn btn-danger btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteTeacherModal"
                        data-id="TEA002"
                        data-name="Ms. Jane Doe"
                        title="Delete">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
            <!-- Example Row 2 -->
            <tr>
              <td>TEA002</td>
              <td>Ms. Jane Doe</td>
              <td>Mathematics</td>
              <td>jane.doe@example.com</td>
              <td>+880987654321</td>
              <td class="d-flex justify-content-center gap-1">
                <button class="btn btn-primary btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#viewTeacherModal"
                        data-id="TEA002"
                        data-name="Ms. Jane Doe"
                        data-department="Mathematics"
                        data-email="jane.doe@example.com"
                        data-phone="+880987654321"
                        title="View">
                  <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-warning btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editTeacherModal"
                        data-id="TEA002"
                        data-name="Ms. Jane Doe"
                        data-department="Mathematics"
                        data-email="jane.doe@example.com"
                        data-phone="+880987654321"
                        title="Edit">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button class="btn btn-danger btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteTeacherModal"
                        data-id="TEA002"
                        data-name="Ms. Jane Doe"
                        title="Delete">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
            <!-- Example Row 2 -->
            <tr>
              <td>TEA002</td>
              <td>Ms. Jane Doe</td>
              <td>Mathematics</td>
              <td>jane.doe@example.com</td>
              <td>+880987654321</td>
              <td class="d-flex justify-content-center gap-1">
                <button class="btn btn-primary btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#viewTeacherModal"
                        data-id="TEA002"
                        data-name="Ms. Jane Doe"
                        data-department="Mathematics"
                        data-email="jane.doe@example.com"
                        data-phone="+880987654321"
                        title="View">
                  <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-warning btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editTeacherModal"
                        data-id="TEA002"
                        data-name="Ms. Jane Doe"
                        data-department="Mathematics"
                        data-email="jane.doe@example.com"
                        data-phone="+880987654321"
                        title="Edit">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button class="btn btn-danger btn-sm" 
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteTeacherModal"
                        data-id="TEA002"
                        data-name="Ms. Jane Doe"
                        title="Delete">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Modals -->

      <!-- View Teacher Modal -->
      <div class="modal fade zoom-in" id="viewTeacherModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white">
              <h5 class="modal-title">Teacher Details</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <h4 id="viewTeacherName">Name: </h4>
              <p><b>Department:</b> <span id="viewTeacherDepartment"></span></p>
              <p><b>Email:</b> <span id="viewTeacherEmail"></span></p>
              <p><b>Phone:</b> <span id="viewTeacherPhone"></span></p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button class="btn btn-success">Download PDF</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Edit Teacher Modal -->
      <div class="modal fade zoom-in" id="editTeacherModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark">
              <h5 class="modal-title">Edit Teacher</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form id="editTeacherForm">
                <input type="hidden" id="editTeacherId" name="teacher_id">
                <div class="mb-3">
                  <label class="form-label">Name</label>
                  <input type="text" class="form-control" id="editTeacherName" name="teacher_name">
                </div>
                <div class="mb-3">
                  <label class="form-label">Department</label>
                  <input type="text" class="form-control" id="editTeacherDepartment" name="department">
                </div>
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" id="editTeacherEmail" name="email">
                </div>
                <div class="mb-3">
                  <label class="form-label">Phone</label>
                  <input type="text" class="form-control" id="editTeacherPhone" name="phone">
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

      <!-- Delete Teacher Modal -->
      <div class="modal fade zoom-in" id="deleteTeacherModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark">
              <h5 class="modal-title">Delete Teacher</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete <b id="deleteTeacherName"></b>?</p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-danger" id="confirmDeleteTeacherBtn">Yes, Delete</button>
              <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Add Teacher Modal -->
      <div class="modal fade zoom-in" id="addTeacherModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white">
              <h5 class="modal-title">Add Teacher</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form action="add-teacher-process.php" method="POST">
                <div class="mb-3">
                  <label class="form-label">Name</label>
                  <input type="text" class="form-control" name="teacher_name" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Department</label>
                  <input type="text" class="form-control" name="department" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                  <label class="form-label">Phone</label>
                  <input type="text" class="form-control" name="phone">
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
    // View Teacher Modal
    var viewModal = document.getElementById('viewTeacherModal');
    viewModal.addEventListener('show.bs.modal', function(event){
      var button = event.relatedTarget;
      document.getElementById('viewTeacherName').innerText = "Name: " + button.dataset.name;
      document.getElementById('viewTeacherDepartment').innerText = button.dataset.department;
      document.getElementById('viewTeacherEmail').innerText = button.dataset.email;
      document.getElementById('viewTeacherPhone').innerText = button.dataset.phone;
    });

    // Edit Teacher Modal
    var editModal = document.getElementById('editTeacherModal');
    editModal.addEventListener('show.bs.modal', function(event){
      var button = event.relatedTarget;
      document.getElementById('editTeacherId').value = button.dataset.id;
      document.getElementById('editTeacherName').value = button.dataset.name;
      document.getElementById('editTeacherDepartment').value = button.dataset.department;
      document.getElementById('editTeacherEmail').value = button.dataset.email;
      document.getElementById('editTeacherPhone').value = button.dataset.phone;
    });

    // Delete Teacher Modal
    var deleteModal = document.getElementById('deleteTeacherModal');
    deleteModal.addEventListener('show.bs.modal', function(event){
      var button = event.relatedTarget;
      document.getElementById('deleteTeacherName').innerText = button.dataset.name;
    });

    // Download Teacher Modal
    var downloadModal = document.getElementById('downloadTeacherModal');
    downloadModal.addEventListener('show.bs.modal', function(event){
      var button = event.relatedTarget;
      document.getElementById('downloadTeacherName').innerText = button.dataset.name;
    });
  </script>
</body>
</html>
