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

$querycustomer = "SELECT * FROM customer_list";
$rscustomer=mysqli_query($con,$querycustomer);

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
                <h3 class='card-title' style='font-weight:bold;'>Admission</h3>
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
                                    <div class='col-4'>
                                        <label>Admission Price</label></br>
                                        <select class='chosen' name='admission_price' id='admission_price'>
                                        <option selected='selected' value=0>Pilihan</option>";
                                        $query_admission = "SELECT * FROM admission";
                                        $rs_admission=mysqli_query($con,$query_admission);
                                        while($row_admission = mysqli_fetch_array($rs_admission)){
                                          $admissioncode = $row_admission['id'] + 45000;
                                          echo "<option value='".$row_admission['id']."'>".$admissioncode."</option>";
                                        }
                                        echo"</select>
                                    </div>
                                     <div class='col-8'>
                                        <label>Customer</label></br>
                                        <select class='chosen' name='customer' id='customer'>";
                                        $query_customer = "SELECT * FROM customer_list";
                                        $rs_customer=mysqli_query($con,$query_customer);
                                        while($row_customer = mysqli_fetch_array($rs_customer)){
                                          echo "<option value='".$row_customer['id']."'>".$row_customer['customer_name'] ." ( ".$row_customer['phone_number']." ) From ".$row_customer['city']."</option>";
                                        }
                                        echo"</select>
                                    </div>

                                    <div id='divPrice'>

                                    </div>
                                   
                                    

                            </div>
                            
                            
                              
                             
                            <center></br><button type='button' class='btn btn-primary' id='but_upload'>Submit</button></center> </div>
                            </div>
                            ";
                            
                            
              echo "</div></div>
              <!-- /.card-header -->

              <div class='container-fluid'>";
            

                $query = "SELECT * FROM admission ORDER BY id ASC";
                $rs=mysqli_query($con,$query);
                


                echo "<table id='dtBasicExample' class='tableFixHead table-bordered table-sm' style='font-size:14px;'>
                <thead>
                <tr>
                <th width='3%'>Name</th>
                <th width='3%'>Country</th>
                <th width='3%'>Category</th>
                <th width='3%'>Validity</th>
                <th width='3%'>Physic</br>
                E-Tix</br>
                Reedem
                </th>
                <th width='3%'>Buy / Sell Adt Price</th>
                <th width='3%'>Buy / Sell Senior Price</th>
                <th width='3%'>Buy / Sell Junior Price</th>
                <th width='3%'>Buy / Sell Child Price</th>
                <th width='3%'>Buy / Sell Infant Price</th>
                <th width='3%'>Opening Hours</br>
                <th width='3%'>Remarks</br>
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
                

                $query_customer = "SELECT * FROM customer_list WHERE id=".$row['customer_id'];
                $rs_customer=mysqli_query($con,$query_customer);
                $row_customer = mysqli_fetch_array($rs_customer);

                $query_bank = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
                $rs_bank=mysqli_query($con,$query_bank);
                $row_bank = mysqli_fetch_array($rs_bank);

                $query_kurs = "SELECT * FROM kurs_live WHERE name LIKE '".$row_bank['name']."'";
                $rs_kurs=mysqli_query($con,$query_kurs);
                $row_kurs = mysqli_fetch_array($rs_kurs);

                if($row_bank['name']=='IDR'){
                  $adt_price = $row['adt_price'];
                  $senior_price = $row['senior_price'];
                  $junior_price = $row['junior_price'];
                  $chd_price = $row['chd_price'];
                  $inf_price = $row['inf_price'];

                  $sell_adt_price = $row['sell_adt_price'];
                  $sell_senior_price = $row['sell_senior_price'];
                  $sell_junior_price = $row['sell_junior_price'];
                  $sell_chd_price = $row['sell_chd_price'];
                  $sell_inf_price = $row['sell_inf_price'];

                }else{
                  $adt_price = $row['adt_price'] * $row_kurs['jual'];
                  $senior_price = $row['senior_price'] * $row_kurs['jual'];
                  $junior_price = $row['junior_price'] * $row_kurs['jual'];
                  $chd_price = $row['chd_price'] * $row_kurs['jual'];
                  $inf_price = $row['inf_price'] * $row_kurs['jual'];

                  $sell_adt_price = $row['sell_adt_price'] * $row_kurs['jual'];
                  $sell_senior_price = $row['sell_senior_price'] * $row_kurs['jual'];
                  $sell_junior_price = $row['sell_junior_price'] * $row_kurs['jual'];
                  $sell_chd_price = $row['sell_chd_price'] * $row_kurs['jual'];
                  $sell_inf_price = $row['sell_inf_price'] * $row_kurs['jual'];
                }

                $totalprice = $totalprice + ($row['total_room']*$price_value) + (int)$totaltax;

                echo "<tr style='font-weight:bold;color:black'>";
                echo "<td nowrap>".$row['name']."</td>";
                $query_country2 = "SELECT * FROM country WHERE id=".$row['country'];
                $rs_country2=mysqli_query($con,$query_country2);
                $row_country2 = mysqli_fetch_array($rs_country2);
                echo "<td>".$row_country2['name']."</td>";
                echo "<td>".$row['category']."</br>
                (".$row['category_desc'].")
                </td>";
                echo "<td nowrap>".$row['validity']."</td>";

                if($row['physic']==0){
                  $physic = 'Tidak';
                }else{
                  $physic = 'Bisa';
                }
                if($row['e_tix']==0){
                  $etix = 'Tidak';
                }else{
                  $etix = 'Bisa';
                }
                if($row['redeem']==0){
                  $redeem = 'Tidak';
                }else{
                  $redeem = 'Bisa';
                }
                echo "<td>".$physic."</br>
                ".$etix."</br>
                ".$redeem."
                </td>";


                echo "<td>Rp ".number_format($adt_price, 0, ".", ".")."</br>
                Rp ".number_format($sell_adt_price, 0, ".", ".")."
                </td>";
                echo "<td>Rp ".number_format($senior_price, 0, ".", ".")."</br>
                Rp ".number_format($sell_senior_price, 0, ".", ".")."
                </td>";
                echo "<td>Rp ".number_format($junior_price, 0, ".", ".")."</br>
                Rp ".number_format($sell_junior_price, 0, ".", ".")."
                </td>";
                echo "<td>Rp ".number_format($chd_price, 0, ".", ".")."</br>
                Rp ".number_format($sell_chd_price, 0, ".", ".")."
                </td>";
                echo "<td>Rp ".number_format($inf_price, 0, ".", ".")."</br>
                Rp ".number_format($sell_inf_price, 0, ".", ".")."
                </td>";
                
                echo "<td>".$row['opening_hours']."</td>";
                echo "<td>".$row['remarks']."</td>";

               
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
 var availableTags = [];
 var availableTags2 = [];
  $(document).ready(function(){
    $(".chosen").chosen();
    $('#summernote').summernote();
    $('#summernote2').summernote();

    $('input[name="datefilter"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
       });
    $('input[name="datefilter2"]').daterangepicker({
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

    $('#admission_price').on('change', function() {
      var id = this.value;
     
        $.ajax({
          type:'POST',
          url:'getAdmissionPrice.php',
          data:{'id':id},
          success:function(data){
           $('#divPrice').html(data);
         }
       });
    });

   $("#but_upload").click(function(){
      var fd = new FormData();
      const monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN",
      "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"
      ];

      var date=new Date($('input[name="datefilter"]').val());
      var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
      var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
      var year = date.getFullYear();

      var validity = year + "-" + month + "-" + day;

      var name = $("input[name=admission_name]").val();
      var country = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;
      var category = $("input[name=category]").val();
      var category_desc = $("input[name=category_desc]").val();
      var opening_hours = $("textarea[name=opening_hours]").val();
      var remarks = $("textarea[name=remarks]").val();

      var physic = document.getElementById("physic").options[document.getElementById("physic").selectedIndex].value;
      var etix = document.getElementById("etix").options[document.getElementById("etix").selectedIndex].value;
      var redeem = document.getElementById("redeem").options[document.getElementById("redeem").selectedIndex].value;
      var kurs_price = document.getElementById("kurs_price").options[document.getElementById("kurs_price").selectedIndex].value;

      var adt_price = $("input[name=adt_price]").val();
      var senior_price = $("input[name=senior_price]").val();
      var junior_price = $("input[name=junior_price]").val();
      var chd_price = $("input[name=chd_price]").val();
      var inf_price = $("input[name=inf_price]").val();

      var sell_adt_price = $("input[name=sell_adt_price]").val();
      var sell_senior_price = $("input[name=sell_senior_price]").val();
      var sell_junior_price = $("input[name=sell_junior_price]").val();
      var sell_chd_price = $("input[name=sell_chd_price]").val();
      var sell_inf_price = $("input[name=sell_inf_price]").val();

      var adt_desc = $("input[name=adt_desc]").val();
      var senior_desc = $("input[name=senior_desc]").val();
      var junior_desc = $("input[name=junior_desc]").val();
      var chd_desc = $("input[name=chd_desc]").val();
      var inf_desc = $("input[name=inf_desc]").val();


      fd.append('validity',validity);
      fd.append('name',name);
      fd.append('country',country);
      fd.append('category',category);
      fd.append('category_desc',category_desc);
      fd.append('opening_hours',opening_hours);
      fd.append('remarks',remarks);
      fd.append('physic',physic);
      fd.append('etix',etix);
      fd.append('redeem',redeem);
      fd.append('kurs_price',kurs_price);
      fd.append('adt_price',adt_price);
      fd.append('senior_price',senior_price);
      fd.append('junior_price',junior_price);
      fd.append('chd_price',chd_price);
      fd.append('inf_price',inf_price);
      fd.append('sell_adt_price',sell_adt_price);
      fd.append('sell_senior_price',sell_senior_price);
      fd.append('sell_junior_price',sell_junior_price);
      fd.append('sell_chd_price',sell_chd_price);
      fd.append('sell_inf_price',sell_inf_price);
      fd.append('adt_desc',adt_desc);
      fd.append('senior_desc',senior_desc);
      fd.append('junior_desc',junior_desc);
      fd.append('chd_desc',chd_desc);
      fd.append('inf_desc',inf_desc);

      $.ajax({
        url: 'insertAdmission.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
          if(response=="success"){
            alert(response);
            reloadManual(5,0,0);
          }else{
            alert(response);
          }

        },
      });

      
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

      
    //    $.ajax({
    //     url: 'updateProfitFlight.php',
    //     type: 'post',
    //     data: fd,
    //     contentType: false,
    //     processData: false,
    //     success: function(response){
    //      if(response=="success"){
    //       alert(response);
    //     }

    //   },
    // });
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
            availableTags2[i]=data[i].PlaceName + " - " + data[i].PlaceId;
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
        availableTags4[i]=data[i].PlaceName + " - " + data[i].PlaceId;
      }
      
    });



    $( "#tags4" ).autocomplete({
      source: availableTags4
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


