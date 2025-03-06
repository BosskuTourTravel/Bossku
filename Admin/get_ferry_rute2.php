<?php
include "../site.php";
include "../db=connection.php";
//export.php  

$data =[];

if ($_POST['rute']) {
      $sql2 = "SELECT * FROM ferry_LT WHERE  type='".$_POST['type']."' AND nama LIKE'%".$_POST['rute']."%'";
      $result2 = mysqli_query($con, $sql2);

      while ($row2 = mysqli_fetch_assoc($result2)) {
            array_push($data,$row2);
       }
      echo json_encode($data);
    
}

?>