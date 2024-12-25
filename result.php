<?php
  // Include the database connection
  include("backend/path.php");
  include("backend/config/config.php");

  // Sanitize the student_id input to prevent SQL injection
  $student_id = mysqli_real_escape_string($connection, $_GET['student_id']);  // Sanitize the student_id

  // Query to fetch student's basic info
  $query_student_info = "SELECT * FROM students WHERE student_id = '$student_id'";
  $result_student_info = mysqli_query($connection, $query_student_info);

  // Check if student data is found
  if (mysqli_num_rows($result_student_info) > 0) {
      $student_info = mysqli_fetch_assoc($result_student_info);
      $student_name = $student_info['name'];
      $father_name = $student_info['father_name'];
      $mother_name = $student_info['mother_name'];
      $class = $student_info['class'];
      $roll = $student_info['roll'];
  } else {
      echo "Student not found.";
      exit;
  }

  // Query to fetch marks for the student
  $query_marks = "
  SELECT s.subject_name, m.cq_marks, m.mcq_marks, m.total_marks
  FROM marks m
  JOIN subjects s ON m.subject_id = s.subject_id
  WHERE m.student_id = '$student_id'";
  $result_marks = mysqli_query($connection, $query_marks);

  // Function to calculate grade and GPA
  function get_grade_and_gpa($total_marks) {
      if ($total_marks >= 80) {
          return ['A+', 5];
      } elseif ($total_marks >= 70) {
          return ['A', 4];
      } elseif ($total_marks >= 60) {
          return ['A-', 3.5];
      } elseif ($total_marks >= 50) {
          return ['B', 3];
      } elseif ($total_marks >= 40) {
          return ['C', 2];
      } elseif ($total_marks >= 33) {
          return ['D', 1];
      } else {
          return ['F', 0];
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Progress Report</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/result.css">
  <script>
    function printPage() {
      window.print();
    }
  </script>
</head>
<body>
  <div class="container">
    <div class="report-card">
      <div class="report-card-header">
        <div class="row justify-content-between">
          <div class="col-md-3">
            <img src="./assets/img/logo/logo-black.png" alt="" class="result-card-image">
          </div>
          <div class="col-md-6 text-center">
            <h2 class="h3 text-uppercase">Decent International School</h2>
            <h2 class="h5">Since 2005</h2>
            <p>Narshinghapur, Ashulia, Savar, Dhaka-1341</p>
          </div>
          <div class="col-md-3">
            <!-- Grade Chart -->
            <div class="grade-chart">
              <table class="table table-striped text-center">
                <thead>
                  <tr>
                    <th>Range</th>
                    <th>Grade</th>
                    <th>GPA</th>
                  </tr>
                </thead>
                <tbody>
                  <tr><td>80-100</td><td>A+</td><td>5</td></tr>
                  <tr><td>70-79</td><td>A</td><td>4</td></tr>
                  <tr><td>60-69</td><td>A-</td><td>3.5</td></tr>
                  <tr><td>50-59</td><td>B</td><td>3</td></tr>
                  <tr><td>40-49</td><td>C</td><td>2</td></tr>
                  <tr><td>33-39</td><td>D</td><td>1</td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>  
      </div>  
      <!-- Student Details -->
      <h3 class="text-decoration-underline text-center mb-2">PROGRESS REPORT</h3>
      <div class="row mb-4 student-details">
        <div class="col-md-6">
          <p><strong>Student's Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> <?php echo $student_name; ?></p>
          <p><strong>Father's Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> <?php echo $father_name; ?></p>
          <p><strong>Mother's Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> <?php echo $mother_name; ?></p>
          <p><strong>Student's ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> <?php echo $student_id; ?></p>
          <p><strong>Examination&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> Annual</p>
        </div>
        <div class="col-md-6">
          <p><strong>Class&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> <?php echo $class; ?></p>
          <p><strong>Group&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> </p>
          <p><strong>Roll&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> <?php echo $roll; ?></p>
          <p><strong>Exam Held&nbsp;&nbsp;&nbsp;:</strong> Dec-24</p>
          <p><strong>Year&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> 2024</p>
        </div>
      </div>

      <!-- Subject Marks Table -->
      <table class="table table-striped text-center">
        <thead>
          <tr>
            <th>Subject</th>
            <th>Full Marks</th>
            <!-- <th>Highest Marks</th> -->
            <!-- <th>CA</th> -->
            <th>CQ</th>
            <th>MCQ</th>
            <!-- <th>AS</th> -->
            <th>Total Marks</th>
            <th>Grade Point</th>
            <th>Letter Grade</th>
          </tr>
        </thead>
        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result_marks)) {
            list($grade, $gpa) = get_grade_and_gpa($row['total_marks']);
            echo "<tr>
                    <td>{$row['subject_name']}</td>
                    <td>100</td>
                    <!-- <td>98.60</td> -->
                    <!-- <td>30</td> -->
                    <td>{$row['cq_marks']}</td>
                    <td>{$row['mcq_marks']}</td>
                    <!-- <td>-</td> -->
                    <td>{$row['total_marks']}</td>
                    <td>{$gpa}</td>
                    <td>{$grade}</td>
                  </tr>";
        }
        ?>
        </tbody>
      </table>

      <!-- Result Summary -->
      <div class="result-card-bottom">
        <div class="row">
          <div class="col-md-9">
            <table class="table table-striped text-center">
              <thead>
                <tr>
                  <th>GPA</th>
                  <th>Grade</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $gpa; ?></td>
                  <td><?php echo $grade; ?></td>
                </tr>
              </tbody>
            </table>
            <table class="table table-striped text-center">
              <thead>
                <tr>
                  <th class="remarks h3">
                    <?php
                      // Display remarks based on GPA
                      if ($gpa == 5) {
                        echo "Excellent";
                      } elseif ($gpa >= 4) {
                        echo "Very Good";
                      } elseif ($gpa >= 3) {
                        echo "Good";
                      } elseif ($gpa >= 2) {
                        echo "Satisfactory";
                      } else {
                        echo "Needs Improvement";
                      }
                    ?>
                  </th>
                </tr>
              </thead>
            </table>
          </div>

          <!-- QR code -->
          <?php
            include("backend/phpqrcode/qrlib.php");
            // Dynamic student data for QR code generation
            $student_data = "Name: {$student_name}\nStudent ID: {$student_id}\nClass: {$class}\nRoll: {$roll}\nResult: {$grade}\nGPA: {$gpa}";
            // Generate QR code
            $qr_code_file = 'assets/qrcodes/student_result_qr.png';
            QRcode::png($student_data, $qr_code_file);
          ?>
        <div class="col-md-3">
          <img src="<?php echo $qr_code_file ?>" alt="Student Result QR Code" class="qr-img">
        </div>
      </div>
    </div>

    <!-- Signatures -->
    <div class="signature-section">
      <div class="signature-box">
        <p>_______________________</p>
        <p>Guardian</p>
      </div>
      <div class="signature-box">
        <p>_______________________</p>
        <p>Class Teacher</p>
      </div>
      <div class="signature-box">
        <p>_______________________</p>
        <p>Principal</p>
      </div>
    </div>

    <!-- Buttons (hidden during print) -->
    <div class="mt-4 text-center no-print">
      <button onclick="printPage()" class="btn btn-secondary">Print</button>
      <a href="<?php echo BASE_URL?>pages/dashboard.php" class="btn btn-primary">Return to Dashboard</a>
    </div>
  </div>
</body>
</html>
