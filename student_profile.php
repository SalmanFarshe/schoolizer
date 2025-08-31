<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Schoolizer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Profile-specific styles */
        .profile-picture-wrapper { position: relative; width: 150px; height: 150px; margin: 0 auto 1rem; }
        .profile-picture { width: 100%; height: 100%; object-fit: cover; border-radius: 50%; border: 4px solid var(--card-border); }
        .upload-button { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(0,0,0,0.6); color: white; border: none; border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; cursor: pointer; opacity: 0; transition: opacity 0.3s ease; }
        .profile-picture-wrapper:hover .upload-button { opacity: 1; }
        #pictureUpload { display: none; }
        .form-label { color: var(--text-secondary); font-weight: 500; }
        .form-control { background-color: rgba(0,0,0,0.2); border: 1px solid var(--card-border); color: var(--text-primary); border-radius: 8px; }
        .form-control:focus { background-color: rgba(0,0,0,0.3); border-color: var(--accent-orange); box-shadow: 0 0 0 0.25rem rgba(253, 126, 20, 0.25); color: var(--text-primary); }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <aside class="sidebar">
            <h1 class="sidebar-heading">Student</h1>
            <ul class="nav-list">
                <li class="nav-item"><a href="student_dashboard.html" class="nav-link"><i class="fas fa-tachometer-alt icon"></i> Dashboard</a></li>
                <li class="nav-item"><a href="student_profile.html" class="nav-link active"><i class="fas fa-user-circle icon"></i> Profile</a></li>
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
            <h1>My Profile</h1>
            <!-- Profile content from before -->
            <div class="row g-4">
                 <div class="col-xl-8"><div class="row g-4"><div class="col-12"><div class="card dashboard-card text-center p-4"><div class="profile-picture-wrapper"><img src="https://placehold.co/150x150/6c757d/f8f9fa?text=User" alt="Profile Picture" class="profile-picture" id="profilePic"><label for="pictureUpload" class="upload-button"><i class="fas fa-camera"></i></label><input type="file" id="pictureUpload" accept="image/*"></div><h4 class="mb-0">Salman Farshe</h4><p class="text-secondary">Student ID: SCHL-1024</p></div></div><div class="col-12"><div class="card dashboard-card p-4"><h5 class="card-title mb-4 fw-bold"><i class="fas fa-user-edit me-2"></i> Basic Information</h5><form><div class="row"><div class="col-md-6 mb-3"><label for="fullName" class="form-label">Full Name</label><input type="text" class="form-control" id="fullName" value="Salman Farshe"></div><div class="col-md-6 mb-3"><label for="email" class="form-label">Email Address</label><input type="email" class="form-control" id="email" value="salman.farshe@example.com"></div></div><div class="mb-3"><label for="phone" class="form-label">Phone Number</label><input type="tel" class="form-control" id="phone" value="+1234567890"></div><div class="mb-3"><label for="address" class="form-label">Address</label><textarea class="form-control" id="address" rows="3">123 Learning Lane, Knowledge City, EDU 45678</textarea></div><button type="submit" class="btn btn-schoolizer mt-3">Save Changes</button></form></div></div></div></div>
                 <div class="col-xl-4"><div class="card dashboard-card p-4"><h5 class="card-title mb-4 fw-bold"><i class="fas fa-key me-2"></i> Change Password</h5><form><div class="mb-3"><label for="currentPassword" class="form-label">Current Password</label><input type="password" class="form-control" id="currentPassword"></div><div class="mb-3"><label for="newPassword" class="form-label">New Password</label><input type="password" class="form-control" id="newPassword"></div><div class="mb-3"><label for="confirmPassword" class="form-label">Confirm New Password</label><input type="password" class="form-control" id="confirmPassword"></div><button type="submit" class="btn btn-primary w-100 mt-3">Update Password</button></form></div></div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const pictureUpload = document.getElementById('pictureUpload');
        const profilePic = document.getElementById('profilePic');
        pictureUpload.addEventListener('change', function(event) { if (event.target.files && event.target.files[0]) { const reader = new FileReader(); reader.onload = function(e) { profilePic.src = e.target.result; }; reader.readAsDataURL(event.target.files[0]); } });
    </script>
</body>
</html>