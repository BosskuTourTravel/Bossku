<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$staff = $_POST['staff'];
$flag = $_POST['flag'];

$sql = "UPDATE customer_list SET handle=".$flag.", staff_handle=".$staff." WHERE id=".$id;
if (mysqli_query($con, $sql)) {
  echo "success";

} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
    



?>