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
                                <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(28,<?php echo $_POST['id'] ?>,0)" title="Refresh"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="card text-left" style="padding: 20px;">
                        <div class="meal" id="meal">
                            <form>
                                <?php
                                $statusMeal = 0;

                                for ($x = 1; $x <= $hari; $x++) {
                                    $queryMeal = "SELECT * FROM  LT_add_meal where tour_id='" . $_POST['id'] . "' && hari='$x'";
                                    $rsMeal = mysqli_query($con, $queryMeal);
                                    $rowMeal = mysqli_fetch_array($rsMeal);
                                    // var_dump($rowMeal['bf'] . " " . $rowMeal['ln'] . " " . $rowMeal['dn']);

                                    $query_up = "SELECT * FROM Guest_meal2 where id=" . $rowMeal['bf'];
                                    $rs_up = mysqli_query($con, $query_up);
                                    $row_up = mysqli_fetch_array($rs_up);

                                    $query_upln = "SELECT * FROM Guest_meal2 where id=" . $rowMeal['ln'];
                                    $rs_upln = mysqli_query($con, $query_upln);
                                    $row_upln = mysqli_fetch_array($rs_upln);

                                    $query_updn = "SELECT * FROM Guest_meal2 where id=" . $rowMeal['dn'];
                                    $rs_updn = mysqli_query($con, $query_updn);
                                    $row_updn = mysqli_fetch_array($rs_updn);

                                    if ($rowMeal['id'] != "") {
                                        $statusMeal = 1;
                                    }
                                ?>
                                    <div style="border: 2px solid; border-color:darkorange; padding: 10px; margin-bottom: 5px;">
                                        <div style="text-align: center; font-weight: bold;">Day <?php echo $x ?></div>
                                        <div style="padding-left: 50px; padding-bottom: 5px;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label style="font-size: 11px;">BREAKFAST</label>
                                                    <input class="form-control form-control-sm" list="bf_list<?php echo $x ?>" name="bf<?php echo $x ?>" id="bf<?php echo $x ?>" value="<?php echo $row_up['negara'] ?>" autocomplete="off">
                                                    <datalist id="bf_list<?php echo $x ?>">
                                                        <?php
                                                        $query_mealb = "SELECT * FROM Guest_meal2 WHERE meal_type='BREAKFAST' Order by negara ASC";
                                                        $rs_mealb = mysqli_query($con, $query_mealb);
                                                        while ($row_mealb = mysqli_fetch_array($rs_mealb)) {
                                                        ?>
                                                            <option data-customvalue="<?php echo $row_mealb['id'] ?>" value="<?php echo $row_mealb['negara'] ?>"></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </datalist>
                                                </div>
                                                <div class="col-md-4">
                                                    <label style="font-size: 11px;">LUNCH</label>
                                                    <input class="form-control form-control-sm" list="ln_list<?php echo $x ?>" name="ln<?php echo $x ?>" id="ln<?php echo $x ?>" value="<?php echo $row_upln['negara'] ?>" autocomplete="off">
                                                    <datalist id="ln_list<?php echo $x ?>">
                                                        <?php
                                                        $query_meall = "SELECT * FROM Guest_meal2  WHERE meal_type='LUNCH' Order by negara ASC";
                                                        $rs_meall = mysqli_query($con, $query_meall);
                                                        while ($row_meall = mysqli_fetch_array($rs_meall)) {
                                                        ?>
                                                            <option data-customvalue="<?php echo $row_meall['id'] ?>" value="<?php echo $row_meall['negara'] ?>"></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </datalist>
                                                </div>
                                                <div class="col-md-4">
                                                    <label style="font-size: 11px;">DINNER</label>
                                                    <input class="form-control form-control-sm" list="dn_list<?php echo $x ?>" name="dn<?php echo $x ?>" id="dn<?php echo $x ?>" value="<?php echo $row_updn['negara'] ?>" autocomplete="off">
                                                    <datalist id="dn_list<?php echo $x ?>">
                                                        <?php
                                                        $query_meal2 = "SELECT * FROM Guest_meal2  WHERE meal_type='DINNER' Order by negara ASC";
                                                        $rs_meald = mysqli_query($con, $query_meal2);
                                                        while ($row_meald = mysqli_fetch_array($rs_meald)) {
                                                        ?>
                                                            <option data-customvalue="<?php echo $row_meald['id'] ?>" value="<?php echo $row_meald['negara'] ?>"></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </datalist>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <input type="hidden" id="hari" name="hari" value="<?php echo  $hari ?>">
                                <?php
                                if ($statusMeal == '1') {
                                ?>
                                    <div class="tmp-button-update" id="tmp-button-update">
                                        <button type="button" class="btn btn-success" onclick="fungsi_update_meal(<?php echo $row_data['id'] ?>)">UPDATE</button>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="meal-button-add" id="meal-button-add">
                                        <button type="button" class="btn btn-warning" onclick="fungsi_add_meal(<?php echo $row_data['id'] ?>)">ADD</button>
                                    </div>
                                    <div class="meal-button-update" id="meal-button-update" style="display: none;">
                                        <button type="button" class="btn btn-success" onclick="fungsi_update_meal(<?php echo $row_data['id'] ?>)">UPDATE</button>
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
    function fungsi_add_meal(x) {
        var hari = $("input[name=hari]").val();
        let formData = new FormData();
        for (let i = 1; i <= hari; i++) {
            var bf = $('#bf' + i).val();
            var v_bf = $('#bf_list' + i + ' [value="' + bf + '"]').data('customvalue');
            var ln = $('#ln' + i).val();
            var v_ln = $('#ln_list' + i + ' [value="' + ln + '"]').data('customvalue');
            var dn = $('#dn' + i).val();
            var v_dn = $('#dn_list' + i + ' [value="' + dn + '"]').data('customvalue');

            formData.append("bf[]", v_bf);
            formData.append("ln[]", v_ln);
            formData.append("dn[]", v_dn);
        }

        formData.append('id', x);
        formData.append('hari', hari);
        $.ajax({
            type: 'POST',
            url: "insert_add_LTmeal.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                // LT_itinerary(0, 0, 0);
                $('.meal-button-update').show();
                $('.meal-button-add').hide();
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });

    }

    function fungsi_update_meal(x) {
        var hari = $("input[name=hari]").val();
        let formData = new FormData();
        for (let i = 1; i <= hari; i++) {
            var bf = $('#bf' + i).val();
            var v_bf = $('#bf_list' + i + ' [value="' + bf + '"]').data('customvalue');
            var ln = $('#ln' + i).val();
            var v_ln = $('#ln_list' + i + ' [value="' + ln + '"]').data('customvalue');
            var dn = $('#dn' + i).val();
            var v_dn = $('#dn_list' + i + ' [value="' + dn + '"]').data('customvalue');

            formData.append("bf[]", v_bf);
            formData.append("ln[]", v_ln);
            formData.append("dn[]", v_dn);
        }

        formData.append('id', x);
        formData.append('hari', hari);
        $.ajax({
            type: 'POST',
            url: "update_add_LTmeal.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                // LT_itinerary(0, 0, 0);
                $('.meal-button-update').show();
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }
</script>