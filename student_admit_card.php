<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admit Card - Schoolizer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page-wrapper">
        <aside class="sidebar">
            <h1 class="sidebar-heading">Student</h1>
            <?php require_once 'includes/sidebar.php'; ?>
        </aside>
        <main class="main-content">
            <h1>Admit Card</h1>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card dashboard-card p-4 text-center">
                        <i class="fas fa-id-card fa-4x text-info mb-3"></i>
                        <h4 class="card-title">Final Examination - Fall 2024</h4>
                        <p class="text-secondary">Your admit card is ready for download. Please ensure all details are correct. Contact the administration for any discrepancies.</p>
                        <div class="mt-4">
                            <a href="#" class="btn btn-lg btn-schoolizer"><i class="fas fa-download me-2"></i>Download Admit Card (PDF)</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>