<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<div id='loadingmsg' style='display: none;'>
    <div class="spinner-grow text-primary" role="status">>
    </div>
    <div class="spinner-grow text-primary" role="status">
    </div>
    <div class="spinner-grow text-primary" role="status">
    </div>
</div>
<div id='loadingover' style='display: none;'></div>
<?php
include "../site.php";
include "../db=connection.php";
session_start();
?>
<div class="content-wrapper" style="width: 170%;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Data Promo PT SUB List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <div style="padding-right: 5px;"><a class="btn btn-warning btn-sm" href="export_dp_ptsub.php" target="_BLANK"><i class="fa fa-file-excel"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table id="example" class="table table-striped table-bordered table-sm" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Master ID</th>
                                <th>Copy ID</th>
                                <th>Code</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Subject</th>
                                <th>Start Pax</th>
                                <th>Until Pax</th>
                                <th>Bonus Pax</th>
                                <th>Price Twn</th>
                                <th>Custom Twn</th>
                                <th>+Twn</th>
                                <th>Visa</th>
                                <th>Tips Guide</th>
                                <!-- <th>Fee TL</th> -->
                                <th>Flight</th>
                                <th>Paket Tour Creator</th>
                                <th>Data Promo Creator</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query_dp = "SELECT * FROM DP_ptsub2 where ket='2' order by negara ASC , city ASC,twn DESC";
                            $rs_dp = mysqli_query($con, $query_dp);
                            while ($value = mysqli_fetch_array($rs_dp)) {
                                $queryStaff2 = "SELECT name FROM  login_staff WHERE id=" . $value['sub_maker'];
                                $rsStaff2 = mysqli_query($con, $queryStaff2);
                                $rowStaff2 = mysqli_fetch_array($rsStaff2);
                                $pt_creator = $rowStaff2['name'];

                                $queryStaff = "SELECT name FROM  login_staff WHERE id=" . $value['dp_maker'];
                                $rsStaff = mysqli_query($con, $queryStaff);
                                $rowStaff = mysqli_fetch_array($rsStaff);
                                $dp_creator = $rowStaff['name'];

                            ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $value['master_id'] ?></td>
                                    <td><?php echo $value['copy_id'] ?></td>
                                    <td><?php echo $value['code'] ?></td>
                                    <td><?php echo $value['negara'] ?></td>
                                    <td><?php echo $value['city'] ?></td>
                                    <td><?php echo $value['judul'] ?></td>
                                    <td><?php echo $value['pax'] ?></td>
                                    <td><?php echo $value['pax_u'] ?></td>
                                    <td><?php echo $value['pax_b'] ?></td>
                                    <td style="min-width: 100px;">
                                        <?php
                                        echo "TWN :" . number_format($value['twn'], 0, ",", ".") . "</br>";
                                        echo "SGL :" . number_format($value['sgl'], 0, ",", ".") . "</br>";
                                        echo "CNB :" . number_format($value['cnb'], 0, ",", ".") . "</br>";
                                        echo "INF :" . number_format($value['inf'], 0, ",", ".") . "</br>";
                                        ?>
                                    </td>
                                    <td style="min-width: 100px;">
                                        <?php
                                        echo "C TWN :" . number_format($value['c_twn'], 0, ",", ".") . "</br>";
                                        echo "C SGL :" . number_format($value['c_sgl'], 0, ",", ".") . "</br>";
                                        echo "C CNB :" . number_format($value['c_cnb'], 0, ",", ".") . "</br>";
                                        echo "C INF :" . number_format($value['c_inf'], 0, ",", ".") . "</br>";
                                        ?>
                                    </td>
                                    <td style="min-width: 100px;"><?php echo "+ " . number_format($value['l_twn'], 0, ",", ".") ?></td>
                                    <td><?php echo number_format($value['visa'], 0, ",", ".") ?></td>
                                    <td><?php echo number_format($value['tips_guide'], 0, ",", ".") ?>
                                        <?php
                                        // $arr_chck = json_decode($value['chck_id'], true);
                                        // foreach ($arr_chck as $val_auto) {
                                        //     $query_p = "SELECT * FROM  checkbox_include2 where  id='$val_auto'";
                                        //     $rs_p = mysqli_query($con, $query_p);
                                        //     $row_p = mysqli_fetch_array($rs_p);

                                        //     echo $row_p['nama'] . "</br>";
                                        // }
                                        ?>
                                    </td>
                                    <!-- <td><?php echo number_format($value['fee_tl'], 0, ",", ".") ?></td> -->
                                    <td style="min-width: 250px;"><?php echo $value['flight'] ?> </td>
                                    <td><?php echo "Created on " . $value['sub_tgl'] . "</br>by " . $pt_creator ?></td>
                                    <td><?php echo "Created on " . $value['tgl'] . "</br>by " . $dp_creator ?></td>
                                    <td style="min-width: 100px;">
                                        <a class="btn btn-warning btn-sm" href="preview_DP_ptsub_baru.php?id=<?php echo $value['id'] ?>" target="_BLANK"><i class="fa fa-print"></i></a>
                                        <a class="btn btn-warning btn-sm" href="../Data_promo/to_png.php?id=<?php echo $value['id'] ?>" target="_BLANK"><i class="fas fa-images"></i></a>
                                        <a class="btn btn-primary btn-sm" href="../Data_promo/to_png_nh.php?id=<?php echo $value['id'] ?>" target="_BLANK"><i class="fas fa-images"></i></a>
                                        <a class="btn btn-danger btn-sm" onclick="del_makelt(<?php echo $value['id'] ?>)"><i class="fa fa-trash"></i></a>
                                        <a href="#myModal" class="btn btn-primary btn-sm" id="custId" data-toggle="modal" data-id="<?php echo $value['id'] ?>"><i class="fa fa-info-circle"></i></a>
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
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg" style="min-width:90%;" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel">DETAIL DATA PROMO PT SUB</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="fetched-data"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
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
    function showLoading() {
        document.getElementById('loadingmsg').style.display = 'block';
        document.getElementById('loadingover').style.display = 'block';
    }
</script>
<script>
    $(document).ready(function() {
        $('#myModal').on('show.bs.modal', function(e) {
            var rowid = $(e.relatedTarget).data('id');
            $.ajax({
                url: "DP_detail_ptsub.php",
                method: "POST",
                asynch: false,
                data: {
                    id: rowid,
                    cb: '2'
                }, //Pass $id
                success: function(data) {
                    $('.fetched-data').html(data); //Show fetched data from database
                }
            });
        });
    });
</script>
<script>
    function del_makelt(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "DP_delete_ptsub.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        DP_Package(0, 0, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }

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
    $(document).ready(function() {

        $('.submit_promo').on('click', e => {
            var r = confirm("Are you sure to copy this file ?");

            if (r == true) {
                const $button = $(e.target);
                const $modalBody = $button.closest('.modal-footer').prev('.modal-body');
                const id = $button.data('id');
                const pax = $modalBody.find($("select[name=pax" + id + "]")).val();
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
            // alert("on");

            //  console.log(id, hari, rute);

        });
    });
</script>