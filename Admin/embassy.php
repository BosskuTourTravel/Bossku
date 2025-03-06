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
                <h3 class='card-title' style='font-weight:bold;'>EMBASSY</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 300px;'>

                    <select class='chosen1' name='scountry' id='scountry' class='form-control'>
                    <option selected='selected' value=0>Search By Country</option>";

                    while($rowcountry = mysqli_fetch_array($rscountry)){
                      echo "<option value='".$rowcountry['id']."'>".$rowcountry['name']."</option>";
                    }
                    echo"</select>
                    
                    <div class='input-group-append'>";
                    
                    echo "<button type='submit' onclick='insertVisa(0,0,0)' class='btn btn-default'><i class='fa fa-plus'></i></button>";
                    
                    echo "</div>
                  </div>
                </div>";
                echo "</br><button type='submit' onclick='insertVisa(2,0,0)' class='btn btn-primary'>Insert Requirements & Notes<i class='fa fa-star'></i></button>
                  <button type='submit' onclick='insertVisa(3,0,0)' class='btn btn-warning'>Edit Requirements & Notes<i class='fa fa-star'></i></button>";
              echo"</div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0' id='myMidBody'>";
            

                $query = "SELECT * FROM embassy ORDER BY id DESC";
                $rs=mysqli_query($con,$query);
                


                echo "<table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:14px;'>
                <thead>
                <tr>
                <th>Country</th>
                <th>City</th>
                <th>Address</th>
                <th>Office Hours</th>
                <th>Phone</th>
                <th>Fax</th>
                <th>Web</th>
                <th>Email</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody id='myTable'>";
                while($row=mysqli_fetch_array($rs)){
                  $querycountry2 = "SELECT * FROM country WHERE id=".$row['country'];
                  $rscountry2=mysqli_query($con,$querycountry2);
                  $rowcountry2 = mysqli_fetch_array($rscountry2);

                  $query_city = "SELECT * FROM city WHERE id=".$row['city'];
                  $rs_city=mysqli_query($con,$query_city);
                  $row_city = mysqli_fetch_array($rs_city);
                  echo"
                  <tr style='font-weight:bold;'>
                  <td>".$rowcountry2['name']."</td>
                  <td>".$row_city['name']."</td>
                  <td>".$row['address']."</td>
                  <td>".$row['office_hours']."</td>
                  <td>".$row['phone']."</td>
                  <td>".$row['fax']."</td>
                  <td>".$row['web']."</td>
                  <td>".$row['email']."</td>";


                  echo "<td><button type='submit' onclick='editVisa(0,".$row['id'].",".$_POST['id'].",0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='delEmbassy(".$row['id'].",".$_POST['id'].")' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>
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
  
 
  function delEmbassy(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delEmbassy.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadVisa(0,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

