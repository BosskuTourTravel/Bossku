<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$persentase = $_POST['persentase'];
$nominal = $_POST['nominal'];
$agentcom = $_POST['agentcom'];
$flag = $_POST['flag'];
$range = $_POST['range'];
$staffcom = $_POST['staffcom'];
$staffcom2 = $_POST['staffcom2'];
$subagent = $_POST['subagent'];
$marketingcom = $_POST['marketingcom'];
$discount = $_POST['discount'];

$sql = "INSERT INTO performa_price VALUES ('',".$range.",".$persentase.",".$nominal.",'".$agentcom."',".$flag.",'".$staffcom."','".$staffcom2."','".$subagent."','".$marketingcom."','".$discount."',".$id.")";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>