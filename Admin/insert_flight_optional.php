<?php
include "../db=connection.php";
session_start();
$date =  date('Y-m-d');
$staff = $_SESSION['staff_id'];

$query_data = "SELECT * FROM LTSUB_itin WHERE id=" . $_POST['sub_id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);

foreach ($_POST['id_fl'] as $value) {

     $query_code = "SELECT * FROM flight_LTnew where id =" . $value;
     $rs_code = mysqli_query($con, $query_code);
     $row_code = mysqli_fetch_array($rs_code);
     if ($row_code['id'] != "") {
          $sql = "INSERT INTO flight_optional VALUES ('','" . $date . "','" . $row_data['master_id'] . "','" . $row_data['id'] . "','" . $row_code['tour_code'] . "','" . $row_code['rute'] . "','".$value."','" . $staff . "')";
          //  var_dump($sql);
          if (mysqli_query($con, $sql)) {
               echo "Berhasill ";
          } else {
               echo "error : " . $sql;
          }
     } else {
          echo "ID tidak terbaca !";
     }
}
$con->close();
