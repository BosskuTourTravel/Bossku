 <?php
 include "../site.php";
 include "../db=connection.php";
 $id = $_POST['id'];

 $query_admission = "SELECT * FROM admission WHERE id=".$id;
 $rs_admission=mysqli_query($con,$query_admission);
 $row_admission = mysqli_fetch_array($rs_admission);

echo "
							<div class='form-row align-items-center'>
                            	<div class='col-2'>
                                        <label>Physhic</label></br>
                                        <select class='chosen' name='physic' id='physic' disabled>";
                                        if($row_admission['physic']==1){
                                        	echo "<option selected='selected' value=1>Ada</option>";
                                        	echo "<option value=0>Tidak Ada</option>";
                                        }else{
                                        	echo "<option value=1>Ada</option>";
                                        	echo "<option selected='selected' value=0>Tidak Ada</option>";
                                        }
                                        echo "</select>
                                    </div>
                                   <div class='col-2'>
                                        <label>E-Tix</label></br>
                                        <select class='chosen' name='etix' id='etix' disabled>";
                                        if($row_admission['etix']==1){
                                        	echo "<option selected='selected' value=1>Ada</option>";
                                        	echo "<option value=0>Tidak Ada</option>";
                                        }else{
                                        	echo "<option value=1>Ada</option>";
                                        	echo "<option selected='selected' value=0>Tidak Ada</option>";
                                        }
                                        echo "</select>
                                    </div>
                                    <div class='col-2'>
                                        <label>Redeem</label></br>
                                        <select class='chosen' name='redeem' id='redeem' disabled>";
                                        if($row_admission['redeem']==1){
                                        	echo "<option selected='selected' value=1>Ada</option>";
                                        	echo "<option value=0>Tidak Ada</option>";
                                        }else{
                                        	echo "<option value=1>Ada</option>";
                                        	echo "<option selected='selected' value=0>Tidak Ada</option>";
                                        }
                                        echo "</select>
                                    </div>

                                    <div class='col-2'>
                                        <label>Kurs Price</label></br>";
                                        $query_kurs = "SELECT * FROM kurs_bank";
                                        $rs_kurs=mysqli_query($con,$query_kurs);
                                       
                                        echo "<select class='chosen' name='kurs_price' id='kurs_price' style='width: 100%;' disabled>
                                        <option selected='selected' value=0>Pilihan</option>";
                                        while( $row_kurs = mysqli_fetch_array($rs_kurs)){
                                          if($row_kurs['id']==$row_admission['kurs']){
                                            echo "<option selected='selected' value='".$row_kurs['id']."'>".$row_kurs['name']."</option>";
                                          }else{
                                            echo "<option value='".$row_kurs['id']."'>".$row_kurs['name']."</option>";
                                          }
                                        }

                                        echo"</select>";
                                    echo "</div>
                            </div>
                            <div class='form-row align-items-center'>
	                            <div class='col-2'>
		                            <label>Adt Pax</label></br>
		                            <select name='adt_pax' id='adt_pax'>
		                            <option selected='selected' value=0>Jumlah Pax</option>";

		                            for ($y = 1; $y <= 20; $y++){
		                            	echo "<option value=".$y.">".$y."</option>";
		                            }
	                            echo "</select></div>
	                            <div class='col-2'>
		                            <label>Senior Pax</label></br>
		                            <select name='senior_pax' id='senior_pax'>
		                            <option selected='selected' value=0>Jumlah Pax</option>";

		                            for ($y = 1; $y <= 20; $y++){
		                            	echo "<option value=".$y.">".$y."</option>";
		                            }
	                            echo "</select></div>
	                            <div class='col-2'>
		                            <label>Junior Pax</label></br>
		                            <select name='junior_pax' id='junior_pax'>
		                            <option selected='selected' value=0>Jumlah Pax</option>";

		                            for ($y = 1; $y <= 20; $y++){
		                            	echo "<option value=".$y.">".$y."</option>";
		                            }
	                            echo "</select></div>
	                            <div class='col-2'>
		                            <label>Chd Pax</label></br>
		                            <select name='chd_pax' id='chd_pax'>
		                            <option selected='selected' value=0>Jumlah Pax</option>";

		                            for ($y = 1; $y <= 20; $y++){
		                            	echo "<option value=".$y.">".$y."</option>";
		                            }
	                            echo "</select></div>
	                            <div class='col-2'>
		                            <label>Inf Pax</label></br>
		                            <select name='inf_pax' id='inf_pax'>
		                            <option selected='selected' value=0>Jumlah Pax</option>";

		                            for ($y = 1; $y <= 20; $y++){
		                            	echo "<option value=".$y.">".$y."</option>";
		                            }
	                            echo "</select></div>

                            </div>
							<div class='form-row align-items-center'>
                                    <div class='col-2'>
                                        <label>Sell Adt Price</label>
                                            <input type='text' class='form-control' name='sell_adt_price' id='sell_adt_price' value='".$row_admission['sell_adt_price']."' placeholder='Enter Adt Price' disabled>
                                    </div>
                                     <div class='col-2'>
                                        <label>Sell Senior Price</label>
                                            <input type='text' class='form-control' name='sell_senior_price' id='sell_senior_price' value='".$row_admission['sell_senior_price']."' placeholder='Enter Adt Price' disabled>
                                    </div>
                                     <div class='col-2'>
                                        <label>Sell Junior Price</label>
                                            <input type='text' class='form-control' name='sell_junior_price' id='sell_junior_price' value='".$row_admission['sell_junior_price']."' placeholder='Enter Adt Price' disabled>
                                    </div>
                                     <div class='col-2'>
                                        <label>Sell Chd Price</label>
                                            <input type='text' class='form-control' name='sell_chd_price' id='sell_chd_price' value='".$row_admission['sell_chd_price']."' placeholder='Enter Adt Price' disabled>
                                    </div>
                                    <div class='col-2'>
                                        <label>Sell Inf Price</label>
                                            <input type='text' class='form-control' name='sell_inf_price' id='sell_inf_price' value='".$row_admission['sell_inf_price']."' placeholder='Enter Adt Price' disabled>
                                    </div>
                              </div>

                              <div class='form-row align-items-center'>
                                    <div class='col-2'>
                                        <label>Adt Desc</label>
                                            <input type='text' class='form-control' name='adt_desc' id='adt_desc' value='".$row_admission['adt_desc']."' placeholder='contoh : (4-12 yrs)' disabled>
                                    </div>
                                     <div class='col-2'>
                                        <label>Senior Desc</label>
                                            <input type='text' class='form-control' name='senior_desc' id='senior_desc' value='".$row_admission['senior_desc']."' placeholder='contoh : (4-12 yrs)' disabled>
                                    </div>
                                     <div class='col-2'>
                                        <label>Junior Desc</label>
                                            <input type='text' class='form-control' name='junior_desc' id='junior_desc' value='".$row_admission['junior_desc']."' placeholder='contoh : (4-12 yrs)' disabled>
                                    </div>
                                     <div class='col-2'>
                                        <label>Chd Desc</label>
                                            <input type='text' class='form-control' name='chd_desc' id='chd_desc' value='".$row_admission['chd_desc']."' placeholder='contoh : (4-12 yrs)' disabled>
                                    </div>
                                    <div class='col-2'>
                                        <label>Inf Desc</label>
                                            <input type='text' class='form-control' name='inf_desc' id='inf_desc' value='".$row_admission['inf_desc']."' placeholder='contoh : (4-12 yrs)' disabled>
                                    </div>
                              </div>";

 ?>
 <script>
 	$(document).ready(function(){
 		$(".chosen").chosen();

    var countDate = <?php echo $count; ?>;
    
    for (i = 1; i <= countDate; i++) {
      $('input[name="datefilter'+i+'"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
      });

    }
    
 	});

 </script>
