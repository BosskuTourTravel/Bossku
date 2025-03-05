<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];
$tanggal = $_POST['tanggal'];
$sql = "UPDATE payment_detail_visapassport SET tanggal_transfer='".$tanggal."' WHERE id=".$id;
if (mysqli_query($con, $sql)) {
  echo "success";

} else {
  echo "Error: " . $sql . "" . mysqli_error($con);
  header("location:https://www.2canholiday.com/Admin/#");
}
$con->close();
    



?>