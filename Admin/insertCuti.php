<?php
include "../site.php";
include "../db=connection.php";
$date=date('Y-m-d');
$name = $_POST['name'];
$tcuti = $_POST['tcuti'];
$tawal = $_POST['tawal'];
$ket = $_POST['ket'];
$queryst = "SELECT * FROM login_staff WHERE name LIKE '$name%'";
$rsst=mysqli_query($con,$queryst);
$rowst = mysqli_fetch_array($rsst);
$staff=$rowst['id'];
var_dump($staff);

$sql = "INSERT INTO cuti VALUES ('','".$date."','".$staff."','".$tcuti."','".$tawal."','".$ket."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>