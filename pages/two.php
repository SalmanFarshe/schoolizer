<?php
 include("../backend/path.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School Admin Dashboard</title>
  <?php require_once("../tem_parts/link.php")?>
</head>
<body>
    <?php
        require_once("../tem_parts/sidebar.php");
        require_once("../backend/config/config.php");  // Ensure you include the database connection
    ?>
<!-- Main Content -->
  <div class="main-content">
    <h1>Class Two Students</h1>
    <p>Below is the list of students in Class Two.</p>

    <!-- Table for Students -->
    <div class="table-responsive mx-auto">
      <table class="table table-striped table-bordered text-center">
        <thead>
          <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Remark</th>
            <th>Result</th>
            <th>CGPA</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            // Fetch students from class six
            $query_students = "SELECT * FROM students WHERE class = 'two'";
            $result_students = mysqli_query($connection, $query_students);

            // Check if there are students in class six
            if (mysqli_num_rows($result_students) > 0) {
                while ($student = mysqli_fetch_assoc($result_students)) {
                    $student_id = $student['student_id'];
                    $student_name = $student['name'];

                    // Fetch the marks for each subject
                    $query_marks = "
                        SELECT m.cq_marks + m.mcq_marks AS total_marks, g.gpa
                        FROM marks m
                        JOIN grades g ON (m.cq_marks + m.mcq_marks) BETWEEN g.grade_range_start AND g.grade_range_end
                        WHERE m.student_id = '$student_id'
                    ";
                    $result_marks = mysqli_query($connection, $query_marks); 

                    // Initialize variables to calculate CGPA
                    $total_gpa = 0;
                    $subject_count = 0;

                    // Calculate the total GPA from all subjects
                    while ($marks = mysqli_fetch_assoc($result_marks)) {
                        $total_gpa += $marks['gpa'];
                        $subject_count++;
                    }

                    // Calculate CGPA (Average GPA from all subjects)
                    if ($subject_count > 0) {
                        $cgpa = $total_gpa / $subject_count;
                    } else {
                        $cgpa = 0;  // No marks available, set CGPA to 0
                    }
                    $cgpa = round($cgpa, 2);

                    // Determine the remark and result based on CGPA
                    if ($cgpa >= 4.5) {
                        $remark = "Excellent Performance";
                        $result = "A+";
                    } elseif ($cgpa >= 4.0) {
                        $remark = "Good Performance";
                        $result = "A";
                    } elseif ($cgpa >= 3.0) {
                        $remark = "Needs Improvement";
                        $result = "B";
                    } elseif ($cgpa >= 2.0) {
                        $remark = "Needs Major Improvement";
                        $result = "C";
                    } else {
                        $remark = "Poor Performance";
                        $result = "D";
                    }

                    // Display student data in table row
                    echo "<tr>
                            <td>{$student_id}</td>
                            <td>{$student_name}</td>
                            <td>{$remark}</td>
                            <td>{$result}</td>
                            <td>{$cgpa}</td>
                            <td><a href='../result.php?student_id={$student_id}' class='btn btn-primary btn-sm'>View Result</a></td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No students found for Class 2.</td></tr>";
            }

            // Close the connection
            mysqli_close($connection);
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
