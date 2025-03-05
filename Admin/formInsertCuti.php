<?php
include "../site.php";
include "../db=connection.php";

session_start();
echo "<div class='content-wrapper'>

 <div>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM PENGAJUAN CUTI</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadsallary(12,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                    <input type='text' class='form-control' name='name' id='name' value='".$_SESSION['staff']."'>
                  </div>
                  <div class=form-group'>
                  <label style='margin-right:85px;'>LAMA CUTI</label>
                  <select name='tcuti' id='tcuti'>
                    <option selected='selected' value=0>Pilih jumlah hari</option>";
                      for ($x = 1; $x <= 10; $x++){
                        echo "<option value=".$x.">".$x."</option>";
                      }
                  
                 echo "</select>
                  <div class=form-group' name='divcuti' id='divcuti'></div>";
                  echo" 
                  <div class='from-group'>
                  <label>Keterangan</label>
                  <input type='text' class='form-control' name='ket' id='ket' placeholder='alasan cuti'>
                  </div>";
                  
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
        $('#tcuti').on('change', function() {
        var count = this.value;
        alert(count);
        $.ajax({
          type:'POST',
          url:'cuti_count.php',
          data:{'count':count},
          success:function(data){
           $('#divcuti').html(data);
         }
       });
      });
  function insertPricejob(){
    var x = $("input[name=name]").val();
    var z = $("input[name=ket]").val();
    var y = document.getElementById("tcuti").options[document.getElementById("tcuti").selectedIndex].value;
    var h = "";
      //  var z = "";
        for (var i = 1; i <= $("#tcuti").val(); i++) {
          if(i==1){
            h = h + $("#tawal"+i).val();
          }
          else{
            h = h + "," + $("#tawal"+i).val();
          }
        }
    $.ajax({
        url:"insertCuti.php",
        method: "POST",
        asynch: false,
        data:{name:x,tcuti:y,tawal:h,ket:z},
        success:function(data){
          reloadsallary(12,x,0);
        }
      });
    
  }

</script>
