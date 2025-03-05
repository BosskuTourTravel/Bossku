<?php
session_start();
include "../site.php";
include "../db=connection.php";
include "../slug.php";
include "Api_LT_total_baru.php";
?>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">LAND TOUR WEBSITE</h3>
                    <div class="input-group input-group-sm">
                        <div class="input-group-append" style="text-align: left;">
                        </div>
                    </div>

                    <!-- </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-2">
                    <?php
                    $query = "SELECT LT_itinerary2.id as tour_id,LT_itinerary2.judul,LT_itinerary2.landtour,LT_itinerary2.hari,LT_itinerary2.status, itin.*,LT_add_Category.category FROM ( SELECT * FROM LT_itinnew where LT_itinnew.agent_twn !='0' && LT_itinnew.statuss !='E' GROUP by LT_itinnew.kode ) AS itin INNER JOIN LT_itinerary2 ON itin.kode = LT_itinerary2.landtour LEFT JOIN LT_add_Category ON LT_itinerary2.id = LT_add_Category.tour_id where LT_itinerary2.landtour !='undefined' order by itin.benua , itin.negara ASC";
                    $rs = mysqli_query($con, $query);
                    $no = 1
                    ?>
                    <table id="example" class="table table-striped table-bordered table-sm" style="font-size: 14px;">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ID</th>
                                <th>Code</th>
                                <th style="max-width: 100px;">Continent-Country</th>
                                <th>Nama Paket</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_array($rs)) {
                                $p = 0;
                                $category_name = "";
                                if (isset($row['category'])) {

                                    $query_ct2 = "SELECT * FROM LT_Category where id='" . $row['category'] . "'";
                                    $rs_ct2 = mysqli_query($con, $query_ct2);
                                    $row_ct2 = mysqli_fetch_array($rs_ct2);
                                    $p = 1;
                                    $category_name = $row_ct2['nama'];
                                }

                                // priceeeee
                                $data_twn = array(
                                    "kurs" => $row['kurs'],
                                    "nominal" => $row['agent_twn'],
                                );


                                $show_kurs_twn = get_kurs($data_twn);
                                $rs_kurs_twn = json_decode($show_kurs_twn, true);



                                $agent_twn = $rs_kurs_twn['data'];


                                $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $agent_twn . "' && price2 >='" . $agent_twn . "'";
                                $rs_profit = mysqli_query($con, $sql_profit);
                                $row_profit = mysqli_fetch_array($rs_profit);

                                $pr = 0;
                                if (isset($row_profit['id'])) {
                                    $pr = $row_profit['profit'];
                                } else {
                                    $pr = 5;
                                }
                                $twin = ($agent_twn * $pr / 100) + $agent_twn;


                                $twn_sp = get_pembulatan($twin);
                                $twn_rp = json_decode($twn_sp, true);



                            ?>
                                <tr>
                                    <th><?php echo $no ?></th>
                                    <th><?php echo $row['tour_id'] ?></th>
                                    <td><?php echo  $row['landtour'] ?></td>
                                    <td><?php echo "<b>" . $row['benua'] . "</b> : " . $row['negara'] ?></td>
                                    <td><?php echo $row['judul'] ?></td>
                                    <td>
                                        <?php
                                        if ($p == '1') {
                                        ?>
                                            <span class="badge badge-pill badge-success"><?php echo $category_name  ?></span>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo "Rp." . number_format($twn_rp['value'], 0, ",", ".") ?></td>
                                    <td>
                                        <?php
                                        if ($p == '0') {
                                        ?>
                                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#handle-modal" data-id="<?php echo $row['tour_id']  ?>" data-cek='0'><i class="fa fa-edit"></i></a>
                                        <?php

                                        } else {
                                        ?>
                                            <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#handle-modal" data-id="<?php echo $row['tour_id']  ?>" data-cek='1'><i class="fa fa-edit"></i></a>
                                        <?php
                                        }
                                        ?>
                                        <a class="btn btn-success btn-sm tip my-1" href="cetak_all_LTnew.php?id=<?php echo $row['tour_id'] ?>" target="_BLANK" title="Cetak Itin"><i class="fa fa-print"></i></a>
                                        <a class="btn btn-warning btn-sm tip my-1" href="<?php echo $domain_web ?>detail-landtour.php?id=<?php echo $row['id'] ?>&master=<?php echo $row['tour_id'] ?>" target="_BLANK" title="Cetak Itin"><i class="fas fa-sign-in-alt"></i></a>
                                        <a class="btn btn-primary btn-sm tip my-1" data-toggle="modal" data-target="#youtube-modal" data-id="<?php echo $row['tour_id']  ?>"><i class="fas fa-link"></i></a>
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
                                    <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="add_handle(); reload()">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="youtube-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal Link Youtube</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data-youtube"></div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="add_youtube(); reload()">Submit</button>
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
            var cek = $(e.relatedTarget).data('cek');
            $.ajax({
                url: "category_modal.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                    cek: cek
                },
                success: function(data) {
                    $('.modal-data-handle').html(data);
                }
            });
        });
        $('#youtube-modal').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "youtube_modal.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                },
                success: function(data) {
                    $('.modal-data-youtube').html(data);
                }
            });
        });
    });
</script>
<script>
    function add_handle() {
        var id = document.getElementById("id").value;
        var staff = document.getElementById("staff").value;
        var cek = document.getElementById("cek").value;
        // alert(cek);
        $.ajax({
            url: "insert_lt_category.php",
            method: "POST",
            asynch: false,
            data: {
                id: id,
                staff: staff,
                cek: cek
            },
            success: function(data) {
                if (data == "success") {
                    alert("Success");
                    // alert(data);
                }
            }
        });
    }

    function add_youtube() {
        var id = document.getElementById("id").value;
        var link = document.getElementById("link").value;
        // alert(cek);
        $.ajax({
            url: "insert_link_youtube.php",
            method: "POST",
            asynch: false,
            data: {
                id: id,
                link: link,
            },
            success: function(data) {
                if (data == "success") {
                    alert("Success");
                    // alert(data);
                }
            }
        });
    }

    function edit_youtube() {
        var id = document.getElementById("id").value;
        var link = document.getElementById("link").value;
        // alert(cek);
        $.ajax({
            url: "edit_link_youtube.php",
            method: "POST",
            asynch: false,
            data: {
                id: id,
                link: link,
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
            LT_Package(22, 0, 0);
        })
    }
</script>