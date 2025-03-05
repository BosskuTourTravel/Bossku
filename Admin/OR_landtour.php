<?php
session_start();
require("Api_Kurs_online.php");
include "../site.php";
include "../db=connection.php";
$query_tgl = "SELECT tgl FROM  kurs_bca_field where nama != 'IDR' order by id ASC limit 1";
$rs_tgl = mysqli_query($con, $query_tgl);
$row_tgl = mysqli_fetch_array($rs_tgl);
?>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="input-group input-group-sm">
                        <div class="input-group-append" style="text-align: left;">
                        </div>
                    </div>

                    <!-- </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    $query = "SELECT * FROM  LT_order_list  order by status ASC, id ASC";
                    $rs = mysqli_query($con, $query);
                    $no = 1
                    ?>
                    <table id="example" class="table table-striped table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Nama Paket</th>
                                <th>Tgl Berangkat</th>
                                <th>Pax</th>
                                <th>Price</th>
                                <th></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_array($rs)) {
                                $query_staff = "SELECT * FROM login_staff where id=".$row['handle'];
                                $rs_staff = mysqli_query($con,$query_staff);
                                $row_staff = mysqli_fetch_array($rs_staff);
                            ?>
                                <tr>
                                    <th><?php echo $no ?></th>
                                    <td>
                                        <div>Nama : <?php echo $row['nama'] ?></div>
                                        <div>Email : <?php echo $row['email'] ?></div>
                                        <div>Tlpn : <?php echo $row['tlpn'] ?></div>
                                        <div style="color: green;">Handle : <?php echo $row_staff['name'] ?></div>
                                    </td>
                                    <td><?php echo $row['nama_paket'] ?></td>
                                    <td><?php echo $row['tgl_berangkat'] ?></td>
                                    <td><?php echo $row['adt'] . " adt, " . $row['chd'] . " chd" ?></td>
                                    <td><?php echo "IDR " . number_format($row['price_web'], 0, ",", ".")  ?></td>
                                    <?php
                                    if ($row['status'] == '0') {
                                    ?>
                                        <td style="color: red; text-align: center;">
                                            <i class="fa fa-times"></i>
                                        </td>
                                    <?php
                                    } else {
                                    ?>
                                        <td style="color: green; text-align: center;">
                                            <i class="fa fa-check"></i>
                                        </td>
                                    <?php
                                    }
                                    ?>
                                    <td>
                                        <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#handle-modal" data-id="<?php echo $row['id']  ?>"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-warning btn-sm" href="cetak_invoice.php?id=<?php echo $row['id'] ?>" target="_BLANK"><i class="fa fa-print"></i></a>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="modal fade" id="handle-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal Handle</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-handle"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success btn-sm" onclick="add_handle()" data-dismiss="modal">Submit</button>
                                </div>
                            </div>
                        </div>
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
            "iDisplayLength": 25
        });
        $('#handle-modal').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "handle_modal.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id
                },
                success: function(data) {
                    $('.modal-data-handle').html(data);
                }
            });
        });
    });
</script>
<script>
    function add_handle() {
        var id = document.getElementById("id").value;
        var staff = document.getElementById("staff").value;
        $.ajax({
                url: "Update_handle_lt.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    staff: staff,
                },
                success: function(data) {
                    if (data == "success") {
                         alert("Success");
                    }
                }
            });
    }
</script>