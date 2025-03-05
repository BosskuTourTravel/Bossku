<?php
include "../site.php";
include "../db=connection.php";


$querycity = "SELECT * FROM transport_type WHERE id=".$_POST['id'];
$rstr = mysqli_query($con,$querytr);
$rowtr = mysqli_fetch_array($rstr);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM UPDATE TRANSPORT TYPE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadTransport(1,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body'>

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>
                  <div class='form-group'>
                    <label>Name</label>
                    <input type='text' class='form-control' name='name' id='name' placeholder='Enter Transport Name'>
                  </div>
                   <div class=form-group'>
                    <label>Transport Type</label>
                    <input type='text' class='form-control' name='name' id='name' placeholder='Enter Transport Type'>";

                    while($rowtr = mysqli_fetch_array($rstr)){
                      echo "<option value=".$rowtr['id'].">".$rowtr['name']."</option>";
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
    $(".chosen").chosen();
    $("#but_upload").click(function(){
        var fd = new FormData();
        var a = $("input[name=name]").val();
        var b = $("input[name=type]").val();
        fd.append('name',a);
        fd.append('type',b);


        $.ajax({
            url: 'updateTrtype.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
            	alert(response);
              reloadTransport(1,0,0);
            },
        });
    });
});

</script>
