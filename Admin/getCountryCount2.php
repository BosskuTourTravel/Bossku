 <?php
 include "../site.php";
 include "../db=connection.php";
 $count = $_POST['count'];

echo "<input type='text' class='form-control' name='countryCount' id='countryCount' value='".$_POST['count']."' hidden>";
 for ($x = 1; $x <= $count; $x++){
 	$querycity = "SELECT * FROM country";
 	$rscity=mysqli_query($con,$querycity);
 	echo"<div class=form-group' style='margin-bottom:10px;'>
 	<label>Country ".$x."</label>
 	<select class='chosen' name='countryA".$x."' id='countryA".$x."' style='width: 100%;'>
 	<option selected='selected' value=0>Pilihan</option>";

 	while($rowcity = mysqli_fetch_array($rscity)){
 		echo "<option value='".$rowcity['id']."'>".$rowcity['name']."</option>";
 	}
 	echo"</select></div>";

 }

 ?>
 <script>
 	$(document).ready(function(){
 		$(".chosen").chosen();
 	});
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
