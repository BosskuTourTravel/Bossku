<?php
include "../site.php";
include "../db=connection.php";


if($_POST['code']==0){
	$totalpax = $_POST['totalpax'];
	$country = $_POST['tcoun'];


	for ($x = 0; $x < $totalpax; $x++) {
		$txtagent = "agent".$x;
		$txtpersentase = "persentase".$x;
		$txtnominal = "nominal".$x;
		$txtagentcom = "agentcom".$x;
		$txtflag = "flag".$x;
		$txtstaffcom = "staffcom".$x;
		$txtstaffcom2 = "staffcom2".$x;
		$txtsubagent = "subagent".$x;
		$txtmarketingcom = "marketingcom".$x;
		$txtdiscount = "discount".$x;

		$cekifnull = 0;

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


		if($agent==''){
			$cekifnull = $cekifnull + 1;
		}
		if($persentase==''){
			$cekifnull = $cekifnull + 1;
			$persentase = 0;
		}
		if($nominal==''){
			$cekifnull = $cekifnull + 1;
			$nominal = 0;
		}
		if($agentcom==''){
			$cekifnull = $cekifnull + 1;
		}
		if($flag==''){
			$cekifnull = $cekifnull + 1;
		}
		if($staffcom==''){
			$cekifnull = $cekifnull + 1;
		}
		if($staffcom2==''){
			$cekifnull = $cekifnull + 1;
		}
		if($subagent==''){
			$cekifnull = $cekifnull + 1;
		}
		if($marketingcom==''){
			$cekifnull = $cekifnull + 1;
		}
		if($discount==''){
			$cekifnull = $cekifnull + 1;
		}

		if($x>0){
			$rooming = '';
		}

		if($cekifnull!=10){
			$queryperformaprice = "SELECT COUNT(*) as total FROM performa_price_standart WHERE agent=".$agent." AND country = ".$country;
			$rsperformaprice=mysqli_query($con,$queryperformaprice);
			$rowperformaprice = mysqli_fetch_assoc($rsperformaprice);

			if($rowperformaprice['total']<=0){
				$query = "SELECT * FROM performa_price_range";
				$rs=mysqli_query($con,$query);
				while($row = mysqli_fetch_array($rs)){
					$sql = "INSERT INTO performa_price_standart VALUES ('',".$agent.",".$country.",".$row['id'].",".$persentase.",".$nominal.",".$flag.",'".$agentcom."','".$staffcom."','".$staffcom2."','".$subagent."','".$marketingcom."','".$discount."')";
					//echo $sql."</br>";
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

									if (mysqli_query($con, $sql2)) {
										$temp = 0;
									}
								}

							}


						}

					}


					
				}
			}
			

		}
	}

	if($temp==0){
		echo "success";
	}
}else{
	$country = $_POST['tcoun'];
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
	$sql = "UPDATE performa_price_standart SET persentase =".$persentase.",nominal = ".$nominal.",option_price=".$flag.",agentcom='".$agentcom."',staffcom='".$staffcom."',staff_com2='".$staffcom2."',subagent='".$subagent."',marketingcom='".$marketingcom."',discount='".$discount."' WHERE id=".$_POST['id'];


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
					if(substr($agentcom,-1) == '%'){
						$commision = substr($agentcom,0,-1);
						$agentcom = $commision;
					}
					$sql2 = "UPDATE performa_price SET persentase = ".$persentase.", nominal = ".$nominal.",option_price = ".$flag.", agentcom = ".$agentcom.", staffcom = '".$staffcom."',staffcom2 = '".$staffcom2."', subagent = '".$subagent."', marketingcom = '".$marketingcom."',discount = '".$discount."' WHERE performa_price_range=".$rowperformastandart['performa_price_range']." AND tour_package = ".$row_tour['id'];
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


}


$con->close();


?>