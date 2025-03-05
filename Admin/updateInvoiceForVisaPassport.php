<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$type = $_POST['type'];
$pax = $_POST['pax'];
$visapassportId = $_POST['visapassportId'];


if($type==0){
	$queryp = "SELECT * FROM visa WHERE id=".$visapassportId;
	$rsp=mysqli_query($con,$queryp);
	$rowp = mysqli_fetch_array($rsp);
}else{
	$queryp = "SELECT * FROM passport WHERE id=".$visapassportId;
	$rsp=mysqli_query($con,$queryp);
	$rowp = mysqli_fetch_array($rsp);
}

$query = "SELECT * FROM invoice WHERE id=".$id;
$rs=mysqli_query($con,$query);
$row = mysqli_fetch_array($rs);

$total = $pax * $rowp['price'];
$grandtotalFinal = $total + $row['grandtotal'] - $row['visapassportTotal'];

$sql = "UPDATE invoice SET visapassportType=".$type.", visapassportId=".$visapassportId.", visapassportPax=".$pax.", visapassportPrice=".$rowp['price'].", visapassportTotal=".$total.", grandtotal=".$grandtotalFinal." WHERE id=".$id;
if (mysqli_query($con, $sql)) {
  echo "success";

} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
    



?>