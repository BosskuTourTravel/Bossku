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
$date2=date("w");
var_dump($date2);
$diff  = round((strtotime($end) - strtotime($mulai))/3600, 1);

if ($type == "B") {
$selisih = round((strtotime($mulai) - strtotime('12:00:00'))/3600, 1);
		if ($selisih > 0 ){
				$lembur=$diff * $lp;
		}else{
			$lembur=($diff - 0.5) * $lp;
		}
} 
else{
	if ($date2=="6"){
		$lembur=($diff - 7.5) * $lp;
	}
	else if ($date2=="0"){
		$lembur=($diff - 8.0) * $lp;
	}
	
	else{
		$lembur=($diff - 8.5) * $lp;
	}
}
if ($lembur < 0){
	$lembur= $lembur * 0;
}
var_dump($lembur);
var_dump($diff);
$sql = "INSERT INTO lembur VALUES ('','".$date."','".$staff."','".$place."','".$mulai."','".$end."','".$diff."','".$lembur."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();
?>