<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

$queryjob = "SELECT * FROM login_staff";
$rsjob=mysqli_query($con,$queryjob);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>INPUT JOB DESCRIPTION STAFF</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadsallary(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>


              <div class='card card-primary' style='height:700px;'>
              
              <!-- /.card-header -->
                <div class='card-body'>
                 <div class='form-group' >
                    <div class='form-group'>
                        <label>Staff</label>
                           <select class='form-control' name='staff' id='staff'>
                              <option value=''> Pilih Staff</option>";
                              while($rowjob = mysqli_fetch_array($rsjob)){
                                echo "<option value='".$rowjob['id']."'>".$rowjob['name']."</option>";
                              }
                          echo"</select>
                    </div>
                    <div class='form-group'>
                        <label>JOB</label>
                            <select class='form-control' name='job' id='job'>
                                <option value=''> Pilih JOB</option>
                            </select>
                    </div>
                    <div class=form-group'>
                        <label>Jumlah job Item</label>
                            <select name='jobitem' id='jobitem'>
                                <option selected='selected' value=0>Pilih</option>";

                                    for ($x = 1; $x <= 20; $x++){
                                      echo "<option value=".$x.">".$x."</option>";
                                    }
                      echo "</select></div>
                   <div class=form-group' name='divjobi' id='divjobi'></div>
               </div>
                    <button type='button' class='btn btn-primary' id='but_upload'>Submit</button>";
              echo" 
            </div>        
              </div>
            </div>
          </div>
        </div>
</div>";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

$("#staff").change(function(){
            // variabel dari nilai combo box kendaraan
            var staff = $("#staff").val();
            // Menggunakan ajax untuk mengirim dan dan menerima data dari server
            $.ajax({
                type: 'POST',
                url: 'getJob.php',
                data: {'staff':staff},
                success: function(data){
                   $("#job").html(data);
                }
            });
        });
        
        $('#jobitem').on('change', function() {
        var count = this.value;
        $.ajax({
          type:'POST',
          url:'job_count.php',
          data:{'count':count},
          success:function(data){
           $('#divjobi').html(data);
         }
       });
      });
$(document).ready(function(){

    $("#but_upload").click(function(){
        var fd = new FormData();
        var a = document.getElementById("staff").options[document.getElementById("staff").selectedIndex].value;
        var b = document.getElementById("job").options[document.getElementById("job").selectedIndex].value;
        var c = document.getElementById("jobitem").options[document.getElementById("jobitem").selectedIndex].value;
        var h = "";
        var z = "";
        for (var i = 1; i <= $("#jobitem").val(); i++) {
          if(i==1){
            h = h + $("#keterangan"+i).val();
            z = z + $("#fileToUpload"+i).val();
          }
          else{
            h = h + ";" + $("#keterangan"+i).val();
            z = z + ";" + $("#fileToUpload"+i).val();
          }
        }
     alert(z);
        fd.append('staff',a);
        fd.append('keterangan',h);
        fd.append('job',b);
        fd.append('jobitem',c);
        data.append('fileToUpload',z[0].files[0]);

        $.ajax({
            url: 'insertSallary3.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                alert(response);
                reloadsallary(5,0,0);
              }else{
                alert(response);
              }
              
            },
        });
    });
});

       // $("#merk").change(function(){
            // variabel dari nilai combo box merk
         //   var id_merk = $("#merk").val();

            // Menggunakan ajax untuk mengirim dan dan menerima data dari server
           // $.ajax({
             //   type: "POST",
               /// dataType: "html",
                //url: "ambil-data.php",
               // data: "merk="+id_merk,
               // success: function(data){
                 //   $("#tipe").html(data);
               // }
            //});
        //});
</script>
