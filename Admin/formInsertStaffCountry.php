  <script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM login_staff";
$rs=mysqli_query($con,$query);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT STAFF COUNTRY</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(-16,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div>

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action=''>
              <div class='card-body'>
                  <div class=form-group'>
                   <label>Staff</label>
                   <select class='chosen' name='staff".$x."' id='staff".$x."' style='width: 100%;'>
                   <option selected='selected' value=0>Pilihan</option>";

                   while($row = mysqli_fetch_array($rs)){

                    $query_type = "SELECT * FROM staff_type WHERE id=".$row['type'];
                    $rs_type=mysqli_query($con,$query_type);
                    $row_type = mysqli_fetch_array($rs_type);

                    if($row['type']==1 || $row['type']==2){

                    }else{
                      echo "<option value=".$row['id'].">".$row['name']." ( ".$row_type['name']." )</option>";
                    }
                    
                  }
                  echo"</select>
                  </div>

                  </br>
                  <div class=form-group'>
                    <label>Tour Country</label>
                    <select name='country_count' id='country_count'>
                    <option selected='selected' value=0>Jumlah Country</option>";

                    for ($x = 1; $x <= 20; $x++){
                      echo "<option value=".$x.">".$x."</option>";
                    }
                   echo "</select></div>
                   <div class=form-group' name='divcountry' id='divcountry'></div>
                   </br>

        

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
   $('#country_count').on('change', function() {
        var count = this.value;
        $.ajax({
          type:'POST',
          url:'getCountryCount.php',
          data:{'count':count},
          success:function(data){
           $('#divcountry').html(data);
         }
       });
    });

   $("#but_upload").click(function(){
      var fd = new FormData();
      var a = document.getElementById("staff").options[document.getElementById("staff").selectedIndex].value;

      var h = "";
      for (var i = 1; i <= $("#country_count").val(); i++) {
          h = h + $("#country"+i).val() + ";";
      }

      fd.append('agent',a);
      fd.append('country',h);

      $.ajax({
              url: 'insertStaffCountry.php',
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              success: function(response){
                if(response=="success"){
                  alert(response);
                  reloadPage(-16,0,0);
                }else{
                  alert(response);
                }
                
              },
          });
      
      });
   });

  
</script>
