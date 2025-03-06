
<?php
include "../db=connection.php";
include "fungsi_gethotel_price.php";
include "fungsi_profit_flight.php";
include "fungsi_feetl.php";
include "Api_LT_total_baru.php";
session_start();
// $id = "835-953-19";
$id = $_POST['paket'];
$mp_id = $_POST['id'];
if ($id != "") {
    $data = explode("-", $id);
    $date = date("Y-m-d");
    $staff =  $_SESSION['staff_id'];
    $copy_id = $data[0];
    $master_id = $data[1];
    $grub_id = $data[2];

    $query_ck = "SELECT * FROM Upload_tokopedia where mp_id='" . $mp_id . "' && master_id='" . $master_id . "' && copy_id='" . $copy_id . "' && grub_id='" . $grub_id . "'";
    $rs_ck = mysqli_query($con, $query_ck);
    $row_ck = mysqli_fetch_array($rs_ck);
    if ($row_ck == "") {

        $query_cek = "SELECT LTSUB_itin.id,LTSUB_itin.master_id,LTP_grub_flight.id AS grub_id,LTP_insert_sfee.id as sfee_id ,LTSUB_itin.hari,LTSUB_itin.judul,LT_change_judul.nama as change_judul,LTSUB_itin.landtour,LT_itinnew.city_in,LT_itinnew.city_out ,LTP_grub_flight.grub_name,LTP_insert_sfee.adt,LTP_insert_sfee.chd,LTP_insert_sfee.inf,login_staff.name as staff FROM LTSUB_itin LEFT JOIN login_staff ON LTSUB_itin.status=login_staff.id LEFT JOIN LT_itinnew ON LTSUB_itin.landtour=LT_itinnew.kode LEFT JOIN LTP_grub_flight ON LT_itinnew.city_in=LTP_grub_flight.city_in && LT_itinnew.city_out=LTP_grub_flight.city_out LEFT JOIN LT_change_judul ON LT_change_judul.grub_id=LTP_grub_flight.id && LT_change_judul.copy_id=LTSUB_itin.id LEFT JOIN LTP_insert_sfee ON LTP_grub_flight.id = LTP_insert_sfee.id_grub WHERE LTSUB_itin.id='" . $copy_id . "' && LTSUB_itin.master_id='" . $master_id . "' && LTP_grub_flight.id='" . $grub_id . "' GROUP BY LTP_insert_sfee.id order by id ASC";
        $rs_cek = mysqli_query($con, $query_cek);
        // var_dump($query_cek);
        $berhasil = 0;
        $gagal = 0;
        while ($row_cek = mysqli_fetch_array($rs_cek)) {

            $tgl_ber = "";
            $query_sfee_tgl = "SELECT tgl FROM LTP_tgl_sfee where sfee_id='" . $row_cek['sfee_id'] . "' order by tgl ASC limit 1";
            $rs_sfee_tgl = mysqli_query($con, $query_sfee_tgl);
            $row_sfee_tgl = mysqli_fetch_array($rs_sfee_tgl);
            $tgl_ber = "Start ON " . $row_sfee_tgl['tgl'];



            $query_cek_addhari = "SELECT  COUNT(hari) AS plus_hari FROM  LT_AH_Main where copy_id='" . $row_cek['id'] . "' && master_id='" . $row_cek['master_id'] . "' && sfee_id='" . $row_cek['sfee_id'] . "'";
            $rs_cek_addhari = mysqli_query($con, $query_cek_addhari);
            $row_cek_addhari = mysqli_fetch_array($rs_cek_addhari);
            $json_day = $row_cek['hari'] + $row_cek_addhari['plus_hari'];

            $data = [];
            $cek_hari = 1;
            $string_fl = "";
            $desc = "";
            for ($c = 1; $c <= $json_day; $c++) {


                $query_cek_hari = "SELECT  id ,hari,rute FROM  LT_AH_Main where copy_id='" . $row_cek['id'] . "' && master_id='" . $row_cek['master_id'] . "' && grub_id='" . $row_cek['grub_id'] . "' && hari='$c'";
                $rs_cek_hari = mysqli_query($con, $query_cek_hari);
                $row_cek_hari = mysqli_fetch_array($rs_cek_hari);

                if ($row_cek_hari['id'] != "") {

                    $rute =  $row_cek_hari['rute'];
                    $arr_tmp_list = [];

                    $queryTmp2 = "SELECT LT_AH_ListTempat.id,LT_AH_ListTempat.tempat,List_tempat.tempat2 FROM LT_AH_ListTempat LEFT JOIN List_tempat ON LT_AH_ListTempat.tempat=List_tempat.id where LT_AH_ListTempat.tour_id='" . $row_cek['id'] . "' && LT_AH_ListTempat.grub_id='" . $row_cek['grub_id'] . "' && LT_AH_ListTempathari='" . $c . "' order by urutan ASC";
                    $rsTmp2 = mysqli_query($con, $queryTmp2);
                    while ($rowTmp2 = mysqli_fetch_array($rsTmp2)) {
                        array_push($arr_tmp_list, $rowTmp2['tempat2']);
                    }

                    $arr_day = array(
                        "hari" => $c,
                        "rute" => $rute,
                        "tempat" => $arr_tmp_list

                    );
                    array_push($data, $arr_day);
                } else {


                    $queryRute = "SELECT * FROM  LT_add_rute where tour_id='" . $row_cek['master_id'] . "' && hari='" . $cek_hari . "'";
                    $rsRute = mysqli_query($con, $queryRute);
                    $rowRute = mysqli_fetch_array($rsRute);

                    $query_rute_hide = "SELECT * FROM LT_Rute where copy_id='" . $row_cek['id'] . "' && master_id='" . $row_cek['master_id'] . "' && grub_id='" . $row_cek['grub_id'] . "' && hari='" . $cek_hari . "'";
                    $rs_rute_hide = mysqli_query($con, $query_rute_hide);
                    $row_rute_hide = mysqli_fetch_array($rs_rute_hide);


                    if ($row_rute_hide['id'] == "") {
                        $rute =  $rowRute['nama'];
                    } else {
                        $rute = $row_rute_hide['nama'];
                    }

                    $desc .= "<div><b># Day " . $c . " " . $rute . "</b></div></br>";

                    $queryTmp = "SELECT LT_add_listTmp.id,LT_add_listTmp.tempat,List_tempat.tempat2 FROM LT_add_listTmp LEFT JOIN List_tempat ON LT_add_listTmp.tempat=List_tempat.id  where LT_add_listTmp.tour_id='" . $row_cek['master_id'] . "' && LT_add_listTmp.hari='" . $cek_hari . "' order by urutan ASC";
                    $rsTmp = mysqli_query($con, $queryTmp);
                    $arr_tmp_list = [];
                    while ($rowTmp = mysqli_fetch_array($rsTmp)) {
                        // array_push($arr_tmp_list, $rowTmp['tempat2']);
                        $desc .= "<div>   " . $rowTmp['tempat2'] . "</div></br>";
                    }

                    $cek_hari++;
                }

                $queryTR = "SELECT LT_add_transport_baru.id,LTP_route_detail.maskapai,LTP_route_detail.dept,LTP_route_detail.arr,LTP_route_detail.take,LTP_route_detail.landing FROM LT_add_transport_baru LEFT JOIN LTP_route_detail ON LT_add_transport_baru.transport=LTP_route_detail.id where master_id='" . $row_cek['master_id'] . "' && copy_id='" . $row_cek['id'] . "' && grub_id='" . $row_cek['grub_id'] . "' &&  hari='" .  $c . "' order by urutan ASC";
                $rsTR = mysqli_query($con, $queryTR);
                //  var_dump($queryTR);

                while ($rowTR = mysqli_fetch_array($rsTR)) {
                    if ($rowTR['id'] != "") {
                        $string_fl .= "<div>" . $rowTR['maskapai'] . " " . $rowTR['dept'] . " - " . $rowTR['arr'] . " (" . $rowTR['take'] . " - " . $rowTR['landing'] . ") </div></br>";
                    }
                }
            }


            $query_gf = "SELECT LTP_grub_flight_value.id,LTP_grub_flight_value.grub_id,LTP_grub_flight_value.flight_id,LTP_grub_flight_value.status,LTP_route_detail.adt,LTP_route_detail.chd,LTP_route_detail.inf,LT_add_roundtrip.adt as rt_adt,LT_add_roundtrip.chd as rt_chd,LT_add_roundtrip.inf as rt_inf FROM LTP_grub_flight_value LEFT JOIN LTP_route_detail ON LTP_grub_flight_value.flight_id=LTP_route_detail.id LEFT JOIN LT_add_roundtrip ON LTP_route_detail.route_id=LT_add_roundtrip.route_id where grub_id='" . $row_cek['grub_id'] . "' order by id ASC";
            $rs_gf_price = mysqli_query($con, $query_gf);
            $adt = 0;
            $chd = 0;
            $inf = 0;
            $x_gf = 1;
            // var_dump($query_gf);
            while ($row_price = mysqli_fetch_array($rs_gf_price)) {
                if ($row_price['status'] == '1') {
                    if ($x_gf == '1') {
                        $adt_rt = $row_cek['rt_adt'];
                        $chd_rt = $row_rt['rt_chd'];
                        $inf_rt = $row_rt['rt_inf'];
                    } else {
                        $adt_rt = 0;
                        $chd_rt = 0;
                        $inf_rt = 0;
                    }
                } else {
                    $adt_rt = $row_price['adt'];
                    $chd_rt = $row_price['chd'];
                    $inf_rt = $row_price['inf'];
                }
                // var_dump($adt_rt);
                $adt = $adt + $adt_rt;
                $chd = $chd + $chd_rt;
                $inf = $inf + $inf_rt;
                $x_gf++;
            }
            $flight_adt = $adt + $row_cek['adt'];
            $flight_chd = $adt + $row_cek['chd'];
            $flight_inf = $adt + $row_cek['inf'];

            // set profit flight
            $arr_profit = array(
                "adt" => $flight_adt,
                "chd" => $flight_chd,
                "inf" => $flight_inf
            );
            // var_dump($arr_profit);
            $show_profit = get_profit_flight($arr_profit);
            $result_profit = json_decode($show_profit, true);

            /// set hotel price
            $data_hotel = array(
                "copy_id" => $row_cek['id'],
                "master_id" => $row_cek['master_id'],
            );

            $show_hp = get_hotel_price($data_hotel);
            $result_hp = json_decode($show_hp, true);
            $string_hotel = "";
            foreach ($result_hp['hotel'] as $val_hotel) {
                $string_hotel .= "<div>" . $val_hotel . "</div>";
            }



            // var_dump($result_hp['twn']);

            //// set fee tl
            $data_feetl = array(
                "master_id" => $row_cek['master_id'],
                "copy_id" => $row_cek['id'],
                "grub_id" => $row_cek['grub_id'],
                "hotel_id" =>  $result_hp['id_hotel']
            );
            $show_feetl = feeTL($data_feetl);
            $result_feetl = json_decode($show_feetl, true);
            // var_dump($result_feetl['adt']);

            //// get value grandtotal tanpa tiket pesawat 
            $query_inc = "SELECT * FROM LT_include_checkbox where tour_id='" . $row_cek['id'] . "' && master_id='" . $row_cek['master_id'] . "'";
            $rs_inc = mysqli_query($con, $query_inc);
            $row_inc = mysqli_fetch_array($rs_inc);

            $query_include = explode(",", $row_inc['chck']);
            $grandtotal = 0;
            foreach ($query_include as $check) {
                if ($check != '1' && $check != '15' && $check != '17' && $check != '32') {
                    $data_tps = array(
                        "master_id" => $row_cek['master_id'],
                        "copy_id" => $row_cek['id'],
                        "check_id" => $check
                    );
                    // var_dump($data_tps);

                    $show_tps = get_total($data_tps);
                    $result_tps = json_decode($show_tps, true);
                    $grandtotal = $grandtotal + $result_tps['adt'];
                }
            }
            // var_dump($grandtotal);


            // set grandtotal
            $total_manual_adt =  $result_profit['adt'] + $result_hp['twn'] + $result_feetl['adt'] + $grandtotal + $result_hp['adm_tokped_twn'];
            $total_manual_chd =  $result_profit['chd'] + $result_hp['cnb'] + $result_feetl['adt'] + $grandtotal + $result_hp['adm_tokped_cnb'];
            $total_manual_inf =  $result_profit['inf'] + $result_hp['inf'] + $result_feetl['adt'] + $grandtotal + $result_hp['adm_tokped_inf'];
            $total_manual_sgl =  $result_profit['adt'] + $result_hp['sgl'] + $result_feetl['adt']  + $grandtotal + $result_hp['adm_tokped_sgl'];

            // pembulatan
            $twn_sp = get_pembulatan($total_manual_adt);
            $twn_rp = json_decode($twn_sp, true);

            $sgl_sp = get_pembulatan($total_manual_sgl);
            $sgl_rp = json_decode($sgl_sp, true);

            $cnb_sp = get_pembulatan($total_manual_chd);
            $cnb_rp = json_decode($cnb_sp, true);

            $inf_sp = get_pembulatan($total_manual_inf);
            $inf_rp = json_decode($inf_sp, true);


            // echo $desc;
            // echo "</br>";
            // echo "FLIGHT";
            // echo $string_fl;
            // echo "</br>";
            // echo "HOTEL";
            // echo $string_hotel;
            // echo "</br>";

            $detail  = $desc . "</br></br>" . "FLIGHT</br>" . $string_fl . "</br></br>" . "HOTEL</br>" . $string_hotel . "</br>";

            if ($total_manual_adt != 0) {
                $judul = $row_cek['judul'] . " " . $row_cek['grub_name'] . " " . $tgl_ber;
                if ($row_cek['change_judul'] != null) {
                    $judul = $row_cek['change_judul'] . " " . $row_cek['grub_name'] . " " . $tgl_ber;
                }

                $sku = "ADT-" . $row_cek['master_id'] . $row_cek['id'] . $row_cek['sfee_id'];

                $sql = "INSERT INTO Upload_tokopedia VALUES ('','" . $mp_id . "','" . $row_cek['master_id'] . "','" . $row_cek['id'] . "','" . $row_cek['grub_id'] . "','" . $row_cek['sfee_id'] . "','" . $judul . "','" . $detail . "','4583','10','1','34655567','30','Baru','','','','','','','','','" . $sku . "','Aktif','50','" . $twn_rp['value'] . "','50','Opsional','Adult')";
                // var_dump($sql);
                if (mysqli_query($con, $sql)) {
                    $berhasil++;
                } else {
                    $gagal++;
                }
            }
            if ($total_manual_chd != 0) {
                $judul = $row_cek['judul'] . " " . $row_cek['grub_name'] . " " . $tgl_ber;
                if ($row_cek['change_judul'] != null) {
                    $judul = $row_cek['change_judul'] . " " . $row_cek['grub_name'] . " " . $tgl_ber;
                }

                $sku = "CNB-" . $row_cek['master_id'] . $row_cek['id'] . $row_cek['sfee_id'];

                $sql2 = "INSERT INTO Upload_tokopedia VALUES ('','" . $mp_id . "','" . $row_cek['master_id'] . "','" . $row_cek['id'] . "','" . $row_cek['grub_id'] . "','" . $row_cek['sfee_id'] . "','" . $judul . "','" . $detail . "','4583','10','1','34655567','30','Baru','','','','','','','','','" . $sku . "','Aktif','50','" . $cnb_rp['value'] . "','50','Opsional','Children')";
                // var_dump($sql);
                if (mysqli_query($con, $sql2)) {
                    $berhasil++;
                } else {
                    $gagal++;
                }
            }
            if ($total_manual_inf != 0) {
                $judul = $row_cek['judul'] . " " . $row_cek['grub_name'] . " " . $tgl_ber;
                if ($row_cek['change_judul'] != null) {
                    $judul = $row_cek['change_judul'] . " " . $row_cek['grub_name'] . " " . $tgl_ber;
                }

                $sku = "INF-" . $row_cek['master_id'] . $row_cek['id'] . $row_cek['sfee_id'];

                $sql3 = "INSERT INTO Upload_tokopedia VALUES ('','" . $mp_id . "','" . $row_cek['master_id'] . "','" . $row_cek['id'] . "','" . $row_cek['grub_id'] . "','" . $row_cek['sfee_id'] . "','" . $judul . "','" . $detail . "','4583','10','1','34655567','30','Baru','','','','','','','','','" . $sku . "','Aktif','50','" . $inf_rp['value'] . "','50','Opsional','Infant')";
                // var_dump($sql);
                if (mysqli_query($con, $sql3)) {
                    $berhasil++;
                } else {
                    $gagal++;
                }
            }
            if ($total_manual_sgl != 0) {
                $judul = $row_cek['judul'] . " " . $row_cek['grub_name'] . " " . $tgl_ber;
                if ($row_cek['change_judul'] != null) {
                    $judul = $row_cek['change_judul'] . " " . $row_cek['grub_name'] . " " . $tgl_ber;
                }

                $sku = "SGL-" . $row_cek['master_id'] . $row_cek['id'] . $row_cek['sfee_id'];

                $sql4 = "INSERT INTO Upload_tokopedia VALUES ('','" . $mp_id . "','" . $row_cek['master_id'] . "','" . $row_cek['id'] . "','" . $row_cek['grub_id'] . "','" . $row_cek['sfee_id'] . "','" . $judul . "','" . $detail . "','4583','10','1','34655567','30','Baru','','','','','','','','','" . $sku . "','Aktif','50','" . $sgl_rp['value'] . "','50','Opsional','Single')";
                // var_dump($sql);
                if (mysqli_query($con, $sql4)) {
                    $berhasil++;
                } else {
                    $gagal++;
                }
            }
        }
        echo "Berhasil : " . $berhasil;
    } else {
        echo "Paket Sudah digunakan dalam Package ini !";
    }

} else {
    echo "data ID tidak tersedia";
}
?>