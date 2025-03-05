<?php
include "../db=connection.php";
session_start();
$id = 2;
// $id = $_POST['id'];
$query_cek = "SELECT promo_flight_detail.*,LT_flight_logo.kode FROM promo_flight_detail LEFT JOIN LT_flight_logo ON promo_flight_detail.flight=LT_flight_logo.id where id_promo='" . $id . "' order by id ASC";
$rs_cek = mysqli_query($con, $query_cek);
$berhasil = 0;
$gagal = 0;
$invalid = 0;
$online = 0;
//  var_dump($query_cek);
while ($row_cek = mysqli_fetch_array($rs_cek)) {
    $adt = isset($row_cek['adt']) ? $row_cek['adt'] : 0;
    $chd = isset($row_cek['chd']) ? $row_cek['chd'] : 0;
    $inf = isset($row_cek['inf']) ? $row_cek['inf'] : 0;
    $bagasi = isset($row_cek['bagasi']) ? $row_cek['bagasi'] : 0;
    $bf = isset($row_cek['bf']) ? $row_cek['bf'] : 0;
    $ln = isset($row_cek['ln']) ? $row_cek['ln'] : 0;
    $dn = isset($row_cek['dn']) ? $row_cek['dn'] : 0;
    // echo "bagasi :".$bagasi;

    $query_add_route = "SELECT id FROM LTP_add_route where city_in ='" . $row_cek['city_in'] . "' && city_out ='" . $row_cek['city_out'] . "' &&  maskapai='" . $row_cek['kode'] . "' ";
    $rs_add_route = mysqli_query($con, $query_add_route);
    $row_add_route = mysqli_fetch_array($rs_add_route);

    // var_dump($query_add_route);
    // echo "</br>";
    // echo $row_add_route['id'];
    if ($row_add_route['id'] != "") {
        ///// cek route ////
        $query_cek_rd = "SELECT * FROM LTP_route_detail where route_id='" . $row_add_route['id'] . "' && type='" . $row_cek['trip'] . "' GROUP by LTP_route_detail.id_grub order by id ASC";
        $rs_cek_rd = mysqli_query($con, $query_cek_rd);
        while ($row_cek_rd = mysqli_fetch_array($rs_cek_rd)) {
            // echo $query_cek_rd;
            if (isset($row_cek_rd['id'])) {
                
                $sql = "UPDATE LTP_route_detail SET adt='" . $adt . "',chd='" . $chd . "',inf='" . $inf . "',bagasi_price='" . $bagasi . "',bf='" . $bf . "',ln='" . $ln . "',dn='" . $dn . "' WHERE id='" . $row_cek_rd['id'] . "'";

                if (mysqli_query($con, $sql)) {
                    $sql_status_online = "UPDATE promo_flight_detail SET status='online' WHERE id='" . $row_cek['id'] . "'";
                    if (mysqli_query($con, $sql_status_online)) {
                        $online++;
                    } else {
                        $gagal++;
                    }
                    $berhasil++;
                } else {
                    $gagal++;
                }

                // echo "adt='" . $adt . "',chd='" . $chd . "',inf='" . $inf . "',bagasi_price='" . $bagasi . "',bf='" . $bf . "',ln='" . $ln . "'.dn='" . $dn . "' WHERE id='" . $row_cek_rd['id'] . "'</br>";
            } else {
                $sql_status = "UPDATE promo_flight_detail SET status='invalid' WHERE id='" . $row_cek['id'] . "'";
                if (mysqli_query($con, $sql_status)) {
                    $invalid++;
                } else {
                    $gagal++;
                }
                // echo "invalid : " . $row_cek['id'];
            }
        }
        // echo $query_cek_rd;
    }
}

echo "berhasil : " . $berhasil . ", ";
echo "gagal : " . $gagal . ", ";
echo "invalid : " . $invalid;
