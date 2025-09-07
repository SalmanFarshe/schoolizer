<?php
require('backend/config/config.php');
require('backend/config/auth.php');

// Only allow teacher or student
restrict_page(['teacher', 'student']); 

$active_page = 'profile.php';
include("backend/path.php");

// Get logged-in user's info
$user_id = $_SESSION['user_id']; 
$userQuery = mysqli_query($conn, "SELECT * FROM users WHERE user_id='$user_id'");
$user = mysqli_fetch_assoc($userQuery);
$role = $user['role'];

// Default profile values
$fullName = "";
$email = "";
$phone = "-";
$address = "-";
$profilePic = "assets/images/default-profile.png";
$extraInfo = "-"; // Assigned Class or Subjects

if($role === 'teacher') {
    $teacherQuery = mysqli_query($conn, "SELECT * FROM teachers WHERE teacher_id='$user_id'");
    if(mysqli_num_rows($teacherQuery) > 0){
        $teacher = mysqli_fetch_assoc($teacherQuery);
        $fullName = $teacher['name'];
        $email = $teacher['email'];
        $phone = isset($teacher['phone']) ? $teacher['phone'] : "-";
        $address = isset($teacher['address']) ? $teacher['address'] : "-";
        $profilePic = isset($teacher['profile_pic']) && $teacher['profile_pic'] != '' ? "assets/images/" . $teacher['profile_pic'] : $profilePic;

        // Assigned classes
        $classesQuery = mysqli_query($conn, "SELECT class_name, section FROM classes WHERE teacher_in_charge='$fullName'");
        $classList = [];
        while($cls = mysqli_fetch_assoc($classesQuery)) $classList[] = $cls['class_name'] . " - " . $cls['section'];
        $extraInfo = !empty($classList) ? implode(", ", $classList) : "-";

        // Subjects
        $subjectsQuery = mysqli_query($conn, "SELECT subject_name FROM subjects WHERE class_id IN (SELECT id FROM classes WHERE teacher_in_charge='$fullName')");
        $subjects = [];
        while($sub = mysqli_fetch_assoc($subjectsQuery)) $subjects[] = $sub['subject_name'];
        $subjectsList = !empty($subjects) ? implode(", ", $subjects) : "-";

    }
} elseif($role === 'student') {
    // Make sure to join users and students via email or exact ID match
    $studentQuery = mysqli_query($conn, "
        SELECT s.*, c.class_name, c.section 
        FROM students s 
        LEFT JOIN classes c ON s.class_id=c.id 
        WHERE s.student_id='{$user['user_id']}' OR s.email='{$user['email']}'
    ");
    if(mysqli_num_rows($studentQuery) > 0){
        $student = mysqli_fetch_assoc($studentQuery);
        $fullName = $student['name'];
        $email = $student['email'];
        $phone = isset($student['phone']) ? $student['phone'] : "-";
        $address = isset($student['address']) ? $student['address'] : "-";
        $profilePic = isset($student['profile_pic']) && $student['profile_pic'] != '' ? "assets/images/" . $student['profile_pic'] : $profilePic;
        $extraInfo = $student['class_name'] ? $student['class_name'] . " - " . $student['section'] : "-";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= ucfirst($role) ?> Profile | Schoolizer</title>
<?php require_once("includes/link.php"); ?>
</head>
<body>
<?php require_once("includes/sidebar.php"); ?>

<div class="main-content p-4">
<div class="container">

<!-- Page Heading -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3"><?= ucfirst($role) ?> Profile</h1>
    <button class="btn button" data-bs-toggle="modal" data-bs-target="#editProfileModal">
        <i class="bi bi-pencil-square me-1"></i> Edit Profile
    </button>
</div>

<!-- Profile Card -->
<div class="card shadow mb-4">
  <div class="card-body text-center">
    <img src="<?= $profilePic ?>" alt="<?= $fullName ?>" class="rounded-circle mb-3" style="width:120px; height:120px; object-fit:cover;">
    <h3 class="mb-0"><?= $fullName ?></h3>
    <p class="text-muted"><?= $role === 'teacher' ? 'Teacher' : 'Student' ?></p>
  </div>
</div>

<!-- Profile Details -->
<div class="card">
  <div class="card-header bg-dark text-white">Profile Details</div>
  <div class="card-body">
    <table class="table table-bordered align-middle">
      <tbody>
        <tr>
          <th class="bg-light" style="width: 200px;"><?= ucfirst($role) ?> ID</th>
          <td><?= $user_id ?></td>
        </tr>
        <tr>
          <th class="bg-light">Full Name</th>
          <td><?= $fullName ?></td>
        </tr>
        <tr>
          <th class="bg-light">Email</th>
          <td><?= $email ?></td>
        </tr>
        <tr>
          <th class="bg-light">Phone</th>
          <td><?= $phone ?></td>
        </tr>
        <tr>
          <th class="bg-light"><?= $role === 'teacher' ? 'Assigned Class' : 'Class' ?></th>
          <td><?= $extraInfo ?></td>
        </tr>
        <?php if($role === 'teacher'): ?>
        <tr>
          <th class="bg-light">Subjects</th>
          <td><?= $subjectsList ?></td>
        </tr>
        <?php endif; ?>
        <tr>
          <th class="bg-light">Address</th>
          <td><?= $address ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

</div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade zoom-in" id="editProfileModal" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
  <div class="modal-header bg-dark text-white">
    <h5 class="modal-title">Edit Profile</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
  </div>
  <div class="modal-body">
    <form method="POST" action="processes/edit-profile-process.php">
      <input type="hidden" name="user_id" value="<?= $user_id ?>">
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" class="form-control" name="name" value="<?= $fullName ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="<?= $email ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="text" class="form-control" name="phone" value="<?= $phone ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Address</label>
        <textarea class="form-control" name="address" rows="2"><?= $address ?></textarea>
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

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
