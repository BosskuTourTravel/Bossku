<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$flag = $_POST['flag'];

$sql = "UPDATE performa_price_standart_flight SET option_price =".$flag." WHERE id=".$id;
if (mysqli_query($con, $sql)) {
	$temp = 0;
} else {
	$temp = 1;
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
    
if($temp==0){
	echo "success";
}

?>