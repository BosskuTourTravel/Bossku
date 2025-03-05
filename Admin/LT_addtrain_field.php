<?php
include "../db=connection.php";
$loop = $_POST['loop'];
// var_dump($loop);

for ($i = 1; $i <= $loop; $i++) {
?>
    <div class="form-row" style="padding-bottom: 10px;">
    <div class="col-md-2">
            <?php if ($i == '1') {
            ?>
                <label for="">Tanggal Berangkat</label>
            <?php
            } ?>
            <input type="date" class="form-control form-control-sm" name="t_tgl<?php echo $i ?>" id="t_tgl<?php echo $i ?>" onclick="">
        </div>
        <div class="col-md-2">
            <?php if ($i == '1') {
            ?>
                <label for="">Train Name</label>
            <?php
            } ?>
            <input class="form-control form-control-sm" name="t_name<?php echo $i ?>" id="t_name<?php echo $i ?>" onclick="">
        </div>
        <div class="col-md-2">
            <?php if ($i == '1') {
            ?>
                <label>Adult</label>
            <?php
            } ?>
            <input class="form-control form-control-sm" name="t_adt<?php echo $i ?>" id="t_adt<?php echo $i ?>" onclick="">
        </div>
        <div class="col-md-2">
            <?php if ($i == '1') {
            ?>
                <label>Child</label>
            <?php
            } ?>
            <input class="form-control form-control-sm" name="t_chd<?php echo $i ?>" id="t_chd<?php echo $i ?>" onclick="">
        </div>
        <div class="col-md-2">
            <?php if ($i == '1') {
            ?>
                <label>Infant</label>
            <?php
            } ?>
            <input class="form-control form-control-sm" name="t_inf<?php echo $i ?>" id="t_inf<?php echo $i ?>" onclick="">
        </div>
        <div class="col-md-1">
            <?php if ($i == '1') {
            ?>
                <label for="">Hari</label>
            <?php
            } ?>

            <input type="text" class="form-control  form-control-sm" id="t_hari<?php echo $i ?>" name="t_hari<?php echo $i ?>">
        </div>
        <div class="col-md-1">
            <?php if ($i == '1') {
            ?>
                <label for="">Urutan</label>
            <?php
            } ?>
            <input type="text" class="form-control  form-control-sm" id="t_urutan<?php echo $i ?>" name="t_urutan<?php echo $i ?>">
        </div>
    </div>
<?php } ?>