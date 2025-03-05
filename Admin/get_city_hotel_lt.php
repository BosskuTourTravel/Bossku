<?php
include "../site.php";
include "../db=connection.php";
//export.php  
$data = [];
if ($_POST['brand']) {

      $query_hotel_city = "SELECT DISTINCT city FROM hotel_lt where country='".$_POST['brand']."' Order by city ASC";
      $rs_hotel_city = mysqli_query($con, $query_hotel_city);
      // var_dump($query_hotel_city);
      while ($row_hotel_city =  mysqli_fetch_assoc($rs_hotel_city)) {
            array_push($data, $row_hotel_city);
      }
      // var_dump($sql_guide);
      echo json_encode($data);
}
