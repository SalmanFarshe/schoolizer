<?php
require('../backend/config/config.php');
require('../backend/config/auth.php');
restrict_page(['admin']);

if(isset($_GET['student_id'])){
    $student_id = $_GET['student_id'];

    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id=?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();

    if(!$data){
        die("Student not found!");
    }

    require('../backend/libs/fpdf.php'); // Make sure the path is correct

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,10,"Student Details",0,1,'C');
    $pdf->Ln(5);
    $pdf->SetFont('Arial','',12);

    foreach($data as $key => $value){
        $pdf->Cell(50,10, ucfirst(str_replace('_',' ',$key)) . ":",0,0);
        $pdf->Cell(0,10,$value,0,1);
    }

    $pdf->Output("D","Student_".$student_id.".pdf");
}
?>
