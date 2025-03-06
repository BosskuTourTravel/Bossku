<?php
include "../site.php";
include "../db=connection.php";
//export.php  
$data =[];
if ($_POST['brand']) {
 
      $sql_lt = "SELECT date_set FROM LTP_insert_sfee WHERE id_grub='".$_POST['brand']."' order by date_set ASC";
      $result_lt = mysqli_query($con, $sql_lt);
      while ($row_lt =  mysqli_fetch_assoc($result_lt)) {
           array_push($data,$row_lt);
      }
      echo json_encode($data);
}
?>