<?php include("../backend/path.php"); ?>
<?php include("../backend/config/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School Admin Dashboard</title>
  <?php require_once("../tem_parts/link.php"); ?>
</head>
<body>
    <?php require_once("../tem_parts/sidebar.php"); ?>

    <!-- Main Content -->
    <div class="main-content">
      <h1>Dashboard</h1>
      <div class="container mt-4">
        <div class="row">
          <!-- Total Students -->
          <div class="col-md-3 mb-3">
            <div class="card">
              <div class="card-body text-center">
                <h5 class="card-title">Total Students</h5>
                <p class="card-text">
                  <?php
                    // Fetch total number of students
                    $query_total_students = "SELECT COUNT(*) AS total_students FROM students";
                    $result_total_students = mysqli_query($connection, $query_total_students);
                    if ($result_total_students) {
                      $total_students = mysqli_fetch_assoc($result_total_students)['total_students'];
                      echo $total_students;
                    } else {
                      echo "Error fetching data";
                    }
                  ?>
                </p>
              </div>
            </div>
          </div>

          <!-- Total Classes -->
          <div class="col-md-3 mb-3">
            <div class="card">
              <div class="card-body text-center">
                <h5 class="card-title">Total Classes</h5>
                <p class="card-text">
                  <?php
                    // Fetch total number of unique classes
                    $query_total_classes = "SELECT COUNT(DISTINCT class) AS total_classes FROM students";
                    $result_total_classes = mysqli_query($connection, $query_total_classes);
                    if ($result_total_classes) {
                      $total_classes = mysqli_fetch_assoc($result_total_classes)['total_classes'];
                      echo $total_classes;
                    } else {
                      echo "Error fetching data";
                    }
                  ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
