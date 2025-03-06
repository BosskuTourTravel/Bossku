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
                    <h3 class="card-title" style="font-weight:bold;">Cruise Tour Drive</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append">
                                <button type="submit" onclick="insertPage(28,0,0)" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    include "../site.php";
                    include "../db=connection.php";
                    $query = "SELECT * FROM  Itinerary_Cuise order by id DESC";
                    $rs = mysqli_query($con, $query);
                    $no = 1;

                    ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tgl</th>
                                <th>Nama</th>
                                <th>Sub</th>
                                <th>Notes</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($rs)) {
                            ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $row['tgl'] ?></td>
                                    <td><?php echo $row['judul'] ?></td>
                                    <td><?php echo $row['sub'] ?></td>
                                    <td><?php echo $country['notes'] ?></td>
                                    <td>
                                        <button type='submit'  onclick="reloadcruise(0,<?php echo $row['id'] ?>,0)" class='btn btn-primary'>Activity</button>
                                        <button type='submit'onclick="reloadcruise(2,<?php echo $row['id'] ?>,0)" class='btn btn-success'>Itin</button>
                                        <button type='submit' onclick="reloadcruise(4,<?php echo $row['id'] ?>,0)"  class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true'></i></button>
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