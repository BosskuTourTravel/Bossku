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

$query_visa = "SELECT * FROM visa WHERE id=".$_POST['id'];
$rs_visa=mysqli_query($con,$query_visa);
$row_visa = mysqli_fetch_array($rs_visa);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM UPDATE VISA</h3>
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
              <div>

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='insertPricePackage.php'>
                <div class='card-body'>
                <input type='text' name='tid' id='tid' value='".$_POST['id']."' hidden>
                  <div class='form-group'>
                    <label>Country</label>
                    <select class='chosen' name='scountry' id='country' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcountry = mysqli_fetch_array($rscountry)){
                      if($rowcountry['id']==$row_visa['country']){
                        echo "<option value='".$rowcountry['id']."' selected>".$rowcountry['name']."</option>";
                      }else{
                        echo "<option value='".$rowcountry['id']."'>".$rowcountry['name']."</option>";
                      }
                      
                    }
                    echo"</select>
                  </div>
                   <div class='form-group'>
                    <label>Continent</label>
                    <select class='chosen' name='scontinent' id='continent' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcontinent = mysqli_fetch_array($rscontinent)){
                      if($rowcontinent['name']==$row_visa['continent']){
                        echo "<option value='".$rowcontinent['name']."' selected>".$rowcontinent['name']."</option>";
                      }else{
                        echo "<option value='".$rowcontinent['name']."'>".$rowcontinent['name']."</option>";
                      }
                      
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
                      if($row_visa_type['name']==$row_visa['type']){
                        echo "<option value='".$row_visa_type['name']."' selected>".$row_visa_type['name']."</option>";
                      }else{
                        echo "<option value='".$row_visa_type['name']."'>".$row_visa_type['name']."</option>";
                      }
                      
                    }
                    
                    echo"</select>
                  </div>

                  <div class='form-group'>
                    <label>Day</label>
                    <input class='form-control' type='text' name='day' id='day' value='".$row_visa['day']."' placeholder='Enter Day Process'>
                  </div>

                  <div class='form-group'>
                    <label>Visa Price</label>
                    <input class='form-control' type='text' name='price' id='price' value='".$row_visa['price']."' placeholder='Enter Visa Price Rupiah'>
                  </div>


                  <div class='form-group'>
                    <label>Embassy</label>
                    <select class='chosen' name='embassy' id='embassy' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowembassy = mysqli_fetch_array($rsembassy)){
                      if($rowembassy['id']==$row_visa['embassy']){
                        echo "<option value='".$rowembassy['id']."' selected>".$rowembassy['address']."</option>";
                      }else{
                        echo "<option value='".$rowembassy['id']."'>".$rowembassy['address']."</option>";
                      }
                      
                    }
                    echo"</select>
                  </div>

                <div class='card-footer'>
                  <button type='button' class='btn btn-primary' onclick='updateVisa()'>Submit</button>
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
  function updateVisa(){
    var a = $("input[name=day]").val();
    var b = $("input[name=price]").val();
    var f = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;
    var g = document.getElementById("continent").options[document.getElementById("continent").selectedIndex].value;
    var h = document.getElementById("type").options[document.getElementById("type").selectedIndex].value;
    var i = document.getElementById("embassy").options[document.getElementById("embassy").selectedIndex].value;
    var tid = $("input[name=tid]").val();

    $.ajax({
        url:"updateVisa.php",
        method: "POST",
        asynch: false,
        data:{day:a,price:b,country:f,continent:g,type:h,embassy:i,id:tid},
        success:function(data){
          alert(data);
          reloadVisa(1,0,0);
        }
      });
    
  }
</script>
