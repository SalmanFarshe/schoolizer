<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['admin']); // Only admin can manage notices

// -------------------------- HANDLE FORM SUBMISSIONS --------------------------

// Add Notice
if(isset($_POST['action']) && $_POST['action'] === 'add') {
    $title       = trim($_POST['title']);
    $description = trim($_POST['description']);
    $date        = $_POST['date'];
    $audience    = $_POST['audience'];

    if($title && $description && $date && $audience){
        $stmt = $conn->prepare("INSERT INTO notices (title, description, notice_date, audience) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $description, $date, $audience);
        $stmt->execute();
        $stmt->close();
        $_SESSION['success'] = "Notice added successfully!";
    } else {
        $_SESSION['error'] = "All fields are required!";
    }
    header("Location: notices.php");
    exit();
}

// Edit Notice
if(isset($_POST['action']) && $_POST['action'] === 'edit') {
    $id          = intval($_POST['notice_id']);
    $title       = trim($_POST['title']);
    $description = trim($_POST['description']);
    $date        = $_POST['date'];
    $audience    = $_POST['audience'];

    if($id && $title && $description && $date && $audience){
        $stmt = $conn->prepare("UPDATE notices SET title=?, description=?, notice_date=?, audience=? WHERE id=?");
        $stmt->bind_param("ssssi", $title, $description, $date, $audience, $id);
        $stmt->execute();
        $stmt->close();
        $_SESSION['success'] = "Notice updated successfully!";
    } else {
        $_SESSION['error'] = "All fields are required!";
    }
    header("Location: notices.php");
    exit();
}

// Delete Notice
if(isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = intval($_POST['notice_id']);
    if($id){
        $stmt = $conn->prepare("DELETE FROM notices WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $_SESSION['success'] = "Notice deleted successfully!";
    } else {
        $_SESSION['error'] = "Invalid notice ID!";
    }
    header("Location: notices.php");
    exit();
}

// Fetch all notices
$notices_res = $conn->query("SELECT * FROM notices ORDER BY notice_date DESC");
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

  <!-- Display messages -->
  <?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
  <?php endif; ?>
  <?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
  <?php endif; ?>

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
        <?php while($row = $notices_res->fetch_assoc()): ?>
        <tr>
          <td><?php echo htmlspecialchars($row['title']); ?></td>
          <td><?php echo $row['notice_date']; ?></td>
          <td><?php echo $row['audience']; ?></td>
          <td class="d-flex justify-content-center gap-1">
            <button class="btn btn-primary btn-sm viewNoticeBtn" 
              data-id="<?php echo $row['id']; ?>" 
              data-title="<?php echo htmlspecialchars($row['title']); ?>" 
              data-desc="<?php echo htmlspecialchars($row['description']); ?>" 
              data-date="<?php echo $row['notice_date']; ?>" 
              data-audience="<?php echo $row['audience']; ?>" 
              data-bs-toggle="modal" data-bs-target="#viewNoticeModal" title="View">
              <i class="bi bi-eye"></i>
            </button>
            <button class="btn btn-warning btn-sm editNoticeBtn" 
              data-id="<?php echo $row['id']; ?>" 
              data-title="<?php echo htmlspecialchars($row['title']); ?>" 
              data-desc="<?php echo htmlspecialchars($row['description']); ?>" 
              data-date="<?php echo $row['notice_date']; ?>" 
              data-audience="<?php echo $row['audience']; ?>" 
              data-bs-toggle="modal" data-bs-target="#editNoticeModal" title="Edit">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn btn-danger btn-sm deleteNoticeBtn" 
              data-id="<?php echo $row['id']; ?>" 
              data-title="<?php echo htmlspecialchars($row['title']); ?>" 
              data-bs-toggle="modal" data-bs-target="#deleteNoticeModal" title="Delete">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
</div>

<!-- ---------------- MODALS ---------------- -->

<!-- Add Notice Modal -->
<div class="modal fade" id="addNoticeModal" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered">
<div class="modal-content">
<div class="modal-header bg-dark text-white">
  <h5 class="modal-title">Add New Notice</h5>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
  <form id="addNoticeForm" method="POST">
    <input type="hidden" name="action" value="add">
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
  <form id="editNoticeForm" method="POST">
    <input type="hidden" name="action" value="edit">
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
  <h4 id="noticeTitle"></h4>
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
  <form method="POST">
    <input type="hidden" name="action" value="delete">
    <input type="hidden" name="notice_id" id="deleteNoticeId">
    <button class="btn btn-danger">Yes, Delete</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
  </form>
</div>
</div>
</div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Fill Edit Modal
    document.querySelectorAll('.editNoticeBtn').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            document.querySelector('#editNoticeForm [name="notice_id"]').value = id;
            document.querySelector('#editNoticeForm [name="title"]').value = btn.dataset.title;
            document.querySelector('#editNoticeForm [name="description"]').value = btn.dataset.desc;
            document.querySelector('#editNoticeForm [name="date"]').value = btn.dataset.date;
            document.querySelector('#editNoticeForm [name="audience"]').value = btn.dataset.audience;
        });
    });

    // Fill View Modal
    document.querySelectorAll('.viewNoticeBtn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('noticeTitle').textContent = btn.dataset.title;
            document.getElementById('noticeDescription').textContent = btn.dataset.desc;
            document.getElementById('noticeDate').textContent = btn.dataset.date;
            document.getElementById('noticeAudience').textContent = btn.dataset.audience;
        });
    });

    // Fill Delete Modal
    document.querySelectorAll('.deleteNoticeBtn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('deleteNoticeTitle').textContent = btn.dataset.title;
            document.getElementById('deleteNoticeId').value = btn.dataset.id;
        });
    });
});
</script>
</body>
</html>
