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
      <div class="dashboard-header">
        <h1>Dashboard</h1>
      </div>

      <!-- Overview Cards -->
      <div class="row justify-content-around mt-3">
        <!-- Total Students -->
        <div class="col-md-3 mb-3">
          <div class="card bxsdw">
            <div class="card-body text-center">
              <h5 class="card-title">Total Students</h5>
              <p class="card-text">
                <?php
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
          <div class="card bxsdw">
            <div class="card-body text-center">
              <h5 class="card-title">Total Classes</h5>
              <p class="card-text">
                <?php
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
        <!-- Total Classes -->
        <div class="col-md-3 mb-3">
          <div class="card bxsdw">
            <div class="card-body text-center">
              <h5 class="card-title">Total Classes</h5>
              <p class="card-text">
                <?php
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
      <div class="row justify-content-around">
        <div class="col-md-6">
          <div class="upload-section bxsdw text-center">
            <h5>Upload CSV File</h5>
            <p class="text-muted">Only CSV files are allowed.</p>
            <?php
              $uploadMessage = "";
              if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csvFile'])) {
                  $uploadDir = "../backend/results/";
                  $fileTmpPath = $_FILES['csvFile']['tmp_name'];
                  $fileName = "result.csv";

                  $fileNameCmps = pathinfo($_FILES['csvFile']['name']);
                  $fileExtension = strtolower($fileNameCmps['extension']);

                  if ($fileExtension === 'csv') {
                      $destPath = $uploadDir . $fileName;

                      if (move_uploaded_file($fileTmpPath, $destPath)) {
                          $uploadMessage = "<p class='text-success'>File uploaded successfully as $fileName</p>";
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
              <button type="submit" class="btn btn-primary">Upload Result File</button>
            </form>
          </div>
        </div>

        <!-- Reset and Generate Section -->
        <div class="col-md-5 bxsdw setting-section text-center d-flex align-items-center justify-content-center">
          <div class="">
            <!-- Reset Button -->
            <div class="mb-3">
              <form method="POST" action="../backend/reset_tables.php" onsubmit="return confirm('Are you sure you want to reset all data? This action cannot be undone.')">
                <button type="submit" class="btn btn-danger">Reset Database</button>
                <p class="warning-msg">Will reset all data. Action cannot be undone.</p>
              </form>
            </div>

            <!-- Generate New Data Button -->
            <div class="mb-3">
              <form method="POST" action="../backend/results/insert-data.php">
                <button type="submit" class="btn btn-success">Generate New Data</button>
                <p class="text-muted">Generating new data will replace the current data.</p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>