n<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
session_start();

$_POST['id'] = 0;

$querycountall = "SELECT COUNT(*) as total FROM tour_package";
$rscountall=mysqli_query($con,$querycountall);
$rowcountall = mysqli_fetch_assoc($rscountall);

$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);

$querystaff = "SELECT * FROM login_staff WHERE type=3 OR type=4";
$rsstaff=mysqli_query($con,$querystaff);

$querycity = "SELECT * FROM city";
$rscity=mysqli_query($con,$querycity);


echo "<div class='content-wrapper'>

          <div>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>CEK LAND TOUR FLIGHT</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 100px;'>
                    
                    <div class='input-group-append'>";
                      if($_SESSION['type']==1 or $_SESSION['staff']=="Joana" or $_SESSION['staff']=="Antonio Chandra"){
                        echo "<button type='submit' onclick='insertPage(3,0,0)' style='width:50px;' class='btn btn-default'><i class='fa fa-plus'></i></button>";
                      }
                    echo "</div>
                  </div>
                </div>
              </div>

              
            <div id='filterMenu' name='filterMenu' >
              <div class='card-header'>
                
                  <div class='input-group input-group-sm'>

                  <select class='chosen1' name='filterC' id='filterC' onchange='reloadCek(2,this.value,0)' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>
                    <option value='1'>Cek Semua Flight</option>
                    <option value='2'>Cek Flight From</option>";


                    
                    echo"</select>
                    <div id='divFilter'></div>
                    
                </div>
              </div>
              </div>
              <!-- /.card-header -->
              <div id='myMidBody'>
              <div id='divPage'>
              ";


              $query_continent = "SELECT * FROM continent";
              $rs_continent=mysqli_query($con,$query_continent);
              while($row_continent = mysqli_fetch_array($rs_continent)){

                if($_SESSION['type']==1 or $_SESSION['type']==2){
                 $query = "SELECT * FROM tour_package WHERE continent = '".$row_continent['id']."' ORDER by staff ASC, id ASC";
                 $query_tourpackagecount = "SELECT COUNT(*) as total FROM tour_package WHERE continent = '".$row_continent['id']."' ORDER by staff ASC, id ASC";
               }else{
                 $query = "SELECT * FROM tour_package WHERE continent = '".$row_continent['id']."' AND staff=".$_SESSION['staff_id']." ORDER BY id ASC";
                 $query_tourpackagecount = "SELECT COUNT(*) as total FROM tour_package WHERE continent = '".$row_continent['id']."' AND staff=".$_SESSION['staff_id']." ORDER BY id ASC";
               }              
               
               $rs_tourpackagecount=mysqli_query($con,$query_tourpackagecount);
               $row_tourpackagecount = mysqli_fetch_assoc($rs_tourpackagecount);
               if($row_tourpackagecount['total']>0){


                 $rs=mysqli_query($con,$query);

                 $cek = 0;
                 $name = [];
                 echo "<div style='margin-left:10px;'>

                 <div class='row'>";
                 echo "<table id='dtBasicExample' class='table  table-bordered table-sm' style='font-size:14px; max-height:100px important;'>";
                 echo"<tr bgcolor='#A9CCE3 '>
                 <th scope='row'>
                 </th>
                 <td colspan='5' align='center'><b>".$row_continent['name']."</b></td>
                 </tr>";
                 echo "<th>Tour Package</th>";
                 echo "<th>Tour Name</th>";
                 echo "<th>Staff</th>";
                 echo "<th>Keterangan</th>";
                 echo "<tbody>";
                 $total = 0;
                 while($row = mysqli_fetch_array($rs)){


                   $tempCity = preg_split ("/[;]+/", $row['city']);
                   $cityTo = 0;
                   $cityOut = 0;
                   if($row['city_count']=='1'){

                    $cityTo = $tempCity[0];
                    $cityOut = $tempCity[0];
                  }else{
                    for($i=0; $i<count($tempCity); $i++){
                     if($i==0){
                      $cityTo = $tempCity[$i];
                    }elseif($i==count($tempCity)-1){
                      $cityOut = $tempCity[$i];
                    }
                  }

                }


                $query_airlines = "SELECT COUNT(*) as total FROM flight_quotation WHERE city_to=".$cityTo." AND city_out=".$cityOut;
                $rs_airlines=mysqli_query($con,$query_airlines);
                $row_airlines = mysqli_fetch_assoc($rs_airlines);
	// echo "<tr>";
	// echo "<td>888".$row['id']."</td>";
	// echo "<td>".$query_airlines."</td>";
	// echo "</tr>";

                if($_POST['kode']==1){
		//landtour yang tidak memiliki flight diflight pricelist
                  if($row_airlines['total']==0 AND $row['staff']!=1){
                   $query_staff = "SELECT * FROM login_staff WHERE id=".$row['staff'];
                   $rs_staff=mysqli_query($con,$query_staff);
                   $row_staff = mysqli_fetch_array($rs_staff);
                   echo "<tr>";
                   echo "<td>888".$row['id']."</td>";
                   echo "<td>".$row['tour_name']."</td>";
                   echo "<td>".$row_staff['name']."</td>";
                   echo "<td>Tidak Memiliki Flight di Flight Pricelist</td>";
                   echo "</tr>";
                   $total = $total + 1;
                 }
               }else{
		//landtour yg memiliki flight tapi mengecek fromnya
                if($row_airlines['total']>0 AND $row['staff']!=1){
                 $query_flight2 = "SELECT COUNT(DISTINCT(city_from)) as total FROM flight_quotation";
                 $rs_flight2=mysqli_query($con,$query_flight2);
                 $row_flight2 = mysqli_fetch_assoc($rs_flight2);

                 $countFlight = 1;
                 $tempFlight  = '';

                 $query_flight = "SELECT DISTINCT(city_from) FROM flight_quotation";
                 $rs_flight=mysqli_query($con,$query_flight);
                 while($row_flight = mysqli_fetch_array($rs_flight)){
                  $query_airlines2 = "SELECT COUNT(*) as total FROM flight_quotation WHERE city_from=".$row_flight['city_from']." AND city_to=".$cityTo." AND city_out=".$cityOut;
                  $rs_airlines2=mysqli_query($con,$query_airlines2);
                  $row_airlines2 = mysqli_fetch_assoc($rs_airlines2);
                  if($row_airlines2['total']==0){
                   $query_city = "SELECT * FROM city WHERE id=".$row_flight['city_from'];
                   $rs_city=mysqli_query($con,$query_city);
                   $row_city = mysqli_fetch_array($rs_city);
                   $tempFlight = $tempFlight ." ". $row_city['name'];
                 }

               }

               $query_staff = "SELECT * FROM login_staff WHERE id=".$row['staff'];
               $rs_staff=mysqli_query($con,$query_staff);
               $row_staff = mysqli_fetch_array($rs_staff);

               echo "<tr>";
               echo "<td>888".$row['id']."</td>";
               echo "<td>".$row['tour_name']."</td>";
               echo "<td>".$row_staff['name']."</td>";
               echo "<td>Tidak Memiliki Flight From ".$tempFlight."</td>";
               echo "</tr>";
               $total = $total + 1;
             }
           }

           
         }
         echo"<tr bgcolor='#FFFFFF '>
         <th scope='row'>
         </th>
         <td colspan='5' align='center'><b>Total : ".$total."</b></td>
         </tr>";
         echo "</tbody></table>";




         echo "</div>
         <!-- /.card-body -->
         </div>";
       }

     }
           echo " <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
</div>";
?>

<script>
  $(document).ready(function(){
    $(".chosen1").chosen();
    $(document).ajaxStart(function(){
      //$("#wait").css("display", "block");
      $('#divPage').css('opacity', '0.3');

    });
    $(document).ajaxComplete(function(){
      //$("#wait").css("display", "none");
      $('#divPage').css('opacity', '1');
    });
  });

  
</script>

