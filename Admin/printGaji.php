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

// // memanggil library FPDF
// //require('../plugins/fpdf/fpdf.php');
// // intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('P','mm','A4');
// // membuat halaman baru
$pdf->AddPage();
// // setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
$querys = "SELECT id,tgl,nama,gaji,bpjs,gj,year(tgl) AS yea,month(tgl) AS mon FROM sallary WHERE nama=".$_SESSION['staff_id']." order by tgl DESC limit 1,1";
$rss=mysqli_query($con,$querys);
$rows = mysqli_fetch_array($rss);
$bulanx=$rows['mon'];
$gj=$rows['gj'];
$x=$rows['yea'];
$y=$rows['mon'];
$tgaw=date("$x-$y-11");
$tgak=date("Y-m-11", strtotime("+1 months",strtotime($tgaw)));
# header
$pdf->cell(180, 25,'',1,0);
$pdf->setFont('Arial','',14);
$pdf->text(70,20,'PT. PERFORMA TOUR & TRAVEL');
$pdf->setFont('Arial','',9);
$pdf->text(20,26,'San Diego M7 no 5, Pakuwon City, Surabaya');
$pdf->text(120,26,'Komplek Ruko Inti Batam Blok A no 7');
$pdf->text(120,29,'Telp (+62) 778 5115338 / Fax 0778-433030');
$pdf->text(145,40,'UPDATE : '.date('d').' '.date('M').' '.date('Y'));
$pdf->setFont('Arial','',12);
$pdf->text(93,42,'SLIP GAJI');
#2
$yi = 43;
$ya = 43;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(60,6,'MONTH',1,0);
$pdf->cell(10,6,':',1,0,'C');
$pdf->cell(70,6,$bulan[$bulanx],1,0);
$jrow = 6;
$ya = $yi + $jrow;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(60,6,'POSITION',1,0);
$pdf->cell(10,6,':',1,0,'C');
////////////////////////////////////////////////////////////
$queryst = "SELECT * FROM login_staff WHERE id=".$rows['nama'];
$rsst=mysqli_query($con,$queryst);
$rowst = mysqli_fetch_array($rsst);
$querystaff = "SELECT * FROM staff_type WHERE id=".$rowst['type'];
$rsstaff=mysqli_query($con,$querystaff);
$rowstaff = mysqli_fetch_array($rsstaff);

