<?php
include "../site.php";
include "../db=connection.php";

$querytour = "SELECT * FROM price_package";
$rstour=mysqli_query($con,$querytour);

$queryhotel = "SELECT * FROM hotel_rating";
$rshotel=mysqli_query($con,$queryhotel);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM PRICE PACKAGE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(2,".$_POST['id'].",0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                    <input type='text' class='form-control' name='name' id='name' placeholder='Enter Hotel Name'>

                    <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                  </div>
                  <div class='form-group'>
                    <label>Rating</label>
                    <select class='form-control select2' name='rating' id='rating' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowhotel = mysqli_fetch_array($rshotel)){
                      echo "<option value=".$rowhotel['id'].">".$rowhotel['name']."</option>";
                    }
                    echo"</select>
                  </div>
                  <div class=form-group'>
                    <label>Price Package</label>
                    <select class='form-control select2' name='pricepackage' id='pricepackage' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowtour = mysqli_fetch_array($rstour)){
                      echo "<option value=".$rowtour['id'].">".$rowtour['name']."</option>";
                    }
                    echo"</select>
                  </div>
                  <div class='form-group'>
                    <label>Year</label>
                    <input type='text' class='form-control' name='year' id='year' placeholder='Enter Year of Price'>

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
                  <button type='button' class='btn btn-primary' onclick='insertPricePackage()'>Submit</button>
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
  function insertPricePackage(){
    var x = $("input[name=id]").val();
    var y = $("input[name=name]").val();
    var z = document.getElementById("pricepackage").options[document.getElementById("pricepackage").selectedIndex].value;
    var d = document.getElementById("rating").options[document.getElementById("rating").selectedIndex].value;
    var v = $("input[name=year]").val();
    $.ajax({
        url:"insertPricePackage.php",
        method: "POST",
        asynch: false,
        data:{id:x,name:y,pricepackage:z,year:v,rating:d},
        success:function(data){
          reloadPage(2,x,0);
        }
      });
    
  }
</script>
