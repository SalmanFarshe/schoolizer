<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['admin']); // Only admin can access

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Add Event
        if ($action === 'add') {
            $name  = trim($_POST['event_name']);
            $date  = trim($_POST['event_date']);
            $type  = trim($_POST['event_type']);
            $class = trim($_POST['event_class']);

            $stmt = $conn->prepare("INSERT INTO academic_events (event_name, event_date, event_type, event_class) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $date, $type, $class);
            $stmt->execute();
        }

        // Edit Event
        if ($action === 'edit') {
            $id    = $_POST['event_id'];
            $name  = trim($_POST['event_name']);
            $date  = trim($_POST['event_date']);
            $type  = trim($_POST['event_type']);
            $class = trim($_POST['event_class']);

            $stmt = $conn->prepare("UPDATE academic_events SET event_name=?, event_date=?, event_type=?, event_class=? WHERE id=?");
            $stmt->bind_param("ssssi", $name, $date, $type, $class, $id);
            $stmt->execute();
        }

        // Delete Event
        if ($action === 'delete') {
            $id = $_POST['event_id'];
            $stmt = $conn->prepare("DELETE FROM academic_events WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }

        header("Location: academic-calendar.php");
        exit;
    }
}

// ================= FETCH EVENTS =================
$events = [];
$result = $conn->query("SELECT * FROM academic_events ORDER BY event_date ASC");
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}
?>
<?php $active_page = 'academic-calendar.php'; ?>
<?php include("backend/path.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Academic Calendar | Schoolizer</title>
  <?php require_once("includes/link.php"); ?>
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js'></script>
</head>
<body>
<?php require_once("includes/sidebar.php"); ?>

<div class="main-content p-4">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="h3">Academic Calendar</h1>
      <button type="button" class="btn button" data-bs-toggle="modal" data-bs-target="#addEventModal">
        <i class="bi bi-plus-circle me-1"></i> Add Event
      </button>
    </div>

    <!-- Calendar -->
    <div id='calendar'></div>

    <!-- Event List Table -->
    <div class="table-responsive mt-4">
      <h4>All Events</h4>
      <table class="table table-striped table-hover table-bordered text-center align-middle">
        <thead class="table-dark">
          <tr>
            <th>Date</th>
            <th>Event</th>
            <th>Type</th>
            <th>Class</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($events)): ?>
            <?php foreach ($events as $event): ?>
              <tr>
                <td><?= htmlspecialchars($event['event_date']) ?></td>
                <td><?= htmlspecialchars($event['event_name']) ?></td>
                <td><?= htmlspecialchars($event['event_type']) ?></td>
                <td><?= htmlspecialchars($event['event_class']) ?></td>
                <td class="d-flex justify-content-center gap-1">
                  <!-- Edit -->
                  <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editEventModal<?= $event['id'] ?>">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <!-- Delete -->
                  <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteEventModal<?= $event['id'] ?>">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>

              <!-- Edit Event Modal -->
              <div class="modal fade" id="editEventModal<?= $event['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                      <h5 class="modal-title">Edit Academic Event</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="post">
                      <input type="hidden" name="action" value="edit">
                      <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                      <div class="modal-body">
                        <div class="mb-3">
                          <label class="form-label">Event Name</label>
                          <input type="text" class="form-control" name="event_name" value="<?= htmlspecialchars($event['event_name']) ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Date</label>
                          <input type="date" class="form-control" name="event_date" value="<?= $event['event_date'] ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Type</label>
                          <select class="form-select" name="event_type">
                            <option <?= $event['event_type']=="Exam"?"selected":"" ?>>Exam</option>
                            <option <?= $event['event_type']=="Holiday"?"selected":"" ?>>Holiday</option>
                            <option <?= $event['event_type']=="Activity"?"selected":"" ?>>Activity</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Class</label>
                          <select class="form-select" name="event_class">
                            <option <?= $event['event_class']=="All"?"selected":"" ?>>All</option>
                            <option <?= $event['event_class']=="9"?"selected":"" ?>>Class 9</option>
                            <option <?= $event['event_class']=="10"?"selected":"" ?>>Class 10</option>
                          </select>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- Delete Event Modal -->
              <div class="modal fade" id="deleteEventModal<?= $event['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                      <h5 class="modal-title">Delete Event</h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure you want to delete <b><?= htmlspecialchars($event['event_name']) ?></b>?</p>
                    </div>
                    <form method="post" class="">
                      <div class="modal-footer">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="event_id" value="<?= $event['id'] ?>">
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="5">No events found.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add Event Modal -->
<div class="modal fade" id="addEventModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Add Academic Event</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form method="post">
        <input type="hidden" name="action" value="add">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Event Name</label>
            <input type="text" class="form-control" name="event_name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" class="form-control" name="event_date" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Type</label>
            <select class="form-select" name="event_type">
              <option value="Exam">Exam</option>
              <option value="Holiday">Holiday</option>
              <option value="Activity">Activity</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Class</label>
            <select class="form-select" name="event_class">
              <option value="All">All</option>
              <option value="9">Class 9</option>
              <option value="10">Class 10</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add Event</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
