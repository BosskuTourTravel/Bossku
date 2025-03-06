<?php
include "../site.php";
include "../db=connection.php";

$queryg = "SELECT * FROM login_staff";
$rsg=mysqli_query($con,$queryg);
$queryo = "SELECT * FROM Setin";
$rso=mysqli_query($con,$queryo);
echo "<div class='content-wrapper'>

 <div>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT LEMBUR PRICE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadsallary(8,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
              <select class='chosen' name='thn' id='thn'>
              <option selected='selected' value=0>Lebih dari 4 tahun </option>
              <option value='1'>YA</option>
              <option value='0'>TDK</option>
        </select>
              <div class=form-group'>
              <label>Type</label>
              <select class='chosen' name='type' id='type'>
                  <option selected='selected' value=0>Pilihan</option>
                  <option value='A'>A</option>
                  <option value='B'>B</option>
            </select>
            <small id='emailHelp' class='form-text text-muted'>Type A : overtime  x nominal && Type B : Durasi x nominal</small>
            </div>
                  <div class=form-group'>
                  <label>OFFICE</label>
                  <select class='chosen' name='office' id='office'>
                      <option selected='selected' value=0>Pilihan</option>";
  
                      while($row3 = mysqli_fetch_array($rso)){
                        echo "<option value=".$row3['id'].">".$row3['nama']."</option>";
                      }
                    echo"
                </select>
                  </div>
                  <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
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
    var w = $("input[name=nominal]").val();
    var t = document.getElementById("type").options[document.getElementById("type").selectedIndex].value;
    var s = document.getElementById("office").options[document.getElementById("office").selectedIndex].value;
    var z = document.getElementById("thn").options[document.getElementById("thn").selectedIndex].value;
   
    $.ajax({
        url:"insertLP.php",
        method: "POST",
        asynch: false,
        data:{id:x,staff:y,nominal:w,type:t,office:s,thn:z},
        success:function(data){
          reloadsallary(8,x,0);
        }
      });
    
  }
</script>
