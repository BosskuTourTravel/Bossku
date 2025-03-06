<?php
include "../db=connection.php";
?>
<div class="form-row">
    <div class="form-group col">
        <label>Country</label>
        <select class="form-control form-control-sm" id="negara" name="negara">
            <option value="" selected>Pilih Negara</option>
            <?php
            $query_country = "SELECT * FROM country order by name ASC";
            $rs_country = mysqli_query($con, $query_country);
            while ($row_country = mysqli_fetch_array($rs_country)) {
            ?>
                <option value="<?php echo $row_country['name'] ?>"><?php echo $row_country['name'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group col">
        <label>Kurs</label>
        <select class="form-control form-control-sm" id="kurs" name="kurs">
            <option value="" selected>Pilih Kurs</option>
            <?php
            $query_kurs = "SELECT * FROM kurs_bca_field order by id ASC";
            $rs_kurs = mysqli_query($con, $query_kurs);
            while ($row_kurs = mysqli_fetch_array($rs_kurs)) {
            ?>
                <option value="<?php echo $row_kurs['nama'] ?>"><?php echo $row_kurs['nama'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="form-group col">
        <label>Breakfast</label>
        <input type="number" class="form-control form-control-sm" id="bf" name="bf" min="0">
    </div>
    <div class="form-group col">
        <label>Lunch</label>
        <input type="number" class="form-control form-control-sm" id="ln" name="ln" min="0">
    </div>
    <div class="form-group col">
        <label>Dinner</label>
        <input type="number" class="form-control form-control-sm" id="dn" name="dn" min="0">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-6">
        <label>Keterangan</label>
        <input type="text" class="form-control form-control-sm" id="ket" name="ket">
    </div>
</div>