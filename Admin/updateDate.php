<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$day = $_POST['day'];
$month = $_POST['month'];
$year  = $_POST['year'];


$sql = "UPDATE date_package SET date_number=".$day.", month=".$month.", year=".$year." WHERE id=".$id;
if (mysqli_query($con, $sql)) {
  echo "success";

} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
    



?>