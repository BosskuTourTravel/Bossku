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

if ($_POST['tmp']) {
      $sql_bf = "SELECT * FROM List_tempat WHERE id='" . $_POST['tmp'] . "'";
      $result_bf = mysqli_query($con, $sql_bf);
      // var_dump( $sql_bf);
      while ($row_bf = mysqli_fetch_array($result_bf)) {
           array_push($data,array("id" => $row_bf['id'],"kurs" => $row_bf['kurs'],"price" => $row_bf['price']));
      }
      // var_dump($sql_guide);
      echo json_encode($data);
    

}

// echo json_encode($data);
?>