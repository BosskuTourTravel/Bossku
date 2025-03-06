<?php
include "../site.php";
include "../db=connection.php";
//export.php  
$land ='';

$data =[];
// var_dump($_POST['bf']);
// var_dump($_POST['ln']);
// var_dump($_POST['dn']);

if ($_POST['land']) {
      $sql_bf = "SELECT * FROM transport WHERE id= '" . $_POST['land'] . "'";
      $result_bf = mysqli_query($con, $sql_bf);
      $row_bf = mysqli_fetch_assoc($result_bf);

}


echo json_encode($row_bf);
?>