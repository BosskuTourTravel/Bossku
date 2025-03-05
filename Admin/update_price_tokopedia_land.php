<?php
include "../db=connection.php";
include "Api_LT_total_baru.php";
session_start();

$mp_id =  $_POST['id'];
// $mp_id = '1';

$berhasil = 0;
$gagal = 0;
$query = "SELECT * FROM Upload_tokopedia_land where mp_id='" . $mp_id . "' ORDER BY id ASC limit 300";
$rs = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($rs)) {

    $query_itin = "SELECT * FROM  LT_itinerary2 where id=" . $row['master_id'];
    $rs_itin = mysqli_query($con, $query_itin);
    $row_itin = mysqli_fetch_assoc($rs_itin);
    $json_day = $row_itin['hari'];

    $query_lt2 = "SELECT * FROM  LT_itinnew where kode = '" . $row['kode'] . "' && no_urut='" .  $row['urutan'] . "' order by no_urut ASC";
    $rs_lt2 = mysqli_query($con, $query_lt2);
    $no = 1;
    while ($row_lt2 = mysqli_fetch_array($rs_lt2)) {
        $desc = "";
        $hotel = "<ul>";
        if ($row_lt2['hotel1'] != "") {
            $hotel .= "<li>" . $row_lt2['hotel1'] . "</li>";
        }
        if ($row_lt2['hotel2'] != "") {
            $hotel .= "<li>" . $row_lt2['hotel2'] . "</li>";
        }
        if ($row_lt2['hotel3'] != "") {
            $hotel .= "<li>" . $row_lt2['hotel3'] . "</li>";
        }
        if ($row_lt2['hotel4'] != "") {
            $hotel .= "<li>" . $row_lt2['hotel4'] . "</li>";
        }
        if ($row_lt2['hotel5'] != "") {
            $hotel .= "<li>" . $row_lt2['hotel5'] . "</li>";
        }
        if ($row_lt2['hotel6'] != "") {
            $hotel .= "<li>" . $row_lt2['hotel6'] . "</li>";
        }
        if ($row_lt2['hotel7'] != "") {
            $hotel .= "<li>" . $row_lt2['hotel7'] . "</li>";
        }
        if ($row_lt2['hotel8'] != "") {
            $hotel .= "<li>" . $row_lt2['hotel8'] . "</li>";
        }
        if ($row_lt2['hotel9'] != "") {
            $hotel .= "<li>" . $row_lt2['hotel9'] . "</li>";
        }
        if ($row_lt2['hotel10'] != "") {
            $hotel .= "<li>" . $row_lt2['hotel10'] . "</li>";
        }
        $hotel .= "</ul><br>";
        for ($c = 1; $c <= $json_day; $c++) {
            $queryRute = "SELECT * FROM  LT_add_rute where tour_id='" . $row_itin['id'] . "' && hari='" . $c . "'";
            $rsRute = mysqli_query($con, $queryRute);
            $rowRute = mysqli_fetch_array($rsRute);
            $rute =  $rowRute['nama'];
            $desc .= "<div><b># Day " . $c . " " . $rute . "</b></div></br>";

            $queryTmp = "SELECT LT_add_listTmp.id,LT_add_listTmp.tempat,List_tempat.tempat2 FROM LT_add_listTmp LEFT JOIN List_tempat ON LT_add_listTmp.tempat=List_tempat.id  where LT_add_listTmp.tour_id='" . $row_itin['id'] . "' && LT_add_listTmp.hari='" . $c . "' order by urutan ASC";
            $rsTmp = mysqli_query($con, $queryTmp);
            $arr_tmp_list = [];
            while ($rowTmp = mysqli_fetch_array($rsTmp)) {
                $desc .= "<div>   " . $rowTmp['tempat2'] . "</div></br>";
            }
        }
        $detail = $desc . "<br>" . $hotel;

        $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $row_lt2['agent_twn'] . "' && price2 >='" . $row_lt2['agent_twn'] . "'";
        $rs_profit = mysqli_query($con, $sql_profit);
        $row_profit = mysqli_fetch_array($rs_profit);

        $pr = 0;
        if ($row_profit['id'] != "") {
            $pr = $row_profit['profit'];
        } else {
            $pr = 5;
        }

        $adm_tokped_twn = $row_lt2['agent_twn'] * $row_profit['adm_tokped'] / 100;
        $adm_tokped_sgl = $row_lt2['agent_sgl'] * $row_profit['adm_tokped'] / 100;
        $adm_tokped_cnb = $row_lt2['agent_cnb'] * $row_profit['adm_tokped'] / 100;
        $adm_tokped_inf = $row_lt2['agent_inf'] * $row_profit['adm_tokped'] / 100;


        $twin = ($row_lt2['agent_twn'] * $pr / 100) + $row_lt2['agent_twn'] + $adm_tokped_twn;
        $chd = ($row_lt2['agent_cnb'] * $pr / 100) + $row_lt2['agent_cnb'] + $adm_tokped_cnb;
        $inf = ($row_lt2['agent_inf'] * $pr / 100) + $row_lt2['agent_inf'] + $adm_tokped_inf;
        $sgl = ($row_lt2['agent_sgl'] * $pr / 100) + $row_lt2['agent_sgl'] + $adm_tokped_sgl;

        $twn_sp = get_pembulatan($twin);
        $twn_rp = json_decode($twn_sp, true);

        $sgl_sp = get_pembulatan($sgl);
        $sgl_rp = json_decode($sgl_sp, true);

        $cnb_sp = get_pembulatan($chd);
        $cnb_rp = json_decode($cnb_sp, true);

        $inf_sp = get_pembulatan($inf);
        $inf_rp = json_decode($inf_sp, true);

        if ($row['varian'] == "Twin") {

            $sql = "UPDATE Upload_tokopedia_land SET deskripsi='" . $detail . "',Harga='" . $twn_rp['value'] . "' WHERE id='" . $row['id'] . "'";
            if (mysqli_query($con, $sql)) {
                $berhasil++;
            } else {
                $gagal++;
            }
        } else if ($row['varian'] == "Child No Bed") {
            $sql = "UPDATE Upload_tokopedia_land SET deskripsi='" . $detail . "',Harga='" . $cnb_rp['value'] . "' WHERE id='" . $row['id'] . "'";
            if (mysqli_query($con, $sql)) {
                $berhasil++;
            } else {
                $gagal++;
            }

        } else if ($row['varian'] == "Infant") {
            $sql = "UPDATE Upload_tokopedia_land SET deskripsi='" . $detail . "',Harga='" . $inf_rp['value'] . "' WHERE id='" . $row['id'] . "'";
            if (mysqli_query($con, $sql)) {
                $berhasil++;
            } else {
                $gagal++;
            }
        } else if ($row['varian'] == "Single") {
            $sql = "UPDATE Upload_tokopedia_land SET deskripsi='" . $detail . "',Harga='" . $sgl_rp['value'] . "' WHERE id='" . $row['id'] . "'";
            if (mysqli_query($con, $sql)) {
                $berhasil++;
            } else {
                $gagal++;
            }
        } else {
        }
    }
}
echo "Update Berhasil :" . $berhasil . " Gagal :" . $gagal;
