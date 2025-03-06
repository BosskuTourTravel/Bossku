<?php
include "../site.php";
include "../db=connection.php";
date_default_timezone_set('Asia/Jakarta');
$date = date("Y-m-d");
$in = date("H:i:s");
$id = $_POST['id'];
$lp = $_POST['lp'];
$jamin = $_POST['office'];
$staff = $_POST['staff'];
$place = $_POST['place'];
$type= $_POST['type'];
$t_ganti=$_POST['t_ganti'];
$ganti=$_POST['ganti'];
$date2=date("w");
$querylp = "SELECT * FROM lemburPrice WHERE nama=".$staff;
$rslp=mysqli_query($con,$querylp);
$rowlp = mysqli_fetch_array($rslp);
$thn=$rowlp['thn'];
//var_dump($thn."thn");

$querystaff = "SELECT * FROM tunjangan WHERE nama=".$_POST['staff'];
$rsstaff=mysqli_query($con,$querystaff);
$rowstaff = mysqli_fetch_array($rsstaff);
$nominal = $rowstaff['nominal'];
//$jamin=date("09:00:00");
var_dump($nominal);
$late="";
$rajin="";

$difflate  = round((strtotime($in) - strtotime($jamin))/3600, 1);
if($difflate > 0)
{	
		// $cb  = round((strtotime($in) - strtotime($jamin)));
		// $jam    =floor($cb / (60 * 60));
		// $menit   =$cb - $jam * (60 * 60);
		// $late=$jam."h".floor( $menit / 60 )."m";
		// var_dump($cb);
		// var_dump($jam);
		// var_dump(floor( $menit / 60 ));
		// var_dump($late);
   $late=$difflate;
}
$diffrajin  = round((strtotime($jamin) - strtotime($in))/3600, 1);
if($diffrajin > 0)
{	
	// $cbr  = round((strtotime($jamin) - strtotime($in)));
	// $jam    =floor($cbr / (60 * 60));
	// $menit   =$cb - $jam * (60 * 60);
	// $rajin=$jam."h".floor( $menit / 60 )."m";
    $rajin=$diffrajin;
}

var_dump($jamin);
var_dump($in);
var_dump($difflate);
var_dump($diffrajin);

if($thn =='1'){
	$sql3 = "INSERT INTO lembur2 VALUES ('','".$date."','".$staff."','".$place."','".$in."','','".$late."','".$rajin."','','','')";
	mysqli_query($con, $sql3);
}else{echo "Anda belum mendapatkan lembur 2";}

$sql = "INSERT INTO lembur VALUES ('','".$date."','".$staff."','".$place."','".$in."','','".$late."','".$rajin."','','','')";
	if (mysqli_query($con, $sql))  {
		$sql2 = "INSERT INTO tunjangan_price VALUES ('','".$date."','".$staff."','".$place."','".$nominal."')";
		mysqli_query($con, $sql2);
		if($date2=="0"){
		$sql3 = "INSERT INTO lembur_minggu VALUES ('','".$date."','".$staff."','".$ganti."','".$t_ganti."')";
		mysqli_query($con, $sql3);
		}else{echo "xxx";}
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();
?>