<?php
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM tour_price_package WHERE id=".$_POST['id'];
$rs=mysqli_query($con,$query);
$row = mysqli_fetch_array($rs);

$querytour = "SELECT * FROM price_package";
$rstour=mysqli_query($con,$querytour);

$queryhotel = "SELECT * FROM hotel_rating";
$rshotel=mysqli_query($con,$queryhotel);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>UPDATEPRICE PACKAGE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(2,".$_POST['tid'].",0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='insertPricePackage.php'>
                <div class='card-body'>
                  <div class='form-group'>
                    <label>Hotel Name</label>
                    <input type='text' class='form-control' name='name' id='name' value='".$row['name']."' placeholder='Enter Hotel Name'>

                    <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                    <input name='tid' id='tid' value='".$_POST['tid']."' type='hidden' >
                  </div>
                   <div class='form-group'>
                    <label>Rating</label>
                    <select class='form-control select2' name='rating' id='rating' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowhotel = mysqli_fetch_array($rshotel)){
                      if($rowhotel['id']==$row['rating']){
                         echo "<option selected='selected' value=".$rowhotel['id'].">".$rowhotel['name']."</option>";
                      }else{
                         echo "<option value=".$rowhotel['id'].">".$rowhotel['name']."</option>";
                      }
                     
                    }
                    echo"</select>
                  </div>
                  <div class=form-group'>
                    <label>Price Package</label>
                    <select class='form-control select2' name='pricepackage' id='pricepackage' style='width: 100%;'>
                    <option value=0>Pilihan</option>";

                    while($rowtour = mysqli_fetch_array($rstour)){
                      if($rowtour['id'] == $row['price_package']){
                        echo "<option selected='selected' value=".$rowtour['id'].">".$rowtour['name']."</option>";
                      }else{
                        echo "<option value=".$rowtour['id'].">".$rowtour['name']."</option>";
                      }
                    }
                    echo"</select>
                  </div>
                  <div class='form-group'>
                    <label>Year</label>
                    <input type='text' class='form-control' name='year' id='year' value=".$row['year']." placeholder='Enter Year of Price'>

                    <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                  </div>";
                  // <!-- <div class='form-group'>
                  //   <label for='exampleInputFile'>File input</label>
                  //   <div class='input-group'>
                  //     <div class='custom-file'>
                  //       <input name="uploaded" type="file" />
                  //     </div>
                      
                  //   </div>
                  // </div> -->
                  
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

    $("#but_upload").click(function(){
         var fd = new FormData();
         var a = $("input[name=id]").val();
         var b = $("input[name=name]").val();
         var c = document.getElementById("pricepackage").options[document.getElementById("pricepackage").selectedIndex].value;
         var d = document.getElementById("rating").options[document.getElementById("rating").selectedIndex].value;
         var x = $("input[name=tid]").val();
         var v = $("input[name=year]").val();

         fd.append('id',a);
         fd.append('name',b);
         fd.append('pricepackage',c);
         fd.append('rating',d);
         fd.append('year',v);
         $.ajax({
          url: 'updatePricePackage.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
            reloadPage(2,x,0);
          },
        });
     });
         

       
});
</script>
