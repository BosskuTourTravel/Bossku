<link href="dist/css/summernote/summernote.css" rel="stylesheet">
<script src="dist/css/summernote/summernote.js"></script>


<?php
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM remark WHERE id=".$_POST['id'];
$rs=mysqli_query($con,$query);
$row = mysqli_fetch_array($rs);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>UPDATE REMARKS PACKAGE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(-8,".$_POST['tid'].",0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                    <input name='id' id='tid' value='".$_POST['id']."' type='hidden' >
                    <input name='tid' id='tid' value='".$_POST['tid']."' type='hidden' >
                    <label>Description</label>
                    <!-- <textarea class='form-control' name='desc' id='desc' value='".$row['description']."' placeholder='Enter Description'>".$row['description']."</textarea> -->
                    <textarea id='summernote' name='editordata' placeholder='Enter Description'>".$row['description']."</textarea>
                  </div> ";
                  
                  
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
?>

<script>


  $(document).ready(function(){
    $('#summernote').summernote();

    $("#but_upload").click(function(){

        var fd = new FormData();
        var a = $("input[name=id]").val();
        var b = $("textarea[name=editordata]").val();
        fd.append('id',a);
        fd.append('name',b);

        var x = $("input[name=tid]").val();
        $.ajax({
          url: 'updateRemarks.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
            if(response=="success"){
                reloadPage(-8,x,0);
            }
          },
        });
        
       
    });
});

</script>
