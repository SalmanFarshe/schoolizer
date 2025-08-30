<?php
    // Only admin can access
  require('backend/config/auth.php');
  restrict_page(['admin']);
?>
<?php $active_page = 'subjects.php'; ?>
<?php include("backend/path.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subjects | Schoolizer</title>
  <?php require_once("includes/link.php"); ?>
</head>
<body>
  <?php require_once("includes/sidebar.php"); ?>

  <div class="main-content p-4">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Subjects</h1>
        <button class="btn button" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
          <i class="bi bi-plus-circle me-1"></i> Add Subject
        </button>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle text-center">
          <thead class="table-dark">
            <tr>
              <th>Subject ID</th>
              <th>Subject Name</th>
              <th>Class</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <!-- Example Row -->
            <tr>
              <td>SUB001</td>
              <td>Mathematics</td>
              <td>10</td>
              <td class="d-flex justify-content-center gap-1">
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSubjectModal"
                  data-id="SUB001" data-name="Mathematics" data-class="10" title="Edit">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteSubjectModal"
                  data-id="SUB001" data-name="Mathematics" title="Delete">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
            <tr>
              <td>SUB002</td>
              <td>English</td>
              <td>9</td>
              <td class="d-flex justify-content-center gap-1">
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSubjectModal"
                  data-id="SUB002" data-name="English" data-class="9" title="Edit">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteSubjectModal"
                  data-id="SUB002" data-name="English" title="Delete">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Add Subject Modal -->
  <div class="modal fade zoom-in" id="addSubjectModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title">Add Subject</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="addSubjectForm" method="POST" action="add-subject-process.php">
            <div class="mb-3">
              <label class="form-label">Subject Name</label>
              <input type="text" class="form-control" name="subject_name" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Class</label>
              <select class="form-select" name="subject_class" required>
                <option value="">Select Class</option>
                <option value="10">10</option>
                <option value="9">9</option>
                <option value="8">8</option>
                <!-- More classes -->
              </select>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-success">Add Subject</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Edit Subject Modal -->
  <div class="modal fade zoom-in" id="editSubjectModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-dark text-dark">
          <h5 class="modal-title">Edit Subject</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="editSubjectForm" method="POST" action="edit-subject-process.php">
            <input type="hidden" name="subject_id" id="editSubId">
            <div class="mb-3">
              <label class="form-label">Subject Name</label>
              <input type="text" class="form-control" name="subject_name" id="editSubName">
            </div>
            <div class="mb-3">
              <label class="form-label">Class</label>
              <select class="form-select" name="subject_class" id="editSubClass">
                <option value="">Select Class</option>
                <option value="10">10</option>
                <option value="9">9</option>
                <option value="8">8</option>
              </select>
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

  <!-- Delete Subject Modal -->
  <div class="modal fade zoom-in" id="deleteSubjectModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-dark text-white">
          <h5 class="modal-title">Delete Subject</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete <b id="deleteSubName"></b>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="confirmDeleteSubject">Yes, Delete</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script>
    // Edit Subject Modal
    var editModal = document.getElementById('editSubjectModal');
    editModal.addEventListener('show.bs.modal', function(event){
      var button = event.relatedTarget;
      document.getElementById('editSubId').value = button.dataset.id;
      document.getElementById('editSubName').value = button.dataset.name;
      document.getElementById('editSubClass').value = button.dataset.class;
    });

    // Delete Subject Modal
    var deleteModal = document.getElementById('deleteSubjectModal');
    deleteModal.addEventListener('show.bs.modal', function(event){
      var button = event.relatedTarget;
      document.getElementById('deleteSubName').innerText = button.dataset.name;
    });
  </script>
</body>
</html>
