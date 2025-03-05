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
  $tgaw2=date("$athn-$tgak-11 0:0:0");
  $tgak2=date("Y-m-11 0:0:0", strtotime("+1 months",strtotime($tgaw2)));
  $tgl_terakhir = date('t', strtotime("+11 Days",strtotime($tgaw2)));
  $ahari=date('w');
  $akhirsby=$tgl_terakhir + 11;
  $querygj = "SELECT * FROM sallary_auto WHERE nama=".$_SESSION['staff_id'];
  $rsgj=mysqli_query($con,$querygj);
  $rowgj = mysqli_fetch_array($rsgj);
  $gji=$rowgj['gj'];
//$tanggal = cal_days_in_month(CAL_GREGORIAN, $tgak, $athn);
// // memanggil library FPDF
// //require('../plugins/fpdf/fpdf.php');
// // intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('P','mm','A4');
// // membuat halaman baru
$pdf->AddPage();
// // setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);

# header
$pdf->setFont('Arial','',12);
$pdf->text(70,20,'ABSENSI KEHADIRAN KARYAWAN');
$pdf->text(90,26,'BULAN '.$bulan[$tgak]);
$pdf->text(10,40,'NAMA : '.$_SESSION['staff']);
$querystaff = "SELECT * FROM staff_type WHERE id=".$_SESSION['type'];
$rsstaff=mysqli_query($con,$querystaff);
$rowstaff = mysqli_fetch_array($rsstaff);
$pdf->text(10,46,'DIVISI :'.$rowstaff['name']);
$yi = 50;
$ya = 50;
$pdf->setFont('Arial','',9);
$pdf->setFillColor(222,222,222);
$pdf->setXY(10,$ya);
$pdf->CELL(10,6,'NO',1,0,'C',1);
$pdf->CELL(20,6,'TANGGAL',1,0,'C',1);
$pdf->CELL(20,6,'HARI',1,0,'C',1);
$pdf->CELL(20,6,'JAM IN',1,0,'C',1);
$pdf->CELL(20,6,'JAM OUT',1,0,'C',1);
$pdf->CELL(20,6,'DURASI',1,0,'C',1);
$pdf->CELL(20,6,'Late In',1,0,'C',1);
$pdf->CELL(20,6,'Early',1,0,'C',1);
$pdf->CELL(20,6,'Over time',1,0,'C',1);
$pdf->CELL(20,6,'Price',1,0,'C',1);

$pdf->setFont('Arial','',9);
if($gji=='1'){
  $query = "SELECT * FROM lembur where  MONTH(tgl) ='".$tgak."' AND YEAR(tgl)='".$athn."' AND staff='".$_SESSION['staff_id']."' ORDER BY tgl ASC";
}else{
$query = "SELECT * FROM lembur where  tgl >='".$tgaw2."' AND tgl < '".$tgak2."' AND staff='".$_SESSION['staff_id']."' ORDER BY tgl ASC";
}
$rs=mysqli_query($con,$query);
$no = 1;
$jrow = 6;
$ya = $yi + $jrow;
$grandtotal=0;
$granddurasi=0;
$grandtelat=0;
$grandrajin=0;
$grandover=0;

