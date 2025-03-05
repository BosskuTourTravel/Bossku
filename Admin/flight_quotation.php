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

$queryairlines = "SELECT * FROM airlines";
$rsairlines=mysqli_query($con,$queryairlines);

$querytype = "SELECT * FROM flight_type";
$rstype=mysqli_query($con,$querytype);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>Flight Pricelist</h3>
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
                                            <label>Airlines</label>
                                                <select class='chosen' name='airlines' id='airlines' style='width: 100%;'>
                                                    <option selected='selected' value=0>Pilihan</option>";
                                                    while($rowairlines = mysqli_fetch_array($rsairlines)){
                                                      echo "<option value='".$rowairlines['id']."'>".$rowairlines['nama']." ( ".$rowairlines['kode']." )</option>";
                                                    }
                                                        
                                    echo"</select>
                                        </div>

                                    <div class='col-3'>
                                            <label>Tipe Harga</label>
                                                <select class='chosen' name='type_price' id='type_price' style='width: 100%;'>";
                                                    $queryprice_type = "SELECT * FROM flight_price_type";
                                                    $rsprice_type=mysqli_query($con,$queryprice_type);
                                                    while($rowprice_type = mysqli_fetch_array($rsprice_type)){
                                                      echo "<option value='".$rowprice_type['id']."'>".$rowprice_type['nama']."</option>";
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
                                                      echo "<option value='".$rowtype['nama']."'>".$rowtype['nama']."</option>";
                                                    }
                                                        
                                    echo"</select>
                                        </div>

                                        <div class='col-3'>
                                            <label>Flight Category</label>
                                                <select class='chosen' name='flight_category' id='flight_category' style='width: 100%;'>
                                                    <option selected='selected' value=0>Pilihan</option>";
                                                      echo "<option value='Low Cost Carrier'>Low Cost Carrier</option>";
                                                      echo "<option value='Full Service Airline'>Full Service Airline</option>";
                                                        
                                    echo"</select>
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
                              <div class='col-4'>
                                <label>Out</label>
                                <input class='form-control' type='text' onkeyup='getFromX(this.value,9)' name='tags9' id='tags9' style='height:2%;'/>
                              </div>

                            </div>
                            <div class='form-row align-items-center'>
                              <div class='col-3'>
                                <label>Kurs</label></br>";
                                $query_kurs = "SELECT * FROM kurs_bank";
                                $rs_kurs=mysqli_query($con,$query_kurs);

                                echo "<select class='chosen' name='kurs_price' id='kurs_price' style='width: 100%;'>";
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
                                        <label>Adt Price</label>
                                            <input type='text' class='form-control' name='adt_price' id='adt_price' value='0' placeholder='Enter Adt Price'>
                                    </div>
                                     <div class='col-3'>
                                        <label>Chd Price</label>
                                            <input type='text' class='form-control' name='chd_price' id='chd_price' value='0' placeholder='Enter Chd Price'>
                                    </div>
                                     <div class='col-3'>
                                        <label>Inf Price</label>
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
                                            <input type='text' class='form-control' name='tax_chd_price' id='tax_chd_price' value='0 ' placeholder='Enter Tax Chd Price'>
                                    </div>
                                     <div class='col-3'>
                                        <label>Tax Inf Price</label>
                                            <input type='text' class='form-control' name='tax_inf_price' id='tax_inf_price' value='0 ' placeholder='Enter Tax Inf Price'>
                                    </div>
                                    <div class='col-3'>
                                    <label>City From</label></br>";
                                    $query_city = "SELECT * FROM city";
                                    $rs_city=mysqli_query($con,$query_city);

                                    echo "<select class='chosen' name='city_froms' id='city_froms' style='width: 100%;'>";
                                    while( $row_city = mysqli_fetch_array($rs_city)){
                                      if($row_city['name']=='IDR'){
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
                                      if($row_city['name']=='IDR'){
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
                                      if($row_city['name']=='IDR'){
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
                                      if($row_city['id']=='IDR'){
                                        echo "<option selected='selected' value='".$row_city['id']."'>".$row_city['name']."</option>";
                                      }else{
                                        echo "<option value='".$row_city['id']."'>".$row_city['name']."</option>";
                                      }
                                    }

                                    echo"</select></div>


                                    <div class='col-4'>
                                        <label>Total Seat</label>
                                            <input type='text' class='form-control' name='total_seat' id='total_seat' value='0' placeholder='Enter Total Seat'>
                                    </div>
                                    <div class='col-4'>
                                        <label>Total FOC</label>
                                            <input type='text' class='form-control' name='total_foc' id='total_foc' value='0' placeholder='Enter Total FOC'>
                                    </div>
                                    <div class='col-4'>
                                        <label>Tax FOC</label>
                                            <input type='text' class='form-control' name='tax_foc' id='tax_foc' value='0' placeholder='Enter Tax FOC'>
                                    </div>";

                                    
                                    echo "<div class='col-6'>
                                    <label>Arrival Time Category</label></br>";
                                    $query_category = "SELECT * FROM itinerary_category_arrival";
                                    $rs_category=mysqli_query($con,$query_category);
                                    echo "<select class='chosen' name='itinerary_category_arrival' id='itinerary_category_arrival' style='width:100%'>";
                                    echo "<option selected='selected' value='0'>Pilihan</option>";
                                    while($row_category = mysqli_fetch_array($rs_category)){
                                      echo "<option value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
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
                                      echo "<option value='".$row_category['id']."'>".$row_category['name']." ( ".$row_category['time']." )</option>";
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
                                    <!-- <textarea class='form-control' name='remarks' id='remarks' placeholder='Enter Remarks'> </textarea> -->
                                    <textarea id='summernote' name='editordata'></textarea>
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
                                            <input class='form-control' type='text' onkeyup='getFrom(this.value)' name='tags' id='tags' value='".$dateNow."' style='height:2%;'/></br>

                                    </div>
                                    </td>
                                    <td>
                                    <div>
                                        <label>To</label>
                                            <input class='form-control' type='text' onkeyup='getTo(this.value)' name='tags2' id='tags2' value='".$dateNow."' style='height:2%;'/></br>

                                    </div>
                                    </td>
                                    <td>
                                    <div>
                                        <label>Time</label>
                                            <input class='form-control' type='text' name='time' id='time' value='00:00-00:00' style='height:2%;'/>
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
                                        <input class='form-control' type='text' name='time2' id='time2' value='00:00-00:00' style='height:2%;'/>
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
            

                $query = "SELECT * FROM flight_quotation ORDER BY id ASC";
                $rs=mysqli_query($con,$query);


                $query_sairline = "SELECT * FROM airlines";
                $rs_sairline=mysqli_query($con,$query_sairline);
                
                
                echo "</br><table class='table' style='font-size:14px;'><tr>";
                echo "<td>";
                echo "
                <label>Airlines</label>
                <select class='chosen' name='sairlines' id='sairlines' style='width: 100%;'>
                <option selected='selected' value=0>Pilihan</option>";
                while($row_sairline = mysqli_fetch_array($rs_sairline)){
                	echo "<option value='".$row_sairline['id']."'>".$row_sairline['nama']." ( ".$row_sairline['kode']." )</option>";
                }

                echo"</select>
                </td>";

                echo "<td>";
                echo "<label>City From</label>
                                <select class='chosen' name='scity_from' id='scity_from' style='width: 100%;'>";
                                $query_cityFlight = "SELECT DISTINCT(city_from) FROM flight_quotation";
                                $rs_cityFlight=mysqli_query($con,$query_cityFlight);
                                while( $row_cityFlight = mysqli_fetch_array($rs_cityFlight)){
                                  $query_cityFlightQuotation = "SELECT * FROM city WHERE id=".$row_cityFlight['city_from'];
                                  $rs_cityFlightQuotation=mysqli_query($con,$query_cityFlightQuotation);
                                  $row_cityFlightQuotation = mysqli_fetch_array($rs_cityFlightQuotation);
                                    echo "<option value='".$row_cityFlightQuotation['id']."'>".$row_cityFlightQuotation['name']."</option>";
                                }

                                echo "</select>";
                echo "</td>";
                echo "<td>";
                echo "<label>Country To</label></br>
                <select class='chosen' name='scountry_to' id='scountry_to' style='width:80%'>";
                $query_city = "SELECT DISTINCT(country_to) FROM flight_quotation";
                $rs_city=mysqli_query($con,$query_city);
                echo "<option value='0'>Pilihan</option>";
                while($row_city = mysqli_fetch_array($rs_city)){
                	$query_cityFlight = "SELECT * FROM country WHERE id=".$row_city['country_to'];
                	$rs_cityFlight=mysqli_query($con,$query_cityFlight);
                	$row_cityFlight = mysqli_fetch_array($rs_cityFlight);
                	echo "<option value='".$row_cityFlight['id']."'>".$row_cityFlight['name']."</option>";
                }
                echo"</select>";
                echo "</td>";
                echo "<td>";
                echo "<label>City To</label>
                                <select class='chosen' name='scity_to' id='scity_to' style='width: 100%;'>";
                                $query_cityFlight = "SELECT DISTINCT(city_to) FROM flight_quotation";
                                $rs_cityFlight=mysqli_query($con,$query_cityFlight);
                                echo "<option value='0'>Pilihan</option>";
                                while( $row_cityFlight = mysqli_fetch_array($rs_cityFlight)){
                                  $query_cityFlightQuotation = "SELECT * FROM city WHERE id=".$row_cityFlight['city_to'];
                                  $rs_cityFlightQuotation=mysqli_query($con,$query_cityFlightQuotation);
                                  $row_cityFlightQuotation = mysqli_fetch_array($rs_cityFlightQuotation);
                                    echo "<option value='".$row_cityFlightQuotation['id']."'>".$row_cityFlightQuotation['name']."</option>";
                                }

                                echo "</select>";
                echo "</td>";
                echo "<td>";
                echo "<label>City Out</label>
                                <select class='chosen' name='scity_out' id='scity_out' style='width: 100%;'>";
                                $query_cityFlight = "SELECT DISTINCT(city_out) FROM flight_quotation";
                                $rs_cityFlight=mysqli_query($con,$query_cityFlight);
                                echo "<option value='-1'>Select All</option>";
                                while( $row_cityFlight = mysqli_fetch_array($rs_cityFlight)){
                                  $query_cityFlightQuotation = "SELECT * FROM city WHERE id=".$row_cityFlight['city_out'];
                                  $rs_cityFlightQuotation=mysqli_query($con,$query_cityFlightQuotation);
                                  $row_cityFlightQuotation = mysqli_fetch_array($rs_cityFlightQuotation);
                                    echo "<option value='".$row_cityFlightQuotation['id']."'>".$row_cityFlightQuotation['name']."</option>";
                                }

                                echo "</select>";
                echo "</td>";
                echo "<td>";
                echo "
                <label>Tipe Harga</label>
                <select class='chosen' name='stype_price' id='stype_price' style='width: 100%;'>";
                $queryprice_type = "SELECT * FROM flight_price_type";
                $rsprice_type=mysqli_query($con,$queryprice_type);
                while($rowprice_type = mysqli_fetch_array($rsprice_type)){
                	echo "<option value='".$rowprice_type['id']."'>".$rowprice_type['nama']."</option>";
                }
                echo "</select>";
                echo "</td>";
                 echo "<td>";
                echo "
                <label>Bulan</label>
                <select class='chosen' name='smonth' id='smonth'>";
                $querymonth = "SELECT * FROM month";
                $rsmonth=mysqli_query($con,$querymonth);
                echo "<option selected='selected' value='0'>Date</option>";
                while($rowmonth = mysqli_fetch_array($rsmonth)){
                	$monthName = substr($rowmonth['name'],0,3);

                	echo "<option value='".$monthName."'>".$monthName."</option>";
                	
                }
                for ($x = 0; $x < 2; $x++) {
                      $querymonth = "SELECT * FROM month";
                      $rsmonth=mysqli_query($con,$querymonth);
                      while($rowmonth = mysqli_fetch_array($rsmonth)){
                      	$monthName = substr($rowmonth['name'],0,3);
                        if($x==0){
                            echo "<option value='".$monthName." 2020'>".$monthName." 2020</option>";
                          
                        }else{
                            echo "<option value='".$monthName." 2021'>".$monthName." 2021</option>";
                        }
                      }
                    }
                echo "</select>";
                echo "</td>";
                echo "<td>";
                echo "<button type='button' class='btn btn-success' onclick='searchManual(0,0,0)'>Search Filter</button>";
                echo "</td>";
               

                echo "</tr></table></br>";

                echo "<table id='dtBasicExample' class='tableFixHead table-striped table-bordered table-sm' style='font-size:14px;'>
                <thead>
                <tr>
                <th width='5%'>ID</th>
                <th width='5%'>Airlines</th>
                <th width='5%'>Type / </br>
                Category</th>
                <th width='5%'>From</th>
                <th width='5%'>To</th>
                <th width='5%'>Out</th>
                <th width='5%'>Type</th>
                <th width='5%'>Price ( adt / chd / inf )</th>
                <th width='5%'>Tax ( adt / chd / inf )</th>
                <th width='5%' >Total( adt / chd / inf )</th>
                <th width='5%' colspan='2'>Date</th>
                <th width='5%' colspan='2'>Detail Flight</th>
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

                $cekadtpricekurs = $row['kurs_price'];
                $cekchdpricekurs = $row['kurs_price'];
                $cekinfpricekurs = $row['kurs_price'];

                if($cekadtpricekurs=='IDR'){
                  $adtprice = (int)$row['adt_price'];

                }else{
                  $query_kurs = "SELECT * FROM kurs_live WHERE name=".$cekadtpricekurs;
                  $rs_kurs=mysqli_query($con,$query_kurs);
                  $row_kurs = mysqli_fetch_array($rs_kurs);

                  $adtprice = (int)$row['adt_price'] * $row_kurs['jual'];
                }

                if(substr($row['chd_price'],-1)!='%'){
                  if($cekchdpricekurs=='IDR'){
                    $chdprice = (int)$row['chd_price'];
                  }else{
                    $query_kurs = "SELECT * FROM kurs_live WHERE name=".$cekchdpricekurs;
                    $rs_kurs=mysqli_query($con,$query_kurs);
                    $row_kurs = mysqli_fetch_array($rs_kurs);

                    $chdprice = (int)$row['chd_price'] * $row_kurs['jual'];
                  }
                }else{
                  $chdpersen = substr($row['chd_price'],0,-1);
                  $chdprice = (int)$chdpersen * $adtprice / 100;
                }


                if(substr($row['inf_price'],-1)!='%'){
                  if($cekinfpricekurs=='IDR'){
                    $infprice = (int)$row['inf_price'];
                  }else{
                    $query_kurs = "SELECT * FROM kurs_live WHERE name=".$cekinfpricekurs;
                    $rs_kurs=mysqli_query($con,$query_kurs);
                    $row_kurs = mysqli_fetch_array($rs_kurs);

                    $infprice = (int)$row['inf_price'] * $row_kurs['jual'];
                  }
                 
                }else{
                  $infpersen = substr($row['inf_price'],0,-1);
                  $infprice = (int)$infpersen * $adtprice / 100;
                }

                $cekadttaxkurs = $row['kurs_tax'];
                $cekchdtaxkurs = $row['kurs_tax'];
                $cekinftaxkurs = $row['kurs_tax'];


                
                if($cekadttaxkurs=='IDR'){
                  $adttax = (int)$row['adt_tax'];

                }else{
                  $query_kurs = "SELECT * FROM kurs_live WHERE name=".$cekadttaxkurs;
                  $rs_kurs=mysqli_query($con,$query_kurs);
                  $row_kurs = mysqli_fetch_array($rs_kurs);

                  $adttax = (int)$row['adt_tax'] * $row_kurs['jual'];
                }

                if($cekchdtaxkurs=='IDR'){
                  $chdtax = (int)$row['chd_tax'];

                }else{
                  $query_kurs = "SELECT * FROM kurs_live WHERE name=".$cekchdtaxkurs;
                  $rs_kurs=mysqli_query($con,$query_kurs);
                  $row_kurs = mysqli_fetch_array($rs_kurs);

                  $chdtax = (int)$row['chd_tax'] * $row_kurs['jual'];
                }

                if($cekinftaxkurs=='IDR'){
                  $inftax = (int)$row['inf_tax'];

                }else{
                  $query_kurs = "SELECT * FROM kurs_live WHERE name=".$cekinftaxkurs;
                  $rs_kurs=mysqli_query($con,$query_kurs);
                  $row_kurs = mysqli_fetch_array($rs_kurs);

                  $inftax = (int)$row['inf_tax'] * $row_kurs['jual'];
                }
              

                $totalpriceadt = $totalprice + $adtprice + $adttax;
                $totalpricechd = $totalprice + $chdprice + $chdtax;
                $totalpriceinf = $totalprice + $infprice + $inftax;
                // if($row['selling_adt_price']!=0){
                // 	$totalsellingprice = $totalsellingprice + ($row['adt']*($row['selling_adt_price']));
                // }
                // if($row['selling_chd_price']!=0){
                // 	$totalsellingprice = $totalsellingprice + ($row['chd']*($row['selling_chd_price']));
                // }
                // if($row['selling_inf_price']!=0){
                // 	$totalsellingprice = $totalsellingprice + ($row['inf']*($row['selling_inf_price']));
                // }

                // $totallabakotor = $totalsellingprice - $totalprice;
                // while($rowdetailpayment = mysqli_fetch_array($rsdetailpayment)){
                // 	if($rowdetailpayment['img_bukti_bayar']!='' OR $rowdetailpayment['bukti_pembayaran']!=''){
                // 		$totaldibayarkansupplier = $totaldibayarkansupplier + $rowdetailpayment['total_dibayarkan'];
                // 	}
                // 	$total_pembayaran = $rowdetailpayment['total_pembayaran'];
                // }

                // $querypayment = "SELECT * FROM payment_detail_flight WHERE invoice_id=".$row['id'];
                // $rspayment = mysqli_query($con,$querypayment);
                // $totaldibayarkan = 0;
                // $totalkekurangan = 0;
                // while($rowpayment = mysqli_fetch_array($rspayment)){
                // 	$totaldibayarkan = $totaldibayarkan + $rowpayment['payment_price'];
                // }
                // $totalkekurangan = $totalsellingprice - $totaldibayarkan;
                // $totalkekurangan = $totalkekurangan * -1;
                // $totalkekurangansupplier = $total_pembayaran - $totaldibayarkansupplier;
               
                
                
                    echo"
                  <tr style='font-weight:bold;color:black'>";
                  

                  $queryairlines = "SELECT * FROM airlines WHERE id=".$row['airlines_id'];
                  $rsairlines = mysqli_query($con,$queryairlines);
                  $rowairlines = mysqli_fetch_array($rsairlines);
                  $tempId = (int)$row['id'] + 20000; 
                  echo "<td>".$tempId."</td>";
                  echo "<td>".$rowairlines['nama']."</br> ( Code : ".$tempId." )</td>";
                  echo "<td>".$row['flight_type']."</br></br>";
                  echo $row['flight_category']."</br>
                  Seat : ".$row['total_seat']."</br>
                  Foc  : ".$row['total_foc']."</br>
                  Tax FOC : Rp ".number_format($row['tax_foc'], 0, ".", ".")."</br></td>";
                  $query_cityTo = "SELECT * FROM city WHERE id=".$row['city_to'];
                  $rs_cityTo=mysqli_query($con,$query_cityTo);
                  $row_cityTo = mysqli_fetch_array($rs_cityTo);

                  echo "<td>".$row['destination_from']."</br>";
                  $query_cityOut = "SELECT * FROM city WHERE id=".$row['city_from'];
                  $rs_cityOut=mysqli_query($con,$query_cityOut);
                  $row_cityOut = mysqli_fetch_array($rs_cityOut);
                  if($row['city_from']!=0){
                    echo "( ".$row_cityOut['name']. " )";
                  }else{
                    echo " - ";
                  }

                  echo "</td>";
                  echo "<td>".$row['destination_to']."</br>";
                  $query_cityTo = "SELECT * FROM city WHERE id=".$row['city_to'];
                  $rs_cityTo=mysqli_query($con,$query_cityTo);
                  $row_cityTo = mysqli_fetch_array($rs_cityTo);
                  if($row['city_to']!=0){
                  	echo "( ".$row_cityTo['name']. " )";
                  }else{
                  	echo " - ";
                  }

                  echo "</br>";
                  $query_countryTo = "SELECT * FROM country WHERE id=".$row['country_to'];
                  $rs_countryTo=mysqli_query($con,$query_countryTo);
                  $row_countryTo = mysqli_fetch_array($rs_countryTo);

                  if($row['country_to']!=0){
                    echo "( ".$row_countryTo['name']. " )";
                  }else{
                    echo " - ";
                  }

                  echo "</br></br> ( ";
                  $query_itin = "SELECT DISTINCT(itinerary_category_arrival) FROM flight_quotation WHERE itinerary_category_arrival > 0 AND id=".$row['id'];
                  $rs_itin=mysqli_query($con,$query_itin);
                  $row_itin = mysqli_fetch_array($rs_itin);

                  $query_itinerary_category = "SELECT * FROM itinerary_category_arrival WHERE id=".$row_itin['itinerary_category_arrival'];
                  $rs_itinerary_category=mysqli_query($con,$query_itinerary_category);
                  $row_itinerary_category = mysqli_fetch_array($rs_itinerary_category);

                  echo $row_itinerary_category['short']." ";

                  echo " ) </br>";

                  echo "</br> ( ";
                  $query_itin = "SELECT DISTINCT(itinerary_category_departure) FROM flight_quotation WHERE itinerary_category_departure > 0 AND id=".$row['id'];
                  $rs_itin=mysqli_query($con,$query_itin);
                  $row_itin = mysqli_fetch_array($rs_itin);

                  $query_itinerary_category = "SELECT * FROM itinerary_category_departure WHERE id=".$row_itin['itinerary_category_departure'];
                  $rs_itinerary_category=mysqli_query($con,$query_itinerary_category);
                  $row_itinerary_category = mysqli_fetch_array($rs_itinerary_category);

                  echo $row_itinerary_category['short']." ";

                  echo " ) </br>";
                  
                  // $query_city = "SELECT * FROM city";
                  // $rs_city=mysqli_query($con,$query_city);

                  // echo "<select name='city_to' id='city_out'>";
                  // while( $row_city = mysqli_fetch_array($rs_city)){
                  //   if($row_city['name']=='IDR'){
                  //     echo "<option selected='selected' value='".$row_city['name']."'>".$row_city['name']."</option>";
                  //   }else{
                  //     echo "<option value='".$row_city['name']."'>".$row_city['name']."</option>";
                  //   }
                  // }

                  // echo"</select>";
                  echo "</td>";
                  echo "<td>".$row['destination_out']."</br>";
                  $query_cityOut = "SELECT * FROM city WHERE id=".$row['city_out'];
                  $rs_cityOut=mysqli_query($con,$query_cityOut);
                  $row_cityOut = mysqli_fetch_array($rs_cityOut);
                  if($row['city_out']!=0){
                  	echo "( ".$row_cityOut['name']. " )";
                  }else{
                  	echo " - ";
                  }
                  // $query_city = "SELECT * FROM city";
                  // $rs_city=mysqli_query($con,$query_city);

                  // echo "<select name='city_to' id='city_out'>";
                  // while( $row_city = mysqli_fetch_array($rs_city)){
                  //   if($row_city['name']=='IDR'){
                  //     echo "<option selected='selected' value='".$row_city['name']."'>".$row_city['name']."</option>";
                  //   }else{
                  //     echo "<option value='".$row_city['name']."'>".$row_city['name']."</option>";
                  //   }
                  // }

                  // echo"</select>";
                  echo "</td>";
                  $queryprice_type = "SELECT * FROM flight_price_type WHERE id =".$row['type'];
                  $rsprice_type=mysqli_query($con,$queryprice_type);
                  $rowprice_type = mysqli_fetch_array($rsprice_type);
                  echo "<td>".$rowprice_type['nama']."</td>";
                  echo "<td>Rp ".number_format($adtprice, 0, ".", ".")."</br>
                  Rp ".number_format($chdprice, 0, ".", ".")."</br>
                  Rp ".number_format($infprice, 0, ".", ".")."</td>";
                  echo "<td>Rp ".number_format($adttax, 0, ".", ".")."</br>
                  Rp ".number_format($chdtax, 0, ".", ".")."</br>
                  Rp ".number_format($inftax, 0, ".", ".")."</td>";
                  echo "<td>Rp ".number_format($totalpriceadt, 0, ".", ".")."</br>
                  Rp ".number_format($totalpricechd, 0, ".", ".")."</br>
                  Rp ".number_format($totalpriceinf, 0, ".", ".")."</td>";


                   echo "<td colspan='2' nowrap>";
                  $query_detail = "SELECT * FROM flight_quotation_date WHERE flight_quotation_id=".$row['id'];
                  $rs_detail=mysqli_query($con,$query_detail);
                  while($row_detail = mysqli_fetch_array($rs_detail)){
                    echo $row_detail['date']."</br>";
                  }
                  echo "</td>";
                  echo "<td colspan='2' nowrap>";
                  $query_detail = "SELECT * FROM flight_quotation_detail WHERE flight_quotation_id=".$row['id']." ORDER BY id ASC ";
                  $rs_detail=mysqli_query($con,$query_detail);
                  while($row_detail = mysqli_fetch_array($rs_detail)){
                    echo $row_detail['airlines'].$row_detail['airlines_code']." ".$row_detail['froms']." ".$row_detail['tos']." ".$row_detail['departure_time']." ".$row_detail['arrival_time']."</br></br>";
                  }
                  echo "</td>";
                 

                  if($row['staff_id']!=''){
                    $querystaff = "SELECT * FROM login_staff WHERE id=".$row['staff_id'];
                    $rsstaff = mysqli_query($con,$querystaff);
                    $rowstaff = mysqli_fetch_array($rsstaff);
                    echo "<td>".$rowstaff['name']."</br></br>
                    Rp ".number_format($row['staff_com'], 0, ".", ".")."</td>";
                  }else{
                    echo "<td>-</td>";
                  }

                  echo "<td><button type='button' class='btn btn-warning' onclick='updateManual(0,".$row['id'].",0)'><i class='fa fa-edit' aria-hidden='true''></i></button></td>";
                  
                  $grandtotalprice = $grandtotalprice + $totalprice;
                  $grandtotalsellingprice = $grandtotalsellingprice + $totalsellingprice;
                  $grandadt = $grandadt + $row['adt'];
                  $grandchd = $grandchd + $row['chd'];
                  $grandinf = $grandinf + $row['inf'];
                  $grandtotallabakotor = $grandtotallabakotor + $totallabakotor;
                  $grandtotalStaffCom = $grandtotalStaffCom + $row['staff_com'];
                  $grandtotalKekurangan = $grandtotalKekurangan + $totalkekurangan;
                }

                // echo "<tr style='font-weight:bold;'>";
                // echo "<td colspan='6'> Total : </td>";
                // echo "<td>".$grandadt."</td>";
                // echo "<td>".$grandchd."</td>";
                // echo "<td>".$grandinf."</td>";
                // echo "<td></td>";
                // echo "<td></td>";
                // echo "<td></td>";
                // echo "<td></td>";
                // echo "<td>Rp ".number_format($grandtotalsellingprice, 0, ".", ".")."</br></br>
                // Rp ".number_format($grandtotalprice, 0, ".", ".")."</td>";
                // echo "<td></td>";
                // echo "<td>Rp ".number_format($grandtotalKekurangan, 0, ".", ".")."</td>";
                // echo "<td></td>";
                // echo "<td></td>";
                // echo "<td>Rp ".number_format($grandtotallabakotor, 0, ".", ".")."</td>";
                // echo "<td></td>";
                // echo "<td></td>";
                // echo "<td></td>";
                // echo "<td></td>";
                // echo "<td>Rp ".number_format($grandtotalStaffCom, 0, ".", ".")."</td>";
                // echo "<td></td>";

          
              
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

      if(type==2){

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
          url: 'insertFlightQuotation.php',
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
          url: 'insertFlightQuotation.php',
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
          url:'getFlightQuotation.php',
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

   //  function editButton(x){
   //    var fd = new FormData();
   //    var profit = $("input[name=profit]").val();
   //    var bagasi = $("input[name=bagasi]").val();
   //    var meal = $("input[name=meal]").val();
   //    fd.append('profit',profit);
   //    fd.append('bagasi',bagasi);
   //    fd.append('meal',meal);
   //    fd.append('id',x);

      
   //     $.ajax({
   //      url: 'updateProfitFlight.php',
   //      type: 'post',
   //      data: fd,
   //      contentType: false,
   //      processData: false,
   //      success: function(response){
   //       if(response=="success"){
   //        alert(response);
   //      }

   //    },
   //  });
   // }

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

