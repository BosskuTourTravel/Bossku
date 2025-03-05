<?php
include "../site.php";
include "../db=connection.php";


$queryagent = "SELECT * FROM agent WHERE id=".$_POST['id'];
$rsagent=mysqli_query($con,$queryagent);
$rowagent = mysqli_fetch_array($rsagent);

$querycountry = "SELECT * FROM country WHERE id=".$_POST['country'];
$rscountry=mysqli_query($con,$querycountry);
$rowcountry = mysqli_fetch_array($rscountry);

$_code = "PricePackage"; 

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>Performa Price [ Agent : ".$rowagent['company']." , Country : ".$rowcountry['name']." ]</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>
                      <button type='submit' onclick='reloadPage(-15,".$_POST['id'].",".$_POST['country'].")' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
        

                $query = "SELECT * FROM performa_price_standart WHERE agent = ".$_POST['id']." and country=".$_POST['country'];
                $rs=mysqli_query($con,$query);
                


                echo "<table class='table table-hover'>
                <thead>
                <tr>
                <th>Range Price</th>
                <th>1. Persentase</th>
                <th>2. Nominal</th>
                <th>Pilihan</th>
                <th>3. Agent Com</th>
                <th>4. Staff Com</th>
                <th>5. Staff Com2</th>
                <th>6. Marketing</th>
                <th>Supplier</th>
                
                <th>Option</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysqli_fetch_array($rs)){
                  $queryz = "SELECT * FROM performa_price_range WHERE id=".$row['performa_price_range'];
                  $rsz=mysqli_query($con,$queryz);
                  $rowz = mysqli_fetch_array($rsz);
                
                  echo"
                  <tr style='font-weight:bold;'>";
                  if($rowz['price2']==1){
                    echo "<td> < ".number_format($rowz['price1'], 0, ".", ".")."</td>";
                  }else if($rowz['price2']==0){
                    echo "<td>".number_format($rowz['price1'], 0, ".", ".")." > .. </td>";
                  }else{
                    echo "<td>".number_format($rowz['price1'], 0, ".", ".")." - ".number_format($rowz['price2'], 0, ".", ".")."</td>";
                  }
                  echo "<td>".$row['persentase']."</td>
                  <td>".$row['nominal']."</td>
                  <td>
                  <select class='form-control select2' onchange='updateFlag(".$row['id'].",".$_POST['id'].",".$_POST['country'].")' name='flag' id='flag' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";
                    for ($x = 1; $x <3; $x++) {
                      if($x==$row['option_price']){
                        echo "<option selected='selected' value=".$x.">".$x."</option>";
                      }else{
                        echo "<option value=".$x.">".$x."</option>";
                      }
                    }
                    echo"</select>
                  </td>
                  <td>".$row['agentcom']."</td>
                  <td>".$row['staffcom']."</td>
                  <td>".$row['staff_com2']."</td>
                  <td>".$row['marketingcom']."</td>
                  <td>".$row['subagent']."</td>
                  <td>

                  <button type='submit' onclick='editPage(-9,".$row['id'].",".$_POST['id'].",".$_POST['country'].")' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  

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

<script>
  function updateFlag(x,z,c) {
    var y = document.getElementById("flag").options[document.getElementById("flag").selectedIndex].value;
    $.ajax({
      url:"updatePerformaOptionAgent.php",
      method: "POST",
      asynch: false,
      data:{id:x,flag:y},
      success:function(data){
        if(data=="success"){
          reloadPage(-15,z,c);
        }else{
          alert("Fail to Update");
        }
      }
    });
  }
  function delPerformaPrice(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
      url:"delPerformaPriceAgent.php",
      method: "POST",
      asynch: false,
      data:{id:x},
      success:function(data){
        if(data=="success"){
          reloadPage(-2,y,0);
        }else{
          alert("Fail to Delete");
        }
      }
    });
   } 
 }

</script>