<?php
include "../site.php";
include "../db=connection.php";
session_start();


$id = $_POST['id'];
// $inclusion = $_POST['inclusion'];
// $exclusion = $_POST['exclusion'];
$title = $_POST['title'];
$remark = $_POST['remark'];
$term = $_POST['term'];

$tipping = $_POST['tipping'];
$tipping2 = $_POST['tipping2'];
$tipping3 = $_POST['tipping3'];
$tippingkurs = $_POST['kurs'];
$ferryname = $_POST['ferryname'];
$ferryprice = $_POST['ferry'];
$ferrykurs = $_POST['ferrykurs'];
$bulletname = $_POST['bulletname'];
$bulletprice = $_POST['bulletprice'];
$bulletkurs = $_POST['bulletkurs'];
$admissionname = $_POST['admissionname'];
$admissionprice = $_POST['admissionprice'];
$admissionkurs = $_POST['admissionkurs'];
$flightname = $_POST['flightname'];
$flightprice = $_POST['flightprice'];
$flightkurs = $_POST['flightkurs'];

$strvisa = $_POST['strvisa'];
$strbordercity = $_POST['strbordercity'];
$strborderkurs = $_POST['strborderkurs'];
$strborderprice = $_POST['strborderprice'];
$strguide = $_POST['strguide'];


$inclusion = json_decode(stripslashes($_POST['inclusion']));
$exclusion = json_decode(stripslashes($_POST['exclusion']));

$stamp 	= date("Y-m-d");
//////////////////////////////////////////////
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

for ($x = 0; $x < count($inclusion); $x++) {
	$sql = "INSERT INTO inclusion_tourpackage VALUES ('',".$inclusion[$x].",".$id.",'".$stamp."')";
	if (mysqli_query($con, $sql)) {
		$tempCek = 0; 
	} else {
		$tempCek = 1; 
	}
}

for ($x = 0; $x < count($exclusion); $x++) {
	$sql = "INSERT INTO exclusion_tourpackage VALUES ('',".$exclusion[$x].",".$id.",'".$stamp."')";
	if (mysqli_query($con, $sql)) {
		$tempCek = 0; 
	} else {
		$tempCek = 1; 
	}
}

// $sql = "INSERT INTO inclusion VALUES ('','".$inclusion."',".$id.")";
// $sql2 = "INSERT INTO exclusion VALUES ('','".$exclusion."',".$id.")";
$sql3 = "INSERT INTO remark VALUES ('','".$title."','".$remark."',".$id.")";
$sql4 = "INSERT INTO termsandconditions VALUES ('','".$term."',".$id.")";
$sql5 = "INSERT INTO exclusion_plus VALUES ('','".$bulletname."','".$bulletprice."',".$bulletkurs.",'".$admissionname."','".$admissionprice."',".$admissionkurs.",'".$flightname."','".$flightprice."',".$flightkurs.",'".$ferryname."','".$ferryprice."',".$ferrykurs.",".$tipping2.",".$tipping3.",".$tippingkurs.",".$id.")";
$sql6 = "UPDATE tour_package SET tipping=".$tipping.", kurs=".$tippingkurs." WHERE id=".$id;
$sql7 = "INSERT INTO exclusion_tourpackage_plus VALUES ('','".$strvisa."','".$strguide."','".$strbordercity."','".$strborderkurs."','".$strborderprice."',".$id.",'".$stamp."')";
$tempCek = 0;

if (mysqli_query($con, $sql3) and mysqli_query($con, $sql4) and mysqli_query($con, $sql5) and mysqli_query($con, $sql6) and mysqli_query($con, $sql7)) {
	$tempCek = 0; 
} else {
    $tempCek  = 1;
}

$flightdomestic_count = $_POST['flightdomestic_count'];
$kursDomestic = $_POST['kursDomestic'];
if($flightdomestic_count > 0){
	for ($x = 0; $x < $flightdomestic_count; $x++) {
		$from = $_POST['from'.$x];
		$to = $_POST['to'.$x];
		$destination_from = $_POST['destination_from'.$x];
		$destination_to = $_POST['destination_to'.$x];
		$price = $_POST['price'.$x];
		$destination_from = str_replace("'","",$destination_from);
		$destination_to = str_replace("'","",$destination_to);
		$sql7 = "INSERT INTO flight_domestic_tourpackage VALUES ('',".$id.",'".$from."','".$to."','".$destination_from."','".$destination_to."',".$kursDomestic.",".$price.",'".$stamp."')";
		// echo $sql7."</br>";
		if (mysqli_query($con, $sql7)){
			$tempCek = 0; 
		}else{
			$tempCek  = 1;
		}
	}

	
}

if ($tempCek == 0){
	echo "success";
//////////////////////////////////////////////////
	$com2="1";
	$queryct= "SELECT * FROM com_landtour WHERE tour_id=".$id;
	$rsct=mysqli_query($con,$queryct);
	$rowct = mysqli_fetch_array($rsct);
	$id_landtour=$rowct['tour_id'];
	if($id==$id_landtour){
		$sqlx = "UPDATE com_landtour SET com2='".$com2."' WHERE tour_id=".$id;
		
	}else{
		$sqlx = "INSERT INTO com_landtour VALUES ('','".$id."','','".$com2."','')";
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
	}else{var_dump("gagal1");}
//////////////////////////////////////////////

}else{
	echo "Error: " . $sql . "" . mysqli_error($con);
	header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();



?>