<?php
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM  LTP_route_detail where id=" . $_POST['id'];
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);

$query_type = "SELECT id,nama FROM LTP_type_flight where id=" . $row['type'];
$rs_type = mysqli_query($con, $query_type);
$row_type = mysqli_fetch_array($rs_type);

//export.php  
?>
<div class="container">
      <form>
            <div class="form-group">
                  <label>Musim</label>
                  <input type="text" class="form-control form-control-sm" id="musim" name="musim" value="<?php echo $row['musim'] ?>">
            </div>
            <div class="form-group">
                  <label>Trip</label>
                  <select class="form-control form-control-sm" id="trip" name="trip">
                        <option value="<?php echo $row_type['id'] ?>" selected><?php echo $row_type['nama'] ?></option>
                        <?php
                        $query_type2 = "SELECT id,nama FROM LTP_type_flight order by nama ASC";
                        $rs_type2 = mysqli_query($con, $query_type2);
                        while ($row_type2 = mysqli_fetch_array($rs_type2)) {
                        ?>
                              <option value="<?php echo $row_type2['id']  ?>"><?php echo $row_type2['nama']  ?></option>
                        <?php
                        }
                        ?>
                  </select>
            </div>
            <div class="form-group">
                  <label>Type</label>
                  <select class="form-control form-control-sm" id="rute" name="rute">
                        <option value="<?php echo $row['rute'] ?>" selected><?php echo $row['rute'] ?></option>
                        <option>FIT</option>
                        <option>FIG</option>
                  </select>
            </div>
            <div class="form-group">
                  <label>Tgl</label>
                  <input type="text" class="form-control form-control-sm" id="tgl" name="tgl" value="<?php echo $row['tgl'] ?>">
            </div>
            <div class="form-group">
                  <label>Code Maskapai</label>
                  <input type="text" class="form-control form-control-sm" id="kode" name="kode" value="<?php echo $row['maskapai'] ?>">
            </div>
            <div class="row">
                  <div class="col-md-6">
                        <div class="form-group">
                              <label>Depature</label>
                              <input type="text" class="form-control form-control-sm" id="dept" name="dept" value="<?php echo $row['dept'] ?>">
                        </div>
                  </div>
                  <div class="col-md-6">
                        <div class="form-group">
                              <label>Arrival</label>
                              <input type="text" class="form-control form-control-sm" id="arr" name="arr" value="<?php echo $row['arr'] ?>">
                        </div>
                  </div>
            </div>
            <div class="row">
                  <div class="col-md-4">
                        <div class="form-group">
                              <label>Etd</label>
                              <input type="text" class="form-control form-control-sm" id="etd" name="etd" value="<?php echo $row['take'] ?>">
                        </div>
                  </div>
                  <div class="col-md-4">
                        <div class="form-group">
                              <label>Eta</label>
                              <input type="text" class="form-control form-control-sm" id="eta" name="eta" value="<?php echo $row['landing'] ?>">
                        </div>
                  </div>
                  <div class="col-md-4">
                        <div class="form-group">
                              <label>Transit</label>
                              <input type="text" class="form-control form-control-sm" id="transit" name="transit" value="<?php echo $row['transit'] ?>">
                        </div>
                  </div>
            </div>
            <div class="row">
                  <div class="col-md-4">
                        <div class="form-group">
                              <label>Adt</label>
                              <input type="text" class="form-control form-control-sm" id="adt" name="adt" value="<?php echo $row['adt'] ?>">
                        </div>
                  </div>
                  <div class="col-md-4">
                        <div class="form-group">
                              <label>Chd</label>
                              <input type="text" class="form-control form-control-sm" id="chd" name="chd" value="<?php echo $row['chd'] ?>">
                        </div>
                  </div>
                  <div class="col-md-4">
                        <div class="form-group">
                              <label>Inf</label>
                              <input type="text" class="form-control form-control-sm" id="inf" name="inf" value="<?php echo $row['inf'] ?>">
                        </div>
                  </div>
            </div>
            <div class="row">
                  <div class="col-md-4">
                        <div class="form-group">
                              <label>Breakfast</label>
                              <input type="text" class="form-control form-control-sm" id="bf" name="bf" value="<?php echo $row['bf'] ?>">
                        </div>
                  </div>
                  <div class="col-md-4">
                        <div class="form-group">
                              <label>Lunch</label>
                              <input type="text" class="form-control form-control-sm" id="ln" name="ln" value="<?php echo $row['ln'] ?>">
                        </div>
                  </div>
                  <div class="col-md-4">
                        <div class="form-group">
                              <label>Dinner</label>
                              <input type="text" class="form-control form-control-sm" id="dn" name="dn" value="<?php echo $row['dn'] ?>">
                        </div>
                  </div>
            </div>
            <div class="row">
                  <div class="col-md-4">
                        <div class="form-group">
                              <label>Bagasi</label>
                              <input type="text" class="form-control form-control-sm" id="bagasi" name="bagasi" value="<?php echo $row['bagasi'] ?>">
                        </div>
                  </div>
                  <div class="col-md-4">
                        <div class="form-group">
                              <label>Bagasi Price</label>
                              <input type="text" class="form-control form-control-sm" id="bagasi_price" name="bagasi_price" value="<?php echo $row['bagasi_price'] ?>">
                        </div>
                  </div>
            </div>
            <div class="row">
                  <div class="col-md-4">
                        <div class="form-group">
                              <label>Seat Price</label>
                              <input type="text" class="form-control form-control-sm" id="seat" name="seat" value="<?php echo $row['seat_price'] ?>">
                        </div>
                  </div>
                  <div class="col-md-4">
                        <div class="form-group">
                              <label>Tax</label>
                              <input type="text" class="form-control form-control-sm" id="tax" name="tax" value="<?php echo $row['tax'] ?>">
                        </div>
                  </div>
            </div>
            <input type="hidden" name="detail_id" id="detail_id" value="<?php echo $_POST['id'] ?>">

      </form>
</div>