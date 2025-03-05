<?php
include "../site.php";
include "../db=connection.php";
session_start();

$id = $_POST['id'];
$name = $_POST['name'];
$year = $_POST['year'];
$rating = $_POST['rating'];
$price_package = $_POST['pricepackage'];
date_default_timezone_set('Asia/Jakarta');
$timedate = date("Y-m-d H:i:s");
$date = date('Y/m/d');
//*** edit neno */
$staff =$_SESSION['staff_id'];
$job = '28';
$keterangan = "input Lantour";
$jumlah = '1';
$queryjob = "SELECT * FROM jenisgaji WHERE id = ".$job;
$rsj=mysqli_query($con,$queryjob);
$rowj = mysqli_fetch_array($rsj);
$harga = $rowj['harga'];
$total=$jumlah * $harga;
$query_tour= "SELECT * FROM tour_package where id=".$id;
$rs_tour=mysqli_query($con,$query_tour);
$row_tour = mysqli_fetch_array($rs_tour);
$name_tour=$row_tour['tour_name'];
///////////////////////////////////////


$sql = "INSERT INTO tour_price_package VALUES ('','".$name."','".$price_package."',".$id.",0,'".$year."',".$rating.")";
	if (mysqli_query($con, $sql)) {
		echo "success";
		$com1="1";
		$queryct= "SELECT * FROM com_landtour  WHERE tour_id=".$id;
		$rsct=mysqli_query($con,$queryct);
		$rowct = mysqli_fetch_array($rsct);
		$id_landtour=$rowct['tour_id'];
		if($id==$id_landtour){
			$sqlx = "UPDATE com_landtour SET com1='".$com1."' WHERE tour_id=".$id;
			
		}else{
			$sqlx = "INSERT INTO com_landtour VALUES ('','".$id."','".$com1."','','')";
			var_dump($sqlx);
		}
		mysqli_query($con, $sqlx);
		$queryx= "SELECT * FROM com_landtour where tour_id=".$id;
		$rsx=mysqli_query($con,$queryx);
		$rowx = mysqli_fetch_array($rsx);
		if($rowx['com1']=="1" && $rowx['com2']=="1" && $rowx['com3']=="1")
		{
			$querytj= "SELECT * FROM total_job where img=".$id;
			$rstj=mysqli_query($con,$querytj);
			$rowtj = mysqli_fetch_array($rstj);
			$img=$rowtj['img'];
			if($id==$img){
				echo"sallary sudah masuk";
			}else{
			var_dump("succes1");
			$sqljob = "INSERT INTO total_job VALUES ('','".$timedate."','".$staff."','".$job."','".$name_tour."','".$id."','".$jumlah."','".$total."')";
			mysqli_query($con, $sqljob);
			}
		}else{var_dump("xxx");}

	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>
