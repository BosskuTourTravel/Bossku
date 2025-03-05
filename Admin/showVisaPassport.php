 <?php
 include "../site.php";
 include "../db=connection.php";
 $type = $_POST['type'];



if($type==0){
  $queryp = "SELECT * FROM visa";
  $rsp=mysqli_query($con,$queryp);
  echo "<div class=form-group' style='margin-bottom:10px;'>
  <label>Visa</label>
  <select class='chosen' name='visapassport' id='visapassport' style='width: 100%;'>
  <option selected='selected' value=0>Pilihan</option>";

  while($rowp = mysqli_fetch_array($rsp)){
    $querycountry = "SELECT * FROM country WHERE id=".$rowp['country'];
    $rscountry=mysqli_query($con,$querycountry);
    $rowcountry = mysqli_fetch_array($rscountry);
    echo "<option value=".$rowp['id'].">".$rowcountry['name']." (".$rowp['type']." / ".$rowp['day']." days / Rp ".number_format($rowp['price'], 0, ".", ".")." )</option>";
  }
  
}else{
  $queryp = "SELECT * FROM passport";
  $rsp=mysqli_query($con,$queryp);
  echo "<div class=form-group' style='margin-bottom:10px;'>
  <label>Passport</label>
  <select class='chosen' name='visapassport' id='visapassport' style='width: 100%;'>
  <option selected='selected' value=0>Pilihan</option>";

  while($rowp = mysqli_fetch_array($rsp)){
    echo "<option value=".$rowp['id'].">".$rowp['zone']." (".$rowp['day']." days / Rp ".number_format($rowp['price'], 0, ".", ".")." )</option>";
  }
}

 	echo"</select></div>
  <div class=form-group' name='divPassportPrice' id='divPassportPrice'></div>";
   echo "<div class=form-group'>
   <label>Jumlah Pax</label>
   <select class='chosen' name='pax' id='pax'>
   <option selected='selected' value=0>Jumlah</option>";

   for ($y = 1; $y <= 30; $y++){
    echo "<option value=".$y.">".$y."</option>";
  }
  echo "</select></div>";


 ?>
 <script>
 	$(document).ready(function(){
 		$(".chosen").chosen();
 	});

  // $('#passport').on('change', function() {
  //   var id = this.value;
  //   $.ajax({
  //     type:'POST',
  //     url:'getPassportPrice.php',
  //     data:{'id':id},
  //     success:function(data){
  //       $('#divPassportPrice').html(data);
  //     }
  //   });
        
  //   });


 	function getCountry(x){
      $('#divcity'+x).html("");
      var id = $("#country"+x).val();
      $.ajax({
        type:'POST',
        url:'getCity.php',
        data:{'id':id},
        success:function(data){
                // the next thing you want to do 
                var obj = JSON.parse(data);
                var city = document.getElementById('city'+x);
                $(city).empty();
                //$(city).append("<option selected='selected' value=0>Pilihan</option>");
                for (var i = 0; i < obj.length; i++) {
                  $('#city'+x+i).append("<option value="+obj[i].id+">"+obj[i].name+"</option>");
                  $('#city'+x+i).trigger("chosen:updated");
                }
              }
            });
    }

 </script>
