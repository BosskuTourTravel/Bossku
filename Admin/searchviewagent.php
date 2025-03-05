<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";
session_start();

$querycountry = "SELECT * FROM agent ORDER BY company ASC";
$rscountry=mysqli_query($con,$querycountry);
echo "<div class='content-wrapper'>

 <div class='row'>
          <div>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>AGENT</h3></br>
                <div>
                  <select class='chosen1' name='scountry' id='scountry' onchange='searchAgent(0,this.value,1)' class='form-control'>
                    <option selected='selected' value=0>Search By Company</option>";

                    while($rowcountry = mysqli_fetch_array($rscountry)){
                      if($rowcountry['tour_country']==''){
                         echo "<option style='color:red;' value='".$rowcountry['id']."'>".$rowcountry['company']." ( ".$rowcountry  ['name']." ) - NO AGENT SCOPE</option>";
                      }else{
                         echo "<option value='".$rowcountry['id']."'>".$rowcountry['company']." ( ".$rowcountry  ['name']." )</option>";
                      }
                    }
                    echo"</select>
                    
                </div>
                <div class='card-tools'>
                  <div class='input-group input-group-sm'> 
                  
                    <div class='input-group-append'>
                      <button type='submit' class='btn btn-default'><i class='fas fa-search'></i></button>
                      <button type='submit' onclick='insertAgent(0,0,0)' style='width:50px;' class='btn btn-default'><i class='fa fa-plus'></i></button>

                      </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div >";
          

                $query = "SELECT * FROM agent WHERE id=".$_POST['id']." ORDER BY company ASC";
                $rs=mysqli_query($con,$query);
                


                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                <th>Company</th>
                <th>AgentCategory</th>
                <th>Agent Name</th>
                <th>Agent Job Title</th>
                <th>Email</th>
                <th>Street</th>
                <th>City</th>
                <th>Representative Country</th>
                <th>Agent Scope</th>
                <th>Website</th>
                <th>Home Phone</th>
                <th>Phone</th>
                <th>Fax</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysqli_fetch_array($rs)){

                  $tempCountry = preg_split ("/[;]+/", $row['tour_country']);
                  $tempString2 = '';
                  
                  echo"
                  <tr style='font-weight:bold;'>";
                 
                  echo "<td>".$row ['company']."</td>";
                   echo "<td>";
                  $query_category = "SELECT * FROM agent_category";
                  $rs_category=mysqli_query($con,$query_category);
                  
                  echo "<select name='scategory' id='scategory' onchange='updateCategory(this.value,".$row['id'].")' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                     while($row_category = mysqli_fetch_array($rs_category)){
                      if($row_category['id']==$row['category']){
                         echo "<option selected='selected' value='".$row_category['id']."'>".$row_category['name']."</option>";
                      }else{
                         echo "<option value='".$row_category['id']."'>".$row_category['name']."</option>";
                      }
                    }
                    echo"</select>";
                  echo "</td>";
                  echo "<td>".$row ['name']."</td>";
                  echo "<td>".$row ['job_title']."</td>";
                  echo "<td>".$row ['email']."</td>";
                  echo "<td>".$row ['street']."</td>";
                  echo "<td>".$row ['city']."</td>";
                  echo "<td>".$row ['country']."</td>";
                  echo "<td>";
                  if($row['tour_country']!='' and $row['tour_country']!='undefined'){
                    for($i=0; $i<count($tempCountry); $i++){
                      $querycountry2 = "SELECT * FROM country WHERE id=".$tempCountry[$i];
                      $rscountry2=mysqli_query($con,$querycountry2);
                      $rowcountry2 = mysqli_fetch_array($rscountry2);
                      if($i==0){
                        $tempString2 = $tempString2 . $rowcountry2['name'];
                      }else{
                        $tempString2 = $tempString2 . "</br>" . $rowcountry2['name'];
                      }
                    }

                    echo $tempString2;
                  }else{
                    echo "-";
                  }

                  
                  echo "</td>";
                  echo "<td>".$row ['website']."</td>";
                  echo "<td>".$row ['home_phone']."</td>";
                  echo "<td>".$row ['phone']."</td>";
                  echo "<td>".$row ['fax']."</td>
                  <td>";
                
                  echo "<button type='submit' onclick='editPage(-11,".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='delAgent(".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
                  
                  echo"</tr>";
                  
                  
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
    function updateCategory(x,y){
    $.ajax({
        url:"updateAgentCategory.php",
        method: "POST",
        asynch: false,
        data:{id:y,category:x},
        success:function(data){
          if(data=="success"){
            alert(data);
          }else{
            alert("Fail to Delete");
          }
        }
      });
  }
  function delAgent(x,y,z){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delAgent.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadPage(-12,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

