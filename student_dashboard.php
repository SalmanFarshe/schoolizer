<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Schoolizer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css"> <!-- Link to the shared CSS file -->
</head>
<body>
    <div class="page-wrapper">
        <aside class="sidebar">
            <h1 class="sidebar-heading">Student</h1>
            <ul class="nav-list">
                <li class="nav-item"><a href="student_dashboard.html" class="nav-link active"><i class="fas fa-tachometer-alt icon"></i> Dashboard</a></li>
                <li class="nav-item"><a href="student_profile.html" class="nav-link"><i class="fas fa-user-circle icon"></i> Profile</a></li>
                <li class="nav-item"><a href="student_result.html" class="nav-link"><i class="fas fa-poll icon"></i> Result</a></li>
                <li class="nav-item"><a href="student_notices.html" class="nav-link"><i class="fas fa-bullhorn icon"></i> Notice</a></li>
                <li class="nav-item"><a href="student_ledger.html" class="nav-link"><i class="fas fa-book icon"></i> Ledger</a></li>
                <li class="nav-item"><a href="student_note.html" class="nav-link"><i class="fas fa-sticky-note icon"></i> Note</a></li>
                <li class="nav-item"><a href="student_routine.html" class="nav-link"><i class="fas fa-calendar-alt icon"></i> Routine</a></li>
                <li class="nav-item"><a href="student_attendance.html" class="nav-link"><i class="fas fa-chart-bar icon"></i> Attendance Report</a></li>
                <li class="nav-item"><a href="student_quiz.html" class="nav-link"><i class="fas fa-question-circle icon"></i> Attempt Quiz</a></li>
                <li class="nav-item"><a href="student_admit_card.html" class="nav-link"><i class="fas fa-id-card icon"></i> Admit card</a></li>
                <li class="nav-item"><a href="student_academic_dates.html" class="nav-link"><i class="fas fa-calendar-check icon"></i> Academic Dates</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <h1>Dashboard</h1>
            <div class="row g-4">
                <!-- Dashboard widgets from before -->
                <div class="col-12 col-lg-6"><div class="card dashboard-card"><div class="card-header bg-transparent border-bottom border-secondary"><h5 class="card-title mb-0 fw-bold"><i class="fas fa-bullhorn me-2 text-warning"></i> Latest Notices</h5></div><ul class="list-group list-group-flush p-3"><li class="list-group-item d-flex justify-content-between align-items-center">Notice about final exams.<span class="badge bg-danger">New</span></li><li class="list-group-item">Holiday declared for national festival.</li><li class="list-group-item">Annual sports day registration is open.</li></ul></div></div>
                <div class="col-12 col-lg-6"><div class="card dashboard-card text-center glow-success"><div class="card-body d-flex flex-column justify-content-center p-4"><h5 class="card-title fw-bold">Attendance Report</h5><div class="attendance-ring" style="--percent: 92;"><div class="attendance-percent">92<small>%</small></div></div><p class="card-text text-secondary mt-2">Your attendance is in good standing.</p></div></div></div>
                <div class="col-12 col-md-6 col-lg-3"><div class="card dashboard-card glow-info"><div class="card-body text-center p-4"><i class="fas fa-sticky-note fa-3x mb-3 text-info"></i><h5 class="card-title fw-bold">View Notes</h5><p class="card-text text-secondary">Access class notes and materials.</p><a href="student_note.html" class="btn btn-info mt-3">Go to Notes</a></div></div></div>
                <div class="col-12 col-md-6 col-lg-3"><div class="card dashboard-card glow-success"><div class="card-body text-center p-4"><i class="fas fa-calendar-alt fa-3x mb-3 text-success"></i><h5 class="card-title fw-bold">View Routine</h5><p class="card-text text-secondary">Check your daily class schedule.</p><a href="student_routine.html" class="btn btn-success mt-3">See Routine</a></div></div></div>
                <div class="col-12 col-md-6 col-lg-3"><div class="card dashboard-card glow-warning"><div class="card-body text-center p-4"><i class="fas fa-question-circle fa-3x mb-3 text-warning"></i><h5 class="card-title fw-bold">Attempt Quiz</h5><p class="card-text text-secondary">A new quiz on Maths is available.</p><a href="student_quiz.html" class="btn btn-schoolizer mt-3">Start Quiz</a></div></div></div>
                <div class="col-12 col-md-6 col-lg-3"><div class="card dashboard-card glow-primary"><div class="card-body text-center p-4"><i class="fas fa-poll fa-3x mb-3 text-primary"></i><h5 class="card-title fw-bold">View Result</h5><p class="card-text text-secondary">Check your latest exam results.</p><a href="student_result.html" class="btn btn-primary mt-3">Check Results</a></div></div></div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>