<style>
    .ui-highlight .ui-state-default {
        background: palevioletred !important;
        border-color: palevioletred !important;
        color: white !important;
    }
</style>
<?php
include "../db=connection.php";
if ($_POST['x'] != "") {
    $query_grub2 = "SELECT * FROM LTP_grub_flight where id=" . $_POST['x'];
    $rs_grub2 = mysqli_query($con, $query_grub2);
    $row_grub2 = mysqli_fetch_array($rs_grub2);

    $query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $_POST['x'] . "' order by id ASC limit 1";
    $rs_gf = mysqli_query($con, $query_gf);
    $row_gf = mysqli_fetch_array($rs_gf);

    $query_det2 = "SELECT * FROM  LTP_route_detail where id='" . $row_gf['flight_id'] . "'";
    $rs_det2 = mysqli_query($con, $query_det2);
    $row_det2 = mysqli_fetch_array($rs_det2);
    $val_tgl = [];
    $arr_tgl = explode("-", $row_det2['tgl']);
    foreach ($arr_tgl as $val) {
        if ($val == '7') {
            array_push($val_tgl, '0');
        } else {
            array_push($val_tgl, $val);
        }
    }
    $data_val = implode('-', $val_tgl);


    function get_price($data)
    {
        include "../db=connection.php";

        $query_flg = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $data['id'] . "' order by id ASC";
        $rs_flg = mysqli_query($con, $query_flg);
        $adt = 0 ;
        $chd = 0 ;
        $inf = 0 ;
        $xr = 1;
        $fl_id = '';
        while ($row_flg = mysqli_fetch_array($rs_flg)) {
            if($xr =='1'){
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
        return json_encode(array("adt" => $adt, "chd" => $chd, "inf" => $inf ,"detail" =>$fl_id), true);
    }
?>
    <div class="card">
        <div class="card-body">
            <div class="judul" style="text-align: center;"><b>Surcharger Fee <?php echo $row_grub2['grub_name'] ?></b></div>
            <input type="hidden" name="tgl_fl" id="tgl_fl" value="<?php echo $data_val ?>">
            <div class="div">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tgl</label>
                            <input type="text" id="tgl" name="tgl" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group" style="padding-top: 30px;">
                            <button type="button" class="btn btn-primary btn-sm" onclick="date_range()">Add</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="">Clear</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Dates Selected</label>
                    <textarea class="form-control" id="date_range" rows="3" disabled></textarea>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Adult</label>
                            <input type="number" class="form-control form-control-sm" id="adt" name="adt">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Child</label>
                            <input type="number" class="form-control form-control-sm" id="chd" name="chd">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Infant</label>
                            <input type="number" class="form-control form-control-sm" id="inf" name="inf">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary btn-sm" onclick="add_sfee(<?php echo $_POST['x'] ?>,<?php echo $_POST['y'] ?>,0)">Submit</button>
            </div>
            <div style="padding-top: 20px;">
                <div style="text-align: center; font-weight: bold;">Data Surcharge Fee</div>
                <table class="table  table-bordered table-sm" style="font-size: 12px;">
                    <thead>
                        <tr style="background-color: #008080; color: white;">
                            <th scope="col">#</th>
                            <th scope="col">Tgl</th>
                            <th scope="col">Adt</th>
                            <th scope="col">Chd</th>
                            <th scope="col">Inf</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // var_dump($_POST['x']);
                        $query_sfee = "SELECT * FROM LTP_insert_sfee where id_grub ='" . $_POST['x'] . "' order by date_set ASC";
                        $rs_sfee = mysqli_query($con, $query_sfee);
                        $no = 1;
                        while ($row_sfee = mysqli_fetch_array($rs_sfee)) {

                            $data = array(
                                "id" => $_POST['x'],
                                "fee_adt" => $row_sfee['adt'],
                                "fee_chd" => $row_sfee['adt'],
                                "fee_inf" => $row_sfee['adt'],
                            );

                            $show_price = get_price($data);
                            $result_price = json_decode($show_price, true);

                            $plus_adt =  $result_price['adt'] + $row_sfee['adt'];
                            $plus_chd =  $result_price['chd'] + $row_sfee['chd'];
                            $plus_inf =  $result_price['inf'] + $row_sfee['inf'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $no ?></th>
                                <td><?php echo $row_sfee['date_set'] ?></td>
                                <td><?php echo number_format($row_sfee['adt'], 0, ",", ".")  ?><br><b><?php echo number_format($plus_adt, 0, ",", "."); ?></b></td>
                                <td><?php echo number_format($row_sfee['chd'], 0, ",", ".")  ?><br><b><?php echo number_format($plus_chd, 0, ",", "."); ?></b></td>
                                <td><?php echo number_format($row_sfee['inf'], 0, ",", ".")  ?><br><b><?php echo number_format($plus_inf, 0, ",", "."); ?></b></td>
                                <td>
                                    <a class="badge badge-danger" onclick="del_sfee(<?php echo $row_sfee['id'] ?>,<?php echo $_POST['x'] ?>,<?php echo $_POST['y'] ?>,<?php echo $_POST['z'] ?>); add_form_sfee(<?php echo $_POST['x'] ?>,<?php echo $_POST['y'] ?>,<?php echo $_POST['z'] ?>)"><i class="fa fa-trash"></i></a>
                                </td>
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
    <script>
        $('#tgl').datepicker({
            changeMonth: true,
            changeYear: true,
            multidate: true,
            minDate: 'today',
            dateFormat: "yy-mm-dd",
            beforeShowDay: function(date) {
                var xx = document.getElementById("tgl_fl").value;
                var fl = xx.split("-");
                var day = String(date.getDay());
                if (fl.includes(day)) {
                    return [true, "ui-highlight"];
                } else {
                    return [false];
                }
            },
        });


        function date_range() {
            var hasil = "";
            var data = document.getElementById("date_range").value;
            var tgl = document.getElementById("tgl").value;
            hasil += data;
            if (hasil === "") {
                hasil += tgl;
            } else {
                hasil += "," + tgl;
            }
            $("textarea#date_range").val(hasil);
        }

        function del_sfee(id, x, y, z) {
            var txt;
            var r = confirm("Are you sure to delete?");
            if (r == true) {
                $.ajax({
                    url: "LTP_delete_sfee.php",
                    method: "POST",
                    asynch: false,
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == "success") {
                            LT_itinerary(22, y, 0);
                        } else {
                            alert("Fail to Delete");
                        }
                    }
                });
            }
        }
    </script>
    <script>
        function add_sfee(x, y, z) {
            var tgl = document.getElementById("date_range").value;
            var adt = document.getElementById("adt").value;
            var chd = document.getElementById("chd").value;
            var inf = document.getElementById("inf").value;

            $.ajax({
                url: "LTP_insert_sfee.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x,
                    adt: adt,
                    chd: chd,
                    inf: inf,
                    tgl: tgl,
                    z: z
                },
                success: function(data) {
                    // alert(data);
                    LT_itinerary(22, y, 0);
                }
            });
        }
    </script>
<?php
}
?>