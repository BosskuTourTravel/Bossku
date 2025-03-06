<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$persentase = $_POST['persentase'];
$nominal = $_POST['nominal'];
$agentcom = $_POST['agentcom'];
$range = $_POST['range'];
$staffcom = $_POST['staffcom'];
$staffcom2 = $_POST['staffcom2'];
$subagent = $_POST['subagent'];
$marketingcom = $_POST['marketingcom'];
$discount = $_POST['discount'];

$sql = "UPDATE performa_price SET performa_price_range=".$range.", persentase=".$persentase.", nominal=".$nominal.", agentcom='".$agentcom."', staffcom='".$staffcom."',staffcom2='".$staffcom2."', subagent='".$subagent."', marketingcom='".$marketingcom."', discount='".$discount."' WHERE id=".$id;
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>