<?php
require("Fpdf/fpdf.php");
$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","B",16);
$pdf->Cell(60,10,"welcome",1,0,'C');
$pdf->output();
?>