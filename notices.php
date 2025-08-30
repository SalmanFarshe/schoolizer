<?php
    // Only admin can access
  require('backend/config/auth.php');
  restrict_page(['admin']);
?>
<?php $active_page = 'notices.php'; ?>
<?php include("backend/path.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notices | Schoolizer</title>
<?php require_once("includes/link.php"); ?>
</head>
<body>
<?php require_once("includes/sidebar.php"); ?>

<div class="main-content p-4">
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">School Notices</h1>
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#addNoticeModal">
      <i class="bi bi-plus-circle me-1"></i> Add Notice
    </button>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-hover table-bordered text-center align-middle">
      <thead class="table-dark">
        <tr>
          <th>Title</th>
          <th>Date</th>
          <th>Target Audience</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <!-- Example Row -->
        <tr>
          <td>Annual Sports Day</td>
          <td>2025-09-01</td>
          <td>All Students</td>
          <td class="d-flex justify-content-center gap-1">
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewNoticeModal" title="View">
              <i class="bi bi-eye"></i>
            </button>
            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editNoticeModal" title="Edit">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteNoticeModal" title="Delete">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</div>

<!-- Add Notice Modal -->
<div class="modal fade" id="addNoticeModal" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">
<div class="modal-header bg-dark text-white">
  <h5 class="modal-title">Add New Notice</h5>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
  <form id="addNoticeForm">
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" class="form-control" name="title" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea class="form-control" name="description" rows="4" required></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Date</label>
      <input type="date" class="form-control" name="date" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Target Audience</label>
      <select class="form-select" name="audience" required>
        <option value="">Select Audience</option>
        <option value="All">All</option>
        <option value="Students">Students</option>
        <option value="Teachers">Teachers</option>
      </select>
    </div>
    <div class="text-end">
      <button type="submit" class="btn btn-success">Post Notice</button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    </div>
  </form>
</div>
</div>
</div>
</div>

<!-- Edit Notice Modal -->
<div class="modal fade" id="editNoticeModal" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">
<div class="modal-header bg-warning text-dark">
  <h5 class="modal-title">Edit Notice</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
  <form id="editNoticeForm">
    <input type="hidden" name="notice_id">
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" class="form-control" name="title" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea class="form-control" name="description" rows="4" required></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Date</label>
      <input type="date" class="form-control" name="date" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Target Audience</label>
      <select class="form-select" name="audience" required>
        <option value="">Select Audience</option>
        <option value="All">All</option>
        <option value="Students">Students</option>
        <option value="Teachers">Teachers</option>
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

<!-- View Notice Modal -->
<div class="modal fade" id="viewNoticeModal" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">
<div class="modal-header bg-dark text-white">
  <h5 class="modal-title">Notice Details</h5>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
  <h4 id="noticeTitle">Title</h4>
  <p id="noticeDescription"></p>
  <p><b>Date:</b> <span id="noticeDate"></span></p>
  <p><b>Audience:</b> <span id="noticeAudience"></span></p>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

<!-- Delete Notice Modal -->
<div class="modal fade" id="deleteNoticeModal" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
<div class="modal-header bg-danger text-white">
  <h5 class="modal-title">Delete Notice</h5>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
  <p>Are you sure you want to delete <b id="deleteNoticeTitle"></b>?</p>
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
// Fill modals dynamically
</script>
</body>
</html>
