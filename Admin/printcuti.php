<?php
include "../site.php";
include "../db=connection.php";
include "fpdf/fpdf.php";
session_start();
$bulan = array(
    '01' => 'JANUARI',
    '02' => 'FEBRUARI',
    '03' => 'MARET',
    '04' => 'APRIL',
    '05' => 'MEI',
    '06' => 'JUNI',
    '07' => 'JULI',
    '08' => 'AGUSTUS',
    '09' => 'SEPTEMBER',
    '10' => 'OKTOBER',
    '11' => 'NOVEMBER',
    '12' => 'DESEMBER',
  );
  $hari = array(
    '1' => 'SENIN',
    '2' => 'SELASA',
    '3' => 'RABU',
    '4' => 'KAMIS',
    '5' => 'JUMAT',
    '6' => 'SABTU',
    '0' => 'MINGGU',
    
  );
  $abulan=date('m');
  $tgak=date("m", strtotime("-1 months"));
  $athn=date('Y');
  $tgaw2=date("$athn-$tgak-10 0:0:0");
  $tgak2=date("Y-m-10 0:0:0", strtotime("+1 months",strtotime($tgaw2)));
  $tgl_terakhir = date('t', strtotime("+10 Days",strtotime($tgaw2)));
  $ahari=date('w');
  $akhirsby=$tgl_terakhir + 10;
//$tanggal = cal_days_in_month(CAL_GREGORIAN, $tgak, $athn);
// // memanggil library FPDF
// //require('../plugins/fpdf/fpdf.php');
// // intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('P','mm','A4');
// // membuat halaman baru
$pdf->AddPage();
// // setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',12);
$querycuti = "SELECT * FROM cuti WHERE id=".$_GET['id'];
$rscuti=mysqli_query($con,$querycuti);
$rowcuti = mysqli_fetch_array($rscuti);
# header
$pdf->setFont('Arial','',12);
$pdf->text(80,26,'SURAT PERMOHONAN CUTI');
$pdf->text(60,32,'KARYAWAN PT. PERFORMA TOUR & TRAVEL');
$pdf->setFont('Arial','',11);
$pdf->text(20,52,'Saya yang bertanda tangan di bawah ini : ');
$querystaff = "SELECT * FROM staff_type WHERE id=".$_SESSION['type'];
$rsstaff=mysqli_query($con,$querystaff);
$rowstaff = mysqli_fetch_array($rsstaff);
$pdf->text(30,62,'Nama    : '.$_SESSION['staff']);
$pdf->text(30,68,'Divisi     : '.$rowstaff['name']);
$pdf->text(20,78,'Bersama surat ini saya selaku karyawan PT. Performa Tour & Travel menyatakan ingin');
$pdf->text(20,84,'mengajukan cuti selama '.$rowcuti['durasi'].' hari kerja.');
$pdf->text(20,90,'Yang akan diambil pada :');
$pdf->text(30,100,'Tanggal   :   '.$rowcuti['tgl_cuti']);
$pdf->text(30,106,'Alasan     :   '.$rowcuti['keterangan']);
$pdf->text(20,116,'Demikianlah surat permohonan ini saya buat, atas perhatian dan pengertianya');
$pdf->text(20,122,'saya ucapkan terimakasih.');
$yi = 128;
$ya = 128;
$pdf->setXY(10,$ya);
$jrow = 6;
$ya = $yi + $jrow;

 $pdf->Ln();
 $pdf->Ln();
 $pdf->Ln();
 $pdf->SetFont('Arial','',9);
 $pdf->SetX(120);
 $pdf->MultiCell(95,10,'Surabaya, '.date('d').' '.$bulan[date('m')].' '.date('Y'),0,'C');
 $pdf->SetX(120);
 $pdf->MultiCell(95,5, 'Mengetahui,',0,'C');
 $pdf->SetX(120);
 $pdf->MultiCell(95,20, ' ',0,'C');
 $pdf->SetX(120);
 $pdf->MultiCell(95,1, 'Pimpinan',0,'C');
 $pdf->Ln();

$pdf->Output();

?>


