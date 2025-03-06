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
                <h3 class='card-title' style='font-weight:bold;'>TRANSPORT QUOTATION</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>

                      <button type='submit' onclick='insertPage(14,0,0)' class='btn btn-default'><i class='fa fa-plus'></i></button>
                      <button type='submit' onclick='reloadsallary(1,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0' style='font-size:14px; align:center;'>";
              echo"
                <div class='container'>
                    <div class='form-row'>
                             <div class='col-3'>
                             <div class='card-body'>
                             <label>Pilih Landtour</label>
                         </div>
                             </div>
                             <div class='col-9'>
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
                                       echo"<tr>
                                         <th scope='row'>
                                         <div class='form-check'>
                                         <input class='form-check-input position-static' type='checkbox'  name='tour' id='".$row['id']."' onclick='total()' value='".$row['duration_tour']."'>
                                         </div>
                                         </th>
                                         <td>888".$row['id']."</td>
                                         <td>".$row['category']."</td>
                                         <td>".$row['tour_name']."</td>
                                         <td>".$rowstaff['name']."</td>
                                       </tr>";
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
                    <div class='col-3'>
                        <div class='card-body'>
                            <label>Total Hari</label>
                        </div>
                    </div>
                    <div class='col-9'>
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
                    <div class='col-3'>
                        <div class='card-body'>
                            <label>Transport </label>
                        </div>
                    </div>
                    <div class='col-9'>
                        <div class='card border-primary mb-3'>
                            <div class='card-body'>
                                    <div class='form-row'>";
                                            $queryAgent = "SELECT DISTINCT agent FROM transport";
                                            $rsAgent=mysqli_query($con,$queryAgent);
                                            $querytp = "SELECT DISTINCT  continent FROM transport";
                                            $rstp=mysqli_query($con,$querytp);
                                            $querycon = "SELECT DISTINCT  contry FROM transport";
                                            $rscon=mysqli_query($con,$querycon);
                                            $querycity = "SELECT DISTINCT  city FROM transport";
                                            $rscity=mysqli_query($con,$querycity);
                                            $queryper = "SELECT DISTINCT  periode FROM transport";
                                            $rsper=mysqli_query($con,$queryper);
                                            $querykurs = "SELECT DISTINCT  kurs FROM transport";
                                            $rskurs=mysqli_query($con,$querykurs);
                                            $querytr = "SELECT DISTINCT  transport_type FROM transport";
                                            $rstr=mysqli_query($con,$querytr);

                                            echo"<div class=form-group' style='margin-bottom:10px;'>
                                                    <div class='card border-primary mb-3'>
                                                        <div class='card-body'>
                                                              <form>
                                                                  <div class='form-row'>
                                                                      <table id='dtBasicExample' class='table table-striped  table-borderless table-sm' style='font-size:8px; max-height:80px important;'>
                                                                        <th>
                                                                              <div class='col'>
                                                                                  <select class='chosen' name='agent".$y."' id='agent".$y."'style='width:150px;'>
                                                                                      <option value=''>Pilih Agent</option>";
                                                                                          while($rowAgent = mysqli_fetch_array($rsAgent)){
                                                                                              $queryAgent2 = "SELECT * FROM agent where id=".$rowAgent['agent']; 
                                                                                              $rsAgent2=mysqli_query($con,$queryAgent2);
                                                                                              $rowAgent2 = mysqli_fetch_array($rsAgent2);
                                                                                              echo "<option value='".$rowAgent2['id']."'>".$rowAgent2['company']."(".$rowAgent2['name'].")</option>";
                                                                                          }
                                                                            echo"</select>
                                                                            </div>
                                                                        </th>
                                                                        <th>
                                                                              <div class='col'>
                                                                                  <select class='chosen' name='conti".$y."' id='conti".$y."'style='width:150px;'>
                                                                                        <option value=''>Pilih Continent</option>";
                                                                                            while($rowtp= mysqli_fetch_array($rstp)){
                                                                                              $querytp2 = "SELECT * FROM continent where id=".$rowtp['continent']; 
                                                                                              $rstp2=mysqli_query($con,$querytp2);
                                                                                              $rowtp2 = mysqli_fetch_array($rstp2);
                                                                                          echo "<option value='".$rowtp2['id']."'>".$rowtp2['name']."</option>";
                                                                                          }
                                                                            echo"</select>
                                                                            </div>
                                                                        </th>
                                                                        <th>
                                                                              <div class='col'>
                                                                                  <select class='chosen' name='con".$y."' id='con".$y."'style='width:150px;'>
                                                                                      <option value=''>Pilih Country</option>";
                                                                                          while($rowcon= mysqli_fetch_array($rscon)){
                                                                                              $querycon2 = "SELECT * FROM country where id=".$rowcon['contry']; 
                                                                                              $rscon2=mysqli_query($con,$querycon2);
                                                                                              $rowcon2 = mysqli_fetch_array($rscon2);
                                                                                          echo "<option value='".$rowcon2['id']."'>".$rowcon2['name']."</option>";
                                                                                          }
                                                                            echo"</select>
                                                                            </div>
                                                                        </th>
                                                                        <th></th>
                                                                        <tr>
                                                                        <th>
                                                                              <div class='col'>
                                                                                  <select class='chosen' name='city".$y."' id='city".$y."'  style='width:150px;'>
                                                                                      <option value=''>Pilih City</option>";
                                                                                          while($rowcity= mysqli_fetch_array($rscity)){
                                                                                              $querycity2 = "SELECT * FROM city where id=".$rowcity['city']; 
                                                                                              $rscity2=mysqli_query($con,$querycity2);
                                                                                              $rowcity2 = mysqli_fetch_array($rscity2);
                                                                                          echo "<option value='".$rowcity2['id']."'>".$rowcity2['name']."</option>";
                                                                                          }
                                                                            echo"</select>
                                                                            </div>
                                                                        </th>
                                                                        <th>
                                                                              <div class='col'>
                                                                                  <select class='chosen' name='per".$y."' id='per".$y."' style='width:150px;'>
                                                                                      <option value=''>Pilih Periode</option>";
                                                                                          while($rowper= mysqli_fetch_array($rsper)){
                                                                                              $queryper2 = "SELECT * FROM periode where id=".$rowper['periode']; 
                                                                                              $rsper2=mysqli_query($con,$queryper2);
                                                                                              $rowper2 = mysqli_fetch_array($rsper2);
                                                                                          echo "<option value='".$rowper2['id']."'>".$rowper2['nama']."</option>";
                                                                                          }
                                                                            echo"</select>
                                                                              </div>
                                                                        </th>
                                                                        <th>
                                                                              <div class='col'>
                                                                                  <select class='chosen' name='trans".$y."' id='trans".$y."' style='width:150px;'>
                                                                                        <option value=''>Pilih Transport Type</option>";
                                                                                            while($rowtr= mysqli_fetch_array($rstr)){
                                                                                                $querytr2 = "SELECT * FROM transport_type where id=".$rowtr['transport_type']; 
                                                                                                $rstr2=mysqli_query($con,$querytr2);
                                                                                                $rowtr2 = mysqli_fetch_array($rstr2);
                                                                                            echo "<option value='".$rowtr2['id']."'>".$rowtr2['name']."</option>";
                                                                                            }
                                                                                  echo"</select>
                                                                              </div>
                                                                        </th>
                                                                        <th><button type='button' class='btn btn-warning' onclick='search(".$y.")'>Submit</th>
                                                                        </tr>";
                                                                  echo"</table>
                                                              </div>
                                                          </form>
                                                    </div>";
                                        echo"</select>
                                        <div class=form-group' name='divjobi2' id='divjobi2".$y."'></div>
                                        </div>";
                                    echo"</div>
                            </div>
                        </div>
                    </div>
                   </div>
                   </div>
                   <div class='form-row'>
                   <div class='col-3'>
                       <div class='card-body'>
                           <label>Total Price</label>
                       </div>
                   </div>
                   <div class='col-9'>
                       <div class='card border-primary mb-3'>
                           <div class='card-body'>
                                   <div class='form-row'>
                                           <div class='col-sm-2 my-1'>
                                                   <input type='text' class='form-control' id='tprice' name='tprice' style='width:100px;'>
                                           </div>
                                   </div>
                           </div>
                       </div>
                   </div>
                  </div>
                <div class='form-row'>
                    <div class='card-body'>
                        <button type='submit' class='btn btn-primary'>Submit</button>
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
  var total = 0;
  for (var i = 0; i < input.length; i++) {
    if (input[i].checked) {
      total += parseFloat(input[i].value);
    }
  }
  var n = total.toFixed()-1;
  document.getElementById("thari").value =  total.toFixed() + "D" + n + "N";
  //document.getElementById("thari2").value =  total.toFixed();
  var count = total.toFixed();
        alert(count);
        $.ajax({
          type:'POST',
          url:'trans_count.php',
          data:{'count':count},
          success:function(data){
           $('#divjobi').html(data);
         }
       });

}

</script>