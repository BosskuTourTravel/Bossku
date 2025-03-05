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

$sql = "UPDATE performa_price_standart SET performa_price_range=".$range.", persentase=".$persentase.", nominal=".$nominal.", agentcom='".$agentcom."', staffcom='".$staffcom."',staffcom2='".$staffcom2."', subagent='".$subagent."', marketingcom='".$marketingcom."', discount='".$discount."' WHERE id=".$id;
	if (mysqli_query($con, $sql)) {

		//batas

		$query_performaprice = "SELECT * FROM performa_price_standart WHERE id=".$id;
		$rs_performaprice=mysqli_query($con,$query_performaprice);
		$row_performaprice = mysqli_fetch_array($rs_performaprice);

		$agent = $row_performaprice['agent'];
		$country = $row_performaprice['country'];

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
					
						$sql2 = "UPDATE performa_price SET persentase = ".$persentase.", nominal = ".$nominal.",option_price = ".$flag.", agentcom = '".$agentcom."', staffcom = '".$staffcom."',staffcom2 = '".$staffcom2."', subagent = '".$subagent."', marketingcom = '".$marketingcom."',discount = '".$discount."' WHERE performa_price_range=".$range." AND tour_package = ".$row_tour['id'];
						// echo $sql2."</br>";
						if (mysqli_query($con, $sql2)) {
							$temp = 0;
						}
					

				}


			}

		}
		//batas



		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();


?>