<?php
session_start();
include "../site.php";
include "../db=connection.php";
?>
<div class="content-wrapper" style="width: 120%;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="form-control form-control-sm" name="maskapai" id="maskapai" onchange="fungsi_mas()">
                                        <option value="">Pilih Maskapai</option>
                                        <?php
                                        $query_route_sel = "SELECT DISTINCT maskapai FROM LTP_add_route order by maskapai ASC";
                                        $rs_route_sel = mysqli_query($con, $query_route_sel);
                                        while ($row_route_sel = mysqli_fetch_array($rs_route_sel)) {
                                            if ($row_route_sel['maskapai'] != "") {
                                                $query_flight_logo = "SELECT * FROM  LT_flight_logo where kode='" . $row_route_sel['maskapai'] . "'";
                                                $rs_flight_logo = mysqli_query($con, $query_flight_logo);
                                                $row_flight_logo = mysqli_fetch_array($rs_flight_logo);
                                        ?>
                                                <option value="<?php echo $row_route_sel['maskapai']  ?>"><?php echo $row_flight_logo['nama'] . " (" . $row_route_sel['maskapai'] . ") "  ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control form-control-sm" name="city_in" id="city_in" onchange="fungsi_in()">
                                        <option value="">Pilih City IN</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control form-control-sm" name="city_out" id="city_out">
                                        <option value="">Pilih City Out</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" onclick="fungsi_search()" class="btn btn-primary  btn-sm"><i class="fa fa-search"></i></button>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-3" style=" text-align: center;">
                            <h3 class="card-title" style="font-weight:bold;">Flight Detail</h3>
                        </div>
                        <div class="col-md-3" style="text-align: right;">
                            <div style="padding-right: 5px;">
                                <button type="button" onclick="LT_Package(18,0,0)" class="btn btn-primary  btn-sm">Insert</button>
                                <button type="button" onclick="fungsi_edit()" class="btn btn-warning  btn-sm">Edit</button>
                                <button type="button" onclick="fungsi_copy()" class="btn btn-success  btn-sm">Copy</button>
                                <button type="button" onclick="LT_Package(11,0,0)" class="btn btn-info  btn-sm">Upload File Excel</button>
                                <button type="button" onclick="fungsi_del()" class="btn btn-danger  btn-sm">Delete</button>
                                <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#fl-agent">Insert Flight Agent</a>
                            </div>
                        </div>
                    </div>

                    <!-- </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div id="content_awal" style="padding: 20px;">
                        <table id="example" class="table table-striped table-bordered table-sm" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID GROUP</th>
                                    <th>MASKAPAI</th>
                                    <th>IN / OUT</th>
                                    <th>TRIP</th>
                                    <th>TYPE</th>
                                    <th>TGL</th>
                                    <th>CODE</th>
                                    <th>DEPT ARR</th>
                                    <th>ETD ETA</th>
                                    <th>TRANSIT</th>
                                    <th>ADT</th>
                                    <th>CHD</th>
                                    <th>INF</th>
                                    <th>BAGASI</th>
                                    <th>BF</th>
                                    <th>LN</th>
                                    <th>DN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT LTP_route_detail.*,LTP_add_route.maskapai,LTP_add_route.city_in,LTP_add_route.city_out,LT_flight_logo.nama AS maskapai_name,LTP_type_flight.nama as type_name FROM  LTP_route_detail lEFT JOIN LTP_add_route ON LTP_route_detail.route_id=LTP_add_route.id LEFT JOIN LT_flight_logo ON LTP_add_route.maskapai =LT_flight_logo.kode LEFT JOIN LTP_type_flight ON LTP_route_detail.type=LTP_type_flight.id order by id ASC";
                                $rs = mysqli_query($con, $query);
                                $no = 1;
                                while ($row = mysqli_fetch_array($rs)) {

                                    // var_dump($id_grub);
                                    // if (isset($row['route_id'])) {
                                    //     $query_route = "SELECT * FROM LTP_add_route where id=" . $row['route_id'];
                                    //     $rs_route = mysqli_query($con, $query_route);
                                    //     $row_route = mysqli_fetch_array($rs_route);
                                    // }
                                    // if (isset($row['type'])) {
                                    //     $query_type = "SELECT nama FROM LTP_type_flight where id=" . $row['type'];
                                    //     $rs_type = mysqli_query($con, $query_type);
                                    //     $row_type = mysqli_fetch_array($rs_type);
                                    // }
                                    // var_dump($query_type);


                                    // if ($row_route['maskapai'] != "") {
                                    // $query_flight_logo2 = "SELECT * FROM  LT_flight_logo where kode='" .  $row_route['maskapai'] . "'";
                                    // $rs_flight_logo2 = mysqli_query($con, $query_flight_logo2);
                                    // $row_flight_logo2 = mysqli_fetch_array($rs_flight_logo2);

                                ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" id="chck" name="chck" value="<?php echo $row['id_grub'] ?>">
                                        </td>
                                        <td>
                                            <?php echo $row['id_grub'] ?>
                                        </td>
                                        <td><?php echo $row['maskapai_name'] ?></td>
                                        <td style="color: darkgreen;"><?php echo $row['city_in'] . " - " . $row['city_out'] ?></td>
                                        <td><?php echo $row['type_name'] ?></td>
                                        <td><?php echo $row['rute'] ?></td>
                                        <td><?php echo $row['tgl'] ?></td>
                                        <td><?php echo $row['maskapai'] ?></td>
                                        <td><?php echo $row['dept'] . "-" . $row['arr'] ?></td>
                                        <td style="max-width: 90px;"><?php echo $row['take'] . "-" . $row['landing'] ?></td>
                                        <td><?php echo $row['transit'] ?></td>
                                        <td><?php echo $row['adt'] ?></td>
                                        <td><?php echo $row['chd'] ?></td>
                                        <td><?php echo $row['inf'] ?></td>
                                        <td><?php echo $row['bagasi'] ?></td>
                                        <td><?php echo $row['bf'] ?></td>
                                        <td><?php echo $row['ln'] ?></td>
                                        <td><?php echo $row['dn'] ?></td>
                                    </tr>
                                <?php
                                    // }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="content_sort" style="padding: 20px;"></div>
                    <!-- <div class="container" style="padding: 20px; width: 100%; margin: 0px;"> -->
                </div>
                <div class="card-footer">

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
    <div class="modal fade" id="fl-agent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insert Flight </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-fl-agent"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 25
        });
        $('#fl-agent').on('show.bs.modal', function(e) {
            // var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "modal_fl_agent.php",
                method: "POST",
                asynch: false,
                // data: {
                //     id: id,
                // },
                success: function(data) {
                    $('.modal-fl-agent').html(data);
                }
            });
        });
    });
