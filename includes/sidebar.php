<!-- Sidebar -->
<nav class="sidebar vh-100 d-flex flex-column">
    <!-- Logo -->
    <div class="sidebar-logo text-center py-3">
        <a href="dashboard.php">
            <img src="assets/images/logo/schoolizer-logo.png" alt="Schoolizer Logo" 
                 class="img-fluid me-2 p-1 rounded bg-white" style="max-height: 50px;">
        </a>
    </div>

    <ul class="nav flex-column">

        <!-- Dashboard -->
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?php if($active_page == 'dashboard.php'){ echo 'active'; } ?>">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

        <!-- Students -->
        <li class="nav-item">
            <a href="student-list.php" class="nav-link <?php if($active_page == 'student-list.php'){ echo 'active'; } ?>">
                <i class="bi bi-people me-2"></i> Students
            </a>
        </li>

        <!-- Teachers -->
        <li class="nav-item">
            <a href="teachers.php" class="nav-link <?php if($active_page == 'teachers.php'){ echo 'active'; } ?>">
                <i class="bi bi-person-badge me-2"></i> Teachers
            </a>
        </li>

        <!-- Classes -->
        <li class="nav-item">
            <a href="class-list.php" class="nav-link <?php if($active_page == 'class-list.php'){ echo 'active'; } ?>">
                <i class="bi bi-journal-text me-2"></i> Classes
            </a>
        </li>

        <!-- Results -->
        <li class="nav-item">
            <a href="results.php" class="nav-link <?php if($active_page == 'results.php'){ echo 'active'; } ?>">
                <i class="bi bi-award me-2"></i> Results
            </a>
        </li>

        <!-- Exams -->
        <li class="nav-item">
            <a href="exams.php" class="nav-link <?php if($active_page == 'exams.php'){ echo 'active'; } ?>">
                <i class="bi bi-pencil-square me-2"></i> Exams
            </a>
        </li>

        <!-- Subjects -->
        <li class="nav-item">
            <a href="subjects.php" class="nav-link <?php if($active_page == 'subjects.php'){ echo 'active'; } ?>">
                <i class="bi bi-book me-2"></i> Subjects
            </a>
        </li>

        <!-- Routine -->
        <li class="nav-item">
            <a href="routine.php" class="nav-link <?php if($active_page == 'routine.php'){ echo 'active'; } ?>">
                <i class="bi bi-calendar-event me-2"></i> Class Routine
            </a>
        </li>

        <!-- Notices -->
        <li class="nav-item">
            <a href="notices.php" class="nav-link <?php if($active_page == 'notices.php'){ echo 'active'; } ?>">
                <i class="bi bi-megaphone me-2"></i> Notices
            </a>
        </li>

        <!-- ID Cards -->
        <li class="nav-item">
            <a href="id-cards.php" class="nav-link <?php if($active_page == 'id-cards.php'){ echo 'active'; } ?>">
                <i class="bi bi-card-text me-2"></i> ID Cards
            </a>
        </li>

        <!-- Reports -->
        <li class="nav-item">
            <a href="report.php" class="nav-link <?php if($active_page == 'report.php'){ echo 'active'; } ?>">
                <i class="bi bi-graph-up-arrow me-2"></i> Reports & Analysis
            </a>
        </li>

        <!-- Academic Calendar -->
        <li class="nav-item">
            <a href="academic-calendar.php" class="nav-link <?php if($active_page == 'academic-calendar.php'){ echo 'active'; } ?>">
                <i class="bi bi-calendar2-week me-2"></i>Calendar
            </a>
        </li>

        <!-- Settings -->
        <li class="nav-item">
            <a href="settings.php" class="nav-link <?php if($active_page == 'settings.php'){ echo 'active'; } ?>">
                <i class="bi bi-gear me-2"></i> Settings
            </a>
        </li>
        
        <!-- Logout -->
        <li class="nav-item bg-danger rounded mt-auto">
            <a href="index.php" class="nav-link text-white">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </li>
    </ul>
    




    <!-- teacher dash -->
    <li class="nav-item">
        <a href="teacher-dash.php" class="nav-link <?php if($active_page == 'teacher-dash.php'){ echo 'active'; } ?>">
            <i class="bi bi-gear me-2"></i> teacher-dash
        </a>
    </li>
    <!-- student dash -->
    <li class="nav-item">
        <a href="student-dash.php" class="nav-link <?php if($active_page == 'student-dash.php'){ echo 'active'; } ?>">
            <i class="bi bi-gear me-2"></i> student-dash
        </a>
    </li>
</nav>
