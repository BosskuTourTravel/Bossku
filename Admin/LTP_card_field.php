<?php
include "../db=connection.php";
if ($_POST['x'] != "") {
    $data = $_POST['tipe'];
    $rute = $_POST['rute'];

    $query = "SELECT * FROM LTP_type_flight where id=" . $data;
    $rs = mysqli_query($con, $query);
    $row = mysqli_fetch_array($rs);

?>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead style="background-color: mediumseagreen;">
                    <tr style="text-align: center;">
                        <th>Flight</th>
                        <th>Dept</th>
                        <th>Arr</th>
                        <th>ETD</th>
                        <th>ETA</th>
                        <th>Transit</th>
                        <th>Adt</th>
                        <th>Chd</th>
                        <th>Inf</th>
                        <th>Bagasi</th>
                        <th>Bagasi Price</th>
                        <th>Seat Price</th>
                        <th>Breakfast</th>
                        <th>Lunch</th>
                        <th>Dinner</th>
                        <th>Tax</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $grub = "";
                    $query_rou = "SELECT * FROM  LTP_route_detail where route_id='" . $_POST['x'] . "' &&  rute='".$_POST['rute']."' order by rute ASC , id ASC";
                    $rs_rou = mysqli_query($con, $query_rou);
                    while ($row_rou = mysqli_fetch_array($rs_rou)) {
                        if ($grub != $row_rou['rute']) {

                            $query_type = "SELECT ket FROM LT_Flight_Tag where tag='" . $row_rou['rute'] . "'";
                            $rs_type = mysqli_query($con, $query_type);
                            $row_type = mysqli_fetch_array($rs_type);
                    ?>
                            <tr>
                                <td colspan="17" style="text-align: center; font-weight: bold;"><?php echo $row_type['ket'] ?></td>
                            </tr>
                        <?php
                            $grub = $row_rou['rute'];
                        }
                        ?>
                        <tr>
                            <td><?php echo  $row_rou['maskapai'] ?></td>
                            <td><?php echo  $row_rou['dept'] ?></td>
                            <td><?php echo  $row_rou['arr'] ?></td>
                            <td><?php echo  $row_rou['take'] ?></td>
                            <td><?php echo  $row_rou['landing'] ?></td>
                            <td><?php if ($row_rou['transit'] != 0) {
                                    echo number_format($row_rou['transit'], 0, ",", ".") . " Menit";
                                }  ?></td>
                            <td><?php echo number_format($row_rou['adt'], 0, ",", ".") ?></td>
                            <td><?php echo number_format($row_rou['chd'], 0, ",", ".") ?></td>
                            <td><?php echo  number_format($row_rou['inf'], 0, ",", ".") ?></td>
                            <td><?php echo  number_format($row_rou['bagasi'], 0, ",", ".") ?></td>
                            <td><?php echo  number_format($row_rou['bagasi_price'], 0, ",", ".") ?></td>
                            <td><?php echo  number_format($row_rou['seat_price'], 0, ",", ".") ?></td>
                            <td><?php echo  number_format($row_rou['bf'], 0, ",", ".") ?></td>
                            <td><?php echo  number_format($row_rou['ln'], 0, ",", ".") ?></td>
                            <td><?php echo  number_format($row_rou['dn'], 0, ",", ".") ?></td>
                            <td><?php echo  number_format($row_rou['tax'], 0, ",", ".") ?></td>
                            <td><?php echo  $row_rou['type'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<?php

}
