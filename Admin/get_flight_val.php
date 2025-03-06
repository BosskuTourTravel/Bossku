<?php
include "../site.php";
include "../db=connection.php";
//export.php  

$data =[];

if ($_POST['brand']) {
      // $sql = "SELECT * FROM flight_LTnew WHERE  id= '" . $_POST['brand'] . "'";
      // $result = mysqli_query($con, $sql);
      // $row= mysqli_fetch_assoc($result);

      $sql2 = "SELECT * FROM flight_LTnew WHERE  type='".$_POST['type']."' AND rute LIKE'%".$_POST['brand']."%'";
      $result2 = mysqli_query($con, $sql2);

      while ($row2 = mysqli_fetch_assoc($result2)) {
            array_push($data,$row2);
       }
      echo json_encode($data);
    
}

?>