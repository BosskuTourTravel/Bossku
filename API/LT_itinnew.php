<?php 
  include "../db=connection.php";
  $data = [];
  $query_master = "SELECT * FROM LT_itinnew  ORDER BY id ASC";
  $rs_master = mysqli_query($con, $query_master);
  while($row_master = mysqli_fetch_array($rs_master)){
    array_push($data,$row_master);
  }
  return json_encode($data,true);
?>