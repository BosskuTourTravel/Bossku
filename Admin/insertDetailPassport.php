<?php
include "../site.php";
include "../db=connection.php";
session_start();
$totalpax = $_POST['totalpax'];
$id = $_POST['id'];
$rooming = $_POST['rooming'];
$remark = $_POST['remark'];

$tempcek = 0;


for ($x = 0; $x < $totalpax; $x++) {
	$txtName = "name".$x;
	$txtSex = "sex".$x;
	$txtNational = "national".$x;
	$txtDob = "dob".$x;
	$txtPob = "pob".$x;
	$txtNoPassport = "nopassport".$x;
	$txtDoe = "doe".$x;
	$txtIssued = "issued".$x;
	$txtTelephone = "telephone".$x;

	$cekifnull = 0;

	$name = $_POST[$txtName];
	$sex = $_POST[$txtSex];
	$national = $_POST[$txtNational];
	$dob = $_POST[$txtDob];
	$pob = $_POST[$txtPob];
	$nopassport = $_POST[$txtNoPassport];
	$doe = $_POST[$txtDoe];
	$issued = $_POST[$txtIssued];
	$telephone = $_POST[$txtTelephone];
	$date = date("Y-m-d");

	if($name==''){
		$cekifnull = $cekifnull + 1;
	}
	if($sex==''){
		$cekifnull = $cekifnull + 1;
	}
	if($national==''){
		$cekifnull = $cekifnull + 1;
	}
	if($dob==''){
		$cekifnull = $cekifnull + 1;
	}
	if($pob==''){
		$cekifnull = $cekifnull + 1;
	}
	if($nopassport==''){
		$cekifnull = $cekifnull + 1;
	}
	if($doe==''){
		$cekifnull = $cekifnull + 1;
	}
	if($issued==''){
		$cekifnull = $cekifnull + 1;
	}
	if($telephone==''){
		$cekifnull = $cekifnull + 1;
	}


	if($x>0){
		$rooming = '';
	}
	if($cekifnull!=9){
		$sql = "INSERT INTO invoice_detail_passport VALUES('',".$id.",'".$name."','".$sex."','".$national."','".$dob."','".$pob."','".$nopassport."','".$doe."','".$issued."','".$rooming."','".$telephone."','".$remark."',".$_SESSION['staff_id'].",'".$date."')";

		if (mysqli_query($con, $sql)) {
			$tempcek = 0;

		} else {
			$tempcek = 1;
		}
	}
	
	

}

if($tempcek==0){
	echo "success";
}else{
	echo "Error: " . $sql . "" . mysqli_error($con);
}

$con->close();






?>