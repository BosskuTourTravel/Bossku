<?php
include "../db=connection.php";
include "Api_LT_total_baru.php";
$query_data = "SELECT * FROM  LTSUB_itin where id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);



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
?>
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
        foreach ($chck as $value) {
            $query_chck = "SELECT * FROM  checkbox_include2 where id=" . $value;
            $rs_chck = mysqli_query($con, $query_chck);
            $row_chck = mysqli_fetch_array($rs_chck);

            if ($value == '1') {

                $data_tps = array(
                    "flight" => $_POST['flight'],
                    "date" => $_POST['date']
                );

                $show_tps = get_flight_price($data_tps);
                $result_tps = json_decode($show_tps, true);
                $grandtotal = $grandtotal + $result_tps['adt'];
            } else if ($value == '15') {
                $data_tps = array(
                    "hotel" => $_POST['hotel'],
                );
                $show_tps = get_chck_hotel($data_tps);
                $result_tps = json_decode($show_tps, true);
                $grandtotal = $grandtotal + $result_tps['adt'];
            } else if ($value == '17') {
                $show_tps = get_adm_price($adm_inc);
                $result_tps = json_decode($show_tps, true);
                $grandtotal = $grandtotal + $result_tps['adt'];
            } else if ($value == '32') {
                // var_dump($value);
                $data_tps = array(
                    "master_id" => $row_data['master_id'],
                    "copy_id" => $row_data['id'],
                    "check_id" => $value,
                    "flight" => $_POST['flight'],
                    "date" => $_POST['date'],
                    "tl_pax" => $_POST['tl_pax']
                );
                // var_dump($data_tps);

                $show_tps = get_total($data_tps);
                $result_tps = json_decode($show_tps, true);
                $grandtotal = $grandtotal + $result_tps['adt'];
            } else {
                $data_tps = array(
                    "master_id" => $row_data['master_id'],
                    "copy_id" => $row_data['id'],
                    "check_id" => $value
                );

                $show_tps = get_total($data_tps);
                $result_tps = json_decode($show_tps, true);
                $grandtotal = $grandtotal + $result_tps['adt'];
                // if($value =='26'){
                //     var_dump($result_tps['detail']);
                // }
            }


            //  var_dump( $row_chck['nama'].": ".$result_tps['adt'].",");
        ?>
            <tr>
                <th style="width: 40px;"><?php echo $no ?></th>
                <td><?php echo $row_chck['nama'] ?></td>
                <td><?php echo number_format($result_tps['adt'], 0, ",", ".") ?></td>
                <td>
                    <?php
                    if ($value == '32') {
                    ?>

                        <!-- <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#cost_tl">Show</a> -->

                        <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#cost_tl" data-id="<?php echo $value ?>" data-sub="<?php echo $row_data['id'] ?>" data-fl="<?php echo $_POST['flight'] ?>" data-date="<?php echo $_POST['date'] ?>" data-tlpax="<?php echo $_POST['tl_pax'] ?>"><i class="fas fa-donate"></i></a>
                        <form action="cetak_invoice_feetl2.php?id=<?php echo $value ?>&sub=<?php echo $row_data['id'] ?>" method="post" target="_blank">
                            <input type="hidden" name="tl_fl" id="tl_fl" value="<?php echo $_POST['flight'] ?>">
                            <input type="hidden" name="tl_date" id="tl_date" value="<?php echo $_POST['date'] ?>">
                            <input type="hidden" name="tl_pax" id="tl_pax" value="<?php echo $_POST['tl_pax'] ?>">
                            <button class="btn btn-warning btn-sm" type="submit"><i class="fas fa-print"></i></button>
                        </form>

                    <?php
                    }
                    ?>
                </td>
            </tr>
        <?php
            $no++;
        }
        ?>
        <tr>
            <th></th>
            <td>Biaya Tambahan (Lain-lain)</td>
            <td><?php echo number_format($_POST['ltwn'], 0, ",", ".") ?></td>
            <td></td>
        </tr>
    </tbody>
    <tfoot>
        <?php
        $grandtotal = $grandtotal + $_POST['ltwn'];
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
        <form action="preview_breakdown.php?id=<?php echo $_POST['id'] ?>" method="post" target="_blank">
            <input type="hidden" name="chck" id="chck" value="<?php echo $_POST['chck'] ?>">
            <input type="hidden" name="adm_inc" id="adm_inc" value="<?php echo $_POST['adm_inc'] ?>">
            <input type="hidden" name="adm_ex" id="adm_ex" value="<?php echo $_POST['adm_ex'] ?>">
            <input type="hidden" name="flight" id="flight" value="<?php echo $_POST['flight'] ?>">
            <input type="hidden" name="date" id="date" value="<?php echo $_POST['date'] ?>">
            <input type="hidden" name="hotel" id="hotel" value="<?php echo $_POST['hotel'] ?>">
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