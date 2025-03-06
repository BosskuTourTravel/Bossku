<?php
include "../db=connection.php";

$sql = "DELETE FROM LT_job_list WHERE id=".$_POST['id'];
if ($con->query($sql) === TRUE) {
  echo "success" ;
} else {
   echo "Gagal";
}
$con->close();
