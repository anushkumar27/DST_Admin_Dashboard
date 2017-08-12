<?php
require("Fpdf/fpdf.php");
$pdf=new FPDF();
print_r(sizeof(get_class_methods($pdf)));
/*$pdf->AddPage();
$pdf->SetFont("Arial","B",16);
$pdf->Cell(10,10,"welcome",1,0,C);
$pdf->output();*/
?>