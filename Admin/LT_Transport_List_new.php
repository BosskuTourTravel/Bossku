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
                    <h3 class="card-title" style="font-weight:bold;">Landtour Transport List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm" onclick="LT_itinerary(3,0,0)"><i class="fa fa-arrow-left"></i></a>
                                <!-- <a class="btn btn-primary btn-sm" onclick="LT_itinerary(4,<?php echo $_POST['id'] ?>,0)"><i class="fa fa-plus"></i></a> -->
                                <a class="btn btn-warning btn-sm" onclick="LT_itinerary(24,<?php echo $_POST['id'] ?>,0)"><i class="fa fa-plus"></i></a>
                                <!-- <a class="btn btn-danger btn-sm" onclick="LT_itinerary(21,<?php echo $_POST['id'] ?>,0)"><i class="fa fa-calendar"></i></a> -->
                                <a class="btn btn-info btn-sm" onclick="LT_itinerary(22,<?php echo $_POST['id'] ?>,<?php echo $_POST['master_id'] ?>)"><i class="fa fa-plane-departure"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    include "../site.php";
                    include "../db=connection.php";
                    $query = "SELECT * FROM  LT_add_transport where master_id='" . $_POST['master_id'] . "' && copy_id='" . $_POST['id'] . "' order by hari ASC, urutan ASC";
                    $rs = mysqli_query($con, $query);
                    $no = 1
                    ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tour</th>
                                <th>hari ke</th>
                                <th>Urutan</th>
                                <th>Type </th>
                                <th>Detail</th>
                                <th>Adult</th>
                                <th>Child</th>
                                <th>Infant</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             $x_gf = 1;
                            while ($row = mysqli_fetch_array($rs)) {

                                $queryStaff = "SELECT * FROM  login_staff WHERE id=" . $row['ket'];
                                $rsStaff = mysqli_query($con, $queryStaff);
                                $rowStaff = mysqli_fetch_array($rsStaff);

                                $querytour = "SELECT * FROM LTSUB_itin WHERE id=" . $row['copy_id'];
                                $rstour = mysqli_query($con, $querytour);
                                $rowtour = mysqli_fetch_array($rstour);


                                $type = "";
                                $detail = "";
                                $adt = '';
                                $chd = '';
                                $inf = '';
                                if ($row['type'] == '1') {
                                    $type = "Flight";

                                    // $queryflight = "SELECT * FROM flight_LTnew WHERE id=" . $row['transport'];
                                    // $rsflight = mysqli_query($con, $queryflight);
                                    // $rowflight = mysqli_fetch_array($rsflight);

                                    $queryflight = "SELECT * FROM  LTP_route_detail where id='" . $row['transport'] . "'";
                                    $rsflight = mysqli_query($con, $queryflight);
                                    $rowflight = mysqli_fetch_array($rsflight);

                                    $query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $row['grub_id'] . "' && flight_id='".$row['transport']."'";
                                    $rs_gf = mysqli_query($con, $query_gf);
                                    $row_gf = mysqli_fetch_array($rs_gf);

                                    $query_typ2 = "SELECT * FROM LTP_type_flight where id='" . $rowflight['type'] . "'";
                                    $rs_typ2 = mysqli_query($con, $query_typ2);
                                    $row_typ2 = mysqli_fetch_array($rs_typ2);
                
                                    $query_rt = "SELECT * FROM  LT_add_roundtrip where route_id='" .  $rowflight['route_id'] . "'";
                                    $rs_rt = mysqli_query($con, $query_rt);
                                    $row_rt = mysqli_fetch_array($rs_rt);

                
                                    if ($row_gf['status'] == '1') {
                                        if($x_gf =='1'){
                                            $type = "Roundtrip Auto";
                                            $adt_rt = $row_rt['adt'];
                                            $chd_rt = $row_rt['chd'];
                                            $inf_rt = $row_rt['inf'];
                                           
                                        }else{
                                            $type = "Roundtrip Auto";
                                            $adt_rt = 0;
                                            $chd_rt = 0;
                                            $inf_rt = 0;
                                        }
                                        $x_gf++;
                
                                    } else {
                                        $type = $row_typ2['nama'];
                                        $adt_rt = $rowflight['adt'];
                                        $chd_rt = $rowflight['chd'];
                                        $inf_rt = $rowflight['inf'];
                                    }

                                    $detail = $rowflight['maskapai']." ".$rowflight['dept'] . " - " . $rowflight['arr'] . " (" . $rowflight['take'] . " - " . $rowflight['landing'] . ") ".$rowflight['rute'];



                                    // set profit flight
                                    $sql_profit = "SELECT * FROM LT_profit_range where price1 <='" . $adt_rt . "' && price2 >='" . $adt_rt. "'";
                                    $rs_profit = mysqli_query($con, $sql_profit);
                                    $row_profit = mysqli_fetch_array($rs_profit);

                                    $pr = 0;
                                    if ($row_profit['id'] != "") {
                                        $pr = $row_profit['profit'];
                                    } else {
                                        $pr = 5;
                                    }
                                    $dm = $rowflight['adt'] * ($row_profit['adm_mkp'] / 100);
                                    $mar = $rowflight['adt'] * ($row_profit['marketing'] / 100);
                                    $agn = $rowflight['adt'] * ($row_profit['sub_agent'] / 100);
                                    $ste = $row_profit['staff_eks'];
                                    $nom = $row_profit['nominal'];
                                    $lain2 = $adm + $mar + $agn + $ste + $nom;

                                    $adt_price = intval($adt_rt) * ($pr / 100);
                                    $chd_price = intval($chd_rt) * ($pr / 100);
                                    $inf_price = intval($inf_rt) * ($pr / 100);

                                    $adt = $adt + intval($adt_rt) +  $adt_price + $nom;
                                    $chd = $chd + intval($chd_rt) + $chd_price + $nom;
                                    $inf = $inf + intval($inf_rt) + $inf_price + $nom;
                                } else if ($row['type'] == '2') {
                                    $type = "Ferry";
                                    $query_ferry = "SELECT * FROM ferry_LT  where id=" . $row['transport'];
                                    $rs_ferry = mysqli_query($con, $query_ferry);
                                    $row_ferry = mysqli_fetch_array($rs_ferry);
                                    $detail = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ") " . $row_ferry['type'];
                                    $adt = $row_ferry['adult'];
                                    $chd = $row_ferry['child'];
                                    $inf = $row_ferry['infant'];
                                } else if ($row['type'] == '4') {
                                    $type = "Train";


                                    $query_train = "SELECT * FROM train_LTnew where id=" . $row['transport'];
                                    $rs_train = mysqli_query($con, $query_train);
                                    $row_train = mysqli_fetch_array($rs_train);

                                    $detail = $row_train['nama'] . " (" . $row_train['tgl'] . ")";
                                    $adt = $row_train['adt'];
                                    $chd = $row_train['chd'];
                                    $inf = $row_train['inf'];
                                }
                                // var_dump($data);
                            ?>
                                <tr>
                                    <td><?php echo  $row['id'] ?></td>
                                    <td><?php echo $rowtour['judul'] ?></td>
                                    <td><?php echo $row['hari'] ?></td>
                                    <td><?php echo $row['urutan'] ?></td>
                                    <td><?php echo $type ?></td>
                                    <td><?php echo $detail ?></td>
                                    <td><?php echo number_format($adt, 0, ",", ".")?></td>
                                    <td><?php echo number_format($chd, 0, ",", ".") ?></td>
                                    <td><?php echo number_format($inf, 0, ",", ".")  ?></td>
                                    <td style="min-width: 100px;">

                                        <a class="btn btn-danger btn-sm" onclick="delete_trans(<?php echo $row['id'] ?>,<?php echo $_POST['id'] ?>,<?php echo $_POST['master_id'] ?>)"><i class="fa fa-trash"></i></a>
                                        <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></a>
                                        <div class="modal fade" id="exampleModal<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">EDIT FLIGHT</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="hari">HARI </label>
                                                                    <input type="text" class="form-control" id="hari" name="hari" value="<?php echo $row['hari'] ?>">
                                                                </div>
                                                                <div class="col">
                                                                    <label for="rutet">URUTAN</label>
                                                                    <input type="text" class="form-control" id="urutan" name="urutan" value="<?php echo $row['urutan'] ?>">
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-success btn-sm submit" data-id="<?php echo $row['id'] ?>" data-master="<?php echo $_POST['master_id'] ?>" data-copy="<?php echo $_POST['id'] ?>" data-dismiss="modal">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
<script>
    function delete_trans(x, y, z) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "LT_delete_transport.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x,
                },
                success: function(data) {
                    if (data == "success") {
                        LT_itinerary(25, y, z);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
    $(document).ready(function() {

        $('.submit').on('click', e => {
            // alert("on");
            const $button = $(e.target);
            const $modalBody = $button.closest('.modal-footer').prev('.modal-body');
            const id = $button.data('id');
            const master = $button.data('master');
            const copy = $button.data('copy');
            const hari = $modalBody.find($("input[name=hari]")).val();
            const urutan = $modalBody.find($("input[name=urutan]")).val();

            let formData = new FormData();
            formData.append('id', '3');
            formData.append('master_id', master);
            formData.append('copy_id', copy);
            formData.append('hari', hari);
            formData.append('urutan', urutan);
            formData.append('flight_id', id);
            // work with the values here:
            $.ajax({
                type: 'POST',
                url: "insert_add_LTtransport.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert(msg);
                    LT_itinerary(25, copy, master);
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
            //  console.log(id, hari, rute);

        });
    });
</script>