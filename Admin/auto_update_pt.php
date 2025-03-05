<?php
include "../db=connection.php";
include "Api_LT_total_baru.php";
include "fungsi_gethotel_price.php";
include "fungsi_profit_flight.php";
include "fungsi_feetl.php";
include "fungsi_forLT.php";


$berhasil = 0;
$gagal = 0;
$id_kosong = 0;
$query = "SELECT * FROM paket_tour_online  order by id ASC";
$rs = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($rs)) {
    // inisialisasi
    $chck = [];
    $adm_inc = [];
    $adm_ex = [];
    $no = 1;
    $grandtotal = 0;
    $hotel_id = 0;
    $include = [];
    $query_include = [];

    $query_data = "SELECT * FROM  LTSUB_itin where id=" . $row['tour_id'];
    $rs_data = mysqli_query($con, $query_data);
    $row_data = mysqli_fetch_array($rs_data);
    // var_dump($query_data);
    $ces = "";
    if (isset($row_data['id'])) {

        $query_inc = "SELECT * FROM LT_include_checkbox where tour_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "'";
        $rs_inc = mysqli_query($con, $query_inc);
        $row_inc = mysqli_fetch_array($rs_inc);
        if (isset($row_inc['id'])) {
            $query_include = explode(",", $row_inc['chck']);
        }
        // var_dump($query_inc);

        $query_adm = "SELECT * FROM tour_adm_chck where tour_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "'";
        $rs_adm = mysqli_query($con, $query_adm);
        $row_adm = mysqli_fetch_array($rs_adm);
        if (isset($row_adm['id'])) {
            $include = explode(",", $row_adm['include']);
        }
        // var_dump($include);

            $query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $row['grub_id'] . "' order by id ASC";
            // $rs_gf = mysqli_query($con, $query_gf);
            $rs_gf_price = mysqli_query($con, $query_gf);
            // var_dump($query_gf);

            foreach ($query_include as $check) {
                $query_chck = "SELECT * FROM  checkbox_include2 where id=" . $check;
                $rs_chck = mysqli_query($con, $query_chck);
                $row_chck = mysqli_fetch_array($rs_chck);
                // var_dump($query_chck);

                if ($check == '1') {
                    // get value price flight
                    $adt = 0;
                    $chd = 0;
                    $inf = 0;
                    $x_gf = 1;
                    while ($row_price = mysqli_fetch_array($rs_gf_price)) {

                        $query_detail2 = "SELECT * FROM  LTP_route_detail where id='" . $row_price['flight_id'] . "'";
                        $rs_detail2 = mysqli_query($con, $query_detail2);
                        $row_detail2 = mysqli_fetch_array($rs_detail2);


                        $query_rt = "SELECT * FROM  LT_add_roundtrip where route_id='" .  $row_detail2['route_id'] . "'";
                        $rs_rt = mysqli_query($con, $query_rt);
                        $row_rt = mysqli_fetch_array($rs_rt);

                        if ($row_price['status'] == '1') {
                            if ($x_gf == '1') {
                                $adt_rt = $row_rt['adt'];
                                $chd_rt = $row_rt['chd'];
                                $inf_rt = $row_rt['inf'];
                            } else {
                                $adt_rt = 0;
                                $chd_rt = 0;
                                $inf_rt = 0;
                            }
                        } else {
                            $adt_rt = $row_detail2['adt'];
                            $chd_rt = $row_detail2['chd'];
                            $inf_rt = $row_detail2['inf'];
                        }
                        // var_dump($adt_rt);
                        $adt = $adt + $adt_rt;
                        $chd = $chd + $chd_rt;
                        $inf = $inf + $inf_rt;
                        $x_gf++;
                    }
                    $query_grub = "SELECT LTP_grub_flight.id,LTP_grub_flight.grub_name,LTP_insert_sfee.date_set,LTP_insert_sfee.id as sfee_id,LTP_insert_sfee.adt,LTP_insert_sfee.chd,LTP_insert_sfee.inf,LTP_insert_sfee.ket,LTP_insert_sfee.tgl as tgl_buat FROM LTP_grub_flight INNER JOIN LTP_insert_sfee ON LTP_grub_flight.id = LTP_insert_sfee.id_grub where LTP_grub_flight.id='" . $row['grub_id'] . "'  && LTP_insert_sfee.id='" . $row['sfee_id'] . "'";
                    $rs_grub = mysqli_query($con, $query_grub);
                    $row_grub = mysqli_fetch_array($rs_grub);
                    
                    if (isset($row_grub['id'])) {
                        $adt = $adt + $row_grub['adt'];
                        $chd = $chd + $row_grub['chd'];
                        $inf = $inf + $row_grub['inf'];
                    }
                    // var_dump($query_detail2);
                    $arr_profit = array(
                        "adt" => $adt,
                        "chd" => $chd,
                        "inf" => $inf
                    );
                    // var_dump($arr_profit);
                    $show_tps = get_profit_flight($arr_profit);
                    $result_tps = json_decode($show_tps, true);
                    $grandtotal = $grandtotal + $result_tps['adt'];
                    // var_dump($result_tps['adt']);

                    $ces .= " + ".$check." ".$result_tps['adt'];

                    ///////////////////////////////////////
                } else if ($check == '15') {

                    $data_hotel = array(
                        "hotel_id" => $row['hotel_id'],
                        "pax" => $row['pax_tour'],
                    );
                    
                    $show_hp = get_hotel_one($data_hotel);
                    if($show_hp){
                        $result_hp = json_decode($show_hp, true);
                        $hotel_id =  $result_hp['id_hotel'];
                        $grandtotal = $grandtotal + $result_hp['twn'];
                    }
                    $ces .= " + ".$check." ".$result_hp['twn'];
                    
                } else if ($check == '17') {
                    $show_tps = get_adm_price($include);
                    if($show_tps){
                        $result_tps = json_decode($show_tps, true);
                        $grandtotal = $grandtotal + $result_tps['adt'];
                        // var_dump($result_tps);

                    }
                    $ces .= " + ".$check." ".$result_tps['adt'];
                } else if ($check == '32') {
                    $fee_tl = 0;
                    if ($row['tl_fee'] != 0) {
                        $data_feetl = array(
                            "master_id" => $row_data['master_id'],
                            "copy_id" => $row_data['id'],
                            "grub_id" => $row['grub_id'],
                            "hotel_id" =>  $hotel_id,
                            "tl_fee" => $row['tl_fee'],
                            "tl_meal" => $row['tl_meal'],
                            "tl_tlpn" => $row['tl_tlpn'],
                            "tl_sfee" => $row['tl_sfee'],
                        );
                       

                        $show_feetl = feeTL_custom($data_feetl);
                        if ($show_feetl) {
                            $result_tps = json_decode($show_feetl, true);
                            if ($row['tl_pax'] != 0) {
                                $fee_tl = $fee_tl + (intval($result_tps['custom']) / intval($row['tl_pax']));
                            }
                        }
                        
                    } else {
                        $data_feetl = array(
                            "master_id" => $row_data['master_id'],
                            "copy_id" => $row_data['id'],
                            "grub_id" => $row['grub_id'],
                            "hotel_id" =>  $hotel_id
                        );
                        // var_dump($data_feetl);
                        $show_feetl2 = feeTL($data_feetl);
                        if ($show_feetl2) {
                            $result_tps2 = json_decode($show_feetl2, true);
                            $fee_tl = $fee_tl + intval($result_tps2['adt']);
                        }
                    }
                    $grandtotal = $grandtotal + $fee_tl;
                    $ces .= " + ".$check." ".$fee_tl;
                    // var_dump($grandtotal);
                } else if ($check == '55') {
                    $data_tps = array(
                        "master_id" => $row_data['master_id'],
                        "copy_id" => $row_data['id'],
                        "grub_id" => $row['grub_id'],
                        "sfee_id" => $row['sfee_id']
                    );
                    // var_dump($data_tps);

                    $show_tps = get_hotel_forLT($data_tps);
                    if($show_tps){
                        $result_tps = json_decode($show_tps, true);
                        $ph = $result_tps['adt'] / 2;
                        $grandtotal = $grandtotal + $ph;
                    }
                    $ces .= " + ".$check." ".$ph;
                    // var_dump($result_tps['adt']." - ".$ph);
                    // var_dump($result_tps);

                } else {
                    $data_tps = array(
                        "master_id" => $row_data['master_id'],
                        "copy_id" => $row_data['id'],
                        "grub_id" => $row['grub_id'],
                        "check_id" => $check
                    );


                    $show_tps = get_total($data_tps);
                    if ($show_tps) {
                        $result_tps = json_decode($show_tps, true);
                        $grandtotal = intval($grandtotal) + intval($result_tps['adt']);
                    }
                    $ces .= " + ".$check." ".intval($result_tps['adt']);
                    // if($check =='23'){
                    //     echo $result_tps['adt'];
                    // }


                }
                // var_dump($grandtotal."</br>");
            }
            $grandtotal = intval($grandtotal) + intval($row['ltwn']);
            $grand_adt = get_pembulatan($grandtotal);
            if($grand_adt){
                $grand_adt_val = json_decode($grand_adt, true);
                $hasil = isset($grand_adt_val['value']) ? $grand_adt_val['value'] : 0;
                $sql = "UPDATE paket_tour_online SET gt='" . $hasil . "' WHERE id='" . $row['id'] . "'";
                if (mysqli_query($con, $sql)) {
                    $berhasil++;
                } else {
                    $gagal++;
                }

                //  echo "ID ".$row['id']." PAX :".$row['pax_tour']." = ".$hasil . "</br>";
            }
           
            
        // }
    } else {
        $id_kosong++;
    }
    // echo "</br>".$ces;
}
$con->close();
echo "Berhasil : " . $berhasil . " - Gagal : " . $gagal . " - ID Kosong : " . $id_kosong;
