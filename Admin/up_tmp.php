<?php
include "../db=connection.php";

if ($_POST['pilihan'] == 1) {

  $arr_change = [];
  $queryTmp = "SELECT * FROM  LT_add_listTmp where id='" . $_POST['id'] . "'";
  $rsTmp = mysqli_query($con, $queryTmp);
  $rowTmp = mysqli_fetch_array($rsTmp);


  $urutan = $rowTmp['urutan'] - 1;
  $data = array(
    "tour_id" => $rowTmp['tour_id'],
    "hari" => $rowTmp['hari'],
    "urutan" =>  $urutan,
    "tmp" =>  $rowTmp['tempat'],
  );
  array_push($arr_change, $data);

  $queryTmp2 = "SELECT * FROM  LT_add_listTmp where tour_id='" . $rowTmp['tour_id'] . "' && hari='" .  $rowTmp['hari'] . "' && urutan='" . $urutan . "' ";
  $rsTmp2 = mysqli_query($con, $queryTmp2);
  $rowTmp2 = mysqli_fetch_array($rsTmp2);

  $urutan2 = $rowTmp2['urutan'] + 1;
  $data2 = array(
    "tour_id" => $rowTmp2['tour_id'],
    "hari" => $rowTmp2['hari'],
    "urutan" =>  $urutan2,
    "tmp" =>  $rowTmp2['tempat'],
  );
  array_push($arr_change, $data2);
  $update = 0;
  $gagal = 0;
  foreach ($arr_change as $val) {
    $sql = "UPDATE LT_add_listTmp SET urutan='" . $val['urutan'] . "' WHERE tour_id='" . $val['tour_id'] . "' && hari='" . $val['hari'] . "' && tempat='" . $val['tmp'] . "'";
    if (mysqli_query($con, $sql)) {
      $update++;
    } else {
      $gagal++;
    }
  }
} else if ($_POST['pilihan'] == 2) {

  $arr_change = [];
  $queryTmp = "SELECT * FROM  LT_add_listTmp where id='" . $_POST['id'] . "'";
  $rsTmp = mysqli_query($con, $queryTmp);
  $rowTmp = mysqli_fetch_array($rsTmp);

  $queryTmp_cek = "SELECT urutan FROM  LT_add_listTmp where tour_id='" . $rowTmp['tour_id'] . "' && hari='" . $rowTmp['hari'] . "' order by urutan DESC limit 1";
  $rsTmp_cek = mysqli_query($con, $queryTmp_cek);
  $rowTmp_cek = mysqli_fetch_array($rsTmp_cek);
  // var_dump($rowTmp['urutan']);
  $p1 = $rowTmp['urutan'];
  $p2 = $rowTmp_cek['urutan'];

  if ($p1 == $p2) {
    echo "Urutan terakhir tidak dapat di turunkan !";
  } else {
    $urutan = $rowTmp['urutan'] + 1;
    $data = array(
      "tour_id" => $rowTmp['tour_id'],
      "hari" => $rowTmp['hari'],
      "urutan" =>  $urutan,
      "tmp" =>  $rowTmp['tempat'],
    );
    array_push($arr_change, $data);

    $queryTmp2 = "SELECT * FROM  LT_add_listTmp where tour_id='" . $rowTmp['tour_id'] . "' && hari='" .  $rowTmp['hari'] . "' && urutan='" . $urutan . "' ";
    $rsTmp2 = mysqli_query($con, $queryTmp2);
    $rowTmp2 = mysqli_fetch_array($rsTmp2);

    $urutan2 = $rowTmp2['urutan'] - 1;
    $data2 = array(
      "tour_id" => $rowTmp2['tour_id'],
      "hari" => $rowTmp2['hari'],
      "urutan" =>  $urutan2,
      "tmp" =>  $rowTmp2['tempat'],
    );
    array_push($arr_change, $data2);
    $update = 0;
    $gagal = 0;
    foreach ($arr_change as $val) {
      $sql = "UPDATE LT_add_listTmp SET urutan='" . $val['urutan'] . "' WHERE tour_id='" . $val['tour_id'] . "' && hari='" . $val['hari'] . "' && tempat='" . $val['tmp'] . "'";
      if (mysqli_query($con, $sql)) {
        $update++;
      } else {
        $gagal++;
      }
    }
  }
} else if ($_POST['pilihan'] == 3) {
  $arr_change = [];
  $queryTmp = "SELECT * FROM  LT_add_listTmp where tour_id='" . $_POST['id'] . "' && hari='" . $_POST['hari'] . "' order by urutan ASC";
  $rsTmp = mysqli_query($con, $queryTmp);
  $up = 0;
  while ($rowTmp = mysqli_fetch_array($rsTmp)) {

    $query_rute = "SELECT id FROM LT_add_rute where tour_id='" . $rowTmp['tour_id'] . "' && hari='" . $rowTmp['hari'] . "'";
    $rs_rute = mysqli_query($con, $query_rute);
    $row_rute = mysqli_fetch_array($rs_rute);

    $query_meal = "SELECT id FROM LT_add_meal where tour_id='" . $rowTmp['tour_id'] . "' && hari='" . $rowTmp['hari'] . "'";
    $rs_meal = mysqli_query($con, $query_meal);
    $row_meal = mysqli_fetch_array($rs_meal);

    $query_ops = "SELECT id FROM LT_add_ops where tour_id='" . $rowTmp['tour_id'] . "' && hari='" . $rowTmp['hari'] . "'";
    $rs_ops = mysqli_query($con, $query_ops);
    $row_ops = mysqli_fetch_array($rs_ops);

    $up = $rowTmp['hari'] - 1;
    $data = array(
      "id" => $rowTmp['id'],
      "tour_id" => $rowTmp['tour_id'],
      "hari" => $up,
      "urutan" => $rowTmp['urutan'],
      "tempat" => $rowTmp['tempat'],
      "rute" =>  $row_rute['id'],
      "meal" => $row_meal['id'],
      "optional" => $row_ops['id'],
    );
    array_push($arr_change, $data);
  }

  $queryTmp2 = "SELECT * FROM  LT_add_listTmp where tour_id='" . $_POST['id'] . "' && hari='" . $up . "' order by urutan ASC";
  $rsTmp2 = mysqli_query($con, $queryTmp2);
  while ($rowTmp2 = mysqli_fetch_array($rsTmp2)) {

    $query_rute2 = "SELECT id FROM LT_add_rute where tour_id='" . $rowTmp2['tour_id'] . "' && hari='" . $rowTmp2['hari'] . "'";
    $rs_rute2 = mysqli_query($con, $query_rute2);
    $row_rute2 = mysqli_fetch_array($rs_rute2);

    $query_meal2 = "SELECT id FROM LT_add_meal where tour_id='" . $rowTmp2['tour_id'] . "' && hari='" . $rowTmp2['hari'] . "'";
    $rs_meal2 = mysqli_query($con, $query_meal2);
    $row_meal2 = mysqli_fetch_array($rs_meal2);

    $query_ops2 = "SELECT id FROM LT_add_ops where tour_id='" . $rowTmp['tour_id'] . "' && hari='" . $rowTmp['hari'] . "'";
    $rs_ops2 = mysqli_query($con, $query_ops2);
    $row_ops2 = mysqli_fetch_array($rs_ops2);

    $down = $rowTmp2['hari'] + 1;
    $data2 = array(
      "id" => $rowTmp2['id'],
      "tour_id" => $rowTmp2['tour_id'],
      "hari" => $down,
      "urutan" => $rowTmp2['urutan'],
      "tempat" => $rowTmp2['tempat'],
      "rute" =>  $row_rute2['id'],
      "meal" => $row_meal2['id'],
      "optional" => $row_ops2['id'],
    );
    array_push($arr_change, $data2);
  }


  $update = 0;
  $gagal = 0;
  foreach ($arr_change as $val) {
    $sql = "UPDATE LT_add_listTmp SET hari='" . $val['hari'] . "' WHERE id='" . $val['id'] . "'";
    if (mysqli_query($con, $sql)) {
      $update++;
    } else {
      $gagal++;
    }
    /// rute //////
    $sql2 = "UPDATE LT_add_rute SET hari='" . $val['hari'] . "' WHERE id='" . $val['rute'] . "'";
    if (mysqli_query($con, $sql2)) {
      $update++;
    } else {
      $gagal++;
    }
    /// rute //////
    /// meal //////
    $sql3 = "UPDATE LT_add_meal SET hari='" . $val['hari'] . "' WHERE id='" . $val['meal'] . "'";
    if (mysqli_query($con, $sql3)) {
      $update++;
    } else {
      $gagal++;
    }
    /// meal //////
    if ($val['optional'] != "") {
      /// ops //////
      $sql4 = "UPDATE LT_add_ops SET hari='" . $val['hari'] . "' WHERE id='" . $val['optional'] . "'";
      if (mysqli_query($con, $sql4)) {
        $update++;
      } else {
        $gagal++;
      }
      /// ops //////
    }
  }
} else if ($_POST['pilihan'] == 4) {
  $arr_change = [];

  $queryTmp = "SELECT * FROM  LT_add_listTmp where tour_id='" . $_POST['id'] . "' && hari='" . $_POST['hari'] . "' order by urutan ASC";
  $rsTmp = mysqli_query($con, $queryTmp);
  $down = 0;
  while ($rowTmp = mysqli_fetch_array($rsTmp)) {

    $query_rute = "SELECT id FROM LT_add_rute where tour_id='" . $rowTmp['tour_id'] . "' && hari='" . $rowTmp['hari'] . "'";
    $rs_rute = mysqli_query($con, $query_rute);
    $row_rute = mysqli_fetch_array($rs_rute);

    $query_meal = "SELECT id FROM LT_add_meal where tour_id='" . $rowTmp['tour_id'] . "' && hari='" . $rowTmp['hari'] . "'";
    $rs_meal = mysqli_query($con, $query_meal);
    $row_meal = mysqli_fetch_array($rs_meal);

    $query_ops = "SELECT id FROM LT_add_ops where tour_id='" . $rowTmp['tour_id'] . "' && hari='" . $rowTmp['hari'] . "'";
    $rs_ops = mysqli_query($con, $query_ops);
    $row_ops = mysqli_fetch_array($rs_ops);

    $down = $rowTmp['hari'] + 1;
    $data = array(
      "id" => $rowTmp['id'],
      "tour_id" => $rowTmp['tour_id'],
      "hari" => $down,
      "urutan" => $rowTmp['urutan'],
      "tempat" => $rowTmp['tempat'],
      "rute" =>  $row_rute['id'],
      "meal" => $row_meal['id'],
      "optional" => $row_ops['id'],
    );
    array_push($arr_change, $data);
  }

  $queryTmp2 = "SELECT * FROM  LT_add_listTmp where tour_id='" . $_POST['id'] . "' && hari='" . $down . "' order by urutan ASC";
  $rsTmp2 = mysqli_query($con, $queryTmp2);
  while ($rowTmp2 = mysqli_fetch_array($rsTmp2)) {

    $query_rute2 = "SELECT id FROM LT_add_rute where tour_id='" . $rowTmp2['tour_id'] . "' && hari='" . $rowTmp2['hari'] . "'";
    $rs_rute2 = mysqli_query($con, $query_rute2);
    $row_rute2 = mysqli_fetch_array($rs_rute2);

    $query_meal2 = "SELECT id FROM LT_add_meal where tour_id='" . $rowTmp2['tour_id'] . "' && hari='" . $rowTmp2['hari'] . "'";
    $rs_meal2 = mysqli_query($con, $query_meal2);
    $row_meal2 = mysqli_fetch_array($rs_meal2);

    $query_ops2 = "SELECT id FROM LT_add_ops where tour_id='" . $rowTmp['tour_id'] . "' && hari='" . $rowTmp['hari'] . "'";
    $rs_ops2 = mysqli_query($con, $query_ops2);
    $row_ops2 = mysqli_fetch_array($rs_ops2);

    $up = $rowTmp2['hari'] - 1;
    $data2 = array(
      "id" => $rowTmp2['id'],
      "tour_id" => $rowTmp2['tour_id'],
      "hari" => $up,
      "urutan" => $rowTmp2['urutan'],
      "tempat" => $rowTmp2['tempat'],
      "rute" =>  $row_rute2['id'],
      "meal" => $row_meal2['id'],
      "optional" => $row_ops2['id'],
    );
    array_push($arr_change, $data2);
  }


  $update = 0;
  $gagal = 0;
  foreach ($arr_change as $val) {
    $sql = "UPDATE LT_add_listTmp SET hari='" . $val['hari'] . "' WHERE id='" . $val['id'] . "'";
    if (mysqli_query($con, $sql)) {
      $update++;
    } else {
      $gagal++;
    }
    /// rute //////
    $sql2 = "UPDATE LT_add_rute SET hari='" . $val['hari'] . "' WHERE id='" . $val['rute'] . "'";
    if (mysqli_query($con, $sql2)) {
      $update++;
    } else {
      $gagal++;
    }
    /// rute //////
    /// meal //////
    $sql3 = "UPDATE LT_add_meal SET hari='" . $val['hari'] . "' WHERE id='" . $val['meal'] . "'";
    if (mysqli_query($con, $sql3)) {
      $update++;
    } else {
      $gagal++;
    }
    /// meal //////
    if ($val['optional'] != "") {
      /// ops //////
      $sql4 = "UPDATE LT_add_ops SET hari='" . $val['hari'] . "' WHERE id='" . $val['optional'] . "'";
      if (mysqli_query($con, $sql4)) {
        $update++;
      } else {
        $gagal++;
      }
      /// ops //////
    }
  }
}


echo $update . " data updated !";

$con->close();
