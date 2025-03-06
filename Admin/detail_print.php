<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<?php
session_start();
include "../db=connection.php";
include "Api_LT_total_baru.php";
// include "api_flight_new.php";
include "fungsi_gethotel_price.php";
include "fungsi_profit_flight.php";
include "fungsi_feetl.php";
$query_sub = "SELECT * FROM  LTSUB_itin where  id =" . $_POST['id'];
$rs_sub = mysqli_query($con, $query_sub);
$row_sub = mysqli_fetch_array($rs_sub);
$in = "";
$out = "";

if ($row_sub['landtour'] != "") {
    $query_itin = "SELECT city_in, city_out FROM LT_itinnew where kode  ='" . $row_sub['landtour'] . "' && city_in !='' && city_out !=''  order by id ASC limit 1";
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
            if($show_tps){
                $result_tps = json_decode($show_tps, true);
                $grandtotal = $grandtotal + $result_tps['adt'];
            }

        }
    }

    //  var_dump($grandtotal);
    ////////////////////////////////////////////////////////
    /////// get hotel
    $data_hotel = array(
        "copy_id" => $row_sub['id'],
        "master_id" => $row_sub['master_id'],
    );

    $show_hp = get_hotel_price($data_hotel);
    $result_hp = json_decode($show_hp, true);

    $detail_hotel = $result_hp['pax'] . " (IDR " . number_format($result_hp['twn'], 0, ",", ".") . ")";

}

