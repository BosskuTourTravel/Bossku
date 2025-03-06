<?php
include "../site.php";
include "../db=connection.php";
session_start();
$date = date("Y-m-d");
$berhasil = 0;
$gagal = 0;
if ($_POST['profit'] != "") {
	if ($_POST['status'] == '1') {
		foreach ($_POST['data'] as $value) {
			$sql_profit = "SELECT * FROM PR_flight where flight_id ='" . $value . "'";
			$rs_profit = mysqli_query($con, $sql_profit);
			$row_profit = mysqli_fetch_array($rs_profit);

			if ($row_profit['id'] == "") {
				$sql = "INSERT INTO PR_flight VALUES ('','$date','$value','" . $_POST['profit'] . "','')";
				if (mysqli_query($con, $sql)) {
					$berhasil++;
				} else {
					$gagal++;
				}
			} else {
				$sql2 = "UPDATE  PR_flight SET profit='" . $_POST['profit'] . "'  WHERE flight_id=" . $value;
				if (mysqli_query($con, $sql2)) {
					$berhasil++;
				} else {
					$gagal++;
				}
			}
		}
	} else if($_POST['status'] == '2') {
	
		$query = "SELECT * FROM  flight_LTnew order by id ASC ";
		$rs = mysqli_query($con, $query);
		while ($row = mysqli_fetch_array($rs)) {
			$sql_profit = "SELECT * FROM PR_flight where flight_id ='" . $row['id'] . "'";
			$rs_profit = mysqli_query($con, $sql_profit);
			$row_profit = mysqli_fetch_array($rs_profit);

		

			if ($row_profit['id'] == "") {
				$sql = "INSERT INTO PR_flight VALUES ('','$date','".$row['id']."','" . $_POST['profit'] . "','')";
				// var_dump($sql);
				if (mysqli_query($con, $sql)) {
					$berhasil++;
				} else {
					$gagal++;
				}
			} else {
				$sql2 = "UPDATE  PR_flight SET profit='" . $_POST['profit'] . "'  WHERE flight_id=" . $row['id'];
				if (mysqli_query($con, $sql2)) {
					$berhasil++;
				} else {
					$gagal++;
				}
			}
		}
	}else{

	}

	$con->close();
}
echo "success" . " , Data berhasil : " . $berhasil . " , Data Gagal : " . $gagal;
