<?php
include "../site.php";
include "../db=connection.php";
$query_type = "SELECT * FROM LTP_type_flight where id=" . $_POST['id'];
$rs_type = mysqli_query($con, $query_type);
$row_type = mysqli_fetch_array($rs_type);

for ($i = 1; $i <= $row_type['kolom']; $i++) {
?>
      <div class="form-row" style="padding-top: 5px;">
            <div class="col" style="max-width: 190px;">
                  <?php if ($i == '1') {
                        echo "<label>Flight Code</label>";
                  } ?>
                  <input type="text" class="form-control form-control-sm" id="maskapai<?php echo $i ?>" name="maskapai<?php echo $i ?>" placeholder="Code Maskapai">
            </div>
            <div class="col" style="max-width: 120px;">
                  <?php if ($i == '1') {
                        echo "<label>Depature</label>";
                  } ?>

                  <input type="text" class="form-control form-control-sm" id="dept<?php echo $i ?>" name="dept<?php echo $i ?>" placeholder="Departure">
            </div>
            <div class="col" style="max-width: 120px;">
                  <?php if ($i == '1') {
                        echo "<label>Arrival</label>";
                  } ?>

                  <input type="text" class="form-control form-control-sm" id="arr<?php echo $i ?>" name="arr<?php echo $i ?>" placeholder="Arrival">
            </div>
            <div class="col" style="max-width: 120px;">
                  <?php if ($i == '1') {
                        echo "<label>Etd</label>";
                  } ?>

                  <input type="text" class="form-control form-control-sm" id="etd<?php echo $i ?>" name="etd<?php echo $i ?>" placeholder="ETD">
            </div>
            <div class="col" style="max-width: 120px;">
                  <?php if ($i == '1') {
                        echo "<label>Eta</label>";
                  } ?>

                  <input type="text" class="form-control form-control-sm" id="eta<?php echo $i ?>" name="eta<?php echo $i ?>" placeholder="ETA">
            </div>
            <div class="col" style="max-width: 120px;" hidden="hidden">
                  <?php if ($i == '1') {
                        echo "<label>Transit</label>";
                  } ?>

                  <input type="text" class="form-control form-control-sm" id="transit<?php echo $i ?>" name="transit<?php echo $i ?>" placeholder="Transit">
            </div>
            <div class="col" style="max-width: 190px;">
                  <?php if ($i == '1') {
                        echo "<label>Tgl</label>";
                  } ?>

                  <input type="text" class="form-control form-control-sm" id="tgl<?php echo $i ?>" name="tgl<?php echo $i ?>" placeholder="Tgl">
            </div>
            <div class="col" style="max-width: 190px;">
                  <?php if ($i == '1') {
                        echo "<label>Adt</label>";
                  } ?>

                  <input type="text" class="form-control form-control-sm" id="adt<?php echo $i ?>" name="adt<?php echo $i ?>" placeholder="Adult">
            </div>
            <div class="col" style="max-width: 190px;">
                  <?php if ($i == '1') {
                        echo "<label>Chd</label>";
                  } ?>

                  <input type="text" class="form-control form-control-sm" id="chd<?php echo $i ?>" name="chd<?php echo $i ?>" placeholder="Child">
            </div>
            <div class="col" style="max-width: 190px;">
                  <?php if ($i == '1') {
                        echo "<label>Inf</label>";
                  } ?>

                  <input type="text" class="form-control form-control-sm" id="inf<?php echo $i ?>" name="inf<?php echo $i ?>" placeholder="Infant">
            </div>
            <div class="col" style="max-width: 190px;">
                  <?php if ($i == '1') {
                        echo "<label>Bf</label>";
                  } ?>

                  <input type="text" class="form-control form-control-sm" id="bf<?php echo $i ?>" name="bf<?php echo $i ?>" placeholder="Breakfast">
            </div>
            <div class="col" style="max-width: 190px;">
                  <?php if ($i == '1') {
                        echo "<label>Ln</label>";
                  } ?>

                  <input type="text" class="form-control form-control-sm" id="ln<?php echo $i ?>" name="ln<?php echo $i ?>" placeholder="Lunch">
            </div>
            <div class="col" style="max-width: 190px;">
                  <?php if ($i == '1') {
                        echo "<label>Dn</label>";
                  } ?>

                  <input type="text" class="form-control form-control-sm" id="dn<?php echo $i ?>" name="dn<?php echo $i ?>" placeholder="Dinner">
            </div>
            <div class="col" style="max-width: 190px;">
                  <?php if ($i == '1') {
                        echo "<label>Bagasi(kg)</label>";
                  } ?>

                  <input type="text" class="form-control form-control-sm" id="bagasi<?php echo $i ?>" name="bagasi<?php echo $i ?>" placeholder="bagasi">
            </div>
            <div class="col" style="max-width: 190px;">
                  <?php if ($i == '1') {
                        echo "<label>Bagasi Price</label>";
                  } ?>

                  <input type="text" class="form-control form-control-sm" id="bagasi_price<?php echo $i ?>" name="bagasi_price<?php echo $i ?>" placeholder="Bagasi Price">
            </div>
            <div class="col" style="max-width: 190px;">
                  <?php if ($i == '1') {
                        echo "<label>SEAT</label>";
                  } ?>
                  <input type="text" class="form-control form-control-sm" id="seat<?php echo $i ?>" name="seat<?php echo $i ?>" placeholder="Seat">
            </div>
            <div class="col" style="max-width: 190px;">
                  <?php if ($i == '1') {
                        echo "<label>Tax</label>";
                  } ?>
                  <input type="text" class="form-control form-control-sm" id="tax<?php echo $i ?>" name="tax<?php echo $i ?>" placeholder="Tax">
            </div>
      </div>
<?php
}
?>
<input type="hidden" name="kolom" id="kolom" value="<?php echo $row_type['kolom'] ?>">