<?php
include "../site.php";
include "../db=connection.php";
date_default_timezone_set('Asia/Jakarta');
$date = date("Y-m-d");
$end = date("H:i:s");
$lp = $_POST['lp'];
$lp2=5000;
$id = $_POST['id'];
$staff = $_POST['staff'];
$querylembur = "SELECT mulai FROM lembur WHERE staff=".$staff." AND tgl=".date("'Y-m-d'");
$rslembur=mysqli_query($con,$querylembur);
$rowlembur = mysqli_fetch_array($rslembur);
$mulai=$rowlembur['mulai'];
$type= $_POST['type'];
$date2=date("w");
$telat=date("H:i:s");
$rajin=date("H:i:s");
$jamin=date("09:00:00");
//var_dump($mulai);
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
        $selisih=$diff - 7.5;
        if($selisih > 0){ $over=$selisih;}
        else{$over=0;}
		$lembur=($diff - 7.5) * $lp;
		$lembur2=($diff - 7.5) * $lp2;
	}
	else if($date2=="0"){
		$queryminggu= "SELECT * FROM lembur_minggu WHERE nama=".$staff." AND tgl=".date("'Y-m-d'");
		$rsminggu=mysqli_query($con,$queryminggu);
		$rowminggu = mysqli_fetch_array($rsminggu);
		$minggu=$rowminggu['ganti'];
		if($minggu==1){
			$selisih=$diff - 8.5;
			if($selisih > 0){ $over=$selisih;}
			else{$over=0;}
			$selisih=$diff - 8.5;
			$lembur=($diff - 8.5) * $lp;
			$lembur2=($diff - 8.5) * $lp2;
		}else{
			$lembur=$diff * $lp;
			$lembur2=$diff * $lp2;
		}

	}
	else{
        $selisih=$diff - 8.5;
        if($selisih > 0){ $over=$selisih;}
        else{$over=0;}
        $selisih=$diff - 8.5;
		$lembur=($diff - 8.5) * $lp;
		$lembur2=($diff - 8.5) * $lp2;
	}
}
if ($lembur < 0 ){
	$lembur= $lembur * 0;
}
if ($lembur2 < 0 ){
	$lembur2= $lembur2 * 0;
}

var_dump($diff);
var_dump($selisih);
var_dump($over."over");
// var_dump($lembur);
//$over=$diff ;
$querylp = "SELECT * FROM lemburPrice WHERE nama=".$staff;
$rslp=mysqli_query($con,$querylp);
$rowlp = mysqli_fetch_array($rslp);
$thn=$rowlp['thn'];
if($thn =='1'){
	$sql3 = "UPDATE lembur2 SET end2='".$end."', durasi2='".$diff."', over2='".$over."' , total2='".$lembur2."' WHERE staff2=".$staff." AND date(tgl2)=".date("'Y-m-d'");
	mysqli_query($con, $sql3);
}else{echo "Anda belum mendapatkan lembur 2";}

$sql = "UPDATE lembur SET end='".$end."', durasi='".$diff."', over='".$over."' , total='".$lembur."' WHERE staff=".$staff." AND date(tgl)=".date("'Y-m-d'");
//echo $sql;
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
	}
	$con->close();
?>