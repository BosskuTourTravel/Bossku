  <script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

session_start();

$querycontinent = "SELECT * FROM continent";
$rscontinent=mysqli_query($con,$querycontinent);

$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);

$querycity = "SELECT * FROM city";
$rscity=mysqli_query($con,$querycity);


$query_continent = "SELECT * FROM continent_explore WHERE id=".$_POST['id'];
$rs_continent=mysqli_query($con,$query_continent);
$row_continent=mysqli_fetch_array($rs_continent);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT CONTINENT EXPLORE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadContinent(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body'>


              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>";
                  
                  echo "<input type='text' class='form-control' name='tid' id='tid' value='".$_POST['id']."' hidden>
                  <div class=form-group'>
                    <label>Continent</label></br>
                    <select class='chosen' name='continent' id='continent'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcontinent=mysqli_fetch_array($rscontinent)){
                      if($rowcontinent['id']==$row_continent['continent']){
                          echo "<option selected='selected' value=".$rowcontinent['id'].">".$rowcontinent['name']."</option>";
                        }else{
                          echo "<option value=".$rowcontinent['id'].">".$rowcontinent['name']."</option>";
                        }
                      }
                    
                   echo "</select>
                  </div></br>
                  <div class='form-group'>
                    <label>Title</label>
                    <input type='text' class='form-control' name='title' id='title' value='".$row_continent['title']."' placeholder='Enter Title'>
                  </div>
                  <div class='form-group'>
                    <label>Description</label>
                    <textarea class='form-control' name='desc' id='desc' placeholder='Enter Description'>".$row_continent['description']."</textarea>
                  </div>
                  <div class=form-group'>
                    <label>Country</label></br>
                    <select class='chosen' name='country' id='country'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcountry=mysqli_fetch_array($rscountry)){
                      if($rowcountry['name']==$row_continent['country']){
                          echo "<option selected='selected' value=".$rowcountry['name'].">".$rowcountry['name']."</option>";
                        }else{
                          echo "<option value=".$rowcountry['name'].">".$rowcountry['name']."</option>";
                        }
                      }
                    
                   echo "</select>
                  </div></br>

                   <div class=form-group'>
                   <label>City</label></br>
                   <select class='chosen' name='city' id='city'>
                   <option selected='selected' value=0>Pilihan</option>";

                      while($rowcity = mysqli_fetch_array($rscity)){
                        if($rowcity['name']==$row_continent['city']){
                          echo "<option selected='selected' value=".$rowcity['name'].">".$rowcity['name']."</option>";
                        }else{
                          echo "<option value=".$rowcity['name'].">".$rowcity['name']."</option>";
                        }
                      }
                    
                    echo "</select>
                  </div>";
                      
                       
                  
                echo "

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


    $("#but_upload").click(function(){
        var fd = new FormData();
        var a = $("input[name=title]").val();
        var b = $("textarea[name=desc]").val();
        var c = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;
        var d = document.getElementById("city").options[document.getElementById("city").selectedIndex].value;
        var e = document.getElementById("continent").options[document.getElementById("continent").selectedIndex].value;
        var x = $("input[name=tid]").val();
      
        fd.append('title',a);
        fd.append('desc',b);
        fd.append('country',c);
        fd.append('city',d);
        fd.append('continent',e);
        fd.append('id',x);
        $.ajax({
            url: 'updateContinentExplore.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                alert(response);
                reloadContinent(0,0,0);
              }else{
                alert(response);
              }
              
            },
        });
    });
});

</script>
