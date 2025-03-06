<?php
include "../db=connection.php";
if ($_POST['x'] != "") {
    $data = $_POST['tipe'];

    $query = "SELECT * FROM LTP_type_flight where id=".$data;
    $rs = mysqli_query($con,$query);
    $row = mysqli_fetch_array($rs);

    for ($i = 1; $i <= $row['kolom']; $i++) {
?>
        <div class="row">
           
            <div class="col" style="max-width: 200px;">
                <div class="form-group">
                    <?php
                    if ($i == 1) {
                        echo "<label>Flight Code</label>";
                    }
                    ?>
                    <input type="text" class="form-control form-control-sm" id="maskapai" name="maskapai[]" autocomplete="off">

                </div>
            </div>
            <div class="col" style="max-width: 200px;">
                <div class="form-group">
                    <?php
                    if ($i == 1) {
                        echo "<label>Depature</label>";
                    }
                    ?>
                    <input type="text" class="form-control form-control-sm" list="dept_list1" id="dept1" name="dept[]" autocomplete="off" onkeyup="getFromX(this.value,1)">
                    <datalist id="dept_list1"></datalist>
                </div>
            </div>
            <div class="col" style="max-width: 200px;">
                <div class="form-group">
                    <?php
                    if ($i == 1) {
                        echo "<label>Arrival</label>";
                    }
                    ?>
                    <input type="text" class="form-control form-control-sm" list="arr_list1" id="arr" name="arr[]" onkeyup="getArr(this.value,1)" autocomplete="off">
                    <datalist id="arr_list1"></datalist>
                </div>
            </div>
            <div class="col" style="max-width: 200px;">
                <div class="form-group">
                    <?php
                    if ($i == 1) {
                        echo "<label>Tgl</label>";
                    }
                    ?>
                    <input type="text" class="form-control form-control-sm" id="tgl" name="tgl[]" autocomplete="off" placeholder="1-2-3-4">
                </div>
            </div>
            <div class="col" style="max-width: 200px;">
                <div class="form-group">
                    <?php
                    if ($i == 1) {
                        echo "<label>ETD</label>";
                    }
                    ?>
                    <input type="time" class="form-control form-control-sm" id="take" name="take[]" autocomplete="off">
                </div>
            </div>
            <div class="col" style="max-width: 200px;">
                <div class="form-group">
                    <?php
                    if ($i == 1) {
                        echo "<label>ETA</label>";
                    }
                    ?>
                    <input type="time" class="form-control form-control-sm" id="landing" name="landing[]" autocomplete="off">
                </div>
            </div>
            <div class="col" style="max-width: 200px;">
                <div class="form-group">
                    <?php
                    if ($i == 1) {
                        echo "<label>ADT Price</label>";
                    }
                    ?>
                    <input type="number" class="form-control form-control-sm" id="adt" name="adt[]" autocomplete="off">
                </div>
            </div>
            <div class="col" style="max-width: 200px;">
                <div class="form-group">
                    <?php
                    if ($i == 1) {
                        echo "<label>CHD Price</label>";
                    }
                    ?>
                    <input type="number" class="form-control form-control-sm" id="chd" name="chd[]" autocomplete="off">
                </div>
            </div>
            <div class="col" style="max-width: 200px;">
                <div class="form-group">
                    <?php
                    if ($i == 1) {
                        echo "<label>INF Price</label>";
                    }
                    ?>
                    <input type="number" class="form-control form-control-sm" id="inf" name="inf[]" autocomplete="off">
                </div>
            </div>
            <div class="col" style="max-width: 200px;">
                <div class="form-group">
                    <?php
                    if ($i == 1) {
                        echo "<label>Baggage(kg)</label>";
                    }
                    ?>
                    <input type="number" class="form-control form-control-sm" id="bagasi" name="bagasi[]">
                </div>
            </div>
            <div class="col" style="max-width: 200px;">
                <div class="form-group">
                    <?php
                    if ($i == 1) {
                        echo "<label>Baggage(price)</label>";
                    }
                    ?>
                    <input type="number" class="form-control form-control-sm" id="bg_price" name="bg_price[]">
                </div>
            </div>
            <div class="col" style="max-width: 200px;">
                <div class="form-group">
                    <?php
                    if ($i == 1) {
                        echo "<label>Seat Price</label>";
                    }
                    ?>
                    <input type="number" class="form-control form-control-sm" id="st_price" name="st_price[]">
                </div>
            </div>
            <div class="col" style="max-width: 200px;">
                <div class="form-group">
                    <?php
                    if ($i == 1) {
                        echo "<label>B(on Board)</label>";
                    }
                    ?>
                    <input type="number" class="form-control form-control-sm" id="bf" name="bf[]">
                </div>
            </div>
            <div class="col" style="max-width: 200px;">
                <div class="form-group">
                    <?php
                    if ($i == 1) {
                        echo "<label>L(on Board)</label>";
                    }
                    ?>
                    <input type="number" class="form-control form-control-sm" id="ln" name="ln[]">
                </div>
            </div>
            <div class="col" style="max-width: 200px;">
                <div class="form-group">
                    <?php
                    if ($i == 1) {
                        echo "<label>D(on Board)</label>";
                    }
                    ?>
                    <input type="number" class="form-control form-control-sm" id="dn" name="dn[]">
                </div>
            </div>
            <div class="col" style="max-width: 200px;">
                <div class="form-group">
                    <?php
                    if ($i == 1) {
                        echo "<label>Tax</label>";
                    }
                    ?>
                    <input type="number" class="form-control form-control-sm" id="tax" name="tax[]">
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "Page Not Found";
}
