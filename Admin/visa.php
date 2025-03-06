<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
session_start();
$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>VISA</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 300px;'>

                    <select class='chosen1' name='scountry' id='scountry' class='form-control'>
                    <option selected='selected' value=0>Search By Country</option>";

                    while($rowcountry = mysqli_fetch_array($rscountry)){
                      echo "<option value='".$rowcountry['id']."'>".$rowcountry['name']."</option>";
                    }
                    echo"</select>
                    
                    <div class='input-group-append'>";
                    
                    echo "<button type='submit' onclick='insertVisa(1,0,0)' class='btn btn-default'><i class='fa fa-plus'></i></button>";
                    
                    echo "</div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0' id='myMidBody'>";
            

                $query = "SELECT * FROM visa ORDER BY continent ASC, country ASC, id DESC";
                $rs=mysqli_query($con,$query);
                


                echo "<table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:14px;'>
                <thead>
                <tr>
                <th>Continent</th>
                <th>Country</th>
                <th>City Embassy</th>
                <th>Embassy</th>
                <th>Type</th>
                <th>Day</th>
                <th>Price</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody id='myTable'>";
                while($row=mysqli_fetch_array($rs)){
                  $querycountry2 = "SELECT * FROM country WHERE id=".$row['country'];
                  $rscountry2=mysqli_query($con,$querycountry2);
                  $rowcountry2 = mysqli_fetch_array($rscountry2);

                  $queryembassy = "SELECT * FROM embassy WHERE id=".$row['embassy'];
                  $rsembassy=mysqli_query($con,$queryembassy);
                  $rowembassy = mysqli_fetch_array($rsembassy);

                  $query_city = "SELECT * FROM city WHERE id=".$rowembassy['city'];
                  $rs_city=mysqli_query($con,$query_city);
                  $row_city = mysqli_fetch_array($rs_city);
                  
                  echo"
                  <tr style='font-weight:bold;'>
                  <td>".$row['continent']."</td>
                  <td>".$rowcountry2['name']."</td>
                  <td>".$row_city['name']."</td>
                  <td>".$rowembassy['address']."</td>
                  <td>".$row['type']."</td>
                  <td>".$row['day']."</td>
                  <td>".$row['price']."</td>";


                   echo "<td><button type='submit' onclick='editVisa(1,".$row['id'].",".$_POST['id'].",0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='delVisa(".$row['id'].",".$_POST['id'].")' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>
                  </tr>";
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
  $(document).ready(function(){
    $(".chosen1").chosen();
  });
  
  function myFunction(x) {
    var input, filter, table, tr, td, i, txtValue;
    filter = x.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = '';
        } else {
          tr[i].style.display = 'none';
        }
      }       
    }
  }
  
 
  function delVisa(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delVisa.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadVisa(1,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>
