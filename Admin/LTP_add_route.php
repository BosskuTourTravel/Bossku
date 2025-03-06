<?php 
include "../site.php";
include "../db=connection.php";
session_start();
$tgl = date("Y-m-d");
$status = $_SESSION['staff_id'];

$in = $_POST['city_in'];
$out = $_POST['city_out'];
$maskapai = $_POST['maskapai'];

if($in !=="" && $out !==""){
	$sql = "INSERT INTO LTP_add_route VALUES ('','$tgl','$in','$out','$maskapai','$status')";
	if (mysqli_query($con, $sql)) {
		echo "berhasill";
	} else {
		echo "error : ".$sql;
	}
	$con->close();
}else{
	echo "Data city tidak boleh kosong !!";
}

?>