?>
<div class="content-wrapper" style="width: 120%;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">List Price Paket Tour </h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm" onclick="LT_itinerary(40,0,0)"><i class="fa fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm" onclick="MN_Package(0,<?php echo $_POST['id'] ?>,<?php echo $_POST['master'] ?>)"><i class="fas fa-sync-alt"></i></a>
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
                        <div class="content-info">
                            <div style="text-align: right;">
                                <a class="btn btn-success btn-sm tip" data-toggle="modal" data-target="#hotel" data-id="<?php echo $row_sub['id']  ?>" data-master="<?php echo $row_sub['master_id'] ?>" title="Add Hotel">Hotel</a>
                                <a class="btn btn-primary btn-sm" onclick="LT_itinerary(37,<?php echo $_POST['id'] ?>,0)">Landtrans</a>
                                <a class="btn btn-warning btn-sm tip" data-toggle="modal" data-target="#adm" data-id="<?php echo $row_sub['id']  ?>" data-master="<?php echo $row_sub['master_id'] ?>" title="Add Include">Tour Admission</a>
                                <a class="btn btn-warning btn-sm tip" data-toggle="modal" data-target="#include" data-id="<?php echo $row_sub['id']  ?>" data-master="<?php echo $row_sub['master_id'] ?>" title="Add Include">Include</a>
                                <a class="btn btn-warning btn-sm tip" data-toggle="modal" data-target="#modal-note" data-id="<?php echo $row_sub['id']  ?>" data-master="<?php echo $row_sub['master_id'] ?>" title="Add Note">Note</a>
                                <a class="btn btn-danger btn-sm tip" onclick="add_print(<?php echo $_POST['id'] ?>,<?php echo $row_sub['master_id'] ?>)" title="Print itin">Print Itin</a>
                            </div>
                            <table id="info" class="table table-striped table-bordered table-sm" style="width:100% ; font-size: 10pt;">
                                <thead style="background-color: darkmagenta; color: white;">
                                    <tr>
                                        <th>Landtour Price</th>
                                        <th>Include</th>
                                        <th>Tour Admission</th>
                                        <th>Cost TL /Pax</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div><?php echo $detail_hotel ?></div>
                                            <div>
                                                <ul>
                                                    <?php
                                                    foreach ($result_hp['hotel'] as $val_hotel) {
                                                        echo "<li>" . $val_hotel . "</li>";
                                                    } ?>
                                                </ul>
                                            </div>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                        <table id="example" class="table table-striped table-bordered table-sm" style="width:100% ; font-size: 9pt;">
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
                                $ids = 0;
                                $grub_ids = 0;
                                // $query_grub = "SELECT * FROM LTP_grub_flight where city_in='" . $in . "' && city_out='" . $out . "' order by id ASC";
                                $query_grub = "SELECT LTP_grub_flight.id,LTP_grub_flight.grub_name,LTP_insert_sfee.date_set,LTP_insert_sfee.id as sfee_id,LTP_insert_sfee.adt,LTP_insert_sfee.chd,LTP_insert_sfee.inf,LTP_insert_sfee.ket,LTP_insert_sfee.tgl as tgl_buat FROM LTP_grub_flight INNER JOIN LTP_insert_sfee ON LTP_grub_flight.id = LTP_insert_sfee.id_grub where LTP_grub_flight.city_in='" . $in . "' && LTP_grub_flight.city_out='" . $out . "' order by LTP_grub_flight.grub_name ASC";
                                $rs_grub = mysqli_query($con, $query_grub);
                                $no = 1;
                                // var_dump($query_grub);
                                while ($row_grub = mysqli_fetch_array($rs_grub)) {
                                    if ($grub_ids != $row_grub['id']) {
                                        $ids++;
                                        $grub_ids = $row_grub['id'];
                                    }
                                    $total_manual_adt = 0;
                                    $total_manual_chd = 0;
                                    $total_manual_inf = 0;
                                    $query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $row_grub['id'] . "' order by id ASC";
                                    $rs_gf = mysqli_query($con, $query_gf);
                                    $rs_gf_price = mysqli_query($con, $query_gf);
                                    // var_dump($query_gf);

                                    $query_staff = "SELECT name FROM  login_staff where id='" . $row_grub['ket'] . "'";
                                    $rs_staff = mysqli_query($con, $query_staff);
                                    $row_staff = mysqli_fetch_array($rs_staff);
                                    $ganti_judul ="";
                                    $query_cek = "SELECT * FROM LT_change_judul WHERE copy_id='" .  $row_sub['id'] . "' && grub_id='" . $row_grub['id'] . "'";
                                    $rs_cek = mysqli_query($con, $query_cek);
                                    $row_cek = mysqli_fetch_array($rs_cek);
                                    if(isset($row_cek)){
                                        $ganti_judul =  $row_cek['nama'];
                                    }

                                ?>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input chck_sfee" type="checkbox" id="chck_id" value="<?php echo $row_grub['sfee_id'] ?>">
                                                <label class="form-check-label">
                                                    <?php echo $no ?>
                                                </label>
                                            </div>
                                        </th>
                                        <th><?php echo $row_grub['id'] ?></th>
                                        <th><?php echo $row_grub['sfee_id'] ?></th>
                                        <td>
                                            <div><?php echo $row_grub['grub_name'] ?></div>
                                            <div><?php echo $ganti_judul ?></div>
                                            <div style="color: darkgreen;">Created by : <?php echo $row_staff['name'] . " on " . $row_grub['tgl_buat'] ?></div>
                                        </td>
                                        <td><?php

                                            $query_sfee_tgl = "SELECT tgl FROM LTP_tgl_sfee where sfee_id='" . $row_grub['sfee_id'] . "' order by tgl ASC";
                                            $rs_sfee_tgl = mysqli_query($con, $query_sfee_tgl);
                                            if (mysqli_num_rows($rs_sfee_tgl) > 0) {
                                                while ($row_sfee_tgl = mysqli_fetch_array($rs_sfee_tgl)) {
                                                    echo $row_sfee_tgl['tgl'] . "</br>";
                                                }
                                            } else {
                                                echo $row_grub['date_set'];
                                            }

                                            ?></td>
                                        <td>
                                            <ul>
                                                <?php
                                                while ($row_gf = mysqli_fetch_array($rs_gf)) {
                                                    $query_detail = "SELECT * FROM  LTP_route_detail where id='" . $row_gf['flight_id'] . "'";
                                                    $rs_detail = mysqli_query($con, $query_detail);
                                                    $row_detail = mysqli_fetch_array($rs_detail);
                                                    $flight_name = $row_detail['maskapai'] . " / " . $row_detail['dept'] . " - " . $row_detail['arr'] . " / " . $row_detail['take'] . " - " . $row_detail['landing'];
                                                    echo "<li>" . $flight_name . "</li>";
                                                }
                                                ?>
                                            </ul>
                                        </td>
                                        <!-- flight -->
                                        <td>
                                            <?php
                                            $adt = 0;
                                            $chd = 0;
                                            $inf = 0;
                                            $x_gf = 1;
                                            while ($row_price = mysqli_fetch_array($rs_gf_price)) {
                                                $query_detail2 = "SELECT * FROM  LTP_route_detail where id='" . $row_price['flight_id'] . "'";
                                                $rs_detail2 = mysqli_query($con, $query_detail2);
                                                $row_detail2 = mysqli_fetch_array($rs_detail2);


                                                $query_rt = "SELECT * FROM  LT_add_roundtrip where route_id='" .  $row_detail2['route_id'] . "'";
                                                $rs_rt = mysqli_query($con, $query_rt);
                                                $row_rt = mysqli_fetch_array($rs_rt);
                                                // var_dump($query_rt);

                                                if ($row_price['status'] == '1') {
                                                    if ($x_gf == '1') {
                                                        $adt_rt = $row_rt['adt'];
                                                        $chd_rt = $row_rt['chd'];
                                                        $inf_rt = $row_rt['inf'];
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
                                        <!-- fee tl -->
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

                                            $jml_hari = $row_plus['jml'] + $row_sub['hari'];
                                            echo $jml_hari . " hari";
                                            ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger btn-sm tip" onclick="LT_Get_Flight(0,<?php echo $row_sub['id'] ?>,<?php echo  $row_grub['id'] ?>,<?php echo $row_grub['sfee_id'] ?>)" title="Add Flight"><i class="fa fa-plane"></i></a>
                                            <a class="btn btn-danger btn-sm tip" onclick="AH_Package(0,<?php echo $row_sub['id'] ?>,<?php echo  $row_grub['id'] ?>,<?php echo $row_grub['sfee_id'] ?>)" title="Tambah Hari"><i class="far fa-calendar-plus"></i></a>
                                            <a class="btn btn-primary btn-sm tip" onclick="LT_Get_Judul(0,<?php echo $row_sub['id'] ?>,<?php echo  $row_grub['id'] ?>,<?php echo $row_grub['sfee_id'] ?>)" title="Edit Judul"><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-warning btn-sm tip" title="Edit Rute" onclick="RT_Package(0,<?php echo $row_sub['id'] ?>,<?php echo  $row_grub['id'] ?>,<?php echo $row_grub['sfee_id'] ?>)"><i class="fa fa-tools"></i></a>
                                            <a class="btn btn-success btn-sm tip" title="one page print" onclick="CT_Package(1,<?php echo $row_sub['id'] ?>,<?php echo $row_grub['id'] ?>,<?php echo $row_grub['sfee_id'] ?>)"><i class="fa fa-print"></i></a>
                                            <a class="btn btn-danger btn-sm tip" title="custom print" onclick="CT_Package(0,<?php echo $row_sub['id'] ?>,<?php echo $row_grub['id'] ?>,<?php echo $row_grub['sfee_id'] ?>)"><i class="fa fa-print"></i></a>
                                            <a class="btn btn-warning btn-sm tip" title="hotel print" onclick="CT_Package(3,<?php echo $row_sub['id'] ?>,<?php echo $row_grub['id'] ?>,<?php echo $row_grub['sfee_id'] ?>)"><i class="fa fa-print"></i></a>
                                            <!-- <a class="btn btn-success btn-sm tip" title="Fee TL" onclick="CT_Package(5,<?php echo $row_sub['id'] ?>,<?php echo $row_grub['id'] ?>,<?php echo $row_grub['sfee_id'] ?>)"><i class="fa fa-user-circle"></i></a> -->
                                            <a class="btn btn-warning btn-sm tip" title="Cetak Flayer Marketplace" onclick="CT_Package(4,<?php echo $row_sub['id'] ?>,<?php echo $row_grub['id'] ?>,<?php echo $row_grub['sfee_id'] ?>)"> <i class="fas fa-images"></i></a>
                                            
                                            <!-- <form action="cetak_itinerary.php?id=<?php echo $row_sub['id'] ?>&grub_id=<?php echo $row_grub['id'] ?>&sfee_id=<?php echo $row_grub['sfee_id'] ?>" method="post" target="_blank">
                                                <button type="submit" class="btn btn-success btn-sm">test</button>
                                            </form> -->

                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <div style="padding: 10px 0px;">Jumlah Grub Flight : <?php echo $ids ?></div>
                    </div>
                    <div class="modal fade" id="include" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">INCLUDE</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="hotel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">INSERT HOTEL</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-hotel"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="adm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tour Admission</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-adm"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-note" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Note</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-note"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-paxtl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Pax TL</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-paxtl"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
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
            "iDisplayLength": 10
        });
        $(".tip").tooltip({
            placement: 'top',
            trigger: 'hover'
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#include').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var master = $(e.relatedTarget).data('master');
            $.ajax({
                url: "include_modal.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    master: master
                },
                success: function(data) {
                    $('.modal-data').html(data);
                }
            });
        });
        $('#hotel').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var master = $(e.relatedTarget).data('master');
            $.ajax({
                url: "modal_form_hotel.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    master_id: master
                },
                success: function(data) {
                    $('.modal-data-hotel').html(data);
                }
            });
        });
        $('#adm').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var master = $(e.relatedTarget).data('master');
            $.ajax({
                url: "modal_form_adm.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    master_id: master
                },
                success: function(data) {
                    $('.modal-data-adm').html(data);
                }
            });
        });
        $('#modal-note').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var master = $(e.relatedTarget).data('master');
            $.ajax({
                url: "modal_form_note.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    master_id: master
                },
                success: function(data) {
                    $('.modal-data-note').html(data);
                }
            });
        });
        $('#modal-paxtl').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var master = $(e.relatedTarget).data('master');
            $.ajax({
                url: "modal_form_paxtl.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    master_id: master,
                },
                success: function(data) {
                    $('.modal-data-note').html(data);
                }
            });
        });
    });

    function add_print(x, y) {
        // alert("onn");
        var arr = $('.chck_sfee:checked').map(function() {
            return this.value;
        }).get();
        alert(arr);
        var val = arr.toString();
        PRN_Package(0, x, y, val);
    }


    function add_chck(x) {
        if ($('#chck' + x).is(':checked')) {
            if (x == '9') {
                document.getElementById("chck10").checked = false;
                document.getElementById("chck11").checked = false;
                document.getElementById("chck12").checked = false;
                const auto_arr = [1, 2, 3, 4, 5, 6, 15, 17, 18, 19, 30, 32, 33, 34, 35, 40, 44, 45, 46, 47, 48, 51, 55, 56, 57, 58];
                for (var i = 0; i < auto_arr.length; i++) {
                    document.getElementById("chck" + auto_arr[i]).checked = true;
                }

                const unchck = [41, 42, 43];
                for (var x = 0; x < auto_arr.length; x++) {
                    document.getElementById("chck" + unchck[x]).checked = false;
                }
            } else if (x == '10') {
                document.getElementById("chck9").checked = false;
                document.getElementById("chck11").checked = false;
                document.getElementById("chck12").checked = false;
                const auto_arr = [1, 2, 3, 4, 5, 6, 15, 17, 18, 19, 30, 32, 33, 34, 35, 40, 44, 45, 46, 47, 48, 51, 55, 56, 57, 58];
                for (var i = 0; i < auto_arr.length; i++) {
                    document.getElementById("chck" + auto_arr[i]).checked = true;
                }

                const unchck = [41, 42, 43];
                for (var x = 0; x < auto_arr.length; x++) {
                    document.getElementById("chck" + unchck[x]).checked = false;
                }
            } else if (x == '11') {
                document.getElementById("chck10").checked = false;
                document.getElementById("chck9").checked = false;
                document.getElementById("chck12").checked = false;
                const auto_arr = [1, 2, 3, 4, 5, 6, 15, 17, 18, 19, 30, 32, 33, 34, 35, 40, 41, 42, 43, 47, 48, 51, 55, 56, 57, 58];
                for (var i = 0; i < auto_arr.length; i++) {
                    document.getElementById("chck" + auto_arr[i]).checked = true;
                }
                const unchck = [44, 45, 46];
                for (var x = 0; x < auto_arr.length; x++) {
                    document.getElementById("chck" + unchck[x]).checked = false;
                }
            } else {
                document.getElementById("chck10").checked = false;
                document.getElementById("chck11").checked = false;
                document.getElementById("chck9").checked = false;
                const auto_arr = [1, 2, 3, 4, 5, 6, 15, 17, 18, 19, 30, 32, 33, 34, 35, 40, 41, 42, 43, 47, 48, 51, 55, 56, 57, 58];
                for (var i = 0; i < auto_arr.length; i++) {
                    document.getElementById("chck" + auto_arr[i]).checked = true;
                }
                const unchck = [44, 45, 46];
                for (var x = 0; x < auto_arr.length; x++) {
                    document.getElementById("chck" + unchck[x]).checked = false;
                }
            }
        } else {
            if (x == '9') {
                const auto_arr = [1, 2, 3, 4, 5, 6, 15, 17, 18, 19, 30, 32, 33, 34, 35, 40, 44, 45, 46, 47, 48, 51, 55, 56, 57, 58];
                for (var i = 0; i < auto_arr.length; i++) {
                    document.getElementById("chck" + auto_arr[i]).checked = false;
                }
            } else if (x == '10') {
                const auto_arr = [1, 2, 3, 4, 5, 6, 15, 17, 18, 19, 30, 32, 33, 34, 35, 40, 44, 45, 46, 47, 48, 51, 55, 56, 57, 58];
                for (var i = 0; i < auto_arr.length; i++) {
                    document.getElementById("chck" + auto_arr[i]).checked = false;
                }
            } else if (x == '11') {
                const auto_arr = [1, 2, 3, 4, 5, 6, 15, 17, 18, 19, 30, 32, 33, 34, 35, 40, 41, 42, 43, 47, 48, 51, 55, 56, 57, 58];
                for (var i = 0; i < auto_arr.length; i++) {
                    document.getElementById("chck" + auto_arr[i]).checked = false;
                }
            } else {
                const auto_arr = [1, 2, 3, 4, 5, 6, 15, 17, 18, 19, 30, 32, 33, 34, 35, 40, 41, 42, 43, 47, 48, 51, 55, 56, 57, 58];
                for (var i = 0; i < auto_arr.length; i++) {
                    document.getElementById("chck" + auto_arr[i]).checked = false;
                }
            }
        }

    }
</script>