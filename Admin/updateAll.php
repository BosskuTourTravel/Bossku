<?php
include "../site.php";
include "../db=connection.php";


$id = $_POST['id'];
// $inclusion = $_POST['inclusion'];
// $exclusion = $_POST['exclusion'];
$title = $_POST['title'];
$remark = $_POST['remark'];
$term = $_POST['term'];

$tipping = $_POST['tipping'];
$tipping2 = $_POST['tipping2'];
$tipping3 = $_POST['tipping3'];
$tippingkurs = $_POST['kurs'];
$ferryname = $_POST['ferryname'];
$ferryprice = $_POST['ferry'];
$ferrykurs = $_POST['ferrykurs'];
$bulletname = $_POST['bulletname'];
$bulletprice = $_POST['bulletprice'];
$bulletkurs = $_POST['bulletkurs'];
$admissionname = $_POST['admissionname'];
$admissionprice = $_POST['admissionprice'];
$admissionkurs = $_POST['admissionkurs'];
$flightname = $_POST['flightname'];
$flightprice = $_POST['flightprice'];
$flightkurs = $_POST['flightkurs'];

$strvisa = $_POST['strvisa'];
$strbordercity = $_POST['strbordercity'];
$strborderkurs = $_POST['strborderkurs'];
$strborderprice = $_POST['strborderprice'];
$strguide = $_POST['strguide'];

$inclusion = json_decode(stripslashes($_POST['inclusion']));
$exclusion = json_decode(stripslashes($_POST['exclusion']));


$queryi = "SELECT COUNT(*) as total FROM inclusion_tourpackage WHERE tour_package=".$id;
$rsi=mysqli_query($con,$queryi);
$rowi=mysqli_fetch_assoc($rsi);

$querye = "SELECT COUNT(*) as total FROM exclusion_tourpackage WHERE tour_package=".$id;
$rse=mysqli_query($con,$querye);
$rowe=mysqli_fetch_assoc($rse);

$queryr = "SELECT COUNT(*) as total FROM remark WHERE tour_package=".$id;
$rsr=mysqli_query($con,$queryr);
$rowr=mysqli_fetch_assoc($rsr);

$queryt = "SELECT COUNT(*) as total FROM termsandconditions WHERE tour_package=".$id;
$rst=mysqli_query($con,$queryt);
$rowt=mysqli_fetch_assoc($rst);

$stamp 	= date("Y-m-d");

if($rowi['total']==0){
	for ($x = 0; $x < count($inclusion); $x++) {
		$sql = "INSERT INTO inclusion_tourpackage VALUES ('',".$inclusion[$x].",".$id.",'".$stamp."')";
		if (mysqli_query($con, $sql)) {
			$tempCek = 0; 
		} else {
			$tempCek = 1; 
		}
	}
}else{
	$sql = "DELETE FROM inclusion_tourpackage WHERE tour_package=".$id;
	if (mysqli_query($con, $sql)) {
		$tempCek = 0; 
	} else {
		$tempCek = 1; 
	}
	for ($x = 0; $x < count($inclusion); $x++) {
		$sql = "INSERT INTO inclusion_tourpackage VALUES ('',".$inclusion[$x].",".$id.",'".$stamp."')";
		if (mysqli_query($con, $sql)) {
			$tempCek = 0; 
		} else {
			$tempCek = 1; 
		}
	}
}

if($rowe['total']==0){
	for ($x = 0; $x < count($exclusion); $x++) {
		$sql = "INSERT INTO exclusion_tourpackage VALUES ('',".$exclusion[$x].",".$id.",'".$stamp."')";
		if (mysqli_query($con, $sql)) {
			$tempCek = 0; 
		} else {
			$tempCek = 1; 
		}
		
	}
}else{
	$sql = "DELETE FROM exclusion_tourpackage WHERE tour_package=".$id;
	if (mysqli_query($con, $sql)) {
		$tempCek = 0; 
	} else {
		$tempCek = 1; 
	}

	for ($x = 0; $x < count($exclusion); $x++) {
		$sql = "INSERT INTO exclusion_tourpackage VALUES ('',".$exclusion[$x].",".$id.",'".$stamp."')";
		if (mysqli_query($con, $sql)) {
			$tempCek = 0; 
		} else {
			$tempCek = 1; 
		}
	}
}

if($rowr['total']==0){
	$sql3 = "INSERT INTO remark VALUES ('','".$title."','".$remark."',".$id.")";
}else{
	$sql3 = "UPDATE remark SET description='".$remark."' WHERE tour_package=".$id;
}

