<?php
include "../site.php";
include "../db=connection.php";

$queryjob = "SELECT * FROM jobdesk WHERE id=".$_POST['staff'];
$rsjob=mysqli_query($con,$queryjob);

while($rowjob = mysqli_fetch_array($rsjob)){
      $data= explode(",",$rowjob['job']);
      for($i=0; $i < count($data); $i++){
          echo " <div class=form-group' name='salaryCount".$i."' id='salaryCount".$i."'>
            <label style='margin-right:85px;'><option value=>".$data[$i]."</option></label>
                <select name='salaryItem".$i."' id='salaryItem".$i."' onchange='getSalaryItem(this.value,".$i.")'>
                   <option selected='selected' value=0>Pilih jumlah Item</option>";
      
                          for ($x = 1; $x <= 20; $x++){
                            echo "<option value=".$x.">".$x."</option>";
                          }


                echo "</select>
                </div></br>
                <div class=form-group' name='divsallary".$i."' id='divsallary".$i."'></div>";

                  echo"
                  </div>";
                                    }  
                  }
?>
<script>
$(document).ready(function () {
  $(".chosen").chosen();
  
})

function getSalaryItem(x,y){
  var count = $("#salaryItem"+x).val();
 		var id = $("#salaryCount"+x).val();
    $.ajax({
      type:'POST',
      url:'getSallary_item.php',
      data:{'salaryItem':x,'countItem':y},
      success:function(data){
        $('#divsallary'+y).html(data);
      }
    });
    
  } 

</script>

