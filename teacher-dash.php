<?php
// teacher-dash.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schoolizer - Teacher Dashboard</title>
   
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }

        body { display: flex; min-height: 100vh; background: #f9f9f9; }

        /* Sidebar */
        .sidebar {
            background: #002B5B;
            color: white;
            padding: 20px 15px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 220px;
        }
        .sidebar .logo {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 25px;
            text-align: left;
        }
        .sidebar .logo span { color: #FF6B35; }
        .sidebar ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 100%;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 15px;
            padding: 8px 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 6px;
            transition: 0.3s;
        }
        .sidebar ul li a:hover {
            background: #FF6B35;
            color: white;
            transform: translateX(5px);
        }

        /* Main Dashboard */
        .dashboard {
            flex: 1;
            padding: 25px;
        }
        .dashboard h1 { font-size: 26px; margin-bottom: 10px; }
        .dashboard p { margin-bottom: 20px; color: #444; }
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }
        .card {
            display: block;
            text-decoration: none;
            background: #ffffff;
            padding: 25px 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease-in-out;
            color: #002B5B;
            position: relative;
            overflow: hidden;
        }
        .card i {
            font-size: 36px;
            margin-bottom: 12px;
            color: #FF6B35;
            transition: 0.3s;
        }
        .card h2 { font-size: 18px; margin-bottom: 6px; }
        .card p { font-size: 14px; color: #555; }

        /* Hover Effect */
        .card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
            background: linear-gradient(135deg, #ffffff, #f1f7ff);
        }
        .card:hover i {
            color: #002B5B;
            transform: rotate(8deg) scale(1.1);
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 12px;
            color: #002B5B;
            margin-top: 25px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
    <div class="logo">School<span>izer</span></div>
    <ul>
        <li><a href="teacher-dash.php"><i class="bi bi-house-door-fill"></i> Dashboard</a></li>
        <li><a href="#"><i class="bi bi-people-fill"></i> Students</a></li>
        <li><a href="#"><i class="bi bi-journal-check"></i> Marks</a></li>
        <li><a href="#"><i class="bi bi-book"></i> Notes</a></li>
        <li><a href="#"><i class="bi bi-calendar2-week"></i> Routine</a></li>
        <li><a href="#"><i class="bi bi-check2-square"></i> Attendance</a></li>
        <li><a href="#"><i class="bi bi-ui-checks-grid"></i> Quizzes</a></li>
        <li><a href="#"><i class="bi bi-calendar-event"></i> Academic Dates</a></li>
        <li><a href="index.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
    </ul>
</aside>

<!-- Main Dashboard -->
<main class="dashboard">
    <h1>Teacher Dashboard</h1>
    <p>Welcome, Teacher! Here is the summary of your section.</p>

    <section class="cards">
        <a href="#" class="card">
            <i class="bi bi-people-fill"></i>
            <h2>Students</h2>
            <p>View student profiles</p>
        </a>

        <a href="#" class="card">
            <i class="bi bi-journal-check"></i>
            <h2>Exam Marks</h2>
            <p>Submit & Update marks</p>
        </a>

        <a href="#" class="card">
            <i class="bi bi-book"></i>
            <h2>Subjects</h2>
            <p>View subject list</p>
        </a>

        <a href="#" class="card">
            <i class="bi bi-file-earmark-text"></i>
            <h2>Notes</h2>
            <p>Upload class notes</p>
        </a>

        <a href="#" class="card">
            <i class="bi bi-calendar2-week"></i>
            <h2>Routine</h2>
            <p>Check your schedule</p>
        </a>

        <a href="#" class="card">
            <i class="bi bi-check2-square"></i>
            <h2>Attendance</h2>
            <p>Take class attendance</p>
        </a>

        <a href="#" class="card">
            <i class="bi bi-ui-checks-grid"></i>
            <h2>Quizzes</h2>
            <p>Create & manage quizzes</p>
        </a>

        <a href="#" class="card">
            <i class="bi bi-calendar-event"></i>
            <h2>Academic Dates</h2>
            <p>View academic calendar</p>
        </a>
    </section>

    <footer class="footer">
        <p>© 2025 Schoolizer | Teacher Dashboard</p>
    </footer>
</main>

</body>
</html>
