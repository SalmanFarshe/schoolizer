<?php
require_once("../config/config.php");

// Check if students or marks table already contains data
$studentCountQuery = "SELECT COUNT(*) AS count FROM students";
$marksCountQuery = "SELECT COUNT(*) AS count FROM marks";

$studentCountResult = mysqli_query($connection, $studentCountQuery);
$marksCountResult = mysqli_query($connection, $marksCountQuery);

if ($studentCountResult && $marksCountResult) {
    $studentCount = mysqli_fetch_assoc($studentCountResult)['count'];
    $marksCount = mysqli_fetch_assoc($marksCountResult)['count'];

    if ($studentCount > 0 || $marksCount > 0) {
        // If either table contains data, terminate the script
        echo "<script>
                alert('Data already exists in the database. Cannot insert new data. To insert again, please reset and try again');
                window.location.href = '../../pages/dashboard.php';
              </script>";
        exit;
    }
}

// Subject name to ID mapping
$subjectMap = [
    "Bangla" => 1,
    "English" => 2,
    "Math" => 3,
    "Religion" => 4,
    "History" => 5,
    "Science" => 6,
    "ICT" => 7,
    "Wellbeing" => 8,
    "Life and Livelihood" => 9,
    "Art & Culture" => 10,
];

function insertStudent($connection, $studentData) {
    $query = "INSERT IGNORE INTO students (student_id, name, father_name, mother_name, class, group_name, roll) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param(
        "ssssssi",
        $studentData['student_id'],
        $studentData['name'],
        $studentData['father_name'],
        $studentData['mother_name'],
        $studentData['class'],
        $studentData['group_name'],
        $studentData['roll']
    );
    if (!$stmt->execute()) {
        error_log("Error in insertStudent query: " . $stmt->error);
    }
}

function insertMark($connection, $markData) {
    $query = "INSERT INTO marks (student_id, subject_id, cq_marks, mcq_marks) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($query);
    $stmt->bind_param(
        "sidd",
        $markData['student_id'],
        $markData['subject_id'],
        $markData['cq_marks'],
        $markData['mcq_marks']
    );
    if (!$stmt->execute()) {
        error_log("Error in insertMark query: " . $stmt->error);
    }
}

// File processing
$filePath = "result.csv";
if (($handle = fopen($filePath, "r")) !== FALSE) {
    // Read headers
    $headers = fgetcsv($handle);

    // Determine column mapping for subjects
    $subjectColumns = [];
    $seenSubjects = []; // Track processed subjects to avoid duplicates
    for ($i = 8; $i < count($headers); $i += 2) {
        $subjectName = trim(str_replace(["cq", "mcq"], "", strtolower($headers[$i])));
        foreach ($subjectMap as $name => $id) {
            if (stripos($subjectName, strtolower($name)) !== false && !isset($seenSubjects[$id])) {
                $subjectColumns[] = [
                    'subject_id' => $id,
                    'cq_column' => $i,
                    'mcq_column' => $i + 1,
                ];
                $seenSubjects[$id] = true; // Mark subject as processed
                break;
            }
        }
    }

    while (($row = fgetcsv($handle)) !== FALSE) {
        if (count($row) < 8) continue; // Skip invalid rows

        // Student data
        $studentData = [
            'student_id' => $row[5],
            'name' => $row[2],
            'father_name' => $row[3],
            'mother_name' => $row[4],
            'class' => $row[1],
            'group_name' => $row[6],
            'roll' => (int)$row[7],
        ];
        insertStudent($connection, $studentData);

        // Marks data
        foreach ($subjectColumns as $subject) {
            $cqMarks = isset($row[$subject['cq_column']]) ? (float)$row[$subject['cq_column']] : 0;
            $mcqMarks = isset($row[$subject['mcq_column']]) ? (float)$row[$subject['mcq_column']] : 0;

            $markData = [
                'student_id' => $studentData['student_id'],
                'subject_id' => $subject['subject_id'],
                'cq_marks' => $cqMarks,
                'mcq_marks' => $mcqMarks,
            ];
            insertMark($connection, $markData);
        }
    }
    fclose($handle);
}
else{
    echo "<script>
            alert('Please upload result file(csv) and try again.');
            window.location.href = '../../pages/dashboard.php';
          </script>";
    exit;
}

mysqli_close($connection);
echo "<script>
            alert('New data have been generated successfully.');
            window.location.href = '../../pages/dashboard.php';
      </script>";
?>