<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$cek = 0;

$sqlday = "DELETE FROM date_package WHERE tourpackage=".$id;
if ($con->query($sqlday) === TRUE) {
	$cek = 0;
} else {
	$cek = 1;
}

if($cek==0){
	$queryprice = "SELECT * FROM tour_price_package WHERE tour_package=".$id;
	$rsprice=mysqli_query($con,$queryprice);
	while($rowprice = mysqli_fetch_array($rsprice)){
		$sqlpricedetail = "DELETE FROM tour_price_detail WHERE tour_price_package=".$rowprice['id'];
		if ($con->query($sqlpricedetail) === TRUE) {
			$cek = 0;
		} else {
			$cek = 1;
		}
	}

}

if($cek==0){
	$sqlprice = "DELETE FROM tour_price_package WHERE tour_package=".$id;
	if ($con->query($sqlprice) === TRUE) {
		$cek = 0;
	} else {
		$cek = 1;
	}
}

if($cek==0){
	$sqlitinerary = "DELETE FROM itinerary WHERE tour_package=".$id;
	if ($con->query($sqlitinerary) === TRUE) {
		$cek = 0;
	} else {
		$cek = 1;
	}
}

if($cek==0){
	$sqlinclusion = "DELETE FROM inclusion WHERE tour_package=".$id;
	if ($con->query($sqlinclusion) === TRUE) {
		$cek = 0;
	} else {
		$cek = 1;
	}
}

if($cek==0){
	$sqlexclusion = "DELETE FROM exclusion WHERE tour_package=".$id;
	if ($con->query($sqlexclusion) === TRUE) {
		$cek = 0;
	} else {
		$cek = 1;
	}
}

if($cek==0){
	$sqlremarks = "DELETE FROM remark WHERE tour_package=".$id;
	if ($con->query($sqlremarks) === TRUE) {
		$cek = 0;
	} else {
		$cek = 1;
	}
}

if($cek==0){
	$sqlterms = "DELETE FROM termsandconditions WHERE tour_package=".$id;
	if ($con->query($sqlterms) === TRUE) {
		$cek = 0;
	} else {
		$cek = 1;
	}
}

if($cek==0){
	$sqlperforma = "DELETE FROM performa_price WHERE tour_package=".$id;
	if ($con->query($sqlperforma) === TRUE) {
		$cek = 0;
	} else {
		$cek = 1;
	}
}

if($cek==0){
	$query = "SELECT * FROM tour_package WHERE id=".$id;
	$rs=mysqli_query($con,$query);
	$row = mysqli_fetch_array($rs);

	$img = $row['img'];
	$img_head = $row['img_head'];

	$sql = "DELETE FROM tour_package WHERE id=".$id;
	$sql2 = "UPDATE agent_files SET status = 0 WHERE id=".$row['tour_files'];
	if ($con->query($sql) === TRUE AND $con->query($sql2) === TRUE) {
		if($img!=''){
			unlink("../".$img);
		}
		if($img_head!=''){
			unlink("../".$img_head);
		}
	    echo "success";
	} else {
	    echo "error";
	}
}

$con->close();


?>