<?php
include "../db=connection.php";
include "Api_get_hotel_lt_range.php";
session_start();
$query_hotel_negara = "SELECT DISTINCT country FROM hotel_lt Order by country ASC";
$rs_hotel_negara = mysqli_query($con, $query_hotel_negara);

$query_hotel_negara2 = "SELECT DISTINCT name AS nama,country,city FROM hotel_lt ORDER by country ASC,city ASC";
$rs_hotel_negara2 = mysqli_query($con, $query_hotel_negara2);


$query_hotel_data = "SELECT * FROM LAN_Hotel_List WHERE master_id='" . $_POST['id'] . "' && status='".$_POST['hotel']."'";
$rs_hotel_data = mysqli_query($con, $query_hotel_data);
// echo $_POST['hotel']
?>
<input type="hidden" name="master_id" id="master_id" value="<?php echo  $_POST['id'] ?>">
<input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo  $_POST['hotel'] ?>">

<div class="content-wrapper">
    <div class="row">
        <div class="col-12" style="padding: 20px;">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Hotel Landtour List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm tip" onclick="LAN_Package(1,<?php echo $_POST['id'] ?>,0)" title="Back"><i class="fas fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm tip" onclick="LAN_Package(0,<?php echo $_POST['id'] ?>,<?php echo $_POST['hotel'] ?>)" title="Refresh"><i class="fas fa-sync-alt"></i></a>
                                <!-- <a class="btn btn-success btn-sm tip" onclick="LAN_Package(1,<?php echo $_POST['id'] ?>,0)" title="Transport"><i class="fas fas fa-bus"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example-1" class="table table-striped table-bordered table-sm" style="font-size: 10pt; text-align: left;">
                        <thead style="background-color: darkgreen; color: white;">
                            <tr>
                                <th>No</th>
                                <th>Nama Hotel</th>
                                <th>Harga</th>
                                <th>Hari ke- </th>
                                <th>Urutan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $gt = 0;
                            $price = 0;
                            while ($row_hotel_data = mysqli_fetch_array($rs_hotel_data)) {
                                $query_hlt = "SELECT * FROM hotel_lt where id='" . $row_hotel_data['hotel_id'] . "'";
                                $rs_hlt = mysqli_query($con, $query_hlt);
                                $row_hlt = mysqli_fetch_array($rs_hlt);

                                if ($row_hotel_data['rate'] == '1') {
                                    $data = array(
                                        "kurs" =>  $row_hlt['kurs'],
                                        "price" => $row_hlt['rate_low'],
                                    );
                                    $show_rate2 = get_rate($data);
                                    $result_rate2 = json_decode($show_rate2, true);

                                    $gt = $gt + $result_rate2['price'];
                                    $price = $result_rate2['price'];
                                } else {
                                    $data = array(
                                        "kurs" =>  $row_hlt['kurs'],
                                        "price" => $row_hlt['rate_high'],
                                    );
                                    $show_rate2 = get_rate($data);
                                    $result_rate2 = json_decode($show_rate2, true);


                                    $gt = $gt + $result_rate2['price'];
                                    $price = $result_rate2['price'];
                                }
                            ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td>
                                        <div style="font-weight: bold; text-decoration: underline;"><?php echo $row_hlt['name'] ?></div>
                                        <div><?php echo $row_hlt['country'] . " ," . $row_hlt['city'] ?></div>
                                        <div style="font-size: 8pt;"><?php echo "Inclusive : " . $row_hlt['inclusive'] ?></div>

                                    </td>
                                    <td>
                                        <div style="font-weight: bold; text-decoration: underline;">
                                            <?php
                                            if ($row_hotel_data['rate'] == '1') {
                                                echo "Low Rate";
                                            } else {
                                                echo "High Rate";
                                            }
                                            ?>
                                        </div>
                                        <div>
                                            <?php echo "IDR " . number_format($price, 0, ",", ".") ?>
                                        </div>
                                    </td>
                                    <td><?php echo $row_hotel_data['hari'] ?></td>
                                    <td><?php echo $row_hotel_data['urutan'] ?></td>
                                    <td>
                                        <a class="btn btn-warning btn-sm tip" data-toggle="modal" data-target="#hari_itin" data-id="<?php echo $row_hotel_data['id']  ?>" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-danger btn-sm tip" onclick="del_hotel(<?php echo $row_hotel_data['id'] ?>,<?php echo $_POST['id'] ?>)" title="Delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div style="text-align: right;">
                        <h4>GRAND TOTAL : IDR <?php echo number_format($gt, 0, ",", ".") ?></h4>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Form Input Hotel</h3>
                </div>
                <div class="card-body">
                    <form class="row">
                        <div class="col-8">
                            <input class="form-control form-control-sm" list="negara_list2" name="negara2" id="negara2" autocomplete="off" placeholder="Pilih Negara" onchange="fungsi_city()">
                            <datalist id="negara_list2">
                                <?php
                                while ($row_hotel_negara2 = mysqli_fetch_array($rs_hotel_negara2)) {
                                ?>
                                    <option label="<?php echo $row_hotel_negara2['city'] . " , " . $row_hotel_negara2['country'] ?>" value="<?php echo $row_hotel_negara2['nama'] ?>">
                                    <?php
                                }
                                    ?>
                            </datalist>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-primary btn-sm" onclick="show_hotel2()">Search Hotel</button>
                        </div>
                    </form>
                </div>
            </div>
            <div style="padding: 10px;"></div>
            <div id="loading_hotel" style="padding: 10px; display: none;">
                <div class="d-flex justify-content-center">
                    <div style="padding: 10px;">
                        <div class="spinner-grow text-muted"></div>
                        <div class="spinner-grow text-primary"></div>
                        <div class="spinner-grow text-success"></div>
                    </div>
                </div>
            </div>
            <div id="card_hotel"></div>

            <div class="modal fade" id="hari_itin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Hari & Urutan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-data"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success btn-sm" onclick="add_hari()" data-dismiss="modal">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example-1').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
        $(".tip").tooltip({
            placement: 'top'
        });
        $('#hari_itin').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "modal_LAN_hotel_hari.php",
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
    });

    function show_hotel2() {
        $('#card_hotel').html('');
        document.getElementById("loading_hotel").style.display = "block";
        var negara = document.getElementById("negara2").value;
        // var city = document.getElementById("city").value;
        // var keyword = document.getElementById("keyword").value;
        $.ajax({
            url: "get_show_hotel_lt2.php",
            method: "POST",
            asynch: false,
            data: {
                negara: negara,
            },
            success: function(data) {
                document.getElementById("loading_hotel").style.display = "none";
                $('#card_hotel').html(data);
            }
        });
        // alert(negara);
    }

    function fungsi_city() {
        var h_gb = document.getElementById("negara").value;
        $("#city_list").empty();
        $.post('get_city_hotel_lt.php', {
            'brand': h_gb,
        }, function(data) {
            var jsonData = JSON.parse(data);
            // console.log(jsonData);

            if (jsonData != '') {

                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    if (counter.city != "") {
                        console.log(counter.city);
                        var ct = counter.city;
                        $('#city_list').append('<option value="' + counter.city + '"></option>');
                    }
                }
            } else {
                $("#city_list").empty().append('<option selected="selected" value="">Tidak ada Hotel Tersedia</option>');
            }
        });
    }

    function show_hotel_detail(x) {
        var hi = document.getElementById("hi" + x).value;
        // var add_hari_id = document.getElementById("add_hari").value;
        if (hi == "0") {
            $.ajax({
                url: "get_show_hotel_lt_detail.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x,
                    // add_hari_id: add_hari_id
                },
                success: function(data) {
                    $('#card_hotel_detail' + x).html(data);
                    document.getElementById("hi" + x).value = "1";
                }
            });
        } else {
            $('#card_hotel_detail' + x).html("");
            document.getElementById("hi" + x).value = "0";
        }


    }

    function add_rate(x, y) {
        var master = document.getElementById("master_id").value;
        var hotel_pkg_id = document.getElementById("hotel_id").value;
        $.ajax({
            url: "LAN_Insert_Hotel.php",
            method: "POST",
            asynch: false,
            data: {
                master: master,
                rate: x,
                hotel_id: y,
                hotel_pkg_id:hotel_pkg_id

            },
            success: function(data) {
                alert(data);
                LAN_Package(0, master,hotel_pkg_id)
            }
        });
    }

    function del_hotel(x, y) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "LAN_delete_hotel.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        LAN_Package(0, y, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }

    function add_hari() {
        var hari = document.getElementById("hari").value;
        var urutan = document.getElementById("urutan").value;
        var id = document.getElementById("id_hotel").value;
        $.ajax({
            url: "LAN_insert_hotel_hari.php",
            method: "POST",
            asynch: false,
            data: {
                id: id,
                hari: hari,
                urutan: urutan
            },
            success: function(data) {
                alert(data);
            }
        });

    }
</script>