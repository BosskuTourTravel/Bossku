<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
session_start();
$query_data = "SELECT * FROM LTSUB_itin WHERE id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">LT Flight Date</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <!-- <a class="btn btn-warning btn-sm" onclick="LT_itinerary(3,0,0)"><i class="fa fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm" onclick="LT_itinerary(4,<?php echo $_POST['id'] ?>,0)"><i class="fa fa-plus"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <?php
                        if ($row_data['landtour'] != "undefined") {
                            $query_code = "SELECT * FROM flight_LTnew where tour_code ='" . $row_data['landtour'] . "'  order by rute ASC";
                            $rs_code = mysqli_query($con, $query_code);
                            $i = 1;
                            $cek_code = "";
                            $cek_id = 0;
                            while ($row_code = mysqli_fetch_array($rs_code)) {
                                $detail = $row_code['maskapai'] . " " . $row_code['dept'] . " - " . $row_code['arr'] . " | " . $row_code['take'] . " - " . $row_code['landing'];
                                if ($i == '1') {
                                    $cek_code = $row_code['rute'];
                        ?>
                                    <div class="form-row" style="padding-bottom: 10px;">
                                        <div class="col-md-2">
                                            <label for="">CODE </label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="<?php echo $row_code['id'] ?>" id="id_fl<?php echo $i ?>" name="id_fl<?php echo $i ?>">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    <?php echo $row_code['tour_code'] ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">RUTE</label>
                                            <input type="text" class="form-control  form-control-sm" id="rute_fl<?php echo $i ?>" name="rute_fl<?php echo $i ?>" value="<?php echo $row_code['rute'] ?>" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Flight Detail</label>
                                            <input type="text" class="form-control  form-control-sm" id="detail_fl<?php echo $i ?>" name="detail_fl<?php echo $i ?>" value="<?php echo $detail ?>" disabled>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Flight Date</label>
                                            <input type="date" class="form-control  form-control-sm" id="tgl_fl<?php echo $i ?>" name="tgl_fl<?php echo $i ?>">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Action</label></br>
                                            <button type="button" class="btn btn-primary btn-sm" onclick="add_date(<?php echo $i ?>,<?php echo $row_code['id'] ?>,<?php echo $_POST['id'] ?>)">Add Date</button>
                                        </div>
                                    </div>
                                    <?php

                                } else {
                                    if ($cek_code != $row_code['rute']) {
                                        $cek_code = $row_code['rute'];
                                    ?>
                                        <div class="form-row" style="padding-bottom: 10px;">
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="<?php echo $row_code['id'] ?>" id="id_fl<?php echo $i ?>" name="id_fl<?php echo $i ?>">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        <?php echo $row_code['tour_code'] ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control  form-control-sm" id="rute_fl<?php echo $i ?>" name="rute_fl<?php echo $i ?>" value="<?php echo $row_code['rute'] ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control  form-control-sm" id="detail_fl<?php echo $i ?>" name="detail_fl<?php echo $i ?>" value="<?php echo $detail ?>" disabled>
                                            </div>

                                            <div class="col-md-2">
                                                <input type="date" class="form-control  form-control-sm" id="tgl_fl<?php echo $i ?>" name="tgl_fl<?php echo $i ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-primary btn-sm" onclick="add_date(<?php echo $i ?>,<?php echo $row_code['id'] ?>,<?php echo $_POST['id'] ?>)">Add Date</button>
                                            </div>

                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="form-row" style="padding-bottom: 10px;">
                                            <div class="col-md-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="<?php echo $row_code['id'] ?>" id="id_fl<?php echo $i ?>" name="id_fl<?php echo $i ?>" disabled>
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        <?php echo $row_code['tour_code'] ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control  form-control-sm" id="rute_fl<?php echo $i ?>" name="rute_fl<?php echo $i ?>" value="<?php echo $row_code['rute'] ?>" disabled>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control  form-control-sm" id="detail_fl<?php echo $i ?>" name="detail_fl<?php echo $i ?>" value="<?php echo $detail ?>" disabled>
                                            </div>

                                        </div>
                            <?php
                                    }
                                }
                                $i++;
                            }
                            ?>
                            <div><button type="button" class="btn btn-primary" onclick="add_flight(<?php echo $i ?>,<?php echo $_POST['id'] ?>)">Submit</button></div>
                        <?php
                        } else {
                        }
                        ?>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        Table Add Keberangkatan Pesawat
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered table-sm" style="font-size: 12px;">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Code</th>
                                                    <th scope="col">Rute</th>
                                                    <th scope="col">TGL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $x = 1;
                                                $query_fl_berangkat = "SELECT * FROM flight_keberangkatan where kode='" . $row_data['landtour'] . "' order by rute ASC, flight_date ASC";
                                                $rs_fl_berangkat = mysqli_query($con, $query_fl_berangkat);
                                                while ($row_flb = mysqli_fetch_array($rs_fl_berangkat)) {
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $x ?></th>
                                                        <td><?php echo $row_flb['kode'] ?></td>
                                                        <td><?php echo $row_flb['rute'] ?></td>
                                                        <td><?php echo $row_flb['flight_date'] ?></td>
                                                    </tr>
                                                <?php
                                                    $x++;
                                                }
                                                ?>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        Priview Print
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered table-sm" style="font-size: 12px;">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Flight</th>
                                                    <th scope="col">Tgl</th>
                                                    <th scope="col">Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query_pre = "SELECT * FROM flight_optional WHERE copy_id=" . $_POST['id'];
                                                $rs_pre = mysqli_query($con, $query_pre);
                                                $code = "";
                                                $no = 1;
                                               
                                                while ($row_pre = mysqli_fetch_array($rs_pre)) {
                                                    $fl_date = "";
                                                    $query_fl_berangkat2 = "SELECT * FROM flight_keberangkatan where kode='" . $row_pre['tour_code'] . "' && rute='" . $row_pre['rute'] . "' order by rute ASC, flight_date ASC";
                                                    $rs_fl_berangkat2 = mysqli_query($con, $query_fl_berangkat2);
                                                    while ($row_flb2 = mysqli_fetch_array($rs_fl_berangkat2)) {
                                                        $fl_date .= date("d M ", strtotime($row_flb2['flight_date'])) . ",";
                                                    }

                                                    $adt = 0;
                                                    $query_fl = "SELECT maskapai,adt,chd,inf FROM  flight_LTnew where tour_code='" . $row_pre['tour_code'] . "' && rute='" . $row_pre['rute'] . "'";
                                                    $rs_fl = mysqli_query($con, $query_fl);
                                                    $io = 0;
                                                    while ($row_fl = mysqli_fetch_array($rs_fl)) {
                                                        $adt = $adt + $row_fl['adt'];
                                                        if ($io == 0) {
                                                            $arr_fl = explode(" ", $row_fl['maskapai']);
                                                            $code =  $arr_fl[0];
                                                        }
                                                        $io++;
                                                    }
                                                    $queryflight_logo = "SELECT nama FROM LT_flight_logo WHERE kode='" . $code . "'";
                                                    $rsflight_logo = mysqli_query($con, $queryflight_logo);
                                                    $rowflight_logo = mysqli_fetch_array($rsflight_logo);
                                                ?>
                                                    <tr>
                                                        <th><?php echo $no . " " . $rowflight_logo['nama'] ?></th>
                                                        <td><?php echo  $fl_date ?></td>
                                                        <td><?php echo number_format($adt, 0, ",", ".") ?></td>
                                                    </tr>
                                                <?php
                                                    $no++;
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- /.card-header -->
                <!-- <div class="card-body table-responsive p-0">
                    <div style="padding-bottom: 20px;">
                    </div>

                </div> -->
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <!-- /.row -->
</div>
<script>
    function add_date(x, y, z) {
        let formData = new FormData();
        var tgl = $("input[name=tgl_fl" + x + "]").val();
        var id = y;
        formData.append('tgl', tgl);
        formData.append('id', id);

        $.ajax({
            type: 'POST',
            url: "insert_fl_berangkat.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                LT_itinerary(21, z, 0);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });

    }

    function add_flight(x, y) {
        let formData = new FormData();
        for (var i = 1; i < x; i++) {
            if ($('#id_fl' + i).is(":checked")) {
                var hasil = $("#id_fl" + i).val();
                formData.append('id_fl[]', hasil);
            }
        }
        formData.append('sub_id', y);
        $.ajax({
            type: 'POST',
            url: "insert_flight_optional.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                LT_itinerary(21, y, 0);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }

    $(document).ready(function() {

        $('.submit').on('click', e => {
            // alert("on");
            const $button = $(e.target);
            const $modalBody = $button.closest('.modal-footer').prev('.modal-body');
            const id = $button.data('id');
            const master = $button.data('master');
            const copy = $button.data('copy');
            const hari = $modalBody.find($("input[name=hari]")).val();
            const urutan = $modalBody.find($("input[name=urutan]")).val();

            let formData = new FormData();
            formData.append('id', '3');
            formData.append('master_id', master);
            formData.append('copy_id', copy);
            formData.append('hari', hari);
            formData.append('urutan', urutan);
            formData.append('flight_id', id);
            // work with the values here:
            $.ajax({
                type: 'POST',
                url: "insert_add_LTtransport.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert(msg);
                    LT_itinerary(10, copy, master);
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
            //  console.log(id, hari, rute);

        });
    });
</script>