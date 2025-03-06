<?php
//export.php  

if (!empty($_FILES["excel_flight"])) {
     //   $connect = mysqli_connect("localhost", "root", "", "testing");  
     include "../site.php";
     include "../db=connection.php";
     include("Classes/PHPExcel/IOFactory.php");

     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_flight"]["name"]);
     if ($file_array[1] == "xlsx") {
?>
          <label class="text-danger">File Format Done</label></br>
          <div class="card">
               <div class="card-body">
                    <?php
                    $object = PHPExcel_IOFactory::load($_FILES["excel_flight"]["tmp_name"]);
                    $berhasil = 0;
                    $gagal = 0;
                    $update = 0;
                    $gagalupdate = 0;
                    $halaman = 1;
                    $worksheet = $object->getSheetByName('main');
                    $date = date("Y-m-d");
                    $s = 0;
                    foreach ($object->getWorksheetIterator() as $worksheet) {
                         $highestRow = $worksheet->getHighestRow();
                         if ($halaman > 4) {
                              $filter = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, 1)->getValue());
                              $s++;
                              if ($filter == "on" || $filter == "") {
                    ?>
                                   <div style="text-align: center; font-weight: bold; padding: 20px; font-size: 16pt;">SHEET <?php echo $s ?></div>
                                   <?php
                                   $p = 1;
                                   for ($row = 3; $row <= $highestRow; $row++) {
                                        $city_in = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                                        $city_out = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                                        $musim = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                                        $type1 =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                                        $type2 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                                        $id_grub = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                                        $maskapai = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                                        $dept_arr = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                                        $no_maskapai = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
                                        $etd = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
                                        $eta = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(10, $row)->getValue());
                                        $tgl = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(11, $row)->getValue());
                                        $transit = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(12, $row)->getValue());
                                        $adt = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(13, $row)->getValue());
                                        $chd = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(14, $row)->getValue());
                                        $inf = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(15, $row)->getValue());
                                        $bagasi =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(16, $row)->getValue());
                                        $bagasi_price =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(17, $row)->getValue());
                                        $seat_price =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(18, $row)->getValue());
                                        $bf =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(19, $row)->getValue());
                                        $ln =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(20, $row)->getValue());
                                        $dn =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(21, $row)->getValue());
                                        $tax =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(22, $row)->getValue());
                                        $profit = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(23, $row)->getValue());
                                        if ($city_in != '' && $city_out != '' && $type1 != '' && $type2 != '' && $maskapai != '') {

                                   ?>
                                             <div class="row">
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>City IN</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="in" name="in[]" value="<?php echo $city_in ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>City OUT</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="out" name="out[]" value="<?php echo $city_out ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>Musim</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="musim" name="musim[]" value="<?php echo $musim ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>Type 1</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="type1" name="type1[]" value="<?php echo $type1 ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>Type 2</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="type2" name="type2[]" value="<?php echo $type2 ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>ID Grub</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="id_grub" name="id_grub[]" value="<?php echo $id_grub ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>Maskapai</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="maskapai" name="maskapai[]" value="<?php echo $maskapai ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>Dept - Arr</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="dept_arr" name="dept_arr[]" value="<?php echo $dept_arr ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>Code Maskapai</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="no_mas" name="no_mas[]" value="<?php echo $no_maskapai ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>ETD</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="etd" name="etd[]" value="<?php echo $etd ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>ETA</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="eta" name="eta[]" value="<?php echo $eta ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>Hari</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="tgl" name="tgl[]" value="<?php echo $tgl ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>ADT</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="adt" name="adt[]" value="<?php echo $adt ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>CHD</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="chd" name="chd[]" value="<?php echo $chd ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>INF</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="inf" name="inf[]" value="<?php echo $inf ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>Bagasi</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="bagasi" name="bagasi[]" value="<?php echo $bagasi ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>Bagasi Price</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="bagasi_price" name="bagasi_price[]" value="<?php echo $bagasi_price ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>Seat Price</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="seat_price" name="seat_price[]" value="<?php echo $seat_price ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>BF</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="bf" name="bf[]" value="<?php echo $bf ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>LN</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="ln" name="ln[]" value="<?php echo $ln ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>DN</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="dn" name="dn[]" value="<?php echo $dn ?>">
                                                       </div>
                                                  </div>
                                                  <div class="col">
                                                       <div class="form-group">
                                                            <?php if ($p == '1') {
                                                                 echo "<label>TAX</label>";
                                                            } ?>
                                                            <input type="text" class="form-control form-control-sm" id="tax" name="tax[]" value="<?php echo $tax ?>">
                                                       </div>
                                                  </div>
                                             </div>
                    <?php

                                        }
                                        $p++;
                                   }
                              }
                         }

                         $halaman++;
                    }
                    ?>
                    <div style="padding-top: 20px;"><button type="button" class="btn btn-success" onclick="add_data()">SUBMIT</button></div>
               </div>
          </div>
     <?php

     } else {
     ?> <label class="text-danger">Invalid File</label><?php
                                                  }
                                             }
                                                       ?>
