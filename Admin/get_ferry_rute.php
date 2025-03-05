<?php
include "../site.php";
include "../db=connection.php";
//export.php  

$data =[];
// var_dump("aaddad");
if ($_POST['brand']) {
      $sql_rute = "SELECT DISTINCT nama FROM ferry_LT WHERE type= '" . $_POST['brand'] . "'";
      $result_rute = mysqli_query($con, $sql_rute);
      while ($row_rute = mysqli_fetch_assoc($result_rute)) {
            array_push($data,$row_rute);
       }
      echo json_encode($data);
    
}

?>