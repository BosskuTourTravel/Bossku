<?php
include "../site.php";
include "../db=connection.php";
session_start();

$query_data = "SELECT * FROM LT_itinerary2 WHERE id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);

$date = date("Y-m-d");
$cabang = $_POST['cabang'];
$status = $_SESSION['staff_id'];
	$sql = "INSERT INTO LTSUB_itin VALUES ('','".$row_data['id']."','".$row_data['judul']."','".$row_data['landtour']."','".$row_data['hari']."','".$row_data['gambar1']."','".$row_data['gambar2']."','".$row_data['gambar3']."','".$row_data['gambar4']."','$date','$status','$cabang')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
	}
// if($cabang=='1'){
// 	$sql = "INSERT INTO LTSUB_itin VALUES ('','".$row_data['id']."','".$row_data['judul']."','".$row_data['landtour']."','".$row_data['hari']."','".$row_data['gambar1']."','".$row_data['gambar2']."','".$row_data['gambar3']."','".$row_data['gambar4']."','$date','$status','$cabang')";
// 	if (mysqli_query($con, $sql)) {
// 		echo "success";
// 	} else {
// 		echo "Error: " . $sql . "" . mysqli_error($con);
// 	}
// }else if($cabang =='2'){
// 	$sql = "INSERT INTO LTBTH_itin VALUES ('','".$row_data['id']."','".$row_data['judul']."','".$row_data['landtour']."','".$row_data['hari']."','".$row_data['gambar1']."','".$row_data['gambar2']."','".$row_data['gambar3']."','".$row_data['gambar4']."','$date','$status')";
// 	if (mysqli_query($con, $sql)) {
// 		echo "success";
// 	} else {
// 		echo "Error: " . $sql . "" . mysqli_error($con);
// 	}
// }else{
// 	$sql = "INSERT INTO LTCGK_itin VALUES ('','".$row_data['id']."','".$row_data['judul']."','".$row_data['landtour']."','".$row_data['hari']."','".$row_data['gambar1']."','".$row_data['gambar2']."','".$row_data['gambar3']."','".$row_data['gambar4']."','$date','$status')";
// 	if (mysqli_query($con, $sql)) {
// 		echo "success";
// 	} else {
// 		echo "Error: " . $sql . "" . mysqli_error($con);
// 	}
// }

$con->close();