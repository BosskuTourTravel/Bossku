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
                    <h3 class="card-title" style="font-weight:bold;">Consortium List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary mr-1" data-toggle="modal" data-target="#add-consortium"><i class="fa fa-plus"></i> Add</button>
                                <button type="button" onclick="CS_Package(0,0,0)" class="btn btn-success mr-1"><i class="fas fa-sync-alt"></i> Reload</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-2">
                    <div class="card-body">
                        <table id="table-consortium" class="table table-striped table-bordered table-sm p-2" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Continent</th>
                                    <th>Country</th>
                                    <th>City</th>
                                    <th>Name Tour</th>
                                    <th>Adult</th>
                                    <th>Child</th>
                                    <th>Infant</th>
                                    <th>Creation Date</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card -->
            <div class="modal fade" id="add-consortium" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ADD Consortium</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-consortium"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table-consortium').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 25
        });
        $('#add-consortium').on('hidden.bs.modal', function() {
            CS_Package(0,0,0);
        });

        $('#add-consortium').on('show.bs.modal', function(e) {
            // var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "modal_consortium.php",
                method: "POST",
                asynch: false,
                // data: {
                //     id: id,
                // },
                success: function(data) {
                    $('.modal-consortium').html(data);
                }
            });
        });
    });
</script>