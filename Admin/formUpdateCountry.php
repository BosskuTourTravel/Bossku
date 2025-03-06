<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";

$querycontinent = "SELECT * FROM continent";
$rscontinent=mysqli_query($con,$querycontinent);

$querycountry = "SELECT * FROM country WHERE id=".$_POST['id'];
$rscountry = mysqli_query($con,$querycountry);
$rowcountry = mysqli_fetch_array($rscountry);

if($_SESSION['type']!=5){
  echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM UPDATE COUNTRY</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(-4,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
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
                    <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                    <label>Name</label>
                    <input type='text' class='form-control' name='name' id='name' value='".$rowcountry['name']."' placeholder='Enter Country Name'>
                  </div>

                  <div class='form-group'>
                    <label>Continent</label>
                    <select class='chosen' name='continent' id='continent'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcontinent = mysqli_fetch_array($rscontinent)){
                      if($rowcontinent['id']==$rowcountry['continent']){
                        echo "<option selected='selected' value=".$rowcontinent['id'].">".$rowcontinent['name']."</option>";
                      }else{
                        echo "<option value=".$rowcontinent['id'].">".$rowcontinent['name']."</option>";
                      }
                      
                    }
                   echo "</select>
                  </div>

                  <div class='form-group' hidden>
                    <label>Img</label>
                    <input type='text' class='form-control' name='img' id='img' value='".$rowcountry['img']."' placeholder='Enter Img'>
                  </div>

                  <div class='form-group' hidden>
                    <label>Img Head</label>
                    <input type='text' class='form-control' name='imghead' id='imghead' value='".$rowcountry['img_head']."' placeholder='Enter Img Head'>
                  </div>
                  <div class='form-group' hidden>
                    <label for='exampleInputFile'>File input</label>
                    <div class='input-group'>
                      <div class='custom-file'>
                        <input name='fileToUpload' id='fileToUpload' accept='image/*' type='file' />
                      </div>
                      
                    </div>
                  </div><div class='form-group' hidden>
                    <label for='exampleInputFile'>File input Img Head</label>
                    <div class='input-group'>
                      <div class='custom-file'>
                        <input name='fileToUpload2' id='fileToUpload2' accept='image/*' type='file' />
                      </div>
                      
                    </div>
                  </div>";
                  
                  
                echo "</div>

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
}else{
  echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM UPDATE COUNTRY</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(-4,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                    <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                    <label>Name</label>
                    <input type='text' class='form-control' name='name' id='name' value='".$rowcountry['name']."' placeholder='Enter Country Name' disabled>
                  </div>

                  <div class='form-group'>
                    <label>Img</label>
                    <input type='text' class='form-control' name='img' id='img' value='".$rowcountry['img']."' placeholder='Enter Img' disabled>
                  </div>

                  <div class='form-group' >
                    <label>Img Head</label>
                    <input type='text' class='form-control' name='imghead' id='imghead' value='".$rowcountry['img_head']."' placeholder='Enter Img Head' disabled>
                  </div>
                  <div class='form-group' >
                    <label for='exampleInputFile'>File input</label>
                    <div class='input-group'>
                      <div class='custom-file'>
                        <input name='fileToUpload' id='fileToUpload' accept='image/*' type='file' />
                      </div>
                      
                    </div>
                  </div><div class='form-group'>
                    <label for='exampleInputFile'>File input Img Head</label>
                    <div class='input-group'>
                      <div class='custom-file'>
                        <input name='fileToUpload2' id='fileToUpload2' accept='image/*' type='file' />
                      </div>
                      
                    </div>
                  </div>";
                  
                  
                echo "</div>

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
}

?>

<script>


  $(document).ready(function(){
    $(".chosen").chosen();
    $("#but_upload").click(function(){
        var fd = new FormData();
        var a = $("input[name=name]").val();
        var b = $("input[name=img]").val();
        var c = $("input[name=imghead]").val();
        var d = document.getElementById("continent").options[document.getElementById("continent").selectedIndex].value;
        var x = $("input[name=id]").val();
        var files = $('#fileToUpload')[0].files[0];
        var files2 = $('#fileToUpload2')[0].files[0];
        fd.append('name',a);
        fd.append('img',b);
        fd.append('img_head',c);
        fd.append('continent',d);
        fd.append('id',x);
        fd.append('fileToUpload',files);
        fd.append('fileToUpload2',files2);
        if($('#fileToUpload')[0].files.length<1 && $('#fileToUpload2')[0].files.length<1){
          fd.append('code',0);
        }else if($('#fileToUpload')[0].files.length<1 && $('#fileToUpload2')[0].files.length>0){
          fd.append('code',2);
        }else if($('#fileToUpload')[0].files.length>0 && $('#fileToUpload2')[0].files.length<1){
          fd.append('code',3);
        }else{
          fd.append('code',1);
        }
        $.ajax({
            url: 'updateCountry.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
            	alert(response);
              reloadPage(-4,0,0);
            },
        });
    });
});

</script>
