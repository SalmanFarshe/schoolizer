<?php
require('backend/config/config.php');

if(isset($_POST['class_id'])){
    $class_id = intval($_POST['class_id']);
    $subQuery = mysqli_query($conn, "SELECT * FROM subjects WHERE class_id='$class_id'");
    $subjects = mysqli_fetch_all($subQuery, MYSQLI_ASSOC);

    echo '<option value="">Select Subject</option>';
    foreach($subjects as $sub){
        echo '<option value="'.$sub['id'].'">'.$sub['subject_name'].'</option>';
    }
}
?>
