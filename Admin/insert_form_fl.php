<?php
include "../site.php";
include "../db=connection.php";
$col = $_POST['col'];
$date = date("Y-m-d");
$status = $_SESSION['staff_id'];


$cek_id = "SELECT id_grub FROM LTP_route_detail ORDER BY id_grub DESC LIMIT 1";
$rs_cek_id = mysqli_query($con, $cek_id);
$row_cek_id = mysqli_fetch_array($rs_cek_id);
$val_cek_id = $row_cek_id['id_grub'] + 1;

$query_code = "SELECT kode FROM LT_flight_logo where id ='" . $_POST['fl'] . "'";
$rs_code = mysqli_query($con, $query_code);
$row_code = mysqli_fetch_array($rs_code);

$query_cek = "SELECT id FROM LTP_add_route where city_in ='" . $_POST['city_in'] . "' && city_out ='" . $_POST['city_out'] . "' &&  maskapai='" . $row_code['kode'] . "' ";
$rs_cek = mysqli_query($con, $query_cek);
$row_cek = mysqli_fetch_array($rs_cek);
$b_route = 0;
$g_route = 0;
$b_detail = 0;
$g_detail = 0;
if ($row_cek['id'] == "") {

    $sql = "INSERT INTO LTP_add_route VALUES ('','" . $date . "','" . $_POST['city_in'] . "','" . $_POST['city_out'] . "','" . $row_code['kode'] . "','$status')";
    // echo "Baru ". $sql."</br>";
    if (mysqli_query($con, $sql)) {
        $b_route++;
    } else {
        $g_route++;
    }
}
// cek route
$query_route = "SELECT id FROM LTP_add_route where city_in ='" . $_POST['city_in'] . "' && city_out ='" . $_POST['city_out'] . "' &&  maskapai='" . $row_code['kode'] . "'";
$rs_route = mysqli_query($con, $query_route);
$row_route = mysqli_fetch_array($rs_route);
if ($row_route['id'] != "") {
    for ($i = 0; $i < $col; $i++) {
        $sql2 = "INSERT INTO LTP_route_detail VALUES ('','" . $row_route['id'] . "','" . $_POST['musim'] . "','" . $_POST['trip'] . "','" . $_POST['rute'] . "','" . $val_cek_id . "','" . $_POST['maskapai'][$i]. "','" . $_POST['dept'][$i] . "','" . $_POST['arr'][$i] . "','" . $_POST['tgl'][$i] . "','" . $_POST['etd'][$i] . "','" . $_POST['eta'][$i] . "','" . $_POST['transit'][$i] . "','" . $_POST['adt'][$i] . "','" . $_POST['chd'][$i] . "','" . $_POST['inf'][$i] . "','" . $_POST['bagasi'][$i] . "','" . $_POST['bagasi_price'][$i] . "','" . $_POST['seat'][$i] . "','" . $_POST['bf'][$i] . "','" . $_POST['ln'][$i] . "','" . $_POST['dn'][$i] . "','" . $_POST['tax'][$i] . "','')";
        if (mysqli_query($con, $sql2)) {
            $b_detail++;
        } else {
            $g_detail++;
            // echo $sql2;
        }
    }
    echo "Route berhasil:".$b_route.", Detail berhasil:". $b_detail;
} else {
    echo "route cek gagal " . $query_route . " </br>";
}

$con->close();
