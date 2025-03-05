<?php
include "../db=connection.php";
session_start();
// var_dump($_SESSION['staff_id']);
$query_role = "SELECT * FROM Staff_role where staff_id='" . $_SESSION['staff_id'] . "'";
$rs_role = mysqli_query($con, $query_role);
$row_role = mysqli_fetch_array($rs_role);
$role_check = explode(",", $row_role['menu_sub']);
function hide_sub_menu($x, $y)
{
    $sub_menu = 0;
    $key_sub_menu = array_search($x, $y);
    if ($key_sub_menu !== false) {
        $sub_menu = 1;
    }
    return $sub_menu;

    // return json_encode(array("sub_menu" => $sub_menu), true);
}
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Land Tour Drive</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append">
                                <?php
                                $get_sub_menu = hide_sub_menu(5, $role_check);
                                if ($get_sub_menu != 0) {
                                ?>
                                    <button type="button" onclick="insertPage(26,0,0)" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                    <button type="button" onclick="reloadManual(9,0,0)" class="btn btn-success"><i class="fa fa-sync"></i></button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">

                    <?php
                    $query = "SELECT * FROM Upload_Drive2 where status='on' order by country ASC";
                    $rs = mysqli_query($con, $query);
                    $query2 = "SELECT * FROM Upload_Drive2 where status='off' order by country ASC";
                    $rs2 = mysqli_query($con, $query2);
                    $no = 1;
                    $no2 = 1;

                    ?>
                    <div style="padding: 20px;">
                        <div style="padding: 20px; text-align: center;">
                            <h3>PAKET TOUR ONLINE</h3>
                        </div>
                        <table id="example" class="table table-striped table-bordered" style="width:100%; font-size: 12px; ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Thumbnail</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($rs)) {
                                    $query_con = "SELECT * FROM country where id=" . $row['country'];
                                    $rs_con = mysqli_query($con, $query_con);
                                    $country = mysqli_fetch_array($rs_con);

                                    $link = $row['thumbnail'];
                                    $headers = explode('/', $link);
                                    $thumbnail = $headers[5];
                                ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td>
                                            <div style="font-weight: bold; text-decoration: underline;"><?php echo $row['judul'] ?></div>
                                            <div><?php echo $row['agent'] . " : " . $row['country'] ?></div>

                                        </td>
                                        <td><?php echo $country['name'] ?></td>
                                        <td>
                                            <select class="form-select form-select-sm" id="status_on<?php echo $row['id'] ?>" onchange="ganti_on(<?php echo $row['id'] ?>)" style="background-color: darkgreen; color: whitesmoke;">
                                                <option selected value="<?php echo $row['status'] ?>"><?php echo $row['status'] ?></option>
                                                <option value="on">On</option>
                                                <option value="off">Off</option>
                                            </select>
                                        </td>
                                        <td><?php echo $row['kurs'] . " " . number_format($row['price']) ?></td>
                                        <td><img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" width="60" height="60"></td>
                                        <td>
                                            <?php
                                            $get_sub_menu = hide_sub_menu(6, $role_check);
                                            if ($get_sub_menu != 0) {
                                            ?>
                                                <button type="button" onclick="del(<?php echo $row['id']  ?>)" class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                        <div style="padding: 20px; text-align: center; color: darkred;">
                            <h3>PAKET TOUR OFFLINE</h3>
                        </div>
                        <table id="example2" class="table table-striped table-bordered" style="width:100%; font-size: 12px; ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Thumbnail</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row2 = mysqli_fetch_array($rs2)) {
                                    $query_con = "SELECT * FROM country where id=" . $row2['country'];
                                    $rs_con = mysqli_query($con, $query_con);
                                    $country = mysqli_fetch_array($rs_con);

                                    $link = $row2['thumbnail'];
                                    $headers = explode('/', $link);
                                    $thumbnail = $headers[5];
                                ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td>
                                            <div style="font-weight: bold; text-decoration: underline;"><?php echo $row2['judul'] ?></div>
                                            <div><?php echo $row2['agent'] . " : " . $row2['country'] ?></div>

                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="form-select form-select-sm" id="status_off<?php echo $row2['id'] ?>" onchange="ganti(<?php echo $row2['id'] ?>)" style="background-color: darkred; color: whitesmoke;">
                                                <option selected value="<?php echo $row2['status'] ?>"><?php echo $row2['status'] ?></option>
                                                <option value="on">On</option>
                                                <option value="off">Off</option>
                                            </select>

                                        </td>
                                        <td><?php echo $row2['kurs'] . " " . number_format($row2['price']) ?></td>
                                        <td><img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" width="60" height="60"></td>
                                        <td>
                                            <?php
                                            $get_sub_menu = hide_sub_menu(6, $role_check);
                                            if ($get_sub_menu != 0) {
                                            ?>
                                                <button type="button" onclick="del(<?php echo $row2['id']  ?>)" class='btn btn-danger btn-sm'><i class='fa fa-trash' aria-hidden='true'></i></button>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                    $no2++;
                                }
                                ?>
                            </tbody>
                        </table>
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
        $('#example2').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
    });
</script>
<script>
    function del(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "del_itin_web.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        reloadManual(9, 0, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }

    function ganti_on(x) {
        var txt;
        var r = confirm("Apakah Kamu yakin merubah status Paket Tour ?");
        var status = document.getElementById("status_on" + x).value;
        if (r == true) {
            // alert(status);
            $.ajax({
                url: "update_status_paket.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x,
                    status: status
                },
                success: function(data) {
                    if (data == "success") {
                        // reloadManual(9, 0, 0);
                        alert("data berhasil Update");
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }

    function ganti(x) {
        var txt;
        var r = confirm("Apakah Kamu yakin merubah status Paket Tour ?");
        var status = document.getElementById("status_off" + x).value;
        if (r == true) {
            // alert(status);
            $.ajax({
                url: "update_status_paket.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x,
                    status: status
                },
                success: function(data) {
                    if (data == "success") {
                        // reloadManual(9, 0, 0);
                        alert("data berhasil Update");
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
</script>