<?php 
  include "../db=connection.php";
  $data = [];
  $query_master = "SELECT * FROM DP_ptsub2  ORDER BY id ASC";
  $rs_master = mysqli_query($con, $query_master);
  while($row_master = mysqli_fetch_array($rs_master)){
    array_push($data,$row_master);
  }
  echo json_encode($data,true);
?>