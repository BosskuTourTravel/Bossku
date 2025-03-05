<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

$querytourtype = "SELECT * FROM agent";
$rstourtype=mysqli_query($con,$querytourtype);

$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);


echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM UPLOAD FILES</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(-10,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                    <label>Agent</label>
                    <select class='chosen' name='agent' id='agent' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowtourtype = mysqli_fetch_array($rstourtype)){
                      echo "<option value='".$rowtourtype['id']."'>".$rowtourtype['company']." ( ".$rowtourtype['email']." )</option>";
                    }
                    echo"</select>
                  </div>
                  </br>
                  <div class=form-group'>
                    <label>Agent Scope</label>
                    <select name='countryA_count' id='countryA_count'>
                    <option selected='selected' value=0>Jumlah Country</option>";

                    for ($x = 1; $x <= 20; $x++){
                      echo "<option value=".$x.">".$x."</option>";
                    }
                   echo "</select></div>
                   <div class=form-group' name='divcountryA' id='divcountryA'></div>
                   </br>
                  <div class=form-group'>
                    <label>Tour Country</label>
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
                   <div class=form-group' name='divcountry' id='divcountry'>
                   </div>
                  </br>
                  
                 
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

    $('#agent').on('change', function() {
      var count = this.value;
      $.ajax({
          type:'POST',
          url:'cekTourCountry.php',
          data:{'id':count},
          success:function(data){
           if(data==0){
            $("#countryA_count").attr('disabled', true);
           }else{
            $("#countryA_count").removeAttr('disabled');
           }
         }
       });
    });

    $('#countryA_count').on('change', function() {
        var count = this.value;
        $.ajax({
          type:'POST',
          url:'getCountryCount2.php',
          data:{'count':count},
          success:function(data){
           $('#divcountryA').html(data);
         }
       });
    });
    $("#but_upload").click(function(){
        var fd = new FormData();
     
        var a = document.getElementById("agent").options[document.getElementById("agent").selectedIndex].value;
        var h = "";
        for (var i = 1; i <= $("#countryA_count").val(); i++) {
          if(i==1){
            h = h + $("#countryA"+i).val();
          }
          else{
            h = h + ";" + $("#countryA"+i).val();
          }
        }

        var files = $('#fileToUpload')[0].files[0];
        fd.append('fileToUpload',files);
        fd.append('agent',a);
        fd.append('countryA',h);

        if($('#fileToUpload')[0].files.length<1){
          fd.append('code',0);
        }else{
          fd.append('code',1);
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
            url: 'uploadAgent.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
            	if(response=="success"){
                alert(response);
            		reloadPage(-10,0,0);
            	}
              
            },
        });
     });
});

</script>
