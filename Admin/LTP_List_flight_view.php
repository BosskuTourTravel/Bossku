<?php
session_start();
?>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<div class="content-wrapper" style="width: 150%;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h3 class="card-title" style="font-weight:bold;">Flight Package List</h3> -->
                    <!-- <div class="card-tools"> -->
                    <div class="input-group input-group-sm">
                        <div class="input-group-append" style="text-align: left;">
                            <!-- <div style="padding-right: 5px;"><a class="btn btn-success btn-sm" href="export_list_tempat.php" target="_BLANK"><i class="fa fa-file-excel"></i></a></div> -->
                            <div style="padding-right: 5px;"> <button type="submit" onclick="LT_Package(5,0,0)" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></div>
                            <div style="padding-right: 5px;"> <button type="submit" onclick="form_edit()" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button></div>
                            <div style="padding-right: 5px;"> <button type="submit" onclick="form_copy()" class="btn btn-info btn-sm"><i class="fa fa-copy"></i></button></div>
                            <div style="padding-right: 5px;"> <button type="submit" onclick="form_del()" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></div>
                            <h3 class="card-title" style="font-weight:bold;">Flight View Package List</h3>
                        </div>
                    </div>

                    <!-- </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    include "../site.php";
                    include "../db=connection.php";
                    $query_dub = "SELECT DISTINCT tour_code FROM flight_LTnew";
                    $rs_dub = mysqli_query($con, $query_dub);

                    ?>
                    <table id="example" class="table table-hover table-sm" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th style="max-width: 50px;">NO</th>
                                <th style="max-width: 50px;">ID</th>
                                <th style="max-width: 100px;">Type</th>
                                <th style="max-width: 150px;">Tour Code</th>
                                <th>Rute</th>
                                <th>INT/DOM</th>
                                <th>Maskapai</th>
                                <th>Dept-Arr</th>
                                <th>Tgl</th>
                                <th style="max-width: 100px;">Jam</th>
                                <th>Adult</th>
                                <th>Child</th>
                                <th>Infant</th>
                                <th>Bagasi</th>
                                <th>Seat Price</th>
                                <th>BF</th>
                                <th>LN</th>
                                <th>DN</th>
                                <th>TAX</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row_dub = mysqli_fetch_array($rs_dub)) {
                                $query = "SELECT * FROM  flight_LTnew where tour_code = '" . $row_dub['tour_code'] . "' order by id ASC limit 1";
                                $rs = mysqli_query($con, $query);
                                // $row = mysqli_fetch_array($rs);
                                while ($row = mysqli_fetch_array($rs)) {
                                    // var_dump($data);
                            ?>
                                    <tr>
                                        <td style="max-width: 50px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input view" id="chck_view<?php echo  $row['id'] ?>" name="chck_view<?php echo  $row['id'] ?>"  value="<?php echo  $row['id'] ?>">
                                                <label class="form-check-label" for="chck_view<?php echo  $row['id'] ?>"><?php echo  $no ?></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input tmp" type="checkbox" id="chck" name="chck" value="<?php echo  $row['id'] ?>">
                                                <label class="form-check-label" for="inlineCheckbox1"><?php echo  $row['id'] ?></label>
                                            </div>
                                        </td>
                                        <td><?php echo  $row['type'] ?></td>
                                        <td style="max-width: 100px;"><?php echo  $row['tour_code'] ?></td>
                                        <td style="max-width: 150px;"><?php
                                                                        $sql_rute = "SELECT * From LT_Flight_Tag where tag='" . $row['rute'] . "'";
                                                                        $rs_rute = mysqli_query($con, $sql_rute);
                                                                        $row_rute = mysqli_fetch_array($rs_rute);
                                                                        // var_dump($sql_rute);
                                                                        if ($row_rute == "") {
                                                                            echo $row['rute'];
                                                                        } else {
                                                                            echo $row_rute['ket'];
                                                                        }
                                                                        ?></td>
                                        <td><?php echo  $row['inter'] ?></td>
                                        <td><?php echo  $row['maskapai'] ?></td>
                                        <td><?php echo  $row['dept'] . " - " . $row['arr'] ?></td>
                                        <td><?php echo  $row['tgl'] ?></td>
                                        <td><?php echo  $row['take'] . " - " . $row['landing'] ?></td>
                                        <td><?php echo  $row['adt'] ?></td>
                                        <td><?php echo  $row['chd'] ?></td>
                                        <td><?php echo  $row['inf'] ?></td>
                                        <td><?php
                                            if ($row['bagasi'] != '0') {
                                                echo $row['bagasi'] . " Kg : " . $row['bagasi_price'];
                                            }
                                            ?></td>
                                        <td><?php echo $row['seat_price'] ?></td>
                                        <td><?php echo $row['bf'] ?></td>
                                        <td><?php echo $row['ln'] ?></td>
                                        <td><?php echo $row['dn'] ?></td>
                                        <td><?php echo $row['tax'] ?></td>
                                    </tr>
                                    <!-- <tr class="detail<?php echo  $row['id'] ?>" style="display: none;">
                                            <td>hjhjhjhjhj asjasa</td>
                                    </tr> -->
                                    <!-- <div class="detail<?php echo  $row['id'] ?>" style="display: none;"> -->
                                    <?php
                                    $query_view = "SELECT * FROM  flight_LTnew where tour_code = '" . $row_dub['tour_code'] . "' && id !='" . $row['id'] . "'";
                                    $rs_view = mysqli_query($con, $query_view);
                                    while ($row_view = mysqli_fetch_array($rs_view)) {
                                    ?>
                                        <tr class="detail<?php echo  $row['id'] ?>" style="display: none;">
                                            <td style="max-width: 50px;"></td>
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input tmp" type="checkbox" id="chck" name="chck" value="<?php echo   $row_view['id'] ?>">
                                                    <label class="form-check-label"><?php echo  $row_view['id'] ?></label>
                                                </div>
                                            </td>
                                            <td><?php echo  $row_view['type'] ?></td>
                                            <td style="max-width: 100px;"><?php echo  $row_view['tour_code'] ?></td>
                                            <td style="max-width: 150px;"><?php
                                                                            $sql_rute = "SELECT * From LT_Flight_Tag where tag='" . $row_view['rute'] . "'";
                                                                            $rs_rute = mysqli_query($con, $sql_rute);
                                                                            $row_rute = mysqli_fetch_array($rs_rute);
                                                                            // var_dump($sql_rute);
                                                                            if ($row_rute == "") {
                                                                                echo $row['rute'];
                                                                            } else {
                                                                                echo $row_rute['ket'];
                                                                            }
                                                                            ?></td>
                                            <td><?php echo  $row_view['inter'] ?></td>
                                            <td><?php echo  $row_view['maskapai'] ?></td>
                                            <td><?php echo  $row_view['dept'] . " - " . $row_view['arr'] ?></td>
                                            <td><?php echo  $row_view['tgl'] ?></td>
                                            <td><?php echo  $row_view['take'] . " - " . $row_view['landing'] ?></td>
                                            <td><?php echo  $row_view['adt'] ?></td>
                                            <td><?php echo  $row_view['chd'] ?></td>
                                            <td><?php echo  $row_view['inf'] ?></td>
                                            <td><?php
                                                if ($row_view['bagasi'] != '0') {
                                                    echo $row_view['bagasi'] . " Kg : " . $row_view['bagasi_price'];
                                                }
                                                ?></td>
                                            <td><?php echo $row_view['seat_price'] ?></td>
                                            <td><?php echo $row_view['bf'] ?></td>
                                            <td><?php echo $row_view['ln'] ?></td>
                                            <td><?php echo $row_view['dn'] ?></td>
                                            <td><?php echo $row_view['tax'] ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                    <!-- </div> -->
                            <?php

                                }

                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
                <!-- /.card-body -->
                <!-- <div id='loadingmsg' style='display: none;'>
                    <div class="spinner-grow text-primary" role="status">>
                    </div>
                    <div class="spinner-grow text-primary" role="status">
                    </div>
                    <div class="spinner-grow text-primary" role="status">
                    </div>
                </div>
                <div id='loadingover' style='display: none;'></div> -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        new DataTable('#example');
        // $('#example').DataTable({
        //     "aLengthMenu": [
        //         [5, 10, 25, -1],
        //         [5, 10, 25, "All"]
        //     ],
        //     "iDisplayLength": 25
        // });
    });
