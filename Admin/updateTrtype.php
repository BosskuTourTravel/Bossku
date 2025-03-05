<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$name = $_POST['name'];
$tr_type = $_POST['transport_type'];

$sql = "UPDATE transport_type SET name='".$name."', transport_type=".$tr_type." WHERE id=".$id;
if (mysqli_query($con, $sql)) {
  echo "success";

} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  //header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
    



?>