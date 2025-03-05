<?php
include "../site.php";
include "../db=connection.php";

$agent = $_POST['agent'];
$country = $_POST['country'];
$persentase = $_POST['persentase'];
$nominal = $_POST['nominal'];
$agentcom = $_POST['agentcom'];
$flag = $_POST['flag'];
$staffcom = $_POST['staffcom'];
$subagent = $_POST['subagent'];
$marketingcom = $_POST['marketingcom'];
$query = "SELECT * FROM performa_price_range";
$rs=mysqli_query($con,$query);
while($row = mysqli_fetch_array($rs)){
	$sql = "INSERT INTO performa_price_standart VALUES ('',".$agent.",".$country.",".$row['id'].",".$persentase.",".$nominal.",".$flag.",'".$agentcom."','".$staffcom."','".$subagent."','".$marketingcom."')";
		if (mysqli_query($con, $sql)) {
			$temp = 0;
		} else {
			$temp = 1;
			echo "Error: " . $sql . "" . mysqli_error($con);
			header("location:https://www.2canholiday.com/Admin/#");
		}
	}

if($temp==0){
	echo "success";
}
	
	$con->close();


?>