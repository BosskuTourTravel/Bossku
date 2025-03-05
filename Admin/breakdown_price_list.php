<?php
include "../db=connection.php";
include "Api_LT_total_baru.php";
include "fungsi_gethotel_price.php";
include "fungsi_profit_flight.php";
include "fungsi_feetl.php";
include "fungsi_forLT.php";


$query_data = "SELECT * FROM  LTSUB_itin where id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);

$query_data2 = "SELECT negara,kurs FROM LT_itinnew where kode='".$row_data['landtour']."' limit 1";
$rs_data2 = mysqli_query($con, $query_data2);
$row_data2 = mysqli_fetch_array($rs_data2);

$query_inc = "SELECT * FROM LT_include_checkbox where tour_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "'";
$rs_inc = mysqli_query($con, $query_inc);
$row_inc = mysqli_fetch_array($rs_inc);
$query_include = explode(",", $row_inc['chck']);

$query_adm = "SELECT * FROM tour_adm_chck where tour_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "'";
$rs_adm = mysqli_query($con, $query_adm);
$row_adm = mysqli_fetch_array($rs_adm);
$include = explode(",", $row_adm['include']);
$exclude = explode(",", $row_adm['exclude']);
// var_dump($include );

$query_grub = "SELECT LTP_grub_flight.id,LTP_grub_flight.grub_name,LTP_insert_sfee.date_set,LTP_insert_sfee.id as sfee_id,LTP_insert_sfee.adt,LTP_insert_sfee.chd,LTP_insert_sfee.inf,LTP_insert_sfee.ket,LTP_insert_sfee.tgl as tgl_buat FROM LTP_grub_flight INNER JOIN LTP_insert_sfee ON LTP_grub_flight.id = LTP_insert_sfee.id_grub where LTP_grub_flight.id='" . $_POST['grub_id'] . "'  && LTP_insert_sfee.id='" . $_POST['sfee_id'] . "'";
$rs_grub = mysqli_query($con, $query_grub);
$row_grub = mysqli_fetch_array($rs_grub);

$query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $_POST['grub_id'] . "' order by id ASC";
$rs_gf = mysqli_query($con, $query_gf);
$rs_gf_price = mysqli_query($con, $query_gf);
// var_dump($query_gf );


$chck = [];
$adm_inc = [];
$adm_ex = [];

