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
                    <h3 class="card-title" style="font-weight:bold;">Otorisasi Staff</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append">
                                <button type="button" onclick="insertPage(26,0,0)" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    $query = "SELECT * FROM LT_job_list order by tgl DESC ";
                    $rs = mysqli_query($con, $query);
                    // var_dump(mysqli_fetch_array($rs));
                    ?>
                    <div style="padding: 20px;">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Staff</th>
                                    <th>Landtour</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_array($rs)) {
                                    $query_lt = "SELECT kode,judul,pax,pax_u,pax_b FROM LT_itinnew where id='" . $row['lt_id'] . "'";
                                    $rs_lt = mysqli_query($con, $query_lt);
                                    $row_lt = mysqli_fetch_array($rs_lt);


                                    $query_js = "SELECT * FROM login_staff where id=".$row['staff_id'];
                                    $rs_js = mysqli_query($con, $query_js);
                                    $row_js = mysqli_fetch_array($rs_js);

                                ?>
                                    <tr>
                                        <th><?php echo $no ?></th>
                                        <td><?php echo $row['tgl'] ?></td>
                                        <td><?php echo $row_js['name'] ?></td>
                                        <td>
                                            <div style="color: darkmagenta;"><?php echo $row_lt['kode'] ?></div>
                                            <div style="font-size: 10pt;"><?php echo $row_lt['judul'] ?></div>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row['status'] == '0') {
                                                echo "Belum Dikerjakan";
                                            } else {
                                                echo "Complate";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger btn-sm" onclick="del_job(<?php echo $row['id'] ?>)"><i class="fa fa-trash"></i></a>
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
    function del_job(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "del_joblist.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        OT_Package(1, 0, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
</script>