if($rowt['total']==0){
	$sql4 = "INSERT INTO termsandconditions VALUES ('','".$term."',".$id.")";
}else{
	$sql4 = "UPDATE termsandconditions SET name='".$term."' WHERE tour_package=".$id;
}

$querycheck = "SELECT COUNT(*) as total FROM exclusion_plus WHERE tour_package=".$id;
$rscheck=mysqli_query($con,$querycheck);
$rowcheck=mysqli_fetch_assoc($rscheck);
if($rowcheck['total']==0){
	$sql5 = "INSERT INTO exclusion_plus VALUES ('','".$bulletname."','".$bulletprice."',".$bulletkurs.",'".$admissionname."','".$admissionprice."',".$admissionkurs.",'".$flightname."','".$flightprice."',".$flightkurs.",'".$ferryname."','".$ferryprice."',".$ferrykurs.",".$tipping2.",".$tipping3.",".$tippingkurs.",".$id.")";
}else{
	$sql5 = "UPDATE exclusion_plus SET bullettrain_name='".$bulletname."',bullettrain_price='".$bulletprice."',bullettrain_kurs=".$bulletkurs.",admission_name='".$admissionname."',admission_price='".$admissionprice."',admission_kurs=".$admissionkurs.",flight_name='".$flightname."',flight_price='".$flightprice."',flight_kurs=".$flightkurs.",ferry_name='".$ferryname."',ferry_price='".$ferryprice."',ferry_kurs=".$ferrykurs.",tipping2=".$tipping2.",tipping3=".$tipping3.", kurs=".$tippingkurs." WHERE tour_package=".$id;
}
$tempCek = 0;
$sql6 = "UPDATE tour_package SET tipping=".$tipping.", kurs=".$tippingkurs." WHERE id=".$id;

$querycheck2 = "SELECT COUNT(*) as total FROM exclusion_tourpackage_plus WHERE tour_package=".$id;
$rscheck2=mysqli_query($con,$querycheck2);
$rowcheck2=mysqli_fetch_assoc($rscheck2);
if($rowcheck2['total']==0){
	$sql7 = "INSERT INTO exclusion_tourpackage_plus VALUES ('','".$strvisa."','".$strguide."','".$strbordercity."','".$strborderkurs."','".$strborderprice."',".$id.",'".$stamp."')";
}else{
	//$sql7 = "UPDATE exclusion_tourpackage_plus SET visa_id='".$strvisa."', guide_language='".$strguide."',border_city='".$strbordercity."',border_kurs'".$strborderkurs."',border_price='".$strborderprice."' WHERE tour_package=".$id;

	$query_exclusion_plus = "SELECT * FROM exclusion_tourpackage_plus WHERE tour_package=".$id;
	$rs_exclusion_plus=mysqli_query($con,$query_exclusion_plus);
	$row_exclusion_plus = mysqli_fetch_array($rs_exclusion_plus);
	$sql7 = "UPDATE exclusion_tourpackage_plus SET visa_id='".$row_exclusion_plus['visa_id']."'WHERE tour_package=".$id;
}

if (mysqli_query($con, $sql3) and mysqli_query($con, $sql4) and mysqli_query($con, $sql5) and mysqli_query($con, $sql6) and mysqli_query($con, $sql7)) {
	$tempCek = 0; 
} else {
	$tempCek  = 1;
}

if($tempCek == 0){
	$sqlDel = "DELETE from flight_domestic_tourpackage WHERE tour_package = ".$id;
	if (mysqli_query($con, $sqlDel)){
		$flightdomestic_count = $_POST['flightdomestic_count'];
		$kursDomestic = $_POST['kursDomestic'];
		if($flightdomestic_count > 0){
			for ($x = 0; $x < $flightdomestic_count; $x++) {
				$from = $_POST['from'.$x];
				$to = $_POST['to'.$x];
				$destination_from = $_POST['destination_from'.$x];
				$destination_to = $_POST['destination_to'.$x];
				$price = $_POST['price'.$x];
				$destination_from = str_replace("'","",$destination_from);
				$destination_to = str_replace("'","",$destination_to);
				$sql7 = "INSERT INTO flight_domestic_tourpackage VALUES ('',".$id.",'".$from."','".$to."','".$destination_from."','".$destination_to."',".$kursDomestic.",".$price.",'".$stamp."')";
		// echo $sql7."</br>";
				if (mysqli_query($con, $sql7)){
					$tempCek = 0; 
				}else{
					$tempCek  = 1;
				}
			}

			
		}
	}else{
		$tempCek  = 1;
	}

	
}



if ($tempCek == 0){
	echo "success";
}else{
	echo "Error: " . $sql . "" . mysqli_error($con);
	header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();



?>