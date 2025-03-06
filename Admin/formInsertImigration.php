<?php
include "../site.php";
include "../db=connection.php";
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT IMIGRATION</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPassport(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action=''>
                <div class='card-body'>
                  
                  <div class=form-group'>
                   <label>Zone</label>
                    <input type='text' required class='form-control' name='zone' id='zone' placeholder='Enter Imigration Zone'>
                  </div>
                 <div class=form-group'>
                   <label>Address</label>
                    <input type='text' required class='form-control' name='address' id='address' placeholder='Enter Imigration Address'>
                  </div>
                  <div class=form-group'>
                   <label>Phone</label>
                    <input type='text' required class='form-control' name='phone' id='phone' placeholder='Enter Imigration Phone'>
                  </div>

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
  $("#but_upload").click(function(){
    var b = $("input[name=zone]").val();
    var c = $("input[name=address]").val();
    var d = $("input[name=phone]").val();

    $.ajax({
        url:"insertImigration.php",
        method: "POST",
        asynch: false,
        data:{zone:b,address:c,phone:d},
        success:function(data){
          reloadPassport(0,0,0);
        }
      });
    
  });
</script>
