<?php
include "../site.php";
include "../db=connection.php";

$agent = $_POST['agent'];
$continent = $_POST['continent'];
$country = $_POST['country'];
$city = $_POST['city'];





$sql = "UPDATE transport SET city =".$city."  WHERE agent=".$agent." AND contry=".$country." AND continent=".$continent;
if (mysqli_query($con, $sql)) {
	echo "success";
} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
   
?>