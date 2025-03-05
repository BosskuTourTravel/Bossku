<?php
include "../db=connection.php";
$loop = $_POST['loop'];
for ($f = 1; $f <= $loop; $f++) {
?>
    <div class="form-row">
        <div class="form-group col-md-1">
            <?php if ($f == '1') {
            ?>
                <label for="">Hari</label>
            <?php
            } ?>
            <input type="text" class="form-control form-control-sm" id="fer_hari< ?php echo $f ?>" name="fer_hari<?php echo $f ?>" />
        </div>
        <div class="form-group col-md-1">
            <?php if ($f == '1') {
            ?>
                <label for="">Urutan</label>
            <?php
            } ?>
            <input type="text" class="form-control form-control-sm" id="fer_urutan<?php echo $f ?>" name="fer_urutan<?php echo $f ?>" />
        </div>
        <div class="form-group col-md-2">
            <?php if ($f == '1') {
            ?>
                <label for="">Ferry Type</label>
            <?php
            } ?>
            <select class="form-control form-control-sm" name="fer_type<?php echo $f ?>" id="fer_type<?php echo $f ?>" onchange="ferry_type(<?php echo $f ?>)">
                <option value="" selected>Pilih</option>
                <option value="ONE WAY">ONE WAY</option>
                <option value="ROUND TRIP">ROUND TRIP</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <?php if ($f == '1') {
            ?>
                <label for="">Ferry Rute</label>
            <?php
            } ?>
            <select class="form-control form-control-sm" id="fer_rute<?php echo $f ?>" name="fer_rute<?php echo $f ?>" onchange="ferry_rute(<?php echo $f ?>)">
                <option value="">Rute Name</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <?php if ($f == '1') {
            ?>
                <label for="">Ferry Name</label>
            <?php
            } ?>
            <select class="form-control form-control-sm" id="fer_name<?php echo $f ?>" name="fer_name<?php echo $f ?>">
                <option value="">Ferry Name</option>
            </select>
        </div>
    </div>
<?php
}
?>