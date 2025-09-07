<?php
require('backend/config/config.php');
require('backend/config/auth.php');
restrict_page(['teacher']); 

$active_page = 'mark-submission.php';
include("backend/path.php");

// Fetch all classes
$classesQuery = mysqli_query($conn, "SELECT * FROM classes");
$classes = mysqli_fetch_all($classesQuery, MYSQLI_ASSOC);

// Handle filter form submission
$class_id = isset($_GET['class_id']) ? intval($_GET['class_id']) : 0;
$subject_id = isset($_GET['subject_id']) ? intval($_GET['subject_id']) : 0;
$exam_type = isset($_GET['exam_type']) ? $_GET['exam_type'] : '';

// Fetch students for selected class
$students = [];
if($class_id > 0){
    $stuQuery = mysqli_query($conn, "SELECT * FROM students WHERE class_id='$class_id'");
    $students = mysqli_fetch_all($stuQuery, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Submit Marks | Schoolizer</title>
<?php require_once("includes/link.php"); ?>
</head>
<body>
<?php require_once("includes/sidebar.php"); ?>

<div class="main-content p-4">
<div class="container">

<h1 class="h3 mb-4">Submit Marks</h1>

<!-- Filter Form -->
<div class="card mb-4">
    <div class="card-header bg-dark text-white">Filter Students</div>
    <div class="card-body">
        <form class="row g-3" method="GET">
            <div class="col-md-4">
                <label class="form-label">Class</label>
                <select class="form-select" name="class_id" required id="classSelect">
                    <option value="">Select Class</option>
                    <?php foreach($classes as $cls): ?>
                        <option value="<?= $cls['id'] ?>" <?= ($cls['id']==$class_id)?'selected':'' ?>>
                            <?= $cls['class_name'].' - '.$cls['section'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Subject</label>
                <select class="form-select" name="subject_id" required id="subjectSelect">
                    <option value="">Select Subject</option>
                    <?php
                    // If form submitted with class, load subjects
                    if($class_id > 0){
                        $subQuery = mysqli_query($conn, "SELECT * FROM subjects WHERE class_id='$class_id'");
                        $subjects = mysqli_fetch_all($subQuery, MYSQLI_ASSOC);
                        foreach($subjects as $sub){
                            $selected = ($sub['id']==$subject_id)?'selected':'';
                            echo '<option value="'.$sub['id'].'" '.$selected.'>'.$sub['subject_name'].'</option>';
                        }
                    }
                    ?>
                </select>
            </div>

<div class="col-md-4">
    <label class="form-label">Exam</label>
    <select class="form-select" name="exam_id" required id="examSelect">
        <option value="">Select Exam</option>
        <?php
        $examQuery = mysqli_query($conn, "SELECT * FROM exams ORDER BY exam_date DESC");
        if($examQuery && mysqli_num_rows($examQuery) > 0){
            while($exam = mysqli_fetch_assoc($examQuery)){
                $selected = ($exam['id']==($_GET['exam_id'] ?? 0)) ? 'selected' : '';
                echo '<option value="'.$exam['id'].'" '.$selected.'>'.$exam['exam_name'].' ('.$exam['exam_date'].')</option>';
            }
        } else {
            echo '<option value="">No exams available</option>';
        }
        ?>
    </select>
</div>



            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Load Students</button>
            </div>
        </form>
    </div>
</div>

<?php if($students && $subject_id && isset($_GET['exam_id']) && $_GET['exam_id'] > 0): ?>
<div class="card">
    <div class="card-header bg-dark text-white">Students</div>
    <div class="card-body table-responsive">
        <form method="POST" action="processes/submit-marks.php">
            <input type="hidden" name="class_id" value="<?= $class_id ?>">
            <input type="hidden" name="subject_id" value="<?= $subject_id ?>">
            <input type="hidden" name="exam_id" value="<?= $_GET['exam_id'] ?? 0 ?>">

            <table class="table table-striped table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>MCS</th>
                        <th>CQ</th>
                        <th>Quiz</th>
                        <th>Attendance</th>
                        <th>Total Marks</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($students as $stu): ?>
                    <tr>
                        <td><?= $stu['student_id'] ?></td>
                        <td><?= $stu['name'] ?></td>
                        <td><input type="number" name="mcs[<?= $stu['student_id'] ?>]" min="0" max="20" class="form-control" required></td>
                        <td><input type="number" name="cq[<?= $stu['student_id'] ?>]" min="0" max="30" class="form-control" required></td>
                        <td><input type="number" name="quiz[<?= $stu['student_id'] ?>]" min="0" max="10" class="form-control" required></td>
                        <td><input type="number" name="attendance[<?= $stu['student_id'] ?>]" min="0" max="5" class="form-control" required></td>
                        <td>0</td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <div class="text-end">
                <button type="submit" class="btn btn-success">Submit Marks</button>
                <input type="hidden" name="exam_id" value="<?= $_GET['exam_id'] ?? 0 ?>">

            </div>
        </form>
    </div>
</div>
<?php endif; ?>

</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function(){
    $('#classSelect').change(function(){
        var classId = $(this).val();
        if(classId != ''){
            $.ajax({
                url: 'fetch_subjects.php',
                type: 'POST',
                data: {class_id: classId},
                success: function(data){
                    $('#subjectSelect').html(data);
                }
            });
        } else {
            $('#subjectSelect').html('<option value="">Select Subject</option>');
        }
    });
});

$(document).ready(function(){
    $('#classSelect').change(function(){
        var classId = $(this).val();
        if(classId != ''){
            $.ajax({
                url: 'fetch_subjects.php',
                type: 'POST',
                data: {class_id: classId},
                success: function(data){
                    $('#subjectSelect').html(data);
                }
            });
        } else {
            $('#subjectSelect').html('<option value="">Select Subject</option>');
        }
    });
});

</script>

</body>
</html>
