<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$customer_id = $_POST['customer_id'];


$sql = "UPDATE flight SET customer_id=".$customer_id." WHERE id=".$id;
if (mysqli_query($con, $sql)) {
  echo "success";

} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
    



?>