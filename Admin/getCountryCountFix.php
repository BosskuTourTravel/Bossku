 <?php
 include "../site.php";
 include "../db=connection.php";

 $tableName = $_POST['tableName'];
 $count = $_POST['count'];
 $id = $_POST['id'];
 $query = "SELECT * FROM ".$tableName." WHERE id=".$id;
 $rs=mysqli_query($con,$query);
 $row = mysqli_fetch_array($rs);

 $tempCountry = preg_split ("/[;]+/", $row['country']);

echo "<input type='text' class='form-control' name='countryCount' id='countryCount' value='".$_POST['count']."' hidden>";
 for ($x = 1; $x <= $count; $x++){
 	$querycity = "SELECT * FROM country";
 	$rscity=mysqli_query($con,$querycity);
 	echo"<div class=form-group' style='margin-bottom:10px;'>
 	<label>Country ".$x."</label>
 	<select class='chosen' name='country".$x."' id='country".$x."' style='width: 100%;'>
 	<option selected='selected' value=0>Pilihan</option>";

 	while($rowcity = mysqli_fetch_array($rscity)){
 		if($rowcity['id']==$tempCountry[$x-1]){
      echo "<option selected='selected' value='".$rowcity['id']."'>".$rowcity['name']."</option>";
    }else{

      echo "<option value='".$rowcity['id']."'>".$rowcity['name']."</option>";
    }
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
