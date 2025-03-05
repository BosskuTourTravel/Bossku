<?php
include "../site.php";
include "../db=connection.php";


	$id = $_POST['id'];
	$country = $_POST['tcoun'];
	$query_performa_standart = "SELECT * FROM performa_price_standart WHERE id=".$id;
	$rs_performa_standart=mysqli_query($con,$query_performa_standart);
	$row_performa_standart = mysqli_fetch_array($rs_performa_standart);

	$tAgent = $row_performa_standart['agent'];

	$txtagent = "agent";
	$txtpersentase = "persentase";
	$txtnominal = "nominal";
	$txtagentcom = "agentcom";
	$txtflag = "flag";
	$txtstaffcom = "staffcom";
	$txtstaffcom2 = "staffcom2";
	$txtsubagent = "subagent";
	$txtmarketingcom = "marketingcom";
	$txtdiscount = "discount";

	$agent = $_POST[$txtagent];
	$persentase = $_POST[$txtpersentase];
	$nominal = $_POST[$txtnominal];
	$agentcom = $_POST[$txtagentcom];
	$flag = $_POST[$txtflag];
	$staffcom = $_POST[$txtstaffcom];
	$staffcom2= $_POST[$txtstaffcom2];
	$subagent = $_POST[$txtsubagent];
	$marketingcom = $_POST[$txtmarketingcom];
	$discount = $_POST[$txtdiscount];
	$sql = "UPDATE performa_price_standart SET persentase =".$persentase.",nominal = ".$nominal.",option_price=".$flag.",agentcom='".$agentcom."',staffcom='".$staffcom."',staff_com2='".$staffcom2."',subagent='".$subagent."',marketingcom='".$marketingcom."',discount='".$discount."' WHERE agent = ".$tAgent." AND country = ".$country;


	if (mysqli_query($con, $sql)) {
		$temp = 0;
	} else {
		$temp = 1;
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}

	if($temp==0){
		$queryperformastandart = "SELECT * FROM performa_price_standart WHERE id =".$_POST['id'];
		$rsperformastandart=mysqli_query($con,$queryperformastandart);
		$rowperformastandart = mysqli_fetch_array($rsperformastandart);

		$query_tour = "SELECT * FROM tour_package WHERE agent=".$rowperformastandart['agent']." AND country LIKE '%".$rowperformastandart['country']."%'";
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
					$sql2 = "UPDATE performa_price SET persentase = ".$persentase.", nominal = ".$nominal.",option_price = ".$flag.", agentcom = '".$agentcom."', staffcom = '".$staffcom."',staffcom2 = '".$staffcom2."', subagent = '".$subagent."', marketingcom = '".$marketingcom."',discount = '".$discount."' WHERE tour_package = ".$row_tour['id'];
					if (mysqli_query($con, $sql2)) {
						$temp = 0;
					}

				}
			}
			// for($i=0; $i<count($tempCountry); $i++){
			// 	$query_country = "SELECT * FROM country WHERE id=".$tempCountry[$i];
			// 	$rs_country=mysqli_query($con,$query_country);
			// 	$row_country = mysqli_fetch_array($rs_country);

			// 	$query_country2 = "SELECT * FROM country WHERE id=".$rowperformastandart['country'];
			// 	$rs_country2=mysqli_query($con,$query_country2);
			// 	$row_country2 = mysqli_fetch_array($rs_country2);

			// 	if($row_country['name']==$row_country2['name']){
			// 		$query_range = "SELECT * FROM performa_price_range";
			// 		$rs_range=mysqli_query($con,$query_range);
			// 		while($row_range = mysqli_fetch_array($rs_range)){
			// 			$sql2 = "UPDATE performa_price SET persentase = ".$persentase.", nominal = ".$nominal.",option_price = ".$flag.", agentcom = '".$agentcom."', staffcom = '".$staffcom."',staffcom2 = '".$staffcom2."', subagent = '".$subagent."', marketingcom = '".$marketingcom."',discount = '".$discount."' WHERE performa_price_range=".$row_range['id']." AND tour_package = ".$row_tour['id'];
			// 			if (mysqli_query($con, $sql2)) {
			// 				$temp = 0;
			// 			}
			// 		}

			// 	}


			// }

		}


		echo "success";
	}

$con->close();


?>