<!DOCTYPE html>
<html lang="en" data-bs-theme="dark"> <!-- Activating Bootstrap's Dark Mode Here -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Schoolizer</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #212529; /* Match exact background from screenshot */
        }
        .page-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Essential Sidebar Styles */
        .sidebar {
            width: 280px;
            min-width: 280px;
            background-color: #16191c; /* Match exact sidebar color */
            padding: 20px;
        }
        .sidebar-heading {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: #343a40;
        }
        .sidebar .nav-link.active {
            color: #fff;
            background-color: #fd7e14; /* Brand orange color for active link */
        }
        .sidebar .nav-link .icon {
            margin-right: 15px;
            width: 20px;
        }

        /* Main Content Styles */
        .main-content {
            flex-grow: 1;
            padding: 40px;
        }

        /* --- HOVER & GLOW EFFECTS (ADDED BACK) --- */
        .dashboard-card {
            /* Added 'box-shadow' to the transition */
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        /* Smart glow effect using Bootstrap's CSS variables */
        .text-bg-primary:hover { box-shadow: 0 0 25px rgba(var(--bs-primary-rgb), 0.5); }
        .text-bg-success:hover { box-shadow: 0 0 25px rgba(var(--bs-success-rgb), 0.5); }
        .text-bg-warning:hover { box-shadow: 0 0 25px rgba(var(--bs-warning-rgb), 0.5); }
        .text-bg-info:hover   { box-shadow: 0 0 25px rgba(var(--bs-info-rgb), 0.5); }
    </style>
</head>
<body>

    <div class="page-wrapper">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <h1 class="sidebar-heading">Student</h1>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#" class="nav-link active"><i class="fas fa-tachometer-alt icon"></i> Dashboard</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link"><i class="fas fa-user-circle icon"></i> Profile</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link"><i class="fas fa-poll icon"></i> Result</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link"><i class="fas fa-bullhorn icon"></i> Notice</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link"><i class="fas fa-book icon"></i> Ledger</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link"><i class="fas fa-sticky-note icon"></i> Note</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link"><i class="fas fa-calendar-alt icon"></i> Routine</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link"><i class="fas fa-chart-bar icon"></i> Attendance Report</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link"><i class="fas fa-question-circle icon"></i> Attempt Quiz</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link"><i class="fas fa-id-card icon"></i> Admit card</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link"><i class="fas fa-calendar-check icon"></i> Academic Dates</a></li>
                <li><a href="index.php" class="nav-link"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            </ul>
        </aside>

        <!-- Main Content Area -->
        <main class="main-content">
            <h1 class="fw-bold mb-4">Dashboard</h1>
            
            <div class="row g-4">
                <!-- Latest Notices -->
                <div class="col-12 col-lg-6">
                    <div class="card bg-body-tertiary dashboard-card h-100">
                        <div class="card-header fw-bold"><i class="fas fa-bullhorn me-2"></i> Latest Notices</div>
                        <div class="card-body">
                           <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-transparent">Notice about the upcoming final exams.</li>
                                <li class="list-group-item bg-transparent">Holiday declared for national festival.</li>
                                <li class="list-group-item bg-transparent">Annual sports day event is now open.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Attendance Report -->
                <div class="col-12 col-lg-6">
                    <div class="card bg-body-tertiary dashboard-card text-center h-100">
                        <div class="card-header fw-bold">Attendance Report</div>
                        <div class="card-body d-flex flex-column justify-content-center">
                            <p class="card-text display-4 fw-bold">92%</p>
                            <p class="card-text text-body-secondary">Your attendance is in good standing.</p>
                        </div>
                    </div>
                </div>

                <!-- Shortcuts (Using Bootstrap background utilities for color) -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card text-bg-primary dashboard-card text-center">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <i class="fas fa-poll fa-3x mb-3"></i>
                            <h5 class="card-title">View Result</h5>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card text-bg-success dashboard-card text-center">
                         <div class="card-body d-flex flex-column justify-content-center">
                            <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                            <h5 class="card-title">View Routine</h5>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card text-bg-warning dashboard-card text-center">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <i class="fas fa-question-circle fa-3x mb-3"></i>
                            <h5 class="card-title">Attempt Quiz</h5>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card text-bg-info dashboard-card text-center">
                        <div class="card-body d-flex flex-column justify-content-center">
                           <i class="fas fa-sticky-note fa-3x mb-3"></i>
                           <h5 class="card-title">View Notes</h5>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>