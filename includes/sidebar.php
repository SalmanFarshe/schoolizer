<?php
    // session_start();

    // Check if user is logged in
    if (!isset($_SESSION['role'])) {
        header("Location: index.php");
        exit();
    }

    $role = $_SESSION['role']; // admin / teacher / student
    $username = $_SESSION['username'];
?>
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

        <?php if($role === 'admin'): ?>
            <!-- Admin-only links -->
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link <?php if($active_page == 'dashboard.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="student-list.php" class="nav-link <?php if($active_page == 'student-list.php'){ echo 'active'; } ?>">
                    <i class="bi bi-people me-2"></i> Students
                </a>
            </li>
            <li class="nav-item">
                <a href="teachers.php" class="nav-link <?php if($active_page == 'teachers.php'){ echo 'active'; } ?>">
                    <i class="bi bi-person-badge me-2"></i> Teachers
                </a>
            </li>
            <li class="nav-item">
                <a href="class-list.php" class="nav-link <?php if($active_page == 'class-list.php'){ echo 'active'; } ?>">
                    <i class="bi bi-journal-text me-2"></i> Classes
                </a>
            </li>
            <li class="nav-item">
                <a href="results.php" class="nav-link <?php if($active_page == 'results.php'){ echo 'active'; } ?>">
                    <i class="bi bi-award me-2"></i> Results
                </a>
            </li>
            <li class="nav-item">
                <a href="exams.php" class="nav-link <?php if($active_page == 'exams.php'){ echo 'active'; } ?>">
                    <i class="bi bi-pencil-square me-2"></i> Exams
                </a>
            </li>
            <li class="nav-item">
                <a href="subjects.php" class="nav-link <?php if($active_page == 'subjects.php'){ echo 'active'; } ?>">
                    <i class="bi bi-book me-2"></i> Subjects
                </a>
            </li>
            <li class="nav-item">
                <a href="routine.php" class="nav-link <?php if($active_page == 'routine.php'){ echo 'active'; } ?>">
                    <i class="bi bi-calendar-event me-2"></i> Class Routine
                </a>
            </li>
            <li class="nav-item">
                <a href="notices.php" class="nav-link <?php if($active_page == 'notices.php'){ echo 'active'; } ?>">
                    <i class="bi bi-megaphone me-2"></i> Notices
                </a>
            </li>
            <li class="nav-item">
                <a href="id-cards.php" class="nav-link <?php if($active_page == 'id-cards.php'){ echo 'active'; } ?>">
                    <i class="bi bi-card-text me-2"></i> ID Cards
                </a>
            </li>
            <li class="nav-item">
                <a href="report.php" class="nav-link <?php if($active_page == 'report.php'){ echo 'active'; } ?>">
                    <i class="bi bi-graph-up-arrow me-2"></i> Reports & Analysis
                </a>
            </li>
            <li class="nav-item">
                <a href="academic-calendar.php" class="nav-link <?php if($active_page == 'academic-calendar.php'){ echo 'active'; } ?>">
                    <i class="bi bi-calendar2-week me-2"></i> Calendar
                </a>
            </li>
            <li class="nav-item">
                <a href="settings.php" class="nav-link <?php if($active_page == 'settings.php'){ echo 'active'; } ?>">
                    <i class="bi bi-gear me-2"></i> Settings
                </a>
            </li>
        <?php endif; ?>

        <?php if($role === 'teacher'): ?>
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link <?php if($active_page == 'dashboard.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="profile.php" class="nav-link <?php if($active_page == 'profile.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Profile
                </a>
            </li>
            <li class="nav-item">
                <a href="teachers.php" class="nav-link <?php if($active_page == 'teachers.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> View Teachers
                </a>
            </li>
            <li class="nav-item">
                <a href="mark-submission.php" class="nav-link <?php if($active_page == 'mark-submission.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Mark Submission
                </a>
            </li>
            <li class="nav-item">
                <a href="student-list.php" class="nav-link <?php if($active_page == 'student-list.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Student List
                </a>
            </li>
            <li class="nav-item">
                <a href="question-submit.php" class="nav-link <?php if($active_page == 'question-submit.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Question Submit
                </a>
            </li>
            <li class="nav-item">
                <a href="view-routine.php" class="nav-link <?php if($active_page == 'view-routine.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> View Routine
                </a>
            </li>
            <!-- <li class="nav-item">
                <a href="attendence.php" class="nav-link <?php if($active_page == 'attendence.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Attendence
                </a>
            </li> -->
            <li class="nav-item">
                <a href="view-calander.php" class="nav-link <?php if($active_page == 'view-calander.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> View Calander
                </a>
            </li>
            <li class="nav-item">
                <a href="view-notice.php" class="nav-link <?php if($active_page == 'view-notice.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> View Notice
                </a>
            </li>
        <?php endif; ?>

        <?php if($role === 'student'): ?>
            <!-- Student-only links -->
            <li class="nav-item">
                <a href="dashboard.php" class="nav-link <?php if($active_page == 'dashboard.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="profile.php" class="nav-link <?php if($active_page == 'profile.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Profile
                </a>
            </li>
            <li class="nav-item">
                <a href="view-result.php" class="nav-link <?php if($active_page == 'view-result.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> View Result
                </a>
            </li>
            <li class="nav-item">
                <a href="view-notice.php" class="nav-link <?php if($active_page == 'view-notice.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> View Notice
                </a>
            </li>
            <li class="nav-item">
                <a href="teachers.php" class="nav-link <?php if($active_page == 'teachers.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> View Teachers
                </a>
            </li>
            <li class="nav-item">
                <a href="view-calander.php" class="nav-link <?php if($active_page == 'view-calander.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> View Calander
                </a>
            </li>
            <li class="nav-item">
                <a href="class-routine.php" class="nav-link <?php if($active_page == 'class-routine.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Routine
                </a>
            </li>
            <!-- <li class="nav-item">
                <a href="attendance-report.php" class="nav-link <?php if($active_page == 'attendance-report.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Attendance Report
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a href="admit-card-download.php" class="nav-link <?php if($active_page == 'admit-card-download.php'){ echo 'active'; } ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Admit Card
                </a>
            </li> -->
        <?php endif; ?>

        <!-- Logout (all roles) -->
        <li class="nav-item bg-danger rounded mt-auto">
            <a href="logout.php" class="nav-link text-white">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </li>
    </ul>
</nav>
