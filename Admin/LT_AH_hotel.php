<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
include "../db=connection.php";
include "Api_get_hotel_lt_range.php";
$query_data = "SELECT * FROM LT_add_hari WHERE id=" . $_POST['row'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);
//var_dump($query_data);
$hari = $row_data['hari'];

$query_hotel_negara = "SELECT DISTINCT country FROM hotel_lt Order by country ASC";
$rs_hotel_negara = mysqli_query($con, $query_hotel_negara);

?>
<input type="hidden" name="add_hari" id="add_hari" value="<?php echo  $_POST['row'] ?>">
<input type="hidden" name="master_id" id="master_id" value="<?php echo  $row_data['master_id'] ?>">
<input type="hidden" name="copy_id" id="copy_id" value="<?php echo  $row_data['copy_id']  ?>">
<input type="hidden" name="hari" id="hari" value="<?php echo  $hari  ?>">
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Landtour Hotel Hari ke - <?php echo $hari ?></h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm" onclick="LT_itinerary(81,<?php echo $_POST['id'] ?>,0)"><i class="fa fa-chevron-circle-left"></i></a>
                                <a class="btn btn-primary btn-sm" onclick="LT_itinerary(93,<?php echo $_POST['id'] ?>,<?php echo $_POST['row'] ?>)"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="container" style="padding: 20px;">
                        <div id="val_hotel1">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-bordered table-sm">
                                        <thead style="background-color: darkslategrey; color: white; text-align: center;">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Hotel Name</th>
                                                <th scope="col">City</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Rate</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query_hotel_data = "SELECT * FROM LTHR_add_hotel WHERE copy_id='" . $row_data['copy_id'] . "' and master_id='" . $row_data['master_id'] . "' and hari='".$hari."'";
                                            $rs_hotel_data = mysqli_query($con, $query_hotel_data);
                                            // var_dump( $query_hotel_data);
                                            $no = 1;
                                            $gt = 0;
                                            while ($row_hotel_data = mysqli_fetch_array($rs_hotel_data)) {
                                                $query_hlt = "SELECT * FROM hotel_lt where id='" . $row_hotel_data['hotel_id'] . "'";
                                                $rs_hlt = mysqli_query($con, $query_hlt);
                                                $row_hlt = mysqli_fetch_array($rs_hlt);
                                            ?>
                                                <tr>
                                                    <td><?php echo $no ?></td>
                                                    <td><?php echo $row_hlt['name'] ?></td>
                                                    <td><?php echo $row_hlt['city']  ?></td>
                                                    <td><?php echo $row_hlt['type'] ?></td>
                                                    <td><?php
                                                    // var_dump($row_hlt['rate']);
                                                        if ($row_hotel_data['rate'] == '1') {
                                                            echo "Low Rate";
                                                        } else {
                                                            echo "High Rate";
                                                        }
                                                        ?></td>
                                                    <td>
                                                        <?php
                                                        if ($row_hotel_data['rate'] == '1') {
                                                            $data = array(
                                                                "kurs" =>  $row_hlt['kurs'],
                                                                "price" => $row_hlt['rate_low'],
                                                            );
                                                            $show_rate2 = get_rate($data);
                                                            $result_rate2 = json_decode($show_rate2, true);

                                                            $gt = $gt + $result_rate2['price'];
                                                            echo number_format($result_rate2['price'], 0, ",", ".");
                                                        } else {
                                                            $data = array(
                                                                "kurs" =>  $row_hlt['kurs'],
                                                                "price" => $row_hlt['rate_high'],
                                                            );
                                                            $show_rate2 = get_rate($data);
                                                            $result_rate2 = json_decode($show_rate2, true);
                                                          

                                                            $gt = $gt + $result_rate2['price'];
                                                            echo number_format($result_rate2['price'], 0, ",", ".");
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-danger btn-sm" onclick="delete_hotel(<?php echo $row_hotel_data['id'] ?>,<?php echo $_POST['id'] ?>,<?php echo $_POST['row'] ?>)"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                                $no++;
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5">Total Price</th>
                                                <th><?php echo number_format($gt, 0, ",", ".") ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div id="val_hotel2"></div>
                        <div style="padding: 10px;"></div>
                        <div class="hotel" id="hotel">
                            <div class="card">
                                <div class="card-body">
                                    <form class="row g-3">
                                        <div class="col-auto">
                                            <input class="form-control form-control-sm" list="negara_list" name="negara" id="negara" autocomplete="off" placeholder="Pilih Negara" onchange="fungsi_city()">
                                            <datalist id="negara_list">
                                                <?php
                                                while ($row_hotel_negara = mysqli_fetch_array($rs_hotel_negara)) {
                                                ?>
                                                    <option value="<?php echo $row_hotel_negara['country'] ?>"></option>
                                                <?php
                                                }
                                                ?>
                                            </datalist>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-control form-control-sm loop" list="city_list" name="city" id="city" autocomplete="off" placeholder="Pilih Kota">
                                            <datalist id="city_list">
                                            </datalist>
                                        </div>
                                        <div class="col-auto">
                                            <input class="form-control form-control-sm" type="text" id="keyword" name="keyword" placeholder="Hotel Name">
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-primary btn-sm" onclick="show_hotel()">Search Hotel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div style="padding: 10px;"></div>
                            <div id="card_hotel"></div>
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
</script>
<script>
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
                         $('#city_list').append('<option value="'+ counter.city +'"></option>');
                    }
                }
            } else {
                 $("#city_list").empty().append('<option selected="selected" value="">Tidak ada Hotel Tersedia</option>');
            }
        });
    }

    function show_hotel() {
        var negara = document.getElementById("negara").value;
        var city = document.getElementById("city").value;
        var keyword = document.getElementById("keyword").value;
        $.ajax({
            url: "get_show_hotel_lt.php",
            method: "POST",
            asynch: false,
            data: {
                negara: negara,
                city: city,
                keyword: keyword
            },
            success: function(data) {
                $('#card_hotel').html(data);
            }
        });
    }

    function show_hotel_detail(x) {
        var hi = document.getElementById("hi" + x).value;
        var add_hari_id = document.getElementById("add_hari").value;
        if (hi == "0") {
            $.ajax({
                url: "get_show_hotel_lt_detail.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x,
                    add_hari_id: add_hari_id
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
        var copy = document.getElementById("copy_id").value;
        var hari = document.getElementById("hari").value;
        var add_hari = document.getElementById("add_hari").value;
        $.ajax({
            url: "insert_select_hotel_lt.php",
            method: "POST",
            asynch: false,
            data: {
                master: master,
                copy: copy,
                hari: hari,
                rate: x,
                hotel_id: y
            },
            success: function(data) {
                alert(data);
                // $('#card_hotel').html(data);
                // LT_itinerary(93,copy,add_hari);
            }
        });
    }

    function delete_hotel(x, y, z) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "LT_delete_hotel_lt.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        LT_itinerary(93, y, z);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
</script>