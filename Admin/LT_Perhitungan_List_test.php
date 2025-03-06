<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();

function get_fl_total($datareq)
{
    include "../db=connection.php";
    $master_id = $datareq['master_id'];
    $copy_id = $datareq['copy_id'];
    $check_id = $datareq['check_id'];

    if ($check_id == '1') {
        $query_plane = "SELECT * FROM LT_add_transport where master_id='" . $master_id . "' && copy_id='" . $copy_id . "' order by hari ASC,urutan ASC";
        $rs_plane = mysqli_query($con, $query_plane);
        $adt = 0;
        $chd = 0;
        $inf = 0;
        $data = [];
        $x = 1;
        while ($row_plane = mysqli_fetch_array($rs_plane)) {
            if ($row_plane['type'] == '1') {
                if ($x == 1) {

                    $query_price = "SELECT * FROM LTP_insert_sfee where id_grub='" . $row_plane['grub_id'] . "'";
                    $rs_price = mysqli_query($con, $query_price);
                    $row_price = mysqli_fetch_array($rs_price);

                    $adt = $adt + $row_price['adt'];
                    $chd = $chd + $row_price['chd'];
                    $inf = $inf + $row_price['inf'];

                    $query_flg = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $data['id'] . "' order by id ASC";
                    $rs_flg = mysqli_query($con, $query_flg);
                    $xr = 1;
                    $fl_id = '';
                    while ($row_flg = mysqli_fetch_array($rs_flg)) {
                        if ($xr == '1') {
                            $fl_id = $row_flg['flight_id'];
                        }
                        if ($row_flg['status'] == '1') {
                            if ($xr == '1') {
                                $query_det2 = "SELECT route_id FROM  LTP_route_detail where id='" . $row_flg['flight_id'] . "'";
                                $rs_det2 = mysqli_query($con, $query_det2);
                                $row_det2 = mysqli_fetch_array($rs_det2);

                                $query_rdt = "SELECT * FROM  LT_add_roundtrip where route_id='" . $row_det2['route_id'] . "'  order by id ASC";
                                $rs_rdt = mysqli_query($con, $query_rdt);
                                $row_rdt = mysqli_fetch_array($rs_rdt);
                                if ($row_rdt['id'] != "") {
                                    $adt = $adt + $row_rdt['adt'];
                                    $chd = $chd + $row_rdt['chd'];
                                    $inf = $inf + $row_rdt['inf'];
                                }
                            }
                        } else {
                            $query_det = "SELECT * FROM  LTP_route_detail where id='" . $row_flg['flight_id'] . "'";
                            $rs_det = mysqli_query($con, $query_det);
                            $row_det = mysqli_fetch_array($rs_det);
                            $adt = $adt + $row_det['adt'];
                            $chd = $chd + $row_det['chd'];
                            $inf = $inf + $row_det['inf'];
                        }
                        $xr++;
                    }
                    
                }

            }
            $x++;
        }
        $sql_profit = "SELECT * FROM LT_profit_range where price1 <='" . $adt. "' && price2 >='" . $adt . "'";
        $rs_profit = mysqli_query($con, $sql_profit);
        $row_profit = mysqli_fetch_array($rs_profit);

        $pr = 0;
        if ($row_profit['id'] != "") {
            $pr = $row_profit['profit'];
        } else {
            $pr = 5;
        }
        $dm = $adt * ($row_profit['adm_mkp'] / 100);
        $mar = $adt * ($row_profit['marketing'] / 100);
        $agn = $adt * ($row_profit['sub_agent'] / 100);
        $ste = $row_profit['staff_eks'];
        $nom = $row_profit['nominal'];
        $lain2 = $adm + $mar + $agn + $ste + $nom;

        $adt_price = intval($adt) * ($pr / 100);
        $chd_price = intval($chd) * ($pr / 100);
        $inf_price = intval($inf) * ($pr / 100);

        $adt = $adt +  $adt_price + $nom;
        $chd = $chd + $chd_price + $nom;
        $inf = $inf + $inf_price + $nom;
        return json_encode(array("adt" => $adt, "chd" =>  $chd, "inf" =>  $inf, "sgl" => $adt, "detail" => $data), true);
    }
}
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Landtour Perhitungan List </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm" onclick="LT_itinerary(3,0,0)"><i class="fa fa-arrow-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    include "../site.php";
                    include "../db=connection.php";
                    $query = "SELECT * FROM  checkbox_include2 order by id ASC";
                    $rs = mysqli_query($con, $query);
                    $no = 1;

                    $query_master = "SELECT * FROM LT_itinerary2  where id=" . $_POST['master_id'];
                    $rs_master = mysqli_query($con, $query_master);
                    $row_master = mysqli_fetch_array($rs_master);
                    $bonus = "";
                    ?>
                    <div style="text-align: center; padding: 10px;"><b></b></div>
                    <table id="example" class="table table-striped table-bordered table-sm" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama</th>
                                <th>Detail</th>
                                <th>Twin/CWB</th>
                                <th>CNB</th>
                                <th>INF</th>
                                <th>SGL</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_twn = 0;
                            $total_chd = 0;
                            $total_inf = 0;
                            $total_sgl = 0;

                            $tips_meal = 0;
                            $tips_flight = 0;
                            $tips_train = 0;
                            $tips_ferry = 0;
                            $tips_flTax = 0;
                            $tips_flMeal = 0;
                            $tips_flBagasi = 0;
                            $tips_LT = 0;
                            $landtour = 0;
                            $single_sub = 0;
                            $ltc = 0;
                            $grand = 0;
                            $grandtotal = 0;
                            $flight = 0;
                            while ($row = mysqli_fetch_array($rs)) {
                                if ($row['id'] == '1') {
                                    $datareq = array(
                                        "master_id" => $_POST['master_id'],
                                        "copy_id" => $_POST['id'],
                                        "check_id" => $row['id']
                                    );
                                    $show_total = get_fl_total($datareq);
                                    $result_show_total = json_decode($show_total, true);
                            ?>
                                    <tr>
                                        <td>Flight</td>
                                        <td></td>
                                        <td><?php echo $result_show_total['adt'] ?></td>
                                        <td><?php echo $result_show_total['chd'] ?></td>
                                        <td><?php echo $result_show_total['inf'] ?></td>
                                        <td><?php echo $result_show_total['sgl'] ?></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                            <?php
                                }
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <!-- /.row -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 10,
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.form-check-input').click(function() {

            var target = $(this).val();
            if (target == 0) {
                $('.flight').show();
                $('.ferry').hide();
                $('.train').hide();
                $('.land').hide();
                // $('.tl-fee').hide();

            } else if (target == 1) {
                $('.flight').hide();
                $('.ferry').show();
                $('.train').hide();
                $('.land').hide();
                // $('.tl-fee').hide();
            } else if (target == 2) {
                $('.rute').hide();
                $('.ferry').hide();
                $('.train').show();
                $('.land').hide();
                // $('.tl-fee').hide();
            } else if (target == 3) {
                $('.rute').hide();
                $('.ferry').hide();
                $('.train').hide();
                $('.land').show();
                // $('.tl-fee').hide();
            } else {

            }
        });

    });
