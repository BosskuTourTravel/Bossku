<!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script> -->
<?php
session_start();
include "../db=connection.php";
include "Api_get_master_print.php";
$query = "SELECT * FROM  LT_itinerary2 where id =" . $_POST['id'];
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);

$query_ia = "SELECT litin_asli,itin_np FROM LT_itinnew where kode='" . $row['landtour'] . "' && litin_asli != '' LIMIT 1";
$rs_ia = mysqli_query($con, $query_ia);
$row_ia = mysqli_fetch_array($rs_ia);
// var_dump($query_ia);
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">KODE : <?php echo $row['landtour'] ?></h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm tip" onclick="LT_itinerary(0,0,0)" title="Back"><i class="fas fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(27,<?php echo $_POST['id'] ?>,0)" title="Refresh"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="card text-left" style="padding: 20px;">
                        <div class="card-header" style="background-color: darkslateblue; color: white;">
                            <div class="row">
                                <div class="col-md-4" style="text-align: center;">
                                    <b>EDIT</b>
                                    <div style="text-align: left; border: solid 2px; padding: 10px;">
                                        <!-- <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(2,<?php echo $row['id'] ?>,0)" title="Add Component"><i class="fa fa-plus"></i></a> -->
                                        <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(5,<?php echo $row['id'] ?>,0)" title="Edit Itin"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(23,<?php echo $row['id'] ?>,0)" title="Edit List Tempat"><i class="fa fa-tasks"></i></a>
                                        <!-- xxxx -->
                                        <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(28,<?php echo $row['id'] ?>,0)" title="Meal"><i class="fas fa-utensils"></i></a>
                                        <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(29,<?php echo $row['id'] ?>,0)" title="Hotel"><i class="fas fa-hotel"></i></a>
                                        <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(30,<?php echo $row['id'] ?>,0)" title="List Tmp Optional"><i class="fas fa-map-marked"></i></a>
                                        <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(37,<?php echo $row['id'] ?>,0)" title="Add Land Transport"><i class="fa fa-bus"></i></a>
                                        <!-- <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(38,<?php echo $row['id'] ?>,0)" title="Add image "><i class="fa fa-image"></i></a> -->
                                        <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(42,<?php echo $row['id'] ?>,0)" title="Add image"><i class="fa fa-image"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4" style="text-align: center;">
                                    <b>PRINT</b>
                                    <div style="text-align: left; border: solid 2px; padding: 10px;">
                                        <!-- <a class="btn btn-success btn-sm tip" href="preview_all_LTnew.php?id=<?php echo $row['id'] ?>" target="_BLANK" title="Cetak Itin"><i class="fa fa-print"></i></a> -->
                                        <a class="btn btn-success btn-sm tip" href="cetak_all_LTnew.php?id=<?php echo $row['id'] ?>" target="_BLANK" title="Cetak Itin"><i class="fa fa-print"></i></a>
                                        <a class="btn btn-warning btn-sm tip" href="../Data_promo/landtour_master.php?id=<?php echo $row['id'] ?>" target="_BLANK" title="Cetak Flayer KOP"> <i class="fas fa-images"></i></a>
                                        <a class="btn btn-success btn-sm tip" href="../Data_promo/landtour_master_agent.php?id=<?php echo $row['id'] ?>" target="_BLANK" title="Cetak Flayer"> <i class="fas fa-images"></i></a>
                                        <a class="btn btn-info btn-sm tip" href="cetak_LT_Agent.php?id=<?php echo $row['id'] ?>" target="_BLANK" title="Cetak Itin Agent"><i class="fa fa-print"></i></a>
                                        <?php if ($row['landtour'] != "undefined") {
                                            if ($_SESSION['staff'] == "Sherliana Tanjaya" or  $_SESSION['staff'] == "Neno Kusminto") {
                                                if ($row_ia['litin_asli'] != "") {
                                        ?>
                                                    <a class="btn btn-success btn-sm tip" href="<?php echo $row_ia['litin_asli'] ?>" target="_BLANK" title="Cek Itin Asli"><i class="fa fa-file-pdf"></i></a>
                                                <?php
                                                }
                                            } else {
                                                if ($row_ia['itin_np'] != "") {
                                                ?>
                                                    <a class="btn btn-warning btn-sm tip" href="<?php echo $row_ia['itin_np'] ?>" target="_BLANK" title="Cek Itin Asli"><i class="fa fa-file-pdf"></i></a>
                                            <?php
                                                }
                                            }
                                            ?>
                                        <?php

                                        } ?>
                                        <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(43,<?php echo $row['id'] ?>,0)"><i class="fa fa-check-square"></i></a>
                                    </div>
                                </div>
                                <div class="col-md-4" style="text-align: center;">
                                    <b>COPY</b>
                                    <div style="text-align: left; border: solid 2px; padding: 10px;">
                                        <button type="button" class="btn btn-primary btn-sm tip" data-toggle="modal" data-target="#exampleModal<?php echo $row['id'] ?>" title="Copy Itin">
                                            <i class="far fa-clone"></i>
                                        </button>
                                        <a class="btn btn-warning btn-sm tip" data-toggle="modal" data-target="#promoModal" data-id="<?php echo $row['id']  ?>" title="Copy to DP"><i class="fa fa-upload"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div style="padding: 10px;">
                                <?php
                                $id = $row['id'];
                                data_print($id); ?>
                            </div>
                        </div>
                        <div class="card-footer text-muted" style="background-color: darkslateblue; color: white; height: 40px;">
                        </div>
                    </div>
                </div>
                <!-- modal disini -->
                <div class="modal fade" id="exampleModal<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Copy Master Itinerary To</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Pilih Lokasi Tujuan Data Tersimpan
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success btn-sm" onclick="copy_itin(<?php echo $row['id'] ?>,2)">SUB</button>
                                <button type="button" class="btn btn-warning btn-sm" onclick="copy_itin(<?php echo $row['id'] ?>,3)">BTH</button>
                                <button type="button" class="btn btn-primary btn-sm" onclick="copy_itin(<?php echo $row['id'] ?>,4)">CGK</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- no 2 -->
                <div class="modal fade" id="promoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Copy to Master Promo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-data"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success btn-sm" onclick="add_promo()" data-dismiss="modal">SUBMIT</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal disini -->
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
    $(document).ready(function() {
        $(".tip").tooltip({
            placement: 'top',
            trigger: "hover"
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#promoModal').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "master_promo_modal.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                },
                success: function(data) {
                    $('.modal-data').html(data);
                }
            });
        });
    });

    function copy_itin(x, y) {
        var r = confirm("Are you sure to copy this file ?");

        if (r == true) {
            let formData = new FormData();
            formData.append('id', x);
            formData.append('cabang', y);
            $.ajax({
                type: 'POST',
                url: "copy_add_LT.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert(msg);
                    // LT_itinerary(0, 0, 0);
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
        }
    }

    function add_promo() {
        var r = confirm("Are you sure to copy this file ?");
        if (r == true) {
            const id = document.getElementById("id").value;
            const pax = document.getElementById("pax").value = document.getElementById("pax").value;
            // alert(pax);

            let formData = new FormData();
            formData.append('id', id);
            formData.append('pax', pax);
            // work with the values here:
            $.ajax({
                type: 'POST',
                url: "copy_master_promo.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert(msg);
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
        }
    }
</script>