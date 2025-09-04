<?php
  require('backend/config/auth.php');
  restrict_page(['admin']);
  require_once("backend/config/config.php");

  // Current logged-in user
  $user_id = $_SESSION['user_id'];

  // Fetch user info with profile
  $sql = "SELECT u.username, u.email, u.role, p.designation, p.profile_pic
          FROM users u
          LEFT JOIN user_profile p ON u.user_id = p.user_id
          WHERE u.user_id = ?";
  $stmt = $conn->prepare($sql);
  if (!$stmt) die("SQL Error: " . $conn->error);
  $stmt->bind_param("s", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  // Fetch site settings (single-row table)
  $settings_sql = "SELECT * FROM settings LIMIT 1";
  $settings_result = $conn->query($settings_sql);
  $settings = $settings_result->fetch_assoc();
?>

<?php $active_page = 'settings.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Settings | Schoolizer</title>
<?php require_once("includes/link.php"); ?>
<style>
  .profile-pic { width:100px; height:100px; object-fit:cover; border-radius:50%; }
</style>
</head>
<body>
<?php require_once("includes/sidebar.php"); ?>

<div class="main-content p-4">
  <div class="container">
     <div class="row">
       <!-- Profile Header -->
       <div class="text-center mb-4 col-md-3">
         <img src="<?= !empty($user['profile_pic']) ? 'uploads/'.$user['profile_pic'] : 'assets/images/default-profile.png' ?>" 
              alt="Profile Picture" class="profile-pic mb-2">
         <h3 class="mb-0"><?= htmlspecialchars($_SESSION['username']) ?></h3>
         <p class="text-muted"><?= htmlspecialchars($_SESSION['role']) ?></p>
       </div>
       
       <div class="col-md-9">
         <!-- Tabs -->
         <ul class="nav nav-tabs mb-4" id="settingsTab" role="tablist">
           <li class="nav-item">
             <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#general" type="button">General</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#appearance" type="button">Appearance</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#security" type="button">Security</button>
            </li>
          </ul>
   
          <form action="processes/update-settings-process.php" method="POST" enctype="multipart/form-data">
            <div class="tab-content" id="settingsTabContent">
      
              <!-- General Tab -->
              <div class="tab-pane fade show active" id="general">
                <div class="card mb-4">
                  <div class="card-header bg-dark text-white">General Settings</div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">School Name</label>
                          <input type="text" class="form-control" name="school_name" 
                                  value="<?= htmlspecialchars($settings['school_name'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Address</label>
                          <input type="text" class="form-control" name="school_address" 
                                  value="<?= htmlspecialchars($settings['school_address'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Phone</label>
                          <input type="text" class="form-control" name="school_phone" 
                                  value="<?= htmlspecialchars($settings['school_phone'] ?? '') ?>" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label">Email</label>
                          <input type="email" class="form-control" name="school_email" 
                                  value="<?= htmlspecialchars($settings['school_email'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Logo</label>
                          <input type="file" class="form-control" name="school_logo">
                          <?php if (!empty($settings['school_logo'])): ?>
                            <img src="assets/images/uploads/<?= $settings['school_logo'] ?>" class="mt-2" style="height:50px;">
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
      
              <!-- Appearance Tab -->
              <div class="tab-pane fade" id="appearance">
                <div class="card mb-4">
                  <div class="card-header bg-primary text-white">Appearance Settings</div>
                  <div class="card-body">
                    <div class="mb-3">
                      <label class="form-label">Primary Color</label>
                      <input type="color" class="form-control form-control-color" name="primary_color" 
                              value="<?= htmlspecialchars($settings['primary_color'] ?? '#175B8C') ?>">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Secondary Color</label>
                      <input type="color" class="form-control form-control-color" name="secondary_color" 
                              value="<?= htmlspecialchars($settings['secondary_color'] ?? '#F24515') ?>">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Favicon</label>
                      <input type="file" class="form-control" name="favicon">
                      <?php if (!empty($settings['favicon'])): ?>
                        <img src="uploads/<?= $settings['favicon'] ?>" class="mt-2" style="height:20px;">
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
      
              <!-- Security Tab -->
              <div class="tab-pane fade" id="security">
                <div class="card mb-4">
                  <div class="card-header bg-danger text-white">Security Settings</div>
                  <div class="card-body">
                    <div class="mb-3">
                      <label class="form-label">Admin Password</label>
                      <input type="password" class="form-control" name="admin_pass" placeholder="Enter new password if changing">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Enable Two-Factor Authentication</label>
                      <select class="form-select" name="two_factor">
                        <option value="1" <?= (!empty($settings['two_factor']) && $settings['two_factor'] == 1) ? 'selected' : '' ?>>Yes</option>
                        <option value="0" <?= (empty($settings['two_factor']) || $settings['two_factor'] == 0) ? 'selected' : '' ?>>No</option>
                      </select>
                    </div>
                  </div>
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
  </div>
</div>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
