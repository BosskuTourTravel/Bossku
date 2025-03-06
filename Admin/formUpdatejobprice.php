<?php
include "../site.php";
include "../db=connection.php";

$queryjob = "SELECT * FROM jenisgaji WHERE id=".$_POST['id'];
$rsjob = mysqli_query($con,$queryjob);
$rowjob = mysqli_fetch_array($rsjob);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM UPDATE JOB PRICE </h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadsallary(2,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                    <label>Job Name</label>
                    <input type='text' class='form-control' name='nama_job' id='nama_job' value='".$rowjob['nama_job']."' placeholder='EnterJob Name'>

                    <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                    <input name='tid' id='tid' value='".$_POST['tid']."' type='hidden' >
                  </div>
                  <div class=form-group'>
                    <label>Price Package</label>
                    <input type='text' class='form-control' name='harga' id='harga' value='".$rowjob['harga']."' placeholder='Enter Price Job'>
                  </div>
                  </div>";


                  // <!-- <div class='form-group'>
                  //   <label for='exampleInputFile'>File input</label>
                  //   <div class='input-group'>
                  //     <div class='custom-file'>
                  //       <input name="uploaded" type="file" />
                  //     </div>
                      
                  //   </div>
                  // </div> -->
                  
                echo "</div>

                <div class='card-footer'>
                  <button type='button' class='btn btn-primary' id='but_upload' >Submit</button>
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



$("#but_upload").click(function(){
    var fd = new FormData();
    var a = $("input[name=nama_job]").val();
    var b = $("input[name=harga]").val();
    var x = $("input[name=id]").val();
    fd.append('nama_job',a);
    fd.append('harga',b);
    fd.append('id',x);


    $.ajax({
        url: 'updatejobprice.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
            alert(response);
          reloadsallary(2,0,0);
        },
    });
});
});
</script>
