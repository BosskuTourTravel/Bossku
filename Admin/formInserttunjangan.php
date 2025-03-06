<?php
include "../site.php";
include "../db=connection.php";

$queryg = "SELECT * FROM login_staff";
$rsg=mysqli_query($con,$queryg);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT TUNJANGAN</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadsallary(6,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                <label>STAFF</label>
                <select class='chosen' name='staff' id='staff'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($row2 = mysqli_fetch_array($rsg)){
                      echo "<option value=".$row2['id'].">".$row2['name']."</option>";
                    }
                  echo"
              </select>
                  <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                  <div class=form-group'>
                    <label>Keterangan</label>
                    <input type='text' class='form-control' name='keterangan' id='keterangan' placeholder='keterangan'>
                  </div>
                  <div class=form-group'>
                  <label>NOMINAL</label>
                  <input type='text' class='form-control' name='nominal' id='nominal' placeholder='nominal'>
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
                  <button type='button' class='btn btn-primary' onclick='insertPricelembur()'>Submit</button>
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
  function insertPricelembur(){
    var x = $("input[name=id]").val();
    var y = document.getElementById("staff").options[document.getElementById("staff").selectedIndex].value;
    var z = $("input[name=keterangan]").val();
    var w = $("input[name=nominal]").val();
   
    $.ajax({
        url:"inserttunjangan.php",
        method: "POST",
        asynch: false,
        data:{id:x,staff:y,keterangan:z,nominal:w},
        success:function(data){
          reloadsallary(6,x,0);
        }
      });
    
  }
</script>
