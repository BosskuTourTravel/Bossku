<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);


echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM PERFORMA PRICE VISA PASSPORT</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div>


              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>
                    <div class='form-group'>
                            <div class='col-4'>
                                <label>Country</label>
                                        <select class='chosen' name='country' id='country' onchange='getPerformaPriceVisaPassport(this.value)' class='form-control'>
                                        <option selected='selected' value=0>Pilihan</option>";
                                            while($rowcountry = mysqli_fetch_array($rscountry)){
                                                $queryperforma = "SELECT COUNT(*) as total FROM performa_price_visapassport WHERE country = ".$rowcountry['id'];
                                                $rsperforma=mysqli_query($con,$queryperforma);
                                                $rowperforma = mysqli_fetch_assoc($rsperforma);

                                                if($rowperforma['total']>0){
                                                  echo "<option style='color:green;' value='".$rowcountry['id']."'>".$rowcountry['name']."</option>";
                                                }else{
                                                  $queryvisa = "SELECT * FROM visa";
                                                    $rsvisa=mysqli_query($con,$queryvisa);
                                                  $cekInvoice = 0;
                                                  while($rowvisa = mysqli_fetch_array($rsvisa)){

                                                    if($rowvisa['country']==$rowcountry['id']){
                                                      $cekInvoice = 1;
                                                    }

                                                  }
                                                  if($cekInvoice==1){
                                                    echo "<option style='color:red;' value='".$rowcountry['id']."'>".$rowcountry['name']."</option>";
                                                  }else{
                                                    echo "<option value='".$rowcountry['id']."'>".$rowcountry['name']."</option>";
                                                  }
                                                  
                                                }
                                              }
                                echo"</select>
                    </div>
                    <div class=form-group' name='divcountry' id='divcountry'></div>

                </div>";
               echo"
             </form>
         </div>
    </div>
</div>
</div>
</div>
</div>";
?>

<script>
   function getPerformaPriceVisaPassport(x) {
    $.ajax({
      type:'POST',
      url:'getPerformaPriceVisaPassport.php',
      data:{'country':x},
      success:function(data){
        $('#divcountry').html(data);
      }
    });
  }
  
$(document).ready(function(){
    $(".chosen").chosen();


});

</script>
