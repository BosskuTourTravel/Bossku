<?php
include "../site.php";
include "../db=connection.php";

$querytour = "SELECT * FROM tour_package WHERE id = ".$_POST['id'];
$rstour=mysqli_query($con,$querytour);
$rowtour = mysqli_fetch_array($rstour);

$_code = "PricePackage"; 

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>Performa Price Package : ".$rowtour['tour_name']."</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>

                      <button type='submit' onclick='insertPage(5,".$_POST['id'].",0)' class='btn btn-default'><i class='fa fa-plus'></i></button>
                      <button type='submit' onclick='reloadPage(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";
        

                $query = "SELECT * FROM performa_price WHERE tour_package = ".$_POST['id'];
                $rs=mysqli_query($con,$query);
                


                echo "<table class='table table-hover'>
                <thead>
                <tr>
                <th>Range Price</th>
                <th>1. Persentase</th>
                <th>2. Nominal</th>
                <th>Pilihan</th>
                <th>Agent Com</th>
                <th>Staff Com</th>
                <th>Staff Com2</th>
                
                <th>Marketing</th>
                <th>Supplier</th>
                <th>Discount</th>
                
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
                  <select class='form-control select2' onchange='updateFlag(".$row['id'].",".$_POST['id'].")' name='flag' id='flag' style='width: 100%;'>
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
                  <td>".$row['staffcom2']."</td>
                  
                  <td>".$row['marketingcom']."</td>
                  <td>".$row['subagent']."</td>
                  <td>".$row['discount']."</td>
                  <td>

                  <button type='submit' onclick='editPage(-1,".$row['id'].",".$_POST['id'].",0)' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='delPerformaPrice(".$row['id'].",".$_POST['id'].")' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button>

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
  function updateFlag(x,z) {
    var y = document.getElementById("flag").options[document.getElementById("flag").selectedIndex].value;
    $.ajax({
      url:"updatePerformaOption.php",
      method: "POST",
      asynch: false,
      data:{id:x,flag:y},
      success:function(data){
        if(data=="success"){
          reloadPage(-2,z,0);
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
      url:"delPerformaPrice.php",
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