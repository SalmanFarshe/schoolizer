<?php include("../backend/path.php"); ?>
<?php include("../backend/config/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School Admin Dashboard</title>
  <?php require_once("../tem_parts/link.php"); ?>
  <style>
    .upload-section {
      border: 2px dashed #6c757d;
      padding: 20px;
      border-radius: 8px;
      background-color: #f8f9fa;
      margin-top: 20px;
    }
    .upload-section h5 {
      margin-bottom: 15px;
    }
  </style>
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
          <!-- Total Teachers -->
          <div class="col-md-3 mb-3">
            <div class="card">
              <div class="card-body text-center">
                <h5 class="card-title">Total Teachers</h5>
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

        <!-- File Upload Section -->
        <div class="row">
          <div class="col-md-12">
            <div class="upload-section text-center">
              <h5>Upload CSV File</h5>
              <p class="text-muted">Only CSV files are allowed.</p>
              <?php
                // File upload handling
                $uploadMessage = "";
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csvFile'])) {
                    $uploadDir = "../backend/results/"; // Ensure this folder exists
                    $fileTmpPath = $_FILES['csvFile']['tmp_name'];
                    $fileName = $_FILES['csvFile']['name'];
                    $fileNameCmps = pathinfo($fileName);
                    $fileExtension = strtolower($fileNameCmps['extension']);

                    // Validate file type
                    if ($fileExtension === 'csv') {
                        $newFileName = uniqid() . '.' . $fileExtension;
                        $destPath = $uploadDir . $newFileName;

                        if (move_uploaded_file($fileTmpPath, $destPath)) {
                            $uploadMessage = "<p class='text-success'>File uploaded successfully: $newFileName</p>";
                        } else {
                            $uploadMessage = "<p class='text-danger'>Error moving the uploaded file.</p>";
                        }
                    } else {
                        $uploadMessage = "<p class='text-danger'>Invalid file type. Only CSV files are allowed.</p>";
                    }
                }
              ?>
              <?php if (!empty($uploadMessage)): ?>
                <div class="mb-3"><?php echo $uploadMessage; ?></div>
              <?php endif; ?>
              <form method="POST" enctype="multipart/form-data" class="d-flex flex-column align-items-center">
                <div class="mb-3">
                  <input type="file" name="csvFile" id="csvFile" class="form-control" accept=".csv" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload File</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
