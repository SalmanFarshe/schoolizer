<?php
  // Only admin can access
  require('backend/config/auth.php');
  require('backend/config/config.php');
  restrict_page(['admin']);
?>
<?php $active_page = 'student-list.php'; ?>
<?php include("backend/path.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students List | Schoolizer</title>
  <?php require_once("includes/link.php") ?>
</head>
<body>
  <?php require_once("includes/sidebar.php"); ?>

  <!-- Main Content -->
  <div class="main-content p-4">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Students List</h1>
        <!-- Add Student Button -->
        <button type="button" class="btn button" data-bs-toggle="modal" data-bs-target="#addStudentModal">
          <i class="bi bi-plus-circle me-1"></i> Add Student
        </button>
      </div>
      <p class="text-muted">Below is the list of all students.</p>

      <!-- Students Table -->
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle text-center">
          <thead class="table-dark">
            <tr>
              <th>Student ID</th>
              <th>Roll</th>
              <th>Name</th>
              <th>Class</th>
              <th>CGPA</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              // Fetch students along with their class info
              $sql = "
                  SELECT s.*, c.class_name, c.section 
                  FROM students s
                  LEFT JOIN classes c ON s.class_id = c.id
                  ORDER BY s.name
              ";
              $result = $conn->query($sql);

              while($row = $result->fetch_assoc()){
                  $class_display = htmlspecialchars($row['class_name']);
                  if(!empty($row['section'])){
                      $class_display .= " - " . htmlspecialchars($row['section']);
                  }
                  ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['roll']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo $class_display; ?></td>
                        <td><?php echo htmlspecialchars($row['cgpa']); ?></td>
                      <!-- View -->
                       <td>
                      <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#viewStudentModal'
                          data-id='<?php echo $row['student_id']; ?>' data-name='<?php echo $row['name']; ?>'
                          data-roll='<?php echo $row['roll']; ?>' data-class='<?php echo $row['class']; ?>'
                          data-father='<?php echo $row['father_name']; ?>' data-mother='<?php echo $row['mother_name']; ?>'
                          data-cgpa='<?php echo $row['cgpa']; ?>' data-email='<?php echo $row['email']; ?>' title='View'>
                          <i class='bi bi-eye'></i>
                      </button>

                      <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editStudentModal"
                          data-id='<?php echo $row['student_id']; ?>' data-name='<?php echo $row['name']; ?>'
                          data-roll='<?php echo $row['roll']; ?>' data-class='<?php echo $row['class']; ?>'
                          data-father='<?php echo $row['father_name']; ?>' data-mother='<?php echo $row['mother_name']; ?>'
                          data-cgpa='<?php echo $row['cgpa']; ?>' data-email='<?php echo $row['email']; ?>' title="Edit">
                          <i class="bi bi-pencil-square"></i>
                      </button>

                      <!-- Delete -->
                      <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteStudentModal"
                          data-id='<?php echo $row['student_id']; ?>' data-name='<?php echo $row['name']; ?>' title="Delete">
                          <i class="bi bi-trash"></i>
                      </button>

                      <!-- Download PDF Button -->
                    <button class="btn btn-success btn-sm"
                        onclick="window.location.href='processes/download-student.php?student_id=<?php echo $row['student_id']; ?>'">
                        <i class="bi bi-download"></i>
                    </button>
                  </td>
              </tr>
              
               <?php
            }
            ?>
          </tbody>
        </table>
      </div>

      <!-- Modals -->

      <!-- View Student Modal -->
      <div class="modal fade zoom-in" id="viewStudentModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white">
              <h5 class="modal-title">Student Details</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <h4 id="viewStudentName">Name: </h4>
              <p><b>Roll:</b> <span id="viewStudentRoll"></span></p>
              <p><b>Class:</b> <span id="viewStudentClass"></span></p>
              <p><b>Father:</b> <span id="viewStudentFather"></span></p>
              <p><b>Mother:</b> <span id="viewStudentMother"></span></p>
              <p><b>CGPA:</b> <span id="viewStudentCgpa"></span></p>
              <p><b>Email:</b> <span id="viewStudentEmail"></span></p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Edit Student Modal -->
<div class="modal fade zoom-in" id="editStudentModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Edit Student</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editStudentForm" method="POST" action="processes/edit-student.php">
          <input type="hidden" id="editStudentId" name="student_id">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" id="editStudentName" name="student_name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Roll</label>
            <input type="text" class="form-control" id="editStudentRoll" name="roll" required>
          </div>
         <div class="mb-3">
            <label class="form-label">Class</label>
           <select class="form-select" name="class_id" id="editStudentClass" required>
              <option value="">Select Class</option>
              <?php
                $classes = $conn->query("SELECT id, class_name, section FROM classes ORDER BY class_name, section");
                while($c = $classes->fetch_assoc()){
                    $display = htmlspecialchars($c['class_name']);
                    if(!empty($c['section'])) $display .= " - " . htmlspecialchars($c['section']);
                    echo "<option value='{$c['id']}'>{$display}</option>";
                }
              ?>
            </select>

          </div>

          <div class="mb-3">
            <label class="form-label">Father's Name</label>
            <input type="text" class="form-control" id="editStudentFather" name="father_name">
          </div>
          <div class="mb-3">
            <label class="form-label">Mother's Name</label>
            <input type="text" class="form-control" id="editStudentMother" name="mother_name">
          </div>
          <div class="mb-3">
            <label class="form-label">CGPA</label>
            <input type="text" class="form-control" id="editStudentCgpa" name="cgpa">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" id="editStudentEmail" name="email" required>
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


<!-- Delete Student Modal -->
<div class="modal fade zoom-in" id="deleteStudentModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Delete Student</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete <b id="deleteStudentName"></b>?</p>
      </div>
      <div class="modal-footer">
        <form action="processes/delete-std.php" method="POST">
          <input type="hidden" name="student_id" id="deleteStudentId">
          <button type="submit" class="btn btn-danger">Yes, Delete</button>
        </form>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


      <!-- Download Modal -->
      <div class="modal fade" id="downloadModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white">
              <h5 class="modal-title">Download Student Report</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p>Download report for <b id="downloadName"></b>.</p>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success">Download PDF</button>
              <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Add Student Modal -->
      <div class="modal fade zoom-in" id="addStudentModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Add Student</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="processes/add-student-process.php" method="POST">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="student_name" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Roll</label>
            <input type="text" class="form-control" name="roll" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Class</label>
            <select class="form-select" name="class_id" required>
              <option value="" disabled selected>Select Class</option>
              <?php
                $classes_res = $conn->query("SELECT id, class_name, section FROM classes ORDER BY class_name, section");
                while($class = $classes_res->fetch_assoc()){
                    $display = htmlspecialchars($class['class_name']);
                    if(!empty($class['section'])){
                        $display .= " - " . htmlspecialchars($class['section']);
                    }
                    echo "<option value='".intval($class['id'])."'>$display</option>";
                }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Father’s Name</label>
            <input type="text" class="form-control" name="father_name">
          </div>
          <div class="mb-3">
            <label class="form-label">Mother’s Name</label>
            <input type="text" class="form-control" name="mother_name">
          </div>
          <div class="mb-3">
            <label class="form-label">CGPA</label>
            <input type="text" class="form-control" name="cgpa">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email">
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
    // View Student
    var viewModal = document.getElementById('viewStudentModal');
    viewModal.addEventListener('show.bs.modal', function(event){
      var button = event.relatedTarget;
      document.getElementById('viewStudentName').innerText = "Name: " + button.dataset.name;
      document.getElementById('viewStudentRoll').innerText = button.dataset.roll;
      document.getElementById('viewStudentClass').innerText = button.dataset.class;
      document.getElementById('viewStudentFather').innerText = button.dataset.father;
      document.getElementById('viewStudentMother').innerText = button.dataset.mother;
      document.getElementById('viewStudentCgpa').innerText = button.dataset.cgpa;
      document.getElementById('viewStudentEmail').innerText = button.dataset.email;
    });

// Edit Student
var editModal = document.getElementById('editStudentModal');
editModal.addEventListener('show.bs.modal', function(event){
    var button = event.relatedTarget;

    document.getElementById('editStudentId').value = button.dataset.id;
    document.getElementById('editStudentName').value = button.dataset.name;
    document.getElementById('editStudentRoll').value = button.dataset.roll;
    document.getElementById('editStudentClass').value = button.dataset.class;
    document.getElementById('editStudentFather').value = button.dataset.father || '';
    document.getElementById('editStudentMother').value = button.dataset.mother || '';
    document.getElementById('editStudentCgpa').value = button.dataset.cgpa || '';
    document.getElementById('editStudentEmail').value = button.dataset.email;
    document.getElementById('editStudentClass').value = student.class_id;
});


// Delete Student Modal
var deleteModal = document.getElementById('deleteStudentModal');
deleteModal.addEventListener('show.bs.modal', function(event){
    var button = event.relatedTarget;
    var studentName = button.dataset.name;
    var studentId = button.dataset.id;

    document.getElementById('deleteStudentName').innerText = studentName;
    document.getElementById('deleteStudentId').value = studentId;
});

  </script>
</body>
</html>
