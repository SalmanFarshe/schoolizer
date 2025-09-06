<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['student', 'teacher']); // accessible by students and teachers

$active_page = 'view-notice.php';
?>
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
      <h1 class="h3 mb-4">Notices</h1>

      <div class="card shadow-sm">
        <div class="card-body table-responsive">
          <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-dark">
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Date</th>
                <th>Audience</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Fetch notices dynamically from DB
              $stmt = $conn->query("SELECT * FROM notices ORDER BY notice_date DESC");
              $count = 1;
              while($notice = $stmt->fetch_assoc()):
                $notice_date = date("d M, Y", strtotime($notice['notice_date']));
                ?>
                <tr>
                  <td><?php echo $count++; ?></td>
                  <td><?php echo htmlspecialchars($notice['title']); ?></td>
                  <td><?php echo $notice_date; ?></td>
                  <td><?php echo htmlspecialchars($notice['audience']); ?></td>
                  <td>
                    <button class="btn btn-sm btn-primary" 
                            data-bs-toggle="modal" 
                            data-bs-target="#viewNoticeModal" 
                            data-title="<?php echo htmlspecialchars($notice['title']); ?>"
                            data-desc="<?php echo htmlspecialchars($notice['description']); ?>"
                            data-date="<?php echo $notice_date; ?>"
                            data-audience="<?php echo htmlspecialchars($notice['audience']); ?>"
                            data-attachment="<?php echo isset($notice['attachment']) ? $notice['attachment'] : ''; ?>">
                      <i class="bi bi-eye"></i> View
                    </button>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- View Notice Modal -->
      <div class="modal fade" id="viewNoticeModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white">
              <h5 class="modal-title" id="noticeTitle">Notice Title</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p><strong>Date:</strong> <span id="noticeDate"></span></p>
              <p><strong>Audience:</strong> <span id="noticeAudience"></span></p>
              <hr>
              <p id="noticeDesc"></p>
              <p id="noticeAttachment"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script>
    var noticeModal = document.getElementById('viewNoticeModal');
    noticeModal.addEventListener('show.bs.modal', function(event){
      var button = event.relatedTarget;
      var title = button.getAttribute('data-title');
      var desc = button.getAttribute('data-desc');
      var date = button.getAttribute('data-date');
      var audience = button.getAttribute('data-audience');
      var attachment = button.getAttribute('data-attachment');

      document.getElementById('noticeTitle').textContent = title;
      document.getElementById('noticeDesc').textContent = desc;
      document.getElementById('noticeDate').textContent = date;
      document.getElementById('noticeAudience').textContent = audience;

      if(attachment){
        document.getElementById('noticeAttachment').innerHTML = 
          '<a href="uploads/' + attachment + '" target="_blank" class="btn btn-sm btn-outline-primary">' +
          '<i class="bi bi-paperclip me-1"></i> View Attachment</a>';
      } else {
        document.getElementById('noticeAttachment').innerHTML = '';
      }
    });
  </script>
</body>
</html>
