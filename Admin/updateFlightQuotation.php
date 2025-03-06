<?php
include "../site.php";
include "../db=connection.php";
session_start();
$tempcek = 0;
$stamp 	= date("Y-m-d");

$id= $_POST['id'];
$airlines= $_POST['airlines'];
$type_price= $_POST['type_price'];
$adt_price= $_POST['adt_price'];
$chd_price= $_POST['chd_price'];
$inf_price= $_POST['inf_price'];
$tax_adt_price= $_POST['tax_adt_price'];
$tax_chd_price= $_POST['tax_chd_price'];
$tax_inf_price= $_POST['tax_inf_price'];
$kurs_price= $_POST['kurs_price'];
$kurs_tax= $_POST['kurs_tax'];
$tax= $_POST['tax'];
$from_fix= $_POST['from_fix'];
$to_fix= $_POST['to_fix'];
$out_fix= $_POST['out_fix'];
$flight_type = $_POST['flight_type'];
$flight_category = $_POST['flight_category'];
$country_to = $_POST['country_to'];
$city_from = $_POST['city_from'];
$city_to = $_POST['city_to'];
$city_out = $_POST['city_out'];
$total_seat = $_POST['total_seat'];
$total_foc = $_POST['total_foc'];
$tax_foc = $_POST['tax_foc'];
$remarks = $_POST['remarks'];

// $ct1 = $_POST['ct1'];
// $ct2 = $_POST['ct2'];
// $ct3 = $_POST['ct3'];
// $ct4 = $_POST['ct4'];
// $ct5 = $_POST['ct5'];
// $ct6 = $_POST['ct6'];
$itinerary_category_arrival = $_POST['itinerary_category_arrival'];
$itinerary_category_departure = $_POST['itinerary_category_departure'];

$sql = "UPDATE flight_quotation SET airlines_id = ".$airlines.",destination_from = '".$from_fix."',destination_to = '".$to_fix."', destination_out = '".$out_fix."', type = '".$type_price."', kurs_price = '".$kurs_price."' , adt_price = '".$adt_price."', chd_price = '".$chd_price."', inf_price = '".$inf_price."', kurs_tax = '".$kurs_tax."' , adt_tax = '".$tax_adt_price."', chd_tax = '".$tax_chd_price."', inf_tax = '".$tax_inf_price."', flight_type='".$flight_type."', flight_category='".$flight_category."',country_to=".$country_to.",city_from =".$city_from.", city_to = ".$city_to.", city_out=".$city_out.",total_seat=".$total_seat.",total_foc=".$total_foc.",tax_foc=".$tax_foc.", itinerary_category_arrival=".$itinerary_category_arrival.", itinerary_category_departure=".$itinerary_category_departure.",remarks = '".$remarks."', stamp_update = '".$stamp."' WHERE id=".$id;


if (mysqli_query($con, $sql)) {
	$tempcek = 0;

} else {
	$tempcek = 1;
	echo "Error: " . $sql . "" . mysqli_error($con);
}
	

