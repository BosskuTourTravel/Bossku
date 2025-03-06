<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
include "../db=connection.php";
// include "Api_LT_total_baru.php";
include "Api_get_hotel_lt_range.php";
include "get_price_selected_hotel.php";

$query = "SELECT Package_rent.id,Package_rent.tgl,Package_rent.nama,login_staff.name as staff FROM Package_rent LEFT JOIN login_staff ON Package_rent.staff=login_staff.id  where master_id='" . $_POST['id'] . "' order by id ASC";
$rs = mysqli_query($con, $query);
// var_dump($query);

$query_master = "SELECT * FROM  LT_itinerary2 where id =" . $_POST['id'];
$rs_master = mysqli_query($con, $query_master);
$row_master = mysqli_fetch_array($rs_master);
$hari = $row_master['hari'];

///// hotel /////////////

$query_hotel_negara = "SELECT DISTINCT country FROM hotel_lt Order by country ASC";
$rs_hotel_negara = mysqli_query($con, $query_hotel_negara);

$query_hotel_negara2 = "SELECT DISTINCT name AS nama,country,city FROM hotel_lt ORDER by country ASC,city ASC";
$rs_hotel_negara2 = mysqli_query($con, $query_hotel_negara2);

$query_hotel_data = "SELECT * FROM LAN_Hotel_List WHERE master_id='" . $_POST['id'] . "'";
$rs_hotel_data = mysqli_query($con, $query_hotel_data);

$query_inc = "SELECT LT_add_listTmp.id,LT_add_listTmp.tour_id,LT_add_listTmp.hari,LT_add_listTmp.urutan,List_tempat.tempat,List_tempat.kurs,List_tempat.price as adt,List_tempat.chd as cnb,List_tempat.infant as inf,LT_add_ops.optional FROM LT_add_listTmp LEFT JOIN List_tempat ON List_tempat.id=LT_add_listTmp.tempat LEFT JOIN LT_add_ops ON (LT_add_ops.master_id=LT_add_listTmp.tour_id && LT_add_ops.hari=LT_add_listTmp.hari && LT_add_ops.urutan=LT_add_listTmp.urutan) WHERE tour_id = '" . $_POST['id'] . "' && LT_add_ops.optional='0' order by LT_add_listTmp.hari,LT_add_listTmp.urutan ASC";
$rs_inc = mysqli_query($con, $query_inc);

$query_ex = "SELECT LT_add_listTmp.id,LT_add_listTmp.tour_id,LT_add_listTmp.hari,LT_add_listTmp.urutan,List_tempat.tempat,List_tempat.kurs,List_tempat.price as adt,List_tempat.chd as cnb,List_tempat.infant as inf,LT_add_ops.optional FROM LT_add_listTmp LEFT JOIN List_tempat ON List_tempat.id=LT_add_listTmp.tempat LEFT JOIN LT_add_ops ON (LT_add_ops.master_id=LT_add_listTmp.tour_id && LT_add_ops.hari=LT_add_listTmp.hari && LT_add_ops.urutan=LT_add_listTmp.urutan) WHERE tour_id = '" . $_POST['id'] . "' && LT_add_ops.optional='1' order by LT_add_listTmp.hari,LT_add_listTmp.urutan ASC";
$rs_ex = mysqli_query($con, $query_ex);


