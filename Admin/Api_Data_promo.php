<?php
function get_datapromo($x){
    include "../db=connection.php";
    include "Api_LT_total.php";
    $query_data = "SELECT * FROM  DP_ptsub where cabang='".$x."' order by id ASC";
    $rs_data = mysqli_query($con, $query_data);
     $data_arr = [];
    while ($row_data = mysqli_fetch_array($rs_data)) {
        $arr = [];
        $arr_chck = json_decode($row_data['chck'], true);
        $total_twn = 0;
        $total_sgl = 0;
        $total_inf = 0;
        $total_chd  = 0;

        // foreach ($arr_chck as $check) {
        //     if ($check != '15') {
        //         $data_tps = array(
        //             "master_id" => $row_data['master_id'],
        //             "copy_id" => $row_data['copy_id'],
        //             "check_id" => $check,
        //         );

        //         $show_tps = get_total($data_tps);
        //         $result_tps = json_decode($show_tps, true);

        //         $total_twn = $total_twn + $result_tps['adt'];
        //         $total_sgl = $total_sgl + $result_tps['sgl'];
        //         $total_chd = $total_chd + $result_tps['chd'];
        //         $total_inf = $total_inf + $result_tps['inf'];
        //     }
        // }

        $query = "SELECT LT_itinerary2.tgl, login_staff.name FROM LT_itinerary2 INNER JOIN login_staff ON LT_itinerary2.status = login_staff.id WHERE LT_itinerary2.id=" . $row_data['master_id'];
        $rs = mysqli_query($con, $query);
        $row = mysqli_fetch_array($rs);
        $tgl = $row['tgl'];
        $staff = $row['name'];

        $queryStaff2 = "SELECT name FROM  login_staff WHERE id=" . $row_data['status'];
        $rsStaff2 = mysqli_query($con, $queryStaff2);
        $rowStaff2 = mysqli_fetch_array($rsStaff2);
        $staff2 = $rowStaff2['name'];


        $query_sub = "SELECT landtour,judul FROM  LTSUB_itin where  id =" . $row_data['copy_id'];
        $rs_sub = mysqli_query($con, $query_sub);
        $row_sub = mysqli_fetch_array($rs_sub);
        if ($row_sub['landtour'] != "undefined") {
            // get id lt_itinnew
            $query_hotel = "SELECT hotel_id FROM LT_select_PilihHTL WHERE master_id='" . $row_data['master_id'] . "' && copy_id='" . $row_data['copy_id'] . "' order by id ASC limit 1";
            $rs_hotel = mysqli_query($con, $query_hotel);
            $row_hotel = mysqli_fetch_array($rs_hotel);
            if ($row_hotel['id'] != "") {

                $query_itin = "SELECT * FROM LT_itinnew WHERE id=" . $row_hotel['hotel_id'];
                $rs_itin = mysqli_query($con, $query_itin);
                $row_itin = mysqli_fetch_array($rs_itin);
                if ($row_itin['id'] != "") {
                    $sql_profit = "SELECT id,profit FROM LT_itin_profit_range where price1 <='" . $row_itin['agent_twn'] . "' && price2 >='" . $row_itin['agent_twn'] . "'";
                    $rs_profit = mysqli_query($con, $sql_profit);
                    $row_profit = mysqli_fetch_array($rs_profit);

                    $pr = 0;
                    if ($row_profit['id'] != "") {
                        $pr = $row_profit['profit'];
                    } else {
                        $pr = 5;
                    }
                    $twin = ($row_itin['agent_twn'] * $pr / 100) + $row_itin['agent_twn'];
                    $chd = ($row_itin['agent_cnb'] * $pr / 100) + $row_itin['agent_cnb'];
                    $inf = ($row_itin['agent_inf'] * $pr / 100) + $row_itin['agent_inf'];
                    $sgl = ($row_itin['agent_sgl'] * $pr / 100) + $row_itin['agent_sgl'];

                    $grand_twn = $total_twn +  $twin + $row_data['l_twn'];
                    $grand_sgl = $total_sgl +  $sgl + $row_data['l_sgl'];
                    $grand_cnb = $total_chd +  $chd + $row_data['l_cnb'];
                    $grand_inf = $total_inf +  $inf + $row_data['l_inf'];

                    $arr['code'] = $row_itin['kode'];
                    $arr['negara'] = $row_itin['negara'];
                    $arr['kota'] = $row_itin['kota'];
                    $arr['judul'] = $row_itin['judul'];
                    $arr['start_pax'] = $row_itin['pax'];
                    $arr['until_pax'] = $row_itin['pax_u'];
                    $arr['bonus_pax'] = $row_itin['pax_b'];
                    $arr['price'] = $grand_twn;
                    $arr['sgl'] = $grand_sgl;
                    $arr['cnb'] = $grand_cnb;
                    $arr['inf'] = $grand_inf;
                }
            }
        } else {
            $query_nc_hotel = "SELECT hotel_twin FROM  LT_select_PilihHTLNC  where copy_id = '" . $row_data['copy_id'] . "' && master_id='" . $row_data['master_id'] . "' order by hari ASC";
            $rs_nc_hotel = mysqli_query($con, $query_nc_hotel);
            $ht_twin = 0;
            while ($row_nc_hotel = mysqli_fetch_array($rs_nc_hotel)) {
                $ht_twin = $ht_twin + $row_nc_hotel['hotel_twin'];
            }
            $grand_twn = $total_twn + $ht_twin + $row_data['l_twn'];
            $grand_sgl = $total_sgl + $ht_twin + $row_data['l_sgl'];
            $grand_cnb = $total_chd + 0 + $row_data['l_cnb'];
            $grand_inf = $total_inf + 0 + $row_data['l_inf'];

            $arr['code'] = "No Code";
            $arr['negara'] = "";
            $arr['judul'] = $row_sub['judul'];
            $arr['start_pax'] = '';
            $arr['until_pax'] = '';
            $arr['bonus_pax'] = '';
            $arr['price'] = $grand_twn;
            $arr['sgl'] = $grand_sgl;
            $arr['cnb'] = $grand_cnb;
            $arr['inf'] = $grand_inf;
        }

        $arr['id'] = $row_data['id'];
        $arr['copy_id'] = $row_data['copy_id'];
        $arr['master_id'] = $row_data['master_id'];
        $arr['link'] = '';
        $arr['link_itin'] = $link;
        $arr['flayer_maker'] = $staff;
        $arr['tgl'] = $tgl;
        $arr['exp'] = $expired;
        $arr['sc'] = $staff2;
        $arr['c_twn'] = $row_data['c_twn'];
        $arr['l_twn'] = $row_data['l_twn'];
        $arr['include'] = $arr_in;
        $arr['exclude'] = $arr_ex;
        $arr['hl'] = $arr_hl;
        $arr['fl'] = $plane;

        array_push($data_arr, $arr);
    }
    $keys = array_column($data_arr, 'negara');
    array_multisort($keys, SORT_ASC, $data_arr);
     return json_encode(array("data" => $data_arr, "status" => "berhasil"), true);
}
?>
