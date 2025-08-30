<?php
    // Only admin can access
  require('backend/config/auth.php');
  restrict_page(['admin']);
?>
<?php $active_page = 'settings.php'; ?>
<?php include("backend/path.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Settings | Schoolizer</title>
<?php require_once("includes/link.php"); ?>
</head>
<body>
<?php require_once("includes/sidebar.php"); ?>

<div class="main-content p-4">
<div class="container">
  <h1 class="h3 mb-4">Settings</h1>

  <form action="update-settings.php" method="POST" enctype="multipart/form-data">
    <!-- General Settings -->
    <div class="card mb-4">
      <div class="card-header bg-dark text-white">
        General Settings
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label">School Name</label>
          <input type="text" class="form-control" name="school_name" value="Schoolizer" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Address</label>
          <input type="text" class="form-control" name="school_address" value="123 Main Street" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Phone</label>
          <input type="text" class="form-control" name="school_phone" value="+880123456789" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="school_email" value="info@schoolizer.com" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Logo</label>
          <input type="file" class="form-control" name="school_logo">
        </div>
      </div>
    </div>

    <!-- Appearance Settings -->
    <div class="card mb-4">
      <div class="card-header bg-primary text-white">
        Appearance Settings
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label">Primary Color</label>
          <input type="color" class="form-control form-control-color" name="primary_color" value="#175B8C">
        </div>
        <div class="mb-3">
          <label class="form-label">Secondary Color</label>
          <input type="color" class="form-control form-control-color" name="secondary_color" value="#F24515">
        </div>
        <div class="mb-3">
          <label class="form-label">Favicon</label>
          <input type="file" class="form-control" name="favicon">
        </div>
      </div>
    </div>

    <!-- Email / Notification Settings -->
    <div class="card mb-4">
      <div class="card-header bg-success text-white">
        Email & Notification Settings
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label">SMTP Host</label>
          <input type="text" class="form-control" name="smtp_host" value="smtp.mail.com">
        </div>
        <div class="mb-3">
          <label class="form-label">SMTP Port</label>
          <input type="text" class="form-control" name="smtp_port" value="587">
        </div>
        <div class="mb-3">
          <label class="form-label">SMTP Username</label>
          <input type="text" class="form-control" name="smtp_user" value="admin@mail.com">
        </div>
        <div class="mb-3">
          <label class="form-label">SMTP Password</label>
          <input type="password" class="form-control" name="smtp_pass">
        </div>
        <div class="mb-3">
          <label class="form-label">Send Notifications To Admin</label>
          <select class="form-select" name="notify_admin">
            <option value="1" selected>Yes</option>
            <option value="0">No</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Security Settings -->
    <div class="card mb-4">
      <div class="card-header bg-danger text-white">
        Security Settings
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label">Admin Password</label>
          <input type="password" class="form-control" name="admin_pass" placeholder="Enter new password if changing">
        </div>
        <div class="mb-3">
          <label class="form-label">Enable Two-Factor Authentication</label>
          <select class="form-select" name="two_factor">
            <option value="1">Yes</option>
            <option value="0" selected>No</option>
          </select>
        </div>
      </div>
    </div>

    <div class="text-end mb-5">
      <button type="submit" class="btn btn-success">Save Changes</button>
      <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
  </form>
</div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
