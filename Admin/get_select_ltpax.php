<?php
include "../site.php";
include "../db=connection.php";
//export.php  
$data =[];
if ($_POST['brand']) {
 
      $sql_lt = "SELECT * FROM LT_itinnew WHERE kode ='".$_POST['brand']."'";
      $result_lt = mysqli_query($con, $sql_lt);
      // var_dump($sql_lt);
      while ($row_lt =  mysqli_fetch_assoc($result_lt)) {
           array_push($data,$row_lt);
      }
      // var_dump($sql_guide);
      echo json_encode($data);
}
?>