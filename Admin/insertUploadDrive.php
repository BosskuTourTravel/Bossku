<?php
include "../site.php";
include "../db=connection.php";
$date = date("Y-m-d H:i:s");
$documents = $_POST['LinkDocs'];
$thumnail = $_POST['Thumbnail'];
$gambar = $_POST['LinkGambar'];
$country = $_POST['country'];
$continent = $_POST['continent'];
$city = $_POST['city'];
$youtube = $_POST['youtube'];
$ig = $_POST['ig'];
$tt = $_POST['tt'];
$judul = $_POST['judul'];
$price =$_POST['price'];
$kurs =$_POST['kurs'];



$sql = "INSERT INTO Upload_Drive VALUES ('','".$date."','".$gambar."','".$thumnail."','".$documents."','".$continent."','".$country."','".$city."','".$judul."','".$ig."','".$tt."','".$youtube."','".$price."','".$kurs."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
		echo $sql;
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>