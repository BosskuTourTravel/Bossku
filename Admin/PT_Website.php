<?php
session_start();
include "../site.php";
include "../db=connection.php";
?>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<div class="content-wrapper">
    <div class="card" style="margin: 10px;">
        <div class="card-header">
            <h3 class="card-title" style="font-weight:bold;">PAKET TOUR WEBSITE</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px; text-align: right;">
                    <a class="btn btn-primary btn-sm" onclick="LT_Package(23,0, 0);"><i class="fas fa-sync-alt"></i></a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <?php
            $query = "SELECT paket_tour_online.*, LTSUB_itin.judul,LTSUB_itin.landtour,LT_change_judul.nama as change_judul,LTP_insert_sfee.ket as staff_id,login_staff.name as staff_name FROM paket_tour_online INNER JOIN LTSUB_itin ON paket_tour_online.tour_id=LTSUB_itin.id lEFT JOIN LT_change_judul ON paket_tour_online.tour_id=LT_change_judul.copy_id && paket_tour_online.grub_id=LT_change_judul.grub_id INNER JOIN LTP_insert_sfee ON paket_tour_online.sfee_id=LTP_insert_sfee.id INNER JOIN login_staff ON LTP_insert_sfee.ket=login_staff.id order by paket_tour_online.negara, paket_tour_online.gt ASC";
            $rs = mysqli_query($con, $query);
            $no = 1;
            ?>
            <table id="example" class="table table-striped table-bordered table-sm" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>ID Paket</th>
                        <th>Code LT</th>
                        <th>Nama Paket</th>
                        <th>Category</th>
                        <th>Pax</th>
                        <th>TGL Berangkat</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row_ls = mysqli_fetch_array($rs)) {

                        $judul = "";

                        if (isset($row_ls['change_judul'])) {
                            $judul = $row_ls['change_judul'];
                        } else {
                            $judul = $row_ls['judul'];
                        }

                        if ($row_ls['promo'] == "p_ls") {
                            $detail = "Low Seasons";
                        } else if ($row_ls['promo'] == "p_ny") {
                            $detail = "New Years";
                        } else if ($row_ls['promo'] == "p_lebaran") {
                            $detail = "Lebaran";
                        } else if ($row_ls['promo'] == "p_sh") {
                            $detail = "School Holiday";
                        } else {
                            $detail = "Undefined";
                        }
                    ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $row_ls['tour_id']  ?></td>
                            <td><?php echo $row_ls['landtour'] ?></td>
                            <td>
                                <div><?php echo $judul ?></div>
                                <div style="font-weight: bold;">Strart : <?php echo $row_ls['start'] ?></div>
                                <div>Created by <?php echo $row_ls['staff_name'] ?></div>
                            </td>
                            <td><?php echo $detail ?></td>
                            <td><?php echo $row_ls['pax_tour'] ?></td>
                            <td>
                                <?php
                                if ($row_ls['tgl_ber'] != "0000-00-00") {
                                    echo $row_ls['tgl_ber'];
                                }
                                ?>
                            </td>
                            <td> <?php echo "IDR " . number_format($row_ls['gt'], 0, ".", ".") ?></td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" onclick="del_pt(<?php echo $row_ls['id'] ?>)"><i class="fa fa-trash"></i></button>
                                <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#handle-modal" data-id="<?php echo $row_ls['id']  ?>"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-success btn-sm tip" href="cetak_pt_website.php?id=<?php echo $row_ls['id'] ?>" target="_BLANK" title="Cetak Itin"><i class="fa fa-print"></i></a>
                            </td>
                        </tr>

                    <?php


                        $no++;
                    }
                    ?>

                </tbody>
                <tfoot>

                </tfoot>
            </table>
            <div class="modal fade" id="handle-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
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
                            <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="add_handle(); reload()">Submit</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
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
        $('#handle-modal').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "category_modal_PT.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                },
                success: function(data) {
                    $('.modal-data-handle').html(data);
                }
            });
        });
    });

    function add_handle() {
        var id = document.getElementById("id").value;
        var promo = document.getElementById("promo").value;
        // alert(cek);
        $.ajax({
            url: "update_pt_category.php",
            method: "POST",
            asynch: false,
            data: {
                id: id,
                promo: promo
            },
            success: function(data) {
                if (data == "success") {
                    alert("Success");
                    // alert(data);
                }
            }
        });
    }

    function reload() {
        $('#handle-modal').on('hidden.bs.modal', function() {
            LT_Package(23, 0, 0);
        })
    }

    function del_pt(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "del_PTWeb.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        // LT_itinerary(81, y, 0);
                        LT_Package(23, x, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
</script>