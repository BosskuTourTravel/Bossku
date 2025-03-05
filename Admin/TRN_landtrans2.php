<?php
include "../db=connection.php";
include "Api_LT_total_baru.php";
session_start();
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Landtransport List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <!-- <button type="button" onclick="TRN_Package(4,0,0)" class="btn btn-primary"><i class="fa fa-plus"></i></button> -->
                                <button type="button" onclick="TRN_Package(3,0,0)" class="btn btn-success"><i class="fa fa-sync"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    $query_tr = "SELECT Transport_new.id,Transport_new.city,Transport_new.country,Transport_new.periode,Transport_new.kurs,Transport_new.trans_type,Transport_new.seat,Transport_new.oneway,Transport_new.twoway,Transport_new.hd1,Transport_new.hd2,Transport_new.fd1,Transport_new.fd2,Transport_new.kaisoda,Transport_new.luarkota,Transport_new.remarks,agent_transport.name as agent_name FROM `Transport_new` INNER JOIN agent_transport ON Transport_new.agent=agent_transport.id ORDER BY country ASC,city ASC";
                    $rs_tr = mysqli_query($con, $query_tr);

                    $no = 1;
                    ?>
                    <div style="padding: 20px;">
                        <table id="tb-pt-sub" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Agent Name</th>
                                    <th>Region</th>
                                    <th>Transport Type</th>
                                    <th>Periode</th>
                                    <th>Price</th>
                                    <th>Remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row_tr = mysqli_fetch_array($rs_tr)) {

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
                                        "kurs" =>  $row_tr['kurs'],
                                        "oneway" => $row_tr['oneway'],
                                        "twoway" => $row_tr['twoway'],
                                        "hd1" => $row_tr['hd1'],
                                        "hd2" => $row_tr['hd2'],
                                        "fd1" => $row_tr['fd1'],
                                        "fd2" => $row_tr['fd2'],
                                        "kaisoda" => $row_tr['kaisoda'],
                                        "luarkota" => $row_tr['luarkota'],
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

                                ?>
                                    <tr>
                                        <td><?php echo $row_tr['id'] ?></td>
                                        <td><?php echo $row_tr['agent_name'] ?></td>
                                        <td>
                                            <div style="font-weight: bold; text-decoration: underline;"><?php echo $row_tr['country'] ?></div>
                                            <div><?php echo $row_tr['city'] ?></div>
                                        </td>
                                        <td><?php echo $row_tr['trans_type'] . " " . $row_tr['seat'] . " seat" ?></td>
                                        <td><?php echo $row_tr['periode'] ?></td>
                                        <td>
                                            <div>One Way : <?php echo " IDR " . number_format($p_oneway) ?></div>
                                            <div>Two Way : <?php echo  " IDR " . number_format($p_twoway) ?></div>
                                            <div>Half Day 1 : <?php echo " IDR " . number_format($p_hd1) ?></div>
                                            <div>Half Day 2 : <?php echo " IDR " . number_format($p_hd2) ?></div>
                                            <div>Full Day 1 : <?php echo " IDR " . number_format($p_fd1) ?></div>
                                            <div>Full Day 2 : <?php echo " IDR " . number_format($p_fd2) ?></div>
                                            <div>Kaisoda : <?php echo " IDR " . number_format($p_kaisoda) ?></div>
                                            <div>Luar Kota : <?php echo " IDR " . number_format($p_luar_kota) ?></div>
                                        </td>
                                        <td><?php echo $row_tr['remarks'] ?></td>
                                        <td></td>
                                    </tr>
                                <?php
                                }
                                ?>


                            </tbody>
                        </table>
                    </div>
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
        $('#tb-pt-sub').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
        $('#tb-trans').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".tip").tooltip({
            placement: 'top',
            trigger: 'hover'
        });
    });
</script>
<script>
    function delete_itin(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "LT_delete_copy.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        LT_itinerary(40, 0, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }

    function view(x) {
        document.getElementById("loading2").style.display = "block";
        $.ajax({
            url: "TRN_landtrans_list.php",
            method: "POST",
            asynch: false,
            data: {
                id: x,
            },
            success: function(data) {
                document.getElementById("loading2").style.display = "none";
                $('#translist').html(data);
            }
        });
    }
</script>