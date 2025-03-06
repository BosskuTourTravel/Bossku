<?php
include "../db=connection.php";
include "Api_LT_total_baru.php";
$query_tp = "SELECT * FROM  Transport_new where agent='" . $_POST['id'] . "' order by id ASC";
$rs_tp = mysqli_query($con, $query_tp);

$query_agn2 = "SELECT * FROM  agent_transport where id='" . $_POST['id'] . "'";
$rs_agn2 = mysqli_query($con, $query_agn2);
$row_agn2 = mysqli_fetch_array($rs_agn2);

?>
<div style="text-align: center;">
    <h3>Transport List <?php echo $row_agn2['company'] ?></h3>
</div>
<div style="text-align: right; padding: 20px;">
    <a class="btn btn-success btn-sm tip" title="add transport" onclick="TRN_Package(4,<?php echo $row_agn2['id'] ?>,0)">New Transport</i></a>
</div>
<table id="tb-trans" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
    <thead>
        <tr>
            <th>Id</th>
            <th>Transport Type</th>
            <th>Agent Price</th>
            <th>Kurs</th>
            <th>IDR Price</th>
            <th>Sell Price</th>
            <th>Remarks</th>
            <th>Img</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row_tp = mysqli_fetch_array($rs_tp)) {
            $pr = 5;
            $p_oneway = 0;
            $p_twoway = 0;
            $p_hd1 = 0;
            $p_hd2 = 0;
            $p_fd1 = 0;
            $p_fd2 = 0;
            $p_kaisoda = 0;
            $p_luar_kota = 0;

            $data = array(
                "kurs" =>  $row_tp['kurs'],
                "oneway" => $row_tp['oneway'],
                "twoway" => $row_tp['twoway'],
                "hd1" => $row_tp['hd1'],
                "hd2" => $row_tp['hd2'],
                "fd1" => $row_tp['fd1'],
                "fd2" => $row_tp['fd2'],
                "kaisoda" => $row_tp['kaisoda'],
                "luarkota" => $row_tp['luarkota'],
            );
            // var_dump($data);
            $adt_kurs = get_kurs_landtrans($data);
            if ($adt_kurs) {
                $rs_adt_kurs = json_decode($adt_kurs, true);
                if (isset($rs_adt_kurs['fd2'])) {
                    $sql_profit = "SELECT * FROM LTR_profit_range where price1 <='" . $rs_adt_kurs['fd2'] . "' && price2 >='" . $rs_adt_kurs['fd2'] . "'";
                    $rs_profit = mysqli_query($con, $sql_profit);
                    $row_profit = mysqli_fetch_array($rs_profit);
                    if (isset($row_profit['id'])) {
                        $pr = $row_profit['profit'];
                    }
                    $persen = intval($pr) / 100;

                    $p_oneway = intval($rs_adt_kurs['oneway']) + (intval($rs_adt_kurs['oneway']) * $persen);
                    $p_twoway = intval($rs_adt_kurs['twoway']) + (intval($rs_adt_kurs['twoway']) * $persen);
                    $p_hd1 = intval($rs_adt_kurs['hd1']) + (intval($rs_adt_kurs['hd1']) * $persen);
                    $p_hd2 = intval($rs_adt_kurs['hd2']) + (intval($rs_adt_kurs['hd2']) * $persen);
                    $p_fd1 = intval($rs_adt_kurs['fd1']) + (intval($rs_adt_kurs['fd1']) * $persen);
                    $p_fd2 = intval($rs_adt_kurs['fd2']) + (intval($rs_adt_kurs['fd2']) * $persen);
                    $p_kaisoda = intval($rs_adt_kurs['kaisoda']) + (intval($rs_adt_kurs['kaisoda']) * $persen);
                    $p_luar_kota = intval($rs_adt_kurs['luarkota']) + (intval($rs_adt_kurs['luarkota']) * $persen);
                }
            }
            // var_dump( $rs_adt_kurs);
            // $adt_tmp = $adt_tmp + $rs_adt_kurs['data'];

        ?>
            <tr>
                <td><?php echo $row_tp['id'] ?></td>
                <td>
                    <div><?php echo $row_tp['trans_type'] . " " . $row_tp['seat'] . " seat" ?></div>
                    <div style="font-weight: bold; text-decoration: underline;"><?php echo $row_tp['periode'] ?></div>
                    <div><?php echo $row_tp['city'] ?></div>
                </td>
                <td style="min-width: 170px;">
                    <div>One Way : <?php echo $row_tp['kurs'] . " " . number_format($row_tp['oneway']) ?></div>
                    <div>Two Way : <?php echo  $row_tp['kurs'] . " " . number_format($row_tp['twoway']) ?></div>
                    <div>Half Day 1 : <?php echo $row_tp['kurs'] . " " . number_format($row_tp['hd1']) ?></div>
                    <div>Half Day 2 : <?php echo $row_tp['kurs'] . " " . number_format($row_tp['hd2']) ?></div>
                    <div>Full Day 1 : <?php echo $row_tp['kurs'] . " " . number_format($row_tp['fd1']) ?></div>
                    <div>Full Day 2 : <?php echo $row_tp['kurs'] . " " . number_format($row_tp['fd2']) ?></div>
                    <div>Kaisoda : <?php echo $row_tp['kurs'] . " " . number_format($row_tp['kaisoda']) ?></div>
                    <div>Luar Kota : <?php echo $row_tp['kurs'] . " " . number_format($row_tp['luarkota']) ?></div>
                </td>
                <td><?php echo $row_tp['kurs'] . " : " . number_format($rs_adt_kurs['rate']) ?></td>
                <td style="min-width: 170px;">
                    <div>One Way : <?php echo " IDR " . number_format($rs_adt_kurs['oneway']) ?></div>
                    <div>Two Way : <?php echo  " IDR " . number_format($rs_adt_kurs['twoway']) ?></div>
                    <div>Half Day 1 : <?php echo " IDR " . number_format($rs_adt_kurs['hd1']) ?></div>
                    <div>Half Day 2 : <?php echo " IDR " . number_format($rs_adt_kurs['hd2']) ?></div>
                    <div>Full Day 1 : <?php echo " IDR " . number_format($rs_adt_kurs['fd1']) ?></div>
                    <div>Full Day 2 : <?php echo " IDR " . number_format($rs_adt_kurs['fd2']) ?></div>
                    <div>Kaisoda : <?php echo " IDR " . number_format($rs_adt_kurs['kaisoda']) ?></div>
                    <div>Luar Kota : <?php echo " IDR " . number_format($rs_adt_kurs['luarkota']) ?></div>
                </td>
                <td style="min-width: 170px;">
                    <div>One Way : <?php echo " IDR " . number_format($p_oneway) ?></div>
                    <div>Two Way : <?php echo  " IDR " . number_format($p_twoway) ?></div>
                    <div>Half Day 1 : <?php echo " IDR " . number_format($p_hd1) ?></div>
                    <div>Half Day 2 : <?php echo " IDR " . number_format($p_hd2) ?></div>
                    <div>Full Day 1 : <?php echo " IDR " . number_format($p_fd1) ?></div>
                    <div>Full Day 2 : <?php echo " IDR " . number_format($p_fd2) ?></div>
                    <div>Kaisoda : <?php echo " IDR " . number_format($p_kaisoda) ?></div>
                    <div>Luar Kota : <?php echo " IDR " . number_format($p_luar_kota) ?></div>
                </td>
                <td><?php echo $row_tp['remarks'] ?></td>
                <td>
                    <?php
                    if ($row_tp['img'] != "") {
                    ?><img src="<?php echo $row_tp['img'] ?>" width="100px" height="70px"><?php
                                                                                        }
                                                                                            ?>
                </td>
                <td>
                    <a class="btn btn-success btn-sm tip" data-toggle="modal" data-target="#copy_transport" data-id="<?php echo $row_tp['id']  ?>" title="Copy transport"><i class="fas fa-clone"></i></a>
                    <a class="btn btn-success btn-sm tip" title="Edit transport" onclick="TRN_Package(5,<?php echo  $row_tp['id']?>,0)"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-warning btn-sm tip" data-toggle="modal" data-target="#img" data-id="<?php echo $row_tp['id']  ?>" title="Add Image"><i class="fas fa-upload"></i></a>
                    <a class="btn btn-danger btn-sm tip" title="delete transport" onclick="del_trans(<?php echo $row_tp['id']  ?>)"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<div class="modal fade" id="img" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-data-img"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success btn-sm" onclick="add_img()" data-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tb-trans').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
        $('#img').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "modal_form_img.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                },
                success: function(data) {
                    $('.modal-data-img').html(data);
                }
            });
        });
    });

    function add_img() {
        let formData = new FormData();
        var img = document.getElementById('img_link').value;
        var id = document.getElementById('id').value;
        // work with the values here:
        formData.append('id', id);
        formData.append('img', img);
        // alert(img);
        $.ajax({
            type: 'POST',
            url: "insert_landtrans_img.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                TRN_Package(0, 0, 0);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        })
    }

    function del_trans(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "delete_landtrans.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        TRN_Package(0, 0, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
</script>