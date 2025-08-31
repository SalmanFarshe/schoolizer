<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Result - Schoolizer</title>
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
                <li class="nav-item"><a href="student_result.html" class="nav-link active"><i class="fas fa-poll icon"></i> Result</a></li>
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
            <h1>Result Summary</h1>
            <div class="card dashboard-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-around text-center mb-4 border-bottom pb-3">
                        <div>
                            <h6 class="text-secondary">OVERALL GPA</h6>
                            <h3 class="fw-bold">3.85 / 4.00</h3>
                        </div>
                        <div>
                            <h6 class="text-secondary">STATUS</h6>
                            <h3 class="fw-bold text-success">Passed</h3>
                        </div>
                        <div>
                            <h6 class="text-secondary">SEMESTER</h6>
                            <h3 class="fw-bold">Fall 2024</h3>
                        </div>
                    </div>
                    <h5 class="card-title mb-3">Term Final Results</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr><th>Subject</th><th>Grade</th><th>GPA</th><th>Remarks</th></tr>
                            </thead>
                            <tbody>
                                <tr><td>Mathematics</td><td>A+</td><td>4.00</td><td>Excellent</td></tr>
                                <tr><td>Physics</td><td>A</td><td>3.75</td><td>Good</td></tr>
                                <tr><td>Chemistry</td><td>A+</td><td>4.00</td><td>Excellent</td></tr>
                                <tr><td>English Literature</td><td>A-</td><td>3.50</td><td>Good</td></tr>
                                <tr><td>Computer Science</td><td>A+</td><td>4.00</td><td>Excellent</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>