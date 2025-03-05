<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

$querytourtype2 = "SELECT * FROM agent_files WHERE id=".$_POST['id'];
$rstourtype2=mysqli_query($con,$querytourtype2);
$rowtourtype2 = mysqli_fetch_array($rstourtype2);

$tempCity = preg_split ("/[;]+/", $rowtourtype2['city']);
$tempCityCount = preg_split ("/[;]+/", $rowtourtype2['city_count']);
$tempCountry = preg_split ("/[;]+/", $rowtourtype2['country']);
$tempString = "";
$tempString2 = ""; 

// echo "<script>alert(".$_POST['id'].");</script>";

$querytourtype = "SELECT * FROM agent";
$rstourtype=mysqli_query($con,$querytourtype);


echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>UPDATE FORM LAND TOUR FILES</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(-11,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>


              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>
                 
                  <div class='form-group'>
                    <input name='tid' id='tid' value='".$_POST['id']."' type='hidden' >
                    <input name='tagent' id='tagent' value='".$rowtourtype2['agent']."' type='hidden' >
                    <label>Agent</label>
                    <select class='chosen' name='agent' id='agent' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowtourtype = mysqli_fetch_array($rstourtype)){
                      if($rowtourtype2['agent']==$rowtourtype['id']){
                        echo "<option selected value='".$rowtourtype['id']."'>".$rowtourtype['company']."</option>";
                      }else{
                        echo "<option value='".$rowtourtype['id']."'>".$rowtourtype['company']."</option>";
                      }
                      
                    }
                    echo"</select>";


                    //countrylandtour
                    echo "<div class=form-group'>
                    <label>Country</label>
                    <select name='country_count' id='country_count'>
                    <option selected='selected' value=0>Jumlah Country</option>";

                    for ($x = 1; $x <= 20; $x++){
                      if($x==count($tempCountry)){
                        echo "<option selected='selected' value=".$x.">".$x."</option>";
                      }else{
                        echo "<option value=".$x.">".$x."</option>";
                      }
                      
                    }
                   echo "</select></div>
                   <div class=form-group' name='divcountry' id='divcountry'>";
                   $countTemp = 0;
                   for ($x = 1; $x <= count($tempCountry); $x++){
                    $cekTemp = $x - 1;
                    $querycity = "SELECT * FROM country";
                    $rscity=mysqli_query($con,$querycity);
                    echo"<div class=form-group' style='margin-bottom:10px;'>
                    <label>Country ".$x."</label>
                    <select class='chosen' name='country".$x."' id='country".$x."' style='width: 100%;' onchange=getCity(".$x.")>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcity = mysqli_fetch_array($rscity)){
                      if($rowcity['id']==$tempCountry[$cekTemp]){
                        echo "<option selected='selected' value=".$rowcity['id'].">".$rowcity['name']."</option>";
                      }else{
                        echo "<option value=".$rowcity['id'].">".$rowcity['name']."</option>";
                      }
                      
                    }
                    echo"</select></div>
                    <div class=form-group'>
                    <label>City ".$x."</label>
                    <select name='city_count".$x."' id='city_count".$x."' onchange=getCity(".$x.")>
                    <option selected='selected' value=0>Jumlah City</option>";

                    for ($y = 1; $y <= 20; $y++){
                      if($y==$tempCityCount[$cekTemp]){
                        echo "<option selected='selected' value=".$y.">".$y."</option>";
                      }else{
                        echo "<option value=".$y.">".$y."</option>";
                      }
                      
                    }
                    echo "</select></div>
                    <div class=form-group' name='divcity".$x."' id='divcity".$x."'>";
                    echo"<div class=form-group' style='margin-bottom:10px;'>";
                    for ($y2 = 1; $y2 <= $tempCityCount[$cekTemp]; $y2++){

                    $cekTemp2 = $y2-1;
                    
                    $querycity = "SELECT * FROM city WHERE country=".$tempCountry[$cekTemp];
                    $rscity=mysqli_query($con,$querycity);
                    
                    echo "<select class='chosen' name='city".$x.$y2."' id='city".$x.$y2."' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcity = mysqli_fetch_array($rscity)){
                      if($rowcity['id']==$tempCity[$countTemp]){
                        echo "<option selected='selected' value=".$rowcity['id'].">".$rowcity['name']."</option>";
                      }else{
                        echo "<option value=".$rowcity['id'].">".$rowcity['name']."</option>";
                      }
                      
                    }
                    echo"</select>";
                    $countTemp = $countTemp + 1;
                  }

                    echo "</div>";
                    

                  }

                   echo "</div></div>";

                    //end



                    echo "</br>


                  <div class='form-group'>
                    <label>Files</label>
                    <input type='text' class='form-control' name='img' id='img' value='".$rowtourtype2['location']."' placeholder='Enter Img'>
                  </div>
                 
                  <div class='form-group'>
                    <label for='exampleInputFile'>File input</label>
                    <div class='input-group'>
                      <div class='custom-file'>
                        <input name='fileToUpload' id='fileToUpload' accept='*' type='file' />
                      </div>
                  </div></div>

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
    $("#agent").val($("#tagent").val());
    $('#country_count').on('change', function() {
        var count = this.value;
        $.ajax({
          type:'POST',
          url:'country_count.php',
          data:{'count':count},
          success:function(data){
           $('#divcountry').html(data);
         }
       });
      });
    $("#but_upload").click(function(){
        var fd = new FormData();
        var y = $("#tid").val();
        var a = document.getElementById("agent").options[document.getElementById("agent").selectedIndex].value;
        var files = $('#fileToUpload')[0].files[0];
        fd.append('fileToUpload',files);
        fd.append('agent',a);
        fd.append('tid',y);

        if($('#fileToUpload')[0].files.length<1){
          fd.append('code',0);
          var b = $("#img").val();
          fd.append('img',b);
        }else{
          fd.append('code',1);
           var b = $("#img").val();
          fd.append('img',b);
        }

        //country landtour
        var sh = "";
        for (var i = 1; i <= $("#country_count").val(); i++) {
          if(i==1){
            sh = sh + $("#country"+i).val();
          }
          else{
            sh = sh + ";" + $("#country"+i).val();
          }
        }
        var x = "";
        var l = "";
        for (var j = 1; j <= $("#country_count").val(); j++) {
          if(j==1){
            l = l + $("#city_count"+j).val();
          }else{
            l = l + ";" + $("#city_count"+j).val();
          }

          for (var i = 1; i <= $("#city_count"+j).val(); i++) {
              if(j==1 && i==1){
                x = x + $("#city"+j+i).val();
              }
              else{
                x = x + ";" + $("#city"+j+i).val();
              }
            }
        }
        fd.append('country',sh);
        fd.append('city',x);
        fd.append('city_count',l);
        //end
        $.ajax({
          url: 'updateAgentFiles.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
           if(response=="success"){
            alert(response);
            reloadPage(-11,0,0);
          }

        },
      });
    });
});

</script>
