<?php
include "../site.php";
include "../db=connection.php";
session_start();

$id = $_POST['id'];
$link = $_POST['link'];
$summer = $_POST['summer'];
$winter = $_POST['winter'];
$autumn = $_POST['autumn'];
$vid = $_POST['vid'];
$tgl = date("Y-m-d");
$tgl2 = date("Y-m-d H:i:s");

$query_img = "SELECT * FROM List_tempat_img where tmp_id=" . $id;
$rs_img = mysqli_query($con, $query_img);
$row_img = mysqli_fetch_array($rs_img);

if ($row_img['id'] == "") {
	$sql = "INSERT INTO List_tempat_img VALUES ('','" . $tgl . "','" . $id . "','" . $link . "','".$summer."','".$winter."','".$autumn."','".$vid."','" . $_SESSION['staff_id'] . "')";
	if (mysqli_query($con, $sql)) {
		// echo "success";
		$sql3 = "INSERT INTO staff_action_records VALUES ('','" . $tgl2 . "','".$_SESSION['staff_id']."','INSERT','14')";
		if (mysqli_query($con, $sql3)) {
			echo "success";
		} else {
			echo "Error: " . $sql3 . "" . mysqli_error($con);
		}

	} else {
		echo "Error: " . $sql3 . "" . mysqli_error($con);
	}
} else {
	$sql2 = "UPDATE List_tempat_img SET link='" . $link . "',summer_img='".$summer."',winter_img='".$winter."',autumn_img='".$autumn."', vid='".$vid."' where id=" . $row_img['id'];
	// var_dump($sql);
	if (mysqli_query($con, $sql2)) {
		$sql4 = "INSERT INTO staff_action_records VALUES ('','" . $tgl2 . "','".$_SESSION['staff_id']."','UPDATE','14')";
		if (mysqli_query($con, $sql4)) {
			echo "success";
		} else {
			echo "Error: " . $sql4 . "" . mysqli_error($con);
		}
	} else {
		echo "Error: " . $sql2 . "" . mysqli_error($con);
	}
}
$con->close();
