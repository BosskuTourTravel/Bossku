<?php
include "../site.php";
include "../db=connection.php";

$query2 = "SELECT * FROM staff_type";
$rs2=mysqli_query($con,$query2);

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
                      <button type='submit' onclick='reloadPage(-3,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                    <label>Name</label>
                    <input type='text' required class='form-control' name='name' id='name' placeholder='Enter Name'>
                  </div>
                  <div class=form-group'>
                   <label>Email</label>
                    <input type='email' required class='form-control' name='email' id='email' placeholder='Enter Email'>
                  </div>
                  <div class=form-group'>
                   <label>Password</label>
                    <input type='password' required class='form-control' name='password' id='password' placeholder='Enter Password'>
                  </div>
                  <div class=form-group'>
                   <label>Phone Number</label>
                    <input type='text' required class='form-control' name='phone' id='phone' placeholder='Enter Phone Number'>
                  </div>
                  <div class=form-group'>
                    <label>Staff</label>
                    <select class='form-control select2' required name='staff' id='staff' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";
                    while($row2 = mysqli_fetch_array($rs2)){
                      if($row2['id']!=1){
                        echo "<option value=".$row2['id'].">".$row2['name']."</option>";
                      }
                    }
                    echo"</select>
                  </div>

                <div class='card-footer'>
                  <button type='button' class='btn btn-primary'  id='but_upload'>Submit</button>
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
    var b = $("input[name=email]").val();
    var c = $("input[name=password]").val();
    var d = $("input[name=name]").val();
    var e = document.getElementById("staff").options[document.getElementById("staff").selectedIndex].value;
    var f = $("input[name=phone]").val();

    $.ajax({
        url:"insertStaff.php",
        method: "POST",
        asynch: false,
        data:{name:d,email:b,password:c,staff:e,phone:f},
        success:function(data){
          if(data=='success'){
            alert(data);
          reloadPage(-3,0,0);
          }
        }
      });
    
  });
</script>
