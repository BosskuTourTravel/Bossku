<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
include "../db=connection.php";

$query_data = "SELECT * FROM LT_itinerary2 WHERE id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);
$hari = $row_data['hari'];

?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">KODE : <?php echo $row_data['landtour'] ?></h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm tip" onclick="LT_itinerary(27,<?php echo $_POST['id'] ?>,0)" title="Back"><i class="fas fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(30,<?php echo $_POST['id'] ?>,0)" title="Refresh"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="card text-left" style="padding: 20px;">
                        <div class="list-tmpt-optional" id="list-tmpt-optional">
                            <form action="">
                                <?php
                                $statusOps = 0;
                                $query_ops = "SELECT * FROM LT_add_ops where master_id='" . $_POST['id'] . "' order by hari ASC, urutan ASC";
                                $rs_ops = mysqli_query($con, $query_ops);
                                $row_ops = mysqli_fetch_array($rs_ops);
                                // var_dump($row_ops['id']);
                                if ($row_ops['id'] != "") {
                                    $statusOps = 1;
                                }
                                for ($x = 1; $x <= $hari; $x++) {
                                    $queryTmp = "SELECT * FROM  LT_add_listTmp where tour_id='" . $_POST['id'] . "' && hari='$x' order by urutan ASC";
                                    $rsTmp = mysqli_query($con, $queryTmp);

                                ?>
                                    <div style="border: 2px solid; border-color:darkgreen; padding: 10px; margin-bottom: 5px;">
                                        <div style="text-align: center; font-weight: bold;">Day <?php echo $x ?></div>
                                        <?php
                                        $loop = 0;
                                        while ($rowTmp = mysqli_fetch_array($rsTmp)) {
                                            $query_ops2 = "SELECT highlight FROM LT_add_ops where master_id='" . $rowTmp['tour_id'] . "' && hari='" . $rowTmp['hari'] . "' && urutan='" . $rowTmp['urutan'] . "'";
                                            $rs_ops2 = mysqli_query($con, $query_ops2);
                                            $row_ops2 = mysqli_fetch_array($rs_ops2);
                                        ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label style="font-size: 11px">List Tempat </label>
                                                            </div>
                                                            <div class="col-md-3"></div>
                                                            <div class="col-md-3" style="text-align: right; font-size: 11px">
                                                                <div class="form-check">
                                                                    <?php
                                                                    if ($row_ops['id'] != "") {
                                                                        if ($row_ops2['highlight'] == '0') {
                                                                    ?>
                                                                            <input type="checkbox" class="form-check-input2" id="<?php echo $x ?>highlight<?php echo $rowTmp['urutan'] ?>" name="<?php echo $x ?>highlight<?php echo $rowTmp['urutan'] ?>" value="<?php echo $rowTmp['urutan'] ?>">
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <input type="checkbox" class="form-check-input2" id="<?php echo $x ?>highlight<?php echo $rowTmp['urutan'] ?>" name="<?php echo $x ?>highlight<?php echo $rowTmp['urutan'] ?>" value="<?php echo $rowTmp['urutan'] ?>" checked>
                                                                        <?php
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                        <input type="checkbox" class="form-check-input2" id="<?php echo $x ?>highlight<?php echo $rowTmp['urutan'] ?>" name="<?php echo $x ?>highlight<?php echo $rowTmp['urutan'] ?>" value="<?php echo $rowTmp['urutan'] ?>">
                                                                    <?php
                                                                    }

                                                                    ?>
                                                                    <label class="form-check-label"><b>Highlight</b></label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3" style="text-align: right; font-size: 11px">
                                                                <div class="form-check">
                                                                    <?php
                                                                    if ($row_ops['id'] != "") {
                                                                        // $query_ops2 = "SELECT * FROM LT_add_ops where master_id='" . $_POST['id'] . "' && hari ='$x' && urutan ='" . $rowTmp['urutan'] . "'";
                                                                        // $rs_ops2 = mysqli_query($con, $query_ops2);
                                                                        // $row_ops2 = mysqli_fetch_array($rs_ops2);
                                                                        if ($row_ops2['optional'] == "1") {
                                                                    ?>
                                                                            <input type="checkbox" class="form-check-input2" id="<?php echo $x ?>optional<?php echo $rowTmp['urutan'] ?>" name="<?php echo $x ?>optional<?php echo $rowTmp['urutan'] ?>" value="<?php echo $rowTmp['urutan'] ?>" checked>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <input type="checkbox" class="form-check-input2" id="<?php echo $x ?>optional<?php echo $rowTmp['urutan'] ?>" name="<?php echo $x ?>optional<?php echo $rowTmp['urutan'] ?>" value="<?php echo $rowTmp['urutan'] ?>">
                                                                        <?php
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                        <input type="checkbox" class="form-check-input2" id="<?php echo $x ?>optional<?php echo $rowTmp['urutan'] ?>" name="<?php echo $x ?>optional<?php echo $rowTmp['urutan'] ?>" value="<?php echo $rowTmp['urutan'] ?>">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                    <label class="form-check-label"><b>Optional</b></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $query_tempat3 = "SELECT * FROM List_tempat where id='" . $rowTmp['tempat'] . "'";
                                                        $rs_tempat3 = mysqli_query($con, $query_tempat3);
                                                        while ($row_tempat3 = mysqli_fetch_array($rs_tempat3)) {
                                                            $detail3 = $row_tempat3['negara'] . " " . $row_tempat3['city'] . " " . $row_tempat3['tempat'];
                                                        }
                                                        ?>
                                                        <input class="form-control form-control-sm" value="<?php echo $detail3 ?>" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                            $loop++;
                                        }
                                        ?>
                                        <input type="hidden" id="<?php echo $x ?>loop" name="<?php echo $x ?>loop" value="<?php echo  $loop ?>">
                                    </div>
                                <?php
                                }
                                ?>
                                <input type="hidden" id="hari" name="hari" value="<?php echo  $hari ?>">
                                <?php
                                if ($statusOps == '1') {
                                ?>
                                    <div class="ops-button-update" id="tmp-button-update">
                                        <button type="button" class="btn btn-success" id='but_optional4' onclick="fungsi_ops(<?php echo $row_data['id'] ?>)">UPDATE</button>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="ops-button-add" id="tmp-button-add">
                                        <button type="button" class="btn btn-warning" id='but_optional3' onclick="fungsi_ops(<?php echo $row_data['id'] ?>)">ADD</button>
                                    </div>
                                    <div class="ops-button-update" id="tmp-button-update" style="display: none;">
                                        <button type="button" class="btn btn-success" id='but_optional4' onclick="fungsi_ops(<?php echo $row_data['id'] ?>)">UPDATE</button>
                                    </div>
                                <?php
                                }
                                ?>
                            </form>

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
            "iDisplayLength": 5
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".tip").tooltip({
            placement: 'top'
        });
    });
</script>
<script>
    function fungsi_ops(x) {

        let formData = new FormData();
        var hari = $("input[name=hari]").val();
        var arr_val = [];
        for (let i = 1; i <= hari; i++) {
            var loop = $("input[name=" + i + "loop]").val();
            arr_loop = [];
            arr_hl = [];
            for (var y = 1; y <= loop; y++) {
                if ($("#" + i + "optional" + y).is(":checked")) {
                    arr_loop.push(1);

                } else {
                    arr_loop.push(0);

                }
                if ($("#" + i + "highlight" + y).is(":checked")) {
                    arr_hl.push(1);
                } else {
                    arr_hl.push(0);
                }
            }
            formData.append("optional[]", arr_loop);
            formData.append("highlight[]", arr_hl);
        }
        formData.append('id', x);
        formData.append('hari', hari);
        $.ajax({
            type: 'POST',
            url: "insert_add_LTops.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                $('.ops-button-update').show();
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });

    }
</script>