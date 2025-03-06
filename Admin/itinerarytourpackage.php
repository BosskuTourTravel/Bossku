<?php
include "../site.php";
include "../db=connection.php";
session_start();
$querytour = "SELECT * FROM tour_package WHERE id = ".$_POST['id'];
$rstour=mysqli_query($con,$querytour);
$rowtour = mysqli_fetch_array($rstour);
$query = "SELECT * FROM tour_package WHERE id = ".$_GET['id_package'];
$rs=mysqli_query($con,$query);
$row = mysqli_fetch_array($rs);


echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>Itinerary : ".$rowtour['tour_name']."</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 500px;'>
                 
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>";
                      if($_SESSION['type']==1 or $_SESSION['staff']=="Antonio Chandra"){
                        echo "<button type='submit' onclick='insertTemp(0,".$_POST['id'].",0)' class='btn btn-primary'><i class='fa fa-plus'></i></button>";
                      }
                      
                     echo "<button type='submit' onclick='insertPage(2,".$_POST['id'].",0)' class='btn btn-default'><i class='fa fa-plus'></i></button>
                      <button type='submit' onclick='reloadPage(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                      
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              </br>
              <div>";
               	  // echo "<button type='submit' onclick='reloadPage(-6,".$_POST['id'].",0)' class='btn btn-primary'>Inclusion</button>
                  // <button type='submit' onclick='reloadPage(-7,".$_POST['id'].",0)' class='btn btn-primary'>Exclusion</button>
                  // <button type='submit' onclick='reloadPage(-8,".$_POST['id'].",0)' class='btn btn-primary'>Remark</button>
                  // <button type='submit' onclick='reloadPage(-9,".$_POST['id'].",0)' class='btn btn-primary'>Terms & Condition</button>";
                  echo "<button type='submit' onclick='insertPage(9,".$_POST['id'].",0)' class='btn btn-primary'>Insert All<i class='fa fa-star'></i></button>
                  <button type='submit' onclick='editPage(-10,".$_POST['id'].",0)' class='btn btn-warning'>Edit All<i class='fa fa-star'></i></button>
              </div>
              </br>
              <div class='card-body table-responsive p-0'>";
        

                $query = "SELECT * FROM itinerary WHERE tour_package=".$_POST['id']." ORDER BY day ASC";
                $rs=mysqli_query($con,$query);
                


                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                <th>Day</th>
                <th>Time Category</th>
                <th>Judul Route</th>
                <th>Description Route</th>
                <th>Img</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysqli_fetch_array($rs)){
                  
                  echo"
                  <tr style='font-weight:bold;'>
                  <td>".$row['day']."</td>";
                  if($row['day']==1){
                    $query_category = "SELECT * FROM itinerary_category_arrival WHERE id=".$row['itinerary_category_arrival'];
                    $rs_category=mysqli_query($con,$query_category);
                    $row_category = mysqli_fetch_array($rs_category);
                    echo "<td>".$row_category['name']."</br>( ".$row_category['time']." )</td>";
                  }elseif($row['day']==$rowtour['duration_tour']){
                    $query_category = "SELECT * FROM itinerary_category_departure WHERE id=".$row['itinerary_category_departure'];
                    $rs_category=mysqli_query($con,$query_category);
                    $row_category = mysqli_fetch_array($rs_category);
                    echo "<td>".$row_category['name']."</br>( ".$row_category['time']." )</td>";
                  }else{
                    echo "<td>-</td>";
                  }
                  
                  
                  echo "<td>".$row['name']."</td>
                  <td>".$row['description']."</td>
                  <td>".$row['img']."</td>

                  <td>
                  <button type='submit' onclick='editPage(2,".$row['id'].",".$_POST['id'].",0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='delItinerary(".$row['id'].",".$_POST['id'].")' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button>
                  </td>
                  </tr>
                  <tr>";
                }

                echo "
                </tbody>
                </table>

                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
</div>";
?>
<div class="box-border" style='text-align: center !important'>
<a href=javascript: class=print><i class="fa fa-print"></i> Print This</a></div>

<script>
  $('.print').click(function(){
      window.open("https://www.2canholiday.com/printitinerary.php?id=<?php echo $_GET['id']?>&id_package=<?php echo $_GET['id_package']?>","Print","menubar=no,toolbar=no,resizable=yes,scrollbars=yes");
    });

  function delItinerary(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
      $.ajax({
        url:"delItinerary.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadPage(1,y,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
   
  }
</script>