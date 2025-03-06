<?php
include "../site.php";
include "../db=connection.php";
//export.php  
$flight ='';

$data =[];
// var_dump($_POST['bf']);
// var_dump($_POST['ln']);
// var_dump($_POST['dn']);

if ($_POST['flight']) {
      $sql_bf = "SELECT * FROM flight_LT WHERE id= '" . $_POST['flight'] . "'";
      $result_bf = mysqli_query($con, $sql_bf);
      $row_bf = mysqli_fetch_assoc($result_bf);

      // $total_bf = intval($bf)* intval($_POST['total']);
      // // var_dump($total_bf);
      //  array_push($data,$total_bf);
      // //array_push($data, array('breakfast' => $total_bf));

}


echo json_encode($row_bf);
?>