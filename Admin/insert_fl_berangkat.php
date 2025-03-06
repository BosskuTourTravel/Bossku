<?php
include "../db=connection.php";
session_start();
$id = $_POST['id'];
$tgl = $_POST['tgl'];
$date =  date('Y-m-d');
$staff = $_SESSION['staff_id'];


$query_code = "SELECT * FROM flight_LTnew where id =" . $id;
$rs_code = mysqli_query($con, $query_code);
$row_code = mysqli_fetch_array($rs_code);
if ($row_code['id'] != "") {
     $sql = "INSERT INTO flight_keberangkatan VALUES ('','" . $date . "','" . $row_code['tour_code'] . "','" . $row_code['rute'] . "','" . $row_code['id'] . "','" . $tgl . "','" . $staff . "')";
     //  var_dump($sql);
     if (mysqli_query($con, $sql)) {
          echo "Berhasill ";
     } else {
         echo "error : ".$sql;
     }
} else {
     echo "ID tidak terbaca !";
}
$con->close();