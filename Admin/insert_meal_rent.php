<?php
include "../db=connection.php";

// var_dump($row_rent['id']);
$date = date("Y-m-d");

$hari = $_POST['hari'];
$range = explode("-", $hari);
// var_dump($_POST['fee']);
$berhasil = 0;
$gagal = 0;
if (!isset($range[1])) {
    // echo $hari;
    $koma = explode(",", $hari);
    foreach ($koma as $value) {

        $query_rent_cek = "SELECT * FROM LT_add_guide_price_manual where tour_id='" . $_POST['tourid'] . "' && package_id='" . $_POST['id'] . "' && hari='".$value."'";
        $rs_rent_cek =  mysqli_query($con, $query_rent_cek);
        $row_rent_cek = mysqli_fetch_array($rs_rent_cek);
        // echo $value;
        if (!isset($row_rent_cek['id'])) {
            $sql = "INSERT INTO LT_add_guide_price_manual VALUES ('','" . $_POST['tourid'] . "','" . $_POST['id'] . "','" . $value . "','','','" . $_POST['bf'] . "','" . $_POST['ln'] . "','" . $_POST['dn'] . "','','" . $date . "','')";
            if (mysqli_query($con, $sql)) {
                echo "Berhasil";
            } else {
                echo "Gagal";
            }
        } else {
            $sql_u = "UPDATE LT_add_guide_price_manual SET bf='" . $_POST['bf'] . "', ln='" . $_POST['ln'] . "',dn='" . $_POST['dn'] . "' WHERE tour_id='" . $_POST['tourid'] . "' && package_id='" . $_POST['id'] . "'  && hari='" . $value . "'";
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
        $query_rent_cek2 = "SELECT * FROM LT_add_guide_price_manual where tour_id='" . $_POST['tourid'] . "' && package_id='" . $_POST['id'] . "' && hari='".$i."'";
        $rs_rent_cek2 =  mysqli_query($con, $query_rent_cek2);
        $row_rent_cek2 = mysqli_fetch_array($rs_rent_cek2);
        if (!isset($row_rent_cek2['id'])) {
            // var_dump($i." ");
            $sql2 = "INSERT INTO LT_add_guide_price_manual VALUES ('','" . $_POST['tourid'] . "','" . $_POST['id'] . "','" . $i . "','','','" . $_POST['bf'] . "','" . $_POST['ln'] . "','" . $_POST['dn'] . "','','" . $date . "','')";
            // var_dump($sql2);
            if (mysqli_query($con, $sql2)) {
                echo "Berhasil";
            } else {
                echo "Gagal";
            }
        } else {
            $sql_u2 = "UPDATE LT_add_guide_price_manual SET bf='" . $_POST['bf'] . "', ln='" . $_POST['ln'] . "',dn='" . $_POST['dn'] . "' WHERE tour_id='" . $_POST['tourid'] . "' && package_id='" . $_POST['id'] . "'  && hari='" . $i . "'";
            if (mysqli_query($con, $sql_u2)) {
                $berhasil++;
            } else {
                $gagal++;
            }
            echo "update berhasil" . $berhasil . ", Gagal : " . $gagal;
        }
    }
}
