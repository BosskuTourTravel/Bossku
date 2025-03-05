<?php
include "../db=connection.php";
if ($_POST['city_in'] != "") {
    $query_tbs = "SELECT * FROM LTP_add_route where city_in='" . $_POST['city_in'] . "' && city_out='" . $_POST['city_out'] . "' order by maskapai ASC";
    $rs_tbs = mysqli_query($con, $query_tbs);
?>
    <table class="table table-bordered table-sm" style="font-size: 12px;">
        <thead>
            <tr style="text-align: center;">
                <th style="min-width: 40px;">#</th>
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
                <th>Group</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            <?php

            while ($row_tbs = mysqli_fetch_array($rs_tbs)) {
                $query_fl_tbs = "SELECT nama FROM LT_flight_logo where kode='" . $row_tbs['maskapai'] . "'";
                $rs_fl_tbs = mysqli_query($con, $query_fl_tbs);
                $row_fl_tbs = mysqli_fetch_array($rs_fl_tbs);
            ?>
                <tr>
                    <th colspan="15" style="text-align: center;"><?php echo $row_fl_tbs['nama'] ?></th>
                </tr>
                <?php
                $no = 1;
                $query_tbs_d = "SELECT * FROM  LTP_route_detail where route_id='" . $row_tbs['id'] . "' order by rute ASC , id ASC";
                $rs_tbs_d = mysqli_query($con, $query_tbs_d);
                $chek_id_tbs = 0;
                while ($row_tbs_d = mysqli_fetch_array($rs_tbs_d)) {
                    $query_typ_tbs = "SELECT * FROM LTP_type_flight where id='" . $row_tbs_d['type'] . "'";
                    $rs_typ_tbs = mysqli_query($con, $query_typ_tbs);
                    $row_typ_tbs = mysqli_fetch_array($rs_typ_tbs);
                ?>
                    <tr>
                        <td>
                            <div style="text-align: center; margin: auto;">
                                <?php
                                if ($chek_id_tbs != $row_tbs_d['id_grub']) {
                                    $chek_id_tbs = $row_tbs_d['id_grub'];
                                ?>
                                    <input class="form-check-input" type="checkbox" id="chck" name="chck" value="<?php echo $row_tbs_d['id'] ?>">
                                <?php
                                }
                                ?>

                            </div>
                        </td>
                        <td><?php echo  $row_tbs_d['maskapai'] ?></td>
                        <td><?php echo  $row_tbs_d['dept'] ?></td>
                        <td><?php echo  $row_tbs_d['arr'] ?></td>
                        <td><?php echo  $row_tbs_d['take'] ?></td>
                        <td><?php echo  $row_tbs_d['landing'] ?></td>
                        <td><?php if ($row_tbs_d['transit'] != 0) {
                                $jam = floor($row_tbs_d['transit'] / 60);
                                $menit = fmod($row_tbs_d['transit'], 60);
                                echo $jam . "H " . $menit . "M";
                            }  ?></td>
                        <td><?php echo $row_tbs_d['tgl'] ?></td>
                        <td><?php echo number_format($row_tbs_d['adt'], 0, ",", ".") ?></td>
                        <td><?php echo number_format($row_tbs_d['chd'], 0, ",", ".") ?></td>
                        <td><?php echo  number_format($row_tbs_d['inf'], 0, ",", ".") ?></td>
                        <td><?php echo  number_format($row_tbs_d['bagasi'], 0, ",", ".") ?></td>
                        <td><?php echo  number_format($row_tbs_d['bagasi_price'], 0, ",", ".") ?></td>
                        <td><?php echo  $row_tbs_d['rute'] ?></td>
                        <td><?php echo  $row_typ_tbs['nama'] ?></td>
                    </tr>
            <?php
                    $no++;
                }
            }
            ?>
        </tbody>
    </table>
<?php
}
?>