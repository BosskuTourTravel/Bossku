<?php
include "../db=connection.php";
include "api_modal_LT.php";
// include "fungsi_feetl.php";
// include "Api_LT_total_baru.php";
// include "fungsi_feetl.php";
// include "fungsi_forLT.php";

$query_data = "SELECT * FROM  LTSUB_itin where id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);

$query_data2 = "SELECT negara,kurs FROM LT_itinnew where kode='" . $row_data['landtour'] . "' limit 1";
$rs_data2 = mysqli_query($con, $query_data2);
$row_data2 = mysqli_fetch_array($rs_data2);

$query_inc = "SELECT * FROM LT_include_checkbox where tour_id='" . $row_data['id'] . "' && master_id='" . $row_data['master_id'] . "'";
$rs_inc = mysqli_query($con, $query_inc);
$row_inc = mysqli_fetch_array($rs_inc);
$query_include = explode(",", $row_inc['chck']);

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
            if ($check == '32') {
                // var_dump($_POST['tl_fee']);
                if ($_POST['tl_fee'] != "") {
                    $data_feetl = array(
                        "master_id" => $row_data['master_id'],
                        "copy_id" => $row_data['id'],
                        "grub_id" => $_POST['grub_id'],
                        "hotel_id" =>  $hotel_id,
                        "tl_fee" => $_POST['tl_fee'],
                        "tl_meal" => $_POST['tl_meal'],
                        "tl_tlpn" => $_POST['tl_tlpn'],
                        "tl_sfee" => $_POST['tl_sfee'],
                    );
                    // // var_dump($data_feetl);
                    // $show_feetl = feeTL_custom($data_feetl);
                    // $result_feetl = json_decode($show_feetl, true);
                } else {
                    $data_feetl = array(
                        "master_id" => $row_data['master_id'],
                        "copy_id" => $row_data['id'],
                        "grub_id" => $_POST['grub_id'],
                        "hotel_id" =>  $hotel_id
                    );
                    // var_dump($data_feetl);
                    $show_feetl = feeTL($data_feetl);
                    $result_feetl = json_decode($show_feetl, true);
                    // $grandtotal = $grandtotal + $fee_tl;
                    // var_dump($result_feetl);
                }
                $fee_tl = 0;
                if ($_POST['tl_pax'] != "") {
                    $fee_tl = $result_feetl['custom'] / $_POST['tl_pax'];
                } else {
                    $fee_tl = $result_feetl['adt'];
                }
                $grandtotal = $grandtotal + $fee_tl;


            } else {

                $data_tps = array(
                    "master_id" => $row_data['master_id'],
                    "copy_id" => $row_data['id'],
                    "grub_id" => $_POST['grub_id'],
                    "sfee_id" => $_POST['sfee_id'],
                    "check_id" => $check
                );
                // var_dump($data_tps);

                $show_tps = get_total_modal($data_tps);
                $result_tps = json_decode($show_tps, true);
                $grandtotal = $grandtotal + $result_tps['adt'];
                if($check == '15'){
                    $hotel_id =  $result_tps['detail'];
                }
            }
            //  var_dump($grandtotal);

        ?>
            <tr>
                <th><?php echo $no ?></th>
                <td><?php echo $row_chck['nama'] ?></td>
                <td>
                    <?php
                    if ($check == '32') {
                        echo number_format($fee_tl, 0, ",", ".");
                    } else {
                        echo number_format($result_tps['adt'], 0, ",", ".");
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
            <td><?php echo number_format($_POST['ltwn'], 0, ",", ".") ?></td>
            <td></td>
        </tr>
    </tbody>
    <tfoot>
        <?php
        // $grandtotal = $grandtotal + $_POST['ltwn'];
        // $grand_adt = get_pembulatan($grandtotal);
        // $grand_adt_val = json_decode($grand_adt, true);
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
            <button type="submit" class="btn btn-primary btn-sm" onclick="">Print Modal Breakdown</button>
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