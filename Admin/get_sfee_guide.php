<?php
include "../site.php";
include "../db=connection.php";
//export.php  
$bf ='';
$ln = '';
$dn = '';
$data =[];
// var_dump($_POST['bf']);
// var_dump($_POST['ln']);
// var_dump($_POST['dn']);

if ($_POST['brand']) {
      $sql_bf = "SELECT * FROM Guest_meal WHERE id= '" . $_POST['brand'] . "'";
      $result_bf = mysqli_query($con, $sql_bf);
      $row_bf = mysqli_fetch_assoc($result_bf);
      // var_dump($sql_bf);

      $sql_guide = "SELECT * FROM Guide_Meal WHERE type='S FEE' &&  negara LIKE '" . $row_bf['negara'] . "%'";
      $result_guide = mysqli_query($con, $sql_guide);
      // $row_guide = mysqli_fetch_assoc($result_guide);
      while ($row_guide = mysqli_fetch_array($result_guide)) {
           array_push($data,$row_guide);
      }
      // var_dump($sql_guide);
      echo json_encode($data);
    

}

// echo json_encode($data);
?>