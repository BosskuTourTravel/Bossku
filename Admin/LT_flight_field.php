<?php
include "../db=connection.php";
$i = $_POST['i'];
?>
<div id="row<?php echo $i ?>">
    <div class="row">
        <div class="col" style="max-width: 150px;">
            <div class="form-group">
                <select class="form-control form-control-sm" id="tipe" name="tipe[]">
                    <option value="">Pilih tipe</option>
                    <option value="ONE WAY">One Way</option>
                    <option value="RETURN">Return</option>
                    <option value="MULTI">Multi</option>
                </select>
            </div>
        </div>
        <div class="col" style="max-width: 250px;">
            <div class="form-group">
                <input class="form-control form-control-sm" list="tour_list" id="tour" name="tour[]" placeholder="Landtour Name">
                <datalist id="tour_list">
                    <?php
                    $query_LTNx = "SELECT DISTINCT judul,kode FROM LT_itinnew  Order by id ASC";
                    $rs_LTNx = mysqli_query($con, $query_LTNx);
                    while ($row_ltn = mysqli_fetch_array($rs_LTNx)) {
                        $kode = $row_ltn['kode'];
                    ?>
                        <option data-customvalue="<?php echo $row_ltn['kode'] ?>" value="<?php echo $row_ltn['kode'] ?>"></option>
                    <?php
                    }
                    ?>
                </datalist>
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <!-- <input type="text" class="form-control form-control-sm" id="rute" name="rute[]"> -->
                <select class="form-control form-control-sm" id="rute" name="rute[]">
                    <option value="">Pilih Rute</option>
                    <option value="f1g">Flight 1 (Group Price)</option>
                    <option value="f2g">Flight 2 (Group Price)</option>
                    <option value="f3g">Flight 3 (Group Price)</option>
                    <option value="f4g">Flight 4 (Group Price)</option>
                    <option value="f5g">Flight 5 (Group Price)</option>
                    <option value="f1f">Flight 1 (FIT Price)</option>
                    <option value="f2f">Flight 2 (FIT Price)</option>
                    <option value="f3f">Flight 3 (FIT Price)</option>
                    <option value="f4f">Flight 4 (FIT Price)</option>
                    <option value="f5f">Flight 5 (FIT Price)</option>
                </select>
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <select class="form-control form-control-sm" id="int" name="int[]">
                    <option value="">Pilih tipe</option>
                    <option value="INT">International</option>
                    <option value="DOM">Domestic</option>
                </select>
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <input type="text" class="form-control form-control-sm" id="maskapai" name="maskapai[]">
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <!-- <input type="text" class="form-control form-control-sm" id="dept" name="dept[]"> -->
                <input type="text" class="form-control form-control-sm" list="dept_list<?php echo $i ?>" id="dept<?php echo $i ?>" name="dept[]" onkeyup="getFromX(this.value,<?php echo $i ?>)">
                <datalist id="dept_list<?php echo $i ?>"></datalist>
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <input type="text" class="form-control form-control-sm" list="arr_list<?php echo $i ?>" id="arr" name="arr[]" onkeyup="getArr(this.value,<?php echo $i ?>)">
                <datalist id="arr_list<?php echo $i ?>"></datalist>
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <input type="date" class="form-control form-control-sm" id="tgl" name="tgl[]">
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <input type="time" class="form-control form-control-sm" id="take" name="take[]">
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <input type="time" class="form-control form-control-sm" id="landing" name="landing[]">
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <input type="number" class="form-control form-control-sm" id="adt" name="adt[]">
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <input type="number" class="form-control form-control-sm" id="chd" name="chd[]">
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <input type="number" class="form-control form-control-sm" id="inf" name="inf[]">
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <input type="number" class="form-control form-control-sm" id="bagasi" name="bagasi[]">
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <input type="number" class="form-control form-control-sm" id="bg_price" name="bg_price[]">
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <input type="number" class="form-control form-control-sm" id="st_price" name="st_price[]">
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <input type="number" class="form-control form-control-sm" id="bf" name="bf[]">
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <input type="number" class="form-control form-control-sm" id="ln" name="ln[]">
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <input type="number" class="form-control form-control-sm" id="dn" name="dn[]">
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <input type="number" class="form-control form-control-sm" id="tax" name="tax[]">
            </div>
        </div>
        <div class="col" style="max-width: 200px;">
            <div class="form-group">
                <button type="button" name="remove" id="<?php echo $i ?>" class="btn btn-danger btn-sm btn_remove" onclick="remove(<?php echo $i ?>)"><i class="fa fa-trash"></i></button>
            </div>
        </div>
    </div>
</div>