<?php
include "../site.php";
include "../db=connection.php";
//export.php  
$data = [];
if ($_POST['brand']) {
      $query_trans_type = "SELECT DISTINCT trans_type FROM Transport_new where country='".$_POST['negara']."' && city='".$_POST['brand']."' Order by trans_type ASC";
      $rs_trans_type = mysqli_query($con, $query_trans_type);
      while ($row_trans_type =  mysqli_fetch_assoc($rs_trans_type)) {
            array_push($data, $row_trans_type);
      }
      echo json_encode($data);
}
