<?php
  require_once("backend/config/config.php");
  // Only admin can access
  require('backend/config/auth.php');
  restrict_page(['admin']);
?>
<?php $active_page = 'results.php'; ?>
<?php include("backend/path.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Results | Schoolizer</title>
  <?php require_once("includes/link.php"); ?>
</head>
<body>
  <?php require_once("includes/sidebar.php"); ?>

  <div class="main-content p-4">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Student Results</h1>
        <button type="button" class="btn button" data-bs-toggle="modal" data-bs-target="#addResultModal">
          <i class="bi bi-plus-circle me-1"></i> Add Result
        </button>
      </div>

      <!-- Search & Filter -->
      <div class="row mb-4">
        <div class="col-md-6 mb-2">
          <input type="text" id="" class="form-control" placeholder="Search by student name, roll or ID">
        </div>
        <div class="col-md-4 mb-2">
          <select id="classFilter" class="form-select">
            <option value="">Filter by Class</option>
            <option value="10">Class 10</option>
            <option value="9">Class 9</option>
            <option value="8">Class 8</option>
            <!-- Add more classes dynamically -->
          </select>
        </div>
      </div>

      <?php
        // Fetch all classes
        $sql = "SELECT class_id, class_name, section FROM classes ORDER BY class_name ASC";
        $result = $conn->query($sql);
      ?>
      <!-- Quick Links -->
      <div class="mb-4">
        <h5>Class Quick Links</h5>
        <div class="d-flex gap-2 flex-wrap justify-content-between">
          <?php while ($row = $result->fetch_assoc()): ?>
            <a href="class-students.php?class_id=<?= urlencode($row['class_id']) ?>" 
              class="btn button">
              <i class="bi bi-people-fill me-1"></i> 
              <?= htmlspecialchars($row['class_name']) ?> 
              <?= $row['section'] ? '(' . htmlspecialchars($row['section']) . ')' : '' ?>
            </a>
          <?php endwhile; ?>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle text-center" id="resultsTable">
          <thead class="table-dark">
            <tr>
              <th>Student ID</th>
              <th>Student Name</th>
              <th>Class</th>
              <th>Roll</th>
              <th>Grade</th>
              <th>CGPA</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>STU001</td>
              <td>John Doe</td>
              <td>10</td>
              <td>01</td>
              <td>A+</td>
              <td>4.36</td>
              <td class="d-flex justify-content-center gap-1">
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#viewResultModal"
                  data-id="RES001" data-name="John Doe" data-class="10" data-roll="01" data-subject="Math"
                  data-marks="95" data-grade="A+" title="View"><i class="bi bi-eye"></i></button>

                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editResultModal"
                  data-id="RES001" data-name="John Doe" data-class="10" data-roll="01" data-subject="Math"
                  data-marks="95" data-grade="A+" title="Edit"><i class="bi bi-pencil-square"></i></button>

                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteResultModal"
                  data-id="RES001" data-name="John Doe" title="Delete"><i class="bi bi-trash"></i></button>

                  <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#printResultModal"
                  data-id="RES001" data-name="John Doe" title="Print">
                  <i class="bi bi-printer"></i>
                </button>

              </td>
            </tr>
            <!-- Add more rows dynamically from DB -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

        <!-- Modals -->

      <!-- Add Result Modal -->
      <div class="modal fade zoom-in" id="addResultModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white">
              <h5 class="modal-title">Add New Result</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form action="add-result-process.php" method="POST">
                <div class="mb-3">
                  <label class="form-label">Student Name</label>
                  <input type="text" class="form-control" name="student_name" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Class</label>
                  <input type="text" class="form-control" name="student_class" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Roll</label>
                  <input type="text" class="form-control" name="roll" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Subject</label>
                  <input type="text" class="form-control" name="subject" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Marks</label>
                  <input type="number" class="form-control" name="marks" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Grade</label>
                  <input type="text" class="form-control" name="grade" required>
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

      <!-- View Result Modal -->
      <div class="modal fade zoom-in" id="viewResultModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white">
              <h5 class="modal-title">Result Details</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <h4 id="viewResName">Student: </h4>
              <p><b>Class:</b> <span id="viewResClass"></span></p>
              <p><b>Roll:</b> <span id="viewResRoll"></span></p>
              <p><b>Subject:</b> <span id="viewResSubject"></span></p>
              <p><b>Marks:</b> <span id="viewResMarks"></span></p>
              <p><b>Grade:</b> <span id="viewResGrade"></span></p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Edit Result Modal -->
      <div class="modal fade zoom-in" id="editResultModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark text-dark">
              <h5 class="modal-title">Edit Result</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form id="editResultForm">
                <input type="hidden" id="editResId" name="result_id">
                <div class="mb-3">
                  <label class="form-label">Student Name</label>
                  <input type="text" class="form-control" id="editResName" name="student_name">
                </div>
                <div class="mb-3">
                  <label class="form-label">Class</label>
                  <input type="text" class="form-control" id="editResClass" name="student_class">
                </div>
                <div class="mb-3">
                  <label class="form-label">Roll</label>
                  <input type="text" class="form-control" id="editResRoll" name="roll">
                </div>
                <div class="mb-3">
                  <label class="form-label">Subject</label>
                  <input type="text" class="form-control" id="editResSubject" name="subject">
                </div>
                <div class="mb-3">
                  <label class="form-label">Marks</label>
                  <input type="number" class="form-control" id="editResMarks" name="marks">
                </div>
                <div class="mb-3">
                  <label class="form-label">Grade</label>
                  <input type="text" class="form-control" id="editResGrade" name="grade">
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

      <!-- Delete Result Modal -->
      <div class="modal fade zoom-in" id="deleteResultModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white">
              <h5 class="modal-title">Delete Result</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete the result of <b id="deleteResName"></b>?</p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-danger" id="confirmDeleteResBtn">Yes, Delete</button>
              <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Modals (Add, View, Edit, Delete) same as previous code -->

  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script>
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const classFilter = document.getElementById('classFilter');
    const table = document.getElementById('resultsTable').getElementsByTagName('tbody')[0];

    function filterTable() {
      const searchText = searchInput.value.toLowerCase();
      const classText = classFilter.value;
      Array.from(table.rows).forEach(row => {
        const name = row.cells[1].innerText.toLowerCase();
        const roll = row.cells[3].innerText.toLowerCase();
        const id = row.cells[0].innerText.toLowerCase();
        const cls = row.cells[2].innerText;
        const matchSearch = name.includes(searchText) || roll.includes(searchText) || id.includes(searchText);
        const matchClass = classText === "" || cls === classText;
        row.style.display = (matchSearch && matchClass) ? "" : "none";
      });
    }

    searchInput.addEventListener('keyup', filterTable);
    classFilter.addEventListener('change', filterTable);

    // View Modal
    var viewModal = document.getElementById('viewResultModal');
    viewModal.addEventListener('show.bs.modal', function(event){
      var button = event.relatedTarget;
      document.getElementById('viewResName').innerText = "Student: " + button.dataset.name;
      document.getElementById('viewResClass').innerText = button.dataset.class;
      document.getElementById('viewResRoll').innerText = button.dataset.roll;
      document.getElementById('viewResSubject').innerText = button.dataset.subject;
      document.getElementById('viewResMarks').innerText = button.dataset.marks;
      document.getElementById('viewResGrade').innerText = button.dataset.grade;
    });

    // Edit Modal
    var editModal = document.getElementById('editResultModal');
    editModal.addEventListener('show.bs.modal', function(event){
      var button = event.relatedTarget;
      document.getElementById('editResId').value = button.dataset.id;
      document.getElementById('editResName').value = button.dataset.name;
      document.getElementById('editResClass').value = button.dataset.class;
      document.getElementById('editResRoll').value = button.dataset.roll;
      document.getElementById('editResSubject').value = button.dataset.subject;
      document.getElementById('editResMarks').value = button.dataset.marks;
      document.getElementById('editResGrade').value = button.dataset.grade;
    });

    // Delete Modal
    var deleteModal = document.getElementById('deleteResultModal');
    deleteModal.addEventListener('show.bs.modal', function(event){
      var button = event.relatedTarget;
      document.getElementById('deleteResName').innerText = button.dataset.name;
    });
  </script>
</body>
</html>
