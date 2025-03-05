<?php
include "../db=connection.php";
?>
<?php
if ($_POST['key'] != "") {

	$query_cit = "SELECT * FROM city where name ='" . $_POST['key'] . "'";
	$rs_cit = mysqli_query($con, $query_cit);
	$row_cit = mysqli_fetch_array($rs_cit);
	if ($row_cit['id'] != "") {
		$query_cou = "SELECT * FROM country where id=" . $row_cit['country'];
		$rs_cou = mysqli_query($con, $query_cou);
		$row_cou = mysqli_fetch_array($rs_cou);
		if ($row_cou['id'] != "") {
			$query_con = "SELECT * FROM continent where id=" . $row_cou['continent'];
			$rs_con = mysqli_query($con, $query_con);
			$row_con = mysqli_fetch_array($rs_con);
		}
	}
	echo json_encode(array("con" => $row_con['name'], "cou" => $row_cou['name'], "cit" => $row_cit['name']));
} else {
	echo json_encode(array("con" => "", "cou" => "", "cit" => ""));
}
?>
