<?php
include "../site.php";
include "../db=connection.php";
//export.php  
$data = [];
if ($_POST['maskapai'] !="") {
      $query_route_in = "SELECT DISTINCT city_in FROM LTP_add_route where maskapai='".$_POST['maskapai']."' order by city_in ASC";
      $rs_route_in = mysqli_query($con, $query_route_in);
      while ($row_route_in = mysqli_fetch_array($rs_route_in)) {
            array_push($data,  $row_route_in['city_in']);
      }
      echo json_encode($data);
}
