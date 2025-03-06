  <script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css"/>
<!-- Script -->

<?php
include "../site.php";
include "../db=connection.php";

session_start();

$querycontinent = "SELECT * FROM continent";
$rscontinent=mysqli_query($con,$querycontinent);

$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);

$querycity = "SELECT * FROM city";
$rscity=mysqli_query($con,$querycity);

$querykurs = "SELECT * FROM kurs_bank";
$rskurs=mysqli_query($con,$querykurs);

$query_agent = "SELECT * FROM agent";
$rs_agent=mysqli_query($con,$query_agent);

$querytransport = "SELECT * FROM transport_type";
$rstransport=mysqli_query($con,$querytransport);

$queryrent_type = "SELECT * FROM rent_type";
$rsrent_type=mysqli_query($con,$queryrent_type);

$querytr = "SELECT * FROM transport_pric WHERE id=".$_POST['id'];
$rstr=mysqli_query($con,$querytr);
$rowtr = mysqli_fetch_array($rstr);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM UPDATE TRANSPORT</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadTransport(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              
              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>";
               
                     echo "<div class='form-group'>
                        <label>Agent</label>
                        <select class='chosen' name='agent' id='agent' class='form-control'>
                        <option selected='selected' value=0>Pilihan</option>";

                        while($row_agent = mysqli_fetch_array($rs_agent)){
                          if($row_agent['company']==$rowtr['agent']){
                            echo "<option selected='selected' value=".$row_agent['company'].">".$row_agent['company']."</option>";
                          }else{
                          echo "<option value='".$row_agent['id']."'>".$row_agent['company']."</option>";
                        }
                      }
                        echo"</select>
                      </div>
               
                        <div class='form-group'>
                        <label>Continent</label>
                        <select class='chosen' name='continent' id='continent'>
                        <option selected='selected' value=0>Pilihan</option>";

                        while($rowcontinent = mysqli_fetch_array($rscontinent)){
                          echo "<option value=".$rowcontinent['id'].">".$rowcontinent['name']."</option>";
                      }
                    
                       echo"</select>
                     </div>
                       <div class='form-group'>
                      <label>Country</label>
                      <select class='chosen' required name='country' id='country' style='width: 100%;'>
                      <option selected='selected' value=0>Pilihan</option>";
                      while($rowcountry = mysqli_fetch_array($rscountry)){
                      
                        echo "<option value=".$rowcountry['id'].">".$rowcountry['name']."</option>";
                      }
                    
                    echo"</select>
                  </div>
                  <div class='form-group'>
                  <label>City</label>
                  <select class='chosen' required name='city' id='city' style='width: 100%;'>
                  <option selected='selected' value=0>Pilihan</option>";
                  while($rowcity = mysqli_fetch_array($rscity)){
              
                  echo "<option value=".$rowcity['id'].">".$rowcity['name']."</option>";
                      }
                    
                  echo"</select>
                  </div>

                  <div class='form-group'>
                  <label>Transport Type</label>
                  <select class='chosen' required name='transport' id='transport' style='width: 100%;'>
                  <option selected='selected' value=0>Pilihan</option>";
                  while($rowtransport = mysqli_fetch_array($rstransport)){
                      
                      echo "<option value=".$rowtransport['id'].">".$rowtransport['name']."</option>";
                    }
                  
                    echo"</select>
                  </div>
                  <div class='form-group'>
                  <label>Seat</label>
                  <input type='text' class='form-control' name='seat' id='seat' value='".$rowtr['seat']."' placeholder='Enter Seat'>
                  </div>
                  <div class='form-group'>
                  <label>Rent Type</label>
                  <select class='chosen' required name='rent' id='rent' style='width: 100%;'>
                  <option selected='selected' value=0>Pilihan</option>";

                    while($rowrent_type = mysqli_fetch_array($rsrent_type)){
                      
                      echo "<option value=".$rowrent_type['id'].">".$rowrent_type['nama']."</option>";
                    
                  }
                    echo"</select>
                   </div>
                  <div class='form-group'>
                    <label>Duration</label>
                    <input type='text' class='form-control' name='duration' id='duration' value='".$rowtr['duration']."' placeholder='Enter Duration'>
                  </div>
                  <div class='form-group'>
                  <label>Price</label>
                  <select name='kurs' id='kurs'>
                  <option selected='selected' value=0>Pilihan Kurs</option>";

                    while($rowkurs = mysqli_fetch_array($rskurs)){
                      echo "<option value=".$rowkurs['id'].">".$rowkurs['name']."</option>";
                    }
                    echo"</select>
                    <input class='form-control' type='price' name='price' value='".$rowtr['price']."' placeholder ='Enter Price' style='width: 100%;' />
                  </div>
                  <div class='form-group'>
                  <label>Tipping</label>
                  <input type='text' class='form-control' name='tipping' id='tipping' value='".$rowtr['tipping']."' placeholder='Enter Tipping'>
                  </div>
                  <label>Charge</label>
                  <input type='text' class='form-control' name='charge' id='charge' value='".$rowtr['charge']."' placeholder='Enter Charge'>
                  </div>
                  <div class='form-row ml-3'>
                    <div class='form-group'>
                    <label>Tanggal Pergi</label>
                    <input type='text' class='form-control' name='tglpergi' id='tglpergi' value='".$rowtr['tglpergi']."' placeholder='Enter Date'>
                    </div>
                    <div class='form-group'>
                    <label>Tanggal Pulang</label>
                    <input type='text' class='form-control' name='tglpulang' id='tglpulang' value='".$rowtr['tglpulang']."' placeholder='Enter Date'>
                    </div>
                  </div>
                  </div>";
                    
                echo "</div>

                <div class='card-footer'>
                  <button type='button' class='btn btn-primary' id='but_upload'>Submit</button>
                </div>
              </form>
            </div>

              </div>
            </div>
          </div>
        </div>
</div>";
?>

<script>

  $(document).ready(function(){
    $.datepicker.setDefaults({
    dateFormat: 'yy-mm-dd'
  });
    $(".chosen").chosen();
  });
  $(function(){
    $("#tglpergi").datepicker();
    $("#tglpulang").datepicker();
  });
  


  $("#but_upload").click(function(){
    var b = document.getElementById("agent").options[document.getElementById("agent").selectedIndex].value;
    var c = document.getElementById("continent").options[document.getElementById("continent").selectedIndex].value;
    var d = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;
    var e = document.getElementById("city").options[document.getElementById("city").selectedIndex].value;
    var f = document.getElementById("transport").options[document.getElementById("transport").selectedIndex].value;
    var g = $("input[name=seat]").val();
    var h = document.getElementById("rent").options[document.getElementById("rent").selectedIndex].value;
    var i = $("input[name=duration]").val();
    var j = $("input[name=price]").val();
    var k = document.getElementById("kurs").options[document.getElementById("kurs").selectedIndex].value;
    var l = $("input[name=tipping]").val();
    var m = $("input[name=charge]").val();
    var n = $("input[name=tglpergi]").val();
    var o = $("input[name=tglpulang]").val();

   // var stringDate = String($('input[name="traveldate"]').val());
     //   var start = new Date(stringDate.substr(0, 10));
      //  var end = new Date(stringDate.substr(13, 24));
     //   var DateString = "";
      //  for (var i = 0; i < 2; i++) {
      //    if(i==0){
      //      date = new Date(start);
      //    }else{
      //      date = new Date(end);
      //    }
      //    var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
      //    var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
      //    var year = date.getFullYear();
      //    if(month==1){
         //   month = "Jan";
         // }else if(month==2){
         //   month = "Feb";
         // }else if(month==3){
         //   month = "Mar";
          //}else if(month==4){
          //  month = "Apr";
          //}else if(month==5){
          //  month = "May";
         // }else if(month==6){
         //   month = "Jun";
         // }else if(month==7){
         //   month = "Jul";
         // }else if(month==8){
         //   month = "Aug";
          //}else if(month==9){
         //   month = "Sep";
         // }else if(month==10){
         //   month = "Oct";
         // }else if(month==11){
          //  month = "Nov";
          //}else if(month==12){
         //   month = "Dec";
         // }
         // if(i==0){
         //   dateString = day+" "+month+" "+year;
         // }else{
          //  dateString = dateString +" - "+day+" "+month+" "+year;
        //  }
        //}
        //var n = dateString;
    
    $.ajax({
      url:"updateTransport.php",
      method: "POST",
      asynch: false,
      data:{'agent':b,'continent':c,'country':d,'city':e,'transport':f,'seat':g,'rent':h, 'duration':i, 'price':j, 'kurs':k, 'tipping':l, 'charge':m, 'tglpergi':n, 'tglpulang':o},
      success:function(data){
        reloadTransport(0,0,0);
      }
    });

  });
</script>
