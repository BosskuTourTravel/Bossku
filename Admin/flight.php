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

$query_flight = "SELECT * FROM flight_quotation";
$rs_flight=mysqli_query($con,$query_flight);
while($row_flight = mysqli_fetch_array($rs_flight)){


 $temp_kurs_price = $row_flight['kurs_price'];
 $temp_adt_price = $row_flight['adt_price'];
 $temp_chd_price = $row_flight['chd_price'];
 $temp_inf_price = $row_flight['inf_price'];
 $temp_kurs_tax = $row_flight['kurs_tax'];
 $temp_adt_tax = $row_flight['adt_tax'];
 $temp_chd_tax = $row_flight['chd_tax'];
 $temp_inf_tax = $row_flight['inf_tax'];
 echo "<input type='text' name='tkurs_price".$row_flight['id']."' id='tkurs_price".$row_flight['id']."' value='".$temp_kurs_price."' hidden>";
 echo "<input type='text' name='tadt_price".$row_flight['id']."' id='tadt_price".$row_flight['id']."' value='".$temp_adt_price."' hidden>";
 echo "<input type='text' name='tchd_price".$row_flight['id']."' id='tchd_price".$row_flight['id']."' value='".$temp_chd_price."' hidden>";
 echo "<input type='text' name='tinf_price".$row_flight['id']."' id='tinf_price".$row_flight['id']."' value='".$temp_inf_price."' hidden>";
 echo "<input type='text' name='tkurs_tax".$row_flight['id']."' id='tkurs_tax".$row_flight['id']."' value='".$temp_kurs_tax."' hidden>";
 echo "<input type='text' name='tadt_tax".$row_flight['id']."' id='tadt_tax".$row_flight['id']."' value='".$temp_adt_tax."' hidden>";
 echo "<input type='text' name='tchd_tax".$row_flight['id']."' id='tchd_tax".$row_flight['id']."' value='".$temp_chd_tax."' hidden>";
 echo "<input type='text' name='tinf_tax".$row_flight['id']."' id='tinf_tax".$row_flight['id']."' value='".$temp_inf_tax."' hidden>";

}

$queryairlines = "SELECT * FROM airlines";
$rsairlines=mysqli_query($con,$queryairlines);

