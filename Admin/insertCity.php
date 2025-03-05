<?php
include "../site.php";
include "../db=connection.php";

$name = $_POST['name'];
$country = $_POST['country'];

$cekName = strtolower($name);

$query_city = "SELECT COUNT(*) as total FROM city WHERE LOWER(name) LIKE '".$cekName."'";
$rs_city=mysqli_query($con,$query_city);
$row_city = mysqli_fetch_assoc($rs_city);

if($row_city['total']<=0){
	$sql = "INSERT INTO city VALUES ('','".$name."','".$country."','')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();

}




?>