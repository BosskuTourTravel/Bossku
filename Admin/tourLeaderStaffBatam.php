<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<style>
  .tableFixHead          { overflow-y: auto; height: 100px; }
  .tableFixHead thead th { position: sticky; top: 0; }

  /* Just common table stuff. Really. */
  th     { background:#ffff; }

</style>
<?php
include "../site.php";
include "../db=connection.php";
session_start();

echo "<center><h3>Tour Leader Staff Batam</h3></center>";
$query = "SELECT * FROM tour_leader_staff_batam ORDER BY id ASC";
$rs=mysqli_query($con,$query);
$arrayID = [];
echo "<table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:14px;'>
<thead>
<tr>
<th width='10%'>Country</th>
<th width='10%'>Kurs</th>
<th width='20%'>Fee Low Season</th>
<th width='20%'>Fee High Season</th>
<th width='20%'>Meal</th>
<th width='20%'>Voucher Hp</th>
</tr>
</thead>
<tbody id='myTable'>";
while($row=mysqli_fetch_array($rs)){
  array_push($arrayID,$row['id']);
  $query_country = "SELECT * FROM country WHERE id=".$row['country'];
  $rs_country=mysqli_query($con,$query_country);
  $row_country = mysqli_fetch_array($rs_country);

  $query_kurs = "SELECT * FROM kurs_bank";
  $rs_kurs=mysqli_query($con,$query_kurs);
  echo "<tr>";
  echo "<td>".$row['country']."</td>";
  echo "<td><select class='chosen' name='kurs".$row['id']."' id='kurs".$row['id']."'>
  <option selected='selected' value=0>Pilihan</option>";
  while($row_kurs = mysqli_fetch_array($rs_kurs)){
    if($row_kurs['id']==$row['kurs']){
      echo "<option selected value='".$row_kurs['id']."'>".$row_kurs['name']."</option>";
    }else{
      echo "<option value='".$row_kurs['id']."'>".$row_kurs['name']."</option>";
    }
    
  }

  echo"</select></td>";
  echo "<td><input type='text' name='fee_lowseason".$row['id']."' id='fee_lowseason".$row['id']."' value='".$row['fee_low_season']."'></td>";
  echo "<td><input type='text' name='fee_highseason".$row['id']."' id='fee_highseason".$row['id']."' value='".$row['fee_high_season']."'></td>";
  echo "<td><input type='text' name='meal".$row['id']."' id='meal".$row['id']."' value='".$row['meal']."'></td>";
  echo "<td><input type='text' name='voucher".$row['id']."' id='voucher".$row['id']."' value='".$row['voucher_hp']."'></td>";
  echo "</tr>";
  

}

echo "
</tbody>
</table>";

echo "<center><button type='button' class='btn btn-primary' id='but_upload'>Submit</button></center></br>";
?>

<script>

$(document).ready(function(){
    $(".chosen").chosen();

    $("#but_upload").click(function(){
        var fd = new FormData();

        var tempID = <?php echo json_encode($arrayID); ?>;
        fd.append('tempID',JSON.stringify(tempID));
        fd.append('pil',2);
        for (i = 0; i < tempID.length; i++) {
            var fee_lowseason = $("input[name=fee_lowseason"+tempID[i]+"]").val();
            var fee_highseason = $("input[name=fee_highseason"+tempID[i]+"]").val();
            var meal = $("input[name=meal"+tempID[i]+"]").val();
            var voucher = $("input[name=voucher"+tempID[i]+"]").val();
            var kurs = document.getElementById("kurs"+tempID[i]).options[document.getElementById("kurs"+tempID[i]).selectedIndex].value;
            fd.append('fee_lowseason'+tempID[i],fee_lowseason);
            fd.append('fee_highseason'+tempID[i],fee_highseason);
            fd.append('meal'+tempID[i],meal);
            fd.append('voucher'+tempID[i],voucher);
            fd.append('kurs'+tempID[i],kurs);
        }

        $.ajax({
          url: 'updateTourLeaderFee.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
            if(response=="success"){
              alert(response);
            }else{
              alert(response);
              reloadManual(2,0,0);
            }

          },
        });

    });

});

function searchTourLeader(x,y,z){
  if(x==0){
    var pil = y;

      if(pil==1){
        $.ajax({
          url:"tourLeaderFreelandBatam.php",
          method: "POST",
          asynch: false,
          data:{id:x,tipe:y},
          success:function(data){
            $('#divTourLeader').html(data);
          }
        });
      }else if(pil==2){
        $.ajax({
          url:"tourLeaderStaffBatam.php",
          method: "POST",
          asynch: false,
          data:{id:x,tipe:y},
          success:function(data){
            $('#divTourLeader').html(data);
          }
        });

      }else if(pil==3){
        $.ajax({
          url:"tourLeaderFreelandSurabaya.php",
          method: "POST",
          asynch: false,
          data:{id:x,tipe:y},
          success:function(data){
           $('#divTourLeader').html(data);
          }
        });

      }else{
        $.ajax({
          url:"tourLeaderStaffSurabaya.php",
          method: "POST",
          asynch: false,
          data:{id:x,tipe:y},
          success:function(data){
            $('#divTourLeader').html(data);
            
          }
        });

      }
  }
}

</script>


