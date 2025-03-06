<?php
include "../site.php";
include "../db=connection.php";
//export.php  
$data = [];
if ($_POST['maskapai'] !="") {
      $query_route_out = "SELECT DISTINCT city_out FROM LTP_add_route where maskapai='".$_POST['maskapai']."' && city_in='".$_POST['city_in']."' order by city_out ASC";
      $rs_route_out = mysqli_query($con, $query_route_out);
      while ($row_route_out = mysqli_fetch_array($rs_route_out)) {
            array_push($data,  $row_route_out['city_out']);
      }
      echo json_encode($data);
}
