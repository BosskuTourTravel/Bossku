<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<?php
session_start();
include "../db=connection.php";
include "Api_LT_total_baru.php";
include "fungsi_gethotel_price.php";
include "fungsi_profit_flight.php";
include "fungsi_feetl.php";

$query_sub = "SELECT * FROM  LTSUB_itin where  id =" . $_POST['id'];
$rs_sub = mysqli_query($con, $query_sub);
$row_sub = mysqli_fetch_array($rs_sub);

if ($row_sub['landtour'] != "") {
    $query_itin = "SELECT city_in, city_out FROM LT_itinnew where kode ='" . $row_sub['landtour'] . "' order by id ASC limit 1";
    $rs_itin = mysqli_query($con, $query_itin);
    $row_itin = mysqli_fetch_array($rs_itin);
    $in = $row_itin['city_in'];
    $out = $row_itin['city_out'];

    //// get value grandtotal tanpa tiket pesawat 
    $query_inc = "SELECT * FROM LT_include_checkbox where tour_id='" . $row_sub['id'] . "' && master_id='" . $row_sub['master_id'] . "'";
    $rs_inc = mysqli_query($con, $query_inc);
    $row_inc = mysqli_fetch_array($rs_inc);

    $query_include = explode(",", $row_inc['chck']);
    $grandtotal = 0;
    foreach ($query_include as $check) {
        if ($check != '1' && $check != '15' && $check != '17' && $check != '32') {
            $data_tps = array(
                "master_id" => $row_sub['master_id'],
                "copy_id" => $row_sub['id'],
                "check_id" => $check
            );
            // var_dump($data_tps);

            $show_tps = get_total($data_tps);
            if ($show_tps) {
                $result_tps = json_decode($show_tps, true);
                $grandtotal = $grandtotal + $result_tps['adt'];
            }
        }
    }
}
/////// get hotel
$data_hotel = array(
    "copy_id" => $row_sub['id'],
    "master_id" => $row_sub['master_id'],
);

