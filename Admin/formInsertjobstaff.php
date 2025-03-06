  <script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";

$query2 = "SELECT * FROM login_staff";
$rs2=mysqli_query($con,$query2);


  echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INPUT JOBS</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadsallary(1,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
   
                    <label>STAFF</label>
                      <select class='chosen' name='staff' id='staff'>
                          <option selected='selected' value=0>Pilihan</option>";

                          while($row2 = mysqli_fetch_array($rs2)){
                            echo "<option value=".$row2['id'].">".$row2['name']."</option>";
                          }
                        echo"
                    </select>
                  </div>                         
                  </div>";              
                  
                  echo "
                  <div class='form-groups'>
                      <label>Gaji Pokok</label>
                      <input type='textbox' required class='form-control' name='gaji' id='gaji' placeholder='Ketikkan Jumlah Gaji disini (tanpa titik koma)'></input>";   

                  echo "</div>
                  <div class='form-groups'>
                      <label>Tunjangan BPJS</label>
                      <input type='textbox' required class='form-control' name='bpjs' id='bpjs' placeholder='Ketikkan Jumlah Tunjangan disini (tanpa titik koma)'></input>               
                  </div>";
                  echo"  
                    <div class='form-groups'>
                        <label>Tanggal Gajian</label>
                        <select class='form-control' name='gj' id='gj'>";
                        for ($y = 1; $y <= 31; $y++ ){
                        echo"<option value='".$y."'>".$y."</option>";
                        }
                        echo"                       
                        </select>             
                    </div>";  

                  echo"<div class='card-footer'>
                  <button type='button' name='klik' class='btn btn-primary my-3' id='klik'>Tambah</button>
                  </div>
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




	
			$("#klik").click(function() {
        var b = document.getElementById("staff").options[document.getElementById("staff").selectedIndex].value;
        var d = $("input[name=gaji]").val();
        var e = $("input[name=bpjs]").val();
        var f = document.getElementById("gj").options[document.getElementById("gj").selectedIndex].value;
				$.ajax({
					url:"insertjobstaff.php",
					method:"POST",
					data:{gaji:d,bpjs:e,staff:b,gj:f},
					success:function(data){
            reloadsallary(1,0,0);
					}
				})
			})

</script>