while($row = mysqli_fetch_array($rs)){
$tanggal=$row['tgl'];
$day = date('w', strtotime($tanggal));
$grandtotal=$grandtotal+$row['total'];
////////
$granddurasi=$granddurasi+$row['durasi'];
$jamgrd    =floor($granddurasi);
$menitgrd   =$granddurasi - $jamgrd ;
$gdd=$jamgrd."h".floor( $menitgrd * 60)."m";
///////
$grandtelat=$grandtelat+$row['telat'];
$jamtl    =floor($grandtelat);
$menittl   =$granddurasi - $jamgrd ;
$gtl=$jamtl."h".floor( $menittl * 60)."m";
///////
$grandrajin=$grandrajin+$row['rajin'];
$jamrj    =floor($grandrajin);
$menitrj   =$grandrajin - $jamrj ;
$grj=$jamrj."h".floor( $menitrj * 60)."m";
///////
$grandover=$grandover+$row['over'];
$jamov    =floor($grandover);
$menitov   =$grandover - $jamov ;
$gov=$jamov."h".floor( $menitov * 60)."m";
///////
$jam    =floor($row['durasi']);
$menit   =$row['durasi'] - $jam ;
$dur=$jam."h".floor( $menit * 60)."m";
$jamover    =floor($row['over']);
$menitover   =$row['over'] - $jamover ;
$durover=$jamover."h".floor( $menitover * 60)."m";
    $pdf->setXY(10,$ya);
    $pdf->setFont('arial','',9);
    $pdf->setFillColor(255,255,255);
    $pdf->cell(10,6,$no,1,0,'C',1);
    $pdf->cell(20,6,$row['tgl'],1,0,'C',1);
    $pdf->cell(20,6,$hari[$day],1,0,'C',1);
    $pdf->cell(20,6,$row['mulai'],1,0,'C',1);
    $pdf->CELL(20,6,$row['end'],1,0,'C',1);
    $pdf->CELL(20,6,$dur,1,0,'C',1);
    $pdf->cell(20,6,$row['telat'],1,0,'C',1);
    $pdf->cell(20,6,$row['rajin'],1,0,'C',1);
    $pdf->CELL(20,6,$durover,1,0,'C',1);
    $pdf->CELL(20,6,'Rp.'.$row['total'],1,0,'C',1);

    $ya = $ya+$jrow;
    $no++;
 }
 $tot="SELECT * FROM lembur where staff='".$_SESSION['staff_id']."' AND YEAR(tgl)='".$athn."' AND MONTH(tgl) ='".$tgak."' ORDER BY tgl ASC";
 $rs=mysqli_query($con,$tot);

 $pdf->setXY(10,$ya);
 $pdf->setFont('arial','',9);
 $pdf->setFillColor(255,255,255);
 $pdf->cell(10,6,'',1,0,'C',1);
 $pdf->cell(20,6,'',1,0,'C',1);
 $pdf->cell(20,6,'',1,0,'C',1);
 $pdf->cell(20,6,'',1,0,'C',1);
 $pdf->cell(20,6,'',1,0,'C',1);
 $pdf->cell(20,6,$gdd,1,0,'C',1);
 $pdf->CELL(20,6,$gtl,1,0,'C',1);
 $pdf->CELL(20,6,$grj,1,0,'C',1);
 $pdf->CELL(20,6,$gov,1,0,'C',1);
 $pdf->CELL(20,6,'Rp.'.$grandtotal,1,0,'C',1);
 $ya = $ya+$jrow;

 $pdf->Ln();
 $pdf->Ln();
 $pdf->Ln();
 $pdf->SetFont('Arial','',9);
 $pdf->SetX(120);
 $pdf->MultiCell(95,10,'Surabaya, '.date('d').' '.$bulan[date('m')].' '.date('Y'),0,'C');
 $pdf->SetX(120);
 $pdf->MultiCell(95,20, ' ',0,'C');
 $pdf->SetX(120);
 $pdf->MultiCell(95,1, 'Performa Tour & Travel',0,'C');
 $pdf->Ln();
 $pdf->AddPage();
 $pdf->SetFont('Arial','B',14);
 $pdf->text(60,30,'LIST CUTI TAHUNAN KARYAWAN   ');
 $xhi = 50;
 $xha = 50;
 $jrow = 6;
 $pdf->SetFont('Arial','',11);
 $pdf->setXY(20,$xha);
 $pdf->cell(30,6,'Nama   :   '.$_SESSION['staff'],0,0,'L');
 $xha=$xha+$jrow;
 $pdf->setXY(20,$xha);
 $pdf->cell(30,6, 'Divisi    :   '.$rowstaff['name'],0,0,'L');
 $xha=$xha+$jrow;
 $pdf->setFont('Arial','',9);
 $pdf->setFillColor(222,222,222);
 $pdf->setXY(20,$xha);
 $pdf->CELL(10,6,'NO',1,0,'C',1);
 $pdf->CELL(30,6,'PERIODE',1,0,'C',1);
 $pdf->CELL(50,6,'TGL CUTI',1,0,'C',1);
 $pdf->CELL(30,6,'LAMA CUTI',1,0,'C',1);
 $pdf->CELL(50,6,'KETERANGAN',1,0,'C',1);
 $xha=$xha+$jrow;
 $pdf->setFillColor(255,255,255);
 $querycut = "SELECT * FROM cuti WHERE nama=".$_SESSION['staff_id']." AND YEAR(tgl)=".date('Y');
 $rscut=mysqli_query($con,$querycut);
 $nocut=1;
 while($rowcut = mysqli_fetch_array($rscut)){
 $pdf->setXY(20,$xha);
 $pdf->CELL(10,6,$nocut,1,0,'C',1);
 $pdf->CELL(30,6,'Periode'  .$nocut,1,0,'C',1);
 $pdf->CELL(50,6,$rowcut['tgl_cuti'],1,0,'C',1);
 $pdf->CELL(30,6,$rowcut['durasi'],1,0,'C',1);
 $pdf->CELL(50,6,$rowcut['keterangan'],1,0,'C',1);
 $xha=$xha+$jrow;
 $nocut++;
 }
$pdf->Output();

?>


