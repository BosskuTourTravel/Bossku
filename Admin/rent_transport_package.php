<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
include "../db=connection.php";
$query = "SELECT * FROM  LT_itinerary2 where id =" . $_POST['id'];
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);
$hari = $row['hari'];
//  var_dump($query);
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Rent Transport Package</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm" onclick="LT_itinerary(3,0,0)"><i class="fa fa-chevron-circle-left"></i></a>
                                <a class="btn btn-primary btn-sm" onclick="LAN_Package(1,<?php echo $_POST['id'] ?>,0)"><i class="fas fa-sync-alt"></i></a>
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="container" style="padding: 20px;">
                        <div class="accordion" id="transport">
                            <?php
                            $sql_tr = "SELECT DISTINCT trans_type FROM Transport_new Order by trans_type ASC";
                            $rs_tr = mysqli_query($con, $sql_tr);
                            $tr = 1;
                            while ($row_tr = mysqli_fetch_array($rs_tr)) {

                                $tr = $row_tr['trans_type'];

                                $query_negara = "SELECT Transport_new.id, Transport_new.city,Transport_new.country, Transport_new.trans_type,agent_transport.company FROM Transport_new LEFT JOIN agent_transport ON agent_transport.id=Transport_new.agent WHERE Transport_new.trans_type='".$tr."' GROUP BY Transport_new.city ORDER BY Transport_new.city ASC";
                                $rs_negara = mysqli_query($con, $query_negara);
                                $data = [];
                                while ($row_negara = mysqli_fetch_array($rs_negara)) {
                                    array_push($data, $row_negara);
                                }
                                
                                // var_dump($query_negara);

                            ?>
                                <div class="card">
                                    <div class="card-header" id="transport_head<?php echo $tr ?>" style="background-color: darkgoldenrod; color: white;" data-toggle="collapse" data-target="#transport<?php echo $tr ?>" aria-expanded="true" aria-controls="transport<?php echo $tr ?>">
                                        <div><?php echo $row_tr['trans_type'] ?></div>
                                    </div>
                                    <div class="card-body" style="padding: 5px;">
                                        <div id="transport<?php echo $tr ?>" class="collapse" aria-labelledby="transport_head<?php echo $tr ?>" data-parent="#transport">
                                            <div style="padding: 10px;">
                                                <?php
                                                for ($i = 1; $i <= $hari; $i++) {
                                                    $query_rute = "SELECT nama FROM  LT_add_rute where hari =" . $i;
                                                    $rs_rute = mysqli_query($con, $query_rute);
                                                    $row_rute = mysqli_fetch_array($rs_rute);

                                                    // var_dump($data);
                                                ?>
                                                    <div style="font-weight: bold;"># Day <?php echo $i . " " . $row_rute['nama'] ?></div>
                                                    <div class="row" style="padding: 10px 15px; justify-content: space-around;">
                                                        <div class="col-md-8">
                                                            <?php echo $row_tr['trans_type'] ?>
                                                            <div class="form-group">
                                                                <input class="form-control form-control-sm" list="negara_list<?php echo $i.$tr ?>" name="negara<?php echo $i ?>" id="negara<?php echo $i ?>" autocomplete="off" placeholder="Country - City - Transport Type">
                                                                <datalist id="negara_list<?php echo $i.$tr ?>">
                                                                    <?php
                                                                    foreach($data as $val){
                                                                   
                                                                    // while ($row_negara = mysqli_fetch_array($rs_negara)) {
                                                                    ?>
                                                                        <option data-id="<?php echo $val['id']  ?>" value="<?php echo $val['city'] . " ," . $val['country'] . " " . $val['trans_type'] ?>"></option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </datalist>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2" style="text-align: right; margin: auto;">
                                                            <div class="form-group">
                                                                <button type="button" class="btn btn-primary btn-sm" onclick="fungsi_search(<?php echo $i ?>)">SEARCH</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="content-val<?php echo $i ?>" style="padding: 10px 15px"></div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <!-- <div class="table-sel" style="padding-top: 10px;"> -->
                                                        <div style="font-weight: bold; text-align: center;">Selected Transport</div>
                                                        <div class="card">
                                                            <div class="card-body" style="padding: 10px;">

                                                                <table class="table table-striped table-sm" style="font-size: 12px;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">No</th>
                                                                            <th scope="col">City</th>
                                                                            <th scope="col">Agent</th>
                                                                            <th scope="col">Transport Type</th>
                                                                            <th scope="col">Rent Type</th>
                                                                            <th scope="col">Season</th>
                                                                            <th scope="col">Capacity</th>
                                                                            <th scope="col">Price</th>
                                                                            <th scope="col">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $query_val = "SELECT * FROM  LT_selected_trans where day ='" . $i . "' && tour_id='" . $_POST['id'] . "'";
                                                                        $rs_val = mysqli_query($con, $query_val);
                                                                        $no = 1;
                                                                        $gt = 0;
                                                                        while ($row_val = mysqli_fetch_array($rs_val)) {

                                                                            $query_trans2 = "SELECT * FROM Transport_new where id=" . $row_val['trans_type'];
                                                                            $rs_trans2 = mysqli_query($con, $query_trans2);
                                                                            $row_trans2 = mysqli_fetch_array($rs_trans2);

                                                                            $query_agents = "SELECT * FROM agent where id='" . $row_trans2['agent'] . "'";
                                                                            $rs_agents = mysqli_query($con, $query_agents);
                                                                            $row_agents = mysqli_fetch_array($rs_agents);
                                                                            $p = $row_val['rent_type'];
                                                                            if ($pp <= $row_trans2['seat']) {
                                                                                $pp = $row_trans2['seat'];
                                                                            }
                                                                        ?>
                                                                            <tr style="text-align: left;">
                                                                                <td><?php echo $no ?></td>
                                                                                <td><?php echo $row_trans2['city'] ?></td>
                                                                                <td><?php echo $row_agents['company'] ?></td>
                                                                                <td><?php echo $row_trans2['trans_type'] ?></td>
                                                                                <td><?php echo $row_val['rent_type'] ?></td>
                                                                                <td><?php echo $row_trans2['periode'] ?></td>
                                                                                <td><?php echo $row_trans2['seat'] ?></td>
                                                                                <td><?php echo "IDR " . number_format($row_trans2[$p], 0, ",", ".")  ?></td>
                                                                                <td><span class="badge bg-danger" style="padding: 5px;" onclick="del_tr(<?php echo $row_val['id'] ?>,<?php echo $_POST['id'] ?>)"><i class="fa fa-trash"></i></span></td>
                                                                            </tr>
                                                                        <?php
                                                                            $gt = $gt + $row_trans2[$p];
                                                                            $no++;
                                                                        }
                                                                        ?>

                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <th colspan="7"></th>
                                                                            <th><?php echo "IDR " . number_format($gt, 0, ",", ".") ?></th>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- </div> -->
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div style="font-weight: bold; text-align: center;">Price List / Pax</div>
                                                        <div class="card">
                                                            <div class="card-body" style="padding: 10px;">

                                                                <div class="table-pax" style="padding-top: 10px;">
                                                                    <table class="table table-striped table-sm" style="font-size: 12px;">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">Pax</th>
                                                                                <th scope="col">Price</th>
                                                                                <th scope="col">Price + Guide</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php

                                                                            for ($a = 1; $a <= $pp; $a++) {
                                                                                $nilai = $grand_total / $a;
                                                                                $nilai_guide = $grand_total_guide / $a;
                                                                            ?>
                                                                                <tr>
                                                                                    <td><?php echo $a ?></td>
                                                                                    <td><?php echo "IDR " . number_format($nilai, 0, ",", ".") ?></td>
                                                                                    <td><?php echo "IDR " . number_format($nilai_guide, 0, ",", ".") ?></td>
                                                                                </tr>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                        </div>
                                    </div>
                                    <div class="card-footer" style="padding: 5px;">
                                        <div style="text-align: right; font-weight: bold;"><?php echo "IDR " . number_format(8000000, 0, ",", ".") ?></div>
                                    </div>
                                </div>
                            <?php
                                $tr++;
                            }
                            ?>
                        </div>
                    </div>
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
        $('#example').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
    });

    function fungsi_search(i) {
        var value = $("#negara_list" + i + " option[value='" + $('#negara' + i).val() + "']").attr('data-id');
        $.ajax({
            url: "get_rent_trans.php",
            method: "POST",
            asynch: false,
            data: {
                value: value,
                id: i
            },
            success: function(data) {
                $('.content-val' + i).html(data);
            }
        });
    }
</script>