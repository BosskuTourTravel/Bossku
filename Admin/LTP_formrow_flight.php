<?php
include "../db=connection.php";
if ($_POST['x'] != "") {
    $query_gf = "SELECT * FROM LTP_grub_flight_value where grub_id='" . $_POST['x'] . "' order by id ASC";
    $rs_gf = mysqli_query($con, $query_gf);
    $x = 1;
    while ($row_gf = mysqli_fetch_array($rs_gf)) {
        $query_detail = "SELECT * FROM  LTP_route_detail where id='" . $row_gf['flight_id'] . "'";
        $rs_detail = mysqli_query($con, $query_detail);
        $row_detail = mysqli_fetch_array($rs_detail);

        $detail = $row_detail['dept'] . " - " . $row_detail['arr'] . " (" . $row_detail['take'] . " - " . $row_detail['landing'] . ")";
?>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <?php if ($x == '1') {
                        echo "<label>Maskapai</label>";
                    } ?>
                    <input type="text" class="form-control form-control-sm" id="maskapai" value="<?php echo $row_detail['maskapai'] ?>" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <?php if ($x == '1') {
                        echo "<label>Detail</label>";
                    } ?>
                    <input type="text" class="form-control form-control-sm" id="edetail" value="<?php echo $detail ?>" disabled>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?php if ($x == '1') {
                        echo "<label>Hari</label>";
                    } ?>
                    <input type="text" class="form-control form-control-sm" id="f_hari<?php echo $x ?>" name="f_hari<?php echo $x ?>">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?php if ($x == '1') {
                        echo "<label>Urutan</label>";
                    } ?>
                    <input type="text" class="form-control form-control-sm" id="f_urutan<?php echo $x ?>" name="f_urutan<?php echo $x ?>">
                </div>
            </div>
        </div>
        <input type="hidden" id="id_fl<?php echo $x ?>" name="id_fl<?php echo $x ?>" value="<?php echo $row_detail['id'] ?>">
    <?php
        $x++;
    }
    ?>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6" style="text-align: right;">
            <input type="hidden" id="loop" name="loop" value="<?php echo $x ?>">
            <div style="padding-right: 5px;"><button type="button" onclick="fungsi_add_flight3(<?php echo $_POST['x'] ?>,<?php echo $_POST['y'] ?>,<?php echo $_POST['z'] ?>)" class="btn btn-primary btn-sm">Add To Itinerary</button></div>
        </div>
    </div>
<?php
}
