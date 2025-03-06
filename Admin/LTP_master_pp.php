<?php
include "../db=connection.php";
if ($_POST['x'] != "") {
    $query_route = "SELECT * FROM  LTP_add_route  where id ='" . $_POST['x'] . "'";
    $rs_route = mysqli_query($con, $query_route);
    $row_route = mysqli_fetch_array($rs_route);

    $query_fl2 = "SELECT * FROM LT_flight_logo where kode='" . $row['maskapai'] . "'";
    $rs_fl2 = mysqli_query($con, $query_fl2);
    $row_fl2 = mysqli_fetch_array($rs_fl2);

    $query_pp = "SELECT * FROM  LTP_add_route  where city_in ='" . $row_route['city_out'] . "' && city_out='" . $row_route['city_in'] . "' && maskapai='" . $row_route['maskapai'] . "'";
    $rs_pp = mysqli_query($con, $query_pp);
    $row_pp = mysqli_fetch_array($rs_pp);
?>
    <div><b style="color: green;"><?php echo $row_pp['city_in'] ?></b> to <b style="color: red;"><?php echo $row_pp['city_out'] ?></b></div>
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
            $query_rou = "SELECT * FROM  LTP_route_detail where route_id='" . $row_pp['id'] . "' order by rute ASC , id ASC";
            $rs_rou = mysqli_query($con, $query_rou);
            while ($row_rou = mysqli_fetch_array($rs_rou)) {
                $query_typ = "SELECT * FROM LTP_type_flight where id='" . $row_rou['type'] . "'";
                $rs_typ = mysqli_query($con, $query_typ);
                $row_typ = mysqli_fetch_array($rs_typ);
            ?>
                <tr>
                    <td><?php echo  $row_rou['maskapai'] ?></td>
                    <td><?php echo  $row_rou['dept'] ?></td>
                    <td><?php echo  $row_rou['arr'] ?></td>
                    <td><?php echo  $row_rou['take'] ?></td>
                    <td><?php echo  $row_rou['landing'] ?></td>
                    <td><?php if ($row_rou['transit'] != 0) {
                            $jam = floor($row_rou['transit'] / 60);
                            $menit = fmod($row_rou['transit'], 60);
                            echo $jam . "H " . $menit . "M";
                        }  ?></td>
                    <td><?php echo $row_rou['tgl'] ?></td>
                    <td><?php echo number_format($row_rou['adt'], 0, ",", ".") ?></td>
                    <td><?php echo number_format($row_rou['chd'], 0, ",", ".") ?></td>
                    <td><?php echo  number_format($row_rou['inf'], 0, ",", ".") ?></td>
                    <td><?php echo  number_format($row_rou['bagasi'], 0, ",", ".") ?></td>
                    <td><?php echo  number_format($row_rou['bagasi_price'], 0, ",", ".") ?></td>
                    <td><?php echo $row_rou['rute'] ?></td>
                    <td><?php echo  $row_typ['nama'] ?></td>
                    <td><a href="#" class="badge badge-danger"><i class="fa fa-trash"></i></a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
}
?>