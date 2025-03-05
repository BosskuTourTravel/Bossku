<?php
include "../site.php";
include "../db=connection.php";
session_start();
$query= "SELECT * FROM lembur WHERE id_lembur=".$_POST['id'];
$rs= mysqli_query($con,$query);


echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT LEMBUR </h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadsallary(4,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>

              <div class='card card-primary'>";
              while($row = mysqli_fetch_array($rs)){

                $queryg = "SELECT * FROM login_staff where id=".$row['staff'];
                $rsg=mysqli_query($con,$queryg);

                $querylp = "SELECT * FROM lemburPrice WHERE nama=".$row['staff'];
                $rslp=mysqli_query($con,$querylp);
                $rowlp = mysqli_fetch_array($rslp);
                
              echo"
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='insertPricePackage.php'>
                <div class='card-body'>
                <label>STAFF</label>
                <select class='chosen' name='staff' id='staff'>";
                    while($row2 = mysqli_fetch_array($rsg)){
                      echo "<option value=".$row2['id'].">".$row2['name']."</option>";
                    }
                  echo"
              </select>
                   <label>Rp".$rowlp['nominal']."/ Jam</label>
                  <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                  <input name='tid' id='tid' value='".$_POST['tid']."' type='hidden' >
                  <input name='lp' id='lp' value='".$rowlp['nominal']."' type='hidden' >
                  <input name='type' id='type' value='".$rowlp['type']."' type='hidden' >
                  <div class=form-group'>
                  <label>Place</label>
                  <select class='chosen' name='place' id='place'>
                      <option value=".$row['place'].">".$row['place']."</option>
                      <option value='pameran'>Pameran</option>
                      <option value='San Diego'>San Diego</option>
                      <option value='Pasar Atom'>Pasar Atom</option>
                      <option value='Batam'>Batam</option>
                </select>
                </div>
                  <div class=form-group'>
                    <label>Start working</label>
                    <input type='time' class='form-control' name='mulai' id='mulai' value='".$row['mulai']."'>
                  </div>
                  <div class=form-group'>
                  <label>Finish working</label>
                  <input type='time' class='form-control' name='end' id='end' value='".$row['end']."'>
                </div>
                  </div>";
                echo "</div>
                <div class='card-footer'>
                  <button type='button' class='btn btn-primary' onclick='Updatelembur()'>Submit</button>
                </div>
              </form>
            </div>
              </div>
            </div>
          </div>
        </div>
</div>";
}
?>

<script>
  function Updatelembur(){
    var x = $("input[name=id]").val();
    var u = $("input[name=lp]").val();
    var t = $("input[name=type]").val();
    var y = document.getElementById("staff").options[document.getElementById("staff").selectedIndex].value;
    var z = $("input[name=mulai]").val();
    var w = $("input[name=end]").val();
    var v = document.getElementById("place").options[document.getElementById("place").selectedIndex].value;
alert(w);
   
    $.ajax({
        url:"Updateviewlemburlembur.php",
        method: "POST",
        asynch: false,
        data:{id:x,staff:y,mulai:z,end:w,place:v,lp:u,type:t},
        success:function(data){
          reloadsallary(4,x,0);
        }
      });
  }
</script>
