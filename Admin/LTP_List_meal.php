<?php
session_start();
?>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Landtour Package List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <div style="padding-right: 5px;"><a class="btn btn-success btn-sm" href="export_list_tempat.php" target="_BLANK"><i class="fa fa-file-excel"></i></a></div>
                                <div style="padding-right: 5px;"> <button type="submit" onclick="LT_Package(2,0,0)" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    include "../site.php";
                    include "../db=connection.php";
                    $query = "SELECT * FROM Guest_meal2 order by negara";
                    $rs = mysqli_query($con, $query);
                    $no = 1 ;
                    ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Negara</th>
                                <th>Type</th>
                                <th>Kurs</th>
                                <th>Price</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($rs)) {
                                // var_dump($data);
                            ?>
                                <tr>
                                    <td><?php echo  $row['id'] ?></td>
                                    <td><?php echo $row['negara'] ?></td>
                                    <td><?php echo $row['meal_type'] ?></td>
                                    <td><?php echo $row['kurs'] ?></td>
                                    <td><?php echo $row['price'] ?></td>
                                    <td>
                                        <a class="btn btn-danger btn-sm" onclick=""><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div id='loadingmsg' style='display: none;'>
                    <div class="spinner-grow text-primary" role="status">>
                    </div>
                    <div class="spinner-grow text-primary" role="status">
                    </div>
                    <div class="spinner-grow text-primary" role="status">
                    </div>
                </div>
                <div id='loadingover' style='display: none;'></div>
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
            "iDisplayLength": 25
        });
    });
</script>
<script>
    function del_makelt(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "del_list_tmp.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        LT_Package(0, 0, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
</script>