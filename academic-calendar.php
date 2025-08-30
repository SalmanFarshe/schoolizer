<?php
    // Only admin can access
  require('backend/config/auth.php');
  restrict_page(['admin']);
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
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEventModal">
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
        <tr>
          <td>2025-09-10</td>
          <td>Midterm Exam</td>
          <td>Exam</td>
          <td>10</td>
          <td class="d-flex justify-content-center gap-1">
            <button class="btn btn-warning btn-sm editBtn" data-bs-toggle="modal" data-bs-target="#editEventModal">Edit</button>
            <button class="btn btn-danger btn-sm deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteEventModal">Delete</button>
          </td>
        </tr>
        <tr>
          <td>2025-10-05</td>
          <td>National Holiday</td>
          <td>Holiday</td>
          <td>All</td>
          <td class="d-flex justify-content-center gap-1">
            <button class="btn btn-warning btn-sm editBtn" data-bs-toggle="modal" data-bs-target="#editEventModal">Edit</button>
            <button class="btn btn-danger btn-sm deleteBtn" data-bs-toggle="modal" data-bs-target="#deleteEventModal">Delete</button>
          </td>
        </tr>
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
      <div class="modal-body">
        <form id="addEventForm">
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
          <div class="text-end">
            <button type="submit" class="btn btn-success">Add Event</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Event Modal -->
<div class="modal fade" id="editEventModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title">Edit Academic Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editEventForm">
          <input type="hidden" name="event_id">
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
          <div class="text-end">
            <button type="submit" class="btn btn-success">Save Changes</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete Event Modal -->
<div class="modal fade" id="deleteEventModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Delete Event</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this event?</p>
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
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    height: 600,
    events: [
      { title: 'Midterm Exam', start: '2025-09-10', color: '#F24515' },
      { title: 'National Holiday', start: '2025-10-05', color: '#175B8C' }
    ]
  });
  calendar.render();
});
</script>
</body>
</html>
