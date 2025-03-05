<?php
include "../site.php";
include "../db=connection.php";

$query_cek = "SELECT * FROM tour_node where copy_id='" . $_POST['tour_id'] . "' && master_id='" . $_POST['master_id'] . "'";
$rs_cek = mysqli_query($con, $query_cek);
$row_cek = mysqli_fetch_array($rs_cek);


if ($row_cek['id'] != "") {
	$sql = "UPDATE tour_node SET note='" . $_POST['note'] . "' WHERE id=" .$row_cek['id'];
	if (mysqli_query($con, $sql)) {
		echo "success updated";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
	}
} else {
	if($_POST['note'] !=""){
		$sql2 = "INSERT INTO tour_node VALUES ('','" . $_POST['master_id'] . "','" . $_POST['tour_id'] . "','" . $_POST['note'] . "')";
		if (mysqli_query($con, $sql2)) {
			echo "success inserted";
		} else {
			echo "Error: " . $sql2 . "" . mysqli_error($con);
		}
	}

}
$con->close();
