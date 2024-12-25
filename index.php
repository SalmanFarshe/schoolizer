<?php 
  include("./backend/path.php");
  include("./backend/config/config.php");
  include("./backend/config/create_tables.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>School Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <?php
        // require_once("./tem_parts/sidebar.php");
        require_once("./backend/path.php");
    ?>
    <div class="main-content">
      <a class="button btn btn-primary" href="<?php echo BASE_URL?>pages/dashboard.php">Go to Dash</a>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
