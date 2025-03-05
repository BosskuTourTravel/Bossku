<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<link href="dist/css/summernote/summernote.css" rel="stylesheet">
<script src="dist/css/summernote/summernote.js"></script>
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
                <h3 class='card-title'>FORM INSERT DEFAULT TERMS CONDITIONS</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadExclusion(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                   <label>Country</label>
                   <select class='chosen' name='country' id='country' style='width: 100%;'>
                   <option selected='selected' value=0>Pilihan</option>";

                   while($rowcountry = mysqli_fetch_array($rscountry)){
                      echo "<option value=".$rowcountry['id'].">".$rowcountry['name']."</option>";
                  }
                  echo"</select>
                  </div>

                  <div class='form-group'>
                    <label>Terms & Conditions Description</label>
                    <!-- <textarea class='form-control' name='tdesc' id='tdesc' placeholder='Enter Terms & Conditions Description'> </textarea> -->
                    <textarea id='summernote4' name='editordata4'></textarea>
                  </div>
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
   $('#summernote4').summernote();

   $("#but_upload").click(function(){
      var fd = new FormData();
      var a = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;
      var b = $("textarea[name=editordata4]").val();
      
      fd.append('terms',b);
      fd.append('country',a);

      $.ajax({
              url: 'insertTermsAndConditionsDefault.php',
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              success: function(response){
                if(response=="success"){
                  alert(response);
                  reloadExclusion(0,0,0);
                }else{
                  alert(response);
                }
                
              },
          });
      
      });
   });

  
</script>
