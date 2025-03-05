<?php
include "../site.php";
include "../db=connection.php";
//export.php  

$data =[];

if ($_POST['brand']) {
      $sql = "SELECT * FROM flight_LTnew WHERE  id= '" . $_POST['brand'] . "'";
      $result = mysqli_query($con, $sql);

      while ($row = mysqli_fetch_assoc($result)) {
            array_push($data,$row);
       }
      echo json_encode($data);
    
}

?>