<?php
include "../site.php";
include "../db=connection.php";


$cekifnull = 0;

$queryperformaprice = "SELECT COUNT(*) as total FROM performa_price_visapassport WHERE country=".$_POST['country'];
$rsperformaprice=mysqli_query($con,$queryperformaprice);
$rowperformaprice = mysqli_fetch_assoc($rsperformaprice);

$country = $_POST['country'];
$agent = $_POST['agent'];
$persentase = $_POST['persentase'];
$nominal = $_POST['nominal'];
$agentcom = $_POST['agentcom'];
$flag = $_POST['flag'];
$staffcom = $_POST['staffcom'];
$staffcom2= $_POST['staffcom2'];
$subagent = $_POST['subagent'];
$marketingcom = $_POST['marketingcom'];
$discount = $_POST['discount'];

if($agent==''){
	$cekifnull = $cekifnull + 1;
}
if($persentase==''){
	$cekifnull = $cekifnull + 1;
}
if($nominal==''){
	$cekifnull = $cekifnull + 1;
}
if($agentcom==''){
	$cekifnull = $cekifnull + 1;
}
if($flag==''){
	$cekifnull = $cekifnull + 1;
}
if($staffcom==''){
	$cekifnull = $cekifnull + 1;
}
if($staffcom2==''){
	$cekifnull = $cekifnull + 1;
}
if($subagent==''){
	$cekifnull = $cekifnull + 1;
}
if($marketingcom==''){
	$cekifnull = $cekifnull + 1;
}
if($discount==''){
	$cekifnull = $cekifnull + 1;
}

if($rowperformaprice['total']>0){

	if($cekifnull!=10){

		$sql = "UPDATE performa_price_visapassport SET persentase =".$persentase.", nominal =".$nominal.", agentcom=".$agentcom.", option_price=".$flag.", staffcom='".$staffcom."', staffcom2='".$staffcom2."', subagent='".$subagent."', marketingcom='".$marketingcom."', discount='".$discount."' WHERE country=".$_POST['country'];

		if (mysqli_query($con, $sql)) {
			echo "success";
		} else {
			echo "Error: " . $sql . "" . mysqli_error($con);
		}

	}


	$con->close();

}else{
	if($cekifnull!=10){

		$sql = "INSERT INTO performa_price_visapassport VALUES ('',".$country.",".$persentase.",".$nominal.",".$agentcom.",".$flag.",'".$staffcom."','".$staffcom2."','".$subagent."','".$marketingcom."','".$discount."','".$visa."','".$passport."')";

		if (mysqli_query($con, $sql)) {
			echo "success";
		} else {
			echo "Error: " . $sql . "" . mysqli_error($con);
		}

	}


	$con->close();
}









?>