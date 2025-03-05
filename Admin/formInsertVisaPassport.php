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
                      <button type='submit' onclick='reloadInvoice(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                    <label>Visa / Passport</label>
                    <select class='chosen' name='type' id='type' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    echo "<option value='0'>Visa</option>";
                    echo "<option value='1'>Passport</option>";
                    echo"</select>
                  </div>

                  <div class=form-group' name='divVisaPassport' id='divVisaPassport'></div>

                  
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
    $('#type').on('change', function() {
        var count = this.value;
        $.ajax({
          type:'POST',
          url:'showVisaPassport.php',
          data:{'type':count},
          success:function(data){
           $('#divVisaPassport').html(data);
         }
       });
      });

  });


  $("#but_upload").click(function(){

    var a = $("input[name=tid]").val();
    var c = document.getElementById("type").options[document.getElementById("type").selectedIndex].value;
    var d = document.getElementById("pax").options[document.getElementById("pax").selectedIndex].value;
    var e = document.getElementById("visapassport").options[document.getElementById("visapassport").selectedIndex].value;


    $.ajax({
      url:"updateInvoiceForVisaPassport.php",
      method: "POST",
      asynch: false,
      data:{'id':a,'type':c,'pax':d,'visapassportId':e},
      success:function(data){
        alert(data);
        reloadInvoice(0,0,0);
      }
    });
  });

</script>
