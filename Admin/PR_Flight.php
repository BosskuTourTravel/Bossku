<?php
session_start();
?>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<div class="content-wrapper" style="width: max-content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h3 class="card-title" style="font-weight:bold;">Flight Package List</h3> -->
                    <!-- <div class="card-tools"> -->
                    <div class="input-group input-group-sm">
                        <div class="input-group-append" style="text-align: left;">
                            <!-- <div style="padding-right: 5px;"> <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i></a></div>
                            <div style="padding-right: 5px;"> <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal2">ALL</a></div> -->
                            <h3 class="card-title" style="font-weight:bold;">Flight Profit List</h3>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">ADD PROFIT </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="row">
                                            <div class="col">
                                                <label for="hari">PROFIT (%)</label>
                                                <input type="text" class="form-control" id="profit" name="profit" placeholder="0">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success btn-sm submit" data-dismiss="modal">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">ADD PROFIT ALL</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="row">
                                            <div class="col">
                                                <label for="hari">PROFIT (%)</label>
                                                <input type="text" class="form-control" id="profit" name="profit" placeholder="0">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-success btn-sm submit2" data-dismiss="modal">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    include "../site.php";
                    include "../db=connection.php";
                    $query = "SELECT * FROM  flight_LTnew order by id ASC ";
                    $rs = mysqli_query($con, $query);
                    $no = 1
                    ?>
                    <table id="example" class="table table-striped table-bordered table-sm" style="width:max-content; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th style="max-width: 100px;">Type</th>
                                <th style="max-width: 150px;">Tour Code</th>
                                <th style="max-width: 200px;">Rute</th>
                                <th>INT/DOM</th>
                                <th>Maskapai</th>
                                <th>Dept-Arr</th>
                                <th>Tgl</th>
                                <th style="max-width: 100px;">Jam</th>
                                <th>Adult</th>
                                <th>Child</th>
                                <th>Infant</th>                               
                                <th style="background-color: greenyellow;">Profit</th>
                                <th>+Lain2</th>
                                <th>Adt Sell</th>
                                <th>Chd Sell</th>
                                <th>Inf Sell</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($rs)) {
                                // var_dump($data);
                            ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="chck" name="chck" value="<?php echo  $row['id'] ?>">
                                            <label class="form-check-label" for="chck"><?php echo  $row['id'] ?></label>
                                        </div>

                                    </td>
                                    <td><?php echo  $row['type'] ?></td>
                                    <td><?php echo  $row['tour_code'] ?></td>
                                    <td><?php
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
                                    <td><?php echo number_format($row['adt'], 0, ",", ".")  ?></td>
                                    <td><?php echo number_format($row['chd'], 0, ",", ".")  ?></td>
                                    <td><?php echo number_format($row['inf'], 0, ",", ".")  ?></td>
                                    <td style="background-color: greenyellow;">
                                        <?php
                                        $sql_profit = "SELECT * FROM LT_profit_range where price1 <='" . $row['adt'] . "' && price2 >='" . $row['adt'] . "'";
                                        $rs_profit = mysqli_query($con, $sql_profit);
                                        $row_profit = mysqli_fetch_array($rs_profit);
                                        // var_dump($sql_profit);

                                        $pr = 0;
                                        if ($row_profit['id'] != "") {
                                            $pr = $row_profit['profit'];
                                            echo $row_profit['profit'] . "%";
                                        } else {
                                            $pr = 5;
                                            echo "5 %";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $dm = $row['adt'] * ($row_profit['adm_mkp'] / 100);
                                        $mar = $row['adt'] * ($row_profit['marketing'] / 100);
                                        $agn = $row['adt'] * ($row_profit['sub_agent'] / 100);
                                        $ste = $row_profit['staff_eks'];
                                        $nom = $row_profit['nominal'];
                                        $lain2 = $adm + $mar + $agn + $ste + $nom;
                                        echo number_format($nom, 0, ",", ".");
                                        ?>
                                    </td>
                                    
                                    <td>
                                    <?php
                                    $adt = ($row['adt'] * $pr / 100) + $row['adt'] + $nom;
                                    echo number_format($adt, 0, ",", ".");
                                    ?>
                                    </td>
                                    <td>
                                        <?php
                                        $chd = ($row['chd'] * $pr / 100) + $row['chd'];
                                        echo number_format($chd, 0, ",", ".");
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $inf = ($row['inf'] * $pr / 100) + $row['inf'];
                                        echo number_format($inf, 0, ",", ".");
                                        ?>
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
            "iDisplayLength": 25
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
        PR_Package(1, data, 0);
    }
</script>
<script>
    $(document).ready(function() {

        $('.submit').on('click', e => {
            // alert("on");
            const $button = $(e.target);
            const $modalBody = $button.closest('.modal-footer').prev('.modal-body');
            const profit = $modalBody.find($("input[name=profit]")).val();
            let formData = new FormData();
            let checkboxes = document.querySelectorAll('input[name="chck"]:checked');
            checkboxes.forEach((checkbox) => {
                // output.push(checkbox.value);
                formData.append('data[]', checkbox.value);
            });
            formData.append('profit', profit);
            formData.append('status', '1');
            // work with the values here:
            $.ajax({
                type: 'POST',
                url: "insert_PR_Flight.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert(msg);
                    PR_Package(0, 0, 0);
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });

        });
        $('.submit2').on('click', e => {
            // alert("on");
            const $button = $(e.target);
            const $modalBody = $button.closest('.modal-footer').prev('.modal-body');
            const profit = $modalBody.find($("input[name=profit]")).val();
            let formData = new FormData();
            let checkboxes = document.querySelectorAll('input[name="chck"]:checked');
            checkboxes.forEach((checkbox) => {
                // output.push(checkbox.value);
                formData.append('data[]', checkbox.value);
            });
            formData.append('profit', profit);
            formData.append('status', '2');
            // work with the values here:
            $.ajax({
                type: 'POST',
                url: "insert_PR_Flight.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert(msg);
                    PR_Package(0, 0, 0);
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });

        });
    });
</script>