<div id="cek" style="padding-bottom: 20px;"></div>
<script>
     function add_data() {
          let formData = new FormData();
          var city_in = $('input[name="in[]"]').map(function() {
               return this.value;
          }).get();
          var city_out = $('input[name="out[]"]').map(function() {
               return this.value;
          }).get();
          var musim = $('input[name="musim[]"]').map(function() {
               return this.value;
          }).get();
          var type1 = $('input[name="type1[]"]').map(function() {
               return this.value;
          }).get();
          var type2 = $('input[name="type2[]"]').map(function() {
               return this.value;
          }).get();
          var id_grub = $('input[name="id_grub[]"]').map(function() {
               return this.value;
          }).get();
          var maskapai = $('input[name="maskapai[]"]').map(function() {
               return this.value;
          }).get();
          var dept_arr = $('input[name="dept_arr[]"]').map(function() {
               return this.value;
          }).get();
          var no_mas = $('input[name="no_mas[]"]').map(function() {
               return this.value;
          }).get();
          var etd = $('input[name="etd[]"]').map(function() {
               return this.value;
          }).get();
          var eta = $('input[name="eta[]"]').map(function() {
               return this.value;
          }).get();
          var tgl = $('input[name="tgl[]"]').map(function() {
               return this.value;
          }).get();
          var transit = $('input[name="transit[]"]').map(function() {
               return this.value;
          }).get();
          var adt = $('input[name="adt[]"]').map(function() {
               return this.value;
          }).get();
          var chd = $('input[name="chd[]"]').map(function() {
               return this.value;
          }).get();
          var inf = $('input[name="inf[]"]').map(function() {
               return this.value;
          }).get();
          var bagasi = $('input[name="bagasi[]"]').map(function() {
               return this.value;
          }).get();
          var bagasi_price = $('input[name="bagasi_price[]"]').map(function() {
               return this.value;
          }).get();
          var seat_price = $('input[name="seat_price[]"]').map(function() {
               return this.value;
          }).get();
          var bf = $('input[name="bf[]"]').map(function() {
               return this.value;
          }).get();
          var ln = $('input[name="ln[]"]').map(function() {
               return this.value;
          }).get();
          var dn = $('input[name="dn[]"]').map(function() {
               return this.value;
          }).get();
          var tax = $('input[name="tax[]"]').map(function() {
               return this.value;
          }).get();

          formData.append('in', city_in);
          formData.append('out', city_out);
          formData.append('musim', musim);
          formData.append('type1', type1);
          formData.append('type2', type2);
          formData.append('id_grub', id_grub);
          formData.append('maskapai', maskapai);
          formData.append('dept_arr', dept_arr);
          formData.append('no_mas', no_mas);
          formData.append('etd', etd);
          formData.append('eta', eta);
          formData.append('tgl', tgl);
          formData.append('transit', transit);
          formData.append('adt', adt);
          formData.append('chd', chd);
          formData.append('inf', inf);
          formData.append('bagasi', bagasi);
          formData.append('bagasi_price', bagasi_price);
          formData.append('seat_price', seat_price);
          formData.append('bf', bf);
          formData.append('ln', ln);
          formData.append('dn', dn);
          formData.append('tax', tax);

          $.ajax({
               type: 'POST',
               url: "insert_add_master_fl.php",
               data: formData,
               cache: false,
               processData: false,
               contentType: false,
               success: function(msg) {
                    // $('#cek').html(msg);
                    alert(msg);
                    LT_Package(11, 0, 0);
               },
               error: function() {
                    alert("Data Gagal Diupload");
               }
          });
     }
</script>