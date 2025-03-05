<?php
include "../site.php";
include "../db=connection.php";
$queryjob = "SELECT * FROM jobdesk WHERE id=".$_POST['id'];
$rsjob = mysqli_query($con,$queryjob);
$rowjob = mysqli_fetch_array($rsjob);
$datajob=explode(',', $rowjob['job']);

$query2 = "SELECT * FROM login_staff";
$rs2=mysqli_query($con,$query2);

$query= "SELECT * FROM jenisgaji";
$rs=mysqli_query($con,$query);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM JOB DESC</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadsallary(3,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='insertPricePackage.php'>
                <div class='card-body'>
                  <div class=form-group'>
                  <label>Staff</label>
                  <input type='text' name='tid' id='tid' value='".$_POST['id']."' hidden>
                  <select class='form-control select' required name='nama' id='nama'  value='".$rowjob['nama_job']."' style='width: 100%;'>
                  <option selected='selected' value=0>Pilihan</option>";
                  while($rowstaff=mysqli_fetch_array($rs2)){
                    if($rowstaff['id']==$rowjob['nama']){
                        echo "<option selected='selected' value=".$rowstaff['id'].">".$rowstaff['name']."</option>";
                      }else{
                        echo "<option value=".$rowstaff['id'].">".$rowstaff['name']."</option>";
                      }
                    }
                  echo"</select>
                </div>
                    <div class='form-group'>
                      <label>Job Name</label>";

                          while($row=mysqli_fetch_array($rs)){
                            if (in_array($row['id'], $datajob)){
                              echo"<div class='row ml-4'>
                              <input class='form-check-input' type='checkbox' name='job".$row['id']."' value='".$row['id']."'checked>".$row['nama_job']."</option>
                              <th scope='col'>(harga Rp.".number_format($row['harga'], 0, ".", ".").")</th>
                              </div>";
                            }else{
                              
                              echo"
                              <div class='row ml-4'>
                              <input class='form-check-input' type='checkbox' name='job".$row['id']."' value='".$row['id']."' >".$row['nama_job']."</option>
                              <th scope='col'>(harga Rp.".number_format($row['harga'], 0, ".", ".").")</th>
                              </div>";
                            }
                          }
                      echo"
                      <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                      
                    </div>";

                echo "</div>


                <div class='card-footer'>
                  <button type='button' class='btn btn-primary' onclick='insertjob()'>Submit</button>
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
  function insertjob(){
    var job = [];
				$(".form-check-input").each(function(){
					if($(this).is(":checked"))
					{
						job.push($(this).val());
					}
				});
				job = job.toString();
    var x = $("input[name=id]").val();
    var y = document.getElementById("nama").options[document.getElementById("nama").selectedIndex].value;

   
    $.ajax({
        url:"Updatejobdesk.php",
        method: "POST",
        asynch: false,
        data:{id:x,nama:y,job:job,},
        success:function(data){
          reloadsallary(3,x,0);
        }
      });
    
  }
</script>