if (isset($_POST['chck'])) {
    $chck = explode(",", $_POST['chck']);
}
if (isset($_POST['adm_inc'])) {
    $adm_inc = explode(",", $_POST['adm_inc']);
}
if (isset($_POST['adm_ex'])) {
    $adm_ex = explode(",", $_POST['adm_ex']);
}
$query_kurs = "SELECT * FROM  kurs_bca_field where nama LIKE '".$row_data2['kurs']."' order by id ASC ";
$rs_kurs = mysqli_query($con, $query_kurs);
$row_kurs = mysqli_fetch_array($rs_kurs);
?>
<div>KURS RATE : <?php echo "<b>". $row_data2['kurs']." ". number_format($row_kurs['jual'])."</b>"?></div>
<table class="table table-sm table-bordered">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Include</th>
            <th scope="col">Price</th>
            <th scope="col">Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $grandtotal = 0;
        $hotel_id = 0;

        foreach ($query_include as $check) {
            $query_chck = "SELECT * FROM  checkbox_include2 where id=" . $check;
            $rs_chck = mysqli_query($con, $query_chck);
            $row_chck = mysqli_fetch_array($rs_chck);

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
                $adt = $adt + $row_grub['adt'];
                $chd = $chd + $row_grub['chd'];
                $inf = $inf + $row_grub['inf'];
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

                ///////////////////////////////////////
            } else if ($check == '15') {
                $data_hotel = array(
                    "copy_id" => $row_data['id'],
                    "master_id" => $row_data['master_id'],
                );

                $show_hp = get_hotel_price($data_hotel);
                $result_hp = json_decode($show_hp, true);
                $hotel_id =  $result_hp['id_hotel'];
                $grandtotal = $grandtotal + $result_hp['twn'];
                // var_dump($result_hp);
            } else if ($check == '17') {
                $show_tps = get_adm_price($include);
                $result_tps = json_decode($show_tps, true);
                $grandtotal = $grandtotal + $result_tps['adt'];
            } else if ($check == '32') {
                $fee_tl = 0;
                if ($_POST['tl_fee'] !="") {
                    $data_feetl = array(
                        "master_id" => $row_data['master_id'],
                        "copy_id" => $row_data['id'],
                        "grub_id" => $row_grub['id'],
                        "hotel_id" =>  $hotel_id,
                        "tl_fee" => $_POST['tl_fee'],
                        "tl_meal" => $_POST['tl_meal'],
                        "tl_tlpn" => $_POST['tl_tlpn'],
                        "tl_sfee" => $_POST['tl_sfee'],
                    );

                    $show_feetl = feeTL_custom($data_feetl);
                    if($show_feetl){
                        $result_tps = json_decode($show_feetl, true);
                        if ($_POST['tl_pax'] != "") {
                            $fee_tl = intval($result_tps['custom']) / intval($_POST['tl_pax']);
                        }
                    }
                    // var_dump("onn");
                } else {
                    $data_feetl = array(
                        "master_id" => $row_data['master_id'],
                        "copy_id" => $row_data['id'],
                        "grub_id" => $row_grub['id'],
                        "hotel_id" =>  $hotel_id
                    );

                    $show_feetl2 = feeTL($data_feetl);
                    if($show_feetl2){
                        $result_tps2 = json_decode($show_feetl2, true);
                        $fee_tl = intval($result_tps2['adt']);
                       
                    }


                }
                
                // if ($_POST['tl_pax'] != "") {
                //     $fee_tl = intval($result_feetl['custom']) / intval($_POST['tl_pax']);
                // } else {
                //     $fee_tl = intval($result_feetl['adt']);
                // }
                $grandtotal = $grandtotal + $fee_tl;
                // var_dump($grandtotal);
            } else if ($check == '55') {
                $data_tps = array(
                    "master_id" => $row_data['master_id'],
                    "copy_id" => $row_data['id'],
                    "grub_id" => $row_grub['id'],
                    "sfee_id" => $row_grub['sfee_id']
                );
                // var_dump($data_tps);

                $show_tps = get_hotel_forLT($data_tps);
                $result_tps = json_decode($show_tps, true);
                $ph = $result_tps['adt'] / 2;
                $grandtotal = $grandtotal + $ph;
                // var_dump($result_tps['adt']." - ".$ph);
                // var_dump($result_tps);

            } else {
                $data_tps = array(
                    "master_id" => $row_data['master_id'],
                    "copy_id" => $row_data['id'],
                    "grub_id" => $row_grub['id'],
                    "check_id" => $check
                );


                $show_tps = get_total($data_tps);
                if(!empty($show_tps)){
                    $result_tps = json_decode($show_tps, true);
                    $grandtotal = intval($grandtotal) + intval($result_tps['adt']);
                }

                // if($check =='23'){
                //     echo $result_tps['adt'];
                // }


            }
        ?>
            <tr>
                <th><?php echo $no ?></th>
                <td><?php echo $row_chck['nama'] ?></td>
                <td>
                    <?php
                    if ($check == '15') {
                        echo number_format(isset($result_hp['twn']) ? $result_hp['twn'] : 0, 0, ",", ".");
                    } else if ($check == '32') {
                        // var_dump($fee_tl);
                        echo number_format($fee_tl, 0, ",", ".");
                    } else if ($check == '55') {
                        echo number_format($ph, 0, ",", ".");
                    } else {
                        echo number_format(isset($result_tps['adt']) ? $result_tps['adt'] : 0, 0, ",", ".");
                    }

                    ?></td>
                <td></td>
            </tr>
        <?php
            $no++;
        }
        ?>
        <tr>
            <th></th>
            <td>Biaya Tambahan (Lain-lain)</td>
            <td><?php  echo number_format(isset($_POST['ltwn']) ? intval($_POST['ltwn']) : 0, 0, ",", ".") ?></td>
            <td></td>
        </tr>
    </tbody>
    <tfoot>
        <?php
        $grandtotal = intval($grandtotal) + intval($_POST['ltwn']);
        $grand_adt = get_pembulatan($grandtotal);
        $grand_adt_val = json_decode($grand_adt, true);
        ?>
        <tr>
            <th scope="col"></th>
            <th scope="col">Total Price</th>
            <th scope="col"><?php echo number_format($grandtotal, 0, ",", ".") ?></th>
            <th style="color: green;"><?php echo number_format($grand_adt_val['value'], 0, ",", ".") ?></th>
        </tr>
    </tfoot>
</table>
<div style="padding-top: 10px;">
    <div style="padding-left: 10px;">
        <form action="preview_breakdown.php?id=<?php echo $_POST['id'] ?>&grub_id=<?php echo $_POST['grub_id'] ?>&sfee_id=<?php echo $_POST['sfee_id'] ?>" method="post" target="_blank">

            <input type="hidden" name="ltwn" id="ltwn" value="<?php echo $_POST['ltwn'] ?>">
            <input type="hidden" name="tl_pax" id="tl_pax" value="<?php echo $_POST['tl_pax'] ?>">
            <input type="hidden" name="pem_gt" id="pem_gt" value="<?php echo $grand_adt_val['value'] ?>">
            <input type="hidden" name="negara_tour" id="negara_tour" value="<?php echo $row_data2['negara'] ?>">
            <input type="hidden" name="pax_tour" id="pax_tour" value="<?php echo  $result_hp['pax'] ?>">
            <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo $hotel_id ?>">          
            <button type="submit" class="btn btn-primary btn-sm" onclick="">Print Breakdown</button>
        </form>

    </div>
</div>
<div class="modal fade" id="cost_tl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">COST TL BREAKDOWN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-data"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#cost_tl').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var itin = $(e.relatedTarget).data('sub');
            var flight = $(e.relatedTarget).data('fl');
            var date = $(e.relatedTarget).data('date');
            var tl_pax = $(e.relatedTarget).data('tlpax');
            $.ajax({
                url: "cost_tl_modal.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    itin: itin,
                    flight: flight,
                    date: date,
                    tl_pax: tl_pax

                },
                success: function(data) {
                    $('.modal-data').html(data);
                }
            });
        });
    });
</script>