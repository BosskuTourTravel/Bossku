<?php
include "../db=connection.php";
include "Api_LT_total_baru.php";


$query_rent2 = "SELECT Rent_selected.id ,Rent_selected.id_package,Rent_selected.id_trans,Rent_selected.id_agent,Rent_selected.trans_type,Rent_selected.seat,Rent_selected.country,Rent_selected.city,Rent_selected.periode,Rent_selected.tipe,Rent_selected.kurs,Rent_selected.price,Rent_selected.status,agent_transport.name as agent FROM Rent_selected LEFT JOIN agent_transport ON Rent_selected.id_agent=agent_transport.id where Rent_selected.id_package=" . $_POST['id'] . "  order by Rent_selected.id ASC";
$rs_rent2 = mysqli_query($con, $query_rent2);
$gt_rent = 0;
while ($row_rent2 = mysqli_fetch_array($rs_rent2)) {
    $datareq = array(
        "kurs" =>  $row_rent2['kurs'],
        "nominal" => $row_rent2['price'],
    );
    $adt_kurs = get_kurs($datareq);
    $rs_adt_kurs = json_decode($adt_kurs, true);
    $gt_rent = $gt_rent + $rs_adt_kurs['data'];
}
$bagi = $_POST['pax'] - $_POST['pilihan'];
$total =  $gt_rent / $bagi;



$query_hotel_data = "SELECT * FROM LAN_Hotel_List WHERE master_id='" . $_POST['package'] . "'";
$rs_hotel_data = mysqli_query($con, $query_hotel_data);
$gprice = 0;
// var_dump($query_hotel_data);
$arr_hotel = [];
while ($row_hotel_data = mysqli_fetch_array($rs_hotel_data)) {
    $query_hlt = "SELECT * FROM hotel_lt where id='" . $row_hotel_data['hotel_id'] . "'";
    $rs_hlt = mysqli_query($con, $query_hlt);
    $row_hlt = mysqli_fetch_array($rs_hlt);

    $detail = "* " . $row_hlt['class'] . " " . $row_hlt['name'];
    array_push($arr_hotel, $detail);


    if ($row_hotel_data['rate'] == '1') {
        $data = array(
            "kurs" =>  $row_hlt['kurs'],
            "price" => $row_hlt['rate_low'],
        );
        $show_rate2 = get_rate($data);
        $result_rate2 = json_decode($show_rate2, true);

        // $gt = $gt + $result_rate2['price'];
        $price = $result_rate2['price'];
        // $gprice = $gprice + ($price /2);
    } else {
        $data = array(
            "kurs" =>  $row_hlt['kurs'],
            "price" => $row_hlt['rate_high'],
        );
        $show_rate2 = get_rate($data);
        $result_rate2 = json_decode($show_rate2, true);


        // $gt = $gt + $result_rate2['price'];
        $price = $result_rate2['price'];
    }
    $gprice = $gprice + $price;
}
$val_hotel = $gprice / 2;
$val_hotel_sgl = $hotel_price;

$query_guide2 = "SELECT * FROM  LT_add_guide_price  where tour_id='" . $_POST['package'] . "' && package_id='" . $_POST['id'] . "'";
$rs_guide2 = mysqli_query($con, $query_guide2);
// var_dump($query_guide2);
$n = 1;
$grand_guide2 = 0;
while ($row_guide2 = mysqli_fetch_array($rs_guide2)) {
    $query_fee2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['fee'] . "'";
    $rs_fee2 = mysqli_query($con, $query_fee2);
    $row_fee2 = mysqli_fetch_array($rs_fee2);

    $query_sfee2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['sfee'] . "'";
    $rs_sfee2 = mysqli_query($con, $query_sfee2);
    $row_sfee2 = mysqli_fetch_array($rs_sfee2);

    $query_bf2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['bf'] . "'";
    $rs_bf2 = mysqli_query($con, $query_bf2);
    $row_bf2 = mysqli_fetch_array($rs_bf2);

    $query_ln2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['ln'] . "'";
    $rs_ln2 = mysqli_query($con, $query_ln2);
    $row_ln2 = mysqli_fetch_array($rs_ln2);

    $query_dn2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['dn'] . "'";
    $rs_dn2 = mysqli_query($con, $query_dn2);
    $row_dn2 = mysqli_fetch_array($rs_dn2);

    $query_vt2 = "SELECT * FROM Guide_Meal where id='" . $row_guide2['vt'] . "'";
    $rs_vt2 = mysqli_query($con, $query_vt2);
    $row_vt2 = mysqli_fetch_array($rs_vt2);

    $guide_total2 = $row_fee2['harga'] + $row_sfee2['harga'] + $row_bf2['harga'] + $row_ln2['harga'] + $row_dn2['harga'] + $row_vt2['harga'];
    $grand_guide2 = $grand_guide2 + $guide_total2;
}
$val_guide = $grand_guide2 / $bagi;

$gt = $total + $val_hotel + $val_guide;
$gt_sgl = $rent_price + $val_hotel_sgl + $val_guide;
$gt_cnb = $rent_price + $val_guide;
$gt_inf = $val_guide;
$kode = $_POST['code'];
$agent = "Performa";
$benua = $_POST['continent'];
$negara = $_POST['country'];
$kota = $_POST['city'];
$judul = $_POST['title'];
$kurs = "IDR";
$pax = $_POST['pax'];
$hotel1 = $arr_hotel[0];
$hotel2 = $arr_hotel[1];
$hotel3 = $arr_hotel[2];
$hotel4 = $arr_hotel[3];
$hotel5 = $arr_hotel[4];
$hotel6 = $arr_hotel[5];
$hotel7 = $arr_hotel[6];
$hotel8 = $arr_hotel[7];
$hotel9 = $arr_hotel[8];
$hotel10 = $arr_hotel[9];
$city_in = $_POST['cityin'];
$city_out = $_POST['cityout'];
$tgl_brkt = $_POST['depature'];

$sql = "INSERT INTO LT_itinnew VALUES ('','$date','$kode','$no_urut','$agent','$benua','$negara','$kota','$judul','$kurs','$pax','$pax_u','$pax_b','$twn','$sgl','$cnb','$sgl_sub','$infant','$gt','$gt_sgl','$gt_cnb','','$gt_inf','$expired','$hotel1','$hotel2','$hotel3','$hotel4','$hotel5','$hotel6','$hotel7','$hotel8','$hotel9','$hotel10','$ket','$vp','" . $tgl_brkt . "','$city_in','$city_out','" . $itin_link . "','" . $itin_np . "','U')";
if (mysqli_query($con, $sql)) {
    echo "Berhasil";
} else {
    echo "Gagal";
}

// var_dump($gt);
