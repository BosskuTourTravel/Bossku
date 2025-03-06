<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$name = $_POST['name'];
$country = $_POST['country'];

$sql = "UPDATE city SET name='".$name."', country=".$country." WHERE id=".$id;
if (mysqli_query($con, $sql)) {
  echo "success";

} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  //header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
    



?>