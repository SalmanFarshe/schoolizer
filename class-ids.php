<?php
    // Only admin can access
    require('backend/config/config.php');
  require('backend/config/auth.php');
  restrict_page(['admin']);
  $active_page = 'id-cards.php';
  
  include("backend/path.php");
  // Fetch all students with class info

    $class_code = $_GET['class_id'] ?? '';

    $sql = "SELECT s.*, c.class_name, c.class_id AS class_code
            FROM students s
            LEFT JOIN classes c ON s.class_id = c.id
            WHERE c.class_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $class_code);
    $stmt->execute();
    $result = $stmt->get_result();
?>


?>
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
    <?php
      // Fetch all classes
      $sqls = "SELECT class_id, class_name, section FROM classes ORDER BY class_name ASC";
      $results = $conn->query($sqls);
    ?>
    
    <!-- Quick Links -->
    <?php
    // Fetch all classes
    $sqls = "SELECT class_id, class_name, section FROM classes ORDER BY class_name ASC";
    $results = $conn->query($sqls);
    ?>
    <div class="mb-4">
    <h5>Class Quick Links</h5>
    <div class="d-flex gap-2 flex-wrap justify-content-start">
        <?php while ($rows = $results->fetch_assoc()): ?>
        <a href="class-ids.php?class_id=<?= urlencode($rows['class_id']) ?>" 
            class="btn btn-outline-success">
            <i class="bi bi-people-fill me-1"></i>
            <?= htmlspecialchars($rows['class_name']) ?> 
            <?= $rows['section'] ? '(' . htmlspecialchars($rows['section']) . ')' : '' ?>
        </a>
        <?php endwhile; ?>
    </div>
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
      <?php if(mysqli_num_rows($result) > 0): ?>
  <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td>Student</td>
      <td><?= htmlspecialchars($row['class_name'] ?? '-') ?></td>
      <td><?= htmlspecialchars($row['student_id']) ?></td>
      <td class="d-flex justify-content-center gap-1">
        <button class="btn btn-primary btn-sm viewStudentBtn" 
                data-bs-toggle="modal" data-bs-target="#viewIDModal"
                data-name="<?= htmlspecialchars($row['name']) ?>"
                data-roll="<?= htmlspecialchars($row['roll']) ?>"
                data-class="<?= htmlspecialchars($row['class_name'] ?? '-') ?>"
                data-id="<?= htmlspecialchars($row['student_id']) ?>"
                data-dob="<?= htmlspecialchars($row['dob'] ?? '-') ?>"
                data-blood="<?= htmlspecialchars($row['blood'] ?? '-') ?>"
                data-photo="<?= htmlspecialchars($row['profile_pic'] ?? 'assets/images/default-avatar.png') ?>"
                title="View/Print">
          <i class="bi bi-eye"></i>
        </button>
        <button class="btn btn-danger btn-sm deleteStudentBtn" 
                data-bs-toggle="modal" data-bs-target="#deleteIDModal"
                data-name="<?= htmlspecialchars($row['name']) ?>"
                data-id="<?= htmlspecialchars($row['student_id']) ?>"
                title="Delete">
          <i class="bi bi-trash"></i>
        </button>
      </td>
    </tr>
  <?php endwhile; ?>
<?php else: ?>
  <tr>
    <td colspan="5">No students found.</td>
  </tr>
<?php endif; ?>

    </tbody>
  </table>
</div>


</div>
</div>

