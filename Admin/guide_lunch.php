<?php
include "../site.php";
include "../db=connection.php";

if ($_POST['lunch']) {
      $data = [];
      $query_meal2 = "SELECT * FROM Guest_meal where id='" . $_POST['lunch'] . "' Order by negara ASC";
      $rs_meal2 = mysqli_query($con, $query_meal2);
      $row_meal2 = mysqli_fetch_array($rs_meal2);

      $query_guide_bf = "SELECT * FROM Guide_Meal where type='MEAL' && kode='F' && negara='".$row_meal2['negara']."' Order by id ASC";
      $rs_guide_bf = mysqli_query($con, $query_guide_bf);
      $row_guide_bf = mysqli_fetch_array($rs_guide_bf);
      array_push($data, array("nama" => $row_guide_bf['nama'], "id" => $row_guide_bf['id'], "harga" => $row_guide_bf['harga']));
      echo json_encode($data);
}
