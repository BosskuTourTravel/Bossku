<?php
include "../site.php";
include "../db=connection.php";

$id = array();
$id = json_decode(stripslashes($_POST['tempID']));
$tempCek = 0;

if($_POST['pil']==1){
	$string = 'tour_leader_freeland_batam';
}elseif($_POST['pil']==2){
	$string = 'tour_leader_staff_batam';
}elseif($_POST['pil']==3){
	$string = 'tour_leader_freeland_surabaya';
}else{
	$string = 'tour_leader_staff_surabaya';
}

for ($x = 0; $x < count($id); $x++) {

	$txtfee_lowseason = "fee_lowseason".$id[$x];
	$txtfee_highseason = "fee_highseason".$id[$x];
	$txtmeal = "meal".$id[$x];
	$txtvoucher = "voucher".$id[$x];
	$txtkurs = "kurs".$id[$x];

	$fee_lowseason = $_POST[$txtfee_lowseason];
	$fee_highseason = $_POST[$txtfee_highseason];
	$meal = $_POST[$txtmeal];
	$voucher = $_POST[$txtvoucher];
	$kurs = $_POST[$txtkurs];

	$sql = "UPDATE ".$string." SET kurs=".$kurs.", fee_low_season=".$fee_lowseason.", fee_high_season=".$fee_highseason.", meal=".$meal.", voucher_hp=".$voucher." WHERE id=".$id[$x];
	// echo $sql."</br>";
	if (mysqli_query($con, $sql)) {
	  $tempCek = 0;

	} else {
	  echo "Error: " . $sql . "" . mysqli_error($con);
	  header("location:https://www.2canholiday.com/Admin/#");
	}

}

if($tempCek==0){
	echo "Success";
}


$con->close();
    



?>