<?php
include "../site.php";
include "../db=connection.php";

$arr = [];
if ($_POST['tipe'] == '1') {
      $query_guide = "SELECT * FROM Guide_Meal where negara='" . $_POST['negara'] . "' && type='FEE' order by id ASC";
      $rs_guide = mysqli_query($con, $query_guide);

      while ($row_guide = mysqli_fetch_array($rs_guide)) {
            array_push($arr, array("id" => $row_guide['id'], "nama" => $row_guide['nama'], "kurs" => $row_guide['kurs'], "harga" => $row_guide['harga']));
      }
} else if ($_POST['tipe'] == '2') {

      $query_guide = "SELECT * FROM Guide_Meal where negara='" . $_POST['negara'] . "' && type='S FEE' order by id ASC";
      $rs_guide = mysqli_query($con, $query_guide);

      while ($row_guide = mysqli_fetch_array($rs_guide)) {
            array_push($arr, array("id" => $row_guide['id'], "nama" => $row_guide['nama'], "kurs" => $row_guide['kurs'], "harga" => $row_guide['harga']));
      }
} else if ($_POST['tipe'] == '3') {
      $query_guide = "SELECT * FROM Guide_Meal where negara='" . $_POST['negara'] . "' && type='MEAL' && kode='E' order by id ASC";
      $rs_guide = mysqli_query($con, $query_guide);

      while ($row_guide = mysqli_fetch_array($rs_guide)) {
            array_push($arr, array("id" => $row_guide['id'], "nama" => $row_guide['nama'], "kurs" => $row_guide['kurs'], "harga" => $row_guide['harga']));
      }
} else if ($_POST['tipe'] == '4') {
      $query_guide = "SELECT * FROM Guide_Meal where negara='" . $_POST['negara'] . "' && type='MEAL' && kode='F' order by id ASC";
      $rs_guide = mysqli_query($con, $query_guide);

      while ($row_guide = mysqli_fetch_array($rs_guide)) {
            array_push($arr, array("id" => $row_guide['id'], "nama" => $row_guide['nama'], "kurs" => $row_guide['kurs'], "harga" => $row_guide['harga']));
      }
} else if ($_POST['tipe'] == '5') {
      $query_guide = "SELECT * FROM Guide_Meal where negara='" . $_POST['negara'] . "' && type='MEAL' && kode='G' order by id ASC";
      $rs_guide = mysqli_query($con, $query_guide);

      while ($row_guide = mysqli_fetch_array($rs_guide)) {
            array_push($arr, array("id" => $row_guide['id'], "nama" => $row_guide['nama'], "kurs" => $row_guide['kurs'], "harga" => $row_guide['harga']));
      }
} else if ($_POST['tipe'] == '6') {
      $query_guide = "SELECT * FROM Guide_Meal where negara='" . $_POST['negara'] . "' && type='VT' && kode='H' order by id ASC";
      $rs_guide = mysqli_query($con, $query_guide);

      while ($row_guide = mysqli_fetch_array($rs_guide)) {
            array_push($arr, array("id" => $row_guide['id'], "nama" => $row_guide['nama'], "kurs" => $row_guide['kurs'], "harga" => $row_guide['harga']));
      }
} else {
}
echo json_encode($arr);
