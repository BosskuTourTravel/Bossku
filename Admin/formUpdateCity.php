<?php
include "../site.php";
include "../db=connection.php";
$querytour = "SELECT * FROM country";
$rstour=mysqli_query($con,$querytour);

$querycity = "SELECT * FROM city WHERE id=".$_POST['id'];
$rscity = mysqli_query($con,$querycity);
$rowcity = mysqli_fetch_array($rscity);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM UPDATE CITY</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(-5,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>
                  <div class='form-group'>
                    <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                    <label>Name</label>
                    <input type='text' class='form-control' name='name' id='name' value='".$rowcity['name']."' placeholder='Enter City Name'>
                  </div>
                   <div class=form-group'>
                    <label>Country</label>
                    <select class='form-control select2' name='country' id='country' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowtour = mysqli_fetch_array($rstour)){
                      if($rowcity['country'] == $rowtour['id']){
                        echo "<option selected='selected' value=".$rowtour['id'].">".$rowtour['name']."</option>";
                      }else{
                        echo "<option value=".$rowtour['id'].">".$rowtour['name']."</option>";
                      }
                    }
                    echo"</select>
                  </div>";
                  
                  
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
        var a = $("input[name=name]").val();
        var b = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;
        var x = $("input[name=id]").val();
        fd.append('name',a);
        fd.append('country',b);
        fd.append('id',x);


        $.ajax({
            url: 'updateCity.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
            	alert(response);
              reloadPage(-5,0,0);
            },
        });
    });
});

</script>
