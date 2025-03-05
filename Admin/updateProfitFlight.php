<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$profit = $_POST['profit'];
$bagasi = $_POST['bagasi'];
$meal = $_POST['meal'];


$sql = "UPDATE flight SET profit='".$profit."', bagasi='".$bagasi."', meal='".$meal."' WHERE id=".$id;
if (mysqli_query($con, $sql)) {
  echo "success";

} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
    



?>