</script>
<script>
    function fungsi_search() {
        $("#content_awal").hide();
        var maskapai = document.getElementById("maskapai").value = document.getElementById("maskapai").value;
        var city_in = document.getElementById("city_in").value = document.getElementById("city_in").value;
        var city_out = document.getElementById("city_out").value = document.getElementById("city_out").value;
        $.ajax({
            url: "get_data_search_flight.php",
            method: "POST",
            asynch: false,
            data: {
                maskapai: maskapai,
                city_in: city_in,
                city_out: city_out
            },
            success: function(data) {
                $('#content_sort').html(data);
            }
        });
    }

    function fungsi_mas() {
        $("#city_in").empty();
        var maskapai = document.getElementById("maskapai").value = document.getElementById("maskapai").value;
        $.post('get_city_in.php', {
            'maskapai': maskapai
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                $('#city_in').append('<option value="">Pilih City IN</option>');
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    if (counter != "") {
                        $('#city_in').append('<option value="' + counter + '">' + counter + '</option>');
                    }
                }
            } else {
                $("#city_in").empty().append('<option selected="selected" value="">Tidak ada Kota tersedia</option>');
            }
        });
    }

    function fungsi_in() {
        $("#city_out").empty();
        var maskapai = document.getElementById("maskapai").value = document.getElementById("maskapai").value;
        var city_in = document.getElementById("city_in").value = document.getElementById("city_in").value;
        $.post('get_city_out.php', {
            'maskapai': maskapai,
            'city_in': city_in
        }, function(data) {
            var jsonData = JSON.parse(data);
            if (jsonData != '') {
                $('#city_out').append('<option value="">Pilih City Out</option>');
                for (var i = 0; i < jsonData.length; i++) {
                    var counter = jsonData[i];
                    if (counter != "") {
                        $('#city_out').append('<option value="' + counter + '">' + counter + '</option>');
                    }
                }
            } else {
                $("#city_out").empty().append('<option selected="selected" value="">Tidak ada Kota tersedia</option>');
            }
        });
    }

    function fungsi_del() {
        let formData = new FormData();
        let checkboxes = document.querySelectorAll('input[name="chck"]:checked');
        let output = [];
        checkboxes.forEach((checkbox) => {
            output.push(checkbox.value);
        });
        var data = output.toString();
        LT_Package(16, data, 0);
    }

    function fungsi_edit() {
        let formData = new FormData();
        let checkboxes = document.querySelectorAll('input[name="chck"]:checked');
        let output = [];
        checkboxes.forEach((checkbox) => {
            output.push(checkbox.value);
        });
        var data = output.toString();
        LT_Package(17, data, 0);
    }

    function fungsi_copy() {
        let formData = new FormData();
        let checkboxes = document.querySelectorAll('input[name="chck"]:checked');
        let output = [];
        checkboxes.forEach((checkbox) => {
            output.push(checkbox.value);
        });

        var data = output.toString();
        console.log(data);
        LT_Package(19, data, 0);
    }
</script>