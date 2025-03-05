  <script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM agent WHERE id=".$_POST['id'];
$rs=mysqli_query($con,$query);
$row = mysqli_fetch_array($rs);

$query_category = "SELECT * FROM agent_category";
$rs_category=mysqli_query($con,$query_category);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM UPDATE AGENT</h3>
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
                    <input type='text' required class='form-control' name='company' id='company' value='".$row['company']."' placeholder='Enter Company'>
                  </div>
                  <div class=form-group'>
                    <label>Category</label>
                    <select class='chosen' name='category' id='category' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($row_category = mysqli_fetch_array($rs_category)){
                      if($row_category['id']==$row['category']){
                        echo "<option selected='selected' value=".$row_category['id'].">".$row_category['name']."</option>";
                      }else{
                        echo "<option value=".$row_category['id'].">".$row_category['name']."</option>";
                      }
                      
                    }
                    echo"</select>
                  </div>
                  <div class=form-group'>
                   <label>Agent Name</label>
                    <input type='text' required class='form-control' name='name' id='name' value='".$row['name']."' placeholder='Enter Name'>
                    <input type='text' required class='form-control' name='tid' id='tid' value='".$_POST['id']."' hidden>
                  </div>
                 <div class=form-group'>
                   <label>Agent Email</label>
                    <input type='text' required class='form-control' name='email' id='email' value='".$row['email']."' placeholder='Enter Email'>
                  </div>

                  <div class=form-group'>
                   <label>City</label>
                    <input type='text' required class='form-control' name='city' id='city' value='".$row['city']."' placeholder='Enter City'>
                  </div>

                  <div class=form-group'>
                   <label>Zipcode</label>
                    <input type='text' required class='form-control' name='zipcode' id='zipcode' value='".$row['zipcode']."' placeholder='Enter Zipcode'>
                  </div>
                  <div class=form-group'>
                   <label>State</label>
                    <input type='text' required class='form-control' name='state' id='state' value='".$row['state']."' placeholder='Enter State'>
                  </div>
                  <div class=form-group'>
                   <label>Street</label>
                    <input type='text' required class='form-control' name='street' id='street' value='".$row['street']."' placeholder='Enter Street'>
                  </div>

                  <div class=form-group'>
                   <label>Country</label>
                    <input type='text' required class='form-control' name='country' id='country' value='".$row['country']."' placeholder='Enter Country'>
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
                    <input type='text' required class='form-control' name='website' id='website' value='".$row['website']."' placeholder='Enter Website'>
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
                   <label>Job Title</label>
                    <input type='text' required class='form-control' name='jobtitle' id='jobtitle' value='".$row['jobtitle']."' placeholder='Enter Job Title'>
                  </div>
                  <div class=form-group'>
                   <label>Home Phone</label>
                    <input type='text' required class='form-control' name='homephone' id='homephone' value='".$row['home_phone']."' placeholder='Enter Home Phone'>
                  </div>
                  <div class=form-group'>
                   <label>Home Fax</label>
                    <input type='text' required class='form-control' name='homefax' id='homefax' value='".$row['home_fax']."' placeholder='Enter Home Fax'>
                  </div>
                  <div class=form-group'>
                   <label>Car Phone</label>
                    <input type='text' required class='form-control' name='carphone' id='carphone' value='".$row['car_phone']."' placeholder='Enter Car Phone'>
                  </div>
                  <div class=form-group'>
                   <label>Home Webpage</label>
                    <input type='text' required class='form-control' name='homewebpage' id='homewebpage' value='".$row['home_webpage']."' placeholder='Enter Home Webpage'>
                  </div>
                  <div class=form-group'>
                   <label>Pager</label>
                    <input type='text' required class='form-control' name='pager' id='pager' value='".$row['pager']."' placeholder='Enter Pager'>
                  </div>
                  <div class=form-group'>
                   <label>Notes</label>
                    <input type='text' required class='form-control' name='notes' id='notes' value='".$row['notes']."' placeholder='Enter Notes'>
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

    var x = $("input[name=tid]").val();

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
        url:"updateAgent.php",
        method: "POST",
        asynch: false,
        data:{id:x,company:a,name:b,email:c,city:d,zipcode:e,state:f,country:g,tourcountry:h,website:i,phone:j,fax:k,jobtitle:l,homephone:m,homefax:n,carphone:o,homewebpage:p,street:q,pager:r,notes:s},
        success:function(data){
          reloadPage(-12,0,0);
        }
      });
    
  }
</script>
