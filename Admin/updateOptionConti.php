<?php
include "../site.php";
include "../db=connection.php";

$agent = $_POST['agent'];
$continent = $_POST['continent'];






$sql = "UPDATE transport SET continent =".$continent."  WHERE agent=".$agent;
if (mysqli_query($con, $sql)) {
	echo "success";
} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
   
?>