<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<style>

	.tableFixHead          { overflow-y: auto; height: 100px; }
	.tableFixHead thead th { position: sticky; top: 0; }

	/* Just common table stuff. Really. */
	th     { background:#ffff; }



	.multiselect {
		width: 100%;
	}

	.selectBox {
		position: relative;
	}

	.selectBox select {
		width: 100%;
		font-weight: bold;
	}

	.overSelect {
		position: absolute;
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
	}

	#checkboxes {
		display: none;
		border: 1px #dadada solid;
	}

	#checkboxes label {
		display: block;
	}

	#checkboxes label:hover {
		background-color: #1e90ff;
	}
  .ui-autocomplete {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  float: left;
  display: none;
  min-width: 160px;
  padding: 10px;
  _width: 160px;
  list-style: none;
 background-color: #f1f1f1;
  border-color: #ccc;
  border-color: rgba(0, 0, 0, 0.2);
  border-style: solid;
  border-width: 1px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;

  }

.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
}
input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}
input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}
input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
}
.ui-autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9;
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important;
  color: #ffffff;
}
</style>
<?php
include "../site.php";
include "../db=connection.php";
session_start();

$querycustomer = "SELECT * FROM customer_list";
$rscustomer=mysqli_query($con,$querycustomer);

$querytour = "SELECT * FROM tour_package";
$rstour=mysqli_query($con,$querytour);

$query_hotel = "SELECT DISTINCT(unique_code) FROM hotel";
$rs_hotel=mysqli_query($con,$query_hotel);

$query_city = "SELECT * FROM city";
$rs_city=mysqli_query($con,$query_city);

$query_country = "SELECT * FROM country";
$rs_country=mysqli_query($con,$query_country);

$query_bank = "SELECT * FROM bank";
$rs_bank=mysqli_query($con,$query_bank);


echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>Hotel</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    
                    <div class='input-group-append'>

                      
                    </div>
                  </div>
                </div>
              </div>
              
              <div class='container' style='font-size:13px; max-width:50px important'>

                              </br>
                            <div class='form-row align-items-center' style='text-align:center;'> 
                                <span onclick='seeInput(0)'><i class='fa fa-eye-slash' aria-hidden='true'> HIDE </i></span>
                                  |
                                <span onclick='seeInput(1)'><i class='fa fa-eye' aria-hidden='true'> UNHIDE</i></span>
                            </div>
                            </br>
                    <div id='divInput'>
                              <div class='form-row align-items-center'> 
                                   <div class='col-3'>
                                            <label>Hotel Type</label>
                                                <select class='chosen' name='hotel_type' id='hotel_type' style='width: 100%;'>
                                                    <option selected='selected' value=0>Pilihan</option>
                                                    <option value='FIT'>FIT</option>
                                                    <option value='Group'>Group</option>
                                                    <option value='Group Tour Series'>Group Tour Series</option>
                                                </select>
                                        </div>
                                     

                                    
                                    <div class='col-3'>
                                        <label>Booking ID</label>
                                            <input type='text' class='form-control' name='booking_id' id='booking_id' placeholder='Enter Booking ID'>
                                    </div>
                                    <div class='col-3'>
                                        <label>Unique Code</label>
                                        <select class='chosen' name='uniquecode' id='uniquecode' class='form-control'>
                                        <option selected='selected' value='0'>Uniqe Code</option>";

                                        while($row_hotel = mysqli_fetch_array($rs_hotel)){
                                        	if($row_hotel['unique_code']!=''){
                                        		echo "<option value='".$row_hotel['unique_code']."'>".$row_hotel['unique_code']."</option>";
                                        	}
                                        }
                                        echo"</select>
                                    </div>
                                    

                            </div>
                            <div class='form-row align-items-center'>
                            	<div class='col-3'>
                                        <label>Guest Name</label>
                                        <select class='chosen' name='customer' id='customer'>
                                        <option selected='selected' value=0>Customer</option>";

                                        while($rowcustomer = mysqli_fetch_array($rscustomer)){
                                          echo "<option value='".$rowcustomer['id']."'>".$rowcustomer['customer_name'] ." ( ".$rowcustomer['phone_number']." ) From ".$rowcustomer['city']."</option>";
                                        }
                                        echo"</select>
                                    </div>
                                    <div class='col-3'>
                                        <label>Tour Name</label>";
                                        echo "<select class='chosen' name='tourpackage' id='tourpackage' class='form-control'>
                                        <option selected='selected' value=0>Tour Name</option>";

                                        while($rowtour = mysqli_fetch_array($rstour)){
                                          echo "<option value='".$rowtour['id']."'>888".$rowtour['id'] ." ".$rowtour['tour_name']." </option>";
                                        }
                                        echo"</select>";
                                        //echo "<input type='text' class='form-control' name='tour_name' id='tour_name' placeholder='Enter Tour Name'>";
                                    echo "</div>
                            </div>
                            <div class='form-row align-items-center'>
                                    <div class='col-3'>
                                        <label>Date Checkin</label>
                                            <input class='form-control' type='text' name='datefilter' id='datefilter' value='".$dateNow."' style='height:2%;'/>
                                    </div>
                                    <div class='col-3'>
                                        <label>Date Checkout</label>
                                            <input class='form-control' type='text' name='datefilter2' id='datefilter2' value='".$dateNow."' style='height:2%;'/>
                                    </div>
                                    <div class='col-3'>
                                        <label>Date Limit Bayar</label>
                                            <input class='form-control' type='text' name='datefilter3' id='datefilter3' value='".$dateNow."' style='height:2%;'/>
                                    </div>
                                    <div class='col-3'>
                                        <label>Date Limit Batal</label>
                                            <input class='form-control' type='text' name='datefilter4' id='datefilter4' value='".$dateNow."' style='height:2%;'/>
                                    </div>
                              </div>
                              <div class='form-row align-items-center'>
                                     <div class='col-3'>
                                        <label>Hotel Name</label>
                                            <input type='text' class='form-control' name='hotel_name' id='hotel_name' placeholder='Enter Hotel Name'>
                                    </div>
                                     <div class='col-3'>
                                        <label>Hotel Address</label>
                                            <input type='text' class='form-control' name='hotel_address' id='hotel_address' placeholder='Enter Hotel Address'>
                                    </div>

                                    <div class='col-3'>
                                        <label>Hotel City</label>
                                        <select class='chosen' name='city' id='city' class='form-control'>
                                        <option selected='selected' value=0>City</option>";

                                        while($row_city = mysqli_fetch_array($rs_city)){
                                          echo "<option value='".$row_city['name']."'>".$row_city['name']."</option>";
                                        }
                                        echo"</select>
                                    </div>
                                    <div class='col-3'>
                                        <label>Hotel Country</label>
                                            <select class='chosen' name='country' id='country' class='form-control'>
                                        <option selected='selected' value=0>Country</option>";

                                        while($row_country = mysqli_fetch_array($rs_country)){
                                          echo "<option value='".$row_country['name']."'>".$row_country['name']."</option>";
                                        }
                                        echo"</select>
                                    </div>
                                </div>
                                <div class='form-row align-items-center'>
                                    <div class='col-4'>
                                        <label>Total Room</label>
                                            <input type='text' class='form-control' name='total_room' id='total_room' value='0' placeholder='Enter Inf Price'>
                                    </div>

                                    <div class='col-4'>
                                        <label>Tax</label>
                                            <input type='text' class='form-control' name='tax' id='tax' placeholder='Enter Tax ( ex : 10% / MYR 10 )'>
                                    </div>
                                     <div class='col-4'>
                                        <label>Total Night</label>
                                            <input type='text' class='form-control' name='total_night' id='total_night' value='0' placeholder='Enter Inf Price'>
                                    </div>

                                </div>

                                <div class='form-row align-items-center'>
                                    <div class='col-3'>
                                        <label>Price</label>
                                            <input type='text' class='form-control' name='price' id='price' placeholder='Enter Price ( ex : MYR 10 / IDR 100000)'>
                                    </div>
                                   
                                    <div class='col-3'>
	                                    <label>Payment Type</label>
		                                    <select class='chosen' name='paymenttype' id='paymenttype' style='width: 100%;'>
			                                    <option value='Debit'>Debit</option>
			                                    <option value='Credit'>Credit</option>
			                                    <option value='Transfer'>Transfer</option>
			                                    <option value='Cash'>Cash</option>
		                                    </select>
                                    </div>
                                    <div class='col-3'>
                                        <label>Bank</label>
                                         <select class='chosen' name='bank' id='bank' class='form-control'>
                                        <option selected='selected' value=0>Bank</option>";

                                        while($row_bank = mysqli_fetch_array($rs_bank)){
                                          echo "<option value='".$row_bank['id']."'>".$row_bank['short']." ( ".$row_bank['nama']." )</option>";
                                        }
                                        echo"</select>";
                                    echo "</div>
                                     <div class='col-3'>
                                        <label>Status</label>
                                            <select class='chosen' name='status' id='status' style='width: 100%;'>
                                                    <option selected='selected' value=0>Pilihan</option>
                                                    <option value='INC BF'>INC BF</option>
                                                    <option value='NO BF'>NO BF</option>
                                                </select>
                                    </div>

                                </div>
                                <div class='form-row align-items-center'>
                                    <div class='col-4'>
                                        <label>Size</label>
                                            <input type='text' class='form-control' name='size' id='size' placeholder='Enter Size (cth : 16 m²/194 ft²)'>
                                    </div>

                                    <div class='col-4'>
                                        <label>Type Room</label>
                                            <input type='text' class='form-control' name='type_room' id='type_room' placeholder='Enter Type Room ( ex : Double Room )'>
                                    </div>

                                    <div class='col-4'>
                                        <label>Type Bed</label>
                                            <input type='text' class='form-control' name='type_bed' id='type_bed' placeholder='Enter Type Bed ( ex : Double Bed )'>
                                    </div>
                                    

                                </div>
                            <div id='divGroup'>
                            
                            </div>
                            ";
                            
                            echo "<center></br><button type='button' class='btn btn-primary' id='but_upload'>Submit</button></center> </div>";
              echo "</div></div>
              <!-- /.card-header -->

              <div class='container-fluid'>";
            

                $query = "SELECT * FROM hotel ORDER BY unique_code ASC";
                $rs=mysqli_query($con,$query);
                


                echo "<table id='dtBasicExample' class='tableFixHead table-bordered table-sm' style='font-size:14px;'>
                <thead>
                <tr>
                <th width='3%'>Unique Code</th>
                <th width='3%'>Guest Name</th>
                <th width='3%'>Date CheckIn</th>
                <th width='3%'>Date Checkout</th>
                <th width='3%'>Date Limit Bayar</th>
                <th width='3%'>Date Limit Batal(Gratis)</th>
                <th width='2%'>Booking ID</th>
                <th width='2%'>City</th>
                <th width='2%'>Country</th>
                <th width='10%' colspan='2'>Hotel Name</th>
                <th width='10%' colspan='2'>Address</th>
                <th width='2%'>Total Room</th>
                <th width='2%'>Type Room</th>
                <th width='2%'>Tax</th>
                <th width='2%'>Total All Night</th>
                <th width='2%'>Price / Night No Tax</th>
                <th width='2%'>Total</th>
                <th width='2%'>Bank</th>
                <th width='5%'>Total Dibayarkan Customer</th>
                <th width='5%'>Kekurangan Pembayaran Customer</th>
                <th width='5%'>Total Dibayarkan ke Supplier</th>
                <th width='5%'>Kekurangan Pembayaran Supplier</th>
                <th width='2%'>Total Room</th>
                <th width='2%'>Status</th>
                <th width='2%'>Size</th>
                <th width='2%'>Type Bed</th>
                <th width='2%'>Staff</th>
                <th width='1%'>Option</th>
                </tr>
                </thead>
                <tbody id='myTable'>";

                $grandtotalprice = 0;
                $grandtotalsellingprice = 0;
                $grandadt = 0;
                $grandchd = 0;
                $grandinf = 0;
                $grandtotallabakotor = 0;
                $grandtotalDibayarkan = 0;
                $grandtotalKekurangan = 0;
                $grandtotalDibayarkanSupplier = 0;
                $grandtotalKekuranganSupplier = 0;
                $grandtotalStaffCom = 0;
               
                while($row=mysqli_fetch_array($rs)){
                $totalprice = 0;
                $totalsellingprice = 0;

                $querydetailpayment = "SELECT * FROM payment_detail_performaflight WHERE invoice_id=".$row['id'];
                $rsdetailpayment = mysqli_query($con,$querydetailpayment);
                $totaldibayarkansupplier = 0;
                $totalkekurangansupplier = 0;
                $total_pembayaran = 0;

                

                $query_customer = "SELECT * FROM customer_list WHERE id=".$row['customer_id'];
                $rs_customer=mysqli_query($con,$query_customer);
                $row_customer = mysqli_fetch_array($rs_customer);

                $query_bank = "SELECT * FROM bank WHERE id=".$row['bank'];
                $rs_bank=mysqli_query($con,$query_bank);
                $row_bank = mysqli_fetch_array($rs_bank);

                $kurs_price = substr($row['price'],0,3);
                $price = substr($row['price'],4,strlen($row['price']));

                $kurs_tax = substr($row['tax'],0,3);

                if($kurs_price=='IDR'){
                	$price_value = (int)$price * 1;
                }else{
                	$query_kurs = "SELECT * FROM kurs_live WHERE name LIKE '".$kurs_price."'";
                	$rs_kurs=mysqli_query($con,$query_kurs);
                	$row_kurs = mysqli_fetch_array($rs_kurs);

                	$price_value = (int)$price * (int)$row_kurs['jual'];
                }

                $query_kurscek = "SELECT COUNT(*) as total FROM kurs_live WHERE name LIKE '".$kurs_tax."'";
                $rs_kurscek=mysqli_query($con,$query_kurscek);
                $row_kurscek = mysqli_fetch_assoc($rs_kurscek);

                if($row_kurscek['total']>0){
                	$query_kurs2 = "SELECT * FROM kurs_live WHERE name LIKE '".$kurs_tax."'";
                	$rs_kurs2=mysqli_query($con,$query_kurs2);
                	$row_kurs2 = mysqli_fetch_array($rs_kurs2);
                	$tax_price = substr($row['tax'],4,strlen($row['tax']));
                	$totaltax = $row_kurs2['jual'] * (int)$tax_price;
                }else{
                	$tax_price = substr($row['tax'],0,-1);
                	$totaltax = (int)$tax_price * (int)$price / 100;

                }

                

                $totalprice = $totalprice + ($row['total_room']*$price_value) + (int)$totaltax;

                echo "<tr style='font-weight:bold;color:black'>";
                echo "<td nowrap>".$row['unique_code']."</td>";
                echo "<td nowrap>".$row_customer['customer_name']."</td>";
                echo "<td>".$row['date_checkin']."</td>";
                echo "<td>".$row['date_checkout']."</td>";
                echo "<td>".$row['date_limit_bayar']."</td>";
                echo "<td>".$row['date_limit_pembatalan']."</td>";
                echo "<td nowrap>".$row['booking_id']."</td>";
                echo "<td>".$row['city']."</td>";
                echo "<td>".$row['country']."</td>";
                echo "<td colspan='2'>".$row['hotel_name']."</td>";
                echo "<td colspan='2'>".$row['hotel_address']."</td>";
                echo "<td>".$row['total_room']."</td>";
                echo "<td>".$row['type_room']."</td>";
                echo "<td>".$row['tax']."</td>";
                echo "<td>".$row['total_night']."</td>";


                echo "<td>Rp ".number_format($price_value, 0, ".", ".")."</td>";
                echo "<td>Rp ".number_format($totalprice, 0, ".", ".")."</td>";
                echo "<td>".$row_bank['nama']."</td>";
                echo "<td>Rp ".number_format($totaldibayarkan, 0, ".", ".")."</br>
                  ".$row['payment']."</br>
                  <button type='submit' onclick='insertPayment(3,".$row['id'].",0)' class='btn btn-success'><i class='fa fa-plus'></i></button></br></br>
                  <button onclick='reloadPayment(4,".$row['id'].",0)' class='btn btn-primary' style='font-size:11px;'>Cek</button></td>
                  
                  <td>Rp ".number_format($totalkekurangan, 0, ".", ".")."</td>";
                  if($totaldibayarkansupplier==0 && $totalkekurangansupplier==0){
                    echo "<td><i class='fa fa-times' aria-hidden='true'></i></br>Rp ".number_format($totaldibayarkansupplier, 0, ".", ".")." </br>";
                  }else{
                    echo "<td>Rp ".number_format($totaldibayarkansupplier, 0, ".", ".")."</br>";
                  }
                  echo "<button type='submit' onclick='insertPayment(-7,".$row['id'].",0)' class='btn btn-success'><i class='fa fa-plus'></i></button></br></br>
                  <button onclick='reloadPayment(-4,".$row['id'].",0)'  class='btn btn-primary' style='font-size:11px;'>Cek</button></td>
                  <td>Rp ".number_format($totalkekurangansupplier, 0, ".", ".")."</td>";
                echo "<td>-</td>";
                echo "<td nowrap>".$row['status']."</td>";
                echo "<td>".$row['size']."</td>";
                echo "<td>".$row['type_bed']."</td>";
                  if($row['staff_id']!=''){
                    $querystaff = "SELECT * FROM login_staff WHERE id=".$row['staff_id'];
                    $rsstaff = mysqli_query($con,$querystaff);
                    $rowstaff = mysqli_fetch_array($rsstaff);
                    echo "<td>".$rowstaff['name']."</br></br>
                    Rp ".number_format($row['staff_com'], 0, ".", ".")."</td>";
                  }else{
                    echo "<td>-</td>";
                  }
                  echo "<td><button type='button' class='btn btn-warning' onclick='editButton(".$row['id'].")'><i class='fa fa-edit' aria-hidden='true''></i></button></td>
                  </tr>";
                }
                  
          
              

                echo "
                </tbody>
                </table>

              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
