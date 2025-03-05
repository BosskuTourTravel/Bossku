<?php
include "../site.php";
include "../db=connection.php";

$invoiceid = $_POST['invoiceid'];
$paymentnumber = $_POST['paymentnumber'];
$paymentprice = $_POST['paymentprice'];
$paymenttype = $_POST['paymenttype'];
$paymentbank = $_POST['paymentbank'];
$description = $_POST['description'];
$tanggal = $_POST['tanggal'];
$stamp 	= date("Y-m-d H:i:s");  

$target_dir = "../assets/i/invoiceFlight/";
$target_dir2 = "assets/i/invoiceFlight/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file2 = $target_dir2 . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// echo $invoiceid;
// echo $paymentnumber;
// echo $paymentprice;
// echo $paymenttype;
// echo $paymentbank;
// echo $stamp;
// echo $target_file2;

$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if($check !== false) {
	$uploadOk = 1;
} else {
	echo "File is not an image.";
	$uploadOk = 0;
}
// Check if file already exists
if (file_exists($target_file)) {
	echo "Sorry, file already exists.";
	$uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
$uploadOk = 0;
}

if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

		$query_cek = "SELECT COUNT(*) as total FROM payment_detail_flight WHERE paymentnumber=".$paymentnumber." AND invoice_id=".$invoiceid;
		$rs_cek = mysqli_query($con,$query_cek);
		$row_cek = mysqli_fetch_assoc($rs_cek);

		if($row_cek<=0){
			$sql = "INSERT INTO payment_detail_flight VALUES ('',".$invoiceid.",".$paymentnumber.",".$paymentprice.",'".$description."','".$target_file2."','".$paymenttype."',".$paymentbank.",'".$tanggal."','".$stamp."',0)";
			if (mysqli_query($con, $sql)) {
				echo "success";

			} else {
				echo "Error: " . $sql . "" . mysqli_error($con);
				header("location:https://www.2canholiday.com/Admin/#");
			}
			$con->close();
		}

		
	} else {
		echo "Sorry, there was an error uploading your file.";
		header("location:https://www.2canholiday.com/Admin/#");
	}
}




?>