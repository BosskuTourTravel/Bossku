<?php
include "../site.php";
include "../db=connection.php";

$staff = $_POST['staff'];
$keterangan = $_POST['keterangan'];
$job = $_POST['job'];
$jumlah=$_POST['jobitem'];
$z=$_POST['fileToUpload'];
date_default_timezone_set('Asia/Jakarta');
$date = date("Y-m-d H:i:s");
$date2 = date("Y-m-d");
$thn=date('Y');
$bln=date('m');
$hr=date('d');

$query = "SELECT * FROM jenisgaji WHERE id = ".$job;
$rs=mysqli_query($con,$query);
$row = mysqli_fetch_array($rs);
$querytj = "SELECT * FROM total_job WHERE  job = ".$job." AND  YEAR(date)=".$thn." AND month(date)=".$bln." AND DAY(date)=".$hr." AND  id_staff=".$staff;
$rstj=mysqli_query($con,$querytj);
$rowtj = mysqli_fetch_array($rstj);
$qjob=$rowtj['job'];
$qdate=$rowtj['date'];

if ($job =='6' or $job =='24' or $job =='25' or $job =='4'or $job =='6'){
  if ($qjob == '6' or $qjob =='24' or $qjob =='25' or $qjob =='4'or $qjob =='6'){
         $total='0';
  }else{
        $total=$row['harga'];
        }
}
else{
$total=$jumlah * $row['harga'];
}
$sql = "INSERT INTO total_job VALUES ('','".$date."','".$staff."','".$job."','".$keterangan."','','".$jumlah."','".$total."')";
if (mysqli_query($con, $sql)) {
  echo "success";
 
}else {
  echo "Error: " . $sql . "" . mysqli_error($con);
}

$con->close();

?>