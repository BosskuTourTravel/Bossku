  <script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";

$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);

$querycity = "SELECT * FROM city";
$rscity=mysqli_query($con,$querycity);

$query_category = "SELECT * FROM agent_category";
$rs_category=mysqli_query($con,$query_category);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT AGENT</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(-12,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action=''>
                <div class='card-body'>
                   <div class=form-group'>
                   <label>Company</label>
                    <input type='text' required class='form-control' name='company' id='company' placeholder='Enter Company'>
                  </div>
                  <div class=form-group'>
                    <label>Category</label>
                    <select class='chosen' name='category' id='category' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($row_category = mysqli_fetch_array($rs_category)){
                      echo "<option value=".$row_category['id'].">".$row_category['name']."</option>";
                    }
                    echo"</select>
                  </div>
                  <div class=form-group'>
                   <label>Agent Name</label>
                    <input type='text' required class='form-control' name='name' id='name' placeholder='Enter Name'>
                  </div>
                 <div class=form-group'>
                   <label>Agent Email</label>
                    <input type='text' required class='form-control' name='email' id='email' placeholder='Enter Email'>
                  </div>

                  <div class=form-group'>
                    <label>City</label>
                    <select class='chosen' name='city' id='city' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcity = mysqli_fetch_array($rscity)){
                      echo "<option value=".$rowcity['name'].">".$rowcity['name']."</option>";
                    }
                    echo"</select>
                  </div>

                  <div class=form-group'>
                   <label>Zipcode</label>
                    <input type='text' required class='form-control' name='zipcode' id='zipcode' placeholder='Enter Zipcode'>
                  </div>
                  <div class=form-group'>
                   <label>State</label>
                    <input type='text' required class='form-control' name='state' id='state' placeholder='Enter State'>
                  </div>
                  <div class=form-group'>
                   <label>Street</label>
                    <input type='text' required class='form-control' name='street' id='street' placeholder='Enter Street'>
                  </div>

                  <div class=form-group'>
                    <label>Country</label>
                    <select class='chosen' name='country' id='country' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcountry = mysqli_fetch_array($rscountry)){
                      echo "<option value=".$rowcountry['name'].">".$rowcountry['name']."</option>";
                    }
                    echo"</select>
                  </div>

                  </br>
                  <div class=form-group'>
                    <label>Tour Country</label>
                    <select name='country_count' id='country_count'>
                    <option selected='selected' value=0>Jumlah Country</option>";

                    for ($x = 1; $x <= 20; $x++){
                      echo "<option value=".$x.">".$x."</option>";
                    }
                   echo "</select></div>
                   <div class=form-group' name='divcountry' id='divcountry'></div>
                   </br>

                  <div class=form-group'>
                   <label>Website</label>
                    <input type='text' required class='form-control' name='website' id='website' placeholder='Enter Website'>
                  </div>
                  <div class=form-group'>
                   <label>Phone</label>
                    <input type='text' required class='form-control' name='phone' id='phone' placeholder='Enter Phone'>
                  </div>
                  <div class=form-group'>
                   <label>Fax</label>
                    <input type='text' required class='form-control' name='fax' id='fax' placeholder='Enter Fax'>
                  </div>

                  <div class=form-group'>
                   <label>Job Title</label>
                    <input type='text' required class='form-control' name='jobtitle' id='jobtitle' placeholder='Enter Job Title'>
                  </div>
                  <div class=form-group'>
                   <label>Home Phone</label>
                    <input type='text' required class='form-control' name='homephone' id='homephone' placeholder='Enter Home Phone'>
                  </div>
                  <div class=form-group'>
                   <label>Home Fax</label>
                    <input type='text' required class='form-control' name='homefax' id='homefax' placeholder='Enter Home Fax'>
                  </div>
                  <div class=form-group'>
                   <label>Car Phone</label>
                    <input type='text' required class='form-control' name='carphone' id='carphone' placeholder='Enter Car Phone'>
                  </div>
                  <div class=form-group'>
                   <label>Home Webpage</label>
                    <input type='text' required class='form-control' name='homewebpage' id='homewebpage' placeholder='Enter Home Webpage'>
                  </div>
                  <div class=form-group'>
                   <label>Pager</label>
                    <input type='text' required class='form-control' name='pager' id='pager' placeholder='Enter Pager'>
                  </div>
                  <div class=form-group'>
                   <label>Notes</label>
                    <input type='text' required class='form-control' name='notes' id='notes' placeholder='Enter Notes'>
                  </div>

                <div class='card-footer'>
                  <button type='button' class='btn btn-primary' onclick='updateAgent()'>Submit</button>
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
   $('#country_count').on('change', function() {
        var count = this.value;
        $.ajax({
          type:'POST',
          url:'getCountryCount.php',
          data:{'count':count},
          success:function(data){
           $('#divcountry').html(data);
         }
       });
    });
   });

  function updateAgent(){
    var a = $("input[name=company]").val();
    var b = $("input[name=name]").val();
    var c = $("input[name=email]").val();
    var d = $("input[name=city]").val();
    var e = $("input[name=zipcode]").val();
    var f = $("input[name=state]").val();
    var g = $("input[name=country]").val();
    var i = $("input[name=website]").val();
    var j = $("input[name=phone]").val();
    var k = $("input[name=fax]").val();
    var l = $("input[name=jobtitle]").val();
    var m = $("input[name=homephone]").val();
    var n = $("input[name=homefax]").val();
    var o = $("input[name=carphone]").val();
    var p = $("input[name=homewebpage]").val();
    var q = $("input[name=street]").val();
    var r = $("input[name=pager]").val();
    var s = $("input[name=notes]").val();

    var h = "";
    for (var i = 1; i <= $("#country_count").val(); i++) {
      if(i==1){
        h = h + $("#country"+i).val();
      }
      else{
        h = h + ";" + $("#country"+i).val();
      }
    }

    $.ajax({
        url:"insertAgent.php",
        method: "POST",
        asynch: false,
        data:{company:a,name:b,email:c,city:d,zipcode:e,state:f,country:g,tourcountry:h,website:i,phone:j,fax:k,jobtitle:l,homephone:m,homefax:n,carphone:o,homewebpage:p,street:q,pager:r,notes:s},
        success:function(data){
          if(data='success'){
            alert(data);
          reloadPage(-12,0,0);
          }else{
            alert(data);
          }
        }
      });
    
  }
</script>
