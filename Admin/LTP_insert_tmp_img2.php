<?php
include "../site.php";
include "../db=connection.php";
session_start();

$link = "";
$summer = "";
$winter = "";
$autumn = "";

$id = $_POST['id'];
$link_val = $_POST['link'];
$tmp_type = $_POST['tmp_type'];

$tgl = date("Y-m-d");
$tgl2 = date("Y-m-d H:i:s");

$query_img2 = "SELECT selected_img_tmp.id,selected_img_tmp.tmp,selected_img_tmp.tmp_type,List_tempat_img.link,List_tempat_img.summer_img,List_tempat_img.winter_img,List_tempat_img.autumn_img FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id WHERE selected_img_tmp.id ='" . $id . "'";
$rs_img2 = mysqli_query($con, $query_img2);
$row_img2 = mysqli_fetch_array($rs_img2);

if ($row_img2['tmp_type'] == "link") {
	$link = $link_val;
} else if ($row_img2['tmp_type'] == "summer_img") {
	$summer = $link_val;
} else if ($row_img2['tmp_type'] == "winter_img") {
	$winter = $link_val;
} else if ($row_img2['tmp_type'] == "autumn_img") {
	$autumn = $link_val;
}

$query_img = "SELECT * FROM List_tempat_img where tmp_id=" . $row_img2['tmp'];
$rs_img = mysqli_query($con, $query_img);
$row_img = mysqli_fetch_array($rs_img);

if ($row_img['id'] == "") {
	$sql = "INSERT INTO List_tempat_img VALUES ('','" . $tgl . "','" .$row_img2['tmp']. "','" . $link . "','" . $summer . "','" . $winter . "','" . $autumn . "','','" . $_SESSION['staff_id'] . "')";
	if (mysqli_query($con, $sql)) {
		// echo "success";
		$sql3 = "INSERT INTO staff_action_records VALUES ('','" . $tgl2 . "','" . $_SESSION['staff_id'] . "','INSERT','14')";
		if (mysqli_query($con, $sql3)) {
			echo "success Input";
		} else {
			echo "Error: " . $sql3 . "" . mysqli_error($con);
		}
	} else {
		echo "Error: " . $sql3 . "" . mysqli_error($con);
	}
} else {
	$sql2 = "UPDATE List_tempat_img SET $tmp_type='" . $link_val . "' where id=" . $row_img['id'];
	// var_dump($sql);
	if (mysqli_query($con, $sql2)) {
		$sql4 = "INSERT INTO staff_action_records VALUES ('','" . $tgl2 . "','" . $_SESSION['staff_id'] . "','UPDATE','14')";
		if (mysqli_query($con, $sql4)) {
			echo "success Update";
		} else {
			echo "Error: " . $sql4 . "" . mysqli_error($con);
		}
	} else {
		echo "Error: " . $sql2 . "" . mysqli_error($con);
	}
}
$con->close();
