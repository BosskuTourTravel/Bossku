<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
include "../site.php";
include "../db=connection.php";

?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">List Make Landtour</h3>
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
                                $data = json_decode($row['data'], true);

                                $query_staff = "SELECT * FROM  login_staff where id=" . $row['status'];
                                $rs_staff = mysqli_query($con, $query_staff);
                                $row_staff = mysqli_fetch_array($rs_staff);
                                // var_dump($)

                                $query_inc = "SELECT * FROM  Prev_Include_LT where id_LT=" . $row['id'];
                                $rs_inc = mysqli_query($con, $query_inc);
                                $row_inc = mysqli_fetch_array($rs_inc);

                                $query_exc = "SELECT * FROM  Prev_Exclude_LT where id_LT=" . $row['id'];
                                $rs_exc = mysqli_query($con, $query_exc);
                                $row_exc = mysqli_fetch_array($rs_exc);

                                $query_lt = "SELECT * FROM  LT_itinnew where kode='" . $data['landtour_name'] . "'";
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

                                if ($data['landtour_name'] != null) {
                                    // var_dump($data);
                            ?>
                                    <tr>
                                        <td><?php echo  $row['id'] ?></td>
                                        <td><?php echo $data['judul'] ?></br><b><?php echo $row_lt['kode'] ?></b></br><?php echo $detail_visa ?>
                                            </br><?php
                                                    $detail = "";
                                                    if ($row_staff['name'] != "") {
                                                        $detail = ": by " . $row_staff['name'];
                                                    }
                                                    $cb = "";
                                                    if ($row_staff['cabang'] == 2) {
                                                        $cb = "From Surabaya";
                                                    } else if ($row_staff['cabang'] == 3) {
                                                        $cb = "From Batam";
                                                    } else if ($row_staff['cabang'] == 4) {
                                                        $cb = "From Jakarta";
                                                    } else {
                                                    }

                                                    echo $cb . " " . $detail;
                                                    ?>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>Acara Tour & Transportasi Sesuai Jadwal Berdasarkan Gabungan Tour</li>
                                                <li>Penjemputan di Bandara Berdasarkan Gabungan Transfer</li>
                                                <li>Pengantaran ke Bandara berdasarkan Gabungan Transfer</li>
                                                <li>Landtour Asia Atau ME sesuai Jadwal</li>
                                                <li>Hotel</li>
                                                <li>Meal Sesuai Jadwal</li>
                                                <li>Driver merangkap Guide Atau Jasa Pendampingan Guide </li>
                                                <li>Souvenir cantik</li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>Tiket Pesawat International , Tax & Fuel Surcharge</li>
                                                <li>Visa</li>
                                                <li>Asuransi Pariwisata</li>
                                                <li>Modem</li>
                                                <li>Tips Guide</li>
                                                <li>Porter dan Biaya Pribadi</li>
                                                <li>Documen : Passport</li>
                                                <li>Tour Optional</li>

                                            </ul>
                                        </td>
                                        <td>
                                            <!-- <a class="btn btn-success btn-sm" href="preview_makeLT.php?id=<?php echo $row['id'] ?>" target="_BLANK"><i class="fa fa-print"></i></a>
                                        <a class="btn btn-primary btn-sm" href="preview_all_LT.php?id=<?php echo $row['id'] ?>" target="_BLANK"><i class="fa fa-print"></i></a> -->
                                            <a class="btn btn-warning btn-sm" href="preview_NF_LT.php?id=<?php echo $row['id'] ?>" target="_BLANK"><i class="fa fa-print"></i></a>
                                            <a class="btn btn-warning btn-sm" onclick="LT_include(0,<?php echo $row['id'] ?>,0)"><i class="fa fa-plus"></i></a>
                                            <!-- <a class="btn btn-success btn-sm" onclick="LT_include(1,<?php echo $row['id'] ?>,0)"><i class="fa fa-plane"></i></a> -->
                                            <a class="btn btn-info btn-sm" onclick="LT_include(3,<?php echo $row['id'] ?>,0)"><i class="fa fa-suitcase"></i></a>
                                            <!-- <a class="btn btn-secondary btn-sm" onclick="LT_include(2,<?php echo $row['id'] ?>,0)"><i class="fa fa-database"></i></a> -->
                                            <a class="btn btn-primary btn-sm" onclick="LT_include(4,<?php echo $row['id'] ?>,0)"><i class="fa fa-gift"></i></a>
                                            <a class="btn btn-danger btn-sm" onclick="del_makelt(<?php echo $row['id'] ?>)"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                    $no++;
                                }
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