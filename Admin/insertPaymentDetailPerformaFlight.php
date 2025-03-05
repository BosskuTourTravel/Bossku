<?php
session_start();
include "../site.php";
include "../db=connection.php";

$invoiceid = $_POST['invoiceid'];
$paymentnumber = $_POST['paymentnumber'];
$paymentprice = $_POST['paymentprice'];
$totalpayment = $_POST['totalpayment'];
$paymentagent = $_POST['paymentagent'];
$norek = $_POST['norek'];
$atasnama = $_POST['atasnama'];
$bank = $_POST['bank'];
$date = $_POST['date'];
$stamp 	= date("Y-m-d H:i:s"); 


// $month = substr($date,0,2);
// $day = substr($date,3,2);
// $year = substr($date,6,4);

// $date = $day + "-" + $month + "-" + $year;

if($_POST['code']==0){
	$target_filex2 = '';
}else{
	$target_dirx = "../assets/i/Performa/InvoiceFlight/Lampiran/";
	$target_dirx2 = "assets/i/Performa/InvoiceFlight/Lampiran/";
	$target_filex = $target_dirx . basename($_FILES["fileToUpload2"]["name"]);
	$target_filex2 = $target_dirx2 . basename($_FILES["fileToUpload2"]["name"]);
	$uploadOkx = 1;

// Check if file already exists
	if (file_exists($target_filex)) {
		echo "Sorry, file already exists.";
		$uploadOkx = 0;
	}
	if ($uploadOkx == 0) {
		echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_filex)) {

		} else {
			echo "Sorry, there was an error uploading your Lampiran.";
			
		}
	}

}

// echo $_SESSION['staff_id'];

$query_cek = "SELECT COUNT(*) as total FROM payment_detail_performaflight WHERE paymentnumber=".$paymentnumber." AND invoice_id=".$invoiceid;
$rs_cek = mysqli_query($con,$query_cek);
$row_cek = mysqli_fetch_assoc($rs_cek);

if($row_cek<=0){

$sql = "INSERT INTO payment_detail_performaflight VALUES ('',".$invoiceid.",".$paymentnumber.",".$paymentagent.",'".$date."',".$totalpayment.",".$paymentprice.",'','".$target_filex2."','','',0,'".$norek."','".$atasnama."','".$bank."',".$_SESSION['staff_id'].",0,1,'".$stamp."')";

	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();

}


?>