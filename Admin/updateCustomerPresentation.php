<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$category = $_POST['category'];
/////// edit neno//////////////////////////////
$dateNow = date("Y-m-d H:i:s");
$querycs = "SELECT * FROM customer_list WHERE id = ".$id;
$rscs=mysqli_query($con,$querycs);
$rowcs = mysqli_fetch_array($rscs);
$staff=$rowcs['staff_input'];
$name=$rowcs['customer_name'];
$job='26';
$jumlah='1';

$queryjob = "SELECT * FROM jenisgaji WHERE id = ".$job;
$rsj=mysqli_query($con,$queryjob);
$rowj = mysqli_fetch_array($rsj);
$harga = $rowj['harga'];
$hargaz=0;
if($category==1){
$hargaz=$hargaz+$harga;
$sqljob = "INSERT INTO total_job VALUES ('','".$dateNow."','".$staff."','".$job."','".$name."','".$id."','".$jumlah."','".$hargaz."')";	
}
else{
  $sqljob = "DELETE FROM total_job  WHERE job=".$job." AND img=".$id;
}

///////////////////////////////////////////////

$sql = "UPDATE customer_list SET presentation=".$category." WHERE id=".$id;
// echo $sql."</br>";
if (mysqli_query($con, $sql) && mysqli_query($con, $sqljob)) {
  echo "success";

} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
    



?>