$querytype = "SELECT * FROM flight_type";
$rstype=mysqli_query($con,$querytype);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>Flight</h3>
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
                                <div class='col-12'>
                                            <label>Flight Invoice</label>
                                                <select class='chosen' name='flight_invoice' id='flight_invoice' style='width: 100%;'>
                                                    <option selected='selected' value=0>Pilihan</option>";
                                                    $query_flightquotation = "SELECT * FROM flight_quotation";
                                                    $rs_flightquotation=mysqli_query($con,$query_flightquotation);
                                                    while($row_flightquotation = mysqli_fetch_array($rs_flightquotation)){
                                                      $query_airlinesX = "SELECT * FROM airlines WHERE id=".$row_flightquotation['airlines_id'];
                                                      $rs_airlinesX=mysqli_query($con,$query_airlinesX);
                                                      $row_airlinesX = mysqli_fetch_array($rs_airlinesX);
                                                      $tempId = $row_flightquotation['id'] + 20000;
                                                      echo "<option value='".$row_flightquotation['id']."'>".$tempId." - ".$row_airlinesX['nama']." ( ".$row_flightquotation['type']." ) ".$row_flightquotation['destination_from']."".$row_flightquotation['destination_to']." * Rp ".$row_flightquotation['adt_price']."</option>";
                                                    }
                                                        
                                    echo"</select>
                                        </div>
                              </div> 
                              <div class='form-row align-items-center'> 
                                   <div class='col-3'>
                                            <label>Flight Type</label>
                                                <select class='chosen' name='flight_type' id='flight_type' style='width: 100%;'>
                                                    <option selected='selected' value=0>Pilihan</option>";
                                                    while($rowtype = mysqli_fetch_array($rstype)){
                                                      echo "<option value='".$rowtype['nama']."'>".$rowtype['nama']."</option>";
                                                    }
                                                        
                                    echo"</select>
                                        </div>
                                        <div class='col-3'>
                                            <label>Flight Category</label>
                                                <select class='chosen' name='flight_category' id='flight_category' style='width: 100%;'>
                                                    <option selected='selected' value=0>Pilihan</option>";
                                                      echo "<option value='Low Cost Carrier'>Low Cost Carrier</option>";
                                                      echo "<option value='Low Cost Carrier'>Full Service Airline</option>";
                                                        
                                    echo"</select>
                                        </div>
                                     <div class='col-3'>
                                            <label>Airlines</label>
                                                <select class='chosen' name='airlines' id='airlines' style='width: 100%;'>
                                                    <option selected='selected' value=0>Pilihan</option>";
                                                    while($rowairlines = mysqli_fetch_array($rsairlines)){
                                                      echo "<option value='".$rowairlines['id']."'>".$rowairlines['nama']." ( ".$rowairlines['kode']." )</option>";
                                                    }
                                                        
                                    echo"</select>
                                        </div>

                                    <div class='col-3'>
                                        <label>PNR</label>
                                            <input type='text' class='form-control' name='pnr' id=pnr' placeholder='Enter PNR'>
                                    </div>
                                    

                            </div>
                            <div class='form-row align-items-center'>
                                    <div class='col-4'>
                                        <label>Adt Pax</label>
                                            <input type='text' class='form-control' name='adt_pax' id='adt_pax' value='0' placeholder='Enter Adt Pax'>
                                    </div>
                                    <div class='col-4'>
                                        <label>Chd Pax</label>
                                            <input type='text' class='form-control' name='chd_pax' id='chd_pax' value='0' placeholder='Enter Chd Pax'>
                                    </div>
                                    <div class='col-4'>
                                        <label>Inf Pax</label>
                                            <input type='text' class='form-control' name='inf_pax' id='inf_pax' value='0' placeholder='Enter Inf Pax'>
                                    </div>
                                    <div class='col-3'>
                                        <label>Kurs</label></br>";
                                        $query_kurs = "SELECT * FROM kurs_bank";
                                        $rs_kurs=mysqli_query($con,$query_kurs);
                                       
                                        echo "<select class='chosen' name='kurs_price' id='kurs_price' style='width: 100%;'>
                                        <option selected='selected' value=0>Pilihan</option>";
                                        while( $row_kurs = mysqli_fetch_array($rs_kurs)){
                                        	if($row_kurs['name']=='IDR'){
                                        		echo "<option selected='selected' value='".$row_kurs['name']."'>".$row_kurs['name']."</option>";
                                        	}else{
                                        		echo "<option value='".$row_kurs['name']."'>".$row_kurs['name']."</option>";
                                        	}
                                        }

                                        echo"</select>";
                                    echo "</div>
                                    <div class='col-3'>
                                        <label>Buy Adt Price</label>
                                            <input type='text' class='form-control' name='adt_price' id='adt_price' value='0' placeholder='Enter Adt Price'>
                                    </div>
                                     <div class='col-3'>
                                        <label>Buy Chd Price</label>
                                            <input type='text' class='form-control' name='chd_price' id='chd_price' value='0' placeholder='Enter Chd Price'>
                                    </div>
                                     <div class='col-3'>
                                        <label>Buy Inf Price</label>
                                            <input type='text' class='form-control' name='inf_price' id='inf_price' value='0' placeholder='Enter Inf Price'>
                                    </div>

                                    
                                    <div class='col-3'>
                                        <label>Kurs</label></br>";
                                        $query_kurs = "SELECT * FROM kurs_bank";
                                        $rs_kurs=mysqli_query($con,$query_kurs);
                                       
                                        echo "<select class='chosen' name='kurs_tax' id='kurs_tax' style='width: 100%;'>";
                                        while( $row_kurs = mysqli_fetch_array($rs_kurs)){
                                        	if($row_kurs['name']=='IDR'){
                                        		echo "<option selected='selected' value='".$row_kurs['name']."'>".$row_kurs['name']."</option>";
                                        	}else{
                                        		echo "<option value='".$row_kurs['name']."'>".$row_kurs['name']."</option>";
                                        	}
                                        }

                                        echo"</select>";
                                    echo "</div>
                                    <div class='col-3'>
                                        <label>Tax Adt Price</label>
                                            <input type='text' class='form-control' name='tax_adt_price' id='tax_adt_price' value='0' placeholder='Enter Tax Adt Price'>
                                    </div>
                                     <div class='col-3'>
                                        <label>Tax Chd Price</label>
                                            <input type='text' class='form-control' name='tax_chd_price' id='tax_chd_price' value='0' placeholder='Enter Tax Chd Price'>
                                    </div>
                                     <div class='col-3'>
                                        <label>Tax Inf Price</label>
                                            <input type='text' class='form-control' name='tax_inf_price' id='tax_inf_price' value='0' placeholder='Enter Tax Inf Price'>
                                    </div>

                                    <div class='col-4'>
                                        <label>Selling Adt Price</label>
                                            <input type='text' class='form-control' name='selling_adt_price' id='selling_adt_price' value='0' placeholder='Enter Adt Price'>
                                    </div>
                                     <div class='col-4'>
                                        <label>Selling Chd Price</label>
                                            <input type='text' class='form-control' name='selling_chd_price' id='selling_chd_price' value='0' placeholder='Enter Chd Price'>
                                    </div>
                                     <div class='col-4'>
                                        <label>Selling Inf Price</label>
                                            <input type='text' class='form-control' name='selling_inf_price' id='selling_inf_price' value='0' placeholder='Enter Inf Price'>
                                    </div>

                            </div>
                            <div id='divGroup'>
                            <div class='form-row align-items-center'>
                                  <div class='col-4'>
                                        <label>Deposit Total Pax</label>
                                            <input type='text' class='form-control' name='deposit_total_pax' id=deposit_total_pax' value='0' placeholder='Enter Deposit Total Pax'>
                                    </div>
                                    <div class='col-4'>
                                        <label>Deposit Pax Amount</label>
                                            <input type='text' class='form-control' name='deposit_pax_amount' id=deposit_pax_amount' value='0' placeholder='Enter Deposit Amount Pax'>
                                    </div>
                                    
                                    <div class='col-4'>
                                        <label>Total Seat</label>
                                            <input type='text' class='form-control' name='total_seat' id=total_seat' value='0' placeholder='Enter Total Seat'>
                                    </div>

                            </div>
                            <div class='form-row align-items-center'>
                                    <div class='col-4'>
                                        <label>Date Limit Deposit</label>
                                            <input class='form-control' type='text' name='datefilterx' id='datefilterx' value='".$dateNow."' style='height:2%;'/>
                                    </div>
                                   
                                    <div class='col-4'>
                                        <label>Date Confirmed</label>
                                            <input class='form-control' type='text' name='datefilterx3' id='datefilterx3' value='".$dateNow."' style='height:2%;'/>
                                    </div>
                                    <div class='col-4'>
                                         <label>Date Limit Issued</label>
                                            <input class='form-control' type='text' name='datefilterx2' id='datefilterx2' value='".$dateNow."' style='height:2%;'/>
                                    </div>

                            </div>

                            <div class='form-row align-items-center'>
                                    <div class='col-4'>
                                        <label>Penalty Pax</label>
                                            <input type='text' class='form-control' name='penalty_pax' id=penalty_pax' value='0' placeholder='Enter Penalty Pax'>
                                    </div>
                                    <div class='col-4'>
                                        <label>Status Penalty</label>
                                           <select class='chosen' name='status_penalty' id='status_penalty' style='width: 100%;'>
                                              <option value='0'>Tidak Hangus</option>
                                              <option value='1'>Hangus</option>
                                          </select>
                                    </div>
                                    <div class='col-4'>
                                        <label>Adm Penalty</label>
                                            <input type='text' class='form-control' name='adm_penalty' id=adm_penalty' value='0' placeholder='Enter Adm Penalty'>
                                    </div>

                                    <div class='col-4'>
                                        <label>Tour Name</label>
                                            <input type='text' class='form-control' name='tour_name' id=tour_name' placeholder='Enter Tour Name'>
                                    </div>


                            </div>
                            </div>
                             <div class='form-row align-items-center'>
                               <div class='col-4'>
                                 <label>From</label>
                                 <input class='form-control' type='text' onkeyup='getFromX(this.value,7)' name='tags7' id='tags7' style='height:2%;'/>
                                 
                               </div>
                               <div class='col-4'>
                                 <label>To</label>
                                 <input class='form-control' type='text' onkeyup='getFromX(this.value,8)' name='tags8' id='tags8' style='height:2%;'/>
                               </div>
                             </div>


                            ";
                            echo "<input type='text' name='tb' id='tb' value=0 hidden>";
                            echo "<input type='text' name='tp' id='tp' value=0 hidden>";
                            echo "<table class='table' style='margin-top:1%;margin-left:1%;'>
                                  <tr>
                                  <td>
                                                <select class='chosen' name='type' id='type'>";
                                                    echo "<option value='0'>...</option>";
                                                    echo "<option selected='selected' value='1'>Round Trip</option>";
                                                    echo "<option value='2'>One Way</option>";
                                                    echo "<option value='3'>Multi City</option>";
                                                    
                                                        
                                    echo"</select>
                                    </td></tr>
                                    </table>";
                                    

                                    echo "<div id='googleflight' name='googleflight'>
                                    <table class='table class='table-striped table-bordered table-sm' style='margin-top:1%;margin-left:1%;'>
                                    <tr>
                                    
                                    <td>
                                     <div>
                                        <label>Depart</label>
                                            <input class='form-control' type='text' name='datefilter3' id='datefilter3' value='".$dateNow."' style='height:2%;'/>
                                    </div>
                                    </td>
                                   
                                    <td>
                                    <div>
                                    <label>Airlines</label>";
                                    $queryairlines = "SELECT * FROM airlines";
                                    $rsairlines=mysqli_query($con,$queryairlines);
                                    echo "<select class='chosen' name='airlines_pil' id='airlines_pil' style='width: 100%;'>
                                    <option selected='selected' value=0>Pilihan</option>";
                                    while($rowairlines = mysqli_fetch_array($rsairlines)){
                                      echo "<option value='".$rowairlines['kode']."'>".$rowairlines['nama']." ( ".$rowairlines['kode']." )</option>";
                                    }

                                    echo"</select>

                                    </div>
                                    </td>
                                    <td>
                                    <div>
                                      <label>Code Airlines</label>
                                        <input class='form-control' type='text' name='code_airlines' id='code_airlines' value='' style='height:2%;'/>
                                    </div>
                                    </td>
                                    <td>
                                    <div>
                                        <label>From</label>
                                            <input class='form-control' type='text' onkeyup='getFrom(this.value)' name='tags' id='tags' value='".$dateNow."' style='height:2%;'/>
                                    </div>
                                    </td>
                                    <td>
                                    <div>
                                        <label>To</label>
                                            <input class='form-control' type='text' onkeyup='getTo(this.value)' name='tags2' id='tags2' value='".$dateNow."' style='height:2%;'/>
                                    </div>
                                    </td>
                                    <td>
                                    <div>
                                        <label>Time</label>
                                            <input class='form-control' type='text' name='time' id='time' value=' 00:00 - 00:00' style='height:2%;'/>
                                    </div>
                                    </td>
                                    <td>
                                    <i class='fa fa-plus' style='color:green;margin-top:2%;position:absolute;text-align: center;' onclick='getTransit(1)' aria-hidden='true'></i>
                                    </td>
                                    </tr>
                                    <td colspan='7'>
                                    <div id='divberangkat'>
                                   
                                    </div>
                                    </td>
                                    <tr>

                                   
                                    <td>
                                    <div>
                                      <label>Return</label>
                                        <input class='form-control' class='form-control' type='text' name='datefilter6' id='datefilter6' value='".$dateNow."' style='height:2%;'/>
                                    </div>
                                    </td>
                                    <td>
                                    <div>
                                      <label>Airlines</label>";
                                        $queryairlines = "SELECT * FROM airlines";
                                        $rsairlines=mysqli_query($con,$queryairlines);
                                        echo "<select class='chosen' name='airlines_pil2' id='airlines_pil2' style='width: 100%;'>
                                        <option selected='selected' value=0>Pilihan</option>";
                                        while($rowairlines = mysqli_fetch_array($rsairlines)){
                                          echo "<option value='".$rowairlines['kode']."'>".$rowairlines['nama']." ( ".$rowairlines['kode']." )</option>";
                                        }

                                        echo"</select>

                                    </div>
                                    </td>
                                    <td>
                                    <div>
                                      <label>Code Airlines</label>
                                        <input class='form-control' type='text' name='code_airlines2' id='code_airlines2' value='' style='height:2%;'/>
                                    </div>
                                    </td>
                                    <td>
                                    <div>
                                        <label>From</label>
                                          <input class='form-control' type='text' onkeyup='getFrom2(this.value)' name='tags3' id='tags3' value='".$dateNow."' style='height:2%;'/>
                                    </div>
                                    </td>
                                    <td>
                                    <div >
                                      <label>To</label>
                                        <input class='form-control' type='text' onkeyup='getTo2(this.value)' name='tags4' id='tags4' value='".$dateNow."' style='height:2%;'/>
                                    </div>
                                    </td>
                                    <td>
                                    <div>
                                      <label>Time</label>
                                        <input class='form-control' type='text' name='time2' id='time2' value=' 00:00 - 00:00' style='height:2%;'/>
                                    </div>
                                    </td>
                                    <td>
                                    <i class='fa fa-plus' style='color:green;margin-top:2%;position:absolute;text-align: center;' onclick='getTransit(2)' aria-hidden='true'></i>
                                    </td>
                                    </tr>
                                    <td colspan='7'>
                                    <div id='divpulang'>
                                   
                                    </div>
                                    </td>
                                    </table>";
                            echo "<center></br><button type='button' class='btn btn-primary' id='but_upload'>Submit</button></center> </div>";
              echo "</div></div>
              <!-- /.card-header -->

              <div class='container-fluid'>";
            

                $query = "SELECT * FROM flight ORDER BY invoice_type,id ASC";
                $rs=mysqli_query($con,$query);
                


                echo "<table id='dtBasicExample' class='tableFixHead table-striped table-bordered table-sm' style='font-size:14px;'>
                <thead>
                <tr>
                <th width='2%'>Flight Type / </br>
                Category</th>
                <th width='2%'>Airlines</th>
                <th width='2%'>PNR</th>
                <th width='5%'>Tour Name</br>
                ( Customer Name )</th>
                <th width='10%' colspan='2'>Detail Flight</th>
                <th width='1%'>adt</th>
                <th width='1%'>chd</th>
                <th width='1%'>inf</th>
                <th width='5%'>Sell Buy Adt Price</th>
                <th width='5%'>Sell Buy Chd Price</th>
                <th width='5%'>Sell Buy Inf Price</th>
                <th width='5%'>Bagasi Meal</th>
                <th width='5%'>Sell Buy Total</th>
                <th width='5%'>Total Dibayarkan Customer</th>
                <th width='5%'>Kekurangan Pembayaran Customer</th>
                <th width='5%'>Total Dibayarkan ke Supplier</th>
                <th width='5%'>Kekurangan Pembayaran Supplier</th>
                <th width='5%'>Laba Kotor</th>
                <th width='2%'>Date Limit Deposit</th>
                <th width='2%'>Date Limit Issued</th>
                <th width='2%'>Date Confirmed</th>
                <th width='5%'>Profit</th>
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

                $totalprice = $totalprice + ($row['adt']*($row['adt_price']+$row['adt_tax']));
                $totalprice = $totalprice + ($row['chd']*($row['chd_price']+$row['chd_tax']));
                $totalprice = $totalprice + ($row['inf']*($row['inf_price']+$row['inf_tax']));
                if($row['selling_adt_price']!=0){
                	$totalsellingprice = $totalsellingprice + ($row['adt']*($row['selling_adt_price']));
                }
                if($row['selling_chd_price']!=0){
                	$totalsellingprice = $totalsellingprice + ($row['chd']*($row['selling_chd_price']));
                }
                if($row['selling_inf_price']!=0){
                	$totalsellingprice = $totalsellingprice + ($row['inf']*($row['selling_inf_price']));
                }

                $totallabakotor = $totalsellingprice - $totalprice;
                while($rowdetailpayment = mysqli_fetch_array($rsdetailpayment)){
                	if($rowdetailpayment['img_bukti_bayar']!='' OR $rowdetailpayment['bukti_pembayaran']!=''){
                		$totaldibayarkansupplier = $totaldibayarkansupplier + $rowdetailpayment['total_dibayarkan'];
                	}
                	$total_pembayaran = $rowdetailpayment['total_pembayaran'];
                }

                $querypayment = "SELECT * FROM payment_detail_flight WHERE invoice_id=".$row['id'];
                $rspayment = mysqli_query($con,$querypayment);
                $totaldibayarkan = 0;
                $totalkekurangan = 0;
                while($rowpayment = mysqli_fetch_array($rspayment)){
                	$totaldibayarkan = $totaldibayarkan + $rowpayment['payment_price'];
                }
                $totalkekurangan = $totalsellingprice - $totaldibayarkan;
                $totalkekurangan = $totalkekurangan * -1;
                $totalkekurangansupplier = $total_pembayaran - $totaldibayarkansupplier;
               
                
                if($row['status']==0){
                    echo"
                  <tr style='font-weight:bold;color:red'>";
                  }else{
                    echo"
                  <tr style='font-weight:bold;color:black'>";
                  }

                  echo "<td>".$row['invoice_type']."</br></br>
                  ".$row['invoice_category']."</td>";
                  $queryairlines = "SELECT * FROM airlines WHERE id=".$row['airlines'];
                  $rsairlines = mysqli_query($con,$queryairlines);
                  $rowairlines = mysqli_fetch_array($rsairlines);
                  echo "<td>".$rowairlines['nama']."</td>";
                  echo "<td>".$row['pnr']."</td>";
                  echo "<td>".$row['tour_name']."</br></br>";
                  if($row['customer_id']==0){
                  	echo "<button type='submit' style='font-size:8px;' onclick='inputCustomer(".$row['id'].",".$row['id'].")' class='btn btn-primary'>Customer</button></br></br>";
                  }else{
                  	$query_customer = "SELECT * FROM customer_list WHERE id=".$row['customer_id'];
                  	$rs_customer=mysqli_query($con,$query_customer);
                  	$row_customer = mysqli_fetch_array($rs_customer);

                  	echo "( ".$row_customer['customer_name']." )</br></br>";
                  }
                  
                  echo "<button type='submit' style='font-size:8px;' onclick='seeDetail(".$row['id'].",".$row['id'].")' class='btn btn-success'>Open</button> <button type='submit' style='font-size:8px;' onclick='closeDetail(".$row['id'].",".$row['id'].")' class='btn btn-danger'>Close</button></td>";
                  
                  echo "<td colspan='2' nowrap>";
                  $query_detail = "SELECT * FROM flight_detail WHERE flight_id=".$row['id'];
                  $rs_detail=mysqli_query($con,$query_detail);
                  while($row_detail = mysqli_fetch_array($rs_detail)){
                    echo $row_detail['airlines'].$row_detail['airlines_code']." ".$row_detail['flight_date']." ".$row_detail['from'].$row_detail['to']." ".$row_detail['departure_time']." ".$row_detail['arrival_time']."</br></br>";
                  }
                  echo "</td>";
                  echo "<td>".$row['adt']."</td>";
                  echo "<td>".$row['chd']."</td>";
                  echo "<td>".$row['inf']."</td>";
                  echo "<td>Rp ".number_format($row['selling_adt_price'], 0, ".", ".")." </br></br> 
                  Rp ".number_format($row['adt_price'], 0, ".", ".")."</br>";
                  echo "( Rp ".number_format($row['adt_tax'], 0, ".", ".")." )";
                  echo "</td>";
                   echo "<td>Rp ".number_format($row['selling_chd_price'], 0, ".", ".")."</br></br>
                   Rp ".number_format($row['chd_price'], 0, ".", ".")."</br>";
                  echo "( Rp ".number_format($row['chd_tax'], 0, ".", ".")." )";
                  echo "</td>";
                   echo "<td>Rp ".number_format($row['selling_inf_price'], 0, ".", ".")."</br></br>
                   Rp ".number_format($row['inf_price'], 0, ".", ".")."</br>";
                  echo "( Rp ".number_format($row['inf_tax'], 0, ".", ".")." )";
                  echo "</td>";

                  

                  echo "<td><input type='text' name='bagasi' id='bagasi' value='".$row['bagasi']."'></br>
                  <input type='text' name='meal' id='meal' value='".$row['meal']."'></td>";
                  echo "<td>Rp ".number_format($totalsellingprice, 0, ".", ".")."</br></br>
                  Rp ".number_format($totalprice, 0, ".", ".")."</td>";

                  

                  echo "<td>Rp ".number_format($totaldibayarkan, 0, ".", ".")."</br>
                  ".$row['payment']."</br>
                  <button type='submit' onclick='insertPayment(2,".$row['id'].",0)' class='btn btn-success'><i class='fa fa-plus'></i></button></br></br>
                  <button onclick='reloadPayment(3,".$row['id'].",0)' class='btn btn-primary' style='font-size:11px;'>Cek</button></td>
                  
                  <td>Rp ".number_format($totalkekurangan, 0, ".", ".")."</td>";
                  if($totaldibayarkansupplier==0 && $totalkekurangansupplier==0){
                  	echo "<td><i class='fa fa-times' aria-hidden='true'></i></br>Rp ".number_format($totaldibayarkansupplier, 0, ".", ".")." </br>";
                  }else{
                  	echo "<td>Rp ".number_format($totaldibayarkansupplier, 0, ".", ".")."</br>";
                  }
                  echo "<button type='submit' onclick='insertPayment(-5,".$row['id'].",0)' class='btn btn-success'><i class='fa fa-plus'></i></button></br></br>
                  <button onclick='reloadPayment(-3,".$row['id'].",0)'  class='btn btn-primary' style='font-size:11px;'>Cek</button></td>
                  <td>Rp ".number_format($totalkekurangansupplier, 0, ".", ".")."</td>";

                  echo "<td>Rp ".number_format($totallabakotor, 0, ".", ".")."</td>";

                  // if($row['country']==0){
                  //   echo "<td>-</td>";
                  // }else{
                  //   echo "<td>".$row['country']."</td>";
                  // }
                  // if($row['city']==0){
                  //   echo "<td>-</td>";
                  // }else{
                  //   echo "<td>".$row['city']."</td>";
                  // }

                  
                  echo "<td>".$row['date_limit_deposit']."</td>";
                  echo "<td>".$row['date_limit_issued']."</td>";
                  echo "<td>".$row['date_confirmed']."</td>";
                  echo "<td><input type='text' name='profit' id='profit' value='".$row['profit']."'></td>";

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
                  </tr>
                  <tr><td colspan='18'><div name='divCustomer".$row['id']."' id='divCustomer".$row['id']."'></div></td></tr>
                  <tr><td colspan='18'><div name='divDetail".$row['id']."' id='divDetail".$row['id']."'></div></td></tr>";

                  $grandtotalprice = $grandtotalprice + $totalprice;
                  $grandtotalsellingprice = $grandtotalsellingprice + $totalsellingprice;
                  $grandadt = $grandadt + $row['adt'];
                  $grandchd = $grandchd + $row['chd'];
                  $grandinf = $grandinf + $row['inf'];
                  $grandtotallabakotor = $grandtotallabakotor + $totallabakotor;
                  $grandtotalStaffCom = $grandtotalStaffCom + $row['staff_com'];
                  $grandtotalKekurangan = $grandtotalKekurangan + $totalkekurangan;
                }

                echo "<tr style='font-weight:bold;'>";
                echo "<td colspan='6'> Total : </td>";
                echo "<td>".$grandadt."</td>";
                echo "<td>".$grandchd."</td>";
                echo "<td>".$grandinf."</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td>Rp ".number_format($grandtotalsellingprice, 0, ".", ".")."</br></br>
                Rp ".number_format($grandtotalprice, 0, ".", ".")."</td>";
                echo "<td></td>";
                echo "<td>Rp ".number_format($grandtotalKekurangan, 0, ".", ".")."</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td>Rp ".number_format($grandtotallabakotor, 0, ".", ".")."</td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td></td>";
                echo "<td>Rp ".number_format($grandtotalStaffCom, 0, ".", ".")."</td>";
                echo "<td></td>";

          
              
                echo "</tr>";

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
 var availableTags3 = [];
 var availableTags4 = [];
  $(document).ready(function(){
    $(".chosen").chosen();
     $('input[name="datefilterx"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });
    $('input[name="datefilterx2"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });
     $('input[name="datefilterx3"]').daterangepicker({
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
    $('input[name="datefilter5"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });
    $('input[name="datefilter6"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });

    $('#flight_invoice').on('change', function() {
    	if(this.value==0){
    		$('#type').val(1);
    		$('#type').trigger("chosen:updated");

    	}else{
    		var count = this.value;
        $('#adt_price').val('');
        $('#chd_price').val('');
        $('#inf_price').val('');
        $('#tax_adt_price').val('');
        $('#tax_chd_price').val('');
        $('#tax_inf').val('');

        $('#kurs_price').val($("input[name=tkurs_price"+count+"]").val());
        $('#kurs_price').trigger("chosen:updated");
        $('#kurs_tax').val($("input[name=tkurs_tax"+count+"]").val());
        $('#kurs_tax').trigger("chosen:updated");
        $('#adt_price').val($("input[name=tadt_price"+count+"]").val());
        $('#chd_price').val($("input[name=tchd_price"+count+"]").val());
        $('#inf_price').val($("input[name=tinf_price"+count+"]").val());
        $('#tax_adt_price').val($("input[name=tadt_tax"+count+"]").val());
        $('#tax_chd_price').val($("input[name=tchd_tax"+count+"]").val());
        $('#tax_inf').val($("input[name=tinf_tax"+count+"]").val());
    		$.ajax({
    			type:'POST',
    			url:'getFlightQuotationInvoice.php',
    			data:{'id':count},
    			success:function(data){
    				$('#googleflight').html(data);
    			}
    		});
    		$('#type').val(0);
    		$('#type').trigger("chosen:updated");
    	}
    });

   $("#but_upload").click(function(){
      var fd = new FormData();
      const monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN",
      "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"
      ];

      var airlines = document.getElementById("airlines").options[document.getElementById("airlines").selectedIndex].value;
      var tour_name = $("input[name=tour_name]").val();
      var flight_type = document.getElementById("flight_type").options[document.getElementById("flight_type").selectedIndex].value;
      var flight_category = document.getElementById("flight_category").options[document.getElementById("flight_category").selectedIndex].value;
      var pnr = $("input[name=pnr]").val();
      var adt_pax = $("input[name=adt_pax]").val();
      var chd_pax = $("input[name=chd_pax]").val();
      var inf_pax = $("input[name=inf_pax]").val();
      var kurs_price = document.getElementById("kurs_price").options[document.getElementById("kurs_price").selectedIndex].value;
      var kurs_tax = document.getElementById("kurs_tax").options[document.getElementById("kurs_tax").selectedIndex].value;
      var adt_price = $("input[name=adt_price]").val();
      var chd_price = $("input[name=chd_price]").val();
      var inf_price = $("input[name=inf_price]").val();
      var selling_adt_price = $("input[name=selling_adt_price]").val();
      var selling_chd_price = $("input[name=selling_chd_price]").val();
      var selling_inf_price = $("input[name=selling_inf_price]").val();
      var tax_adt_price = $("input[name=tax_adt_price]").val();
      var tax_chd_price = $("input[name=tax_chd_price]").val();
      var tax_inf_price = $("input[name=tax_inf_price]").val();
      var status_penalty = document.getElementById("status_penalty").options[document.getElementById("status_penalty").selectedIndex].value;
      var penalty_pax = $("input[name=penalty_pax]").val();
      var adm_penalty = $("input[name=adm_penalty]").val();
      var deposit_pax_amount = $("input[name=deposit_pax_amount]").val();
      var deposit_total_pax = $("input[name=deposit_total_pax]").val();
      var total_seat = $("input[name=total_seat]").val();

      var date=new Date($('input[name="datefilterx"]').val());
      var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
      var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
      var year = date.getFullYear();

      var date2=new Date($('input[name="datefilterx2"]').val());
      var month2 = ((date2.getMonth()+1)<10) ? "0" + (date2.getMonth()+1) : (date2.getMonth()+1);
      var day2 = (date2.getDate() < 10) ? "0" + date2.getDate() : date2.getDate();
      var year2 = date2.getFullYear();

      var date3=new Date($('input[name="datefilterx3"]').val());
      var month3 = ((date3.getMonth()+1)<10) ? "0" + (date3.getMonth()+1) : (date3.getMonth()+1);
      var day3 = (date3.getDate() < 10) ? "0" + date3.getDate() : date3.getDate();
      var year3 = date3.getFullYear();

      var tdate = year + "-" + month + "-" + day;
      var tdate2 = year2 + "-" + month2 + "-" + day2;
      var tdate3 = year3 + "-" + month3 + "-" + day3;

      var tags7 = $("input[name=tags7]").val();
      var tags8 = $("input[name=tags8]").val();
      var find = tags7.indexOf("(");
      var find2 = tags8.indexOf("(");
      var destination_fromx = tags7.substring(0,find-1);
      var destination_tox = tags8.substring(0,find2-1);


      fd.append('airlines',airlines);
      fd.append('tour_name',tour_name);
      fd.append('flight_type',flight_type);
      fd.append('flight_category',flight_category);
      fd.append('pnr',pnr);
      fd.append('adm_penalty',adm_penalty);
      fd.append('adt_pax',adt_pax);
      fd.append('chd_pax',chd_pax);
      fd.append('inf_pax',inf_pax);
      fd.append('kurs_price',kurs_price);
      fd.append('kurs_tax',kurs_tax);
      fd.append('adt_price',adt_price);
      fd.append('chd_price',chd_price);
      fd.append('inf_price',inf_price);
      fd.append('selling_adt_price',selling_adt_price);
      fd.append('selling_chd_price',selling_chd_price);
      fd.append('selling_inf_price',selling_inf_price);
      fd.append('tax_adt_price',tax_adt_price);
      fd.append('tax_chd_price',tax_chd_price);
      fd.append('tax_inf_price',tax_inf_price);
      fd.append('status_penalty',status_penalty);
      fd.append('penalty_pax',penalty_pax);
      fd.append('deposit_pax_amount',deposit_pax_amount);
      fd.append('deposit_total_pax',deposit_total_pax);
      fd.append('total_seat',total_seat);
      fd.append('tdate',tdate);
      fd.append('tdate2',tdate2);
      fd.append('tdate3',tdate3);
      fd.append('destination_fromx',destination_fromx);
      fd.append('destination_tox',destination_tox);


      var type = document.getElementById("type").options[document.getElementById("type").selectedIndex].value;
      fd.append('type',type);
      if(type==0){
        var flightInvoice = document.getElementById("flight_invoice").options[document.getElementById("flight_invoice").selectedIndex].value;
        var countDetail = $("input[name=countDetail]").val();
        var quotationID = $("input[name=quotationID]").val();

        fd.append('flightInvoice',flightInvoice);
        fd.append('countDetail',countDetail);
        fd.append('quotationID',quotationID);

        var x;
        for (x = 0; x < countDetail; x++) {
        	var dayQuotation = $("input[name=dayQuotation"+x+"]").val();
        	var monthQuotation = document.getElementById("QuotationMonth"+x).options[document.getElementById("QuotationMonth"+x).selectedIndex].value;
        	var dateQuotation = dayQuotation + "" + monthQuotation;
        	fd.append('dateQuotation'+x,dateQuotation);
        }

        $.ajax({
          url: 'insertFlight.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
            if(response=="success"){
              alert(response);
              reloadManual(1,0,0);
            }else{
              alert(response);
            }

          },
        });

      }else if(type==2){

        var date=new Date($('input[name="datefilter3"]').val());
        var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
        var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
        var year = date.getFullYear();

        var airlines_pil = document.getElementById("airlines_pil").options[document.getElementById("airlines_pil").selectedIndex].value;
        var airlines_code = $("input[name=code_airlines]").val();
        var tags = $("input[name=tags]").val();
        var tags2 = $("input[name=tags2]").val();
        var time2 = $("input[name=time2]").val();

        var res = time2.split("-");


        var departure_time = res[0].replace(':','');
        var arrival_time = res[1].replace(':','');
        var n = tags.indexOf("-")+1;
        var len = tags.length;
        var from = tags.substring(n, len);
        var n2 = tags2.indexOf("-")+1;
        var len2 = tags2.length;
        var to = tags2.substring(n2, len2);

        var find = tags.indexOf("(");
        var find2 = tags2.indexOf("(");
        var destination_from = tags.substring(0,find-1);
        var destination_to = tags2.substring(0,find2-1);

        var flight_date = day+monthNames[date.getMonth()];


        fd.append('flight_date',flight_date);
        fd.append('airlines_pil',airlines_pil);
        fd.append('airlines_code',airlines_code);
        fd.append('from',from);
        fd.append('to',to);
        fd.append('destination_from',destination_from);
        fd.append('destination_to',destination_to);
        fd.append('departure_time',departure_time);
        fd.append('arrival_time',arrival_time);

        $.ajax({
          url: 'insertFlight.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
            if(response=="success"){
              alert(response);
              reloadManual(1,0,0);
            }else{
              alert(response);
            }

          },
        });

      }else{

        var counttb = $("input[name=tb]").val();
        var counttp = $("input[name=tp]").val();

        fd.append('counttb',counttb);
        fd.append('counttp',counttp);

        var date=new Date($('input[name="datefilter3"]').val());
        var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
        var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
        var year = date.getFullYear();

        var airlines_pil = document.getElementById("airlines_pil").options[document.getElementById("airlines_pil").selectedIndex].value;
        var airlines_code = $("input[name=code_airlines]").val();
        var tags = $("input[name=tags]").val();
        var tags2 = $("input[name=tags2]").val();
        var time = $("input[name=time]").val();

        var res = time.split("-");


        var departure_time = res[0].replace(':','');
        var arrival_time = res[1].replace(':','');
        var n = tags.indexOf("-")+1;
        var len = tags.length;
        var from = tags.substring(n, len);
        var n2 = tags2.indexOf("-")+1;
        var len2 = tags2.length;
        var to = tags2.substring(n2, len2);

        var find = tags.indexOf("(");
        var find2 = tags2.indexOf("(");
        var destination_from = tags.substring(0,find-1);
        var destination_to = tags2.substring(0,find2-1);

        var flight_date = day+monthNames[date.getMonth()];

        fd.append('flight_date',flight_date);
        fd.append('airlines_pil',airlines_pil);
        fd.append('airlines_code',airlines_code);
        fd.append('from',from);
        fd.append('to',to);
        fd.append('destination_from',destination_from);
        fd.append('destination_to',destination_to);
        fd.append('departure_time',departure_time);
        fd.append('arrival_time',arrival_time);

        var date2=new Date($('input[name="datefilter6"]').val());
        var month2 = ((date2.getMonth()+1)<10) ? "0" + (date2.getMonth()+1) : (date2.getMonth()+1);
        var day2 = (date2.getDate() < 10) ? "0" + date2.getDate() : date2.getDate();
        var year2 = date2.getFullYear();

        var airlines_pil2 = document.getElementById("airlines_pil2").options[document.getElementById("airlines_pil2").selectedIndex].value;
        var airlines_code2 = $("input[name=code_airlines2]").val();
        var tags3 = $("input[name=tags3]").val();
        var tags4 = $("input[name=tags4]").val();
        var time2 = $("input[name=time2]").val();

        var res2 = time2.split("-");
        var departure_time2 = res2[0].replace(':','');
        var arrival_time2 = res2[1].replace(':','');
        var n3 = tags3.indexOf("-")+1;
        var len3 = tags3.length;
        var from2 = tags3.substring(n3, len3);
        var n4 = tags4.indexOf("-")+1;
        var len4 = tags4.length;
        var to2 = tags4.substring(n4, len4);

        var find = tags3.indexOf("(");
        var find2 = tags4.indexOf("(");
        var destination_from2 = tags3.substring(0,find-1);
        var destination_to2 = tags4.substring(0,find2-1);

        var flight_date2 = day2+monthNames[date2.getMonth()];

        fd.append('flight_date2',flight_date2);
        fd.append('airlines_pil2',airlines_pil2);
        fd.append('airlines_code2',airlines_code2);
        fd.append('from2',from2);
        fd.append('to2',to2);
        fd.append('destination_from2',destination_from2);
        fd.append('destination_to2',destination_to2);
        fd.append('departure_time2',departure_time2);
        fd.append('arrival_time2',arrival_time2);

        for (i = 0; i < counttb; i++) {
          var dateb=new Date($('input[name="datefilter1'+i+'1"]').val());
          var monthb = ((dateb.getMonth()+1)<10) ? "0" + (dateb.getMonth()+1) : (dateb.getMonth()+1);
          var dayb = (dateb.getDate() < 10) ? "0" + dateb.getDate() : dateb.getDate();
          var yearb = dateb.getFullYear();
          var transit_typeb = $("input[name=transitType1"+i+"]").val();
          var airlines_pilb = document.getElementById("airlines_pil1"+i).options[document.getElementById("airlines_pil1"+i).selectedIndex].value;
          var airlines_codeb = $("input[name=code_airlines1"+i+"]").val();
          var tagsb = $("input[name=tags1"+i+"1]").val();
          var tags2b = $("input[name=tags1"+i+"2]").val();
          var timeb = $("input[name=time1"+i+"]").val();
        
          var resb = timeb.split("-");


          var departure_timeb = resb[0].replace(':','');
          var arrival_timeb = resb[1].replace(':','');
          var nb = tagsb.indexOf("-")+1;
          var lenb = tagsb.length;
          var fromb = tagsb.substring(nb, lenb);
          var n2b = tags2b.indexOf("-")+1;
          var len2b = tags2b.length;
          var tob = tags2b.substring(n2b, len2b);

          var find = tagsb.indexOf("(");
          var find2 = tags2b.indexOf("(");
          var destination_fromb = tagsb.substring(0,find-1);
          var destination_tob = tags2b.substring(0,find2-1);

          var flight_dateb = dayb+monthNames[dateb.getMonth()];

          fd.append('flight_date1'+i,flight_dateb);
          fd.append('airlines_pil1'+i,airlines_pilb);
          fd.append('airlines_code1'+i,airlines_codeb);
          fd.append('from1'+i,fromb);
          fd.append('to1'+i,tob);
          fd.append('destination_from1'+i,destination_fromb);
          fd.append('destination_to1'+i,destination_tob);
          fd.append('departure_time1'+i,departure_timeb);
          fd.append('arrival_time1'+i,arrival_timeb);
          fd.append('transit_type1'+i,transit_typeb);

        }

        for (i = 0; i < counttp; i++) {
          var dateb=new Date($('input[name="datefilter2'+i+'1"]').val());
          var monthb = ((dateb.getMonth()+1)<10) ? "0" + (dateb.getMonth()+1) : (dateb.getMonth()+1);
          var dayb = (dateb.getDate() < 10) ? "0" + dateb.getDate() : dateb.getDate();
          var yearb = dateb.getFullYear();
          var transit_typeb = $("input[name=transitType2"+i+"]").val();
          var airlines_pilb = document.getElementById("airlines_pil2"+i).options[document.getElementById("airlines_pil2"+i).selectedIndex].value;
          var airlines_codeb = $("input[name=code_airlines2"+i+"]").val();
          var tagsb = $("input[name=tags2"+i+"1]").val();
          var tags2b = $("input[name=tags2"+i+"2]").val();
          var timeb = $("input[name=time2"+i+"]").val();

          var resb = timeb.split("-");


          var departure_timeb = resb[0].replace(':','');
          var arrival_timeb = resb[1].replace(':','');
          var nb = tagsb.indexOf("-")+1;
          var lenb = tagsb.length;
          var fromb = tagsb.substring(nb, lenb);
          var n2b = tags2b.indexOf("-")+1;
          var len2b = tags2b.length;
          var tob = tags2b.substring(n2b, len2b);

          var find = tagsb.indexOf("(");
          var find2 = tags2b.indexOf("(");
          var destination_fromb = tagsb.substring(0,find-1);
          var destination_tob = tags2b.substring(0,find2-1);

          var flight_dateb = dayb+monthNames[dateb.getMonth()];

          fd.append('flight_date2'+i,flight_dateb);
          fd.append('airlines_pil2'+i,airlines_pilb);
          fd.append('airlines_code2'+i,airlines_codeb);
          fd.append('from2'+i,fromb);
          fd.append('to2'+i,tob);
          fd.append('destination_from2'+i,destination_fromb);
          fd.append('destination_to2'+i,destination_tob);
          fd.append('departure_time2'+i,departure_timeb);
          fd.append('arrival_time2'+i,arrival_timeb);
          fd.append('transit_type2'+i,transit_typeb);

        }

         $.ajax({
          url: 'insertFlight.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
            if(response=="success"){
              alert(response);
              reloadManual(1,0,0);
            }else{
              alert(response);
            }

          },
        });

      }
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
            availableTags2[i]=data[i].PlaceName + " ( "+ data[i].CountryName +" ) " + " - " + data[i].PlaceId;
        }
      
    });



    $( "#tags2" ).autocomplete({
          source: availableTags2
        });

  }
  function getFrom2(x){

    $.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
      var i=0;
      availableTags = [];
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
        availableTags4[i]=data[i].PlaceName  + " ( "+ data[i].CountryName +" ) " + " - " + data[i].PlaceId;
      }
      
    });



    $( "#tags4" ).autocomplete({
      source: availableTags4
    });

  }
  function getFromX(x,y){
  
    $.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
      var i=0;
      availableTags = [];
      for(i=0;i<data.length;i++){
        availableTags[i]=data[i].PlaceName + " ( "+ data[i].CountryName +" ) " + " - " + data[i].PlaceId;
      }
      
    });



    $( "#tags"+y ).autocomplete({
      source: availableTags
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

