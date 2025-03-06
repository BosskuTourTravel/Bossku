<?php
session_start();
include "../site.php";
include "../db=connection.php";
?>
<div class="content-wrapper" style="width: 110%;">
    <div id='loadingover' style='display: none;'></div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Landtour Package List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 350px;">
                            <div class="form-group" style="margin-right: 5px;">
                                <select class="form-control form-control-sm" id="item" name="item">
                                    <option value="">Pilih Nama Staff</option>
                                    <?php
                                    $query = "SELECT * FROM login_staff  order by id ASC";
                                    $rs = mysqli_query($con, $query);
                                    while ($row = mysqli_fetch_array($rs)) {
                                    ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div style="margin-right: 20px;"> <button type="button" onclick="add_job()" class="btn btn-warning btn-sm">assign</button></div>
                            <div class="input-group-append" style="text-align: right;">
                                <div style="padding-right: 5px;"><a class="btn btn-success btn-sm" href="export_list_tempat.php" target="_BLANK"><i class="fa fa-file-excel"></i></a></div>
                                <div style="padding-right: 5px;"> <button type="button" onclick="LT_Package(2,0,0)" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    $query_code = "SELECT DISTINCT kode  FROM  LT_itinnew order by kode ASC";
                    $rs_code = mysqli_query($con, $query_code);
                    $no = 1
                    ?>
                    <div style="padding: 20px;">
                        <table id="example" class="table table-striped table-bordered table-sm" style="width:100%; font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NO</th>
                                    <th>KODE</th>
                                    <?php
                                    if ($_SESSION['type'] == 1  or $_SESSION['type'] == 2 or $_SESSION['staff'] == "Lestari") {
                                    ?>
                                        <th>AGENT</th>
                                    <?php

                                    }
                                    ?>
                                    <th>JUDUL</th>
                                    <th>NEGARA</th>
                                    <th>PAX</th>
                                    <th>PRICE</th>
                                    <th>HOTEL</th>
                                    <th>KET</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row_code = mysqli_fetch_array($rs_code)) {
                                    $label = "";
                                    $query = "SELECT * FROM LT_itinnew where kode='" . $row_code['kode'] . "' LIMIT 1";
                                    $rs = mysqli_query($con, $query);
                                    $row = mysqli_fetch_array($rs);

                                    $query_ia = "SELECT * FROM LT_itinnew where kode='" . $row_code['kode'] . "' && litin_asli != '' LIMIT 1";
                                    $rs_ia = mysqli_query($con, $query_ia);
                                    $row_ia = mysqli_fetch_array($rs_ia);


                                    $query_master = "SELECT * FROM LT_itinerary2 where landtour='" . $row_code['kode'] . "' LIMIT 1";
                                    $rs_master = mysqli_query($con, $query_master);
                                    $row_master = mysqli_fetch_array($rs_master);

                                    $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $row['agent_twn'] . "' && price2 >='" . $row['agent_twn'] . "'";
                                    $rs_profit = mysqli_query($con, $sql_profit);
                                    $row_profit = mysqli_fetch_array($rs_profit);

                                    $pr = 0;
                                    if ($row_profit['id'] != "") {
                                        $pr = $row_profit['profit'];
                                    } else {
                                        $pr = 5;
                                    }
                                    $ste = $row_profit['staff_eks'];
                                    $nom = $row_profit['nominal'];
                                    // $lain2 = $dm + $mar + $agn_s + $ste + $nom;

                                    $atwn =  ($row['agent_twn'] * $pr / 100) + $row['agent_twn'] + $nom;
                                    $asgl =  ($row['agent_sgl'] * $pr / 100) + $row['agent_sgl'] + $nom;
                                    $acnb =  ($row['agent_cnb'] * $pr / 100) + $row['agent_cnb'] + $nom;
                                    $asglsub =  ($row['agent_sglsub'] * $pr / 100) + $row['agent_sglsub'];
                                    $ainfant =  ($row['agent_infant'] * $pr / 100) + $row['agent_infant'] + $nom;
                                    // var_dump($data);
                                ?>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="<?php echo  $row['id'] ?>" id="chck" name="chck">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    <?php echo  $row['id'] ?>
                                                </label>
                                            </div>

                                        </td>
                                        <td><?php echo $row['no_urut'] ?></td>
                                        <td><?php echo $row['kode'] ?></td>
                                        <?php
                                        if ($_SESSION['type'] == 1  or $_SESSION['type'] == 2 or $_SESSION['staff'] == "Lestari") {
                                        ?>
                                            <td><?php echo $row['agent'] ?></td>
                                        <?php

                                        }
                                        ?>

                                        <td><?php echo $row['judul'] ?></td>
                                        <td><?php echo $row['benua'] . "</br>" . $row['negara'] . "</br>" . $row['kota'] ?></td>
                                        <td><?php
                                            $pax = $row['pax'];
                                            $detailj = "(" . $pax . " - " . $row['pax_u'] . " [" . $row['pax_b'] . "])";
                                            echo $detailj ?></td>
                                        <td style="min-width: 150px;">
                                            <div>TWIN : Rp. <?php echo number_format($atwn, 0, ",", ".") ?></div>
                                            <div>SINGLE : Rp. <?php echo number_format($asgl, 0, ",", ".") ?></div>
                                            <div>CNB : Rp. <?php echo number_format($acnb, 0, ",", ".") ?></div>
                                            <div>SGL SUB : Rp. <?php echo number_format($asgl, 0, ",", ".") ?></div>
                                            <div>INFANT : Rp. <?php echo number_format($ainfant, 0, ",", ".") ?></div>
                                        </td>
                                        <td style="font-size: 10px;">
                                            <div>
                                                <?php
                                                if ($row['hotel1'] != "") {
                                                    echo "<li>" . $row['hotel1'] . "</li>";
                                                }
                                                if ($row['hotel2'] != "") {
                                                    echo "<li>" . $row['hotel2'] . "</li>";
                                                }
                                                if ($row['hotel3'] != "") {
                                                    echo "<li>" . $row['hotel3'] . "</li>";
                                                }
                                                if ($row['hotel4'] != "") {
                                                    echo "<li>" . $row['hotel4'] . "</li>";
                                                }
                                                if ($row['hotel5'] != "") {
                                                    echo "<li>" . $row['hotel5'] . "</li>";
                                                }
                                                if ($row['hotel6'] != "") {
                                                    echo "<li>" . $row['hotel6'] . "</li>";
                                                }
                                                if ($row['hotel7'] != "") {
                                                    echo "<li>" . $row['hotel7'] . "</li>";
                                                }
                                                if ($row['hotel8'] != "") {
                                                    echo "<li>" . $row['hotel8'] . "</li>";
                                                }
                                                if ($row['hotel9'] != "") {
                                                    echo "<li>" . $row['hotel9'] . "</li>";
                                                }
                                                if ($row['hotel10'] != "") {
                                                    echo "<li>" . $row['hotel10'] . "</li>";
                                                }
                                                ?>
                                            </div>
                                        </td>
                                        <td><?php echo $row['ket'] ?></td>
                                        <td style="text-align: center;">
                                            <?php
                                            if ($row['statuss'] == "U") {
                                                if ($row_master['id'] == "") {
                                            ?>
                                                    <p style="color: blue;">Ready Used</p>
                                                <?php
                                                } else {
                                                ?>
                                                    <p style="color: green;">Publish</p>
                                                <?php
                                                }
                                            } else {
                                                if ($row_master['id'] == "") {
                                                ?>
                                                    <p style="color: red;">Unused</p>
                                                <?php
                                                } else {
                                                ?>
                                                    <p style="color: red;">Expired</p>
                                            <?php
                                                }
                                            } ?>

                                        </td>
                                        <td style="min-width: 100px;">
                                            <?php
                                            if ($row['statuss'] == "U") {
                                                if ($row_master['id'] == "") {
                                            ?>
                                                    <a class="btn btn-warning btn-sm" onclick="LT_itinerary(13,<?php echo $row['id'] ?>,0)"><i class="fa fa-edit"></i></a>
                                                <?php
                                                }
                                            }
                                            if ($_SESSION['staff'] == "Sherliana Tanjaya" or  $_SESSION['staff'] == "Neno Kusminto") {
                                                if ($row_ia['litin_asli'] != "") {
                                                ?>
                                                    <a class="btn btn-success btn-sm" href="<?php echo $row_ia['litin_asli'] ?>" target="_BLANK"><i class="fa fa-file-pdf"></i></a>
                                                <?php
                                                }
                                            } else {
                                                if ($row_ia['itin_np'] != "") {
                                                ?>
                                                    <a class="btn btn-warning btn-sm" href="<?php echo $row_ia['itin_np'] ?>" target="_BLANK"><i class="fa fa-file-pdf"></i></a>
                                            <?php
                                                }
                                            }

                                            ?>
                                            <!-- <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#job_modal" data-id="<?php echo  $row_ia['id']  ?>"><i class="fa fa-edit"></i></a> -->
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- <div class="modal fade" id="job_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Job List Staff</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data"></div>
                                </div>
                            </div>
                        </div>
                    </div> -->
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
        // $('#job_modal').on('show.bs.modal', function(e) {
        //     var id = $(e.relatedTarget).data('id');
        //     $.ajax({
        //         url: "modal_job_list.php",
        //         method: "POST",
        //         asynch: false,
        //         data: {
        //             id: id,
        //         },
        //         success: function(data) {
        //             $('.modal-data').html(data);
        //         }
        //     });
        // });
    });
</script>
<script>
    function add_job() {
        let checkboxes = document.querySelectorAll('input[name="chck"]:checked');
        var item = document.getElementById("item").value;
        let output = [];
        checkboxes.forEach((checkbox) => {
            output.push(checkbox.value);
        });
        var data = output.toString();
        if (data === "") {
            alert("Landtour belum di pilih !!");
        } else if (item === "") {
            alert("Nama staff belum di pilih !!");
        } else {
            $.ajax({
                url: "insert_job_list.php",
                method: "POST",
                asynch: false,
                data: {
                    staff_id: item,
                    lt_id: data
                },
                success: function(data) {
                    alert(data);
                    LT_Package(3, 0, 0);
                }
            });
        }

    }
</script>