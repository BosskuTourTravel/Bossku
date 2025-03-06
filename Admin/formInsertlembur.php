<?php
include "../site.php";
include "../db=connection.php";
session_start();
$date2=date("w");
$queryg = "SELECT * FROM login_staff where id=".$_SESSION['staff_id'];
$rsg=mysqli_query($con,$queryg);

$querylp = "SELECT * FROM lemburPrice WHERE nama=".$_SESSION['staff_id'];
$rslp=mysqli_query($con,$querylp);
$rowlp = mysqli_fetch_array($rslp);
$queryset = "SELECT * FROM Setin WHERE id=".$rowlp['office'];
$rsset=mysqli_query($con,$queryset);
$rowset = mysqli_fetch_array($rsset);
echo "<div class='content-wrapper'>

 <div>
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

              <div class='card card-primary'>
              
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
                      <input name='lp' id='lp' value='".$rowlp['nominal']."' type='hidden' >
                      <input name='type' id='type' value='".$rowlp['type']."' type='hidden' >
                      <input name='office' id='office' value='".$rowset['jam']."' type='hidden' >
                  <div class=form-group'>
                      <label>Place</label>
                      <select class='chosen' name='place' id='place'>
                          <option selected='selected' value=0>Pilihan</option>
                          <option value='pameran'>Pameran</option>
                          <option value='San Diego'>San Diego</option>
                          <option value='Pasar Atom'>Pasar Atom</option>
                          <option value='Batam'>Batam</option>
                    </select>
                </div>";
                if($date2=="0"){
                echo"
                  <div class=form-group'>
                      <label>MENGGANTIKAN LIBUR</label>
                      <select class='chosen' name='ganti' id='ganti'>
                          <option selected='selected' value=0>TIDAK</option>
                          <option value='1'>IYA</option>
                    </select>
                </div>
                <div class=form-group' name='divtgl' id='divtgl'></div>";
                }
                echo"
                  </div>";
                 echo" <input type='hidden' id='date' name='date' value='".$date2."'>";
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
  $('#ganti').on('change', function() {
  var count = this.value;
  $.ajax({
    type:'POST',
    url:'tgl_count.php',
    data:{'count':count},
    success:function(data){
      $('#divtgl').html(data);
    }
  });
});
  function insertPricelembur(){
    var x = $("input[name=id]").val();
    var u = $("input[name=lp]").val();
    var t = $("input[name=type]").val();
    var w = $("input[name=office]").val();
    var y = document.getElementById("staff").options[document.getElementById("staff").selectedIndex].value;
    var v = document.getElementById("place").options[document.getElementById("place").selectedIndex].value;
    var date = $("input[name=date]").val();
    var a="";
    var b="";
    if(date = 0){
//      a = a + $("#t_ganti").val();
   var a = $("input[name=t_ganti]").val();
    var b = document.getElementById("ganti").options[document.getElementById("ganti").selectedIndex].value;
    }
      alert(a);
   
    $.ajax({
        url:"insertlemburin.php",
        method: "POST",
        asynch: false,
        data:{id:x,staff:y,place:v,lp:u,type:t,office:w,ganti:b,t_ganti:a},
        success:function(data){
          reloadsallary(4,x,0);
        }
      });
  }
</script>
