<?php
include "../site.php";
include "../db=connection.php";
include "fpdf/fpdf.php";
session_start();
$bulan = array(
    '1' => 'JANUARI',
    '2' => 'FEBRUARI',
    '3' => 'MARET',
    '4' => 'APRIL',
    '5' => 'MEI',
    '6' => 'JUNI',
    '7' => 'JULI',
    '8' => 'AGUSTUS',
    '9' => 'SEPTEMBER',
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
  $athn=date('Y');
  $hari=date('D');
$querys = "SELECT id,tgl,nama,gaji,bpjs,gj,MONTH(tgl) as mon,YEAR(tgl) as yea FROM sallary WHERE id=".$_GET['id'];
$rss=mysqli_query($con,$querys);
$rows = mysqli_fetch_array($rss);
$bulanx=$rows['mon'];
$gj=$rows['gj'];
$x=$rows['yea'];
$y=$rows['mon'];
$tgaw=date("$x-$y-11");
$tgak=date("Y-m-11", strtotime("+1 months",strtotime($tgaw)));
$queryst = "SELECT * FROM login_staff WHERE id=".$rows['nama'];
$rsst=mysqli_query($con,$queryst);
$rowst = mysqli_fetch_array($rsst);
$querystaff = "SELECT * FROM staff_type WHERE id=".$rowst['type'];
$rsstaff=mysqli_query($con,$querystaff);
$rowstaff = mysqli_fetch_array($rsstaff);
// // memanggil library FPDF
// //require('../plugins/fpdf/fpdf.php');
// // intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('P','mm','A4');
// // membuat halaman baru
#halaman ke 2
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->text(50,30,'JOB DESCRIPTIONS LIST BULAN  '.$bulan[$bulanx]);
$yhi = 50;
$yha = 50;
$jrow = 6;
$pdf->SetFont('Arial','',11);
$pdf->setXY(20,$yha);
$pdf->cell(30,6,'Nama   :   '.$rowst['name'],0,0,'L');
$yha=$yha+$jrow;
$pdf->setXY(20,$yha);
$pdf->cell(30,6, 'Divisi    :   '.$rowstaff['name'],0,0,'L');
$yha=$yha+$jrow;
$pdf->setFont('Arial','',9);
$pdf->setFillColor(222,222,222);
$pdf->setXY(20,$yha);
$pdf->CELL(10,6,'NO',1,0,'C',1);
$pdf->CELL(60,6,'NAMA JOB',1,0,'C',1);
$pdf->CELL(10,6,'JML',1,0,'C',1);
$pdf->CELL(60,6,'KET',1,0,'C',1);
$pdf->CELL(20,6,'SALLARY',1,0,'C',1);
$yha=$yha+$jrow;
if($gj=='1'){
$query = "SELECT * FROM total_job WHERE id_staff=".$rows['nama']." AND YEAR(date)=".$rows['yea']." AND MONTH(date)=".$rows['mon'];
}else{
$query = "SELECT * FROM total_job WHERE date >= '".$tgaw."' AND date < '".$tgak."' AND id_staff =".$rows['nama'];
}
$rs=mysqli_query($con,$query);
$nox = 1;
$totalx=0;
function limit_words($string, $word_limit){
  $words = explode(" ",$string);
  return implode(" ",array_splice($words,0,$word_limit));
}
while($row = mysqli_fetch_array($rs)){
  $queryjg = "SELECT * FROM jenisgaji WHERE id=".$row['job'];
  $rsjg=mysqli_query($con,$queryjg);
  $rowjg = mysqli_fetch_array($rsjg);
  $ket=$row['keterangan'];
  $limited_string = limit_words($ket, 5);
$pdf->setFont('Arial','',8);
$pdf->setFillColor(255,255,255);
$pdf->setXY(20,$yha);
$pdf->CELL(10,6,$nox,1,0,'C',1);
$pdf->CELL(60,6,$rowjg['nama_job'],1,0,'L',1);
$pdf->CELL(10,6,$row['jumlah'],1,0,'C',1);
$pdf->CELL(60,6,$limited_string,1,0,'L',1);
$pdf->CELL(20,6,number_format($row['total'], 0, ".", "."),1,0,'C',1);
$yha=$yha+$jrow;
$nox++;
$totalx= $totalx+$row['total'];
}
$pdf->setXY(20,$yha);
$pdf->CELL(10,6,'',1,0,'C',1);
$pdf->CELL(70,6,'Total',1,0,'L',1);
$pdf->CELL(80,6,'Rp. '.number_format($totalx, 0, ".", "."),1,0,'C',1);
$yha=$yha+$jrow;
#printout
$pdf->Output("Laporan Gaji.pdf","I");
?>