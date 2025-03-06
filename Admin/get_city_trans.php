<?php
include "../site.php";
include "../db=connection.php";
//export.php  
$data = [];
if ($_POST['brand']) {

      $query_trans_city = "SELECT DISTINCT city FROM Transport_new where country='".$_POST['brand']."' Order by city ASC";
      $rs_trans_city = mysqli_query($con, $query_trans_city);
      while ($row_trans_city =  mysqli_fetch_assoc($rs_trans_city)) {
            array_push($data, $row_trans_city);
      }
      echo json_encode($data);
}
