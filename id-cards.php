<?php
    // Only admin can access
  require('backend/config/auth.php');
  restrict_page(['admin']);
?>
<?php $active_page = 'id-cards.php'; ?>
<?php include("backend/path.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ID Cards | Schoolizer</title>
<?php require_once("includes/link.php"); ?>
</head>
<body>
<?php require_once("includes/sidebar.php"); ?>

<div class="main-content p-4">
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">ID Cards</h1>
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#generateIDModal">
      <i class="bi bi-plus-circle me-1"></i> Generate ID Card
    </button>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-hover table-bordered text-center align-middle">
      <thead class="table-dark">
        <tr>
          <th>Name</th>
          <th>Role</th>
          <th>Class</th>
          <th>ID Number</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <!-- Example Row -->
        <tr>
          <td>John Doe</td>
          <td>Student</td>
          <td>10</td>
          <td>STU001</td>
          <td class="d-flex justify-content-center gap-1">
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewIDModal" title="View/Print">
              <i class="bi bi-eye"></i>
            </button>
            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteIDModal" title="Delete">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</div>

<!-- Generate ID Card Modal -->
<div class="modal fade" id="generateIDModal" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">
<div class="modal-header bg-dark text-white">
  <h5 class="modal-title">Generate ID Card</h5>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
  <form id="generateIDForm">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" class="form-control" name="name" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Role</label>
      <select class="form-select" name="role" required>
        <option value="">Select Role</option>
        <option value="Student">Student</option>
        <option value="Teacher">Teacher</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Class (if Student)</label>
      <input type="text" class="form-control" name="class">
    </div>
    <div class="mb-3">
      <label class="form-label">ID Number</label>
      <input type="text" class="form-control" name="id_number" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Upload Photo</label>
      <input type="file" class="form-control" name="photo" accept="image/*" required>
    </div>
    <div class="text-end">
      <button type="submit" class="btn btn-success">Generate</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    </div>
  </form>
</div>
</div>
</div>
</div>

<!-- View/Print ID Modal -->
<div class="modal fade" id="viewIDModal" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">
<div class="modal-header bg-dark text-white">
  <h5 class="modal-title">ID Card</h5>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body text-center">
  <div class="id-card p-3 border rounded" style="width: 350px; margin:auto;">
    <img id="idPhoto" src="assets/images/default-avatar.png" alt="Photo" class="img-fluid rounded mb-2" style="height:100px;">
    <h5 id="idName">John Doe</h5>
    <p id="idRole">Student</p>
    <p id="idClass">Class: 10</p>
    <p id="idNumber">ID: STU001</p>
  </div>
</div>
<div class="modal-footer">
  <button class="btn btn-success" onclick="printIDCard()">Print</button>
  <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

<!-- Delete ID Modal -->
<div class="modal fade" id="deleteIDModal" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
<div class="modal-header bg-danger text-white">
  <h5 class="modal-title">Delete ID Card</h5>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
  <p>Are you sure you want to delete ID Card of <b id="deleteIDName">John Doe</b>?</p>
</div>
<div class="modal-footer">
  <button class="btn btn-danger">Yes, Delete</button>
  <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
</div>
</div>
</div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
function printIDCard() {
  var printContents = document.querySelector('.id-card').outerHTML;
  var originalContents = document.body.innerHTML;
  document.body.innerHTML = printContents;
  window.print();
  document.body.innerHTML = originalContents;
}
</script>
</body>
</html>
