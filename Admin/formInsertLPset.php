<?php
include "../site.php";
include "../db=connection.php";

$queryg = "SELECT * FROM login_staff";
$rsg=mysqli_query($con,$queryg);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT SET START WORK</h3>
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
              <form role='form' method='post' action='insertPricePackage.php'>
                <div class='card-body'>
              <div class=form-group'>
              <label>Pilih Cabang</label>
              <select class='chosen' name='place' id='place'>
                  <option selected='selected' value=0>Pilihan</option>
                  <option value='Surabaya'>Surabaya</option>
                  <option value='Batam'>Batam</option>
            </select>
            </div>
                  <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                  <div class=form-group'>
                  <label>JAM MASUK</label>
                  <input type='time' class='form-control' name='tl' id='tl'>
                </div>
                  </div>";
                echo "</div>
                <div class='card-footer'>
                  <button type='button' class='btn btn-primary' onclick='insertPricelembur()'>Submit</button>
                </div>
              </form>
            </div>
            <div class=form-group' name='divjob' id='divjob'>
            <div class='container'>
            <table class='table table-sm'>
            <thead>
              <tr>
              <th scope='col'>#</th>
              <th scope='col'>Office</th>
              <th scope='col'>IN</th>
              <th scope='col'>OPTION</th>
              </tr>
            </thead>
            <tbody>";
            $querys = "SELECT * FROM Setin";
            $rss=mysqli_query($con,$querys);
            while($rows = mysqli_fetch_array($rss)){
              echo"<tr>
              <th scope='row'>".$rows['id']."</th>
              <td>".$rows['nama']."</td>
              <td>".$rows['jam']."</td>
              <td></td>
              </tr>";
            }
            echo"</tbody>
            </table>
            </div>
    </div>

              </div>
            </div>
          </div>
        </div>
        </div>";
?>

<script>
  function insertPricelembur(){
    var x = $("input[name=id]").val();
    var w = $("input[name=tl]").val();
    var t = document.getElementById("place").options[document.getElementById("place").selectedIndex].value;
   
    $.ajax({
        url:"insertSetin.php",
        method: "POST",
        asynch: false,
        data:{id:x,,tl:w,place:t},
        success:function(data){
        insertPage(21,0,0);
        }
      });
    
  }
</script>
