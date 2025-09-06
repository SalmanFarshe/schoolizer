<!-- Quick Stats Cards -->
<div class="row mb-4">
  <div class="col-md-3 mb-3">
    <div class="card text-white bg-primary">
      <div class="card-body text-center">
        <i class="bi bi-journal-bookmark-fill fs-2"></i>
        <h2>5</h2>
        <h5>Enrolled Classes</h5>
      </div>
    </div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card text-white bg-success">
      <div class="card-body text-center">
        <i class="bi bi-book-fill fs-2"></i>
        <h2>12</h2>
        <h5>Completed Subjects</h5>
      </div>
    </div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card text-white bg-warning">
      <div class="card-body text-center">
        <i class="bi bi-check2-square fs-2"></i>
        <h2>92%</h2>
        <h5>Attendance</h5>
      </div>
    </div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card text-white bg-danger">
      <div class="card-body text-center">
        <i class="bi bi-patch-question-fill fs-2"></i>
        <h2>3</h2>
        <h5>Pending Quizzes</h5>
      </div>
    </div>
  </div>
</div>

<!-- Academic Info Cards -->
<div class="row mb-4">
  <div class="col-md-6 mb-3">
    <div class="card text-dark bg-light">
      <div class="card-body">
        <h5>Latest Result</h5>
        <p>Exam: Midterm 2025</p>
        <p>GPA: 3.85 / 4.00</p>
        <a href="view-result.php" class="btn btn-sm btn-primary">View Full Results</a>
      </div>
    </div>
  </div>
  <div class="col-md-6 mb-3">
    <div class="card text-dark bg-light">
      <div class="card-body">
        <h5>Next Exam / Event</h5>
        <p>Exam: Final 2025</p>
        <p>Date: 15 Sep 2025</p>
        <p>Class: 10 - A</p>
        <a href="view-calander.php" class="btn btn-sm btn-success">View Calendar</a>
      </div>
    </div>
  </div>
</div>

<!-- Quick Actions -->
<div class="mb-4">
  <h5>Quick Actions</h5>
  <div class="d-flex gap-2 flex-wrap">
    <a href="results.php" class="btn btn-primary"><i class="bi bi-poll me-1"></i> View Results</a>
    <a href="routine.php" class="btn btn-success"><i class="bi bi-calendar2-week me-1"></i> View Routine</a>
    <a href="notes.php" class="btn btn-warning"><i class="bi bi-sticky-note me-1"></i> View Notes</a>
    <a href="quiz.php" class="btn btn-danger"><i class="bi bi-question-circle me-1"></i> Attempt Quiz</a>
    <a href="ledger.php" class="btn btn-info"><i class="bi bi-journal-text me-1"></i> Ledger</a>
    <a href="attendance-report.php" class="btn btn-secondary"><i class="bi bi-check2-square me-1"></i> Attendance Report</a>
    <a href="admit-card.php" class="btn btn-dark"><i class="bi bi-file-earmark-arrow-down me-1"></i> Admit Card</a>
  </div>
</div>

<!-- Notices Table -->
<div class="card mb-4">
  <div class="card-header bg-dark text-white">Recent Notices</div>
  <div class="card-body table-responsive">
    <table class="table table-striped table-bordered align-middle text-center">
      <thead class="table-dark">
        <tr>
          <th>Date</th>
          <th>Notice</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>2025-08-31</td>
          <td>Upcoming final exams schedule released.</td>
          <td><button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewNoticeModal">View</button></td>
        </tr>
        <tr>
          <td>2025-08-30</td>
          <td>Holiday for national festival declared.</td>
          <td><button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewNoticeModal">View</button></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Notice Modal -->
<div class="modal fade" id="viewNoticeModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Notice Details</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Date: 2025-08-31</p>
        <p>Notice: Upcoming final exams schedule released. Please check your schedule and prepare accordingly.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
