<?php
require_once('tcpdf/tcpdf.php');

$totalBelanja = $_POST['total_belanja'];
$jumlahBayar = $_POST['jumlah_bayar'];

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->AddPage();
$pdf->SetFont('helvetica', '', 12);

$pdf->Cell(0, 10, 'Total Belanja: Rp. ' . number_format($totalBelanja) . '.000', 0, 1);
$pdf->Cell(0, 10, 'Jumlah Bayar (Rp): ' . $jumlahBayar, 0, 1);

$pdf->Output('invoice.pdf', 'I');