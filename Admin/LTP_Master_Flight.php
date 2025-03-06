<?php
session_start();
include "../site.php";
include "../db=connection.php";

$arr = [];
$query_city = "SELECT name,country FROM city order by name ASC";
$rs_city = mysqli_query($con, $query_city);
while ($row = mysqli_fetch_array($rs_city)) {
    $query_con = "SELECT name FROM country where id='" . $row['country'] . "'";
    // var_dump($query_con);
    $rs_con = mysqli_query($con, $query_con);
    $row_con = mysqli_fetch_array($rs_con);
    array_push($arr, array("city" => $row['name'], "country" => $row_con['name']));
}
$arr_fl = [];
$query_fl = "SELECT * FROM LT_flight_logo order by nama ASC";
$rs_fl = mysqli_query($con, $query_fl);
while ($row_fl = mysqli_fetch_array($rs_fl)) {
    array_push($arr_fl, array("kode" => $row_fl['kode'], "nama" => $row_fl['nama']));
}
?>
<div class="content-wrapper" style="width: 120%;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div style="text-align: center;">
                        <h3 class="card-title" style="font-weight:bold;">Master Flight Landtour</h3>
                    </div>
                    <div>
                        <div class="input-group input-group-sm">
                            <div class="input-group-append" style="text-align: left;">
                                <div style="padding-right: 5px;"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_route_modal"><i class="fa fa-plus"></i></button></div>
                                <div style="padding-right: 5px;"><button type="button" class="btn btn-success btn-sm" onclick="LT_Package(11,0,0)"><i class="fa fa-file-excel"></i></button></div>
                                <div style="padding-right: 5px;"><button type="button" id="btn_all" class="btn btn-sm" onclick="add_data('all'); add_filter('all')" style="background-color: orange; color: white;">ALL</button></div>
                                <div style="padding-right: 5px;"><button type="button" id="btn_sub" class="btn btn-sm" onclick="add_data('sub'); add_filter('sub')" style="background-color: green; color: white;">SUB</button></div>
                                <div style="padding-right: 5px;"><button type="button" id="btn_sin" class="btn btn-sm" onclick="add_data('sin'); add_filter('sin') " style="background-color: green; color: white;">SIN</button></div>
                                <div style="padding-right: 5px;"><button type="button" id="btn_cgk" class="btn btn-sm" onclick="add_data('cgk'); add_filter('cgk')" style="background-color: green; color: white;">CGK</button></div>
                                <div style="padding-right: 5px;"><button type="button" id="btn_dps" class="btn btn-sm" onclick="add_data('dps');add_filter('dps')" style="background-color: green; color: white;">DPS</button></div>
                                <!-- <div style="padding-right: 5px;"><button type="button" class="btn btn-success btn-sm" onclick="LT_Package(12,0,0)">SET RETURN</button></div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- modal route -->
                <div class="modal fade" id="add_route_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">ADD ROUTE</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label class="form-label">CITY IN</label>
                                        <input class="form-control" list="cityin_list" id="city_in" name="city_in" autocomplete="off" placeholder="Type to search...">
                                        <datalist id="cityin_list">
                                            <?php
                                            foreach ($arr as $val) {
                                            ?>
                                                <option value="<?php echo $val['city'] ?>"><?php echo $val['country'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">CITY OUT</label>
                                        <input class="form-control" list="cityout_list" id="city_out" name="city_out" autocomplete="off" placeholder="Type to search...">
                                        <datalist id="cityout_list">
                                            <?php
                                            foreach ($arr as $val) {
                                            ?>
                                                <option value="<?php echo $val['city'] ?>"><?php echo $val['country'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Maskapai</label>
                                        <input class="form-control" list="maskapai_list" id="maskapai" name="maskapai" autocomplete="off" placeholder="Type to search...">
                                        <datalist id="maskapai_list">
                                            <?php
                                            foreach ($arr_fl as $val_fl) {
                                            ?>
                                                <option value="<?php echo $val_fl['kode'] ?>"><?php echo $val_fl['nama'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </datalist>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success btn-sm route">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of modal route -->

                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="table_show" style="padding: 20px;">
                        <?php

                        $query = "SELECT * FROM  LTP_add_route order by maskapai ASC , city_in ASC";
                        $rs = mysqli_query($con, $query);
                        
                        ?>
                        <table id="example" class="table table-striped table-bordered table-sm" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr style="text-align: center;">
                                    <th>Id</th>
                                    <th>Maskapai</th>
                                    <th>Departure (City IN)</th>
                                    <th>Arrival (City OUT)</th>
                                    <th>Detail</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_array($rs)) {
                                    // var_dump($row['maskapai']." - ".$row['id']);
                                    $query_fl2 = "SELECT * FROM LT_flight_logo where kode='" . $row['maskapai'] . "'";
                                    $rs_fl2 = mysqli_query($con, $query_fl2);
                                    $row_fl2 = mysqli_fetch_array($rs_fl2);
                                   

                                ?>
                                    <tr>
                                        <td style="width: 10px;">
                                            <div style="text-align: center; margin: auto;">
                                                <input class="form-check-input  view" type="checkbox" id="chck_view<?php echo $row['id'] ?>" name="chck_view<?php echo $row['id'] ?>" value="<?php echo $row['id'] ?>" onclick="add_view(<?php echo $row['id'] ?>)">
                                            </div>
                                        </td>
                                        <td style="width: 120px;"><?php echo $row_fl2['nama'] ?></td>
                                        <td style="width: 120px;"><?php echo $row['city_in'] ?></td>
                                        <td style="width: 120px;"><?php echo $row['city_out'] ?></td>

                                        <td>
                                            <?php
                                            $query_rr = "SELECT * FROM  LT_add_roundtrip where route_id =" . $row['id'];
                                            $rs_rr = mysqli_query($con, $query_rr);
                                            $row_rr = mysqli_fetch_array($rs_rr);
                                            if ($row_rr['id'] != "") {
                                            ?>
                                                <div>Roun trip Price : </div>
                                                <div>ADT :<?php echo number_format($row_rr['adt'], 0, ",", ".")." / CHD : ".number_format($row_rr['chd'], 0, ",", ".")." / INF : ".number_format($row_rr['inf'], 0, ",", ".");?> </div>
                                            <?php
                                            }
                                            ?>

                                            <div class="detail<?php echo $row['id'] ?>" style="display: none;">

                                                <div><b style="color: green;"><?php echo $row['city_in'] ?></b> to <b style="color: red;"><?php echo $row['city_out'] ?></b></div>
                                                <table class="table table-bordered table-sm">
                                                    <thead style="background-color: mediumseagreen;">
                                                        <tr style="text-align: center;">
                                                            <th>Flight</th>
                                                            <th>Dept</th>
                                                            <th>Arr</th>
                                                            <th>ETD</th>
                                                            <th>ETA</th>
                                                            <th>Transit</th>
                                                            <th>Date</th>
                                                            <th>Adt</th>
                                                            <th>Chd</th>
                                                            <th>Inf</th>
                                                            <th>Bagasi</th>
                                                            <th>Bagasi Price</th>
                                                            <th>Groub</th>
                                                            <th>Type</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $query_rou = "SELECT * FROM  LTP_route_detail where route_id='" . $row['id'] . "' order by rute ASC , id ASC";
                                                        $rs_rou = mysqli_query($con, $query_rou);
                                                        // var_dump($query_rou);
                                                        while ($row_rou = mysqli_fetch_array($rs_rou)) {
                                                            $query_typ = "SELECT * FROM LTP_type_flight where id='" . $row_rou['type'] . "'";
                                                            $rs_typ = mysqli_query($con, $query_typ);
                                                            $row_typ = mysqli_fetch_array($rs_typ);
                                                        ?>
                                                            <tr>
                                                                <td><?php echo  $row_rou['maskapai'] ?></td>
                                                                <td><?php echo  $row_rou['dept'] ?></td>
                                                                <td><?php echo  $row_rou['arr'] ?></td>
                                                                <td><?php echo  $row_rou['take'] ?></td>
                                                                <td><?php echo  $row_rou['landing'] ?></td>
                                                                <td><?php if ($row_rou['transit'] != 0) {
                                                                        $jam = floor($row_rou['transit'] / 60);
                                                                        $menit = fmod($row_rou['transit'], 60);
                                                                        echo $jam . "H " . $menit . "M";
                                                                    }  ?></td>
                                                                <td><?php echo $row_rou['tgl'] ?></td>
                                                                <td><?php echo number_format($row_rou['adt'], 0, ",", ".") ?></td>
                                                                <td><?php echo number_format($row_rou['chd'], 0, ",", ".") ?></td>
                                                                <td><?php echo  number_format($row_rou['inf'], 0, ",", ".") ?></td>
                                                                <td><?php echo  number_format($row_rou['bagasi'], 0, ",", ".") ?></td>
                                                                <td><?php echo  number_format($row_rou['bagasi_price'], 0, ",", ".") ?></td>
                                                                <td><?php echo $row_rou['rute'] ?></td>
                                                                <td><?php echo  $row_typ['nama'] ?></td>
                                                                <td><a href="#" class="badge badge-danger"><i class="fa fa-trash"></i></a></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                                <div id="pp<?php echo $row['id'] ?>">
                                                </div>

                                            </div>
                                        </td>
                                        <td style="width: 90px;">
                                            <input type="hidden" id="cek<?php echo $row['id'] ?>" value="0">
                                            <button type="button" class="btn btn-success btn-sm" onclick="LT_Package(10,<?php echo $row['id'] ?>,0)"><i class="fa fa-plane-departure"></i></button>
                                            <button type="button" class="btn btn-warning btn-sm" onclick="add_pp(<?php echo $row['id'] ?>)"><i class="fa fa-retweet"></i></button>
                                            <button type="button" class="btn btn-primary btn-sm" onclick="LT_Package(12,<?php echo $row['id'] ?>,0)"><i class="fa fa-cog"></i></button>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                    <div id="table_show2" tyle="padding: 20px;">

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
<script>
    function add_data(x) {
        if (x === 'all') {
            document.getElementById("btn_all").style.backgroundColor = "orange";
            document.getElementById("btn_sub").style.backgroundColor = "green";
            document.getElementById("btn_sin").style.backgroundColor = "green";
            document.getElementById("btn_cgk").style.backgroundColor = "green";
            document.getElementById("btn_dps").style.backgroundColor = "green";
        } else if (x === 'sub') {
            document.getElementById("btn_all").style.backgroundColor = "green";
            document.getElementById("btn_sub").style.backgroundColor = "orange";
            document.getElementById("btn_sin").style.backgroundColor = "green";
            document.getElementById("btn_cgk").style.backgroundColor = "green";
            document.getElementById("btn_dps").style.backgroundColor = "green";
        } else if (x === 'sin') {
            document.getElementById("btn_all").style.backgroundColor = "green";
            document.getElementById("btn_sub").style.backgroundColor = "green";
            document.getElementById("btn_sin").style.backgroundColor = "orange";
            document.getElementById("btn_cgk").style.backgroundColor = "green";
            document.getElementById("btn_dps").style.backgroundColor = "green";
        } else if (x === 'cgk') {
            document.getElementById("btn_all").style.backgroundColor = "green";
            document.getElementById("btn_sub").style.backgroundColor = "green";
            document.getElementById("btn_sin").style.backgroundColor = "green";
            document.getElementById("btn_cgk").style.backgroundColor = "orange";
            document.getElementById("btn_dps").style.backgroundColor = "green";
        } else if (x === 'dps') {
            document.getElementById("btn_all").style.backgroundColor = "green";
            document.getElementById("btn_sub").style.backgroundColor = "green";
            document.getElementById("btn_sin").style.backgroundColor = "green";
            document.getElementById("btn_cgk").style.backgroundColor = "green";
            document.getElementById("btn_dps").style.backgroundColor = "orange";
        }

    }

    function add_filter(x) {
        $('.table_show').hide();
        $.ajax({
            url: "LTP_master_table.php",
            method: "POST",
            asynch: false,
            data: {
                x: x,
            },
            success: function(data) {
                $('#table_show2').html(data);
            }
        });


    }

    function add_pp(x) {
        var cek = document.getElementById('cek' + x).value;
        if (cek === '0') {
            $.ajax({
                url: "LTP_master_pp.php",
                method: "POST",
                asynch: false,
                data: {
                    x: x,
                },
                success: function(data) {
                    $('#pp' + x).html(data);
                    document.getElementById('cek' + x).value = '1';
                }
            });
        } else {
            $('#pp' + x).html('');
            document.getElementById('cek' + x).value = '0';
        }

    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 25
        });
    });
</script>
<script>
    function add_view(x) {
        if ($('#chck_view' + x).is(':checked')) {
            $('.detail' + x).show();
        } else {
            $('.detail' + x).hide();
        }
    }
</script>
<script>
    $('.route').on('click', e => {
        let formData = new FormData();
        const $button = $(e.target);
        const $modalBody = $button.closest('.modal-footer').prev('.modal-body');

        const city_in = $modalBody.find("#city_in").val();
        const city_out = $modalBody.find("#city_out").val();
        const maskapai = $modalBody.find("#maskapai").val();

        formData.append('city_in', city_in);
        formData.append('city_out', city_out);
        formData.append('maskapai', maskapai);

        // alert(city_in);
        $.ajax({
            type: 'POST',
            url: "LTP_add_route.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                // LT_Package(9, 0, 0);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        })
    });
</script>
<script>
    $('.round').on('click', e => {
        let formData = new FormData();
        const $button = $(e.target);
        const $modalBody = $button.closest('.modal-footer').prev('.modal-body');
    });
</script>