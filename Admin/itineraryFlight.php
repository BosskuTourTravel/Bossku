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
<div>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>Itinerary Flight</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    
                    <div class='input-group-append'>

                      
                    </div>
                  </div>
                </div>
              </div>
              
              <div>
                           
                    <div id='divInput'  style='font-size:13px; margin-left:1%;margin-top:1%;'>
                     <div class='form-row align-items-center' style='text-align:center;'> 
                                <span onclick='seeInput(0)'><i class='fa fa-eye-slash' aria-hidden='true'> HIDE </i></span>
                                  |
                                <span onclick='seeInput(1)'><i class='fa fa-eye' aria-hidden='true'> UNHIDE</i></span>
                            </div>
                            </br>
                              <div class='form-row align-items-center'>
                              		<div class='col-2'>
                                        <label>Flight Type</label></br>
                                        <select class='chosen' name='flight_type' id='flight_type' style='width: 80%'>
                                        <option selected='selected' value='FIT'>FIT</option>

                                        <option value='Group'>Group</option>";

                                        echo"</select>
                                    </div>
                                    <div class='col-2'>
                                    <label>Tipe Harga</label>
                                    <select class='chosen' name='type_price' id='type_price' style='width: 80%'>";
                                    $queryprice_type = "SELECT * FROM flight_price_type";
                                    $rsprice_type=mysqli_query($con,$queryprice_type);
                                    while($rowprice_type = mysqli_fetch_array($rsprice_type)){
                                      echo "<option value='".$rowprice_type['id']."'>".$rowprice_type['nama']."</option>";
                                    }
                                    echo "</select>
                                    </div>
                                    <div class='col-2'>
                                        <label>City From</label></br>
                                        <select class='chosen' name='city_from' id='city_from' style='width:80%'>";
                                        $query_city = "SELECT DISTINCT(city_from) FROM flight_quotation";
                                        $rs_city=mysqli_query($con,$query_city);
                                        while($row_city = mysqli_fetch_array($rs_city)){
                                          $query_cityFlight = "SELECT * FROM city WHERE id=".$row_city['city_from'];
                                          $rs_cityFlight=mysqli_query($con,$query_cityFlight);
                                          $row_cityFlight = mysqli_fetch_array($rs_cityFlight);
                                          echo "<option value='".$row_cityFlight['id']."'>".$row_cityFlight['name']."</option>";
                                        }
                                        echo"</select>
                                    </div>
                                     <div class='col-2'>
                                        <label>Country To</label></br>
                                        <select class='chosen' name='country_to' id='country_to' style='width:80%'>";
                                        $query_city = "SELECT DISTINCT(country_to) FROM flight_quotation";
                                        $rs_city=mysqli_query($con,$query_city);
                                        echo "<option value='0'>Pilihan</option>";
                                        while($row_city = mysqli_fetch_array($rs_city)){
                                          $query_cityFlight = "SELECT * FROM country WHERE id=".$row_city['country_to'];
                                          $rs_cityFlight=mysqli_query($con,$query_cityFlight);
                                          $row_cityFlight = mysqli_fetch_array($rs_cityFlight);
                                          echo "<option value='".$row_cityFlight['id']."'>".$row_cityFlight['name']."</option>";
                                        }
                                        echo"</select>
                                    </div>  
                                    <div class='col-2'>
                                        <label>City To</label></br>
                                        <select class='chosen' name='city_to' id='city_to' style='width:80%'>";
                                        $query_city = "SELECT DISTINCT(city_to) FROM flight_quotation";
                                        $rs_city=mysqli_query($con,$query_city);
                                        echo "<option value='0'>Pilihan</option>";
                                        while($row_city = mysqli_fetch_array($rs_city)){
                                          $query_cityFlight = "SELECT * FROM city WHERE id=".$row_city['city_to'];
                                          $rs_cityFlight=mysqli_query($con,$query_cityFlight);
                                          $row_cityFlight = mysqli_fetch_array($rs_cityFlight);
                                          echo "<option value='".$row_cityFlight['id']."'>".$row_cityFlight['name']."</option>";
                                        }
                                        echo"</select>
                                    </div> 
                                    <div class='col-2'>
                                        <label>City Out</label></br>
                                        <select class='chosen' name='city_out' id='city_out' style='width:80%'>";
                                        $query_city = "SELECT DISTINCT(city_out) FROM flight_quotation";
                                        $rs_city=mysqli_query($con,$query_city);
                                        echo "<option value='-1'>Select All</option>";
                                        while($row_city = mysqli_fetch_array($rs_city)){
                                          $query_cityFlight = "SELECT * FROM city WHERE id=".$row_city['city_out'];
                                          $rs_cityFlight=mysqli_query($con,$query_cityFlight);
                                          $row_cityFlight = mysqli_fetch_array($rs_cityFlight);
                                          echo "<option value='".$row_cityFlight['id']."'>".$row_cityFlight['name']."</option>";
                                        }
                                        echo"</select>
                                    </div>
                                    <div id='divAirlinesFlight'>
                                     <div class='col-2'>
                                        <label>Airlines</label></br>
                                        <select class='chosen' name='airlines' id='airlines'>";
                                        $query_airlines = "SELECT DISTINCT airlines_id,flight_type,kurs_price FROM flight_quotation";
                                        $rs_airlines=mysqli_query($con,$query_airlines);
                                        while($row_airlines = mysqli_fetch_array($rs_airlines)){
                                          // $cekadtpricekurs = $row_airlines['kurs_price'];

                                          // if($cekadtpricekurs=='IDR'){
                                          //   $adtprice = (int)$row_airlines['adt_price'];

                                          // }else{
                                          //   $query_kurs = "SELECT * FROM kurs_live WHERE name=".$cekadtpricekurs;
                                          //   $rs_kurs=mysqli_query($con,$query_kurs);
                                          //   $row_kurs = mysqli_fetch_array($rs_kurs);

                                          //   $adtprice = (int)$row_airlines['adt_price'] * $row_kurs['jual'];
                                          // }
                                          $query_flight = "SELECT * FROM airlines WHERE id=".$row_airlines['airlines_id'];
                                          $rs_flight=mysqli_query($con,$query_flight);
                                          $row_flight = mysqli_fetch_array($rs_flight);
                                          echo "<option value='".$row_airlines['airlines_id'] ."-".$row_airlines['flight_type']."-".$row_airlines['adt_price']."'>".$row_flight['nama'] ." - ".$row_airlines['flight_type']."</option>";
                                        }
                                        echo"</select>
                                    </div>
                                  </div>
                                    
                                    

                            </div>
                            
                              </br>
                              <center><div class='col-4'>
                                    <button type='button' class='btn btn-primary' id='but_upload'>Submit</button>
                                    </div></center>
                             
                            
                            </div>
                            ";
                            
                            
              echo "</div></div>
              <!-- /.card-header -->

              <div class='container-fluid'>
              <div id='divItinerary'>

              </div>";
            

     


               

              echo "</div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
          </div>
          </div>
        </div>
        <!-- /.row -->
