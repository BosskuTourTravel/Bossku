<?php
include "../site.php";
include "../db=connection.php";

$country = $_POST['country'];
$agent = $_POST['agent'];
$flag = $_POST['flag'];

$sql = "UPDATE performa_price_standart SET option_price =".$flag." WHERE country=".$country." AND agent=".$agent;
if (mysqli_query($con, $sql)) {
	$temp = 0;
} else {
	$temp = 1;
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
    

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
					$sql2 = "UPDATE performa_price SET option_price = ".$flag." WHERE performa_price_range=".$row_range['id']." AND tour_package = ".$row_tour['id'];

					if (mysqli_query($con, $sql2)) {
						$temp = 0;
					}
				}

			}


		}

	}


	echo "success";
}

?>