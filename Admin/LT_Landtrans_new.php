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
                    <h3 class="card-title" style="font-weight:bold;">Land Transport Package</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm" onclick="LT_itinerary(3,0,0)"><i class="fa fa-chevron-circle-left"></i></a>
                                <a class="btn btn-primary btn-sm" onclick="LT_itinerary(37,<?php echo $_POST['id'] ?>,0)"><i class="fas fa-sync-alt"></i></a>
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="container" style="padding: 20px;">
                        <div class="accordion" id="land">
                            <input type="hidden" id="tour_id" name="tour_id" value="<?php echo $row['id'] ?>">
                            <?php
                            for ($i = 1; $i <= $hari; $i++) {
                                $query_rute = "SELECT nama FROM  LT_add_rute where hari =" . $i;
                                $rs_rute = mysqli_query($con, $query_rute);
                                $row_rute = mysqli_fetch_array($rs_rute);

                                // $query_negara = "SELECT DISTINCT country FROM Transport_new Order by country ASC";
                                // $rs_negara = mysqli_query($con, $query_negara);


                            ?>
                                <div class="card">
                                    <div class="card-header" style="background-color: darkslategray; color: white;" id="landhead<?php echo $i ?>" data-toggle="collapse" data-target="#land<?php echo $i ?>" aria-expanded="true" aria-controls="land<?php echo $i ?>">
                                        <div><?php echo "Day " . $i . " : " . $row_rute['nama'] ?></div>
                                    </div>
                                    <div class="card-body">
                                        <div id="land<?php echo $i ?>" class="collapse" aria-labelledby="landhead<?php echo $i ?>" data-parent="#land">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input class="form-control form-control-sm" list="negara_list<?php echo $i ?>" name="negara<?php echo $i ?>" id="negara<?php echo $i ?>" autocomplete="off" placeholder="Country - City - Transport Type">
                                                        <datalist id="negara_list<?php echo $i ?>">
                                                            <?php
                                                            $query_negara = "SELECT DISTINCT city,trans_type FROM Transport_new Order by city ASC";
                                                            $rs_negara = mysqli_query($con, $query_negara);
                                                            while ($row_negara = mysqli_fetch_array($rs_negara)) {
                                                                $query_agentsel = "SELECT * FROM agent where id='" . $row_trans2['agent'] . "'";
                                                                $rs_agentsel = mysqli_query($con, $query_agentsel);
                                                                $row_agentsel = mysqli_fetch_array($rs_agentsel);
                                                            ?>
                                                                <option value="<?php echo $row_negara['city'] . "-" . $row_negara['trans_type'] ?>"></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </datalist>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <select class="form-control form-control-sm" id="durasi<?php echo $i ?>" name="durasi<?php echo $i ?>">
                                                            <option value="oneway" selected>One Way</option>
                                                            <option value="twoway">Two Way </option>
                                                            <option value="hd1">Half Day 1</option>
                                                            <option value="hd2">Half Day 2</option>
                                                            <option value="fd1">Full Day 1</option>
                                                            <option value="fd2">Full Day 2</option>
                                                            <option value="kaisoda">Kaisoda</option>
                                                            <option value="luarkota">Luar Kota</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1" id="chck_guide<?php echo $i ?>" name="chck_guide<?php echo $i ?>">
                                                        <label class="form-check-label">
                                                            Guide
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" style="text-align: right; margin: auto;">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-primary btn-sm" onclick="fungsi_search(<?php echo $i ?>)">SEARCH</button>
                                                        <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_guide" data-id="<?php echo $i ?>">Guide</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="content-val<?php echo $i ?>">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="content-selected">
                            <div class="card">
                                <div class="card-header" style="background-color: darkmagenta; color: white;">
                                    <div>Selected Transpor Value</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <?php
                                            $grand_total = 0;
                                            $grand_total_guide = 0;
                                            $pp = 0;
                                            for ($i = 1; $i <= $hari; $i++) {
                                            ?>
                                                <div class="card">
                                                    <div class="card-body" style="padding: 10px;">
                                                        <div class="tittle">
                                                            <div class="row">
                                                                <div class="col-md-6"> <b><?php echo "DAY " . $i ?></b></div>
                                                                <!-- <div class="col-md-6" style="text-align: right;">
                                                                    <span class="badge bg-danger" style="padding: 5px;" data-toggle="modal" data-target="#modal_del_sel_trans" data-id="<?php echo $i ?>" data-tour_id="<?php echo $_POST['id']  ?>"><i class="fa fa-trash"></i></span>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                        <div class="table-sel" style="padding-top: 10px;">
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
                                                        <div class="table_guide">
                                                            <div>Guide</div>
                                                            <table class="table table-striped table-sm" style="font-size: 12px;">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">NO</th>
                                                                        <th scope="col">Country</th>
                                                                        <th scope="col">FEE</th>
                                                                        <th scope="col">SFEE</th>
                                                                        <th scope="col">BREAKFAST</th>
                                                                        <th scope="col">LUNCH</th>
                                                                        <th scope="col">DINNER</th>
                                                                        <th scope="col">VOUCHER TLPN</th>
                                                                        <th scope="col">Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $query_guide = "SELECT * FROM  LT_add_guide_new  where hari='$i' && tour_id='" . $_POST['id'] . "'";
                                                                    $rs_guide = mysqli_query($con, $query_guide);
                                                                    $n = 1;
                                                                    $grand_guide = 0;
                                                                    while ($row_guide = mysqli_fetch_array($rs_guide)) {
                                                                        $query_fee = "SELECT * FROM Guide_Meal where id='" . $row_guide['fee'] . "'";
                                                                        $rs_fee = mysqli_query($con, $query_fee);
                                                                        $row_fee = mysqli_fetch_array($rs_fee);

                                                                        $query_sfee = "SELECT * FROM Guide_Meal where id='" . $row_guide['sfee'] . "'";
                                                                        $rs_sfee = mysqli_query($con, $query_sfee);
                                                                        $row_sfee = mysqli_fetch_array($rs_sfee);

                                                                        $query_bf = "SELECT * FROM Guide_Meal where id='" . $row_guide['bf'] . "'";
                                                                        $rs_bf = mysqli_query($con, $query_bf);
                                                                        $row_bf = mysqli_fetch_array($rs_bf);

                                                                        $query_ln = "SELECT * FROM Guide_Meal where id='" . $row_guide['ln'] . "'";
                                                                        $rs_ln = mysqli_query($con, $query_ln);
                                                                        $row_ln = mysqli_fetch_array($rs_ln);

                                                                        $query_dn = "SELECT * FROM Guide_Meal where id='" . $row_guide['dn'] . "'";
                                                                        $rs_dn = mysqli_query($con, $query_dn);
                                                                        $row_dn = mysqli_fetch_array($rs_dn);

                                                                        $query_vt = "SELECT * FROM Guide_Meal where id='" . $row_guide['vt'] . "'";
                                                                        $rs_vt = mysqli_query($con, $query_vt);
                                                                        $row_vt = mysqli_fetch_array($rs_vt);

                                                                        $guide_total = $row_fee['harga'] + $row_sfee['harga'] + $row_bf['harga'] + $row_ln['harga'] + $row_dn['harga'] + $row_vt['harga'];


                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $n ?></td>
                                                                            <td><?php echo $row_guide['negara'] ?></td>
                                                                            <td><?php echo number_format($row_fee['harga'], 0, ",", ".") ?></td>
                                                                            <td><?php echo number_format($row_sfee['harga'], 0, ",", ".") ?></td>
                                                                            <td><?php echo number_format($row_bf['harga'], 0, ",", ".") ?></td>
                                                                            <td><?php echo number_format($row_ln['harga'], 0, ",", ".") ?></td>
                                                                            <td><?php echo number_format($row_dn['harga'], 0, ",", ".") ?></td>
                                                                            <td><?php echo  number_format($row_vt['harga'], 0, ",", ".") ?></td>
                                                                            <td><?php echo "IDR " . number_format($guide_total, 0, ",", ".") ?></td>
                                                                        </tr>
                                                                    <?php
                                                                        $n++;
                                                                        $grand_guide = $grand_guide + $guide_total;
                                                                    }
                                                                    ?>

                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th colspan="8"></th>
                                                                        <th><?php echo "IDR " . number_format($grand_guide, 0, ",", ".") ?></th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php
                                                $grand_total = $grand_total + $gt;
                                                $grand_total_guide = $grand_total_guide + $gt + $grand_guide;
                                            }
                                            ?>

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
                                <div class="card-footer">
                                    <div style="text-align: right;">
                                        <b><?php echo "IDR " . number_format($grand_total, 0, ",", ".") ?></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="price_list(<?php echo $i ?>,<?php echo  $_POST['id'] ?>)">View Price List</button>
                        <div class="trans_val" style="padding-top: 20px;">
                            <!-- //// acordion -->

                        </div>

                    </div>
                    <!-- <div class="modal fade" id="modal_del_sel_trans" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: darkred; color: white;">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal Delete Selected Transport Value</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-sel-trans"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="del_trans()" data-dismiss="modal">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="modal fade" id="modal_guide" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: darkred; color: white;">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal Guide</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <!-- <button type="button" class="btn btn-danger btn-sm" onclick="del_trans()" data-dismiss="modal">Delete</button> -->
                                </div>
                            </div>
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
        $('#modal_guide').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "modal_guide.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                },
                success: function(data) {
                    $('.modal-data').html(data);
                }
            });
        });
        // $('#modal_trans').on('show.bs.modal', function(e) {
        //     var id = $(e.relatedTarget).data('id');
        //     // alert("onn");
        //     $.ajax({
        //         url: "modal_add_trans.php",
        //         method: "POST",
        //         asynch: false,
        //         data: {
        //             id: id,
        //         },
        //         success: function(data) {
        //             $('.modal-data-add').html(data);
        //         }
        //     });
        // });
        // $('#modal_del_sel_trans').on('show.bs.modal', function(e) {
        //     var id = $(e.relatedTarget).data('id');
        //     var tour_id =  $(e.relatedTarget).data('tour_id');
        //     // alert("onn");
        //     $.ajax({
        //         url: "modal_del_sel_trans.php",
        //         method: "POST",
        //         asynch: false,
        //         data: {
        //             id: id,
        //             tour_id:tour_id
        //         },
        //         success: function(data) {
        //             $('.modal-data-sel-trans').html(data);
        //         }
        //     });
        // });
    });

    function fungsi_negara(x, y) {
        $("#city_list" + y).empty();
        $.post('get_city_trans.php', {
            'brand': x,
        }, function(data) {
            var jsonData = JSON.parse(data);
            // console.log(jsonData);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    if (counter.city != "") {
                        console.log(counter.city);
                        var ct = counter.city;
                        $('#city_list' + y).append('<option value="' + counter.city + '"></option>');
                    }
                }
            } else {
                $("#city_list" + y).empty().append('<option selected="selected" value="">Tidak ada Hotel Tersedia</option>');
            }
        });

    }

    function fungsi_city(x, y) {
        var negara = document.getElementById('negara' + y).value;
        $("#trans_list" + y).empty();
        $.post('get_trans_trans.php', {
            'brand': x,
            'negara': negara
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    if (counter.trans_type != "") {
                        // console.log(counter.trans_type);
                        var ct = counter.trans_type;
                        $('#trans_list' + y).append('<option value="' + counter.trans_type + '"></option>');
                    }
                }
            } else {
                $("#trans_list" + y).empty().append('<option selected="selected" value="">Tidak ada Hotel Tersedia</option>');
            }
        });
    }

    function fungsi_trans(x) {
        var negara = document.getElementById('negara' + y).value;
        var city = document.getElementById('city' + y).value;
        $("#agent_list" + y).empty();
        $.post('get_agent_trans.php', {
            'brand': x,
            'negara': negara,
            'city': city
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    if (counter != "") {
                        $('#agent_list' + y).append('<option value="' + counter + '"></option>');
                    }
                }
            } else {
                $("#agent_list" + y).empty().append('<option selected="selected" value="">Tidak ada Hotel Tersedia</option>');
            }
        });
    }

    function fungsi_search(x) {
        var negara = document.getElementById('negara' + x).value;
        var durasi = document.getElementById("durasi" + x).value;
        $.ajax({
            url: "get_data_search_trans.php",
            method: "POST",
            asynch: false,
            data: {
                negara: negara,
                durasi: durasi,
                id: x
            },
            success: function(data) {
                $('.content-val' + x).html(data);
            }
        });
    }

    function add_list(x, y) {
        var durasi = document.getElementById("durasi" + y).value = document.getElementById("durasi" + y).value;
        var tour_id = $("input[name=tour_id]").val();
        if ($('#chck_guide' + y).is(":checked")) {
            var guide = '1';
        } else {
            var guide = '0';
        }
        $.ajax({
            url: "get_data_add_list_trans.php",
            method: "POST",
            asynch: false,
            data: {
                durasi: durasi,
                day: y,
                tour_id: tour_id,
                trans_type: x,
                guide: guide

            },
            success: function(data) {
                // $('.content-val' + x).html(data);
                alert(data);
            }
        });
    }


    function price_list(x, y) {
        let formData = new FormData();
        formData.append('loop', x);
        formData.append('tour_id', y);
        $.ajax({
            type: 'POST',
            url: "content_all_trans.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('.trans_val').html(data);
            },
        })

    }

    function fungsi_add(x) {
        let formData = new FormData();
        var hari = $("input[name=hari]").val();
        var item = document.getElementById("item").value;
        for (i = 1; i <= item; i++) {
            var negara = document.getElementById("sel" + i).value;
            var fee = document.getElementById("fee" + i).value;
            var sfee = document.getElementById("sfee" + i).value;
            var bf = document.getElementById("bf" + i).value;
            var ln = document.getElementById("ln" + i).value;
            var dn = document.getElementById("dn" + i).value;
            var vt = document.getElementById("vt" + i).value;

            formData.append('fee' + i, fee);
            formData.append('sfee' + i, sfee);
            formData.append('bf' + i, bf);
            formData.append('ln' + i, ln);
            formData.append('dn' + i, dn);
            formData.append('vt' + i, vt);
            formData.append('negara' + i, negara);
        }
        formData.append('hari', hari);
        formData.append('item', item);
        formData.append('tour_id', x);
        $.ajax({
            type: 'POST',
            url: "LT_add_guide_new.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                $('#modal_guide').modal('hide');
                //  LT_itinerary(37,x,0);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        })
        // alert(item);
    }

    function del_tr(x, y) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "del_selected_trans.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        LT_itinerary(37, y, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
</script>