</div>";
?>

<script>
 var availableTags = [];
  $(document).ready(function(){
    $(".chosen").chosen();
    // $(document).ajaxStart(function(){
    //   //$("#wait").css("display", "block");
    //   $('#divInput').css('opacity', '0.3');
    //   $('#divItinerary').css('opacity', '0.3');

    // });
    // $(document).ajaxComplete(function(){
    //   //$("#wait").css("display", "none");
    //   $('#divItinerary').css('opacity', '1');
    // });
    });

  // $('#city_to').on('change', function() {
  //     $("#country_to").prop( "disabled", true );
  //   });
   $('#flight_type').on('change', function() {
    var flight_type = document.getElementById("flight_type").options[document.getElementById("flight_type").selectedIndex].value;
    var city_from = document.getElementById("city_from").options[document.getElementById("city_from").selectedIndex].value;
    var city_to = document.getElementById("city_to").options[document.getElementById("city_to").selectedIndex].value;
    var country_to = document.getElementById("country_to").options[document.getElementById("country_to").selectedIndex].value;
    var city_out = document.getElementById("city_out").options[document.getElementById("city_out").selectedIndex].value;
    var type_price = document.getElementById("type_price").options[document.getElementById("type_price").selectedIndex].value;

        $.ajax({
          type:'POST',
          url:'getItineraryFlight.php',
          data:{'city_from':city_from,'city_to':city_to,'city_out':city_out,'country_to':country_to,'flight_type':flight_type,'type_price':type_price},
          success:function(data){
           $('#divAirlinesFlight').html(data);
         }
       });
    });
  $('#type_price').on('change', function() {
    var flight_type = document.getElementById("flight_type").options[document.getElementById("flight_type").selectedIndex].value;
    var city_from = document.getElementById("city_from").options[document.getElementById("city_from").selectedIndex].value;
    var city_to = document.getElementById("city_to").options[document.getElementById("city_to").selectedIndex].value;
    var country_to = document.getElementById("country_to").options[document.getElementById("country_to").selectedIndex].value;
    var city_out = document.getElementById("city_out").options[document.getElementById("city_out").selectedIndex].value;
    var type_price = document.getElementById("type_price").options[document.getElementById("type_price").selectedIndex].value;

        $.ajax({
          type:'POST',
          url:'getItineraryFlight.php',
          data:{'city_from':city_from,'city_to':city_to,'city_out':city_out,'country_to':country_to,'flight_type':flight_type,'type_price':type_price},
          success:function(data){
           $('#divAirlinesFlight').html(data);
         }
       });
    });
  $('#city_out').on('change', function() {
  	var flight_type = document.getElementById("flight_type").options[document.getElementById("flight_type").selectedIndex].value;
    var city_from = document.getElementById("city_from").options[document.getElementById("city_from").selectedIndex].value;
    var city_to = document.getElementById("city_to").options[document.getElementById("city_to").selectedIndex].value;
    var country_to = document.getElementById("country_to").options[document.getElementById("country_to").selectedIndex].value;
    var city_out = document.getElementById("city_out").options[document.getElementById("city_out").selectedIndex].value;
    var type_price = document.getElementById("type_price").options[document.getElementById("type_price").selectedIndex].value;

        $.ajax({
          type:'POST',
          url:'getItineraryFlight.php',
          data:{'city_from':city_from,'city_to':city_to,'city_out':city_out,'country_to':country_to,'flight_type':flight_type,'type_price':type_price},
          success:function(data){
           $('#divAirlinesFlight').html(data);
         }
       });
    });

  $('#country_to').on('change', function() {
  	var flight_type = document.getElementById("flight_type").options[document.getElementById("flight_type").selectedIndex].value;
    var city_from = document.getElementById("city_from").options[document.getElementById("city_from").selectedIndex].value;
    var city_to = document.getElementById("city_to").options[document.getElementById("city_to").selectedIndex].value;
    var country_to = document.getElementById("country_to").options[document.getElementById("country_to").selectedIndex].value;
    var city_out = document.getElementById("city_out").options[document.getElementById("city_out").selectedIndex].value;
    var type_price = document.getElementById("type_price").options[document.getElementById("type_price").selectedIndex].value;

        $.ajax({
          type:'POST',
          url:'getItineraryFlight.php',
          data:{'city_from':city_from,'city_to':city_to,'city_out':city_out,'country_to':country_to,'flight_type':flight_type,'type_price':type_price},
          success:function(data){
           $('#divAirlinesFlight').html(data);
         }
       });
    });

  $('#city_to').on('change', function() {
    $('#country_to').val(0);
    var flight_type = document.getElementById("flight_type").options[document.getElementById("flight_type").selectedIndex].value;
    var city_from = document.getElementById("city_from").options[document.getElementById("city_from").selectedIndex].value;
    var city_to = document.getElementById("city_to").options[document.getElementById("city_to").selectedIndex].value;
    var country_to = document.getElementById("country_to").options[document.getElementById("country_to").selectedIndex].value;
    var city_out = document.getElementById("city_out").options[document.getElementById("city_out").selectedIndex].value;
    var type_price = document.getElementById("type_price").options[document.getElementById("type_price").selectedIndex].value;

        $.ajax({
          type:'POST',
          url:'getItineraryFlight.php',
          data:{'city_from':city_from,'city_to':city_to,'city_out':city_out,'country_to':country_to,'flight_type':flight_type,'type_price':type_price},
          success:function(data){
           $('#divAirlinesFlight').html(data);
         }
       });
    });

   $('#city_from').on('change', function() {
   	var flight_type = document.getElementById("flight_type").options[document.getElementById("flight_type").selectedIndex].value;
    var city_from = document.getElementById("city_from").options[document.getElementById("city_from").selectedIndex].value;
    var city_to = document.getElementById("city_to").options[document.getElementById("city_to").selectedIndex].value;
    var country_to = document.getElementById("country_to").options[document.getElementById("country_to").selectedIndex].value;
    var city_out = document.getElementById("city_out").options[document.getElementById("city_out").selectedIndex].value;
    var type_price = document.getElementById("type_price").options[document.getElementById("type_price").selectedIndex].value;

        $.ajax({
          type:'POST',
          url:'getItineraryFlight.php',
          data:{'city_from':city_from,'city_to':city_to,'city_out':city_out,'country_to':country_to,'flight_type':flight_type,'type_price':type_price},
          success:function(data){
           $('#divAirlinesFlight').html(data);
         }
       });
    });

   $("#but_upload").click(function(){
      var fd = new FormData();
      const monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN",
      "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"
      ];
      var country_to = document.getElementById("country_to").options[document.getElementById("country_to").selectedIndex].value;
      var city_from = document.getElementById("city_from").options[document.getElementById("city_from").selectedIndex].value;
      var city_to = document.getElementById("city_to").options[document.getElementById("city_to").selectedIndex].value;
      var city_out = document.getElementById("city_out").options[document.getElementById("city_out").selectedIndex].value;
      var airlines = document.getElementById("airlines").options[document.getElementById("airlines").selectedIndex].value;
      var flight_type = document.getElementById("flight_type").options[document.getElementById("flight_type").selectedIndex].value;
      var airlinesArray = airlines.split(/[.,\/ -]/);
      var airlines_id = airlinesArray[0];
      var airlines_type = airlinesArray[1];
      var type_price = document.getElementById("type_price").options[document.getElementById("type_price").selectedIndex].value;
      fd.append('country_to',country_to);
      fd.append('city_from',city_from);
      fd.append('city_to',city_to);
      fd.append('city_out',city_out);
      fd.append('airlines_id',airlines_id);
      fd.append('airlines_type',airlines_type);
      fd.append('flight_type',flight_type);
      fd.append('type_price',type_price);

      var x = document.getElementById("airlines");
      var airlinesArray = [];
      var countAirlines = 0;
      var i;
      for (i = 0; i < x.length; i++) {
        if(x.options[i].value!='0' || x.options[i].value!=0){
          var tempString = x.options[i].value;
          var find = tempString.indexOf("-");
          var tempValue = tempString.substring(0,find);
          airlinesArray.push(tempValue);
          countAirlines = countAirlines + 1;
          
        }
        
      }

      // for (i = 0; i < airlinesArray.length; i++) {
      //   alert(airlinesArray[i]);
      // }
      airlinesArray = JSON.stringify(airlinesArray);
      fd.append('airlinesArray',airlinesArray);
      // if(airlines==0){
      //   alert('Tidak Bisa Melakukan Kombinasi Karena Flight Tidak Tersedia');
      // }else{
      //   $.ajax({
      //     url: 'searchLandTourFlightCity.php',
      //     type: 'post',
      //     data: fd,
      //     contentType: false,
      //     processData: false,
      //     success: function(response){
      //       $('#divItinerary').html(response);

      //     },
      //   });
      // }
      if(countAirlines==0){

        alert('Tidak Bisa Melakukan Kombinasi Karena Flight Tidak Ada');
      }else{
        $.ajax({
          url: 'searchLandTourFlightCity.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
            $('#divItinerary').html(response);

          },
        });
      }
      
    });

</script>