</script>
<script>
    $(document).ready(function() {
        $('.view').click(function() {
            var x = $(this).val();
            if ($('#chck_view' + x).is(':checked')) {
                $('.detail' + x).show();
            } else {
                $('.detail' + x).hide();
            }

        });
    });
</script>
<script>
    function form_del(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            let formData = new FormData();
            let checkboxes = document.querySelectorAll('input[name="chck"]:checked');
            checkboxes.forEach((checkbox) => {
                // output.push(checkbox.value);
                formData.append('id[]', checkbox.value);
            });
            // var data = output.toString();

            $.ajax({
                type: 'POST',
                url: "del_ltp_flight.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert(msg);
                    LT_Package(4, 0, 0);
                },
                error: function() {
                    alert("Data Gagal Di Hapus");
                }
            });
        }
    }

    function form_edit() {
        let formData = new FormData();
        let checkboxes = document.querySelectorAll('input[name="chck"]:checked');
        let output = [];
        checkboxes.forEach((checkbox) => {
            output.push(checkbox.value);
        });
        var data = output.toString();
        LT_Package(6, data, 0);
    }
    

    function form_copy() {
        let formData = new FormData();
        let checkboxes = document.querySelectorAll('input[name="chck"]:checked');
        let output = [];
        checkboxes.forEach((checkbox) => {
            output.push(checkbox.value);
        });
        var data = output.toString();
        LT_Package(7, data, 0);
    }
</script>