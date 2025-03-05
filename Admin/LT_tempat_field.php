<?php
include "../db=connection.php";
$i = $_POST['i'];
$x = $_POST['x'];
?>
<div id="<?php echo $x ?>row<?php echo $i ?>">
    <div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <label style="font-size: 11px">List Tempat </label>
                <input class="form-control form-control-sm" list="<?php echo $x ?>tmp_list" name="<?php echo $x ?>tmp[]" id="<?php echo $x ?>tmp[]" placeholder="Masukkan Nama Tempat">
                <datalist id="<?php echo $x ?>tmp_list">
                    <?php
                    $query_tempat = "SELECT * FROM List_tempat Order by id ASC";
                    $rs_tempat = mysqli_query($con, $query_tempat);
                    while ($row_tempat = mysqli_fetch_array($rs_tempat)) {
                    ?>
                        <option data-customvalue="<?php echo $row_tempat['id'] ?>" value="<?php echo $row_tempat['negara'] . " " . $row_tempat['city'] . " " . $row_tempat['tempat'] ?>"></option>
                    <?php
                    }
                    ?>
                </datalist>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group" style="padding-top: 25px">
                <button type="button" name="remove" id="<?php echo $i ?>" class="btn btn-danger btn-sm btn_remove" onclick="remove(<?php echo $x ?>,<?php echo $i ?>)"><i class="fa fa-trash"></i></button>
            </div>
        </div>
    </div>
</div>