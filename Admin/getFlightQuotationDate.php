 <?php
 include "../site.php";
 include "../db=connection.php";
 $count = $_POST['count'];

echo "<input type='text' class='form-control' name='dateCount' id='dateCount' value='".$_POST['count']."' hidden>";
 for ($x = 1; $x <= $count; $x++){
 	echo"<div class=form-group' style='margin-bottom:10px;'>
 	<label>Date ".$x."</label>
  <input class='form-control' type='text' name='datefilter".$x."' id='datefilter".$x."' value='".$dateNow."' style='height:2%;'/></div>";

 }

 ?>
 <script>
 	$(document).ready(function(){
 		$(".chosen").chosen();

    var countDate = <?php echo $count; ?>;
    
    for (i = 1; i <= countDate; i++) {
      $('input[name="datefilter'+i+'"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
      });

    }
    
 	});

 </script>
