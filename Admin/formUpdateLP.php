<?php
include "../site.php";
include "../db=connection.php";

$querylp = "SELECT * FROM lemburPrice WHERE id=".$_POST['id'];
$rslp = mysqli_query($con,$querylp);
echo "<div class='content-wrapper'>

 <div class='row'>
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
                <select class='chosen' name='staff' id='staff'>";
                    while($rowlp = mysqli_fetch_array($rslp)){
                        $querystaff = "SELECT * FROM login_staff WHERE id=".$rowlp['nama'];
                        $rsstaff=mysqli_query($con,$querystaff);
                        $rowstaff = mysqli_fetch_array($rsstaff);
                      echo "<option value=".$rowstaff['id'].">".$rowstaff['name']."</option>";
                    
                  echo"
              </select>
              <div class=form-group'>
              <label>Type</label>
              <select class='chosen' name='type' id='type'>
                  <option value=".$rowlp['type'].">".$rowlp['type']."</option>
                  <option value='A'>A</option>
                  <option value='B'>B</option>
            </select>
            </div>
                  <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                  <input name='tid' id='tid' value='".$_POST['tid']."' type='hidden' >
                  <div class='form-group'>
                  <label>NOMINAL</label>
                  <input type='text' class='form-control' name='nominal' id='nominal' value='".$rowlp['nominal']."' placeholder='nominal'>
                </div>
                  </div>";
                    }
                echo "</div>

                <div class='card-footer'>
                <button type='button' class='btn btn-primary' id='but_upload' >Submit</button>
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
    var x = $("input[name=id]").val();
    var a = document.getElementById("staff").options[document.getElementById("staff").selectedIndex].value;
    var b = $("input[name=nominal]").val();
    var t = document.getElementById("type").options[document.getElementById("type").selectedIndex].value;
    fd.append('staff',a);
    fd.append('nominal',b);
    fd.append('id',x);
    fd.append('type',t);


    $.ajax({
        url: 'UpdateLP.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            alert(response);
          reloadsallary(8,0,0);
        },
    });
});
});
</script>
