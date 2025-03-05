<?php
include "../site.php";
include "../db=connection.php";

$query2 = "SELECT * FROM staff_type";
$rs2=mysqli_query($con,$query2);

$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);

$querycontinent = "SELECT * FROM continent";
$rscontinent=mysqli_query($con,$querycontinent);

$queryembassy = "SELECT * FROM embassy";
$rsembassy=mysqli_query($con,$queryembassy);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT VISA</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadVisa(1,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div >

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='insertPricePackage.php'>
                <div class='card-body'>
                  <div class='form-group'>
                    <label>Country</label>
                    <select class='chosen' name='country' id='country' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcountry = mysqli_fetch_array($rscountry)){
                      echo "<option value='".$rowcountry['id']."'>".$rowcountry['name']."</option>";
                    }
                    echo"</select>
                  </div>
                   <div class='form-group'>
                    <label>Continent</label>
                    <select class='chosen' name='continent' id='continent' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcontinent = mysqli_fetch_array($rscontinent)){
                      echo "<option value='".$rowcontinent['name']."'>".$rowcontinent['name']."</option>";
                    }
                    echo"</select>
                  </div>
                  <div class='form-group'>
                    <label>Type</label>
                    <select class='chosen' name='type' id='type' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";
                    $query_visa_type = "SELECT * FROM visa_type";
                    $rs_visa_type=mysqli_query($con,$query_visa_type);
                    while($row_visa_type = mysqli_fetch_array($rs_visa_type)){
                      echo "<option value='".$row_visa_type['name']."'>".$row_visa_type['name']."</option>";
                    }
                    
                    echo"</select>
                  </div>

                  <div class='form-group'>
                    <label>Day</label>
                    <input class='form-control' type='text' name='day' id='day' placeholder='Enter Day Process'>
                  </div>

                  <div class='form-group'>
                    <label>Visa Price</label>
                    <input class='form-control' type='text' name='price' id='price' placeholder='Enter Visa Price Rupiah'>
                  </div>


                  <div class='form-group'>
                    <label>Embassy</label>
                    <select class='chosen' name='embassy' id='embassy' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowembassy = mysqli_fetch_array($rsembassy)){
                      echo "<option value='".$rowembassy['id']."'>".$rowembassy['address']."</option>";
                    }
                    echo"</select>
                  </div>

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
    $(".chosen").chosen();

  });


  $("#but_upload").click(function(){

    var a = $("input[name=day]").val();
    var b = $("input[name=price]").val();
    var f = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;
    var g = document.getElementById("continent").options[document.getElementById("continent").selectedIndex].value;
    var h = document.getElementById("type").options[document.getElementById("type").selectedIndex].value;
    var i = document.getElementById("embassy").options[document.getElementById("embassy").selectedIndex].value;

    $.ajax({
      url:"insertVisa.php",
      method: "POST",
      asynch: false,
      data:{day:a,price:b,country:f,continent:g,type:h,embassy:i},
      success:function(data){
        alert(data);
        reloadVisa(1,0,0);
      }
    });
  });

</script>
