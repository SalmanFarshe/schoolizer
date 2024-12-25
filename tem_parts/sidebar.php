<!-- Sidebar -->
  <div class="sidebar">
    <div class="text-center">
      <a href="<?php echo BASE_URL?>pages/dashboard.php" class="logo">
        <img class="m-auto logo_img" src="<?php echo BASE_URL?>assets/img/logo/logo-black.png" alt="School Logo" class="img-fluid rounded-circle">
      </a>    
      <!-- <h1 class="school_name">Decent International School</h1> -->
    </div>
    <a href="<?php echo BASE_URL?>pages/dashboard.php"><i class="bi bi-speedometer2 icon"></i> Dashboard</a>
    <a class="dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#classesDropdown" aria-expanded="false" aria-controls="classesDropdown">
      <i class="bi bi-list-nested icon"></i> Classes
    </a>
    <div class="collapse show" id="classesDropdown">
      <a href="<?php echo BASE_URL?>pages/six.php"><i class="bi bi-box-arrow-in-right icon"></i> Six</a>
      <a href="<?php echo BASE_URL?>pages/seven.php"><i class="bi bi-box-arrow-in-right icon"></i> Seven</a>
      <a href="<?php echo BASE_URL?>pages/eight.php"><i class="bi bi-box-arrow-in-right icon"></i> Eight</a>
      <a href="<?php echo BASE_URL?>pages/nine.php"><i class="bi bi-box-arrow-in-right icon"></i> Nine</a>
      <a href="<?php echo BASE_URL?>pages/ten.php"><i class="bi bi-box-arrow-in-right icon"></i> Ten</a>
    </div>
    <a href="<?php echo BASE_URL?>pages/students.php"><i class="bi bi-people icon"></i> Students</a>
    <a href="<?php echo BASE_URL?>pages/teachers.php"><i class="bi bi-person-badge icon"></i> Teachers</a>
    <!-- <a href="<?php #echo BASE_URL?>pages/logout.php"><i class="bi bi-box-arrow-right icon"></i> Logout</a> -->
  </div>