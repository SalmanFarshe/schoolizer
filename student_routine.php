<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Routine - Schoolizer</title>
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
                <li class="nav-item"><a href="student_routine.html" class="nav-link active"><i class="fas fa-calendar-alt icon"></i> Routine</a></li>
                <li class="nav-item"><a href="student_attendance.html" class="nav-link"><i class="fas fa-chart-bar icon"></i> Attendance Report</a></li>
                <li class="nav-item"><a href="student_quiz.html" class="nav-link"><i class="fas fa-question-circle icon"></i> Attempt Quiz</a></li>
                <li class="nav-item"><a href="student_admit_card.html" class="nav-link"><i class="fas fa-id-card icon"></i> Admit card</a></li>
                <li class="nav-item"><a href="student_academic_dates.html" class="nav-link"><i class="fas fa-calendar-check icon"></i> Academic Dates</a></li>
            </ul>
        </aside>
        <main class="main-content">
            <h1>Class Routine</h1>
            <div class="card dashboard-card p-4">
                 <p class="text-secondary text-end">Last Updated: Oct 15, 2024</p>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="table-dark">
                            <tr><th>Time</th><th>Saturday</th><th>Sunday</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>09:00 - 10:00</td><td>Mathematics</td><td>Physics</td><td>Mathematics</td><td>Physics</td><td>Mathematics</td></tr>
                            <tr><td>10:00 - 11:00</td><td>Chemistry</td><td>English</td><td>Chemistry</td><td>English</td><td>Chemistry</td></tr>
                            <tr><td>11:00 - 12:00</td><td colspan="5" class="table-secondary"><strong>LUNCH BREAK</strong></td></tr>
                            <tr><td>12:00 - 01:00</td><td>Computer Sc.</td><td>Physics Lab</td><td>Computer Sc.</td><td>Physics Lab</td><td>Computer Sc.</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>