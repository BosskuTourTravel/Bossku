<?php
include "../db=connection.php";

// $query_sfee = "SELECT * FROM LTP_insert_sfee where id_grub ='" . $_POST['x'] . "' && date_set='".$_POST['date']."' order by date_set ASC";
// $rs_sfee = mysqli_query($con, $query_sfee);
// $row_sfee = mysqli_fetch_array($rs_sfee);
// $det_arr = [];
// while ($row_sfee = mysqli_fetch_array($rs_sfee)) {
//     array_push($det_arr, $row_sfee['date_set']);
// }
// $data_val = implode(',', $det_arr);
?>
<style>
    .ui-highlight .ui-state-default {
        background: palevioletred !important;
        border-color: palevioletred !important;
        color: white !important;
    }
</style>
<div>
    <!-- <input type="hidden" name="tgl_fl" id="tgl_fl" value="<?php echo $data_val ?>"> -->
    <table class="table table-bordered table-sm" style="font-size: 11px;">
        <thead>
            <tr style="text-align: center;">
                <th style="min-width: 40px;">No</th>
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
                <th>Type 1</th>
                <th>Type 2</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $_POST['x'] . "' order by id ASC";
            $rs_gf = mysqli_query($con, $query_gf);

            $query_sfee_tt = "SELECT * FROM LTP_insert_sfee where id_grub ='" . $_POST['x'] . "' && date_set='".$_POST['date']."'";
            $rs_sfee_tt = mysqli_query($con, $query_sfee_tt);
            $row_sfee_tt = mysqli_fetch_array($rs_sfee_tt);
            // var_dump($query_sfee_tt);
            $adt_sfe = 0;
            $chd_sfe = 0;
            $inf_sfe = 0;
            if ($row_sfee_tt['id'] != "") {
                $adt_sfe = $row_sfee_tt['adt'];
                $chd_sfe = $row_sfee_tt['chd'];
                $inf_sfe = $row_sfee_tt['inf'];
            }

            $no = 1;
            $adt = 0;
            $chd = 0;
            $inf = 0;
            $bg = 0;
            $x_gf = 1;
            while ($row_gf = mysqli_fetch_array($rs_gf)) {

                $query_detail = "SELECT * FROM  LTP_route_detail where id='" . $row_gf['flight_id'] . "'";
                $rs_detail = mysqli_query($con, $query_detail);
                $row_detail = mysqli_fetch_array($rs_detail);

                $query_typ2 = "SELECT * FROM LTP_type_flight where id='" . $row_detail['type'] . "'";
                $rs_typ2 = mysqli_query($con, $query_typ2);
                $row_typ2 = mysqli_fetch_array($rs_typ2);

                $query_rt = "SELECT * FROM  LT_add_roundtrip where route_id='" .  $row_detail['route_id'] . "'";
                $rs_rt = mysqli_query($con, $query_rt);
                $row_rt = mysqli_fetch_array($rs_rt);

                if ($row_gf['status'] == '1') {
                    if ($x_gf == '1') {
                        $type = "Roundtrip Auto";
                        $adt_rt = $row_rt['adt'];
                        $chd_rt = $row_rt['chd'];
                        $inf_rt = $row_rt['inf'];
                    } else {
                        $type = "Roundtrip Auto";
                        $adt_rt = 0;
                        $chd_rt = 0;
                        $inf_rt = 0;
                    }
                } else {
                    $type = $row_typ2['nama'];
                    $adt_rt = $row_detail['adt'];
                    $chd_rt = $row_detail['chd'];
                    $inf_rt = $row_detail['inf'];
                }
            ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo  $row_detail['maskapai'] ?></td>
                    <td><?php echo  $row_detail['dept'] ?></td>
                    <td><?php echo  $row_detail['arr'] ?></td>
                    <td><?php echo  $row_detail['take'] ?></td>
                    <td><?php echo  $row_detail['landing'] ?></td>
                    <td><?php if ($row_detail['transit'] != 0) {
                            $jam = floor($row_detail['transit'] / 60);
                            $menit = fmod($row_detail['transit'], 60);
                            echo $jam . "H " . $menit . "M";
                        }  ?></td>
                    <td><?php echo $row_detail['tgl'] ?></td>
                    <td><?php echo number_format($adt_rt, 0, ",", ".") ?></td>
                    <td><?php echo number_format($chd_rt, 0, ",", ".") ?></td>
                    <td><?php echo  number_format($inf_rt, 0, ",", ".") ?></td>
                    <td><?php echo  number_format($row_detail['bagasi'], 0, ",", ".") ?></td>
                    <td><?php echo  number_format($row_detail['bagasi_price'], 0, ",", ".") ?></td>
                    <td><?php echo  $row_detail['rute'] ?></td>
                    <td><?php echo  $type ?></td>
                </tr>
            <?php
                $no++;
                $adt = $adt + $adt_rt;
                $chd = $chd + $chd_rt;
                $inf = $inf + $inf_rt;
                $bg = $bg + $row_detail['bg'];
                $x_gf++;
            }
            $adt = $adt + $adt_sfe;
            $chd = $chd + $chd_sfe;
            $inf = $inf + $inf_sfe;
            ?>
            <tr>
                <th colspan="8">Surcharge Fee</th>
                <td><?php echo  number_format($adt_sfe, 0, ",", ".") ?></td>
                <td><?php echo  number_format($chd_sfe, 0, ",", ".") ?></td>
                <td><?php echo  number_format($inf_sfe, 0, ",", ".") ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="8">Total Price Flight</th>
                <th><?php echo  number_format($adt, 0, ",", ".") ?></th>
                <th><?php echo  number_format($chd, 0, ",", ".") ?></th>
                <th><?php echo  number_format($inf, 0, ",", ".") ?></th>
                <th></th>
                <th><?php echo  number_format($bg, 0, ",", ".") ?></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>