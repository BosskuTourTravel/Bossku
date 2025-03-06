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
$staffcom2 = $_POST['staffcom2'];
$subagent = $_POST['subagent'];
$marketingcom = $_POST['marketingcom'];
$discount = $_POST['discount'];
$query = "SELECT * FROM performa_price_range";
$rs=mysqli_query($con,$query);
while($row = mysqli_fetch_array($rs)){
	$sql = "INSERT INTO performa_price_standart VALUES ('',".$agent.",".$country.",".$row['id'].",".$persentase.",".$nominal.",".$flag.",'".$agentcom."','".$staffcom."','".$staffcom2."','".$subagent."','".$marketingcom."','".$discount."')";
		if (mysqli_query($con, $sql)) {
			$temp = 0;
		} else {
			$temp = 1;
			echo "Error: " . $sql . "" . mysqli_error($con);
			header("location:https://www.2canholiday.com/Admin/#");
		}
	}

if($temp==0){
		$query_tour = "SELECT * FROM tour_package WHERE agent=".$agent." AND country LIKE '%".$country."%'";
		$rs_tour=mysqli_query($con,$query_tour);
		while($row_tour = mysqli_fetch_array($rs_tour)){
			$tempCountry = preg_split ("/[;]+/", $row_tour['country']);


			for($i=0; $i<count($tempCountry); $i++){
				$query_country = "SELECT * FROM country WHERE id=".$tempCountry[$i];
				$rs_country=mysqli_query($con,$query_country);
				$row_country = mysqli_fetch_array($rs_country);

				$query_country2 = "SELECT * FROM country WHERE id=".$country;
				$rs_country2=mysqli_query($con,$query_country2);
				$row_country2 = mysqli_fetch_array($rs_country2);

				if($row_country['name']==$row_country2['name']){
					$query_range = "SELECT * FROM performa_price_range";
					$rs_range=mysqli_query($con,$query_range);
					while($row_range = mysqli_fetch_array($rs_range)){
						$sql2 = "UPDATE performa_price SET persentase = ".$persentase.", nominal = ".$nominal.",option_price = ".$flag.", agentcom = '".$agentcom."', staffcom = '".$staffcom."',staffcom2 = '".$staffcom2."', subagent = '".$subagent."', marketingcom = '".$marketingcom."',discount = '".$discount."' WHERE performa_price_range=".$row_range['id']." AND tour_package = ".$row_tour['id'];
						// echo $sql2."</br>";
						if (mysqli_query($con, $sql2)) {
							$temp = 0;
						}
					}

				}


			}

		}

	
	echo "success";
}
	
	$con->close();


?>