<?php
include "../site.php";
include "../db=connection.php";

$queryg = "SELECT * FROM jenisgaji";
$rsg=mysqli_query($con,$queryg);
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
                      <button type='submit' onclick='reloadsallary(2,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                    <label>Job Name</label>
                    <input type='text' class='form-control' name='name' id='name' placeholder='EnterJob Name'>

                    <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                    
                  </div>
                  <div class=form-group'>
                    <label>Price Package</label>
                    <input type='text' class='form-control' name='harga' id='harga' placeholder='Enter Price Job'>
                  </div>
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
                  <button type='button' class='btn btn-primary' onclick='insertPricejob()'>Submit</button>
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
  function insertPricejob(){
    var x = $("input[name=id]").val();
    var y = $("input[name=name]").val();
    var z = $("input[name=harga]").val();
   
    $.ajax({
        url:"insertjobprice.php",
        method: "POST",
        asynch: false,
        data:{id:x,name:y,harga:z,},
        success:function(data){
          reloadsallary(2,x,0);
        }
      });
    
  }
</script>
