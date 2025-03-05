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
      $sql_bf = "SELECT * FROM LT_itin WHERE id='" . $_POST['brand'] . "'";
      $result_bf = mysqli_query($con, $sql_bf);
      while ($row_lt = mysqli_fetch_array($result_bf)) {
           array_push($data,array("id" => $row_lt['id'],"twn" => $row_lt['twn'],"cnb" => $row_lt['cnb'],"sgl" => $row_lt['sgl']));
      }
      // var_dump($sql_guide);
      echo json_encode($data);
    

}

// echo json_encode($data);
?>