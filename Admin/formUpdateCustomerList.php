<?php
include "../site.php";
include "../db=connection.php";

$querycustomer = "SELECT * FROM customer_list WHERE id=".$_POST['id'];
$rscustomer=mysqli_query($con,$querycustomer);
$rowcustomer = mysqli_fetch_array($rscustomer);

$tempCountry = preg_split ("/[;]+/", $rowcustomer['destination']);

$querymonth = "SELECT * FROM month";
$rsmonth=mysqli_query($con,$querymonth);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>FORM UPDATE CUSTOMER LIST</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadCustomer(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='#'>
                <div class='card-body'>
                  <div class='form-group'>
                    <label>Customer Name</label>
                    <input type='text' class='form-control' name='name' id='name' value='".$rowcustomer['customer_name']."' placeholder='Enter Customer Name'>
                    <input type='text' class='form-control' name='tid' id='tid' value='".$_POST['id']."' hidden>
                  </div>

                  <div class='form-group'>
                  <label>Customer Address</label>
                  <input type='text' class='form-control' name='address' id='address' value='".$rowcustomer['address']."' placeholder='Enter Customer Adress'>
                  </div>

                  <div class='form-group'>
                    <label>Phone Number</label>
                    <input type='text' class='form-control' name='phone' id='phone' value='".$rowcustomer['phone_number']."' placeholder='Enter Phone Number'>
                  </div>
                  <div class=form-group'>
                  <label>Customer Category</label>
                  <select class='chosen' name='customer_category' id='customer_category' style='width: 100%;'>
                  <option selected='selected' value=0>Pilihan</option>";


                  $query_category = "SELECT * FROM customer_category";
                  $rs_category=mysqli_query($con,$query_category);
                  while($row_category = mysqli_fetch_array($rs_category)){
                    if($row_category['name']==$rowcustomer['category']){
                      echo "<option selected='selected' value='".$row_category['name']."'>".$row_category['name']."</option>";
                    }else{
                      echo "<option value='".$row_category['name']."'>".$row_category['name']."</option>";
                    }
                    
                  }

                  echo"</select>
                  </div>
                  <div class='form-group'>
                    <label>Tour Type</label>
                    <input type='text' class='form-control' name='type' id='type' value='".$rowcustomer['tour_type']."' placeholder='Enter Tour Type'>
                  </div>
                  <div class='form-group'>
                    <label>Destination</label>
                    <select name='country_count' id='country_count'>
                    <option selected='selected' value=0>Jumlah Country</option>";

                    for ($x = 1; $x <= 20; $x++){
                      if(count($tempCountry)==$x){
                        echo "<option selected='selected' value=".$x.">".$x."</option>";
                      }else{
                        echo "<option value=".$x.">".$x."</option>";
                      }
                      
                    }
                    echo "</select></div>
                    <div class=form-group' name='divcountry' id='divcountry'>";
                    for ($x = 1; $x <= count($tempCountry); $x++){
                      $querycity = "SELECT * FROM country";
                      $rscity=mysqli_query($con,$querycity);

                      echo"<div class=form-group' style='margin-bottom:10px;'>
                      <label>Country ".$x."</label>
                      <select class='chosen' name='country".$x."' id='country".$x."' style='width: 100%;'>
                      <option selected='selected' value=0>Pilihan</option>";

                      while($rowcity = mysqli_fetch_array($rscity)){
                        if($rowcity['name']==$tempCountry[$x-1]){
                          echo "<option selected='selected' value='".$rowcity['name']."'>".$rowcity['name']."</option>";
                        }else{
                          echo "<option value='".$rowcity['name']."'>".$rowcity['name']."</option>";
                        }
                        
                      }
                      echo"</select></div>";
                    }
                    echo "</div>
                    </br>
                  </div>
                  <div class='form-group'>
                    <label>Departure / Remarks</label>
                    <input type='text' class='form-control' name='departure' id='departure' value='".$rowcustomer['departure_date']."' placeholder='Enter Departure Date'>
                  </div>
                  <div class='form-group'>
                    <label>Total Pax</label>
                    <input type='text' class='form-control' name='pax' id='pax' value='".$rowcustomer['total_pax']."' placeholder='Enter Total Pax'>
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
                          $cek = $rowmonth['name'] . " 2020";
                          if($rowcustomer['month_planning']==$cek){
                            echo "<option selected='selected' value='".$rowmonth['name']." 2020'>".$rowmonth['name']." 2020</option>";
                          }else{
                            echo "<option value='".$rowmonth['name']." 2020'>".$rowmonth['name']." 2020</option>";
                          }
                          
                        }else{
                          $cek = $rowmonth['name'] . " 2021";
                          if($rowcustomer['month_planning']==$cek){
                            echo "<option selected='selected' value='".$rowmonth['name']." 2021'>".$rowmonth['name']." 2021</option>";
                          }else{
                             echo "<option value='".$rowmonth['name']." 2021'>".$rowmonth['name']." 2021</option>";
                          }
                        }
                      }
                    }
                    echo"</select>
                  </div>
                  <div class='form-group'>
                    <label>Email</label>
                    <input type='email' class='form-control' name='email' id='email' value='".$rowcustomer['email']."' placeholder='Enter Email'>
                  </div>
                  <div class='form-group'>
                    <label>Customer From</label>
                    <input type='text' class='form-control' name='from' id='from' value='".$rowcustomer['customer_from']."' placeholder='Enter Customer From'>
                  </div>
                  <div class='form-group'>
                    <label>City</label>
                    <select class='chosen' name='city' id='city' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";
                      if($rowcustomer['city']=='Surabaya'){
                        echo "<option selected='selected' value='Surabaya'>Surabaya</option>";
                        echo "<option value='Batam'>Batam</option>";
                      }elseif($rowcustomer['city']=='Batam'){
                        echo "<option value='Surabaya'>Surabaya</option>";
                        echo "<option selected='selected' value='Batam'>Batam</option>";
                      }else{
                        echo "<option value='Surabaya'>Surabaya</option>";
                        echo "<option value='Batam'>Batam</option>";
                      }
            					
            					
                    echo"</select>
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
    $(".chosen").chosen();

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

    $("#but_upload").click(function(){

        var fd = new FormData();
        var a = $("input[name=name]").val();
        var b = $("input[name=phone]").val();
        var c = $("input[name=type]").val();
        var e = $("input[name=pax]").val();
        var f = document.getElementById("month").options[document.getElementById("month").selectedIndex].value;
        var g = $("input[name=email]").val();
        var d = $("input[name=from]").val();
        var x = document.getElementById("city").options[document.getElementById("city").selectedIndex].value;
        var y = document.getElementById("customer_category").options[document.getElementById("customer_category").selectedIndex].value;
        var j = $("input[name=departure]").val();
        var l = $("input[name=address]").val();
        var h = "";
        for (var i = 1; i <= $("#country_count").val(); i++) {
          if(i==1){
            h = h + $("#country"+i).val();
          }
          else{
            h = h + ";" + $("#country"+i).val();
          }
        }

        var x = $("input[name=tid]").val();
        fd.append('id',x);
        fd.append('name',a);
        fd.append('phone',b);
        fd.append('type',c);
        fd.append('destination',h);
        fd.append('pax',e);
        fd.append('month',f);
        fd.append('email',g);
        fd.append('from',d);
        fd.append('city',x);
        fd.append('address',l);
        fd.append('customer_category',y);
        fd.append('departure',j);
     
        $.ajax({
          url: 'updateCustomerList.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
            if(response=='success'){
              reloadCustomer(0,0,0);
            }else{
              alert(response);
            }
            
          },
        });
        
       
    });
  });

 
</script>
