<link href="dist/css/summernote/summernote.css" rel="stylesheet">
<script src="dist/css/summernote/summernote.js"></script>


<?php
include "../site.php";
include "../db=connection.php";

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT REQUIREMENTS & NOTES PASSPORT</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPassport(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                  <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                  <div class='form-group'>
                    <label>Passport Requirements</label>
                    <!-- <textarea class='form-control' name='idesc' id='idesc' placeholder='Enter Passport Requirements'> </textarea> -->
                    <textarea id='summernote' name='editordata'></textarea>
                  </div>
                  <div class='form-group'>
                    <label>Passport Notes</label>
                    <!-- <textarea class='form-control' name='rdesc' id='rdesc' placeholder='Enter Passport Notes'> </textarea> -->
                    <textarea id='summernote2' name='editordata2'></textarea>
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
    $('#summernote').summernote();
    $('#summernote2').summernote();

   
    $("#but_upload").click(function(){

        var fd = new FormData();
        var b = $("textarea[name=editordata]").val();
        var c = $("textarea[name=editordata2]").val();

        fd.append('requirements',b);
        fd.append('notes',c);

        $.ajax({
            url: 'insertPassportRequirementsNotes.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                alert("Success");
                reloadPassport(0,0,0);
              }
            },
        });
    });
});

</script>
