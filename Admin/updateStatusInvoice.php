<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$flag = $_POST['flag'];


$sql = "UPDATE invoice SET status=".$flag." WHERE id=".$id;
if (mysqli_query($con, $sql)) {
  echo "success";

} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
    



?>