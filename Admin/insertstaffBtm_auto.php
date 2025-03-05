<?php
include "../site.php";
include "../db=connection.php";
$btm="1";
$querysall= "SELECT * FROM sallary_auto where gj=".$btm." order by id ASC";
$rssall=mysqli_query($con,$querysall);
while($rowsall = mysqli_fetch_array($rssall)){
$staff =$rowsall['nama'];
$gaji =$rowsall['gaji'];
$bpjs =$rowsall['bpjs'];
$gj = $rowsall['gj'];

date_default_timezone_set('Asia/Jakarta');
$date = date("Y-m-d H:i:s");


$sql = "INSERT INTO sallary VALUES ('','".$date."','".$staff."','".$gaji."','".$bpjs."','".$gj."')";
	if (mysqli_query($con, $sql)) {
		echo "success";
	} else {
		echo "Error: " . $sql . "" . mysqli_error($con);
		header("location:https://2canholiday.com/Admin/#");
	}

}
	$con->close();


?>