<!-- viewIDModal ID Card Modal -->
<div class="modal fade" id="viewIDModal" tabindex="-1">
  <div class="modal-dialog modal-l modal-dialog-centered">
    <div class="modal-content shadow-lg">
      
      <!-- Modal Header -->
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-credit-card-2-front me-2"></i> Generate Student ID Card
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <div class="id-card-container d-flex justify-content-center gap-5 flex-wrap">

          <!-- FRONT SIDE -->
          <div class="id-card border rounded-3 shadow-sm p-3 position-relative"
               style="width: 350px; background:#fdfdfd; border:1px solid #e0e0e0;">
            
            <!-- Header -->
            <div class="d-flex align-items-center border-bottom pb-2 mb-3" style="border-color:#175B8C;">
              <img src="assets/images/school-logo.png" alt="School Logo" class="me-2"
                   style="height:50px; width:50px; object-fit:contain;">
              <div>
                <h5 class="mb-0 text-primary fw-bold">Schoolizer High School</h5>
                <small class="text-muted">Student ID Card</small>
              </div>
            </div>

            <!-- Student Info -->
            <div class="row g-2">
              <!-- Photo -->
              <div class="col-4 text-center">
                <img id="idPhoto" src="assets/images/uploads/1756923403_51d66de6686cf864.jpg"
                     class="img-fluid rounded-circle border border-2 border-primary"
                     style="height:100px; width:100px; object-fit:cover;">
                <p class="mb-0 mt-2 small"><strong>Roll:</strong> <span id="idRoll">12</span></p>
                <p class="mb-0 small"><strong>Class:</strong> <span id="idClass">10</span></p>
              </div>
              <!-- Details -->
              <div class="col-8">
                <p class="mb-1 small"><strong>Name:</strong> <span id="idName">John Doe</span></p>
                <p class="mb-1 small"><strong>Role:</strong> <span id="idRole">Student</span></p>
                <p class="mb-1 small"><strong>ID:</strong> <span id="idNumber">STU001</span></p>
                <p class="mb-1 small"><strong>DOB:</strong> <span id="idDob">01-01-2010</span></p>
                <p class="mb-1 small"><strong>Blood:</strong> <span id="idBlood">O+</span></p>
              </div>
            </div>

            <!-- Footer -->
            <div class="position-absolute bottom-0 start-0 end-0 text-white text-center py-1 rounded-bottom"
                 style="background:#175B8C;">
              <small class="fw-bold">Authorized by Principal</small>
            </div>
          </div>

          <!-- BACK SIDE -->
          <div class="id-card border rounded-3 shadow-sm p-3"
               style="width: 350px; background:#fff; border:1px solid #e0e0e0;">
            
            <!-- Header -->
            <div class="border-bottom pb-2 mb-3 text-center" style="border-color:#F24515;">
              <h6 class="mb-0 text-danger fw-bold">School Information</h6>
            </div>

            <!-- School Info -->
            <div class="text-start ps-2 small">
              <p class="mb-2 fw-bold">Schoolizer High School</p>
              <p class="mb-1"><i class="bi bi-geo-alt-fill me-1"></i> 123 School Road, Dhaka</p>
              <p class="mb-1"><i class="bi bi-telephone-fill me-1"></i> +880 1234-567890</p>
              <p class="mb-1"><i class="bi bi-envelope-fill me-1"></i> contact@schoolizer.edu</p>
              <p class="mb-1"><i class="bi bi-globe me-1"></i> www.schoolizer.edu</p>
            </div>

            <!-- Motto -->
            <div class="mt-3 p-2 text-center text-white rounded" style="background:#F24515;">
              <small><em>"Excellence in Education"</em></small>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <button class="btn btn-success" onclick="printIDCard()">Print</button>
        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
          Cancel
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Generate ID Card Modal -->
<div class="modal fade" id="generateIDModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content shadow-lg">

      <!-- Modal Header -->
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-credit-card-2-front me-2"></i> Generate Student ID Card
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <div class="row g-3">

          <!-- Student Info Inputs -->
          <div class="col-12 col-md-6">
            <label class="form-label fw-bold">Name</label>
            <input type="text" id="inputName" class="form-control" placeholder="Enter student's full name">

            <label class="form-label fw-bold mt-2">Roll Number</label>
            <input type="text" id="inputRoll" class="form-control" placeholder="Enter roll number">

            <label class="form-label fw-bold mt-2">Class</label>
            <input type="text" id="inputClass" class="form-control" placeholder="Enter class">

            <label class="form-label fw-bold mt-2">Student ID</label>
            <input type="text" id="inputID" class="form-control" placeholder="Enter student ID">

            <label class="form-label fw-bold mt-2">Date of Birth</label>
            <input type="date" id="inputDob" class="form-control">

            <label class="form-label fw-bold mt-2">Blood Group</label>
            <input type="text" id="inputBlood" class="form-control" placeholder="Enter blood group">
          </div>

          <!-- Photo Upload -->
          <div class="col-12 col-md-6">
            <label class="form-label fw-bold">Upload Photo</label>
            <input type="file" id="inputPhoto" class="form-control">
          </div>

        </div>

        <!-- ID Card Preview -->
        <div class="id-card-container d-flex justify-content-center gap-5 flex-wrap mt-4" id="idCardsToPrint">

          <!-- FRONT SIDE -->
          <div class="id-card border rounded-3 shadow-sm p-3 position-relative"
               style="width: 350px; background:#fdfdfd; border:1px solid #e0e0e0;">
            
            <!-- Header -->
            <div class="d-flex align-items-center border-bottom pb-2 mb-3" style="border-color:#175B8C;">
              <img src="assets/images/school-logo.png" alt="School Logo" class="me-2"
                   style="height:50px; width:50px; object-fit:contain;">
              <div>
                <h5 class="mb-0 text-primary fw-bold">Schoolizer High School</h5>
                <small class="text-muted">Student ID Card</small>
              </div>
            </div>

            <!-- Student Info -->
            <div class="row g-2">
              <div class="col-4 text-center">
                <img id="previewPhoto" src="assets/images/default-avatar.png"
                     class="img-fluid rounded-circle border border-2 border-primary"
                     style="height:100px; width:100px; object-fit:cover;">
                <p class="mb-0 mt-2 small"><strong>Roll:</strong> <span id="previewRoll">-</span></p>
                <p class="mb-0 small"><strong>Class:</strong> <span id="previewClass">-</span></p>
              </div>
              <div class="col-8">
                <p class="mb-1 small"><strong>Name:</strong> <span id="previewName">-</span></p>
                <p class="mb-1 small"><strong>Role:</strong> Student</p>
                <p class="mb-1 small"><strong>ID:</strong> <span id="previewID">-</span></p>
                <p class="mb-1 small"><strong>DOB:</strong> <span id="previewDob">-</span></p>
                <p class="mb-1 small"><strong>Blood:</strong> <span id="previewBlood">-</span></p>
              </div>
            </div>

            <!-- Footer -->
            <div class="position-absolute bottom-0 start-0 end-0 text-white text-center py-1 rounded-bottom"
                 style="background:#175B8C;">
              <small class="fw-bold">Authorized by Principal</small>
            </div>
          </div>

          <!-- BACK SIDE -->
          <div class="id-card border rounded-3 shadow-sm p-3"
               style="width: 350px; background:#fff; border:1px solid #e0e0e0;">
            
            <!-- Header -->
            <div class="border-bottom pb-2 mb-3 text-center" style="border-color:#F24515;">
              <h6 class="mb-0 text-danger fw-bold">School Information</h6>
            </div>

            <!-- School Info -->
            <div class="text-start ps-2 small">
              <p class="mb-2 fw-bold">Schoolizer High School</p>
              <p class="mb-1"><i class="bi bi-geo-alt-fill me-1"></i> 123 School Road, Dhaka</p>
              <p class="mb-1"><i class="bi bi-telephone-fill me-1"></i> +880 1234-567890</p>
              <p class="mb-1"><i class="bi bi-envelope-fill me-1"></i> contact@schoolizer.edu</p>
              <p class="mb-1"><i class="bi bi-globe me-1"></i> www.schoolizer.edu</p>
            </div>

            <!-- Motto -->
            <div class="mt-3 p-2 text-center text-white rounded" style="background:#F24515;">
              <small><em>"Excellence in Education"</em></small>
            </div>
          </div>

        </div>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-success px-4" onclick="printIDCard('idCardsToPrint')">
          <i class="bi bi-printer me-1"></i> Print
        </button>
        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
          Cancel
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  // Update ID Card dynamically
  const inputName = document.getElementById('inputName');
  const inputRoll = document.getElementById('inputRoll');
  const inputClass = document.getElementById('inputClass');
  const inputID = document.getElementById('inputID');
  const inputDob = document.getElementById('inputDob');
  const inputBlood = document.getElementById('inputBlood');
  const inputPhoto = document.getElementById('inputPhoto');

  inputName.addEventListener('input', () => document.getElementById('previewName').innerText = inputName.value || '-');
  inputRoll.addEventListener('input', () => document.getElementById('previewRoll').innerText = inputRoll.value || '-');
  inputClass.addEventListener('input', () => document.getElementById('previewClass').innerText = inputClass.value || '-');
  inputID.addEventListener('input', () => document.getElementById('previewID').innerText = inputID.value || '-');
  inputDob.addEventListener('input', () => document.getElementById('previewDob').innerText = inputDob.value || '-');
  inputBlood.addEventListener('input', () => document.getElementById('previewBlood').innerText = inputBlood.value || '-');
  
  inputPhoto.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if(file){
      const reader = new FileReader();
      reader.onload = () => document.getElementById('previewPhoto').src = reader.result;
      reader.readAsDataURL(file);
    }
  });

  // Print function
  function printIDCard(id) {
    const printContents = document.getElementById(id).outerHTML;
    const originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload(); // reload to restore modal
  }
</script>

<script>
  // Fill view ID modal dynamically
  document.querySelectorAll('.viewStudentBtn').forEach(button => {
    button.addEventListener('click', function() {
      const name = this.dataset.name;
      const roll = this.dataset.roll;
      const studentClass = this.dataset.class;
      const studentId = this.dataset.id;
      const dob = this.dataset.dob;
      const blood = this.dataset.blood;
      const photo = this.dataset.photo;

      document.getElementById('idName').innerText = name;
      document.getElementById('idRoll').innerText = roll;
      document.getElementById('idClass').innerText = studentClass;
      document.getElementById('idNumber').innerText = studentId;
      document.getElementById('idDob').innerText = dob;
      document.getElementById('idBlood').innerText = blood;
      document.getElementById('idPhoto').src = photo;
    });
  });

  // Fill delete modal dynamically
  document.querySelectorAll('.deleteStudentBtn').forEach(button => {
    button.addEventListener('click', function() {
      const name = this.dataset.name;
      const studentId = this.dataset.id;
      document.getElementById('deleteIDName').innerText = name;
      // You can add deletion logic here
    });
  });
</script>

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
