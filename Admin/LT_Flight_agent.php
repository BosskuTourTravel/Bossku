<?php
session_start();
include "../site.php";
include "../db=connection.php";
?>
<div class="content-wrapper p-2">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Flight Agent</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#fl-add-agent"><i class="fa fa-plus"></i> Add</button>
                                <button type="button" onclick="LT_Package(24,0,0)" class="btn btn-success mr-1"><i class="fas fa-sync-alt"></i> Reload</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-2">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center bg-success">
                            <h5>Flight Travel Fair Promo</h5>
                        </div>
                        <div class="card-body">
                            <table id="table-name" class="table table-striped table-bordered table-sm p-2" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>JUDUL</th>
                                        <th>TGL</th>
                                        <th>KETERANGAN</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query_promo = "SELECT * FROM promo_flight order by id ASC";
                                    $rs_promo = mysqli_query($con, $query_promo);
                                    while ($row_promo = mysqli_fetch_array($rs_promo)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row_promo['id'] ?></td>
                                            <td><?php echo $row_promo['nama'] ?></td>
                                            <td><?php echo $row_promo['tgl'] ?></td>
                                            <td><?php echo $row_promo['ket'] ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-link btn-sm" onclick="show_flight(<?php echo $row_promo['id'] ?>)"><i class="fa fa-list-alt"></i> View</button>
                                                <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#fl-agent" data-id="<?php echo $row_promo['id'] ?>"><i class="fa fa-plus"></i> Add</button>
                                                <button type="button" class="btn btn-link btn-sm"><i class="fa fa-trash"></i> Hapus</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="show-flight"></div>
                </div>
            </div>
            <!-- /.card -->
            <div class="modal fade" id="fl-agent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Insert Flight </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-fl-agent"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="fl-add-agent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-large" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Insert Promo </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-fl-add-agent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table-name').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 25
        });
        $('#table-flight').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 25
        });
        $('#fl-agent').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "modal_fl_agent.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                },
                success: function(data) {
                    $('.modal-fl-agent').html(data);
                }
            });
        });
        $('#fl-add-agent').on('show.bs.modal', function(e) {
            // var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "modal_fl_add_agent.php",
                method: "POST",
                asynch: false,
                // data: {
                //     id: id,
                // },
                success: function(data) {
                    $('.modal-fl-add-agent').html(data);
                }
            });
        });
    });

    function show_flight(x) {
        $.ajax({
            url: "LT_Flight_agent_show.php",
            method: "POST",
            asynch: false,
            data: {
                id: x,
            },
            success: function(data) {
                $('#show-flight').html(data);
            }
        });
    }
</script>