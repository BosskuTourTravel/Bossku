<?php
include "../db=connection.php";
$query_rent = "SELECT * FROM LT_add_guide_price_manual where tour_id='" . $_POST['tourid'] . "' && package_id='" . $_POST['id'] . "'";
$rs_rent =  mysqli_query($con, $query_rent);
$row_rent = mysqli_fetch_array($rs_rent);
// var_dump($row_rent['id']);
$date = date("Y-m-d");

$hari = $_POST['hari'];
$range = explode("-", $hari);
// var_dump($_POST['fee']);
$berhasil = 0;
$gagal = 0;
if ($range[1] == "") {
    // echo $hari;
    $koma = explode(",", $hari);
    foreach ($koma as $value) {
        // echo $value;
        if ($row_rent['id'] == "") {
            $sql = "INSERT INTO LT_add_guide_price_manual VALUES ('','" . $_POST['tourid'] . "','" . $_POST['id'] . "','" . $value . "','','','','','','".$_POST['vt']."','" . $date . "','')";
            if (mysqli_query($con, $sql)) {
                echo "Berhasil";
            } else {
                echo "Gagal";
            }
        } else {
            $sql_u = "UPDATE LT_add_guide_price_manual SET vt='".$_POST['vt']."'  WHERE tour_id='" . $_POST['tourid'] . "' && package_id='" . $_POST['id'] . "'  && hari='" . $value . "'";
            if (mysqli_query($con, $sql_u)) {
                $berhasil++;
            } else {
                $gagal++;
            }
            echo "update berhasil" . $berhasil . ", Gagal : " . $gagal;
        }
    }
} else {
    // echo "range";
    for ($i = $range[0]; $i <= $range[1]; $i++) {
        // var_dump($row_rent['id']);
        if ($row_rent['id'] == "") {
            // var_dump($i." ");
            $sql2 = "INSERT INTO LT_add_guide_price_manual VALUES ('','" . $_POST['tourid'] . "','" . $_POST['id'] . "','" . $i . "','','','','','','".$_POST['vt']."','" . $date . "','')";
            // var_dump($sql2);
            if (mysqli_query($con, $sql2)) {
                echo "Berhasil";
            } else {
                echo "Gagal";
            }
        } else {
            $sql_u2 = "UPDATE LT_add_guide_price_manual SET vt='".$_POST['vt']."' WHERE tour_id='" . $_POST['tourid'] . "' && package_id='" . $_POST['id'] . "'  && hari='" . $i . "'";
            if (mysqli_query($con, $sql_u2)) {
                $berhasil++;
            } else {
                $gagal++;
            }
            echo "update berhasil" . $berhasil . ", Gagal : " . $gagal;
        }
    }
}