if($tempcek==0){

	// $query_detail = "SELECT * FROM flight_quotation ORDER BY id DESC LIMIT 1";
	// $rs_detail=mysqli_query($con,$query_detail);
	// $row_detail = mysqli_fetch_array($rs_detail);

	// for ($i = 0; $i < 2; $i++) {
	// 	for ($j = 1; $j <= 12; $j++) {
	// 		$txtdate = "date".$i.$j;
	// 		$date = $_POST[$txtdate];

	// 		if($date!=''){
	// 			$sql2 = "INSERT INTO flight_quotation_date VALUES('',".$row_detail['id'].",'".$date."')";

	// 			if (mysqli_query($con, $sql2)) {
	// 				$tempcek = 0;

	// 			} else {
	// 				$tempcek = 1;
	// 			}
	// 		}
	// 	}
	// }

	$query_detail = "SELECT * FROM flight_quotation ORDER BY id DESC LIMIT 1";
	$rs_detail=mysqli_query($con,$query_detail);
	$row_detail = mysqli_fetch_array($rs_detail);

	$type= $_POST['type'];

	if($type==0){
		$tempQuotationDetail = json_decode(stripslashes($_POST['tempQuotationDetail']));
		for ($x = 0; $x < count($tempQuotationDetail); $x++) {
			$txtID = 'tid_detail' . $tempQuotationDetail[$x];
			$txtFlightDate = 'flight_date' . $tempQuotationDetail[$x];
			$txtAirlinesPil = 'airlines_pil' . $tempQuotationDetail[$x];
			$txtAirlinesCode = 'airlines_code' . $tempQuotationDetail[$x];
			$txtFrom = 'from' . $tempQuotationDetail[$x];
			$txtTo = 'to' . $tempQuotationDetail[$x];
			$txtDestinationFrom = 'destination_from' . $tempQuotationDetail[$x];
			$txtDestinationTo = 'destination_to' . $tempQuotationDetail[$x];
			$txtDepartureTime = 'departure_time' . $tempQuotationDetail[$x];
			$txtArrivalTime = 'arrival_time' . $tempQuotationDetail[$x];
			$id_detail = $_POST[$txtID];
			$flight_date = $_POST[$txtFlightDateF];
			$airlines_pil = $_POST[$txtAirlinesPil];
			$airlines_code = $_POST[$txtAirlinesCode];
			$from = $_POST[$txtFrom];
			$to = $_POST[$txtTo];
			$destination_from = $_POST[$txtDestinationFrom];
			$destination_to = $_POST[$txtDestinationTo];
			$departure_time = $_POST[$txtDepartureTime];
			$arrival_time = $_POST[$txtArrivalTime];

			$destination_from = str_replace("'","",$destination_from);
			$destination_to = str_replace("'","",$destination_to);
			$sql2 = "UPDATE flight_quotation_detail SET airlines = '".$airlines_pil."', airlines_code = '".$airlines_code."',flight_date = '".$flight_date."',froms = '".$from."', tos = '".$to."', destination_from = '".$destination_from."', destination_to = '".$destination_to."', departure_time = '".$departure_time."', arrival_time = '".$arrival_time."' WHERE id=".$id_detail;
	
			if (mysqli_query($con, $sql2)) {
				$tempcek = 0;

			} else {
				$tempcek = 1;
			}
		}

	}elseif($type==2){
		$flight_date = $_POST['flight_date'];
		$airlines_pil = $_POST['airlines_pil'];
		$airlines_code = $_POST['airlines_code'];
		$from = $_POST['from'];
		$to = $_POST['to'];
		$destination_from = $_POST['destination_from'];
		$destination_to = $_POST['destination_to'];
		$departure_time = $_POST['departure_time'];
		$arrival_time = $_POST['arrival_time'];

		$destination_from = str_replace("'","",$destination_from);
		$destination_to = str_replace("'","",$destination_to);

		$sql2 = "INSERT INTO flight_quotation_detail VALUES('',".$id.",'".$airlines_pil."','".$airlines_code."','".$flight_date."','".$from."','".$to."','".$destination_from."','".$destination_to."','".$departure_time."','".$arrival_time."','".$stamp."')";

		if (mysqli_query($con, $sql2)) {
			$tempcek = 0;

		} else {
			$tempcek = 1;
		}
	}else{

		$counttb = $_POST['counttb'];
		$counttp = $_POST['counttp'];

		$flight_date = $_POST['flight_date'];
		$airlines_pil = $_POST['airlines_pil'];
		$airlines_code = $_POST['airlines_code'];
		$from = $_POST['from'];
		$to = $_POST['to'];
		$destination_from = $_POST['destination_from'];
		$destination_to = $_POST['destination_to'];
		$departure_time = $_POST['departure_time'];
		$arrival_time = $_POST['arrival_time'];

		$destination_from = str_replace("'","",$destination_from);
		$destination_to = str_replace("'","",$destination_to);
		$sql2 = "INSERT INTO flight_quotation_detail VALUES('',".$id.",'".$airlines_pil."','".$airlines_code."','".$flight_date."','".$from."','".$to."','".$destination_from."','".$destination_to."','".$departure_time."','".$arrival_time."',1,'".$stamp."')";

		if (mysqli_query($con, $sql2)) {


			for ($x = 0; $x < $counttb; $x++) {
				$flight_date = $_POST['flight_date1'.$x];
				$airlines_pil = $_POST['airlines_pil1'.$x];
				$airlines_code = $_POST['airlines_code1'.$x];
				$from = $_POST['from1'.$x];
				$to = $_POST['to1'.$x];
				$destination_from1 = $_POST['destination_from1'.$x];
				$destination_to1 = $_POST['destination_to1'.$x];
				$departure_time = $_POST['departure_time1'.$x];
				$arrival_time = $_POST['arrival_time1'.$x];
				$transit_type = $_POST['transit_type1'.$x];
				$destination_from1 = str_replace("'","",$destination_from1);
				$destination_to1 = str_replace("'","",$destination_to1);

				$sql2 = "INSERT INTO flight_quotation_detail VALUES('',".$id.",'".$airlines_pil."','".$airlines_code."','".$flight_date."','".$from."','".$to."','".$destination_from1."','".$destination_to1."','".$departure_time."','".$arrival_time."',".$transit_type.",'".$stamp."')";

				if (mysqli_query($con, $sql2)) {
					$tempcek = 0;
				} else {
					$tempcek = 1;
				}


			}
			

			$flight_date2 = $_POST['flight_date2'];
			$airlines_pil2 = $_POST['airlines_pil2'];
			$airlines_code2 = $_POST['airlines_code2'];
			$from2 = $_POST['from2'];
			$to2 = $_POST['to2'];
			$destination_from2 = $_POST['destination_from2'];
			$destination_to2 = $_POST['destination_to2'];
			$departure_time2 = $_POST['departure_time2'];
			$arrival_time2 = $_POST['arrival_time2'];

			$destination_from2 = str_replace("'","",$destination_from2);
			$destination_to2 = str_replace("'","",$destination_to2);

			$sql2 = "INSERT INTO flight_quotation_detail VALUES('',".$id.",'".$airlines_pil2."','".$airlines_code2."','".$flight_date2."','".$from2."','".$to2."','".$destination_from2."','".$destination_to2."','".$departure_time2."','".$arrival_time2."',2,'".$stamp."')";

			if (mysqli_query($con, $sql2)) {
				$tempcek = 0;

			} else {
				$tempcek = 1;
			}

			for ($x = 0; $x < $counttp; $x++) {
				$flight_date = $_POST['flight_date2'.$x];
				$airlines_pil = $_POST['airlines_pil2'.$x];
				$airlines_code = $_POST['airlines_code2'.$x];
				$from = $_POST['from2'.$x];
				$to = $_POST['to2'.$x];
				$destination_from2 = $_POST['destination_from2'.$x];
				$destination_to2 = $_POST['destination_to2'.$x];
				$departure_time = $_POST['departure_time2'.$x];
				$arrival_time = $_POST['arrival_time2'.$x];
				$transit_type = $_POST['transit_type2'.$x];
				$destination_from2 = str_replace("'","",$destination_from2);
				$destination_to2 = str_replace("'","",$destination_to2);

				$sql2 = "INSERT INTO flight_quotation_detail VALUES('',".$id.",'".$airlines_pil."','".$airlines_code."','".$flight_date."','".$from."','".$to."','".$destination_from2."','".$destination_to2."','".$departure_time."','".$arrival_time."',".$transit_type.",'".$stamp."')";

				if (mysqli_query($con, $sql2)) {
					$tempcek = 0;

				} else {
					$tempcek = 1;
				}


			}


			


			

		} else {
			$tempcek = 1;
		}



	}
	
	
}else{
	echo "Error: " . $sql . "" . mysqli_error($con);
}

if($tempcek==0){
	echo "success";
}else{
	echo "Error: " . $sql . "" . mysqli_error($con);
	echo "Error: " . $sql2 . "" . mysqli_error($con);
}


$con->close();






?>