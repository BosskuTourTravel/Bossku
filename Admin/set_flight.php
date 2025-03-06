<?php
include "../site.php";
include "../db=connection.php";
session_start();
$date = date("Y-m-d");

$columnHeader = '';
$columnHeader = "ID"."\t"."City in" . "\t" . "city out" . "\t" . "Musim" . "\t" . "Type1" . "\t" . "type2" . "\t" . "Id_grub" . "\t" . "Maskapai" . "\t" . "Dept-Arr" . "\t" . "Maskapai2" . "\t" . "Etd" . "\t" . "Eta"."\t"."Hari"."\t"."Transit"."\t"."Adt"."\t"."Chd"."\t"."Inf";
$setData = '';

$query = "SELECT * FROM flight_LTnew order by id ASC";
$rs = mysqli_query($con, $query);
$hari = '';
while ($row = mysqli_fetch_array($rs)) {
	$day = date('D', strtotime($row['tgl']));
	switch ($day) {
		case "Sun":
			$hari = 7;
			break;
		case "Mon":
			$hari = 1;
			break;
		case "Tue":
			$hari = 2;
			break;
		case "Wed":
			$hari = 3;
			break;
		case "Thu":
			$hari = 4;
			break;
		case "Fri":
			$hari = 5;
			break;
		case "Sat":
			$hari = 6;
			break;
		default:
			$hari = 7;
	}
	// echo $hari . "</br>";
	$query_itin = "SELECT * FROM LT_itinnew where kode ='" . $row['tour_code'] . "' order by id limit 1";
	$rs_itin = mysqli_query($con, $query_itin);
	$row_itin = mysqli_fetch_array($rs_itin);
	$type = "";
	if ($row_itin['id'] != "") {
		if ($row['type'] == "ONE WAY") {
			$type = "One Way Direct";
		} else if ($row['type'] == "RETURN") {
			$type = "One Way Connecting";
		} else if ($row['type'] == "MULTI") {
			$type = "Round Trip Connecting";
		} else {
		}
		$dep_arr = $row['dept'] . "-" . $row['arr'];
		$kota = substr($row['rute'], 3);
		$city_in = "";
		if ($kota == "bth") {
			$city_in = "Singapore";
		} else if ($kota == "cgk") {
			$city_in = "Singapore";
		} else if ($kota == "dps") {
			$city_in = "Denpasar";
		} else {
			$city_in = "Surabaya";
		}

		$value = $row['id']."\t".$city_in . " \t" . $row_itin['city_in'] . " \t" . "all" . " \t" . $type . " \t" . " " . " \t" . " " . " \t" ." ". " \t" . $dep_arr . " \t" . $row['maskapai'] . " \t" . $row['take'] . " \t" . $row['landing']."\t".$hari."\t"." "."\t".$row['adt']."\t".$row['chd']."\t".$row['inf'];
		$setData .= trim($value) . "\n";
	}
}
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=List_Flg_" . $date . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo ucwords($columnHeader) . "\n" . $setData . "\n";
