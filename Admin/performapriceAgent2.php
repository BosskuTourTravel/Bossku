<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);


echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM PERFORMA PRICE AGENT COUNTRYl</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div>


              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>
                    <div class='form-group'>
                            <div class='col-4'>
                                <label>Country</label>
                                        <select class='chosen' name='country' id='country' onchange='getAgent(this.value)' class='form-control'>
                                        <option selected='selected' value=0>Pilihan</option>";
                                            while($rowcountry = mysqli_fetch_array($rscountry)){
                                            	$querytourpackage = "SELECT * FROM tour_package";
                                            	$rstourpackage=mysqli_query($con,$querytourpackage);
                                            	$cekTourPackage = 0;
                                            	while($rowtourpackage = mysqli_fetch_array($rstourpackage)){
                                            		$tempCountry = preg_split ("/[;]+/", $rowtourpackage['country']);
                                            		for($i=0; $i<count($tempCountry); $i++){
                                            			if($tempCountry[$i]==$rowcountry['id']){
                                            				$cekTourPackage = 1;
                                            			}
                                            		}

                                            		if($cekTourPackage==1){
                                            			$queryperforma = "SELECT COUNT(*) as total FROM performa_price_standart WHERE country = ".$rowcountry['id'];
                                            			$rsperforma=mysqli_query($con,$queryperforma);
                                            			$rowperforma = mysqli_fetch_assoc($rsperforma);

                                            			// $queryperforma2 = "SELECT COUNT(*) as total FROM performa_price WHERE tour_package = ".$rowtourpackage['id'];
                                            			// $rsperforma2=mysqli_query($con,$queryperforma2);
                                            			// $rowperforma2 = mysqli_fetch_assoc($rsperforma2);

                                            			if($rowperforma['total']>0){
                                            				$cekTourPackage = 2;

                                            			}
                                            		}
                                            		if($cekTourPackage==2){
                                            			break;
                                            		}
                                            	}

                                            	if($cekTourPackage == 2){
                                            		echo "<option style='color:green;' value='".$rowcountry['id']."'>".$rowcountry['id']." - ".$rowcountry['name']."</option>";
                                            	}elseif($cekTourPackage == 0){
                                            		echo "<option value='".$rowcountry['id']."'>".$rowcountry['id']." - ".$rowcountry['name']."</option>";
                                            	}else{
                                            		echo "<option style='color:red;' value='".$rowcountry['id']."'>".$rowcountry['id']." - ".$rowcountry['name']."</option>";
                                            	}
                                                
                                              }
                                echo"</select>
                    </div>
                    <div class=form-group' name='divcountry' id='divcountry'></div>

                </div>";
               echo"
             </form>
         </div>
    </div>
</div>
</div>
</div>
</div>";
?>

<script>
   function getAgent(x) {
    $.ajax({
      type:'POST',
      url:'getAgent2.php',
      data:{'country':x},
      success:function(data){
        $('#divcountry').html(data);
      }
    });
  }
  
$(document).ready(function(){
    $(".chosen").chosen();


});

</script>
