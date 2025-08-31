<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report - Schoolizer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page-wrapper">
        <aside class="sidebar">
            <h1 class="sidebar-heading">Student</h1>
            <ul class="nav-list">
                <li class="nav-item"><a href="student_dashboard.html" class="nav-link"><i class="fas fa-tachometer-alt icon"></i> Dashboard</a></li>
                <li class="nav-item"><a href="student_profile.html" class="nav-link"><i class="fas fa-user-circle icon"></i> Profile</a></li>
                <li class="nav-item"><a href="student_result.html" class="nav-link"><i class="fas fa-poll icon"></i> Result</a></li>
                <li class="nav-item"><a href="student_notices.html" class="nav-link"><i class="fas fa-bullhorn icon"></i> Notice</a></li>
                <li class="nav-item"><a href="student_ledger.html" class="nav-link"><i class="fas fa-book icon"></i> Ledger</a></li>
                <li class="nav-item"><a href="student_note.html" class="nav-link"><i class="fas fa-sticky-note icon"></i> Note</a></li>
                <li class="nav-item"><a href="student_routine.html" class="nav-link"><i class="fas fa-calendar-alt icon"></i> Routine</a></li>
                <li class="nav-item"><a href="student_attendance.html" class="nav-link active"><i class="fas fa-chart-bar icon"></i> Attendance Report</a></li>
                <li class="nav-item"><a href="student_quiz.html" class="nav-link"><i class="fas fa-question-circle icon"></i> Attempt Quiz</a></li>
                <li class="nav-item"><a href="student_admit_card.html" class="nav-link"><i class="fas fa-id-card icon"></i> Admit card</a></li>
                <li class="nav-item"><a href="student_academic_dates.html" class="nav-link"><i class="fas fa-calendar-check icon"></i> Academic Dates</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <h1>Attendance Report</h1>
             <div class="card dashboard-card p-4">
                 <div class="row text-center mb-4 border-bottom pb-3">
                     <div class="col-md-6 border-end border-secondary"><h6 class="text-secondary">OVERALL ATTENDANCE</h6><h3 class="fw-bold text-success">92%</h3></div>
                     <div class="col-md-6"><h6 class="text-secondary">LAST 30 DAYS</h6><h3 class="fw-bold text-warning">88%</h3></div>
                 </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr><th>Date</th><th>Subject</th><th>Status</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>Oct 26, 2024</td><td>Mathematics</td><td><span class="badge bg-success">Present</span></td></tr>
                            <tr><td>Oct 25, 2024</td><td>Physics</td><td><span class="badge bg-danger">Absent</span></td></tr>
                            <tr><td>Oct 24, 2024</td><td>Chemistry</td><td><span class="badge bg-success">Present</span></td></tr>
                            <tr><td>Oct 23, 2024</td><td>English</td><td><span class="badge bg-warning text-dark">Late</span></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>