$show_hp = get_hotel_price($data_hotel);
$result_hp = json_decode($show_hp, true);
?>
<div class="content-wrapper" style="width: 120%;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Print Package </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm" onclick="MN_Package(0,<?php echo $_POST['id'] ?>,<?php echo $_POST['master_id'] ?>)"><i class="fa fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm" onclick="PRN_Package(0,<?php echo $_POST['id'] ?>,<?php echo $_POST['master_id'] ?>,'<?php echo $_POST['arr'] ?>')"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <div style="padding: 10px;">
                        <div style="text-align: center; font-weight: bold; padding: 5px;">
                            <h3><?php echo $row_sub['judul'] ?></h3>
                        </div>
                        <div style="text-align: center; font-weight: bold; padding-bottom: 20px;"><?php echo $row_sub['landtour'] ?></div>
                        <table id="example" class="table table-striped table-bordered table-sm" style="width:100% ; font-size: 10pt;">
                            <thead style="background-color: darkgreen; color: white;">
                                <tr>
                                    <th>No</th>
                                    <th>ID Grub</th>
                                    <th>ID SFEE</th>
                                    <th>Flight Groub Name</th>
                                    <th>Tgl Keberangkatan</th>
                                    <th>Detail Flight</th>
                                    <th>Flight Price</th>
                                    <th>Fee TL Price</th>
                                    <th>Paket Tour Price</th>
                                    <th>Jml Hari</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = explode(",", $_POST['arr']);
                                $no = 1;
                                foreach ($data as $val) {
                                    $query_grub = "SELECT LTP_grub_flight.id,LTP_grub_flight.grub_name,LTP_insert_sfee.date_set,LTP_insert_sfee.id as sfee_id,LTP_insert_sfee.adt,LTP_insert_sfee.chd,LTP_insert_sfee.inf,LTP_insert_sfee.ket,LTP_insert_sfee.tgl as tgl_buat FROM LTP_grub_flight INNER JOIN LTP_insert_sfee ON LTP_grub_flight.id = LTP_insert_sfee.id_grub where LTP_grub_flight.city_in='" . $in . "' && LTP_grub_flight.city_out='" . $out . "' && LTP_insert_sfee.id='" . $val . "'";
                                    $rs_grub = mysqli_query($con, $query_grub);
                                    $row_grub = mysqli_fetch_array($rs_grub);
                                    // var_dump($query_grub);

                                    $query_staff = "SELECT name FROM  login_staff where id='" . $row_grub['ket'] . "'";
                                    $rs_staff = mysqli_query($con, $query_staff);
                                    $row_staff = mysqli_fetch_array($rs_staff);

                                    $query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $row_grub['id'] . "' order by id ASC";
                                    $rs_gf = mysqli_query($con, $query_gf);
                                    $rs_gf_price = mysqli_query($con, $query_gf);
                                    // var_dump($query_gf);

                                    // var_dump($query_grub);
                                ?>
                                    <tr>
                                        <th><?php echo $no ?></th>
                                        <th><?php echo $row_grub['id'] ?></th>
                                        <th><?php echo $val ?></th>
                                        <td>
                                            <div><?php echo $row_grub['grub_name'] ?></div>
                                            <div style="color: darkgreen;">Created by : <?php echo $row_staff['name'] . " on " . $row_grub['tgl_buat'] ?></div>
                                        </td>
                                        <td>
                                            <?php
                                            $query_sfee_tgl = "SELECT tgl FROM LTP_tgl_sfee where sfee_id='" . $row_grub['sfee_id'] . "' order by tgl ASC";
                                            $rs_sfee_tgl = mysqli_query($con, $query_sfee_tgl);
                                            if (mysqli_num_rows($rs_sfee_tgl) > 0) {
                                                while ($row_sfee_tgl = mysqli_fetch_array($rs_sfee_tgl)) {
                                                    echo $row_sfee_tgl['tgl'] . "</br>";
                                                }
                                            } else {
                                                echo $row_grub['date_set'];
                                            }

                                            ?>
                                        </td>
                                        <td>
                                            <ul>
                                                <?php
                                                $cek_gf = 0;
                                                while ($row_gf = mysqli_fetch_array($rs_gf)) {
                                                    $query_detail = "SELECT * FROM  LTP_route_detail where id='" . $row_gf['flight_id'] . "'";
                                                    $rs_detail = mysqli_query($con, $query_detail);
                                                    $row_detail = mysqli_fetch_array($rs_detail);
                                                    $flight_name = $row_detail['maskapai'] . " / " . $row_detail['dept'] . " - " . $row_detail['arr'] . " / " . $row_detail['take'] . " - " . $row_detail['landing'];
                                                    echo "<li>" . $flight_name . "</li>";
                                                    $cek_gf = 1;
                                                }
                                                ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <?php
                                            $adt = 0;
                                            $chd = 0;
                                            $inf = 0;
                                            $x_gf = 1;
                                            while ($row_price = mysqli_fetch_array($rs_gf_price)) {
                                                $adt_rt = 0;
                                                $chd_rt = 0;
                                                $inf_rt = 0;

                                                $query_detail2 = "SELECT * FROM  LTP_route_detail where id='" . $row_price['flight_id'] . "'";
                                                $rs_detail2 = mysqli_query($con, $query_detail2);
                                                $row_detail2 = mysqli_fetch_array($rs_detail2);


                                                if ($cek_gf == '1') {
                                                    if ($x_gf == '1') {
                                                        $query_rt = "SELECT * FROM  LT_add_roundtrip where route_id='" .  $row_detail2['route_id'] . "'";
                                                        $rs_rt = mysqli_query($con, $query_rt);
                                                        $row_rt = mysqli_fetch_array($rs_rt);
                                                        if (isset($row_rt['id'])) {
                                                            $adt_rt = $row_rt['adt'];
                                                            $chd_rt = $row_rt['chd'];
                                                            $inf_rt = $row_rt['inf'];
                                                        }
                                                    } else {
                                                        $adt_rt = 0;
                                                        $chd_rt = 0;
                                                        $inf_rt = 0;
                                                    }
                                                } else {
                                                    $adt_rt = $row_detail2['adt'];
                                                    $chd_rt = $row_detail2['chd'];
                                                    $inf_rt = $row_detail2['inf'];
                                                }
                                                // var_dump($adt_rt);
                                                $adt = $adt + $adt_rt;
                                                $chd = $chd + $chd_rt;
                                                $inf = $inf + $inf_rt;
                                                $x_gf++;
                                            }
                                            $adt = $adt + $row_grub['adt'];
                                            $chd = $chd + $row_grub['chd'];
                                            $inf = $inf + $row_grub['inf'];
                                            // var_dump($query_detail2);


                                            $query_sfee = "SELECT * FROM LTP_insert_sfee where id='" . $row_grub['sfee_id'] . "'";
                                            $rs_sfee = mysqli_query($con, $query_sfee);
                                            $row_sfee = mysqli_fetch_array($rs_sfee);
                                            // var_dump($adt);

                                            $arr_profit = array(
                                                "adt" => $adt,
                                                "chd" => $chd,
                                                "inf" => $inf
                                            );
                                            // var_dump($arr_profit);
                                            $show_profit = get_profit_flight($arr_profit);
                                            $result_profit = json_decode($show_profit, true);

                                            // $val_adt = $result_profit['adt'] + $row_sfee['adt'];




                                            ?>
                                            <ul>
                                                <li>Adt : IDR <?php echo number_format($result_profit['adt'], 0, ",", ".") ?></li>
                                                <li>Chd : IDR <?php echo number_format($result_profit['chd'], 0, ",", ".")  ?></li>
                                                <li>Inf : IDR <?php echo number_format($result_profit['inf'], 0, ",", ".") ?></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <?php
                                            $data_feetl = array(
                                                "master_id" => $row_sub['master_id'],
                                                "copy_id" => $row_sub['id'],
                                                "grub_id" => $row_grub['id'],
                                                "hotel_id" =>  $result_hp['id_hotel']
                                            );

                                            // var_dump($data_feetl);

                                            $show_feetl = feeTL($data_feetl);
                                            $result_feetl = json_decode($show_feetl, true);
                                            echo "IDR " . number_format($result_feetl['adt'], 0, ",", ".");
                                            ?>
                                        </td>
                                        <td>
                                            <ul>
                                                <?php
                                                $total_manual_adt =  $result_profit['adt'] + $result_hp['twn'] + $result_feetl['adt'] + $grandtotal;
                                                $total_manual_chd =  $result_profit['chd'] + $result_hp['cnb'] + $result_feetl['adt'] + $grandtotal;
                                                $total_manual_inf =  $result_profit['inf'] + $result_hp['inf'] + $result_feetl['adt'] + $grandtotal;
                                                //  var_dump($result_profit['adt'] ."+". $result_hp['twn'] ."+". $result_feetl['adt'] ."+". $grandtotal);

                                                ?>
                                                <li>Adt : IDR <?php echo number_format($total_manual_adt, 0, ",", ".") ?></li>
                                                <li>Chd : IDR <?php echo number_format($total_manual_chd, 0, ",", ".")  ?></li>
                                                <li>Inf : IDR <?php echo number_format($total_manual_inf, 0, ",", ".") ?></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <?php
                                            $query_plus = "SELECT COUNT(*) as jml FROM  LT_AH_Main WHERE copy_id='" . $row_sub['id'] . "' && grub_id='" . $row_grub['id'] . "'";
                                            $rs_plus = mysqli_query($con, $query_plus);
                                            $row_plus = mysqli_fetch_array($rs_plus);
                                            // var_dump($query_plus);

                                            $jml_hari = $row_plus['jml'] + $row_sub['hari'];
                                            echo $jml_hari . " hari";
                                            ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger btn-sm" onclick="del_id(<?php echo $val ?>,'<?php echo $_POST['arr'] ?>',<?php echo $_POST['id'] ?>,<?php echo $_POST['master_id'] ?>)"><i class="fa fa-trash"></i></a>
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
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card" style="padding: 20px;">
                <form action="cetak_custom_all.php?id=<?php echo $row_sub['id'] ?>&grub_id=<?php echo $row_grub['id'] ?>" method="post" target="_blank">
                    <input type="hidden" name="val_id" id="val_id" value="<?php echo $_POST['arr'] ?>">
                    <div style="padding-bottom: 10px;">
                        <label for="">Lain-lain</label>
                        <div class="row">
                            <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="ltwn" id="ltwn" placeholder="Twn" onchange="updateInput(this.value)"></div>
                            <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="lsgl" id="lsgl" placeholder="Sgl" disabled></div>
                            <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="lcnb" id="lcnb" placeholder="Cnb" disabled></div>
                            <div class="col-md-2"><input class="form-control form-control-sm" type="text" name="linf" id="linf" placeholder="Inf" disabled></div>
                        </div>
                    </div>
                    <div style="padding-bottom: 10px;">
                        <label for="">COST TL (Pax)</label>
                        <div class="row">
                            <div class="col-md-2">
                                <input class="form-control form-control-sm" type="number" name="tl_pax" id="tl_pax">
                            </div>
                        </div>
                    </div>
                    <div style="padding-bottom: 10px;">
                    </div>
                    <div style="text-align: center; padding: 10px;">
                        <button type="submit" class="btn btn-success">Print Itinerary</button>
                    </div>
                </form>
            </div>
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
            "iDisplayLength": 10
        });
        $(".tip").tooltip({
            placement: 'top',
            trigger: 'hover'
        });
    });
</script>

<script type="text/javascript">
    function del_id(x, y, z, u) {
        const array = y.split(",");
        val = x.toString();
        console.log(array);

        const index = array.indexOf(val);
        if (index > -1) { // only splice array when item is found
            array.splice(index, 1); // 2nd parameter means remove one item only
        }
        console.log(array);
        var vals = array.toString();
        PRN_Package(0, z, u, vals);
    }

    function updateInput(ish) {
        document.getElementById("lsgl").value = ish;
        document.getElementById("lcnb").value = ish;
        document.getElementById("linf").value = ish;
    }
</script>