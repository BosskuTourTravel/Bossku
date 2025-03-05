<?php
include "../db=connection.php";

if ($_POST['value'] != "") {

    $query_cek = "SELECT * FROM Transport_new where id=" . $_POST['value'];
    $rs_cek = mysqli_query($con, $query_cek);
    $row_cek = mysqli_fetch_array($rs_cek);
    // var_dump($query_cek);
?>
    <table class="table table-striped table-sm" style="font-size: 14px;">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Agent</th>
                <th scope="col">Region</th>
                <th scope="col">Transport Type</th>
                <th scope="col">Rent Type</th>
                <th scope="col">Season</th>
                <th scope="col">Capacity</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query_trans = "SELECT Transport_new.id, Transport_new.country,Transport_new.city, Transport_new.agent,Transport_new.trans_type, Transport_new.periode,Transport_new.seat,agent_transport.company,Transport_new.oneway,Transport_new.twoway,Transport_new.hd1,Transport_new.hd2,Transport_new.fd1,Transport_new.fd2,Transport_new.kaisoda,Transport_new.luarkota,Transport_new.kurs FROM Transport_new LEFT JOIN agent_transport ON agent_transport.id=Transport_new.agent where Transport_new.country='" . $row_cek['country'] . "' && Transport_new.city ='" . $row_cek['city'] . "' && Transport_new.trans_type='" . $row_cek['trans_type'] . "' Order by Transport_new.city ASC";
            $rs_trans = mysqli_query($con, $query_trans);
            $no = 1;
            //  var_dump($query_trans);
            while ($row_trans = mysqli_fetch_array($rs_trans)) {

            ?>
                <tr>
                    <th style="width: 40px;"><?php echo $no ?></th>
                    <td><?php echo  $row_trans['company'] ?></td>
                    <td><?php echo  $row_trans['city'] . " " . $row_trans['country'] ?></td>
                    <td><?php echo $row_trans['trans_type'] ?></td>
                    <td>One Way</td>
                    <td><?php echo $row_trans['periode'] ?></td>
                    <td><?php echo $row_trans['seat'] . " seat" ?></td>
                    <td><?php echo $row_trans['kurs'] . " " . number_format($row_trans['oneway']) ?></td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-warning btn-sm" onclick="add_list(<?php echo  $row_trans['id'] ?>,<?php echo $_POST['id'] ?>,'oneway')">add to list</button>
                    </td>
                </tr>
                <tr>
                    <th style="width: 40px;"><?php echo $no + 1 ?></th>
                    <td><?php echo  $row_trans['company'] ?></td>
                    <td><?php echo  $row_trans['city'] . " " . $row_trans['country'] ?></td>
                    <td><?php echo $row_trans['trans_type'] ?></td>
                    <td>Two Way</td>
                    <td><?php echo $row_trans['periode'] ?></td>
                    <td><?php echo $row_trans['seat'] . " seat" ?></td>
                    <td><?php echo $row_trans['kurs'] . " " . number_format($row_trans['twoway']) ?></td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-warning btn-sm" onclick="add_list(<?php echo  $row_trans['id'] ?>,<?php echo $_POST['id'] ?>,'twoway')">add to list</button>
                    </td>
                </tr>
                <tr>
                    <th style="width: 40px;"><?php echo $no + 2 ?></th>
                    <td><?php echo  $row_trans['company'] ?></td>
                    <td><?php echo  $row_trans['city'] . " " . $row_trans['country'] ?></td>
                    <td><?php echo $row_trans['trans_type'] ?></td>
                    <td>Half Day 1</td>
                    <td><?php echo $row_trans['periode'] ?></td>
                    <td><?php echo $row_trans['seat'] . " seat" ?></td>
                    <td><?php echo $row_trans['kurs'] . " " . number_format($row_trans['hd1']) ?></td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-warning btn-sm" onclick="add_list(<?php echo  $row_trans['id'] ?>,<?php echo $_POST['id'] ?>,'hd1')">add to list</button>
                    </td>
                </tr>
                <tr>
                    <th style="width: 40px;"><?php echo $no + 3 ?></th>
                    <td><?php echo  $row_trans['company'] ?></td>
                    <td><?php echo  $row_trans['city'] . " " . $row_trans['country'] ?></td>
                    <td><?php echo $row_trans['trans_type'] ?></td>
                    <td>Half Day 2</td>
                    <td><?php echo $row_trans['periode'] ?></td>
                    <td><?php echo $row_trans['seat'] . " seat" ?></td>
                    <td><?php echo $row_trans['kurs'] . " " . number_format($row_trans['hd2']) ?></td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-warning btn-sm" onclick="add_list(<?php echo  $row_trans['id'] ?>,<?php echo $_POST['id'] ?>,'hd2')">add to list</button>
                    </td>
                </tr>
                <tr>
                    <th style="width: 40px;"><?php echo $no + 4 ?></th>
                    <td><?php echo  $row_trans['company'] ?></td>
                    <td><?php echo  $row_trans['city'] . " " . $row_trans['country'] ?></td>
                    <td><?php echo $row_trans['trans_type'] ?></td>
                    <td>Full Day 1</td>
                    <td><?php echo $row_trans['periode'] ?></td>
                    <td><?php echo $row_trans['seat'] . " seat" ?></td>
                    <td><?php echo $row_trans['kurs'] . " " . number_format($row_trans['fd1']) ?></td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-warning btn-sm" onclick="add_list(<?php echo  $row_trans['id'] ?>,<?php echo $_POST['id'] ?>,'fd1')">add to list</button>
                    </td>
                </tr>
                <tr>
                    <th style="width: 40px;"><?php echo $no + 5 ?></th>
                    <td><?php echo  $row_trans['company'] ?></td>
                    <td><?php echo  $row_trans['city'] . " " . $row_trans['country'] ?></td>
                    <td><?php echo $row_trans['trans_type'] ?></td>
                    <td>Full Day 2</td>
                    <td><?php echo $row_trans['periode'] ?></td>
                    <td><?php echo $row_trans['seat'] . " seat" ?></td>
                    <td><?php echo $row_trans['kurs'] . " " . number_format($row_trans['fd2']) ?></td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-warning btn-sm" onclick="add_list(<?php echo  $row_trans['id'] ?>,<?php echo $_POST['id'] ?>,'fd2')">add to list</button>
                    </td>
                </tr>
                <tr>
                    <th style="width: 40px;"><?php echo $no + 6 ?></th>
                    <td><?php echo  $row_trans['company'] ?></td>
                    <td><?php echo  $row_trans['city'] . " " . $row_trans['country'] ?></td>
                    <td><?php echo $row_trans['trans_type'] ?></td>
                    <td>Kaisoda</td>
                    <td><?php echo $row_trans['periode'] ?></td>
                    <td><?php echo $row_trans['seat'] . " seat" ?></td>
                    <td><?php echo $row_trans['kurs'] . " " . number_format($row_trans['kaisoda']) ?></td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-warning btn-sm" onclick="add_list(<?php echo  $row_trans['id'] ?>,<?php echo $_POST['id'] ?>,'kaisoda')">add to list</button>
                    </td>
                </tr>
                <tr>
                    <th style="width: 40px;"><?php echo $no + 7 ?></th>
                    <td><?php echo  $row_trans['company'] ?></td>
                    <td><?php echo  $row_trans['city'] . " " . $row_trans['country'] ?></td>
                    <td><?php echo $row_trans['trans_type'] ?></td>
                    <td>Luar Kota</td>
                    <td><?php echo $row_trans['periode'] ?></td>
                    <td><?php echo $row_trans['seat'] . " seat" ?></td>
                    <td><?php echo $row_trans['kurs'] . " " . number_format($row_trans['luarkota']) ?></td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-warning btn-sm" onclick="add_list(<?php echo  $row_trans['id'] ?>,<?php echo $_POST['id'] ?>,'luarkota')">add to list</button>
                    </td>
                </tr>

            <?php
                $no = $no + 8;
            }
            ?>
        </tbody>
    </table>
    
<?php
} else {
    echo "Data ID Kosong !";
}
?>