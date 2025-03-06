<?php
include "../site.php";
include "../db=connection.php";

$a1= $_POST['a1'];
$a2= $_POST['a2'];
$a3= $_POST['a3'];
$a4= $_POST['a4'];
$a5= $_POST['a5'];
$a6= $_POST['a6'];
$tpax= $_POST['tpax'];
$total= $_POST['bb'];
$kurs=$_POST['cc'];
$ket=$_POST['ket'];
$gn=$_POST['gn'];
$tlp=$_POST['tlp'];
$total_gt=explode(";", $_POST['total_gt']);
$tour = explode(";", $_POST['dl']);
//var_dump($tour);
$data_a1=explode(",", $a1);
$data2_a1=$data_a1[0];
$data_a2=explode(",", $a2);
$data2_a2=$data_a2[0];
$data_a3=explode(",", $a3);
$data2_a3=$data_a3[0];
$data_a4=explode(",", $a4);
$data2_a4=$data_a4[0];
$data_a5=explode(",", $a5);
$data2_a5=$data_a5[0];
$data_a6=explode(",", $a6);
$data2_a6=$data_a6[0];
for($i=0; $i < count($tour); $i++) {
$tour2[$i]= explode(",", $tour[$i]);
	$tourpack= $tour2[$i][0];
	 $durasi_pack=$tour2[$i][1];
	 $agt=$total_gt[$i];
	if($tourpack != $data2_a1){
		$final_a1=NULL;
	}else{
		$final_a1=$a1;
	}
	if($tourpack != $data2_a2){
		$final_a2=NULL;
	}else{
		$final_a2=$a2;
	}
	if($tourpack != $data2_a3){
		$final_a3=NULL;
	}else{
		$final_a3=$a3;
	}
	if($tourpack != $data2_a4){
		$final_a4=NULL;
	}else{
		$final_a4=$a4;
	}
	if($tourpack != $data2_a5){
		$final_a5=NULL;
	}else{
		$final_a5=$a5;
	}		
		
	
 $sql = "INSERT INTO transquo VALUES ('','".$tourpack."','".$durasi_pack."','".$tpax."','".$kurs."','".$ket."','".$final_a1."','".$final_a2."','".$final_a3."','".$final_a4."','".$final_a5."','".$final_a6."','".$agt."','".$gn."','".$tlp."')";
//var_dump($sql);
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://www.2canholiday.com/Admin/#");
}
	 

}
	$con->close();


?>