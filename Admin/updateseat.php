<?php
include "../site.php";
include "../db=connection.php";

$agent = $_POST['agent'];
$continent = $_POST['continent'];
$country = $_POST['country'];
$city = $_POST['city'];
$periode = $_POST['periode'];
$kurs = $_POST['kurs'];
$tp = $_POST['tp'];
$seat = $_POST['seat'];


$sql = "UPDATE transport SET seat ='".$seat."' WHERE agent=".$agent." contry=".$country." AND city=".$city." AND continent=".$continent." AND  periode=='".$periode."' AND  transport_type=".$tp;
var_dump($sql);
if (mysqli_query($con, $sql)) {
	echo "success";
} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
    
?>