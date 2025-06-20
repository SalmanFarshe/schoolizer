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
  WHERE m.student_id = '$student_id' AND m.total_marks > 0
  GROUP BY m.subject_id ASC";
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

  // Calculate CGPA
  $total_gpa = 0;
  $subject_count = 0;
  while ($row = mysqli_fetch_assoc($result_marks)) {
      // Calculate GPA and Grade for each subject
      list($grade, $gpa) = get_grade_and_gpa($row['total_marks']);
      $total_gpa += $gpa;
      $subject_count++;
  }

  // Calculate final CGPA (average GPA from all subjects)
  $cgpa = $subject_count > 0 ? $total_gpa / $subject_count : 0;
  $cgpa = number_format($cgpa, 2);  // Ensure CGPA is rounded to 2 decimal places
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

      <h3 class="text-decoration-underline text-center mb-2">PROGRESS REPORT</h3>
      <div class="row mb-4 student-details">
        <div class="col-md-6">
          <p><strong>Student's Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> <?php echo ucfirst($student_name); ?></p>
          <p><strong>Father's Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> <?php echo ucfirst($father_name); ?></p>
          <p><strong>Mother's Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> <?php echo ucfirst($mother_name); ?></p>
          <p><strong>Student's ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> <?php echo $student_id; ?></p>
          <p><strong>Examination&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> 1st semister</p>
        </div>
        <div class="col-md-6">
          <p><strong>Class&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> <?php echo ucfirst($class);?></p>
          <p><strong>Roll&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> <?php echo $roll; ?></p>
          <p><strong>Exam Held&nbsp;&nbsp;&nbsp;:</strong> Apr-25</p>
          <p><strong>Year&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong> 2025</p>
        </div>
      </div>

      <table class="table table-striped text-center">
        <thead>
          <tr>
            <th>Subject</th>
            <th>Full Marks</th>
            <th>CQ</th>
            <th>MCQ</th>
            <th>Total Marks</th>
            <th>Grade Point</th>
            <th>Letter Grade</th>
          </tr>
        </thead>
        <tbody>
        <?php
        // Reset result_marks query to start over for GPA calculation
        $result_marks = mysqli_query($connection, $query_marks);
        while ($row = mysqli_fetch_assoc($result_marks)) {
            // Calculate GPA and Grade for each subject
            list($grade, $gpa) = get_grade_and_gpa($row['total_marks']);
            echo "<tr>
                    <td>{$row['subject_name']}</td>
                    <td>100</td>
                    <td>{$row['cq_marks']}</td>
                    <td>{$row['mcq_marks']}</td>
                    <td>{$row['total_marks']}</td>
                    <td>{$gpa}</td>
                    <td>{$grade}</td>
                  </tr>";
        }
        ?>
        </tbody>
        <?php
          $total_marks_obtained = 0;
          $result_marks = mysqli_query($connection, $query_marks); // Reset the query for calculating total
          while ($row = mysqli_fetch_assoc($result_marks)) {
              $total_marks_obtained += $row['total_marks'];
          }
          ?>
          <tfoot>
            <tr>
              <th colspan="4" class="text-center">Total Marks:</th>
              <th><?php echo $total_marks_obtained; ?></th>
            </tr>
          </tfoot>
      </table>

      <div class="result-card-bottom">
        <div class="row">
          <div class="col-md-9">
            <table class="table table-striped text-center">
              <thead>
                <tr>
                  <th>GPA</th>
                  <th>Grade</th>
                  <th>Class Position</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $cgpa; ?></td>
                  <td>
                    <?php
                      if ($cgpa == 5.00) {
                        echo "A+";
                      } elseif ($cgpa >= 4.00) {
                        echo "A";
                      } elseif ($cgpa >= 3.50) {
                        echo "A-";
                      } elseif ($cgpa >= 3.00) {
                        echo "B";
                      } elseif ($cgpa >= 2.00) {
                        echo "C";
                      } elseif ($cgpa >= 1.00) {
                        echo "D";
                      } else {
                        echo "F";
                      }
                    ?>
                  </td>
                  <?php 
                    $query_rank = "
                    SELECT distinct m.student_id, SUM(m.total_marks) AS total_marks
                    FROM marks m
                    JOIN students s ON m.student_id = s.student_id
                    WHERE s.class = '$class'
                    GROUP BY m.student_id
                    ORDER BY total_marks DESC";
                    
                    $position = 0;
                    $result_rank = mysqli_query($connection, $query_rank);

                    if ($result_rank) {
                        while ($row_rank = mysqli_fetch_assoc($result_rank)) {
                            $position++;
                            if ($row_rank['student_id'] == $student_id) {
                                break; // Stop once the current student's position is found
                            }
                        }
                        $total_students = mysqli_num_rows($result_rank); // Total students in the class
                    } else {
                        $position = "N/A";
                        $total_students = "N/A";
                    }
                    ?>
                    <?php 
                      if($position > 3)
                      {
                        ?>
                        <td>
                          <?php echo $position . "th" . " of " . $total_students . " students"; ?>
                        </td>
                        <?php
                      }
                      else if($position == 1){
                        ?>
                          <td><?php echo $position . "st" . " of " . $total_students . " students"; ?></td>
                        <?php
                      }
                      else if($position == 2){
                        ?>
                          <td><?php echo $position . "nd" . " of " . $total_students . " students"; ?></td>
                        <?php
                      }
                      else if($position == 3){
                        ?>
                          <td><?php echo $position . "rd" . " of " . $total_students . " students"; ?></td>
                        <?php
                      }
                    ?>
                </tr>
              </tbody>
            </table>
            <table class="table table-striped text-center">
              <thead>
                <tr>
                  <th class="remarks h3">
                    <?php
                      if ($cgpa == 5.00) {
                        echo "Excellent";
                      } elseif ($cgpa >= 4.00) {
                        echo "Very Good";
                      } elseif ($cgpa >= 3.00) {
                        echo "Good";
                      } elseif ($cgpa >= 2.00) {
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
          <div class="col-md-3">
            <?php
              include("backend/phpqrcode/qrlib.php");
              $student_data = "Name: Md. Mahin Babu\nStudent ID: 20050560\nClass: Five\nRoll: 5\nResult: 4.78";
              $qr_code_file = 'assets/qrcodes/student_result_qr.png';
              QRcode::png($student_data, $qr_code_file);
            ?>
            <img src="<?php echo $qr_code_file ?>" alt="Student Result QR Code" class="qr-img">
          </div>
        </div>
      </div>

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

      <div class="mt-4 text-center no-print">
        <button onclick="printPage()" class="btn btn-secondary">Print</button>
        <a href="<?php echo BASE_URL?>pages/dashboard.php" class="btn btn-primary">Return to Dashboard</a>
      </div>
    </div>
  </div>
</body>
</html>
