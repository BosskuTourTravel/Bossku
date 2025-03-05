 <?php
 include "../site.php";
 include "../db=connection.php";
 $phone = $_POST['phone'];



 $query2 = "SELECT COUNT(*) as total FROM customer_list WHERE phone_number LIKE '".$phone."'";
 $rs2=mysqli_query($con,$query2);
 $row2 = mysqli_fetch_assoc($rs2);

 if($row2['total']>0){
   $query = "SELECT * FROM customer_list WHERE phone_number LIKE '".$phone."'";
   $rs=mysqli_query($con,$query);
   $row = mysqli_fetch_array($rs);

   echo "<div class='form-group'>
   <label>Customer Name</label>
   <input type='text' class='form-control' name='name' id='name' value='".$row['customer_name']."' placeholder='Enter Customer Name'>
   </div>

   <div class='form-group'>
  <label>Customer Address</label>
  <input type='text' class='form-control' name='address' id='address' placeholder='Enter Customer Adress'>
  </div>

   <div class=form-group'>
  <label>Customer Category</label>
  <select class='chosen' name='customer_category' id='customer_category' style='width: 100%;'>
  <option selected='selected' value=0>Pilihan</option>";

  
  $query_category = "SELECT * FROM customer_category";
  $rs_category=mysqli_query($con,$query_category);
  while($row_category = mysqli_fetch_array($rs_category)){
    echo "<option value='".$row_category['name']."'>".$row_category['name']."</option>";
  }
  
  echo"</select>
  </div>

   <div class='form-group'>
   <label>Tour Type</label>
   <input type='text' class='form-control' name='type' id='type' placeholder='Enter Tour Type'>
   </div>
   <div class='form-group'>
   <label>Destination</label>
   <input type='text' class='form-control' name='destination' id='destination' placeholder='Enter Destination'>
   </div>
   <div class='form-group'>
   <label>Departure / Remarks</label>
   <input type='text' class='form-control' name='departure' id='departure' placeholder='Enter Departure Date'>
   </div>
   <div class='form-group'>
   <label>Total Pax</label>
   <input type='text' class='form-control' name='pax' id='pax' placeholder='Enter Total Pax'>
   </div>
   <div class=form-group'>
   <label>Month Planning</label>
   <select class='chosen' name='month' id='month' style='width: 100%;'>
   <option selected='selected' value=0>Pilihan</option>";

   for ($x = 0; $x < 2; $x++) {
    $querymonth = "SELECT * FROM month";
    $rsmonth=mysqli_query($con,$querymonth);
     while($rowmonth = mysqli_fetch_array($rsmonth)){
      if($x==0){
        echo "<option value='".$rowmonth['name']." 2020'>".$rowmonth['name']." 2020</option>";
      }else{
        echo "<option value='".$rowmonth['name']." 2021'>".$rowmonth['name']." 2021</option>";
      }
    }
  }
  
  echo"</select>
  </div>
  <div class='form-group'>
  <label>Email</label>
  <input type='email' class='form-control' name='email' id='email' value='".$row['email']."' placeholder='Enter Email'>
  </div>
  <div class='form-group'>
  <label>Customer From</label>
  <input type='text' class='form-control' name='from' id='from' value='".$row['customer_from']."' placeholder='Enter Customer From'>
  </div>
  <div class='form-group'>
  <label>City</label>
  <select class='chosen' name='cityc' id='cityc' style='width: 100%;'>
  <option selected='selected' value=0>Pilihan</option>";
  if($row['city']=='Surabaya'){
    echo "<option selected value='Surabaya'>Surabaya</option>";
  }else{
    echo "<option selected value='Batam'>Batam</option>";
  }
  echo"</select>
  </div>";


}else{
  echo "<div class='form-group'>
  <label>Customer Name</label>
  <input type='text' class='form-control' name='name' id='name' placeholder='Enter Customer Name'>
  </div>

  <div class='form-group'>
  <label>Customer Address</label>
  <input type='text' class='form-control' name='address' id='address' placeholder='Enter Customer Adress'>
  </div>

  <div class=form-group'>
  <label>Customer Category</label>
  <select class='chosen' name='customer_category' id='customer_category' style='width: 100%;'>
  <option selected='selected' value=0>Pilihan</option>";

  
  $query_category = "SELECT * FROM customer_category";
  $rs_category=mysqli_query($con,$query_category);
  while($row_category = mysqli_fetch_array($rs_category)){
    echo "<option value='".$row_category['name']."'>".$row_category['name']."</option>";
  }
  
  echo"</select>
  </div>

  <div class='form-group'>
  <label>Tour Type</label>
  <input type='text' class='form-control' name='type' id='type' placeholder='Enter Tour Type'>
  </div>
  <div class='form-group'>
  <label>Destination</label>
  <select name='country_count' id='country_count'>
  <option selected='selected' value=0>Jumlah Country</option>";

  for ($x = 1; $x <= 20; $x++){
    echo "<option value=".$x.">".$x."</option>";
  }
  echo "</select></div>
  <div class=form-group' name='divcountry' id='divcountry'></div>
  </br>
  </div>
  <div class='form-group'>
  <label>Departure / Remarks</label>
  <input type='text' class='form-control' name='departure' id='departure' placeholder='Enter Departure Date'>
  </div>
  <div class='form-group'>
  <label>Total Pax</label>
  <input type='text' class='form-control' name='pax' id='pax' placeholder='Enter Total Pax'>
  </div>
  <div class=form-group'>
  <label>Month Planning</label>
  <select class='chosen' name='month' id='month' style='width: 100%;'>
  <option selected='selected' value=0>Pilihan</option>";

  for ($x = 0; $x < 2; $x++) {
    $querymonth = "SELECT * FROM month";
    $rsmonth=mysqli_query($con,$querymonth);
     while($rowmonth = mysqli_fetch_array($rsmonth)){
      if($x==0){
        echo "<option value='".$rowmonth['name']." 2020'>".$rowmonth['name']." 2020</option>";
      }else{
        echo "<option value='".$rowmonth['name']." 2021'>".$rowmonth['name']." 2021</option>";
      }
    }
  }
  echo"</select>
  </div>
  <div class='form-group'>
  <label>Email</label>
  <input type='email' class='form-control' name='email' id='email' placeholder='Enter Email'>
  </div>
  <div class='form-group'>
  <label>Customer From</label>
  <input type='text' class='form-control' name='from' id='from' placeholder='Enter Customer From'>
  </div>
  <div class='form-group'>
  <label>City</label>
  <select class='chosen' name='cityc' id='cityc' style='width: 100%;'>
  <option selected='selected' value=0>Pilihan</option>";
  echo "<option value='Surabaya'>Surabaya</option>";
  echo "<option value='Batam'>Batam</option>";
  echo"</select>
  </div>";
}



?>


<script>
 $(document).ready(function(){
  $(".chosen").chosen();
});
 $('#country_count').on('change', function() {
        var count = this.value;
        $.ajax({
          type:'POST',
          url:'getCustomerListCountry.php',
          data:{'count':count},
          success:function(data){
           $('#divcountry').html(data);
         }
       });
      });
</script>