?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Rent Transport Package</h3>
                    <div class="card-tools">
                        <div class="input-group-append" style="text-align: right;">
                            <a class="btn btn-warning btn-sm" onclick="LT_itinerary(0,0,0)"><i class="fa fa-chevron-circle-left"></i></a>
                            <a class="btn btn-primary btn-sm" onclick="LAN_Package(1,<?php echo $_POST['id'] ?>,0)"><i class="fas fa-sync-alt"></i></a>
                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#new_package">New Package</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <!-- meal -->
                    <div class="container" style="padding: 20px;">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div>
                                            <h4>MEAL PACKAGE</h4>
                                        </div>
                                    </div>
                                    <div>
                                        <a class="btn btn-warning btn-sm tip" onclick="hide_meal()" title="Refresh"><i class="fa fa-eye-slash"></i> Hide</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" id="meal-head" style="display: none;">
                                <table id="example_hotel" class="table table-striped table-bordered table-sm" style="font-size: 10pt; text-align: left;">
                                    <thead style="background-color: darkgreen; color: white;">
                                        <tr>
                                            <th>Day</th>
                                            <th>Negara</th>
                                            <th>Breakfast</th>
                                            <th>Lunch</th>
                                            <th>Dinner</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $queryMeal = "SELECT LT_add_meal.*, CASE WHEN bf_meal.negara IS NOT NULL THEN bf_meal.negara WHEN ln_meal.negara IS NOT NULL THEN ln_meal.negara ELSE dn_meal.negara END as negara,CASE WHEN bf_meal.kurs IS NOT NULL THEN bf_meal.kurs WHEN ln_meal.kurs IS NOT NULL THEN ln_meal.kurs ELSE dn_meal.kurs END as kurs, bf_meal.price as breakfast , ln_meal.price as lunch, dn_meal.price as dinner FROM `LT_add_meal` LEFT JOIN Guest_meal2 as bf_meal ON (bf_meal.id=LT_add_meal.bf) LEFT JOIN Guest_meal2 as ln_meal ON (ln_meal.id=LT_add_meal.ln) LEFT JOIN Guest_meal2 as dn_meal ON (dn_meal.id=LT_add_meal.dn) WHERE tour_id='".$_POST['id']."' order by LT_add_meal.hari ASC";
                                        $rsMeal = mysqli_query($con, $queryMeal);
                                        $gt_meal = 0;
                                        // var_dump($queryMeal);
                                        while ($rowMeal = mysqli_fetch_array($rsMeal)) {

                                            $data_bf = array(
                                                "kurs" =>  $rowMeal['kurs'],
                                                "price" => $rowMeal['breakfast'],
                                            );
                                            $show_rate_bf = get_rate($data_bf);
                                            $result_rate_bf = json_decode($show_rate_bf, true);
                                            ///////////////////////
                                            $data_ln = array(
                                                "kurs" =>  $rowMeal['kurs'],
                                                "price" => $rowMeal['lunch'],
                                            );
                                            $show_rate_ln = get_rate($data_ln);
                                            $result_rate_ln = json_decode($show_rate_ln, true);
                                            ///////////////////////////
                                            $data_dn = array(
                                                "kurs" =>  $rowMeal['kurs'],
                                                "price" => $rowMeal['dinner'],
                                            );
                                            $show_rate_dn = get_rate($data_dn);
                                            $result_rate_dn = json_decode($show_rate_dn, true);

                                            $total = $result_rate_bf['price'] + $result_rate_ln['price'] + $result_rate_dn['price'];
                                        ?>
                                            <tr>
                                                <td><?php echo $rowMeal['hari'] ?></td>
                                                <td><?php echo $rowMeal['negara'] ?></td>
                                                <td><?php echo  isset($rowMeal['breakfast']) ? "IDR " . number_format($result_rate_bf['price']) : "exclude"; ?>
                                                </td>
                                                <td><?php echo isset($rowMeal['lunch']) ? "IDR " . number_format($result_rate_ln['price']) : "exclude"; ?></td>
                                                <td><?php echo "IDR " . isset($rowMeal['dinner']) ? "IDR " . number_format($result_rate_dn['price']) : "exclude"; ?></td>
                                                <td><?php echo "IDR " . number_format($total) ?></td>
                                            </tr>
                                        <?php
                                            $gt_meal += $total;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div style="text-align: right;">
                                    <h4>GRAND TOTAL : IDR <?php echo number_format($gt_meal) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- adm -->
                    <div class="container" style="padding: 20px;">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <div>
                                            <h4>ADDMISSION PACKAGE</h4>
                                        </div>
                                    </div>
                                    <div>
                                        <a class="btn btn-warning btn-sm tip" onclick="hide_adm()" title="Refresh"><i class="fa fa-eye-slash"></i> Hide</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" id="adm-head" style="display: none;">
                                <div class="d-flex justify-content-center p-2"><b>INCLUDE</b></div>
                                <table id="example_adm_in" class="table table-striped table-bordered table-sm" style="font-size: 10pt; text-align: left;">
                                    <thead style="background-color: darkgreen; color: white;">
                                        <tr>
                                            <th>Day</th>
                                            <th>List Tempat</th>
                                            <th>adt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total_inc = 0;
                                        while ($row_inc = mysqli_fetch_array($rs_inc)) {
                                            $inc_price = 0;
                                            if (isset($row_inc['kurs']) && $row_inc['adt'] != '0') {
                                                $data_inc = array(
                                                    "kurs" =>  $row_inc['kurs'],
                                                    "price" => $row_inc['adt'],
                                                );
                                                $show_inc = get_rate($data_inc);
                                                $result_rate_inc = json_decode($show_inc, true);
                                                $inc_price = $result_rate_inc['price'];
                                            }
                                        ?>
                                            <tr>
                                                <th><?php echo $row_inc['hari'] ?></th>
                                                <th><?php echo $row_inc['tempat'] ?></th>
                                                <th><?php echo "IDR " . number_format($inc_price) ?></th>
                                            </tr>
                                        <?php
                                            $total_inc += $inc_price;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot style="background-color: darkgreen; color: white;">
                                        <tr>
                                            <td>TOTAL</td>
                                            <td></td>
                                            <td>IDR <?php echo number_format($total_inc) ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="d-flex justify-content-center p-2"><b>EXCLUDE</b></div>
                                <table id="example_adm_ex" class="table table-striped table-bordered table-sm" style="font-size: 10pt; text-align: left;">
                                    <thead style="background-color: darkblue; color: white;">
                                        <tr>
                                            <th>Day</th>
                                            <th>List Tempat</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total_ex = 0;
                                        while ($row_ex = mysqli_fetch_array($rs_ex)) {
                                            $ex_price = 0;
                                            if (isset($row_ex['kurs']) && $row_ex['adt'] != '0') {
                                                $data_ex = array(
                                                    "kurs" =>  $row_ex['kurs'],
                                                    "price" => $row_ex['adt'],
                                                );
                                                $show_ex = get_rate($data_ex);
                                                $result_rate_ex = json_decode($show_ex, true);
                                                $ex_price = $result_rate_ex['price'];
                                            }
                                        ?>
                                            <tr>
                                                <th><?php echo $row_ex['hari'] ?></th>
                                                <th><?php echo $row_ex['tempat'] ?></th>
                                                <th><?php echo "IDR " . number_format($ex_price) ?></th>
                                            </tr>
                                        <?php
                                            $total_ex += $ex_price;
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>IDR <?php echo number_format($total_ex) ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div style="text-align: right;">
                                    <h4>GRAND TOTAL : IDR <?php echo $total_inc ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- hotel -->
                    <div class="container" style="padding: 20px;">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4>HOTEL PACKAGE</h4>
                                        </div>
                                    <div>
                                        <!-- <a class="btn btn-primary btn-sm tip" onclick="LAN_Package(0,<?php echo $_POST['id'] ?>,0)" title="Refresh"><i class="fa fa-plus"> Add Guest Hotel</i></a> -->
                                        <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#new_hotel_package" data-id="<?php echo $_POST['id'] ?>"><i class="fa fa-plus"> Add Hotel Package</i></a>
                                        <a class="btn btn-warning btn-sm tip" onclick="hide_hotel()" title="Refresh"><i class="fa fa-eye-slash"></i> Hide</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" id="hotel-head" style="display: none;">
                                <table id="example_hotel_package" class="table table-striped table-bordered table-sm text-xsmall" style="font-size: 10pt; text-align: left;">
                                    <thead style="background-color: darkgreen; color: white;">
                                        <tr>
                                            <th>No</th>
                                            <th>Hotel Package Name</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $query_hotel_package = "SELECT Hotel_Package.*,login_staff.name as staff FROM Hotel_Package LEFT JOIN login_staff ON login_staff.id=Hotel_Package.status where Hotel_Package.master_id='" . $_POST['id'] . "' order by Hotel_Package.id DESC";
                                        $rs_hotel_package = mysqli_query($con, $query_hotel_package);
                                        while ($row_hp = mysqli_fetch_array($rs_hotel_package)) {
                                            $tgl = date_create($row_hp['tgl']);
                                        ?>
                                            <tr>
                                                <td><?php echo $no ?></td>
                                                <td><?php echo $row_hp['nama'] ?></td>
                                                <td class="small">
                                                    <div><?php echo "Created at : " . date_format($tgl, "d-m-Y") ?></div>
                                                    <div><b><?php echo $row_hp['staff'] ?></b></div>
                                                </td>
                                                <td>

                                                    <a class="btn btn-success btn-sm p-1" data-toggle="modal" data-target="#detail_hotel_package" data-id="<?php echo $_POST['id'] ?>" data-hotel="<?php echo $row_hp['id']  ?>"><i class="fa fa-plus"> Detail Hotel</i></a>
                                                    <a class="btn btn-warning btn-sm p-1" onclick="LAN_Package(0,<?php echo $_POST['id'] ?>,<?php echo $row_hp['id']  ?>)"><i class="fa fa-plus"> ADD HOTEL</i></a>
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
                    <!-- rent -->
                    <div class="container" style="padding: 20px;">
                        <?php
                        while ($row = mysqli_fetch_array($rs)) {

                            $query_rent = "SELECT Rent_selected.id ,Rent_selected.id_package,Rent_selected.id_trans,Rent_selected.id_agent,Rent_selected.trans_type,Rent_selected.seat,Rent_selected.country,Rent_selected.city,Rent_selected.periode,Rent_selected.tipe,Rent_selected.kurs,Rent_selected.price,Rent_selected.status,agent_transport.name as agent FROM Rent_selected LEFT JOIN agent_transport ON Rent_selected.id_agent=agent_transport.id where Rent_selected.id_package=" . $row['id'] . "  order by Rent_selected.id ASC";
                            $rs_rent = mysqli_query($con, $query_rent);
                            // var_dump($query_rent);
                        ?>
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div><?php echo $row['nama'] ?></div>
                                            <div><?php echo "Di buat : " . $row['tgl'] . " Oleh " . $row['staff'] ?></div>
                                        </div>
                                        <div>
                                            <a class="btn btn-warning btn-sm tip" data-toggle="modal" data-target="#edit_package" data-id="<?php echo $row['id'] ?>" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#add_package" data-id="<?php echo $row['id'] ?>"><i class="fa fa-plus"></i></a>
                                            <a class="btn btn-danger btn-sm tip" onclick="del_all(<?php echo $row['id']  ?>,<?php echo  $_POST['id'] ?>)" title="Delete Data"><i class="fas fa-trash"></i></a>
                                            <a class="btn btn-warning btn-sm tip" onclick="" title="Refresh"><i class="fa fa-eye-slash"></i> Hide</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>Rent Transport</div>
                                            <table class="table table-striped table-sm" style="font-size: 12px;">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Hari</th>
                                                        <th scope="col">Agent</th>
                                                        <th scope="col">Region</th>
                                                        <th scope="col">Rent Type</th>
                                                        <th scope="col">Durasi</th>
                                                        <th scope="col">Season</th>
                                                        <th scope="col">Capacity</th>
                                                        <th scope="col">Price</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $gt = 0;
                                                    while ($row_rent = mysqli_fetch_array($rs_rent)) {

                                                        $pr = 5;
                                                        $idr = 0;
                                                        $datareq = array(
                                                            "kurs" =>  $row_rent['kurs'],
                                                            "nominal" => $row_rent['price'],
                                                        );
                                                        $adt_kurs = get_kurs($datareq);
                                                        if ($adt_kurs) {
                                                            $rs_adt_kurs = json_decode($adt_kurs, true);
                                                            if (isset($rs_adt_kurs['data'])) {

                                                                $idr = $rs_adt_kurs['data'];
                                                                $sql_profit = "SELECT * FROM LTR_profit_range where price1 <='" . $idr . "' && price2 >='" . $idr . "'";
                                                                $rs_profit = mysqli_query($con, $sql_profit);
                                                                $row_profit = mysqli_fetch_array($rs_profit);
                                                                if (isset($row_profit['id'])) {
                                                                    $pr = $row_profit['profit'];
                                                                }
                                                                $persen = intval($pr) / 100;
                                                                $p_oneway = intval($idr) + (intval($idr) * $persen);
                                                                $gt = $gt + $p_oneway;
                                                                //  var_dump(intval($idr) ." + ". "(".intval($idr) ." * ". $persen.")");
                                                            }
                                                        }

                                                    ?>
                                                        <tr>
                                                            <td><?php echo $row_rent['status'] ?></td>
                                                            <td><?php echo $row_rent['agent'] ?></td>
                                                            <td><?php echo $row_rent['country'] . " - " . $row_rent['city'] ?></td>
                                                            <td><?php echo $row_rent['trans_type'] ?></td>
                                                            <td><?php echo $row_rent['tipe'] ?></td>
                                                            <td><?php echo $row_rent['periode'] ?></td>
                                                            <td><?php echo $row_rent['seat'] ?></td>
                                                            <td><?php echo "IDR " . number_format($p_oneway)  ?></td>
                                                            <td>
                                                                <span class="badge bg-danger" style="padding: 5px;" onclick="del_rent(<?php echo $row_rent['id']  ?>,<?php echo  $_POST['id'] ?>)"><i class="fa fa-trash"></i></span>
                                                                <span class="badge bg-warning" style="padding: 5px;" data-toggle="modal" data-target="#edit_data" data-id="<?php echo $row_rent['id'] ?>" data-package="<?php echo $row['id'] ?>"><i class="fa fa-plus"></i></span>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="7"></th>
                                                        <th colspan="2">IDR <?php echo number_format($gt) ?></th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            <div class="table_guide">
                                                <div class="d-flex justify-content-between align-items-center my-2">
                                                    <div>Guide</div>
                                                    <div>
                                                        <span class="badge bg-warning" style="padding: 5px;" data-toggle="modal" data-target="#modal_guide" data-id="<?php echo $row['id'] ?>" data-tourid="<?php echo $_POST['id'] ?>"><i class="fa fa-plus"></i></span>
                                                        <span class="badge bg-warning" style="padding: 5px;" data-toggle="modal" data-target="#modal_fee" data-id="<?php echo $row['id'] ?>" data-tourid="<?php echo $_POST['id'] ?>">Fee & Sfee</span>
                                                        <span class="badge bg-warning" style="padding: 5px;" data-toggle="modal" data-target="#modal_meal" data-id="<?php echo $row['id'] ?>" data-tourid="<?php echo $_POST['id'] ?>">Meal</span>
                                                        <span class="badge bg-warning" style="padding: 5px;" data-toggle="modal" data-target="#modal_vt" data-id="<?php echo $row['id'] ?>" data-tourid="<?php echo $_POST['id'] ?>">Voucher Tlpn</span>
                                                    </div>
                                                </div>
                                                <table class="table table-striped table-sm" style="font-size: 12px;">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Hari</th>
                                                            <th scope="col">Country</th>
                                                            <th scope="col">FEE</th>
                                                            <th scope="col">SFEE</th>
                                                            <th scope="col">BREAKFAST</th>
                                                            <th scope="col">LUNCH</th>
                                                            <th scope="col">DINNER</th>
                                                            <th scope="col">VOUCHER TLPN</th>
                                                            <th scope="col">Total</th>
                                                            <th scope="col">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $query_guide = "SELECT * FROM  LT_add_guide_price  where tour_id='" . $_POST['id'] . "' && package_id='" . $row['id'] . "' order by hari ASC";
                                                        $rs_guide = mysqli_query($con, $query_guide);

                                                        $query_guide_manual = "SELECT * FROM  LT_add_guide_price_manual  where tour_id='" . $_POST['id'] . "' && package_id='" . $row['id'] . "' order by hari ASC";
                                                        $rs_guide_manual = mysqli_query($con, $query_guide_manual);
                                                        // var_dump($query_guide);
                                                        $n = 1;
                                                        $grand_guide = 0;
                                                        while ($row_guide = mysqli_fetch_array($rs_guide)) {
                                                            $fee_price = 0;
                                                            $sfee_price = 0;
                                                            $bf_price = 0;
                                                            $ln_price = 0;
                                                            $dn_price = 0;
                                                            $vt_price = 0;
                                                            $query_fee = "SELECT * FROM Guide_Meal where id='" . $row_guide['fee'] . "'";
                                                            $rs_fee = mysqli_query($con, $query_fee);
                                                            $row_fee = mysqli_fetch_array($rs_fee);
                                                            if (isset($row_fee['id'])) {

                                                                $data_fee = array(
                                                                    "kurs" =>  $row_fee['kurs'],
                                                                    "price" => $row_fee['harga'],
                                                                );
                                                                $show_fee = get_rate($data_fee);
                                                                $result_fee = json_decode($show_fee, true);

                                                                $fee_price = $result_fee['price'];
                                                            }

                                                            $query_sfee = "SELECT * FROM Guide_Meal where id='" . $row_guide['sfee'] . "'";
                                                            $rs_sfee = mysqli_query($con, $query_sfee);
                                                            $row_sfee = mysqli_fetch_array($rs_sfee);
                                                            if (isset($row_sfee['id'])) {

                                                                                                                                
                                                                $data_sfee = array(
                                                                    "kurs" =>  $row_sfee['kurs'],
                                                                    "price" => $row_sfee['harga'],
                                                                );
                                                                $show_sfee = get_rate($data_sfee);
                                                                $result_sfee = json_decode($show_sfee, true);
                                                                $sfee_price = $result_sfee['price'];
                                                            }

                                                            $query_bf = "SELECT * FROM Guide_Meal where id='" . $row_guide['bf'] . "'";
                                                            $rs_bf = mysqli_query($con, $query_bf);
                                                            $row_bf = mysqli_fetch_array($rs_bf);
                                                            if (isset($row_bf['id'])) {
                                                                $data_bf = array(
                                                                    "kurs" =>  $row_bf['kurs'],
                                                                    "price" => $row_bf['harga'],
                                                                );
                                                                $show_bf = get_rate($data_bf);
                                                                $result_bf = json_decode($show_bf, true);

                                                                $bf_price = $result_bf['price'];
                                                            }

                                                            $query_ln = "SELECT * FROM Guide_Meal where id='" . $row_guide['ln'] . "'";
                                                            $rs_ln = mysqli_query($con, $query_ln);
                                                            $row_ln = mysqli_fetch_array($rs_ln);
                                                            if (isset($row_ln['id'])) {

                                                                $data_ln = array(
                                                                    "kurs" =>  $row_ln['kurs'],
                                                                    "price" => $row_ln['harga'],
                                                                );
                                                                $show_ln = get_rate($data_ln);
                                                                $result_ln = json_decode($show_ln, true);
                                                                $ln_price = $result_ln['price'];
                                                            }

                                                            $query_dn = "SELECT * FROM Guide_Meal where id='" . $row_guide['dn'] . "'";
                                                            $rs_dn = mysqli_query($con, $query_dn);
                                                            $row_dn = mysqli_fetch_array($rs_dn);
                                                            if (isset($row_dn['id'])) {

                                                                $data_dn = array(
                                                                    "kurs" =>  $row_dn['kurs'],
                                                                    "price" => $row_dn['harga'],
                                                                );
                                                                $show_dn = get_rate($data_dn);
                                                                $result_dn = json_decode($show_dn, true);
                                                                $dn_price = $result_dn['price'];
                                                            }

                                                            $query_vt = "SELECT * FROM Guide_Meal where id='" . $row_guide['vt'] . "'";
                                                            $rs_vt = mysqli_query($con, $query_vt);
                                                            $row_vt = mysqli_fetch_array($rs_vt);
                                                            if (isset($row_vt['id'])) {

                                                                $data_vt = array(
                                                                    "kurs" =>  $row_vt['kurs'],
                                                                    "price" => $row_vt['harga'],
                                                                );
                                                                $show_vt = get_rate($data_vt);
                                                                $result_vt = json_decode($show_vt, true);

                                                                $vt_price = $result_vt['price'];
                                                            }

                                                            $guide_total = $fee_price + $sfee_price + $bf_price + $ln_price + $dn_price + $vt_price


                                                        ?>
                                                            <tr>
                                                                <td><?php echo $row_guide['hari'] ?></td>
                                                                <td><?php echo $row_guide['negara'] ?></td>
                                                                <td><?php echo number_format($fee_price, 0, ",", ".") ?></td>
                                                                <td><?php echo number_format($sfee_price, 0, ",", ".") ?></td>
                                                                <td><?php echo number_format($bf_price, 0, ",", ".") ?></td>
                                                                <td><?php echo number_format($ln_price, 0, ",", ".") ?></td>
                                                                <td><?php echo number_format($dn_price, 0, ",", ".") ?></td>
                                                                <td><?php echo  number_format($vt_price, 0, ",", ".") ?></td>
                                                                <td><?php echo "IDR " . number_format($guide_total, 0, ",", ".") ?></td>
                                                                <td>
                                                                    <span class="badge bg-danger" style="padding: 5px;" onclick="del_guide(<?php echo $row_guide['id']  ?>,<?php echo  $_POST['id'] ?>)"><i class="fa fa-trash"></i></span>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                            $n++;
                                                            $grand_guide = $grand_guide + $guide_total;
                                                        }
                                                        while ($row_guide_manual = mysqli_fetch_array($rs_guide_manual)) {
                                                            $guide_total_manual = $row_guide_manual['fee'] + $row_guide_manual['sfee'] + $row_guide_manual['bf'] + $row_guide_manual['ln'] + $row_guide_manual['dn'] + $row_guide_manual['vt'];
                                                            $grand_guide = $grand_guide + $guide_total_manual;
                                                            
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $row_guide_manual['hari'] ?></td>
                                                                <td></td>
                                                                <td><?php echo number_format($row_guide_manual['fee'], 0, ",", ".") ?></td>
                                                                <td><?php echo number_format($row_guide_manual['sfee'], 0, ",", ".") ?></td>
                                                                <td><?php echo number_format($row_guide_manual['bf'], 0, ",", ".") ?></td>
                                                                <td><?php echo number_format($row_guide_manual['ln'], 0, ",", ".") ?></td>
                                                                <td><?php echo number_format($row_guide_manual['dn'], 0, ",", ".") ?></td>
                                                                <td><?php echo number_format($row_guide_manual['vt'], 0, ",", ".") ?></td>
                                                                <td><?php echo "IDR " . number_format($guide_total_manual, 0, ",", ".") ?></td>
                                                                <td>
                                                                    <span class="badge bg-danger" style="padding: 5px;" onclick="del_guide_manual(<?php echo $row_guide_manual['id']  ?>,<?php echo  $_POST['id'] ?>)"><i class="fa fa-trash"></i></span>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                            $n++;
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
                                                <div></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $query_pax = "SELECT seat FROM Rent_selected  where id_package=" . $row['id'] . "  order by id ASC limit 1";
                                    $rs_pax = mysqli_query($con, $query_pax);
                                    $row_pax = mysqli_fetch_array($rs_pax);
                                    $seat = isset($row_pax['seat']) ? $row_pax['seat'] : '0' ;
                                    //  var_dump($_POST['id']);
                                    ?>
                                    <div class="form-inputan">
                                        <div class="p-2">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Guest Hotel</label>
                                                        <select class="form-control form-control-sm" id="guest_hotel<?php echo $row['id'] ?>">
                                                            <option selected value="0">Select Hotel Package</option>
                                                            <?php
                                                            $query_hh = "SELECT Hotel_Package.*,LAN_Hotel_List.hotel_id,LAN_Hotel_List.rate FROM Hotel_Package LEFT JOIN LAN_Hotel_List ON Hotel_Package.id=LAN_Hotel_List.status  where Hotel_Package.master_id='".$_POST['id']."' GROUP BY Hotel_Package.id order by Hotel_Package.nama ASC";
                                                            $rs_hh = mysqli_query($con, $query_hh);
                                                            while ($row_hh = mysqli_fetch_array($rs_hh)) {
                                                                $show_hotel_price = get_price_selected_hotel($row_hh['id']);
                                                                $rs_hotel_price = json_decode($show_hotel_price, true);

                                                            ?>
                                                                <option value="<?php echo $row_hh['id'] ?>"><?php echo $row_hh['nama'] . " || IDR " . number_format($rs_hotel_price['price']) ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Guide Hotel</label>
                                                        <select class="form-control form-control-sm" id="guide_hotel<?php echo $row['id'] ?>">
                                                            <option selected value="0">Same as guest</option>
                                                            <?php
                                                            $query_hh2 = "SELECT Hotel_Package.*,LAN_Hotel_List.hotel_id,LAN_Hotel_List.rate FROM Hotel_Package LEFT JOIN LAN_Hotel_List ON Hotel_Package.id=LAN_Hotel_List.status GROUP BY Hotel_Package.id order by Hotel_Package.id ASC";
                                                            $rs_hh2 = mysqli_query($con, $query_hh2);
                                                            while ($row_hh2 = mysqli_fetch_array($rs_hh2)) {
                                                                $show_hotel_price2 = get_price_selected_hotel($row_hh2['id']);
                                                                $rs_hotel_price2 = json_decode($show_hotel_price2, true);


                                                            ?>
                                                                <option value="<?php echo $row_hh2['id'] ?>"><?php echo $row_hh2['nama'] . " || IDR " . number_format($rs_hotel_price2['price']) ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label">FOC Hotel</label>
                                                        <select class="form-control form-control-sm" id="foc_hotel<?php echo $row['id'] ?>">
                                                            <option selected value="0">Same as guest</option>
                                                            <?php
                                                            $query_hh3 = "SELECT Hotel_Package.*,LAN_Hotel_List.hotel_id,LAN_Hotel_List.rate FROM Hotel_Package LEFT JOIN LAN_Hotel_List ON Hotel_Package.id=LAN_Hotel_List.status GROUP BY Hotel_Package.id order by Hotel_Package.id ASC";
                                                            $rs_hh3 = mysqli_query($con, $query_hh3);
                                                            while ($row_hh3 = mysqli_fetch_array($rs_hh3)) {
                                                                $show_hotel_price3 = get_price_selected_hotel($row_hh3['id']);
                                                                $rs_hotel_price3 = json_decode($show_hotel_price3, true);

                                                            ?>
                                                                <option value="<?php echo $row_hh3['id'] ?>"><?php echo $row_hh3['nama'] . " || IDR " . number_format($rs_hotel_price3['price']) ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="chck_meal<?php echo $row['id'] ?>" checked>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Include Meal
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="chck_adm<?php echo $row['id'] ?>" checked>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Include Admission
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="pax">Peserta (Guide + FOC)</label>
                                                    <select class="form-control form-control-sm" id="pax<?php echo $row['id'] ?>" name="pax">
                                                        <?php
                                                        for ($i = 1; $i <= $seat; $i++) {
                                                            echo "<option>" . $i . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="pilihan">Guide</label>
                                                    <select class="form-control form-control-sm" id="pilihan<?php echo $row['id'] ?>" name="pilihan">
                                                        <option value="0">Without Guide</option>
                                                        <option value="1">1 Guide</option>
                                                        <option value="2">2 Guide</option>
                                                        <option value="3">3 Guide</option>
                                                        <option value="4">4 Guide</option>
                                                        <option value="5">5 Guide</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="foc">FOC</label>
                                                    <select class="form-control form-control-sm" id="foc<?php echo $row['id'] ?>" name="foc">
                                                        <option value="0">Without FOC</option>
                                                        <option value="1">1 FOC</option>
                                                        <option value="2">2 FOC</option>
                                                        <option value="3">3 FOC</option>
                                                        <option value="4">4 FOC</option>
                                                        <option value="5">5 FOC</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col" style="padding-top: 30px;">
                                                <input type="hidden" name="adm_price" id="adm_price<?php echo $row['id'] ?>" value="<?php echo $total_inc ?>">
                                                <input type="hidden" name="guest_meal_price" id="guest_meal_price<?php echo $row['id'] ?>" value="<?php echo $gt_meal ?>">
                                                <button type="button" class="btn btn-primary btn-sm" onclick="cek_price(<?php echo $row['id'] ?>,<?php echo $_POST['id'] ?>,<?php echo $seat ?>)">Cek Price</button>
                                            </div>
                                        </div>
                                        <!-- </form> -->
                                        <div style="padding: 10px;">
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal_code" data-id="<?php echo $row['id'] ?>" data-tourid="<?php echo $_POST['id'] ?>">Make Code</button>
                                        </div>
                                    </div>
                                    <div class="cek-data<?php echo $row['id'] ?>"></div>
                                </div>
                            </div>
                        <?php
                     }
                      ?>
                    </div>


                    <!-- //////////////////////////////////////// modal //////////////////////////////// -->
                    <div class="modal fade" id="add_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">ADD Package</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="new_hotel_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">ADD New Hotel Package</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-new-hotel-package"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="detail_hotel_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Hotel Package</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-detail-hotel-package"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="new_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">New Package</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Package Name</label>
                                        <input type="text" class="form-control" id="nama" placeholder="Enter Package Name">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success btn-sm" onclick="add_package(<?php echo $_POST['id'] ?>)">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal_code" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">EDIT CODE</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-code"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="edit_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">EDIT HARI</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-edit"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <div class="modal-data-guide"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal_fee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal FEE</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-fee"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal_meal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal Meal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-meal"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal_vt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal Voucher Tlpn</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-vt"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ///////////////////////////////////////////////////////// -->
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
        $('#example_hotel').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
        $('#example_hotel_package').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
        $('#example_adm_in').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
        $('#example_adm_ex').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
        $('#add_package').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            //  alert(id);
            $.ajax({
                url: "modal_add_rent.php",
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
        $('#new_hotel_package').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            //  alert(id);
            $.ajax({
                url: "modal_new_hotel_package.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                },
                success: function(data) {
                    $('.modal-new-hotel-package').html(data);
                }
            });
        });
        $('#detail_hotel_package').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var hotel = $(e.relatedTarget).data('hotel');
            //  alert(id);
            $.ajax({
                url: "modal_detail_hotel.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    hotel: hotel
                },
                success: function(data) {
                    $('.modal-detail-hotel-package').html(data);
                }
            });
        });
        $('#edit_data').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var package = $(e.relatedTarget).data('package');
            // alert(id);
            $.ajax({
                url: "modal_edit_data.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    package: package
                },
                success: function(data) {
                    $('.modal-data-edit').html(data);
                }
            });
        });
        $('#modal_code').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var package = $(e.relatedTarget).data('tourid');
            var pilihan = document.getElementById("pilihan" + id).value;
            pax = document.getElementById("pax" + id).value;
            $.ajax({
                url: "modal_edit_code.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    package: package,
                    pilihan: pilihan,
                    pax: pax
                },
                success: function(data) {
                    $('.modal-data-code').html(data);
                }
            });
        });

        $('#modal_guide').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var tourid = $(e.relatedTarget).data('tourid');
            $.ajax({
                url: "modal_rent_guide.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    tourid: tourid
                },
                success: function(data) {
                    $('.modal-data-guide').html(data);
                }
            });
        });

        $('#modal_fee').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var tourid = $(e.relatedTarget).data('tourid');
            $.ajax({
                url: "modal_rent_fee.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    tourid: tourid
                },
                success: function(data) {
                    $('.modal-data-fee').html(data);
                }
            });
        });
        $('#modal_meal').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var tourid = $(e.relatedTarget).data('tourid');
            $.ajax({
                url: "modal_rent_gude_meal.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    tourid: tourid
                },
                success: function(data) {
                    $('.modal-data-meal').html(data);
                }
            });
        });
        $('#modal_vt').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            var tourid = $(e.relatedTarget).data('tourid');
            $.ajax({
                url: "modal_guide_vt.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    tourid: tourid
                },
                success: function(data) {
                    $('.modal-data-vt').html(data);
                }
            });
        });

    });

    function get_price(x) {
        $.ajax({
            url: "get_price_rent.php",
            method: "POST",
            asynch: false,
            data: {
                id: x
            },
            success: function(data) {
                $('.data-price').html(data);
            }
        });
    }

    function fungsi_search(i) {
        var value = $("#negara_list" + i + " option[value='" + $('#negara' + i).val() + "']").attr('data-id');

        $.ajax({
            url: "get_rent_trans.php",
            method: "POST",
            asynch: false,
            data: {
                value: value,
                id: i
            },
            success: function(data) {
                $('.content-val' + i).html(data);
            }
        });
    }

    function add_package(x) {
        var nama = document.getElementById("nama").value;
        // alert(nama);
        $.ajax({
            url: "insert_package_rent.php",
            method: "POST",
            asynch: false,
            data: {
                nama: nama,
                id: x
            },
            success: function(data) {
                alert(data);
            }
        });
    }

    function cek_price(x, y, z) {
        var val_meal = 0;
        var adm = 0;
        var pax = document.getElementById("pax" + x).value;
        var pilihan = document.getElementById("pilihan" + x).value;
        var foc = document.getElementById("foc" + x).value;
        var guest_meal_price = document.getElementById("guest_meal_price"+x).value;
        var adm_price = document.getElementById("adm_price"+x).value;
        var guest_hotel = document.getElementById("guest_hotel"+x).value;
        var guide_hotel = document.getElementById("guide_hotel"+x).value;
        var foc_hotel = document.getElementById("foc_hotel"+x).value;
        var chck_meal = document.getElementById("chck_meal"+x);
        var chck_adm = document.getElementById("chck_adm"+x);
        if (chck_meal.checked) {
            val_meal = 1;
            $("#chck_meal"+x).val(1);
        }else{
            $("#chck_meal"+x).val(0);
        }
        if (chck_adm.checked) {
            val_adm = 1;
            $("#chck_adm"+x).val(1);
        }else{
            $("#chck_adm"+x).val(0);
        }

        $.ajax({
            url: "cek_price_rent.php",
            method: "POST",
            asynch: false,
            data: {
                id: x,
                tourid: y,
                pax: pax,
                pilihan: pilihan,
                foc: foc,
                seat: z,
                guest_meal_price: guest_meal_price,
                adm_price: adm_price,
                guest_hotel: guest_hotel,
                guide_hotel: guide_hotel,
                foc_hotel: foc_hotel,
                val_adm: val_adm,
                val_meal: val_meal
            },
            success: function(data) {
                $('.cek-data' + x).html(data);
            }
        });
    }

    function del_all(x, y) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "del_rent_pkg.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    alert(data);
                    if (data == "success") {

                        // LT_itinerary(0, 0, 0);
                        LAN_Package(1, y, 0);
                    }
                }
            });
        }
    }


    function del_rent(x, y) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "del_rent_rent.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    alert(data);
                    if (data == "success") {

                        // LT_itinerary(0, 0, 0);
                        LAN_Package(1, y, 0);
                    }
                }
            });
        }
    }

    function del_guide(x, y) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "del_rent_guide.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    alert(data);
                    if (data == "success") {

                        // LT_itinerary(0, 0, 0);
                        LAN_Package(1, y, 0);
                    }
                }
            });
        }
    }

    function del_guide_manual(x, y) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "del_rent_guide_manual.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    alert(data);
                    if (data == "success") {

                        // LT_itinerary(0, 0, 0);
                        LAN_Package(1, y, 0);
                    }
                }
            });
        }
    }

    function hide_meal() {
        $("#meal-head").toggle();
    }

    function hide_adm() {
        $("#adm-head").toggle();
    }

    function hide_hotel() {
        $("#hotel-head").toggle();
    }
</script>