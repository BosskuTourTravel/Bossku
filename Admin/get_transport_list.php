<?php
include "../site.php";
include "../db=connection.php";
//export.php  



if ($_POST['pilih'] == '1') {
      $data = [];
      if ($_POST['kode'] == "") {
            $sql_rute = "SELECT DISTINCT rute FROM flight_LTnew order by rute ASC";
            $rs_rute = mysqli_query($con, $sql_rute);
            while ($row_rute = mysqli_fetch_array($rs_rute)) {
                  array_push($data, $row_rute);
            }
      } else {
            $sql_rute = "SELECT DISTINCT rute FROM flight_LTnew where tour_code='" . $_POST['kode'] . "' order by rute ASC";
            $rs_rute = mysqli_query($con, $sql_rute);
            while ($row_rute = mysqli_fetch_array($rs_rute)) {
                  array_push($data, $row_rute);
            }
      }
      echo json_encode($data);
} else if ($_POST['pilih'] == '2') {
      $data = [];
      $sql_type = "SELECT DISTINCT type FROM flight_LTnew where tour_code='" . $_POST['kode'] . "' && rute='" . $_POST['rute'] . "'  order by type ASC";
      $rs_type = mysqli_query($con, $sql_type);
      while ($row_type = mysqli_fetch_array($rs_type)) {
            array_push($data, $row_type);
      }
      echo json_encode($data);

}else if($_POST['pilih'] == '3'){
      $data = [];
      $sql_detail = "SELECT * FROM flight_LTnew where tour_code='" . $_POST['kode'] . "' && tgl='" . $_POST['tgl'] . "' ";
      $rs_detail = mysqli_query($con, $sql_detail);
      while ($row_detail = mysqli_fetch_array($rs_detail)) {
         $id = $row_detail['id'];
         $detail = $row_detail['maskapai']." ".$row_detail['dept']." - ".$row_detail['arr']." | ".$row_detail['take']." - ".$row_detail['landing']." | ".$row_detail['rute']." | ".$row_detail['type'];
         array_push($data,array("id" => $id, "detail" => $detail));
      }
       echo json_encode($data);
}else if($_POST['pilih'] == '4'){
      $sql_tgl = "SELECT DISTINCT tgl FROM flight_LTnew where tour_code='" . $_POST['kode'] . "' order by tgl ASC";
      $rs_tgl = mysqli_query($con, $sql_tgl);
      $data = [];
      while ($row_tgl = mysqli_fetch_array($rs_tgl)) {
            array_push($data,array("tgl" => $row_tgl['tgl']));
      }
      echo json_encode($data);
}else{

}
