<?php
include "../site.php";
include "../db=connection.php";
session_start();
$tempcek = 0;
$stamp 	= date("Y-m-d");

$airlines= $_POST['airlines'];
$tour_name= $_POST['tour_name'];
$flight_type= $_POST['flight_type'];
$flight_category = $_POST['flight_category'];
$pnr= $_POST['pnr'];
$adm_penalty= $_POST['adm_penalty'];
$adt_pax= $_POST['adt_pax'];
$chd_pax= $_POST['chd_pax'];
$inf_pax= $_POST['inf_pax'];
$kurs_price= $_POST['kurs_price'];
$kurs_tax= $_POST['kurs_tax'];
$adt_price= $_POST['adt_price'];
$chd_price= $_POST['chd_price'];
$inf_price= $_POST['inf_price'];
$selling_adt_price= $_POST['selling_adt_price'];
$selling_chd_price= $_POST['selling_chd_price'];
$selling_inf_price= $_POST['selling_inf_price'];
$tax_adt_price= $_POST['tax_adt_price'];
$tax_chd_price= $_POST['tax_chd_price'];
$tax_inf_price= $_POST['tax_inf_price'];
$status_penalty= $_POST['status_penalty'];
$penalty_pax= $_POST['penalty_pax'];
$deposit_pax_amount= $_POST['deposit_pax_amount'];
$deposit_total_pax= $_POST['deposit_total_pax'];
$total_seat= $_POST['total_seat'];
$tdate= $_POST['tdate'];
$tdate2= $_POST['tdate2'];
$tdate3= $_POST['tdate3'];
$destination_fromx = $_POST['destination_fromx'];
$destination_tox = $_POST['destination_tox'];
$destination_fromx = str_replace("'","",$destination_fromx);
$destination_tox = str_replace("'","",$destination_tox);

$sql = "INSERT INTO flight VALUES('',".$airlines.",'".$tour_name."','".$pnr."',".$adt_pax.",".$chd_pax.",".$inf_pax.",'".$kurs_price."','".$adt_price."','".$chd_price."','".$inf_price."','".$selling_adt_price."','".$selling_chd_price."','".$selling_inf_price."','".$kurs_tax."','".$tax_adt_price."','".$tax_chd_price."','".$tax_inf_price."','".$destination_fromx."','".$destination_tox."',0,0,".$adm_penalty.",'".$flight_type."','".$flight_category."',".$status_penalty.",".$penalty_pax.",".$deposit_pax_amount.",".$deposit_total_pax.",".$total_seat.",'".$tdate."','".$tdate2."','".$tdate3."','','',0,0,".$_SESSION['staff_id'].",0,0,'".$stamp."')";

if (mysqli_query($con, $sql)) {
	$tempcek = 0;

} else {
	$tempcek = 1;
	echo "Error: " . $sql . "" . mysqli_error($con);
}
	

if($tempcek==0){

	$query_detail = "SELECT * FROM flight ORDER BY id DESC LIMIT 1";
	$rs_detail=mysqli_query($con,$query_detail);
	$row_detail = mysqli_fetch_array($rs_detail);

	$type= $_POST['type'];

	if($type==0){
		$flightInvoice = $_POST['flightInvoice'];
		$countDetail = $_POST['countDetail'];
		$quotationID = $_POST['quotationID'];

		$query_flightquotation = "SELECT * FROM flight_quotation_detail WHERE flight_quotation_id=".$quotationID;
		$rs_flightquotation=mysqli_query($con,$query_flightquotation);
		$counQuotation = 0;
		while($row_flightquotation = mysqli_fetch_array($rs_flightquotation)){

			$dateQuotationText = "dateQuotation".$counQuotation;
			$dateQuotation = $_POST[$dateQuotationText];
			$sql2 = "INSERT INTO flight_detail VALUES('',".$row_detail['id'].",'".$row_flightquotation['airlines']."','".$row_flightquotation['airlines_code']."','".$dateQuotation."','".$row_flightquotation['froms']."','".$row_flightquotation['tos']."','".$row_flightquotation['destination_from']."','".$row_flightquotation['destination_to']."','".$row_flightquotation['departure_time']."','".$row_flightquotation['arrival_time']."',".$row_flightquotation['type'].",'".$stamp."')";

			if (mysqli_query($con, $sql2)) {
				$tempcek = 0;

			} else {
				$tempcek = 1;
			}
			 $counQuotation = $counQuotation + 1;
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

		$sql2 = "INSERT INTO flight_detail VALUES('',".$row_detail['id'].",'".$airlines_pil."','".$airlines_code."','".$flight_date."','".$from."','".$to."','".$destination_from."','".$destination_to."','".$departure_time."','".$arrival_time."',1,'".$stamp."')";

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

		$sql2 = "INSERT INTO flight_detail VALUES('',".$row_detail['id'].",'".$airlines_pil."','".$airlines_code."','".$flight_date."','".$from."','".$to."','".$destination_from."','".$destination_to."','".$departure_time."','".$arrival_time."','".$stamp."')";

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

				$sql2 = "INSERT INTO flight_detail VALUES('',".$row_detail['id'].",'".$airlines_pil."','".$airlines_code."','".$flight_date."','".$from."','".$to."','".$destination_from1."','".$destination_to1."','".$departure_time."','".$arrival_time."',".$transit_type.",'".$stamp."')";

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

			$sql2 = "INSERT INTO flight_detail VALUES('',".$row_detail['id'].",'".$airlines_pil2."','".$airlines_code2."','".$flight_date2."','".$from2."','".$to2."','".$destination_from2."','".$destination_to2."','".$departure_time2."','".$arrival_time2."','".$stamp."')";

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

				$sql2 = "INSERT INTO flight_detail VALUES('',".$row_detail['id'].",'".$airlines_pil."','".$airlines_code."','".$flight_date."','".$from."','".$to."','".$destination_from2."','".$destination_to2."','".$departure_time."','".$arrival_time."',".$transit_type.",'".$stamp."')";

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