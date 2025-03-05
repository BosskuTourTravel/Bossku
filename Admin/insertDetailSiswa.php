<?php
include "../site.php";
include "../db=connection.php";
session_start();
$totalsiswa = $_POST['totalsiswa'];
$id = $_POST['id'];

$tempcek = 0;


$query_detailsiswa = "SELECT COUNT(*) as total FROM siswa WHERE customer_id=".$_POST['id'];
$rs_detailsiswa=mysqli_query($con,$query_detailsiswa);
$row_detailsiswa = mysqli_fetch_assoc($rs_detailsiswa);

if($row_detailsiswa['total']>0){
	$sql = "DELETE FROM siswa WHERE customer_id =".$id;
		if (mysqli_query($con, $sql)) {
			$tempcek = 0;

		} else {
			$tempcek = 1;
		}
}

if($tempcek!=1){

	for ($x = 0; $x < $totalsiswa; $x++) {
		$txtName = "name".$x;
		$txtPhone = "phone".$x;
		$txtAddress = "address".$x;
		$txtEmail = "email".$x;
		$cekifnull = 0;

		$name = $_POST[$txtName];
		$phone = $_POST[$txtPhone];
		$address = $_POST[$txtAddress];
		$email = $_POST[$txtEmail];

		$date = date("Y-m-d");

		if($name=='' OR $name=='undefined'){
			$cekifnull = $cekifnull + 1;
		}
		if($phone=='' OR $phone=='undefined'){
			$cekifnull = $cekifnull + 1;
		}
		if($address=='' OR $address=='undefined'){
			$cekifnull = $cekifnull + 1;
		}
		if($email=='' OR $email=='undefined'){
			$cekifnull = $cekifnull + 1;
		}
		if($cekifnull!=4){
			$sql = "INSERT INTO siswa VALUES('',".$id.",'".$name."','".$phone."','".$address."','".$email."',".$_SESSION['staff_id'].",'".$date."')";
		 //echo $sql."</br>";
			if (mysqli_query($con, $sql)) {
				$tempcek = 0;

			} else {
				$tempcek = 1;
			}
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