/////////////////////////////////////////////////////////
$pdf->cell(70,6,$rowstaff['name'],1,0);
$ya = $ya+$jrow;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(60,6,'NAME',1,0);
$pdf->cell(10,6,':',1,0,'C');
$pdf->cell(70,6,$rowst['name'],1,0);
$ya = $ya+$jrow;
////////////////////////////////////////
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(60,6,'WORKING STARTING',1,0);
$pdf->cell(10,6,':',1,0,'C');
$pdf->cell(70,6,$rowst['stamp'],1,0);
$ya = $ya+$jrow;
///////////////////////////////////
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(60,6,'TARGET OMSET',1,0);
$pdf->cell(10,6,':',1,0,'C');
$pdf->cell(70,6,'',1,0);
$ya = $ya+$jrow;
////////////////////////////////
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$querygj = "SELECT * FROM sallary  WHERE nama=".$_SESSION['staff_id']." AND YEAR(tgl) =".date('Y')." AND MONTH(tgl) =".date('m');
$rsgj=mysqli_query($con,$querygj);
$rowgj = mysqli_fetch_array($rsgj);
$pdf->cell(60,6,'I. GAJI POKOK',0,0);
$pdf->cell(10,6,'',0,0);
$pdf->cell(60,6,'',0,0);
$pdf->cell(10,6,'',0,0,'C');
$pdf->cell(40,6,'',0,0,'C');
$ya = $ya+$jrow;
///////////////////////////////////////////////////////
$querytj = "SELECT * FROM tunjangan WHERE nama=".$rows['nama'];
$rstj=mysqli_query($con,$querytj);
$rowtj = mysqli_fetch_array($rstj);
$querylp = "SELECT * FROM lemburPrice WHERE nama=".$rows['nama'];
$rslp=mysqli_query($con,$querylp);
$rowlp = mysqli_fetch_array($rslp);
////////////////////////////////
if($gj=='1'){
$querytjp = "SELECT COUNT(nominal) as cnom FROM tunjangan_price WHERE nama=".$rows['nama']." AND YEAR(tgl)=".$rows['yea']." AND MONTH(tgl)=".$rows['mon'];
$querylem = "SELECT SUM(total) as subtotal,SUM(over) as subdurasi  FROM lembur WHERE staff =".$rows['nama']." AND YEAR(tgl)=".$rows['yea']." AND MONTH(tgl)=".$rows['mon'];
$querylem2 = "SELECT SUM(total2) as subtotal2,SUM(over2) as subdurasi2  FROM lembur2 WHERE staff2 =".$rows['nama']." AND YEAR(tgl2)=".$rows['yea']." AND MONTH(tgl2)=".$rows['mon'];
$queryjd = "SELECT SUM(total) as subjobdesk FROM total_job WHERE id_staff =".$rows['nama']." AND YEAR(date)=".$rows['yea']." AND MONTH(date) =".$rows['mon'];
$querycomlt = "SELECT SUM(staff_com) as substaffcom FROM invoice WHERE staff_id=".$rows['nama']." AND YEAR(stamp)=".$rows['yea']." AND MONTH(stamp) =".$rows['mon'];
$querycomvp = "SELECT SUM(staff_com) as subvpcom FROM invoiceVisaPassport WHERE staff_id=".$rows['nama']." AND YEAR(stamp)=".$rows['yea']." AND MONTH(stamp) =".$rows['mon'];
$queryfl = "SELECT SUM(staff_com) as subflcom,SUM(adt_price) as subadtcom,SUM(selling_adt_price) as subsap FROM flight WHERE staff_id=".$rows['nama']." AND YEAR(stamp)=".$rows['yea']." AND MONTH(stamp) =".$rows['mon'];
}else{
$querytjp = "SELECT COUNT(nominal) as cnom FROM tunjangan_price WHERE tgl >= '".$tgaw."' AND tgl < '".$tgak."' AND nama=".$rows['nama'];
$querylem = "SELECT SUM(total) as subtotal,SUM(over) as subover  FROM lembur WHERE tgl >= '".$tgaw."' AND tgl < '".$tgak."' AND staff=".$rows['nama'];
$querylem2 = "SELECT SUM(total2) as subtotal2,SUM(over2) as subover2  FROM lembur2 WHERE tgl2 >= '".$tgaw."' AND tgl2 < '".$tgak."' AND staff2=".$rows['nama'];
$queryjd = "SELECT SUM(total) as subjobdesk FROM total_job WHERE date >= '".$tgaw."' AND date < '".$tgak."' AND id_staff =".$rows['nama'];
$querycomlt = "SELECT SUM(staff_com) as substaffcom FROM invoice WHERE stamp >= '".$tgaw."' AND stamp < '".$tgak."' AND staff_id=".$rows['nama'];
$querycomvp = "SELECT SUM(staff_com) as subvpcom FROM invoiceVisaPassport WHERE stamp >= '".$tgaw."' AND stamp < '".$tgak."' AND staff_id=".$rows['nama'];
$queryfl = "SELECT SUM(staff_com) as subflcom,SUM(adt_price) as subadtcom,SUM(selling_adt_price) as subsap FROM flight WHERE stamp >= '".$tgaw."' AND stamp < '".$tgak."' AND staff_id=".$rows['nama'];
}
////////////////////////////////////
$rstjp=mysqli_query($con,$querytjp);
$rowtjp = mysqli_fetch_array($rstjp);
$rslem=mysqli_query($con,$querylem);
$rowlem=mysqli_fetch_array($rslem);
$rslem2=mysqli_query($con,$querylem2);
$rowlem2=mysqli_fetch_array($rslem2);
$rsjd=mysqli_query($con,$queryjd);
$rowjd=mysqli_fetch_array($rsjd);
$rscomlt=mysqli_query($con,$querycomlt);
$rowcomlt=mysqli_fetch_array($rscomlt);
$rscomvp=mysqli_query($con,$querycomvp);
$rowcomvp=mysqli_fetch_array($rscomvp);
$rsfl=mysqli_query($con,$queryfl);
$rowfl=mysqli_fetch_array($rsfl);
$lembur=$rowlem['subtotal'] + $rowlem2['subtotal2'];