</script>
<script>
    $(document).ready(function() {
        var i = 1;
        $('#add').click(function() {
            i++;
            $.ajax({
                url: "LT_transport_field.php",
                method: "POST",
                asynch: false,
                data: {
                    i: i
                },
                success: function(data) {
                    $('#dynamic_field').append(data);
                }
            });
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
    });
</script>
<script>
    $(document).ready(function() {

        $('.submit').on('click', e => {
            // alert("on");
            const $button = $(e.target);
            // const $modalBody = $button.closest('.modal-footer').prev('.modal-body');
            // const id = $button.data('id');
            // const hari = $modalBody.find($("input[name=hari]")).val();
            // const rute = $modalBody.find($("input[name=rute]")).val();

            // let formData = new FormData();
            // formData.append('id', id);
            // formData.append('hari', hari);
            // formData.append('rute', rute);
            // // work with the values here:
            // $.ajax({
            //     type: 'POST',
            //     url: "add_LT_hari.php",
            //     data: formData,
            //     cache: false,
            //     processData: false,
            //     contentType: false,
            //     success: function(msg) {
            //         alert(msg);
            //         LT_itinerary(8,id,0);
            //     },
            //     error: function() {
            //         alert("Data Gagal Diupload");
            //     }
            // });
            //  console.log(id, hari, rute);

        });
    });
</script>