<?php
include "../db=connection.php";
if ($_POST['x'] != "") {
    $value = $_POST['x'];
    if ($value == "sub") {
        $query_tb = "SELECT * FROM  LTP_add_route where city_in='Surabaya'  order by maskapai ASC , city_in ASC";
        $rs_tb = mysqli_query($con, $query_tb);
    } else if ($value == "sin") {
        $query_tb = "SELECT * FROM  LTP_add_route where city_in='Singapore'  order by maskapai ASC , city_in ASC";
        $rs_tb = mysqli_query($con, $query_tb);
    } else if ($value == "cgk") {
        $query_tb = "SELECT * FROM  LTP_add_route where city_in='Jakarta'  order by maskapai ASC , city_in ASC";
        $rs_tb = mysqli_query($con, $query_tb);
    } else if ($value == "dps") {
        $query_tb = "SELECT * FROM  LTP_add_route where city_in='Denpasar'  order by maskapai ASC , city_in ASC";
        $rs_tb = mysqli_query($con, $query_tb);
    } else {
        $query_tb = "SELECT * FROM  LTP_add_route  order by maskapai ASC , city_in ASC";
        $rs_tb = mysqli_query($con, $query_tb);
    }
?>
    <div style="padding: 20px;">
        <table id="example2" class="table table-striped table-bordered table-sm" style="width:100%; font-size: 12px;">
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
                while ($row_tb = mysqli_fetch_array($rs_tb)) {
                    $query_fl2_tb = "SELECT * FROM LT_flight_logo where kode='" . $row_tb['maskapai'] . "'";
                    $rs_fl2_tb = mysqli_query($con, $query_fl2_tb);
                    $row_fl2_tb = mysqli_fetch_array($rs_fl2_tb);

                ?>
                    <tr>
                        <td style="width: 10px;">
                            <div style="text-align: center; margin: auto;">
                                <input class="form-check-input  view" type="checkbox" id="chck_view_tb<?php echo $row_tb['id'] ?>" name="chck_view_tb<?php echo $row_tb['id'] ?>" value="<?php echo $row_tb['id'] ?>" onclick="add_view_tb(<?php echo $row_tb['id'] ?>)">
                            </div>
                        </td>
                        <td style="width: 120px;"><?php echo $row_fl2_tb['nama'] ?></td>
                        <td style="width: 120px;"><?php echo $row_tb['city_in'] ?></td>
                        <td style="width: 120px;"><?php echo $row_tb['city_out'] ?></td>



                        <td>
                            <?php
                            $query_rr2 = "SELECT * FROM  LT_add_roundtrip where route_id =" . $row_tb['id'];
                            $rs_rr2 = mysqli_query($con, $query_rr2);
                            $row_rr2 = mysqli_fetch_array($rs_rr2);
                            if ($row_rr2['id'] != "") {
                            ?>
                                <div>Roun trip Price : </div>
                                <div>ADT :<?php echo number_format($row_rr2['adt'], 0, ",", ".") . " / CHD : " . number_format($row_rr2['chd'], 0, ",", ".") . " / INF : " . number_format($row_rr2['inf'], 0, ",", "."); ?> </div>
                            <?php
                            }
                            ?>
                            <div class="detail_tb<?php echo $row_tb['id'] ?>" style="display: none;">
                                <div><b style="color: green;"><?php echo $row_tb['city_in'] ?></b> to <b style="color: red;"><?php echo $row_tb['city_out'] ?></b></div>
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
                                        $query_rou_tb = "SELECT * FROM  LTP_route_detail where route_id='" . $row_tb['id'] . "' order by rute ASC , id ASC";
                                        $rs_rou_tb = mysqli_query($con, $query_rou_tb);
                                        while ($row_rou_tb = mysqli_fetch_array($rs_rou_tb)) {
                                            $query_typ_tb = "SELECT * FROM LTP_type_flight where id='" . $row_rou_tb['type'] . "'";
                                            $rs_typ_tb = mysqli_query($con, $query_typ_tb);
                                            $row_typ_tb = mysqli_fetch_array($rs_typ_tb);
                                        ?>
                                            <tr>
                                                <td><?php echo  $row_rou_tb['maskapai'] ?></td>
                                                <td><?php echo  $row_rou_tb['dept'] ?></td>
                                                <td><?php echo  $row_rou_tb['arr'] ?></td>
                                                <td><?php echo  $row_rou_tb['take'] ?></td>
                                                <td><?php echo  $row_rou_tb['landing'] ?></td>
                                                <td><?php if ($row_rou_tb['transit'] != 0) {
                                                        $jam = floor($row_rou_tb['transit'] / 60);
                                                        $menit = fmod($row_rou_tb['transit'], 60);
                                                        echo $jam . "H " . $menit . "M";
                                                    }  ?></td>
                                                <td><?php echo $row_rou_tb['tgl'] ?></td>
                                                <td><?php echo number_format($row_rou_tb['adt'], 0, ",", ".") ?></td>
                                                <td><?php echo number_format($row_rou_tb['chd'], 0, ",", ".") ?></td>
                                                <td><?php echo  number_format($row_rou_tb['inf'], 0, ",", ".") ?></td>
                                                <td><?php echo  number_format($row_rou_tb['bagasi'], 0, ",", ".") ?></td>
                                                <td><?php echo  number_format($row_rou_tb['bagasi_price'], 0, ",", ".") ?></td>
                                                <td><?php echo $row_rou_tb['rute'] ?></td>
                                                <td><?php echo  $row_typ_tb['nama'] ?></td>
                                                <td><a href="#" class="badge badge-danger"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div id="pp_tb<?php echo $row_tb['id'] ?>">
                                </div>

                            </div>
                        </td>
                        <td style="width: 90px;">
                            <input type="hidden" id="cek_tb<?php echo $row_tb['id'] ?>" value="0">
                            <button type="button" class="btn btn-success btn-sm" onclick="LT_Package(10,<?php echo $row_tb['id'] ?>,0)"><i class="fa fa-plane-departure"></i></button>
                            <button type="button" class="btn btn-warning btn-sm" onclick="add_pp_tb(<?php echo $row_tb['id'] ?>)"><i class="fa fa-retweet"></i></button>
                            <button type="button" class="btn btn-primary btn-sm" onclick="LT_Package(12,<?php echo $row_tb['id'] ?>,0)"><i class="fa fa-cog"></i></button>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example2').DataTable({
                "aLengthMenu": [
                    [5, 10, 25, -1],
                    [5, 10, 25, "All"]
                ],
                "iDisplayLength": 25
            });
        });
    </script>
    <script>
        function add_view_tb(x) {
            if ($('#chck_view_tb' + x).is(':checked')) {
                $('.detail_tb' + x).show();
            } else {
                $('.detail_tb' + x).hide();
            }
        }

        function add_pp_tb(x) {
            var cek = document.getElementById('cek_tb' + x).value;
            if (cek === '0') {
                $.ajax({
                    url: "LTP_master_pp.php",
                    method: "POST",
                    asynch: false,
                    data: {
                        x: x,
                    },
                    success: function(data) {
                        $('#pp_tb' + x).html(data);
                        document.getElementById('cek_tb' + x).value = '1';
                    }
                });
            } else {
                $('#pp_tb' + x).html('');
                document.getElementById('cek_tb' + x).value = '0';
            }

        }
    </script>
<?php
}
