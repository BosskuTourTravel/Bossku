<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">List Itinerary</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <button type="submit" onclick="reloadLandtour(3,0,0)" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    include "../site.php";
                    include "../db=connection.php";
                    $query = "SELECT * FROM  Prev_itin order by id DESC";
                    $rs = mysqli_query($con, $query);
                    $no = 1
                    ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($rs)) {
                                $data = json_decode($row['data'],true);
                                // var_dump($data);
                            ?>
                                <tr>
                                    <td><?php echo  $row['id']?></td>
                                    <td><?php echo $data['nama']?></td>
                                    <td>
                                    <a class="btn btn-success btn-xs" href="preview_itinerary.php?id=<?php echo$row['id']?>" target="_BLANK"><i class="fa fa-print"></i></a>
                                    <a class="btn btn-warning btn-xs" onclick="LT_include(0,<?php echo $row['id'] ?>,0)"><i class="fa fa-edit"></i></a>
                                    <a class="btn btn-danger btn-xs" onclick="del_makelt(<?php echo $row['id'] ?>)"><i class="fa fa-trash"></i></a>        
                                    </td>
                                </tr>
                            <?php
                                $no++;
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