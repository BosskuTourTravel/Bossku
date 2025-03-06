<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
include "../site.php";
include "../db=connection.php";

$query_st = "SELECT * FROM  login_staff where id=" . $_SESSION['staff_id'];
$rs_st = mysqli_query($con, $query_st);
$row_st = mysqli_fetch_array($rs_st);
$cabang = $row_st['cabang'];
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">List Landtour Surabaya</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php

                    $query = "SELECT * FROM  Prev_makeLT order by id DESC";
                    $rs = mysqli_query($con, $query);
                    $no = 1
                    ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama</th>
                                <th>Include</th>
                                <th>Exclude</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($rs)) {
                                /// 2 = sub ,3 = bth

                                // if ($row_staff['cabang'] == '2') {

                                $data = json_decode($row['data'], true);

                                $query_inc = "SELECT * FROM  Prev_Include_LT where id_LT=" . $row['id'];
                                $rs_inc = mysqli_query($con, $query_inc);
                                $row_inc = mysqli_fetch_array($rs_inc);

                                $query_exc = "SELECT * FROM  Prev_Exclude_LT where id_LT=" . $row['id'];
                                $rs_exc = mysqli_query($con, $query_exc);
                                $row_exc = mysqli_fetch_array($rs_exc);

                                $query_lt = "SELECT * FROM  LT_itinnew where id=" . $data['landtour_name'];
                                $rs_lt = mysqli_query($con, $query_lt);
                                $row_lt = mysqli_fetch_array($rs_lt);

                                $query_visa = "SELECT * FROM  LT_add_visa where tour_id='" . $row['id'] . "' order by tgl ASC";
                                $rs_visa = mysqli_query($con, $query_visa);
                                $row_visa = mysqli_fetch_array($rs_visa);
                                // var_dump($query_visa);
                                $detail_visa = "";
                                if ($row_visa['id'] != "") {
                                    $detail_visa = "Visa : " . $row_visa['ket'];
                                }


                                // var_dump($data);
                            ?>
                                <tr>
                                    <td><?php echo  $row['id'] ?></td>
                                    <td><?php echo $data['judul'] ?></br><b><?php echo $row_lt['kode'] ?></b></br><?php echo $detail_visa ?></br>
                                        <!-- <p style="color: salmon;"><?php echo "Created by : " . $row_staff['name'] ?></p> -->

                                        <?php
                                        $query_addflight = "SELECT * FROM LT_add_flight  where  tour_id='" . $row['id'] . "' && ket=2";
                                        $rs_addflight = mysqli_query($con, $query_addflight);
                                        $row_addflight = mysqli_fetch_array($rs_addflight);

                                        if ($row_addflight['id'] != "") {
                                        ?>
                                            <p style="color: salmon;"><B>INCLUDE FLIGHT</B></p>
                                        <?php
                                        }

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $include = json_decode($row_inc['include'], true);
                                        foreach ($include as $val_inc) {
                                            $query_val_inc = "SELECT * FROM  checkbox_include where id=" . $val_inc;
                                            $rs_val_inc = mysqli_query($con, $query_val_inc);
                                            $row_val_inc = mysqli_fetch_array($rs_val_inc);
                                            echo $row_val_inc['nama'];
                                            echo "</br>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $exclude = json_decode($row_exc['exclude'], true);
                                        foreach ($exclude as $val_exc) {
                                            $query_val_exc = "SELECT * FROM  checkbox_include where id=" . $val_exc;
                                            $rs_val_exc = mysqli_query($con, $query_val_exc);
                                            $row_val_exc = mysqli_fetch_array($rs_val_exc);
                                            echo $row_val_exc['nama'];
                                            echo "</br>";
                                        }

                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $query_tt = "SELECT * FROM  LT_Perhitungan where tour_id='" . $row['id'] . "' && ket=".$cabang;
                                        $rs_tt = mysqli_query($con, $query_tt);
                                        $row_tt = mysqli_fetch_array($rs_tt);

                                        if ($row_tt['id'] != "") {
                                        ?>
                                            <a class="btn btn-success btn-sm" href="preview_makeLT.php?id=<?php echo $row['id'] ?>&cabang=2&tt=<?php echo  $row_tt['id']?>" target="_BLANK"><i class="fa fa-print"></i></a>
                                        <?php
                                        }
                                        ?>
                                        <a class="btn btn-primary btn-sm" href="preview_all_LT.php?id=<?php echo $row['id'] ?>&cabang=2" target="_BLANK"><i class="fa fa-print"></i></a>
                                        <?php
                                        if ($cabang == 2) {
                                        ?>
                                            <!-- <a class="btn btn-warning btn-sm" onclick="LT_include(0,<?php echo $row['id'] ?>,0)"><i class="fa fa-plus"></i></a> -->
                                            <a class="btn btn-success btn-sm" onclick="LT_include(1,<?php echo $row['id'] ?>,0)"><i class="fa fa-plane"></i></a>
                                            <!-- <a class="btn btn-info btn-sm" onclick="LT_include(3,<?php echo $row['id'] ?>,0)"><i class="fa fa-suitcase"></i></a> -->
                                            <a class="btn btn-secondary btn-sm" onclick="LT_include(2,<?php echo $row['id'] ?>,<?php echo $cabang ?>)"><i class="fa fa-database"></i></a>
                                            <!-- <a class="btn btn-primary btn-sm" onclick="LT_include(4,<?php echo $row['id'] ?>,0)"><i class="fa fa-gift"></i></a>
                                                <a class="btn btn-danger btn-sm" onclick="del_makelt(<?php echo $row['id'] ?>)"><i class="fa fa-trash"></i></a> -->
                                        <?php
                                        }
                                        ?>

                                    </td>
                                </tr>
                            <?php
                                $no++;
                                // }
                            }
                            ?>
                        </tbody>
                    </table>
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
    });
</script>
<script>
    function del_makelt(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "del_makeLT.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        Reloaditin(5, 0, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
</script>