<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
session_start();
$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);

$querycountall = "SELECT COUNT(*) as total FROM agent_files WHERE deletedStatus=0";
$rscountall=mysqli_query($con,$querycountall);
$rowcountall = mysqli_fetch_assoc($rscountall);

$querycount = "SELECT COUNT(*) as total FROM agent_files WHERE status = 0 AND deletedStatus=0";
$rscount=mysqli_query($con,$querycount);
$rowcount = mysqli_fetch_assoc($rscount);

$querystaff = "SELECT * FROM login_staff WHERE type=3 OR type=4";
$rsstaff=mysqli_query($con,$querystaff);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>";
                
                echo "<div id='countTotal'><h3 class='card-title' style='font-weight:bold;'>LAND TOUR FILES ( Total Belum Di Input : ".$rowcount['total']." dari ".$rowcountall['total']." )</h3></div>";
                
                echo "</br>
                <div>
                <select class='chosen' name='scountry' id='scountry' onchange='searchPage(1,this.value)' class='form-control'>
                    <option selected='selected' value=0>Search By Agent Scope</option>";

                    while($rowcountry = mysqli_fetch_array($rscountry)){
                      echo "<option value='".$rowcountry['id']."'>".$rowcountry['name']."</option>";
                    }
                    echo"</select>";

                   if($_SESSION['type']==1 or $_SESSION['staff']=="Joana" or $_SESSION['staff']=="Antonio Chandra"){
                     echo "<select class='chosen' name='stourcountry' id='stourcountry' onchange='searchPage(8,this.value)' class='form-control'>
                      <option selected='selected' value=0>Search By Tour Country</option>";
                      $querycountry = "SELECT * FROM country";
                      $rscountry=mysqli_query($con,$querycountry);
                      while($rowcountry = mysqli_fetch_array($rscountry)){
                        echo "<option value='".$rowcountry['name']."'>".$rowcountry['name']."</option>";
                      }

                      echo"</select>";
                      echo "<select class='chosen' name='sstaff' id='sstaff' onchange='searchPage(6,this.value)' class='form-control'>
                      <option selected='selected' value=0>Search By Staff</option>";

                      while($rowstaff = mysqli_fetch_array($rsstaff)){
                        echo "<option value='".$rowstaff['id']."'>".$rowstaff['name']."</option>";
                      }

                      echo"</select>";
                    }

                    echo "<select class='chosen' name='sstatus' id='sstatus' onchange='searchPage(7,this.value)' class='form-control'>
                    <option selected='selected' value=0>Search By Status</option>";
                      echo "<option value='1'>Sudah Diinput</option>";
                      echo "<option value='0'>Belum Diinput</option>";

                    echo"</select>
                </div>
                <div class='card-tools'>
                  <div class='input-group input-group-sm'>";
                    

                  echo "</div>
                </div>
              </div>
              <!-- /.card-header -->
              <div>";
              $querycountry2 = "SELECT * FROM staff_country WHERE staff=".$_SESSION['staff_id'];
              $rscountry2=mysqli_query($con,$querycountry2);
              $rowcountry2 = mysqli_fetch_array($rscountry2);

              $tempCountryFiles = preg_split ("/[;]+/", $rowcountry2['country']);
              $tempquery = "SELECT * FROM agent_files WHERE country LIKE ";

              $countStatusTrue = 0;
              $countStatusFalse = 0;

              for($i=0; $i<count($tempCountryFiles)-1; $i++){

                if($i==0){
                  $tempquery = $tempquery . "'%" . $tempCountryFiles[$i] . "%'";
                }else{
                  $tempquery = $tempquery . " OR country LIKE " . "'%" . $tempCountryFiles[$i] . "%'";
                }

                

              }
              $tempquery = $tempquery ." ORDER BY id DESC";


              if($_SESSION['type']==1 or $_SESSION['staff']=="Joana" or $_SESSION['staff']=="Antonio Chandra"){
                 $query = "SELECT * FROM agent_files WHERE deletedStatus=0 ORDER BY id DESC";
              }else{
                 $query = $tempquery;
              }
             
                $rs=mysqli_query($con,$query);

                echo "<table class='table table-hover' style='font-size:14px;'>
                <thead>
                <tr>
                <th>ID</th>
                <th>Agent Scope</th>
                <th>Tour Country</th>
                <th>Agent ID</th>
                <th>Agent Company</th>
                <th>File</th>
                <th>Staff</th>
                <th>Date Upload</th>
                <th>Date Update</th>
                <th>Status</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody>";

                while($row = mysqli_fetch_array($rs)){
                  $query_agent = "SELECT * FROM agent WHERE id=".$row['agent'];
                  $rs_agent=mysqli_query($con,$query_agent);
                  $row_agent = mysqli_fetch_array($rs_agent);

                  $query_package = "SELECT * FROM tour_package WHERE tour_files=".$row['id'];
                  $rs_package=mysqli_query($con,$query_package);
                  $row_package = mysqli_fetch_array($rs_package);

                  $query_package2 = "SELECT * FROM tour_package WHERE tour_files=".$row['id'];
                  $rs_package2=mysqli_query($con,$query_package2);
                  $row_package2 = mysqli_fetch_array($rs_package2);

                  $tempCountry = preg_split ("/[;]+/", $row_agent['tour_country']);
                  $tempString2 = '';

                  $tempCountry2 = preg_split ("/[;]+/", $row['country']);
                  $tempString3 = '';
                  
                  $query_staff2 = "SELECT * FROM login_staff WHERE id=".$row_package['staff'];
                  $rs_staff2=mysqli_query($con,$query_staff2);
                  $row_staff2 = mysqli_fetch_array($rs_staff2);

                  $cekCountry = 0;

                  for($i=0; $i<count($tempCountry2); $i++){
                    $query_country_cek = "SELECT * FROM country WHERE id=".$tempCountry2[$i];
                    $rs_country_cek=mysqli_query($con,$query_country_cek);
                    $row_country_cek = mysqli_fetch_array($rs_country_cek);
                    for($j=0; $j<count($tempCountryFiles)-1; $j++){
                      $query_country_cek2 = "SELECT * FROM country WHERE id=".$tempCountryFiles[$j];
                      $rs_country_cek2=mysqli_query($con,$query_country_cek2);
                      $row_country_cek2 = mysqli_fetch_array($rs_country_cek2);
                      // if($_SESSION['staff']=="Nanda"){

                      //   echo "ID : ".$row['id']." - ".$row_country_cek['name']." == ".$row_country_cek2['name'];
                      //   echo " - ".$tempCountryFiles[$j]." - </br>";
                      // }
                      
                      if($row_country_cek['name']==$row_country_cek2['name']){
                        $cekCountry = $cekCountry + 1;
                      }
                    }
                  }
                  if($_SESSION['type']==1 OR $_SESSION['type']==2 or $_SESSION['staff']=="Joana"){
                    $cekCountry = 1;
                  }

                  
                  if($cekCountry > 0){



                  echo "<input type='text' id='".$row['id']."' value='".$row['location']."' hidden>";
                  echo"
                  <tr style='font-weight:bold;'>";
                  echo "<td>".$row['id']."</td>";
                  echo "<td>";
                  if($row_agent['tour_country']!='' and $row_agent['tour_country']!='undefined'){
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
                  echo "<td>";

                  if($row['country']!='' and $row['country']!='undefined'){
                    for($i=0; $i<count($tempCountry2); $i++){
                      $querycountry2 = "SELECT * FROM country WHERE id=".$tempCountry2[$i];
                      $rscountry2=mysqli_query($con,$querycountry2);
                      $rowcountry2 = mysqli_fetch_array($rscountry2);
                      if($i==0){
                        $tempString3 = $tempString3 . $rowcountry2['name'];
                      }else{
                        $tempString3 = $tempString3 . "</br>" . $rowcountry2['name'];
                      }
                    }

                    echo $tempString3;
                  }else{
                    echo "-";
                  }
                  "</td>";
                  if($row_package2['id']=='' or $row_package2['id']=='null'){
                      echo "<td>".$row['agent']." - 0</td>";
                    }else{
                      echo "<td>".$row['agent']." - ".$row_package2['id']."</td>";
                    }
                  if($_SESSION['type']==1 or $_SESSION['staff']=="Joana" or $_SESSION['staff']=="Antonio Chandra"){
                    echo "<td>".$row_agent ['company']."</td>";
                  }else{
                    echo "<td> - </td>";
                  }
                  echo "<td><a href='".$row['location']."' download>".substr($row['location'],14)."</a>

                  </td>";

                 $tempStaff = '';
                  if($row['status']==0){
                    $query_staff_country2 = "SELECT * FROM staff_country";
                    $rs_staff_country2=mysqli_query($con,$query_staff_country2);
                    while($row_staff_country2 = mysqli_fetch_array($rs_staff_country2)){
                      $cekCountry2 = 0;
                      $tempCountryFiles2 = preg_split ("/[;]+/", $row_staff_country2['country']);
                      for($i=0; $i<count($tempCountry2); $i++){
                        $query_country_cek = "SELECT * FROM country WHERE id=".$tempCountry2[$i];
                        $rs_country_cek=mysqli_query($con,$query_country_cek);
                        $row_country_cek = mysqli_fetch_array($rs_country_cek);
                        for($j=0; $j<count($tempCountryFiles2)-1; $j++){
                          $query_country_cek2 = "SELECT * FROM country WHERE id=".$tempCountryFiles2[$j];
                          $rs_country_cek2=mysqli_query($con,$query_country_cek2);
                          $row_country_cek2 = mysqli_fetch_array($rs_country_cek2);

                          if($row_country_cek['name']==$row_country_cek2['name']){
                            $cekCountry2 = $cekCountry2 + 1;
                          }
                        }
                      }

                      if($cekCountry2>0){
                        $query_staff2 = "SELECT * FROM login_staff WHERE id=".$row_staff_country2['staff'];
                        $rs_staff2=mysqli_query($con,$query_staff2);
                        $row_staff2 = mysqli_fetch_array($rs_staff2);
                        $tempStaff = $tempStaff . $row_staff2['name'] . "</br>";
                      }
                    }
                  }else{
                    $query_staff2 = "SELECT * FROM login_staff WHERE id=".$row_package2['staff'];
                    $rs_staff2=mysqli_query($con,$query_staff2);
                    $row_staff2 = mysqli_fetch_array($rs_staff2);
                    $tempStaff = $row_staff2['name'];
                  }
                  echo "<td>".$tempStaff."</td>";

                  $date = date("Y-m-d");
                  $day = substr($row['uploadDate'],8,2);
                  $month = substr($row['uploadDate'],5,2);
                  $year = substr($row['uploadDate'],0,4);
                  $tanggal = $day."-".$month."-".$year;
                  if($row['uploadDate']=='0000-00-00'){
                    $tanggal = '-';
                  }

                  echo "<td>".$tanggal."</td>";

                  $date = date("Y-m-d");
                  $day = substr($row['updateDate'],8,2);
                  $month = substr($row['updateDate'],5,2);
                  $year = substr($row['updateDate'],0,4);
                  $tanggal = $day."-".$month."-".$year;
                  if($row['updateDate']=='0000-00-00'){
                    $tanggal = '-';
                  }
                  if($date==$rowfiles['updateDate']){
                    echo "<td style='color:red'>".$tanggal."</td>";
                  }else{
                    echo "<td>".$tanggal."</td>";
                  }
                  if($row['status']==0){
                    echo "<td style='color:red'>Belum di Input</td>";
                    if($row['country']!=''){
                      echo "<td><button type='submit' onclick='insertPage(3,".$row['id'].",".$row['agent'].")' style='font-size:13px;' class='btn btn-success'><i class='fa fa-arrow-right' aria-hidden='true''></i></button>";
                    }else{
                      echo "<td>";
                    }
                    
                  }else{
                    echo "<td style='color:green'>Sudah di Input</td><td>";
                  }

                  
                  if($_SESSION['type']==1 or $_SESSION['staff']=="Joana" or $_SESSION['staff']=="Antonio Chandra"){
                    echo "<button type='submit' onclick='editPage(-8,".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>";
                    if($row['status']==0){
                      echo "<button type='submit' onclick='delAgentFiles(".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
                    }
                    
                  }else{
                    echo "</td>";
                  }
                  echo"</tr>
                  <tr>";
                  
                  
                }
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
  
  function delAgentFiles(x,y,z){
  	var file = $("#"+x).val();
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delAgentFiles.php",
        method: "POST",
        asynch: false,
        data:{'id':x,'files':file},
        success:function(data){
          if(data=="success"){
            reloadPage(-11,0,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

