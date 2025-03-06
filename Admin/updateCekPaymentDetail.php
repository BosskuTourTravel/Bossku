<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$tipe = $_POST['tipe'];

if($tipe==0){
	$sql = "UPDATE payment_detail SET status_cek=1 WHERE id=".$id;
}elseif($tipe==1){
	$sql = "UPDATE payment_detail_visapassport SET status_cek=1 WHERE id=".$id;
}elseif($tipe==4){
	$sql = "UPDATE payment_detail_flight SET status_cek=1 WHERE id=".$id;
}else{
	$sql = "UPDATE pengeluaran_kantor SET status_cek=1 WHERE id=".$id;
}
if (mysqli_query($con, $sql)) {
  echo "success";

} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
    



?>