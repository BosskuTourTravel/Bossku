<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$cek = 0;

$sql = "DELETE FROM tour_price_package WHERE id=".$id;
$sqlpricedetail = "DELETE FROM tour_price_detail WHERE tour_price_package=".$id;
if ($con->query($sqlpricedetail) === TRUE) {
	$cek = 0;
} else {
	$cek = 1;
}

if($cek==0){
	if ($con->query($sql) === TRUE) {
	    echo "success";
	} else {
	    echo "error";
	}
}

$con->close();


?>