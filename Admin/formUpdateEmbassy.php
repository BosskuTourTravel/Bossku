  <script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

$query2 = "SELECT * FROM country";
$rs2=mysqli_query($con,$query2);

$query = "SELECT * FROM embassy WHERE id=".$_POST['id'];
$rs=mysqli_query($con,$query);
$row = mysqli_fetch_array($rs);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM UPDATE EMBASSY</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadVisa(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div >

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='insertPricePackage.php'>
                <div class='card-body'>
                <div class=form-group'>
                    <label>Country</label>
                    <select class='chosen' required name='country' id='country' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";
                    while($row2 = mysqli_fetch_array($rs2)){
                      if($row2['id']==$row['country']){
                        echo "<option selected value=".$row2['id'].">".$row2['name']."</option>";
                      }else{
                        echo "<option value=".$row2['id'].">".$row2['name']."</option>";
                      }
                    }
                    echo"</select>
                  </div>";

                  $querycity = "SELECT * FROM city";
                  $rscity=mysqli_query($con,$querycity);
                  echo"<div class=form-group' style='margin-bottom:10px;'>
                  <label>City</label>
                  <select class='chosen' name='city' id='city' style='width: 100%;'>
                  <option selected='selected' value=0>Pilihan</option>";

                  while($rowcity = mysqli_fetch_array($rscity)){
                    if($rowcity['id']==$row['city']){
                      echo "<option selected='selected' value='".$rowcity['id']."'>".$rowcity['name']."</option>";
                    }else{
                      echo "<option value='".$rowcity['id']."'>".$rowcity['name']."</option>";
                    }
                    
                  }
                  echo"</select></div>";

                  echo "<div class='form-group'>
                   <input type='text' required class='form-control' name='tid' id='tid' value='".$_POST['id']."' hidden>
                    <label>Address</label>
                    <input type='text' required class='form-control' name='address' id='address' value='".$row['address']."' placeholder='Enter Address'>
                  </div>
                  <div class=form-group'>
                   <label>Office Hour</label>
                    <input type='email' required class='form-control' name='hour' id='hour' value='".$row['office_hours']."' placeholder='Enter Office Hour'>
                  </div>
                  <div class=form-group'>
                   <label>Phone</label>
                    <input type='text' required class='form-control' name='phone' id='phone' value='".$row['phone']."' placeholder='Enter Phone'>
                  </div>
                  <div class=form-group'>
                   <label>Fax</label>
                    <input type='text' required class='form-control' name='fax' id='fax' value='".$row['fax']."' placeholder='Enter Fax'>
                  </div>
                  <div class=form-group'>
                   <label>Website</label>
                    <input type='text' required class='form-control' name='website' id='website' value='".$row['web']."'   placeholder='Enter Website'>
                  </div>
                  <div class=form-group'>
                   <label>Email</label>
                    <input type='text' required class='form-control' name='email' id='email' value='".$row['email']."' placeholder='Enter Email'>
                  </div>
                  

                <div class='card-footer'>
                  <button type='button' class='btn btn-primary' id='but_upload'>Submit</button>
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

	$(document).ready(function(){
		$(".chosen").chosen();
	});
	$("#but_upload").click(function(){
		var b = $("input[name=address]").val();
		var c = $("input[name=hour]").val();
		var d = $("input[name=phone]").val();
		var e = $("input[name=fax]").val();
		var f = $("input[name=website]").val();
		var g = $("input[name=email]").val();
		var h = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;
    var i = document.getElementById("city").options[document.getElementById("city").selectedIndex].value;
    var x = $("input[name=tid]").val();

		$.ajax({
			url:"updateEmbassy.php",
			method: "POST",
			asynch: false,
			data:{'address':b,'hour':c,'phone':d,'fax':e,'web':f,'email':g,'country':h,'city':i,'id':x},
			success:function(data){
				reloadVisa(0,0,0);
			}
		});

	});
</script>
