<?php
include "../site.php";
include "../db=connection.php";
//export.php  
$data = [];
if ($_POST['brand']) {
      $query_trans_type = "SELECT DISTINCT agent FROM Transport_new where country='".$_POST['negara']."' && city='".$_POST['city']."' && trans_type='".$_POST['brand']."'  Order by agent ASC";
      $rs_trans_type = mysqli_query($con, $query_trans_type);
      while ($row_trans_type =  mysqli_fetch_assoc($rs_trans_type)) {
            $query_agent = "SELECT * FROM agent where id='".$row_trans_type['agent']."'";
            $rs_agent = mysqli_query($con,$query_agent);
            $row_agent = mysqli_fetch_array($rs_agent);
            array_push($data,  $row_agent['company']);
      }
      echo json_encode($data);
}
