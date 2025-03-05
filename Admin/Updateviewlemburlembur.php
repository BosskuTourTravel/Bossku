<?php
include "../site.php";
include "../db=connection.php";

$date = date("Y-m-d H:i:s");
$id = $_POST['id'];
$lp = $_POST['lp'];
$staff = $_POST['staff'];
$place = $_POST['place'];
$mulai = $_POST['mulai'];
$end = $_POST['end'];
$type= $_POST['type'];

$diff  = round((strtotime($end) - strtotime($mulai))/3600, 1);
if ($type == "B") {
$selisih = round((strtotime($mulai) - strtotime('12:00:00'))/3600, 1);
		if ($selisih > 0 ){
				$lembur=$diff * $lp;
		}else{
			$lembur=($diff - 0.5) * $lp;
		}
} else{
$lembur=($diff - 8.5) * $lp;
}
var_dump($mulai);
$sql = "UPDATE lembur SET staff='".$staff."', place='".$place."', mulai='".$mulai."', end='".$end"', WHERE id_lembur=".$id;
//$sql = "INSERT INTO lembur VALUES ('','".$date."','".$staff."','".$place."','".$mulai."','".$end."','".$diff."','".$lembur."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();
?>