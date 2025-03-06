<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
session_start();

$query = "SELECT DISTINCT(phone_number) FROM customer_list";
$rs=mysqli_query($con,$query);

$querycountry = "SELECT * FROM month";
$rscountry=mysqli_query($con,$querycountry);

$querydate = "SELECT DISTINCT(request_date) FROM customer_list ORDER by request_date DESC";
$rsdate=mysqli_query($con,$querydate);

$querycategory = "SELECT * FROM customer_category";
$rscategory=mysqli_query($con,$querycategory);

$query_country = "SELECT * FROM country";
$rs_country=mysqli_query($con,$query_country);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>Customer List</h3></br>
                <div>
                    <select class='chosen1' name='sphonenumber' id='sphonenumber' onchange='searchCustomer(0,this.value,1)' class='form-control'>
                    <option selected='selected' value=0>Search By Phone</option>";

                    while($row = mysqli_fetch_array($rs)){
                      $query2 = "SELECT * FROM customer_list WHERE phone_number LIKE '".$row['phone_number']."'";
                      $rs2=mysqli_query($con,$query2);
                      $row2 = mysqli_fetch_assoc($rs2);
                      echo "<option value='".$row['phone_number']."'>".$row['phone_number']." ( ".$row2['customer_name']." )</option>";
                    }
                    echo"</select>

                    <select class='chosen1' name='srequestdate' id='srequestdate' onchange='searchCustomer(0,this.value,2)' class='form-control'>
                    <option selected='selected' value=0>Search By RequestDate</option>";

                    while($rowdate = mysqli_fetch_array($rsdate)){
                      echo "<option value='".$rowdate['request_date']."'>".$rowdate['request_date']."</option>";
                    }
                    echo"</select>

                    <select class='chosen1' name='sfrom' id='sfrom' onchange='searchCustomer(0,this.value,4)' class='form-control'>
                    <option selected='selected' value=0>Search By City</option>";

                    echo "<option value='Surabaya'>Surabaya</option>";
                    echo "<option value='Batam'>Batam</option>";
                    
                    echo"</select>

                    <select class='chosen1' name='scategory' id='scategory' onchange='searchCustomer(0,this.value,6)' class='form-control'>
                    <option selected='selected' value=0>Search By Category</option>";

                     while($rowcategory = mysqli_fetch_array($rscategory)){
                      echo "<option value='".$rowcategory['name']."'>".$rowcategory['name']."</option>";
                    }
                    
                    echo"</select>
                    </br>

                    <select class='chosen1' name='s_country' id='s_country'class='form-control'>
                    <option selected='selected' value=''>Search By Country</option>";

                    while($row_country = mysqli_fetch_array($rs_country)){
                      echo "<option value='".$row_country['name']."'>".$row_country['name']."</option>";
                    }
                    echo"</select>

                    <select class='chosen1' name='s_month' id='s_month' class='form-control'>
                    <option selected='selected' value=''>Search By Month</option>";

                    while($rowcountry = mysqli_fetch_array($rscountry)){
                      echo "<option value='".$rowcountry['name']."'>".$rowcountry['name']."</option>";
                    }
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
                    echo"</select>";
                     echo "<button type='button' onclick='searchCustomer(0,0,5)' class='btn btn-default'>Search Filter</button>";
                    
                    echo "</div>
                <div class='card-tools'>
                  <div class='input-group input-group-sm'>
                  	
                    <div class='input-group-append'>";
                    
                    
                      echo "<button type='submit' onclick='insertCustomer(0,0,0)' class='btn btn-default'><i class='fa fa-plus'></i></button>";
                    echo "</div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div  id='myMidBody'>";
            

                $query = "SELECT * FROM customer_list ORDER BY id DESC";
                $rs=mysqli_query($con,$query);
                


                echo "<table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:14px;'>
                <thead>
                <tr>
                <th>RequestDate</th>
                <th>CustomerName</th>
                <th>Category</th>
                <th>Tour Type</br>
                Month Plan</th>
                <th>Departure / Remarks</th>
                <th>Total Pax</th>
                <th>Email | Phone | Address</th>
                <th>CustomerFrom</th>
                <th>City</th>
                <th>Attend</br>
                Presentation</br>
                Open Table</br>
                </th>
                <th>Staff Handle</th>
                <th>Staff Input</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody id='myTable'>";
                while($row=mysqli_fetch_array($rs)){
                  
                  if($row['staff_handle']!=-1){
                    $querystaff = "SELECT * FROM login_staff WHERE id=".$row['staff_handle'];
                    $rsstaff = mysqli_query($con,$querystaff);
                    $rowstaff = mysqli_fetch_array($rsstaff);
                  }

                  if($row['staff_input']!=0){
                    $querystaff2 = "SELECT * FROM login_staff WHERE id=".$row['staff_input'];
                    $rsstaff2 = mysqli_query($con,$querystaff2);
                    $rowstaff2 = mysqli_fetch_array($rsstaff2);
                  }

                  echo"
                  <tr style='font-weight:bold;'>
                  <td>".$row['request_date']."</td>
                  <td>".$row['customer_name']."</br>";
                  if($row['category']=='School'){
                    echo "<button type='submit' onclick='insertDetailSiswa(0,".$row['id'].",0)' class='btn btn-primary' style='font-size:8px'>Detail Siswa</button></br>";
                  }
                  echo "</td>
                  <td>
                  <select name='customer_category' id='customer_category' onchange='updateCategory(this.value,".$row['id'].")'>
                  <option selected='selected' value=0>Pilihan</option>";


                   $query_category = "SELECT * FROM customer_category";
                   $rs_category=mysqli_query($con,$query_category);
                   while($row_category = mysqli_fetch_array($rs_category)){
                    if($row_category['name']==$row['category']){
                      echo "<option selected='selected' value='".$row_category['name']."'>".$row_category['name']."</option>";
                    }else{
                      echo "<option value='".$row_category['name']."'>".$row_category['name']."</option>";
                    }
                    
                  }

                  echo "</select></br></br>
                  ".$row['destination']."
                  </td>
                  <td>".$row['tour_type']."</br>
                  ".$row['month_planning']."
                  </td>
                  <td>".$row['departure_date']."</td>
                  <td>".$row['total_pax']."</td>
                  <td>".$row['email']."</br>
                  ".$row['phone_number']."</br>
                  ".$row['address']."
                  </td>
                  <td>".$row['customer_from']."</td>
                  <td>".$row['city']."</td>";

                  if($row['category']=='School'){


                    echo "<td><select name='staff_attend' id='staff_attend' onchange='updateAttend(this.value,".$row['id'].")'>";
                    if($row['attend']==0){
                      echo "<option selected='selected' value='0'>Belum</option>";
                      echo "<option value='1'>Attend</option>";
                    }else{
                      echo "<option value='0'>Belum</option>";
                      echo "<option selected='selected' value='1'>Attend</option>";
                    }
                    echo "</select></br></br>";
                    echo "<select name='staff_presentation' id='staff_presentation' onchange='updatePresentation(this.value,".$row['id'].")'>";
                    if($row['presentation']==0){
                      echo "<option selected='selected' value='0'>Belum</option>";
                      echo "<option value='1'>Presentation</option>";
                    }else{
                      echo "<option value='0'>Belum</option>";
                      echo "<option selected='selected' value='1'>Presentation</option>";
                    }
                    echo "</select></br></br>";
                    echo "<select name='staff_stand' id='staff_stand' onchange='updateStand(this.value,".$row['id'].")'>";
                    if($row['stand']==0){
                      echo "<option selected='selected' value='0'>Belum</option>";
                      echo "<option value='1'>Stand</option>";
                    }else{
                      echo "<option value='0'>Belum</option>";
                      echo "<option selected='selected' value='1'>Stand</option>";
                    }
                    echo "</select></td>";

                  }else{
                    echo "<td>-</td>";
                  }

                  if($row['staff_handle']==-1){
                    echo "<td> - </br>";
                    if($row['handle']=='0'){
                      echo "<input type='text' class='form-control' name='staff".$row['id']."' id='staff".$row['id']."' value='".$_SESSION['staff_id']."' hidden>";
                      echo "<button onclick='updateHandle(".$row['id'].",1)' class='btn btn-danger' style='font-size:11px;'>Belum di Handle</button>";
                    }else{
                      if($row['staff_handle']==$_SESSION['staff_id']){
                        echo "<input type='text' class='form-control' name='staff".$row['id']."' id='staff".$row['id']."' value='-1' hidden>";
                        echo "<button onclick='updateHandle(".$row['id'].",0)' class='btn btn-success' style='font-size:11px;'>Sudah di Handle</button>";
                      }else{
                        echo "<input type='text' class='form-control' name='staff".$row['id']."' id='staff".$row['id']."' value='-1' hidden>";
                        echo "<button class='btn btn-success' style='font-size:11px;'>Sudah di Handle</button>";
                      }
                      
                    }

                    echo "</td>";
                  }else{
                    echo "<td>".$rowstaff['name']."</br>";

                    if($row['handle']=='0'){
                      echo "<input type='text' class='form-control' name='staff".$row['id']."' id='staff".$row['id']."' value='".$_SESSION['staff_id']."' hidden>";
                      echo "<button onclick='updateHandle(".$row['id'].",1)' class='btn btn-danger' style='font-size:11px;'>Belum di Handle</button>";
                    }else{
                      if($row['staff_handle']==$_SESSION['staff_id']){
                        echo "<input type='text' class='form-control' name='staff".$row['id']."' id='staff".$row['id']."' value='-1' hidden>";
                        echo "<button onclick='updateHandle(".$row['id'].",0)' class='btn btn-success' style='font-size:11px;'>Sudah di Handle</button>";
                      }else{
                        echo "<input type='text' class='form-control' name='staff".$row['id']."' id='staff".$row['id']."' value='-1' hidden>";
                        echo "<button class='btn btn-success' style='font-size:11px;'>Sudah di Handle</button>";
                      }

                    }

                    echo "</td>";
                  }

                  if($row['staff_input']==0){
                    echo "<td> - </td>";
                  }else{
                    echo "<td>".$rowstaff2['name']."</td>";
                  } 

                  echo "<td><button type='submit' onclick='editCustomer(0,".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='delCustomer(".$row['id'].",0)' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>
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
  $(document).ready(function(){
    $(".chosen1").chosen();
  });

  function updateCategory(x,y){
    $.ajax({
        url:"updateCustomerCategory.php",
        method: "POST",
        asynch: false,
        data:{id:y,category:x},
        success:function(data){
          if(data=="success"){
            alert(data);
          }else{
            alert("Fail to Update");
          }
        }
      });
  }

  function updateAttend(x,y){
    $.ajax({
        url:"updateCustomerAttend.php",
        method: "POST",
        asynch: false,
        data:{id:y,category:x},
        success:function(data){
          if(data=="success"){
            alert(data);
          }else{
            alert("Fail to Update");
          }
        }
      });
  }

  function updatePresentation(x,y){
    $.ajax({
        url:"updateCustomerPresentation.php",
        method: "POST",
        asynch: false,
        data:{id:y,category:x},
        success:function(data){
          if(data=="success"){
            alert(data);
          }else{
            alert("Fail to Update");
          }
        }
      });
  }

  function updateStand(x,y){
    $.ajax({
        url:"updateCustomerStand.php",
        method: "POST",
        asynch: false,
        data:{id:y,category:x},
        success:function(data){
          if(data=="success"){
            alert(data);
          }else{
            alert("Fail to Update");
          }
        }
      });
  }

  function updateHandle(x,z){
    var txt;
    if(z==0){
      var r = confirm("Are you sure to Deactive handle this Customer?");
    }else{
      var r = confirm("Are you sure to Handle this Customer?");
    }

    
    if (r == true) {
      var y = $("input[name=staff"+x+"]").val();

     $.ajax({
        url:"updateHandleCustomerList.php",
        method: "POST",
        asynch: false,
        data:{id:x,staff:y,flag:z},
        success:function(data){
          if(data=="success"){
            reloadCustomer(0,0,0);
          }else{
            alert("Fail to Update");
          }
        }
      });
    } 
  }
  
 
  function delCustomer(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delCustomerList.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadCustomer(0,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

