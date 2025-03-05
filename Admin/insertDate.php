<?php
include "../site.php";
include "../db=connection.php";
session_start();

$id = $_POST['id'];
$month = $_POST['month'];
$day = $_POST['day'];
$year = $_POST['year'];
$pilihan = $_POST['pilihan'];

//*** edit neno */
$staff =$_SESSION['staff_id'];
$job = '28';
$keterangan = "input Lantour";
$jumlah = '1';
$timedate = date("Y-m-d H:i:s");
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

$query= "SELECT count(*) as total FROM date_package WHERE date_number=".$day." and month=".$month." and year=".$year." and tourpackage=".$id;
$rs=mysqli_query($con,$query);
$row= mysqli_fetch_assoc($rs);

if($row['total']<1){
	$sql = "INSERT INTO date_package VALUES ('','".$day."','".$month."','".$year."',".$id.")";
	$sql2 = "UPDATE tour_package SET days='".$pilihan."' WHERE id=".$id;
	if (mysqli_query($con, $sql) and mysqli_query($con, $sql2)) {
		echo "success";
		$com3="1";
		$queryct= "SELECT * FROM com_landtour  WHERE tour_id=".$id;
		$rsct=mysqli_query($con,$queryct);
		$rowct = mysqli_fetch_array($rsct);
		$id_landtour=$rowct['tour_id'];
		if($id==$id_landtour){
			$sqlx = "UPDATE com_landtour SET com3='".$com3."' WHERE tour_id=".$id;
			
		}else{
			$sqlx = "INSERT INTO com_landtour VALUES ('','".$id."','','','".$com3."')";
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
}else{
	echo "success";
}



?>