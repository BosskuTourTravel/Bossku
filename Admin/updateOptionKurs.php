<?php
include "../site.php";
include "../db=connection.php";

$agent = $_POST['agent'];
$continent = $_POST['continent'];
$country = $_POST['country'];
$city = $_POST['city'];
$periode = $_POST['periode'];
$kurs = $_POST['kurs'];



$sql = "UPDATE transport SET kurs =".$kurs."  WHERE agent=".$agent." AND contry=".$country." AND city=".$city." AND continent=".$continent." AND  periode=".$periode;
if (mysqli_query($con, $sql)) {
	echo "success";
} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
   
?>