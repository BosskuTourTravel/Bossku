<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";
session_start();
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>HOTEL QUOTATION</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>

                      <button type='submit' onclick='insertPage(25,0,0)' class='btn btn-default'><i class='fa fa-plus'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0' style='font-size:14px; align:center;'>";
              echo"
                <div class='container'>
                    <div class='form-row'>
                             <div class='col-1'>
                             <div class='card-body'>
                             <label>Pilih Landtour</label>
                         </div>
                             </div>
                             <div class='col-11'>
                                <div class='card border-primary mb-3'>
                                     <div class='card-body'>
                                     <table class='table table-sm'>
                                     <thead>
                                       <tr>
                                         <th scope='col'>#</th>
                                         <th scope='col'>Tour Code</th>
                                         <th scope='col'>Tour Category</th>
                                         <th scope='col'>Tour Name</th>
                                         <th scope='col'>staff</th>
                                       </tr>
                                     </thead>
                                     <tbody>";
                                     $query = "SELECT * FROM tour_package ORDER BY category ASC";
                                     $rs=mysqli_query($con,$query);
                                     $n=1;
                                     while($row = mysqli_fetch_array($rs)){
                                      $querystaff = "SELECT * FROM login_staff WHERE id=".$row['staff'];
                                      $rsstaff=mysqli_query($con,$querystaff);
                                      $rowstaff = mysqli_fetch_array($rsstaff);
                                      if( $n==1){
                                        echo"<tr bgcolor='#DCDCDC'>
                                        <th scope='row'>
                                        </th>
                                        <td colspan='4' align='center'><b>Tour Category : &nbsp; ".$row['category']."</b></td>
                                      </tr>";
                                      }
                                      $querytr = "SELECT * FROM transquo where tour_pack=".$row['id'];
                                      $rstr=mysqli_query($con,$querytr);
                                      $rowtr = mysqli_fetch_array($rstr);
                                      $trquo=$rowtr['tour_pack'];

                                      $queryhq = "SELECT * FROM hotelquo where tour_pack=".$row['id'];
                                      $rshq=mysqli_query($con,$queryhq);
                                      $rowhq = mysqli_fetch_array($rshq);
                                      $hq=$rowhq['tour_pack'];
                                      $id=$row['id'];
                                      //var_dump($hq);
                                      if($trquo==NULL){
                                       echo"<tr>
                                         <th scope='row'>
                                         <div class='form-check'>
                                         <input class='form-check-input position-static' type='checkbox'  name='tour' id='".$row['id']."' onclick='total()' value='".$row['id'].",".$row['duration_tour'].",".$row['kurs']."'>
                                         </div>
                                         </th>
                                         <td>888".$row['id']."</td>
                                         <td>".$row['category']."</td>
                                         <td>".$row['tour_name']."</td>
                                         <td>".$rowstaff['name']."</td>
                                       </tr>";
                                      }
                                      // else if($hq==$id){
                                      //   echo"<tr bgcolor='#0000FF'>
                                      //   <th scope='row'>
                                      //   <div class='form-check'>
                                      //   <input class='form-check-input position-static' type='checkbox'  name='tour' id='".$row['id']."' onclick='total()' value='".$row['id'].",".$row['duration_tour'].",".$row['kurs']."'>
                                      //   </div>
                                      //   </th>
                                      //   <td>888".$row['id']."</td>
                                      //   <td>".$row['category']."</td>
                                      //   <td>".$row['tour_name']."</td>
                                      //   <td>".$rowstaff['name']."</td>
                                      // </tr>";
                                      // }
                                      else{
                                        echo"<tr bgcolor='#FFFF00'>
                                        <th scope='row'>
                                        <div class='form-check'>
                                        <input class='form-check-input position-static' type='checkbox'  name='tour' id='".$row['id']."' onclick='total()' value='".$row['id'].",".$row['duration_tour'].",".$row['kurs']."'>
                                        </div>
                                        </th>
                                        <td>888".$row['id']."</td>
                                        <td>".$row['category']."</td>
                                        <td>".$row['tour_name']."</td>
                                        <td>".$rowstaff['name']."</td>
                                      </tr>";
                                      }

                                       $queryxx="SELECT category, COUNT(category) AS count FROM tour_package GROUP BY category HAVING COUNT(category) > 1";
                                       $rsxx=mysqli_query($con,$queryxx);
                                       $y=0;
                                       while($rowxx = mysqli_fetch_array($rsxx)){
                                         
                                      if($rowxx['category']==$row['category'] && $y+$rowxx['count']==$n){
                                        echo"<tr bgcolor='#DCDCDC'>
                                        <th scope='row'>
                                        </th>
                                        <td colspan='4' align='center'><b>Tour Category : &nbsp; ".$row['category']."&nbsp;|&nbsp; jumlah &nbsp; ".$rowxx['count']."</b></td>
                                      </tr>";

                                      }
                                      $y=$y+$rowxx['count'];
                                     // echo $y;
                                      }
                                      $n=$n+1;
                                      }

                                     echo"</tbody>
                                   </table>";
                                    echo"</div>
                                </div>
                             </div>
                         </div>
                    </div>
                    <div class='form-row'>
                    <div class='col-1'>
                        <div class='card-body'>
                            <label>Total Hari</label>
                        </div>
                    </div>
                    <div class='col-11'>
                        <div class='card border-primary mb-3'>
                            <div class='card-body'>
                                    <div class='form-row'>
                                            <div class='col-sm-2 my-1'>
                                                    <input type='text' class='form-control' id='thari' name='thari' style='width:100px;'>
                                            </div>
                                    </div>
                                    <div class=form-group' name='divjobi' id='divjobi'></div>
                            </div>
                        </div>
                    </div>
                   </div>
                   <div class='form-row'>
                   <div class='col-1'>
                       <div class='card-body'>
                           <label></label>
                       </div>
                   </div>
                   <div class='col-11'>
                       <div class='card border-primary mb-3'>
                           <div class='card-body'>
                                   <div class='form-row'>
                                           <div class='col-sm-2 my-1'>

                                           </div>
                                   </div>
                                   <div class=form-group' name='divjobi2' id='divjobi2'></div>
                           </div>
                       </div>
                   </div>
                  </div>
                </div>";
                echo"
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
</div>";
?>

<script>
 $(document).ready(function(){
    $(".chosen").chosen();
  });
function total() {
  var input = document.getElementsByName("tour");
  var total ="";
  //var subtotal ="";
  for (var i = 0; i < input.length; i++) {
          if (input[i].checked) {
            if(total==""){
                      total = total + input[i].value;
            }
            else{
                 total = total + ";"+ input[i].value;
            }
          }
  }
  var strtotal = total.split(";");
  var strtotal2=[];
  var subtotal=0;
  for(var i = 0; i < strtotal.length; i++){
          strtotal2[i] = strtotal[i].split(",");
          d = Number(strtotal2[i][1]);
          subtotal= subtotal + d ;
        }
   var n = subtotal-1;
   document.getElementById("thari").value =  subtotal + "D" + n + "N";
  // //document.getElementById("thari2").value =  total.toFixed();
   var count = subtotal;
//   alert(total);
        $.ajax({
          type:'POST',
          url:'trans_count.php',
          data:{'count':count,'total':total},
          success:function(data){
           $('#divjobi').html(data);
         }
       });

}

</script>