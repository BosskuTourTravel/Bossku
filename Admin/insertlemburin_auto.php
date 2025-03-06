<?php
include "../site.php";
include "../db=connection.php";
date_default_timezone_set('Asia/Jakarta');
$date = date("Y-m-d");

$queryst= "SELECT nama  FROM sallary_auto";
$rsst=mysqli_query($con,$queryst);
while($rowst = mysqli_fetch_array($rsst)){
$staff=$rowst['nama'];
$querylembur = "SELECT * FROM lembur WHERE tgl ='".$date."' AND staff=".$staff;
$rslembur=mysqli_query($con,$querylembur);
$rowlembur = mysqli_fetch_array($rslembur);
$st = $rowlembur['staff'];
if($staff==$st){
    echo"karyawan masuk";

}else{
    $sql = "INSERT INTO lembur VALUES ('','".$date."','".$staff."','LIBUR','','','','','','','')";
	mysqli_query($con, $sql); 
}
}
$con->close();
	
?>