<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<link href="dist/css/summernote/summernote.css" rel="stylesheet">
<script src="dist/css/summernote/summernote.js"></script>
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

$query_flightquotation = "SELECT * FROM flight_quotation WHERE id=".$_POST['id'];
$rs_flightquotation=mysqli_query($con,$query_flightquotation);
$row_flightquotation = mysqli_fetch_array($rs_flightquotation);

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
                      <button type='submit' onclick='reloadManual(4,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                                   <input type='text' name='tid' id='tid' value='".$_POST['id']."' hidden>
                                     <div class='col-3'>
                                            <label>Airlines</label>
                                                <select class='chosen' name='airlines' id='airlines' style='width: 100%;'>
                                                    <option selected='selected' value=0>Pilihan</option>";
                                                    while($rowairlines = mysqli_fetch_array($rsairlines)){
                                                      if($rowairlines['id']==$row_flightquotation['airlines_id']){
                                                        echo "<option selected='selected' value='".$rowairlines['id']."'>".$rowairlines['nama']." ( ".$rowairlines['kode']." )</option>";
                                                      }else{
                                                        echo "<option value='".$rowairlines['id']."'>".$rowairlines['nama']." ( ".$rowairlines['kode']." )</option>";
                                                      }
                                                      
                                                    }
                                                        
                                    echo"</select>
                                        </div>

                                    <div class='col-3'>
                                            <label>Tipe Harga</label>
                                                <select class='chosen' name='type_price' id='type_price' style='width: 100%;'>";
                                                    $queryprice_type = "SELECT * FROM flight_price_type";
                                                    $rsprice_type=mysqli_query($con,$queryprice_type);
                                                    while($rowprice_type = mysqli_fetch_array($rsprice_type)){
                                                      if($rowprice_type['id']==$row_flightquotation['type']){
                                                        echo "<option selected='selected' value='".$rowprice_type['id']."'>".$rowprice_type['nama']."</option>";
                                                      }else{
                                                        echo "<option value='".$rowprice_type['id']."'>".$rowprice_type['nama']."</option>";
                                                      }
                                                      
                                                    }
                                                echo "</select>
                                        </div>

                                        <div class='col-3'>
                                            <label>Flight Type</label>
                                                <select class='chosen' name='flight_type' id='flight_type' style='width: 100%;'>
                                                    <option selected='selected' value=0>Pilihan</option>";
                                                    $querytype = "SELECT * FROM flight_type";
                                                    $rstype=mysqli_query($con,$querytype);
                                                    while($rowtype = mysqli_fetch_array($rstype)){
                                                      if($rowtype['nama']==$row_flightquotation['flight_type']){
                                                        echo "<option selected='selected' value='".$rowtype['nama']."'>".$rowtype['nama']."</option>";
                                                      }else{
                                                        echo "<option value='".$rowtype['nama']."'>".$rowtype['nama']."</option>";
                                                      }
                                                      
                                                    }
                                                        
                                    echo"</select>
                                        </div>

                                        <div class='col-3'>
                                            <label>Flight Category</label>
                                                <select class='chosen' name='flight_category' id='flight_category' style='width: 100%;'>
                                                    <option selected='selected' value=0>Pilihan</option>";
                                                    if($row_flightquotation['flight_category']=='Low Cost Carrier'){
                                                      echo "<option selected='selected' value='Low Cost Carrier'>Low Cost Carrier</option>";
                                                      echo "<option value='Full Service Airline'>Full Service Airline</option>";
                                                    }elseif($row_flightquotation['flight_category']=='Full Service Airline'){
                                                      echo "<option value='Low Cost Carrier'>Low Cost Carrier</option>";
                                                      echo "<option selected='selected' value='Full Service Airline'>Full Service Airline</option>";
                                                    }else{
                                                      echo "<option value='Low Cost Carrier'>Low Cost Carrier</option>";
                                                      echo "<option value='Full Service Airline'>Full Service Airline</option>";
                                                    }
                                                      
                                                      
                                                        
                                    echo"</select>
                                        </div>

                                    
                                    

                            </div>
                            <div class='form-row align-items-center'>
                              <div class='col-4'>
                                <label>From</label>
                                <input class='form-control' type='text' onkeyup='getFromX(this.value,7)' name='tags7' id='tags7' value='".$row_flightquotation['destination_from']."' style='height:2%;'/>

                              </div>
                              <div class='col-4'>
                                <label>To</label>
                                <input class='form-control' type='text' onkeyup='getFromX(this.value,8)' name='tags8' id='tags8' value='".$row_flightquotation['destination_to']."' style='height:2%;'/>
                              </div>
                              <div class='col-4'>
                                <label>Out</label>
                                <input class='form-control' type='text' onkeyup='getFromX(this.value,9)' name='tags9' id='tags9' value='".$row_flightquotation['destination_out']."' style='height:2%;'/>
                              </div>

                            </div>
                            <div class='form-row align-items-center'>
                            <div class='col-3'>
                            <label>Kurs</label></br>";
                            $query_kurs = "SELECT * FROM kurs_bank";
                            $rs_kurs=mysqli_query($con,$query_kurs);

                            echo "<select class='chosen' name='kurs_price' id='kurs_price' style='width: 100%;'>";
                            while( $row_kurs = mysqli_fetch_array($rs_kurs)){
                              if($row_kurs['name']==$row_flightquotation['kurs_price']){
                                echo "<option selected='selected' value='".$row_kurs['name']."'>".$row_kurs['name']."</option>";
                              }else{
                                echo "<option value='".$row_kurs['name']."'>".$row_kurs['name']."</option>";
                              }
                            }

                            echo"</select>";
                            echo "</div>
                             <div class='col-3'>
                                        <label>Adt Price</label>
                                            <input type='text' class='form-control' name='adt_price' id='adt_price' value='".$row_flightquotation['adt_price']."' placeholder='Enter Adt Price'>
                                    </div>
                                     <div class='col-3'>
                                        <label>Chd Price</label>
                                            <input type='text' class='form-control' name='chd_price' id='chd_price' value='".$row_flightquotation['chd_price']."' placeholder='Enter Chd Price'>
                                    </div>
                                     <div class='col-3'>
                                        <label>Inf Price</label>
                                            <input type='text' class='form-control' name='inf_price' id='inf_price' value='".$row_flightquotation['inf_price']."' placeholder='Enter Inf Price'>
                                    </div>

                                    <div class='col-3'>
                                    <label>Kurs</label></br>";
                                    $query_kurs = "SELECT * FROM kurs_bank";
                                    $rs_kurs=mysqli_query($con,$query_kurs);

                                    echo "<select class='chosen' name='kurs_tax' id='kurs_tax' style='width: 100%;'>";
                                    while( $row_kurs = mysqli_fetch_array($rs_kurs)){
                                      if($row_kurs['name']==$row_flightquotation['kurs_tax']){
                                        echo "<option selected='selected' value='".$row_kurs['name']."'>".$row_kurs['name']."</option>";
                                      }else{
                                        echo "<option value='".$row_kurs['name']."'>".$row_kurs['name']."</option>";
                                      }
                                    }

                                    echo"</select>";
                                    echo "</div>
                              <div class='col-3'>
                                        <label>Tax Adt Price</label>
                                            <input type='text' class='form-control' name='tax_adt_price' id='tax_adt_price' value='".$row_flightquotation['adt_tax']."' placeholder='Enter Tax Adt Price'>
                                    </div>
                                     <div class='col-3'>
                                        <label>Tax Chd Price</label>
                                            <input type='text' class='form-control' name='tax_chd_price' id='tax_chd_price' value='".$row_flightquotation['chd_tax']."' placeholder='Enter Tax Chd Price'>
                                    </div>
                                     <div class='col-3'>
                                        <label>Tax Inf Price</label>
                                            <input type='text' class='form-control' name='tax_inf_price' id='tax_inf_price' value='".$row_flightquotation['inf_tax']."' placeholder='Enter Tax Inf Price'>
                                    </div>
                                    ";

                                    echo "
                                    <div class='col-3'>
                                    <label>City From</label></br>";
                                    $query_city = "SELECT * FROM city";
                                    $rs_city=mysqli_query($con,$query_city);

                                    echo "<select class='chosen' name='city_froms' id='city_froms' style='width: 100%;'>";
                                    while( $row_city = mysqli_fetch_array($rs_city)){
                                       if($row_city['id']==$row_flightquotation['city_from']){
                                        echo "<option selected='selected' value='".$row_city['id']."'>".$row_city['name']."</option>";
                                      }else{
                                        echo "<option value='".$row_city['id']."'>".$row_city['name']."</option>";
                                      }
                                    }

                                    echo"</select></div>
                                    <div class='col-3'>
                                    <label>Country To</label></br>";
                                    $query_city = "SELECT * FROM country";
                                    $rs_city=mysqli_query($con,$query_city);

                                    echo "<select class='chosen' name='country_tos' id='country_tos' style='width: 100%;'>";
                                    while( $row_city = mysqli_fetch_array($rs_city)){
                                      if($row_city['id']==$row_flightquotation['country_to']){
                                        echo "<option selected='selected' value='".$row_city['id']."'>".$row_city['name']."</option>";
                                      }else{
                                        echo "<option value='".$row_city['id']."'>".$row_city['name']."</option>";
                                      }
                                    }

                                    echo"</select></div>
                                    
                                    <div class='col-3'>
                                    <label>City To</label></br>";
                                    $query_city = "SELECT * FROM city";
                                    $rs_city=mysqli_query($con,$query_city);

                                    echo "<select class='chosen' name='city_tos' id='city_tos' style='width: 100%;'>";
                                    while( $row_city = mysqli_fetch_array($rs_city)){
                                      if($row_city['id']==$row_flightquotation['city_to']){
                                        echo "<option selected='selected' value='".$row_city['id']."'>".$row_city['name']."</option>";
                                      }else{
                                        echo "<option value='".$row_city['id']."'>".$row_city['name']."</option>";
                                      }
                                    }

                                    echo"</select></div>
                                    <div class='col-3'>
                                    <label>City Out</label></br>";
                                    $query_city = "SELECT * FROM city";
                                    $rs_city=mysqli_query($con,$query_city);

                                    echo "<select class='chosen' name='city_outs' id='city_outs' style='width: 100%;'>";
                                    while( $row_city = mysqli_fetch_array($rs_city)){
                                      if($row_city['id']==$row_flightquotation['city_out']){
                                        echo "<option selected='selected' value='".$row_city['id']."'>".$row_city['name']."</option>";
                                      }else{
                                        echo "<option value='".$row_city['id']."'>".$row_city['name']."</option>";
                                      }
                                    }

                                    echo"</select></div>
                                    <div class='col-4'>
                                        <label>Total Seat</label>
                                            <input type='text' class='form-control' name='total_seat' id='total_seat' value='".$row_flightquotation['total_seat']."' placeholder='Enter Total Seat'>
                                    </div>
                                    <div class='col-4'>
                                        <label>Total FOC</label>
                                            <input type='text' class='form-control' name='total_foc' id='total_foc' value='".$row_flightquotation['total_foc']."' placeholder='Enter Total FOC'>
                                    </div>
                                   <div class='col-4'>
                                        <label>Tax FOC</label>
                                            <input type='text' class='form-control' name='tax_foc' id='tax_foc' value='".$row_flightquotation['tax_foc']."' placeholder='Enter Tax FOC'>
                                    </div>";

                                    
                                    
                                    // $query_category = "SELECT * FROM itinerary_category";
                                    // $rs_category=mysqli_query($con,$query_category);
                                    // $tempCT = array();
                                    // array_push($tempCT,$row_flightquotation['daily']);
                                    // array_push($tempCT,$row_flightquotation['morning']);
                                    // array_push($tempCT,$row_flightquotation['noon']);
                                    // array_push($tempCT,$row_flightquotation['evening']);
                                    // array_push($tempCT,$row_flightquotation['night']);
                                    // array_push($tempCT,$row_flightquotation['earlymorning']);
                                    // while($row_category = mysqli_fetch_array($rs_category)){
                                    //   $countCT = $row_category['id'] - 1;

                                    //   if($tempCT[$countCT]==1){
                                    //     echo "<div class='col-2'>";
                                    //     echo "<label>Arrival & Departure Time Category</label></br>";
                                    //     echo "<input type='checkbox' name='category".$row_category['id']."' id='category".$row_category['id']."' checked>".$row_category['name']."<br>";
                                    //     echo "</div>";
                                    //   }else{
                                    //     echo "<div class='col-2'>";
                                    //     echo "<label>Arrival & Departure Time Category</label></br>";
                                    //     echo "<input type='checkbox' name='category".$row_category['id']."' id='category".$row_category['id']."'>".$row_category['name']."<br>";
                                    //     echo "</div>";
                                    //   }

                                    // }

                                    // echo "</br></br>";

                                    echo "<div class='col-6'>
                                    <label>Arrival Time Category</label></br>";
                                    $query_category = "SELECT * FROM itinerary_category_arrival";
                                    $rs_category=mysqli_query($con,$query_category);
                                    echo "<select class='chosen' name='itinerary_category_arrival' id='itinerary_category_arrival' style='width:100%'>";
                                    echo "<option selected='selected' value='0'>Pilihan</option>";
                                    while($row_category = mysqli_fetch_array($rs_category)){
                                     if($row_category['id']==$row_flightquotation['itinerary_category_arrival']){
                                      echo "<option selected='selected' value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
                                    }else{
                                      echo "<option value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
                                    }

                      //echo "<input type='checkbox' name='category".$row_category['id']."' id='category".$row_category['id']."'>".$row_category['name']."<br>";

                                  }

                                  echo "</select></div>
                                  <div class='col-6'>
                                  <label>Departure Time Category</label></br>";
                                  $query_category = "SELECT * FROM itinerary_category_departure";
                                  $rs_category=mysqli_query($con,$query_category);
                                  echo "<select class='chosen' name='itinerary_category_departure' id='itinerary_category_departure' style='width:100%'>";
                                  echo "<option selected='selected' value='0'>Pilihan</option>";
                                  while($row_category = mysqli_fetch_array($rs_category)){
                                    if($row_category['id']==$row_flightquotation['itinerary_category_departure']){
                                      echo "<option selected='selected' value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
                                    }else{
                                      echo "<option value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
                                    }

                      //echo "<input type='checkbox' name='category".$row_category['id']."' id='category".$row_category['id']."'>".$row_category['name']."<br>";

                                  }

                                  echo "</select></div>";

                                    for ($x = 0; $x < 2; $x++) {
                                      $querymonth = "SELECT * FROM month";
                                      $rsmonth=mysqli_query($con,$querymonth);
                                      while($rowmonth = mysqli_fetch_array($rsmonth)){
                                        $substringMonth = substr($rowmonth['name'],0,3);

                                        if($x==0){
                                          echo "<div class='col-2'>
                                          <label>Date ( ".$substringMonth." 2020 )</label>
                                          <input type='text' class='form-control' name='datea".$x.$rowmonth['id']."' id='datea".$x.$rowmonth['id']."' value='' placeholder='Contoh : 15-20'>
                                          <input type='text' name='datea2".$x.$rowmonth['id']."' id='datea2".$x.$rowmonth['id']."' value='".$substringMonth." 2020' hidden>
                                          </div>";
                                        }else{
                                          echo "<div class='col-2'>
                                          <label>Date ( ".$substringMonth." 2021 )</label>
                                          <input type='text' class='form-control' name='dateb".$x.$rowmonth['id']."' id='dateb".$x.$rowmonth['id']."' value='' placeholder='Contoh : 15-20'>
                                          <input type='text' name='dateb2".$x.$rowmonth['id']."' id='dateb2".$x.$rowmonth['id']."' value='".$substringMonth." 2021' hidden>
                                          </div>";

                                        }
                                      }
                                    }
                             // echo "<div class='col-12'>
                             //    <label>Date</label>
                             //    <textarea id='summernote' name='editordata'>";

                             //    for ($x = 0; $x < 2; $x++) {
                             //      $querymonth = "SELECT * FROM month";
                             //      $rsmonth=mysqli_query($con,$querymonth);
                             //      while($rowmonth = mysqli_fetch_array($rsmonth)){
                             //        if($x==0){
                             //          echo $rowmonth['name']." 2020 </br>";
                             //        }else{
                             //          echo $rowmonth['name']." 2021 </br>";
                                     
                             //       }
                             //     }
                             //   }
                             //    echo "</textarea>
                             //  </div>
                             echo "</div>
                                    <div class='form-group'>
                                    <label>Remarks</label>
                                    <textarea id='summernote' name='editordata'>".$row_flightquotation['remarks']."</textarea>
                                    </div>";

                            // echo " 
                            // <table class='table' style='margin-top:1%;margin-left:1%;'>
                            // <tr><td>
                            // <label>Date</label>
                            
                            
                            // 	<select  name='dateCount' id='dateCount'>";
                            // 	echo "<option selected='selected' value='0'>0</option>";
                            //              for ($x = 1; $x <= 15; $x++) {
                            //              	echo "<option value='".$x."'>".$x."</option>";
                            //              }
                                                        
                            //         echo"</select></td></tr>
                            //         <td colspan='2'>
                            //         <div id='divDate'>
                                   
                            //         </div>
                            //         </td>
                           
                            // ";
                            echo "<input type='text' name='tb' id='tb' value=0 hidden>";
                            echo "<input type='text' name='tp' id='tp' value=0 hidden>";
                            echo "<table class='table' style='margin-top:1%;margin-left:1%;'>
                                  <tr>
                                  <td>
                                                <select class='chosen' name='type' id='type'>";
                                                    
                                                    echo "<option value='0'>...</option>";
                                                    echo "<option value='1'>Round Trip</option>";
                                                    echo "<option value='2'>One Way</option>";
                                                    echo "<option value='3'>Multi City</option>";
                                                    
                                                        
                                    echo"</select>
                                    </td></tr>
                                    </table>";
                                    

                                    echo "<div id='googleflight' name='googleflight'>
                                    <table class='table class='table-striped table-bordered table-sm' style='margin-top:1%;margin-left:1%;'>";

                                    $query_flightquotationdetail = "SELECT * FROM flight_quotation_detail WHERE flight_quotation_id=".$row_flightquotation['id']." ORDER BY type ASC, id ASC";
                                    $rs_flightquotationdetail=mysqli_query($con,$query_flightquotationdetail);
                                    $tempQuotationDetail = array();
                                    while($row_flightquotationdetail = mysqli_fetch_array($rs_flightquotationdetail)){
                                      array_push($tempQuotationDetail,$row_flightquotationdetail['id']);
                                      echo "<tr>

                                      <td>
                                      <div>
                                      <input type='text' name='tid_detail".$row_flightquotationdetail['id']."' id='tid_detail".$row_flightquotationdetail['id']."' value='".$row_flightquotationdetail['id']."' hidden>
                                      <input class='form-control' type='text' name='datefilter3' id='datefilter3' value='".$dateNow."' style='height:2%;' hidden/>
                                      </div>
                                      </td>

                                      <td>
                                      <div>
                                      <label>Airlines</label></br>";
                                      $queryairlines = "SELECT * FROM airlines";
                                      $rsairlines=mysqli_query($con,$queryairlines);
                                      echo "<select class='chosen' name='airlines_pil".$row_flightquotationdetail['id']."' id='airlines_pil".$row_flightquotationdetail['id']."' style='width: 100%;'>
                                      <option selected='selected' value=0>Pilihan</option>";
                                      while($rowairlines = mysqli_fetch_array($rsairlines)){
                                        if($rowairlines['kode']==$row_flightquotationdetail['airlines']){
                                          echo "<option selected='selected' value='".$rowairlines['kode']."'>".$rowairlines['nama']." ( ".$rowairlines['kode']." )</option>";
                                        }else{
                                          echo "<option value='".$rowairlines['kode']."'>".$rowairlines['nama']." ( ".$rowairlines['kode']." )</option>";
                                        }
                                      }

                                      echo"</select>

                                      </div>
                                      </td>
                                      <td>
                                      <div>
                                      <label>Code Airlines</label>
                                      <input class='form-control' type='text' name='code_airlines".$row_flightquotationdetail['id']."' id='code_airlines".$row_flightquotationdetail['id']."' value='".$row_flightquotationdetail['airlines_code']."' style='height:2%;'/>
                                      </div>
                                      </td>
                                      <td>
                                      <div>
                                      <label>From</label>
                                      <input class='form-control' type='text' onkeyup='getFromX(this.value,".$row_flightquotationdetail['id'].")' name='tags".$row_flightquotationdetail['id']."' id='tags".$row_flightquotationdetail['id']."' value='".$row_flightquotationdetail['destination_from']." - ".$row_flightquotationdetail['froms']."' style='height:2%;'/>
                                      </div>
                                      </td>
                                      <td>
                                      <div>
                                      <label>To</label>
                                      <input class='form-control' type='text' onkeyup='getFromX(this.value,".$row_flightquotationdetail['id'].")' name='tags2".$row_flightquotationdetail['id']."' id='tags2".$row_flightquotationdetail['id']."' value='".$row_flightquotationdetail['destination_to']." - ".$row_flightquotationdetail['tos']."' style='height:2%;'/>
                                      </div>
                                      </td>
                                      <td>
                                      <div>";

                                      $string = $row_flightquotationdetail['departure_time'];
                                      $stringTime2 = substr($string, -2);
                                      $stringTime = substr($string,0, strpos($string, $stringTime2));

                                      $stringFull = $stringTime . ":" . $stringTime2;

                                      $string = $row_flightquotationdetail['arrival_time'];
                                      $findme = '+';
                                      $pos = strpos($string, $findme);
                                      if($pos==''){
                                        $stringTime2 = substr($string, -2);
                                        $stringTime = substr($string,0, strpos($string, $stringTime2));

                                        $stringFull2 = $stringTime . ":" . $stringTime2;
                                      }else{
                                        $stringTime2 = substr($string,2, $pos);
                                        $stringTime = substr($string,0, 2);

                                        $stringFull2 = $stringTime . ":" . $stringTime2 ;
                                      }
                                      

                                      $time = $stringFull . "-" . $stringFull2;

                                      echo "<label>Time</label>
                                      <input class='form-control' type='text' name='time".$row_flightquotationdetail['id']."' id='time".$row_flightquotationdetail['id']."' value='".$time."' style='height:2%;'/>
                                      </div>
                                      </td>
                                     
                                      </tr>
                                      <td colspan='7'>
                                      <div id='divberangkat'>

                                      </div>
                                      </td>
                                      <tr>";
                                    }

                                   
                                    echo "</table>";
                            echo "<center></br><button type='button' class='btn btn-primary' id='but_upload'>Submit</button></center> </div>";
              echo "</div></div>
              <!-- /.card-header -->

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
    $('#summernote').summernote();
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

    $('#dateCount').on('change', function() {
        var count = this.value;
        $.ajax({
          type:'POST',
          url:'getFlightQuotationDate.php',
          data:{'count':count},
          success:function(data){
           $('#divDate').html(data);
         }
       });
      });


   $("#but_upload").click(function(){
      var fd = new FormData();
      const monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN",
      "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"
      ];

      var tid = $("input[name=tid]").val();
      var airlines = document.getElementById("airlines").options[document.getElementById("airlines").selectedIndex].value;
      var type_price = document.getElementById("type_price").options[document.getElementById("type_price").selectedIndex].value;
      var adt_price = $("input[name=adt_price]").val();
      var chd_price = $("input[name=chd_price]").val();
      var inf_price = $("input[name=inf_price]").val();
      var tax_adt_price = $("input[name=tax_adt_price]").val();
      var tax_chd_price = $("input[name=tax_chd_price]").val();
      var tax_inf_price = $("input[name=tax_inf_price]").val();
      var kurs_price = document.getElementById("kurs_price").options[document.getElementById("kurs_price").selectedIndex].value;
      var kurs_tax = document.getElementById("kurs_tax").options[document.getElementById("kurs_tax").selectedIndex].value;
      var flight_type = document.getElementById("flight_type").options[document.getElementById("flight_type").selectedIndex].value;
      var flight_category = document.getElementById("flight_category").options[document.getElementById("flight_category").selectedIndex].value;
      var country_to = document.getElementById("country_tos").options[document.getElementById("country_tos").selectedIndex].value;
      var city_from = document.getElementById("city_froms").options[document.getElementById("city_froms").selectedIndex].value;
      var city_to = document.getElementById("city_tos").options[document.getElementById("city_tos").selectedIndex].value;
      var city_out = document.getElementById("city_outs").options[document.getElementById("city_outs").selectedIndex].value;
      var total_seat = $("input[name=total_seat]").val();
      var total_foc = $("input[name=total_foc]").val();
      var tax_foc = $("input[name=tax_foc]").val();
      //var date = $("textarea[name=editordata]").val();
      var remarks = $("textarea[name=editordata]").val();
      fd.append('remarks',remarks);

      var from = $("input[name=tags7]").val();
      var to = $("input[name=tags8]").val();
      var out = $("input[name=tags9]").val();
      if(from!=''){
        var n_from = from.indexOf("-")+1;
        var len_from = from.length;
        var from_fix = from.substring(n_from, len_from);
      }else{
         var from_fix = '';
      }
      if(to!=''){
        var n_to = to.indexOf("-")+1;
        var len_to = to.length;
        var to_fix = to.substring(n_to, len_to);
      }else{
         var to_fix = '';
      }
      
      if(out!=''){
       var n_out = out.indexOf("-")+1;
       var len_out = out.length;
       var out_fix = out.substring(n_out, len_out);
      }else{
        var out_fix = '';
      }

      // var ct1 = 0;
      // var ct2 = 0;
      // var ct3 = 0;
      // var ct4 = 0;
      // var ct5 = 0;
      // var ct6 = 0;

      // if ($('input[name=category1]').is(':checked')) {
      //   ct1 = 1;
      // }
      // if ($('input[name=category2]').is(':checked')) {
      //   ct2 = 1;
      // }
      // if ($('input[name=category3]').is(':checked')) {
      //   ct3 = 1;
      // }
      // if ($('input[name=category4]').is(':checked')) {
      //   ct4 = 1;
      // }
      // if ($('input[name=category5]').is(':checked')) {
      //   ct5 = 1;
      // }
      // if ($('input[name=category6]').is(':checked')) {
      //   ct6 = 1;
      // }
      // fd.append('ct1',ct1);
      // fd.append('ct2',ct2);
      // fd.append('ct3',ct3);
      // fd.append('ct4',ct4);
      // fd.append('ct5',ct5);
      // fd.append('ct6',ct6);
      var itinerary_category_arrival = document.getElementById("itinerary_category_arrival").options[document.getElementById("itinerary_category_arrival").selectedIndex].value;
      var itinerary_category_departure = document.getElementById("itinerary_category_departure").options[document.getElementById("itinerary_category_departure").selectedIndex].value;
      fd.append('itinerary_category_arrival',itinerary_category_arrival);
      fd.append('itinerary_category_departure',itinerary_category_departure);
     
      if(airlines==8){
        if(chd_price==0){
          chd_price = adt_price * 80 / 100;
          tax_chd_price = tax_adt_price;
        }
        if(inf_price==0){
          inf_price = adt_price * 10 / 100;
          tax_inf_price = tax_adt_price;
        }
      }else if(airlines==25){
        if(chd_price==0){
          chd_price = adt_price * 85 / 100;
          tax_chd_price = tax_adt_price;
        }
        if(inf_price==0){
          inf_price = adt_price * 10 / 100;
          tax_inf_price = tax_adt_price;
        }
       }else if(airlines==24){
        if(chd_price==0){
          chd_price = adt_price;
          tax_chd_price = tax_adt_price;
        }
        if(inf_price==0){
          inf_price = adt_price * 20 / 100;
          tax_inf_price = tax_adt_price;
        }
       }else if(airlines==4 || airlines == 5){
        if(chd_price==0){
          chd_price = adt_price;
          tax_chd_price = tax_adt_price;
        }
        if(inf_price==0){
          inf_price = adt_price * 10 / 100;
          tax_inf_price = tax_adt_price;
        }
       }else if(airlines==17){
        if(chd_price==0){
          chd_price = adt_price;
          tax_chd_price = tax_adt_price;
        }
        if(inf_price==0){
          inf_price = adt_price * 10 / 100;
          tax_inf_price = tax_adt_price;
        }
       }else if(airlines==12){
        if(chd_price==0){
          chd_price = adt_price;
          tax_chd_price = tax_adt_price;
        }
        if(inf_price==0){
          inf_price = adt_price * 20 / 100;
          tax_inf_price = tax_adt_price;
        }
       }else if(airlines==32){
        if(chd_price==0){
          chd_price = adt_price;
          tax_chd_price = tax_adt_price;
        }
        if(inf_price==0){
          inf_price = adt_price * 20 / 100;
          tax_inf_price = tax_adt_price;
        }
       }

      fd.append('id',tid);
      fd.append('airlines',airlines);
      fd.append('type_price',type_price);
      fd.append('adt_price',adt_price);
      fd.append('chd_price',chd_price);
      fd.append('inf_price',inf_price);
      fd.append('tax_adt_price',tax_adt_price);
      fd.append('tax_chd_price',tax_chd_price);
      fd.append('tax_inf_price',tax_inf_price);
      fd.append('kurs_price',kurs_price);
      fd.append('kurs_tax',kurs_tax);
      fd.append('flight_type',flight_type);
      fd.append('flight_category',flight_category);
      fd.append('country_to',country_to);
      fd.append('city_from',city_from);
      fd.append('city_to',city_to);
      fd.append('city_out',city_out);
      fd.append('total_seat',total_seat);
      fd.append('total_foc',total_foc);
      fd.append('tax_foc',tax_foc);
      //fd.append('date',date);
      fd.append('from_fix',from_fix);
      fd.append('to_fix',to_fix);
      fd.append('out_fix',out_fix);

      for (i = 0; i < 2; i++) {
        for (j = 1; j <= 12; j++) {
          
          if(i==0){
            var iDate = $("input[name='datea"+i+j+"']").val();
            var iDate2 = $("input[name='datea2"+i+j+"']").val();
            var tempDate = iDate + " " + iDate2;
          }else{
            var iDate = $("input[name='dateb"+i+j+"']").val();
            var iDate2 = $("input[name='dateb2"+i+j+"']").val();
            var tempDate = iDate + " " + iDate2;
          }
          if(iDate!=''){
            // alert(tempDate+" - "+i+j);
            fd.append('date'+i+j,tempDate);
          }else{
            fd.append('date'+i+j,'');
          }
          
        }

      }


      var type = document.getElementById("type").options[document.getElementById("type").selectedIndex].value;
      fd.append('type',type);

      if(type==0){
        var tempQuotationDetail = <?php echo json_encode($tempQuotationDetail); ?>;

        for (i = 0; i < tempQuotationDetail.length; i++) {
          var tid_detailb = $("input[name=tid_detail"+tempQuotationDetail[i]+"]").val();
          var dateb = new Date($('input[name="datefilter3"]').val());
          var monthb = ((dateb.getMonth()+1)<10) ? "0" + (dateb.getMonth()+1) : (dateb.getMonth()+1);
          var dayb = (dateb.getDate() < 10) ? "0" + dateb.getDate() : dateb.getDate();
          var yearb = dateb.getFullYear();

          var airlines_pilb = document.getElementById("airlines_pil"+tempQuotationDetail[i]).options[document.getElementById("airlines_pil"+tempQuotationDetail[i]).selectedIndex].value;
          var airlines_codeb = $("input[name=code_airlines"+tempQuotationDetail[i]+"]").val();
          var tagsb = $("input[name=tags"+tempQuotationDetail[i]+"]").val();
          var tags2b = $("input[name=tags2"+tempQuotationDetail[i]+"]").val();
          var timeb = $("input[name=time"+tempQuotationDetail[i]+"]").val();
        
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
          if(find==-1){
            var find = tagsb.indexOf("-")-1;
          }
          var find2 = tags2b.indexOf("(");
          if(find2==-1){
            var find2 = tags2b.indexOf("-")-1;
          }
          var destination_fromb = tagsb.substring(0,find-1);
          var destination_tob = tags2b.substring(0,find2-1);

          var flight_dateb = dayb+monthNames[dateb.getMonth()];

          fd.append('tid_detail'+tempQuotationDetail[i],tid_detailb);
          fd.append('flight_date'+tempQuotationDetail[i],flight_dateb);
          fd.append('airlines_pil'+tempQuotationDetail[i],airlines_pilb);
          fd.append('airlines_code'+tempQuotationDetail[i],airlines_codeb);
          fd.append('from'+tempQuotationDetail[i],fromb);
          fd.append('to'+tempQuotationDetail[i],tob);
          fd.append('destination_from'+tempQuotationDetail[i],destination_fromb);
          fd.append('destination_to'+tempQuotationDetail[i],destination_tob);
          fd.append('departure_time'+tempQuotationDetail[i],departure_timeb);
          fd.append('arrival_time'+tempQuotationDetail[i],arrival_timeb);
        }

        tempQuotationDetail = JSON.stringify(tempQuotationDetail);
        fd.append('tempQuotationDetail',tempQuotationDetail);

        $.ajax({
          url: 'updateFlightQuotation.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
            if(response=="success"){
              alert(response);
              reloadManual(4,0,0);
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
          url: 'updateFlightQuotation.php',
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

        }

        for (i = 0; i < counttp; i++) {
          var dateb=new Date($('input[name="datefilter2'+i+'1"]').val());
          var monthb = ((dateb.getMonth()+1)<10) ? "0" + (dateb.getMonth()+1) : (dateb.getMonth()+1);
          var dayb = (dateb.getDate() < 10) ? "0" + dateb.getDate() : dateb.getDate();
          var yearb = dateb.getFullYear();

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

        }

         $.ajax({
          url: 'updateFlightQuotation.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
            if(response=="success"){
              alert(response);
              reloadManual(4,0,0);
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

