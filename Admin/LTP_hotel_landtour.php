<?php
session_start();
?>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<div class="content-wrapper" style="width: 200%;">
    <div id='loadingover' style='display: none;'></div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Hotel Landtour Package List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <!-- <div style="padding-right: 5px;"><a class="btn btn-success btn-sm" href="export_list_tempat.php" target="_BLANK"><i class="fa fa-file-excel"></i></a></div> -->
                                <div style="padding-right: 5px;"><button type="submit" onclick="LT_Package(14,0,0)" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    include "../site.php";
                    include "../db=connection.php";
                    $query_code = "SELECT DISTINCT kode  FROM  LT_itinnew order by kode ASC";
                    $rs_code = mysqli_query($con, $query_code);
                    $no = 1
                    ?>
                    <table id="example" class="table table-striped table-bordered table-sm" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Continent</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Hotel Name</th>
                                <th>Address</th>
                                <th>Periode</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Class</th>
                                <th>Kurs</th>
                                <th>Type</th>
                                <th>OCC</th>
                                <th>Rate Low</th>
                                <th>Rate High</th>
                                <th>Extra Bed</th>
                                <th>Inclusive</th>
                                <th>Remarks</th>
                                <th>Quote</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query_hlt = "SELECT * FROM hotel_lt order by id ASC";
                            $rs_hlt = mysqli_query($con, $query_hlt);
                            while ($row_hlt = mysqli_fetch_array($rs_hlt)) {
                            ?>
                                <tr>
                                    <td><?php echo $row_hlt['id']?></td>
                                    <td><?php echo $row_hlt['continent']?></td>
                                    <td><?php echo $row_hlt['country']?></td>
                                    <td><?php echo $row_hlt['city']?></td>
                                    <td><?php echo $row_hlt['name']?></td>
                                    <td><?php echo $row_hlt['addres']?></td>
                                    <td><?php echo $row_hlt['periode']?></td>
                                    <td><?php echo $row_hlt['email']?></td>
                                    <td><?php echo $row_hlt['phone']?></td>
                                    <td><?php echo $row_hlt['class']?></td>
                                    <td><?php echo $row_hlt['kurs']?></td>
                                    <td><?php echo $row_hlt['type']?></td>
                                    <td><?php echo $row_hlt['occ']?></td>
                                    <td><?php echo $row_hlt['rate_low']?></td>
                                    <td><?php echo $row_hlt['rate_high']?></td>
                                    <td><?php echo $row_hlt['extra_bed']?></td>
                                    <td><?php echo $row_hlt['inclusive']?></td>
                                    <td><?php echo $row_hlt['remarks']?></td>
                                    <td><?php echo $row_hlt['quote']?></td>
                                    <td></td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
        <!-- /.card-body -->
    </div>
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