<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$person = $_POST['person'];
$personplus = $_POST['personplus'];
$personplus2 = $_POST['personplus2'];
$price = $_POST['price'];
$cwb = $_POST['cwb'];
$cnb = $_POST['cnb'];
$inf = $_POST['inf'];
$adt = $_POST['adt'];
$adt_sub = $_POST['adt_sub'];
$kurs = $_POST['kurs'];
$tourpricepackage = $_POST['tourpricepackage'];
$tag = $_POST['tag'];
$tag2 = $_POST['tag2'];
$surcharge = $_POST['surcharge'];

$sql = "UPDATE tour_price_detail SET person=".$person.",tag='".$tag."', personplus=".$personplus.",tag2='".$tag2."', personplus2=".$personplus2.", price=".$price.", cwb='".$cwb."', cnb='".$cnb."', inf='".$inf."', adt='".$adt."',adt_sub=".$adt_sub.", kurs=".$kurs.", surcharge_weekend=".$surcharge." WHERE id=".$id;
if (mysqli_query($con, $sql)) {
  echo "success";

} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
    



?>