</div>";
?>

<script>
 var availableTags = [];
 var availableTags2 = [];
  $(document).ready(function(){
    $(".chosen").chosen();

    $('input[name="datefilter"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });
    $('input[name="datefilter2"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });
    $('input[name="datefilter3"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });
    $('input[name="datefilter4"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });

   $("#but_upload").click(function(){
      var fd = new FormData();
      const monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN",
      "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"
      ];


      var uniquecode = document.getElementById("uniquecode").options[document.getElementById("uniquecode").selectedIndex].value;
      var hotel_type = document.getElementById("hotel_type").options[document.getElementById("hotel_type").selectedIndex].value;
      var guest_name = document.getElementById("customer").options[document.getElementById("customer").selectedIndex].value;
      var booking_id = $("input[name=booking_id]").val();
      var hotel_name = $("input[name=hotel_name]").val();
      var tour_name = document.getElementById("tourpackage").options[document.getElementById("tourpackage").selectedIndex].value;
      //var tour_name = $("input[name=tour_name]").val();
      var hotel_address = $("input[name=hotel_address]").val();
      var city = document.getElementById("city").options[document.getElementById("city").selectedIndex].value;
      var country = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;
      var total_room = $("input[name=total_room]").val();
      var tax = $("input[name=tax]").val();
      var total_night = $("input[name=total_night]").val();
      var price = $("input[name=price]").val();
      var status = document.getElementById("status").options[document.getElementById("status").selectedIndex].value;
      var paymenttype = document.getElementById("paymenttype").options[document.getElementById("paymenttype").selectedIndex].value;
      var bank = document.getElementById("bank").options[document.getElementById("bank").selectedIndex].value;
      var size = $("input[name=size]").val();
      var type_room = $("input[name=type_room]").val();
      var type_bed = $("input[name=type_bed]").val();

      var date=new Date($('input[name="datefilter"]').val());
      var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
      var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
      var year = date.getFullYear();

      var date2=new Date($('input[name="datefilter2"]').val());
      var month2 = ((date2.getMonth()+1)<10) ? "0" + (date2.getMonth()+1) : (date2.getMonth()+1);
      var day2 = (date2.getDate() < 10) ? "0" + date2.getDate() : date2.getDate();
      var year2 = date2.getFullYear();

      var date3=new Date($('input[name="datefilter3"]').val());
      var month3 = ((date3.getMonth()+1)<10) ? "0" + (date3.getMonth()+1) : (date3.getMonth()+1);
      var day3 = (date3.getDate() < 10) ? "0" + date3.getDate() : date3.getDate();
      var year3 = date3.getFullYear();

      var date4=new Date($('input[name="datefilter4"]').val());
      var month4 = ((date4.getMonth()+1)<10) ? "0" + (date4.getMonth()+1) : (date4.getMonth()+1);
      var day4 = (date4.getDate() < 10) ? "0" + date4.getDate() : date4.getDate();
      var year4 = date4.getFullYear();

      var tdate = year + "-" + month + "-" + day;
      var tdate2 = year2 + "-" + month2 + "-" + day2;
      var tdate3 = year3 + "-" + month3 + "-" + day3;
      var tdate4 = year4 + "-" + month4 + "-" + day4;


      fd.append('uniquecode',uniquecode);
      fd.append('hotel_type',hotel_type);
      fd.append('guest_name',guest_name);
      fd.append('booking_id',booking_id);
      fd.append('hotel_name',hotel_name);
      fd.append('tour_name',tour_name);
      fd.append('hotel_address',hotel_address);
      fd.append('city',city);
      fd.append('country',country);
      fd.append('total_room',total_room);
      fd.append('tax',tax);
      fd.append('total_night',total_night);
      fd.append('price',price);
      fd.append('status',status);
      fd.append('payment_type',paymenttype);
      fd.append('bank',bank);
      fd.append('size',size);
      fd.append('type_room',type_room);
      fd.append('type_bed',type_bed);
      fd.append('date_checkin',tdate);
      fd.append('date_checkout',tdate2);
      fd.append('date_limit_bayar',tdate3);
      fd.append('date_limit_pembatalan',tdate4);

      $.ajax({
        url: 'insertHotel.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
          if(response=="success"){
            alert(response);
            reloadManual(3,0,0);
          }else{
            alert(response);
          }

        },
      });

      
    });

    $('#type').on('change', function() {
      var count = this.value;
     
        $.ajax({
          type:'POST',
          url:'getFlight.php',
          data:{'count':count},
          success:function(data){
           $('#googleflight').html(data);
           $("input[name=tb]").val(0);
           $("input[name=tp]").val(0);
         }
       });
      

    });


  });
	
 function inputCustomer(x,y){
   $.ajax({
          type:'POST',
          url:'seeInputCustomerFlight.php',
          data:{'id':y},
          success:function(data){
           $('#divCustomer'+y).html(data);
         }
       });
  }
  function closeDetail(x,y){
    $('#divDetail'+y).html('');
  }
  function seeDetail(x,y){
   $.ajax({
          type:'POST',
          url:'seeDetailFlight.php',
          data:{'id':y},
          success:function(data){
           $('#divDetail'+y).html(data);
         }
       });
  }

    function editButton(x){
      var fd = new FormData();
      var profit = $("input[name=profit]").val();
      var bagasi = $("input[name=bagasi]").val();
      var meal = $("input[name=meal]").val();
      fd.append('profit',profit);
      fd.append('bagasi',bagasi);
      fd.append('meal',meal);
      fd.append('id',x);

      
       $.ajax({
        url: 'updateProfitFlight.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
         if(response=="success"){
          alert(response);
        }

      },
    });
   }

  function seeInput(y){
    var x = document.getElementById("divInput");
    if(y==0){
       x.style.display = "none";
    }else{
       x.style.display = "block";
    }
  }

  $('#flight_type').on('change', function() {
    if(this.value=='FIT'){
      var x = document.getElementById("divGroup");
      x.style.display = "none";
    }else{
     var x = document.getElementById("divGroup");
     x.style.display = "block";
   }
 });

  function getTransit(x){
    if(x==1){
       var count = $("input[name=tb]").val();
       var tempCount = parseInt($("input[name=tb]").val()) + 1;
       $.ajax({
        type:'POST',
        url:'getTransit.php',
        data:{'count':count,'tipe':x},
        success:function(data){
         $("#divberangkat").append(data);
         $("input[name=tb]").val(tempCount);
       }
     });
   }else{
      var count = $("input[name=tp]").val();
      var tempCount = parseInt($("input[name=tp]").val()) + 1;
       $.ajax({
        type:'POST',
        url:'getTransit.php',
        data:{'count':count,'tipe':x},
        success:function(data){
         $("#divpulang").append(data);
         $("input[name=tp]").val(tempCount);
       }
     });
    }

    //alert($("input[name=tb]").val());

   // $("#divberangkat").appendChild("<td>asd</td>");
  }
  function getFrom(x){

    $.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
         var i=0;
         availableTags = [];
         for(i=0;i<data.length;i++){
            availableTags[i]=data[i].PlaceName + " ( "+ data[i].CountryName +" ) " + " - " + data[i].PlaceId;
        }
      
    });



    $( "#tags" ).autocomplete({
          source: availableTags
        });

  }

  function getTo(x){

    $.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
         var i=0;
         availableTags2 = [];
         for(i=0;i<data.length;i++){
            availableTags2[i]=data[i].PlaceName + " - " + data[i].PlaceId;
        }
      
    });



    $( "#tags2" ).autocomplete({
          source: availableTags2
        });

  }
  function getFrom2(x){

    $.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
      var i=0;
      availableTags3 = [];
      for(i=0;i<data.length;i++){
        availableTags3[i]=data[i].PlaceName + " ( "+ data[i].CountryName +" ) " + " - " + data[i].PlaceId;
      }
      
    });



    $( "#tags3" ).autocomplete({
      source: availableTags3
    });

  }

  function getTo2(x){

    $.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
      var i=0;
      availableTags4 = [];
      for(i=0;i<data.length;i++){
        availableTags4[i]=data[i].PlaceName + " - " + data[i].PlaceId;
      }
      
    });



    $( "#tags4" ).autocomplete({
      source: availableTags4
    });

  }    
  function delPaymentDetail(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delStaff.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadPage(-3,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