/////////////////////////////////////
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(40,6,'GAJI BASIC',1,0);
$pdf->cell(40,6,'Rp.'.number_format($rows['gaji'], 0, ".", "."),1,0);
$pdf->cell(10,6,'x',1,0,'C');
$pdf->cell(30,6,'1',1,0,'C');
$pdf->cell(10,6,'Month',1,0);
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,number_format($rows['gaji'], 0, ".", "."),1,0,'C');
$ya = $ya+$jrow;
/////////////////////////////////////////
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(40,6,'JOB DESC',1,0);
$pdf->cell(40,6,'Rp.'.number_format($rowjd['subjobdesk'], 0, ".", "."),1,0);
$pdf->cell(10,6,'',1,0,'C');
$pdf->cell(30,6,'',1,0,'C');
$pdf->cell(10,6,'',1,0,'C');
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,number_format($rowjd['subjobdesk'], 0, ".", "."),1,0,'C');
$ya = $ya+$jrow;
//////////////////////////
$jp=$rowtjp['cnom'] * $rowtj['nominal'];
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(40,6,'BPJS',1,0);
$pdf->cell(40,6,'Rp.'.number_format($rows['bpjs'], 0, ".", "."),1,0);
$pdf->cell(10,6,'x',1,0,'C');
$pdf->cell(30,6,'1',1,0,'C');
$pdf->cell(10,6,'Month',1,0);
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,number_format($rows['bpjs'], 0, ".", "."),1,0,'C');
$ya = $ya+$jrow;
////////////////////////////////
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(60,6,'II. TUNJANGAN',0,0);
$pdf->cell(10,6,'',0,0);
$pdf->cell(60,6,'',0,0);
$pdf->cell(10,6,'',0,0);
$pdf->cell(40,6,'',0,0);
$ya = $ya+$jrow;
#3
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(40,6,'Makan/Transport',1,0);
$pdf->cell(40,6,'Rp.'.number_format($rowtj['nominal'], 0, ".", "."),1,0);
$pdf->cell(10,6,'x',1,0,'C');
$pdf->cell(30,6,$rowtjp['cnom'],1,0,'C');
$pdf->cell(10,6,'Day',1,0);
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,number_format($jp, 0, ".", "."),1,0,'C');
$ya = $ya+$jrow;
//////////////////////////////////////////////////////
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(40,6,'Lembur',1,0);
$pdf->cell(40,6,'Rp.'.$rowlp['nominal'],1,0);
$pdf->cell(10,6,'x',1,0,'C');
$pdf->cell(30,6,$rowlem['subover'],1,0,'C');
$pdf->cell(10,6,'Hours',1,0);
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,number_format($lembur, 0, ".", "."),1,0,'C');
$ya = $ya+$jrow;
#4
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(60,6,'III. COMISSION',0,0);
$pdf->cell(10,6,'',0,0);
$pdf->cell(60,6,'',0,0);
$pdf->cell(10,6,'',0,0);
$pdf->cell(40,6,'',0,0);
$ya = $ya+$jrow;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(40,8,'',1,0);
$pdf->cell(30,8,'Omset Jual',1,0,'C');
$pdf->cell(30,8,'Nett Profit',1,0,'C');
$pdf->cell(30,8,'Persentase',1,0,'C');
$ya = $ya+$jrow+2;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(40,6,'Flight Ticket',1,0);
$pdf->cell(30,6,number_format($rowfl['subadtcom'], 0, ".", "."),1,0);
$pdf->cell(30,6,number_format($rowfl['subsap'], 0, ".", "."),1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,number_format($rowfl['subflcom'], 0, ".", "."),1,0,'C');
$ya = $ya+$jrow;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(40,6,'Admission Ticket/JR',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,'',1,0);
$ya = $ya+$jrow;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(40,6,'Ferry',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,'',1,0);
$ya = $ya+$jrow;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(40,6,'Staff Landtour',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,number_format($rowcomlt['substaffcom'], 0, ".", "."),1,0,'C');
$ya = $ya+$jrow;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(40,6,'Landtour &  Staff Marketing',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,'',1,0);
$ya = $ya+$jrow;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(40,6,'Cruise',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,'',1,0);
$ya = $ya+$jrow;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(40,6,'Visa',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,number_format($rowcomvp['subvpcom'], 0, ".", "."),1,0,'C');
$ya = $ya+$jrow;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(40,6,'Insunance',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,'',1,0);
$ya = $ya+$jrow;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(40,6,'Modem',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,'',1,0);
$ya = $ya+$jrow;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(40,6,'Tour Package',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(30,6,'',1,0);
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,'',1,0);
$ya = $ya+$jrow;
#5
///////total///////////
$total=$rows['gaji'] + $rowjd['subjobdesk'] + $rows['bpjs'] + $jp + $rowlem['subtotal'] + $rowlem2['subtotal2'] + $rowcomvp['subvpcom'] + $rowcomlt['substaffcom'] + $rowfl['subflcom'];
/////////////////////
$ya = $ya+$jrow;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(130,6,'Tunjangan Kerajinan (bila mencapai omset yang di targetkan)',1,0);
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,'',1,0);;
$ya = $ya+$jrow+2;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(130,6,'',1,0,'C');
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,'',1,0);;
$ya = $ya+$jrow+2;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(110,6,'',0,0,'C');
$pdf->cell(20,6,'TOTAL',0,0);
$pdf->cell(10,6,'Rp',0,0,'C');
$pdf->cell(40,6,number_format($total, 0, ".", "."),1,0,'C');
$ya = $ya+$jrow+2;
#6
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(180,6,'Notes :',0,0,'L');
$ya = $ya+$jrow-3;
$pdf->setXY(10,$ya);
$pdf->cell(180,6,'1. komisi tiket pesawat, landtour dan paket tour tidak berlaku untuk penjualan paket taour group series, Karena untuk event lebaran ',0,0,'L');
$ya = $ya+$jrow-3;
$pdf->setXY(10,$ya);
$pdf->cell(180,6,'    dan desember sistem komisi atau bonus tiket pesawat dan lebaran akan dibuat pro rata yaitu (0.5% x omset dibagi jumlah staff)',0,0,'L');
$ya = $ya+$jrow-3;
$pdf->setXY(10,$ya);
$pdf->cell(180,6,'2. kenaikan gaji akan dikaji per 3 bulan sekali dengan beberapa pertimbangan pencapaian target omset,kerajinan,jujur dan kesabaran.',0,0,'L');
$ya = $ya+$jrow;
#7
$ya = $ya+$jrow;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(30,6,'Diterima Oleh',0,0,'C');
$pdf->cell(120,6,'',0,0);
$pdf->cell(30,6,'Diberikan Oleh',0,0,'C');
$ya = $ya+$jrow+15;
$pdf->setFont('Arial','',9);
$pdf->setXY(10,$ya);
$pdf->cell(30,6,$rowst['name'],0,0,'C');
$pdf->cell(120,6,'',0,0);
$pdf->cell(30,6,'Bpk. Fandi',0,0,'C');
#halaman ke 2
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
$pdf->CELL(70,6,'NAMA JOB',1,0,'C',1);
$pdf->CELL(30,6,'JUMLAH',1,0,'C',1);
$pdf->CELL(50,6,'PENDAPATAN',1,0,'C',1);
$yha=$yha+$jrow;
if($gj=='1'){
  $query = "SELECT job,SUM(jumlah) as subjumlah,SUM(total) as subtotal  FROM total_job WHERE id_staff=".$rows['nama']." AND YEAR(date)=".$rows['yea']." AND MONTH(date)=".$rows['mon']." GROUP BY job";
}else{
  $query = "SELECT job,SUM(jumlah) as subjumlah,SUM(total) as subtotal  FROM total_job WHERE date >= '".$tgaw."' AND date < '".$tgak."' AND id_staff ='".$rows['nama']."' GROUP BY job";
}
$rs=mysqli_query($con,$query);
$nox = 1;
$totalx=0;
while($row = mysqli_fetch_array($rs)){
  $queryjg = "SELECT * FROM jenisgaji WHERE id=".$row['job'];
  $rsjg=mysqli_query($con,$queryjg);
  $rowjg = mysqli_fetch_array($rsjg);
$pdf->setFillColor(255,255,255);
$pdf->setXY(20,$yha);
$pdf->CELL(10,6,$nox,1,0,'C',1);
$pdf->CELL(70,6,$rowjg['nama_job'],1,0,'L',1);
$pdf->CELL(30,6,$row['subjumlah'],1,0,'C',1);
$pdf->CELL(50,6,number_format($row['subtotal'], 0, ".", "."),1,0,'C',1);
$yha=$yha+$jrow;
$nox++;
$totalx= $totalx+$row['subtotal'];
}
$pdf->setXY(20,$yha);
$pdf->CELL(10,6,'',1,0,'C',1);
$pdf->CELL(70,6,'Total',1,0,'L',1);
$pdf->CELL(30,6,'',1,0,'C',1);
$pdf->CELL(50,6,number_format($totalx, 0, ".", "."),1,0,'C',1);
$yha=$yha+$jrow;
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->text(60,30,'LIST CUTI TAHUNAN KARYAWAN   ');
$xhi = 50;
$xha = 50;
$jrow = 6;
$pdf->SetFont('Arial','',11);
$pdf->setXY(20,$xha);
$pdf->cell(30,6,'Nama   :   '.$rowst['name'],0,0,'L');
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
$querycut = "SELECT * FROM cuti WHERE nama=".$rows['nama']." AND YEAR(tgl)=".date('Y');
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
$pdf->Output("Laporan Gaji.pdf","I");
?>


