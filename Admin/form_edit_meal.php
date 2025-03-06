<?php
include "../db=connection.php";
$query = "SELECT Guest_meal2.id,Guest_meal2.negara,Guest_meal2.kurs, bf_meal.price as breakfast,ln_meal.price as lunch,dn_meal.price as dinner, Guest_meal2.ket FROM Guest_meal2 LEFT JOIN Guest_meal2 as bf_meal ON (bf_meal.negara = Guest_meal2.negara && bf_meal.meal_type='BREAKFAST' && bf_meal.ket=Guest_meal2.ket) LEFT JOIN Guest_meal2 as ln_meal ON (ln_meal.negara = Guest_meal2.negara && ln_meal.meal_type='LUNCH' && ln_meal.ket=Guest_meal2.ket) LEFT JOIN Guest_meal2 as dn_meal ON (dn_meal.negara = Guest_meal2.negara && dn_meal.meal_type='DINNER' && dn_meal.ket=Guest_meal2.ket) WHERE Guest_meal2.id='" . $_POST['id'] . "' GROUP BY Guest_meal2.ket  order by Guest_meal2.negara ASC";
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);
?>
<div class="form-row">
    <div class="form-group col">
        <label>Country</label>
        <select class="form-control form-control-sm" id="negara_edit" name="negara_edit" disabled>
            <option value="<?php echo isset($row['negara']) ? $row['negara'] : "" ?>" selected><?php echo isset($row['negara']) ? $row['negara'] : "" ?></option>
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
        <select class="form-control form-control-sm" id="kurs_edit" name="kurs_edit">
            <option value="<?php echo isset($row['kurs']) ? $row['kurs'] : "" ?>" selected><?php echo isset($row['kurs']) ? $row['kurs'] : "" ?></option>
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
        <input type="number" class="form-control form-control-sm" id="bf_edit" name="bf_edit" min="0" value="<?php echo $row['breakfast'] ?>">
    </div>
    <div class="form-group col">
        <label>Lunch</label>
        <input type="number" class="form-control form-control-sm" id="ln_edit" name="ln_edit" min="0" value="<?php echo $row['lunch'] ?>">
    </div>
    <div class="form-group col">
        <label>Dinner</label>
        <input type="number" class="form-control form-control-sm" id="dn_edit" name="dn_edit" min="0" value="<?php echo $row['dinner'] ?>">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-6">
        <label>Keterangan</label>
        <input type="text" class="form-control form-control-sm" id="ket_edit" name="ket_edit" value="<?php echo $row['ket'] ?>" disabled>
    </div>
</div>