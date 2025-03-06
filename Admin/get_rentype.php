<?php
include "../site.php";
include "../db=connection.php";
//export.php  
$data = [];
$rent = $_POST['rt'];
if ($_POST['brand']) {

      $sql_lt = "SELECT * FROM Transport_new WHERE id ='" . $_POST['brand'] . "'";
      $result_lt = mysqli_query($con, $sql_lt);
      // var_dump($sql_lt);
      while ($row_lt = mysqli_fetch_array($result_lt)) {
            $id = $row_lt['id'];
            $nama = $rent;
            if ($rent == "ow") {
                  $harga = $row_lt['oneway'];
            } else if ($rent == "tw") {
                  $harga = $row_lt['twoway'];
            } else if ($rent == "hd1") {
                  $harga = $row_lt['hd1'];
            } else if ($rent == "hd2") {
                  $harga = $row_lt['hd2'];
            } else if ($rent == "fd1") {
                  $harga = $row_lt['fd1'];
            } else if ($rent == "fd2") {
                  $harga = $row_lt['fd2'];
            } else if ($rent == "kaisoda") {
                  $harga = $row_lt['kaisoda'];
            } else if ($rent == "luarkota") {
                  $harga = $row_lt['luarkota'];
            } else {
                  $harga = "";
            }
            array_push($data, array("id" => $id, "nama" => $nama, "harga" => $harga));
      }
      // var_dump($sql_guide);
      echo json_encode($data);
}
