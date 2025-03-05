<?php
include "../db=connection.php";
$loop = $_POST['loop'];
$code ="";
if($_POST['code'] !="undefined"){
    $code = $_POST['code'];
}

?>
<div style="text-align: center;"><b> <?php echo $_POST['code'] ?></b></div>
<?php
for ($i = 1; $i <= $loop; $i++) {
?>
    <div class="form-row" style="padding-bottom: 10px;">
        <div class="col-md-2">
            <?php if ($i == '1') {
            ?>
                <label for="">Tour Code</label>
            <?php
            } ?>
            <input class="form-control form-control-sm" list="f_kode_list<?php echo $i ?>" name="f_kode<?php echo $i ?>" id="f_kode<?php echo $i ?>" value="<?php echo $code ?>"  autocomplete="off" onchange="fungsi_kode(<?php echo $i ?>)">
            <datalist id="f_kode_list<?php echo $i ?>">
            <option data-customvalue="" value="No Landtour Code"></option>
                <?php
                $query_code = "SELECT DISTINCT tour_code FROM flight_LTnew order by tour_code ASC";
                $rs_code = mysqli_query($con, $query_code);

                while ($row_code = mysqli_fetch_array($rs_code)) {
                ?>
                    <option data-customvalue="<?php echo $row_code['tour_code'] ?>" value="<?php echo $row_code['tour_code'] ?> "></option>
                <?php
                }
                ?>
            </datalist>
        </div>
        <div class="col-md-2">
            <?php if ($i == '1') {
            ?>
                <label for="">TGL</label>
            <?php
            } ?>
            <input class="form-control form-control-sm" list="f_tgl_list<?php echo $i ?>" name="f_tgl<?php echo $i ?>" id="f_tgl<?php echo $i ?>"  autocomplete="off" onchange="fungsi_tgl(<?php echo $i ?>)">
            <datalist id="f_tgl_list<?php echo $i ?>">
            </datalist>
        </div>
        <div class="col-md-6">
            <?php if ($i == '1') {
            ?>
                <label for="">Flight Detail</label>
            <?php
            } ?>
            <input class="form-control form-control-sm" list="f_name_list<?php echo $i ?>" name="f_name<?php echo $i ?>" id="f_name<?php echo $i ?>" autocomplete="off">
            <datalist id="f_name_list<?php echo $i ?>">
            </datalist>
        </div>

        <div class="col-md-1">
            <?php if ($i == '1') {
            ?>
                <label for="">Hari</label>
            <?php
            } ?>

            <input type="text" class="form-control  form-control-sm" id="f_hari<?php echo $i ?>" name="f_hari<?php echo $i ?>"  autocomplete="off">
        </div>
        <div class="col-md-1">
            <?php if ($i == '1') {
            ?>
                <label for="">Urutan</label>
            <?php
            } ?>
            <input type="text" class="form-control  form-control-sm" id="f_urutan<?php echo $i ?>" name="f_urutan<?php echo $i ?>"  autocomplete="off">
        </div>

    </div>
<?php } ?>