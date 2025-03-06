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
                <h3 class='card-title' style='font-weight:bold;'>DEFAULT TERMS AND CONDITIONS</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 300px;'>
                    <select class='chosen' name='scountry' id='scountry' onchange='searchPage(1,this.value)' class='form-control'>
                    <option selected='selected' value=0>Search By Country</option>";

                    while($rowcountry = mysqli_fetch_array($rscountry)){
                      echo "<option value='".$rowcountry['id']."'>".$rowcountry['name']."</option>";
                    }
                    echo"</select>
                    
                    <button type='submit' onclick='insertExclusion(0,0,0)' class='btn btn-default'><i class='fa fa-plus'></i></button>
                  </div>

                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>";

                $query = "SELECT * FROM termsandconditions_default";
                $rs=mysqli_query($con,$query);

                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                <th>Country</th>
                <th>Description</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody>";

                 while($row = mysqli_fetch_array($rs)){
                  $query_country2 = "SELECT * FROM country WHERE id=".$row['country'];
                  $rs_country2 = mysqli_query($con,$query_country2);
                  $row_country2 = mysqli_fetch_array($rs_country2);
                  echo"
                  <tr style='font-weight:bold;'>";
                  echo "<td>".$row_country2['name']."</td>
                  <td>".$row['name']."</td>";
                  echo "<td><button type='submit' onclick='editExclusion(0,".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='delTermsAndConditionDefault(".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
                  
                  echo"</tr>
                  ";
                  
                  
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
    $(".chosen").chosen();
  });
  
  function delTermsAndConditionDefault(x,y,z){
    var txt;

    var r = confirm("Are you sure to delete?");
    if (r == true) {
      alert(x);
     $.ajax({
        url:"delTermsConditionsDefault.php",
        method: "POST",
        asynch: false,
        data:{'id':x},
        success:function(data){
          if(data=="success"){
            reloadExclusion(0,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

