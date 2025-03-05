<script src="dist/css/style.css"></script>
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


              
              $total_records_per_page = $_POST['total_records_per_page'];
              $next_page = $_POST['next_page'] + $total_records_per_page;
              $previous_page =  $next_page - $total_records_per_page;
            
              if($_POST['typePage']==1){
                $page_no = $_POST['page_no'] - 1;
                $typePage = $previous_page;
                $next_page = $typePage - $total_records_per_page;
              }else{
                $page_no = $_POST['page_no'] + 1;
                $typePage = $next_page;

              }
                if($_SESSION['type']!=1 and $_SESSION['type']!=2 and $_SESSION['type']!=5 and $_SESSION['staff']!="Joana" and $_SESSION['type']!=6){
                  $query = "SELECT * FROM tour_package WHERE staff=".$_SESSION['staff_id']." ORDER BY dateInsert DESC LIMIT ".$typePage.", ".$typePage;
                  $rs=mysqli_query($con,$query);
                }else{
                  $query = "SELECT * FROM tour_package ORDER BY dateInsert DESC LIMIT ".$typePage.", ".$typePage;
                  $rs=mysqli_query($con,$query);
                }
                
                // echo "previous_page : ".$previous_page."</br>";
                // echo "next_page : ".$next_page."</br>";
                
                //    echo $query."</br>";

                echo "<table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:14px; max-height:100px important;'>
                <thead>
                <tr>
                <th>Tour Code</th>
                <th>Landtour Files</th>";

                 if($_SESSION['type']==1 or $_SESSION['type']==2 or $_SESSION['staff']=="Joana"){
                 	 echo "<th>Agent Name</th>";
                 }
                 echo "<th>Tour Country</th>
                <th>City</th>
                <th>Tour Name</th>
                <th>Tour Type</th>
                <th>Tour Category</th>
                <th>Departure Day</th>
                <th>Min Person</th>
                <th>Hotel Rating</th>";
                
                if($_SESSION['type']==1 or $_SESSION['staff']=="Antonio Chandra"){
                	echo "<th>Purchase Price</th>";
                }
                echo "<th>Selling Price</th>
                <th>Tipping</th>
                
                <th>Img</th>
                <th>Staff</th>
                <th>Date Files</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody id='myTable'>";

                while($row = mysqli_fetch_array($rs)){
                  $totalBullet = 0;
                  $totalFerry = 0;
                  $price2 = 999999999999;

                  $tempMinPerson = $row['minperson'];
                  $tempHotelRating = '';

                  $query_package2 = "SELECT * FROM tour_price_package WHERE tour_package =".$row['id'];
                  $rs_package2 = mysqli_query($con,$query_package2);

                  $query_exclusion = "SELECT * FROM exclusion_plus WHERE tour_package =".$row['id'];
                  $rs_exclusion = mysqli_query($con,$query_exclusion);
                  $row_exclusion = mysqli_fetch_array($rs_exclusion);

                  $query_staff = "SELECT * FROM login_staff WHERE id=".$row['staff'];
                  $rs_staff=mysqli_query($con,$query_staff);
                  $row_staff = mysqli_fetch_array($rs_staff);

                  $query_staff = "SELECT * FROM login_staff WHERE id=".$row['staff'];
                  $rs_staff=mysqli_query($con,$query_staff);
                  $row_staff = mysqli_fetch_array($rs_staff);
                  
                  while ($row_package2 = mysqli_fetch_array($rs_package2)) {
                    $query_min_price = "SELECT * FROM tour_price_detail WHERE tour_price_package =".$row_package2['id'];
                    $rs_min_price=mysqli_query($con,$query_min_price);

                    while($row_min_price = mysqli_fetch_array($rs_min_price)){

                      $query_k2 = "SELECT * FROM kurs_bank WHERE id = ".$row_min_price['kurs'];
                      $rs_k2=mysqli_query($con,$query_k2);
                      $row_k2 = mysqli_fetch_array($rs_k2);

                      $query_kurs2 = "SELECT * FROM kurs_live WHERE name LIKE '".$row_k2['name']."'";
                      $rs_kurs2=mysqli_query($con,$query_kurs2);
                      $row_kurs2 = mysqli_fetch_array($rs_kurs2);

                      if(isset($row_min_price['price'])==null){

                      }else{
                          $query_performa_kurs = "SELECT * FROM performa_kurs_standart WHERE kurs=".$row_min_price['kurs'];
                          $rs_performa_kurs=mysqli_query($con,$query_performa_kurs);
                          $row_performa_kurs = mysqli_fetch_array($rs_performa_kurs);

                          if(!isset($row_kurs['name'])){
                            $value_kurs = 1;
                          }else{

                            if($row_kurs['jual']>$row_performa_kurs['price']){
                              $value_kurs = $row_kurs['jual'];
                            }else{
                              $value_kurs = $row_performa_kurs['price'];
                            }

                          }

                          if(!isset($row_kurs2['name'])){
                            $value_kurs2 = 1 * $row_min_price['price'];
                          }else{
                            if($row_kurs2['jual']>$row_performa_kurs['price']){
                              $row_kurs2['jual'] = $row_kurs2['jual'];
                            }else{
                              $row_kurs2['jual'] = $row_performa_kurs['price'];
                            }
                            $value_kurs2 = $row_kurs2['jual'] * $row_min_price['price'];
                          }
                          
                          if($price2>$value_kurs2){
                            $price2 = $value_kurs2;
                            $tempMinPerson = $row_min_price['person'];
                          }


                      }

                    }

                    $tempHotelRating = $row_package2['rating'];
                  }


                  $query_range = "SELECT * FROM performa_price_range";
                  $rs_range=mysqli_query($con,$query_range);
                  $pId = 0;


                  while($row_range = mysqli_fetch_array($rs_range)){
                    if($row_range['price2']==1){
                      if($price2<=$row_range['price1']){
                        $pId = $row_range['id'];
                      }
                    }else if($row_range['price2']==0){
                      if($price2>=$row_range['price1']){
                        $pId = $row_range['id'];
                      }
                    }else{
                      if($price2>$row_range['price1'] && $price2<=$row_range['price2']){
                        $pId = $row_range['id'];
                      }

                    }

                  }
                  $query_performa = "SELECT * FROM performa_price WHERE performa_price_range=".$pId." AND tour_package = ".$row['id'];
                  $rs_performa=mysqli_query($con,$query_performa);
                  $row_performa = mysqli_fetch_array($rs_performa);
                  $tempPerforma = 0;

                  
                  if($row_performa['option_price'] == 1){
                    $tempPerforma = $row_performa['persentase']*$price2/100;
                  }elseif ($row_performa['option_price'] == 2) {
                    $tempPerforma = $row_performa['nominal'];
                  }elseif ($row_performa['option_price'] == 3) {
                    $tempPerforma = $row_performa['agentcom'];
                  }

                  $purchaseprice = $price2;
                  if($purchaseprice>1000 && substr((int)$price2,-3)!='000'){
                    $purchaseprice = ((int)$purchaseprice - substr((int)$purchaseprice,-3)) + 1000;
                  }
                  if($purchaseprice >= 999999999999){
                    $purchaseprice = 0;
                  }
                  $price2 = $price2 + $tempPerforma;
                  if($price2>1000 && substr((int)$price2,-3)!='000'){
                    $price2 = ((int)$price2 - substr((int)$price2,-3)) + 1000;
                  }
                  if($price2 >= 999999999999){
                    $price2 = 0;
                  }

                  if($price2>=1000000000000){
                    $price2 = 0;
                  }

                  $tempCity = preg_split ("/[;]+/", $row['city']);
                  $tempCountry = preg_split ("/[;]+/", $row['country']);
                  $tempString = "";
                  $tempString2 = "";  

                  $querykurs = "SELECT * FROM kurs_bank WHERE id=".$row['kurs'];
                  $rskurs=mysqli_query($con,$querykurs);
                  $rowkurs = mysqli_fetch_array($rskurs);

                  $queryfiles = "SELECT * FROM agent_files WHERE id=".$row['tour_files'];
                  $rsfiles=mysqli_query($con,$queryfiles);
                  $rowfiles = mysqli_fetch_array($rsfiles);

                  if($row['flag']==1){
                    $flag = "Active";
                  }else{
                    $flag = "Inactive";
                  }

                  if($row['minperson']<10){
                    $tippingPrice = $row['tipping'];
                  }else if($row['minperson']>=10 && $row['minperson']<15){
                    $tippingPrice = $row_exclusion['tipping2'];
                  }else{
                    $tippingPrice = $row_exclusion['tipping3'];
                  }

                  //bullettrain , ferry
                  $tempBulletTrain = preg_split ("/[;]+/", $row_exclusion['bullettrain_name']);
                  $tempFerry = preg_split ("/[;]+/", $row_exclusion['ferry_name']);
                  $tempBulletTrainPrice = preg_split ("/[;]+/", $row_exclusion['bullettrain_price']);
                  $tempFerryPrice = preg_split ("/[;]+/", $row_exclusion['ferry_price']);

                  $query_bankbullet = "SELECT * FROM kurs_bank WHERE id=".$row_exclusion['bullettrain_kurs'];
                  $rs_bankbullet=mysqli_query($con,$query_bankbullet);
                  $row_bankbullet = mysqli_fetch_array($rs_bankbullet);

                  $query_bankferry = "SELECT * FROM kurs_bank WHERE id=".$row_exclusion['ferry_kurs'];
                  $rs_bankferry=mysqli_query($con,$query_bankferry);
                  $row_bankferry = mysqli_fetch_array($rs_bankferry);

                  //end

                echo"
                <tr style='font-weight:bold;'>";
                echo "<td>888".$row['id']."</br></br>
                <button type='submit' style='font-size:10px;' onclick='printItineraryStaff(2,".$row['id'].")' class='btn btn-primary'>Print Itinerary</button></br></br>";
                if($_SESSION['type']==1 or $_SESSION['type']==2){
                  echo "<button type='submit' style='font-size:10px;' onclick='printItineraryPerforma(2,".$row['id'].")' class='btn btn-primary'>Print Itinerary Performa</button>";
                }
                echo "</td>";
                echo "<td>".$row['agent']."-".$row['tour_files']."</br>";
                $query_tourfiles = "SELECT * FROM agent_files WHERE id=".$row['tour_files'];
                $rs_tourfiles=mysqli_query($con,$query_tourfiles);
                $row_tourfiles = mysqli_fetch_array($rs_tourfiles);
                echo "<a href='".$row_tourfiles['location']."'>Download</a>";
                echo "</td>";
                if($_SESSION['type']==1 or $_SESSION['type']==2 or $_SESSION['staff']=="Joana"){
                	$query_agent = "SELECT * FROM agent WHERE id=".$row['agent'];
                	$rs_agent=mysqli_query($con,$query_agent);
                	$row_agent = mysqli_fetch_array($rs_agent);

                	echo "<td>".$row_agent['company']."</td>";
                }

                echo "<td>";
                 if($row['country']!='' and $row['country']!='undefined'){
                  for($i=0; $i<count($tempCountry); $i++){
                    $query_country = "SELECT * FROM country WHERE id = ".$tempCountry[$i];
                    $rs_country=mysqli_query($con,$query_country);
                    $row_country = mysqli_fetch_array($rs_country);
                    if($i==0){
                      $tempString2 = $tempString2 . $row_country['name'];
                    }else{
                      $tempString2 = $tempString2 . "</br>" . $row_country['name'];
                    }
                  }

                echo $tempString2;
                }else{
                  echo "-";
                }
                echo "</td>";
                echo "<td>";
                if($row['city']!='' and $row['city']!='undefined'){
                  for($i=0; $i<count($tempCity); $i++){
                    $query_city = "SELECT * FROM city WHERE id = ".$tempCity[$i];
                    $rs_city=mysqli_query($con,$query_city);
                    $row_city = mysqli_fetch_array($rs_city);
                    if($i==0){
                      $tempString = $tempString . $row_city['name'];
                    }else{
                      $tempString = $tempString . "</br>" . $row_city['name'];
                    }
                  }
                   echo $tempString;
                }else{
                  echo "-";
                }
               
                echo "</td>";
                
                echo "<td>".$row['tour_name']."</br></br>
                ".$row['days']."</br>
                ".$row['departure']."
                </td>
                <td>".$row['tour_type']."</td>
                <td>".$row['category']."</td>
                

                <td>";

                $query_cekdate = "SELECT COUNT(*) as total FROM date_package WHERE tourpackage=".$row['id'];
                $rs_cekdate=mysqli_query($con,$query_cekdate);
                $row_cekdate = mysqli_fetch_assoc($rs_cekdate);
                if($row_cekdate['total']>0){
                  echo "<button type='submit' style='font-size:10px;' onclick='reloadPage(4,".$row['id'].",0)' class='btn btn-success'><i class='fa fa-calendar' aria-hidden='true''></i></button>";
                }else{
                  echo "<button type='submit' style='font-size:10px;' onclick='reloadPage(4,".$row['id'].",0)' class='btn btn-danger'><i class='fa fa-calendar' aria-hidden='true''></i></button>";
                }
                  
                echo "</td>
                <td>".$tempMinPerson."</br>

                 <button type='submit' style='font-size:8px;' onclick='seeDetail(".$row['id'].",".$row['id'].")' class='btn btn-success'>Open</button> <button type='submit' style='font-size:8px;' onclick='closeDetail(".$row['id'].",".$row['id'].")' class='btn btn-danger'>Close</button></td>";
                $queryrating = "SELECT * FROM hotel_rating WHERE id=".$tempHotelRating;
                $rsrating=mysqli_query($con,$queryrating);
                $rowrating = mysqli_fetch_array($rsrating);
                echo "<td>".$rowrating['name']."</td>";
                if($_SESSION['type']==1 or $_SESSION['staff']=="Antonio Chandra"){
                	echo "<td>Rp ".number_format($purchaseprice, 0, ".", ".")."</td>";
                }


                echo "<td>Rp ".number_format($price2, 0, ".", ".")."</td>
                <td>".$rowkurs['name']." ".$tippingPrice."</td>";
                
                echo "<td style='font-size:10px;'><img src='../".$row['img']."' style='height:50px;weight:50px;'>
                </br>";
                for ($x = 0; $x < count($tempBulletTrain); $x++) {
                  if($row_bankbullet['name']=='IDR'){
                    $totalBullet = (int)$tempBulletTrainPrice[$x];
                  }else{
                    $query_kursbullet = "SELECT * FROM kurs_live WHERE name LIKE '".$row_bankbullet['name']."'";
                    $rs_kursbullet=mysqli_query($con,$query_kursbullet);
                    $row_kursbullet = mysqli_fetch_array($rs_kursbullet);

                    $totalBullet = (int)$totalBullet + ((int)$tempBulletTrainPrice[$x]*(int)$row_kursbullet['jual']);
                  }
                  echo $tempBulletTrain[$x]." : Rp ".number_format($totalBullet, 0, ".", ".")."</br>";
                  
                }

                for ($x = 0; $x < count($tempFerry); $x++) {
                  if($row_bankferry['name']=='IDR'){
                    $totalFerry = (int)$tempFerryPrice[$x];
                  }else{
                    $query_kursferry = "SELECT * FROM kurs_live WHERE name LIKE '".$row_bankferry['name']."'";
                    $rs_kursferry=mysqli_query($con,$query_kursferry);
                    $row_kursferry = mysqli_fetch_array($rs_kursferry);

                    $totalFerry = (int)$totalFerry + ((int)$tempFerryPrice[$x]*(int)$row_kursferry['jual']);
                    
                  }
                  echo $tempFerry[$x]." : Rp ".number_format($totalFerry, 0, ".", ".")."</br>";
                  
                }

                
                $query_staff_support = "SELECT * FROM login_staff WHERE id=".$row['staff_support'];
                $rs_staff_support=mysqli_query($con,$query_staff_support);
                $row_staff_support = mysqli_fetch_array($rs_staff_support);

                echo "</td>
                <td>".$row_staff['name']."<br>"; 
                if($row_staff_support['name']!=''){
                  echo "( ".$row_staff_support['name']." )</br>";
                }
                echo $row['timedate']."</br>";
                if($flag=="Active"){
                  echo "<button onclick='updateFlag(".$row['id'].",0);' class='btn btn-success' style='font-size:11px;'>".$flag."</button>";
                }else{
                  echo "<button onclick='updateFlag(".$row['id'].",1);' class='btn btn-danger' style='font-size:11px;'>".$flag."</button>";
                }
                echo "</td>";
                $date = date("Y-m-d");
                $day = substr($rowfiles['updateDate'],8,2);
                $month = substr($rowfiles['updateDate'],5,2);
                $year = substr($rowfiles['updateDate'],0,4);
                $tanggal = $day."-".$month."-".$year;
                if($rowfiles['updateDate']=='0000-00-00'){
                  $tanggal = '-';
                }
                if($date==$rowfiles['updateDate']){
                  echo "<td style='color:red'>".$tanggal."</td>";
                }else{
                  echo "<td>".$tanggal."</td>";
                }
                
                echo "<td>";
                  if($_SESSION['type']==1 or $_SESSION['type']==2){
                    echo "<button type='submit' onclick='reloadPage(-2,".$row['id'].",0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-star' aria-hidden='true'></i></button>";
                  }
                  $cekTourPrice = 0;
                  $query_cekhotel = "SELECT * FROM tour_price_package WHERE tour_package=".$row['id'];
                  $rs_cekhotel=mysqli_query($con,$query_cekhotel);
                  while($row_cekhotel = mysqli_fetch_array($rs_cekhotel)){
                    $query_cekprice = "SELECT COUNT(*) as total FROM tour_price_detail WHERE tour_price_package=".$row_cekhotel['id'];
                    $rs_cekprice=mysqli_query($con,$query_cekprice);
                    $row_cekprice = mysqli_fetch_assoc($rs_cekprice);

                    if($row_cekprice['total']>0){
                      $cekTourPrice = $cekTourPrice + 1;
                    }

                  }

                  if($cekTourPrice>0){
                    echo "<button type='submit' style='font-size:13px;' onclick='reloadPage(2,".$row['id'].",0)' class='btn btn-success'><i class='fa fa-tag' aria-hidden='true''></i></button>";
                  }else{
                    echo "<button type='submit' style='font-size:13px;' onclick='reloadPage(2,".$row['id'].",0)' class='btn btn-danger'><i class='fa fa-tag' aria-hidden='true''></i></button>";
                  }
                  

                  $query_cekitinerary = "SELECT COUNT(*) as total FROM itinerary WHERE tour_package=".$row['id'];
                  $rs_cekitinerary=mysqli_query($con,$query_cekitinerary);
                  $row_cekitinerary = mysqli_fetch_assoc($rs_cekitinerary);

                  $query_cekinclusion = "SELECT COUNT(*) as total FROM inclusion_tourpackage WHERE tour_package=".$row['id'];
                  $rs_cekinclusion=mysqli_query($con,$query_cekinclusion);
                  $row_cekinclusion = mysqli_fetch_assoc($rs_cekinclusion);

                  $query_cekexclusion = "SELECT COUNT(*) as total FROM exclusion_tourpackage WHERE tour_package=".$row['id'];
                  $rs_cekexclusion=mysqli_query($con,$query_cekexclusion);
                  $row_cekexclusion = mysqli_fetch_assoc($rs_cekexclusion);

                  if($row_cekitinerary['total']>0 AND $row_cekinclusion['total']>0 AND $row_cekexclusion['total']>0){
                    echo "<button type='submit' style='font-size:13px;' onclick='reloadPage(1,".$row['id'].",0)' class='btn btn-success'><i class='fa fa-list-alt' aria-hidden='true''></i></button>";
                  }elseif($row_cekitinerary['total']>0 AND $row_cekinclusion['total']==0 AND $row_cekexclusion['total']==0){
                    echo "<button type='submit' style='font-size:13px;' onclick='reloadPage(1,".$row['id'].",0)' class='btn btn-primary'><i class='fa fa-list-alt' aria-hidden='true''></i></button>";
                  }elseif($row_cekitinerary['total']==0 AND $row_cekinclusion['total']>0 AND $row_cekexclusion['total']>0){
                    echo "<button type='submit' style='font-size:13px;' onclick='reloadPage(1,".$row['id'].",0)' class='btn btn-warning'><i class='fa fa-list-alt' aria-hidden='true''></i></button>";
                  }else{
                    echo "<button type='submit' style='font-size:13px;' onclick='reloadPage(1,".$row['id'].",0)' class='btn btn-danger'><i class='fa fa-list-alt' aria-hidden='true''></i></button>";
                  }
                  
                  echo "<button type='submit' onclick='editPage(3,".$row['id'].",".$_POST['id'].",0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='delTourPackage(".$row['id'].",".$_POST['id'].")' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                  
                  

                echo "</td>
                </tr>
                <tr><td colspan='18'><div name='divDetail".$row['id']."' id='divDetail".$row['id']."'></div></td></tr>";

                echo "<script>closeDetail(".$row['id'].",".$row['id'].");</script>";

                }

                echo "
                </tbody>
                </table>

                <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>";
                //echo "Page ".$page_no;
                
                echo "<center>
                <button onclick='MovePage(1)'>Back</button>
                <button onclick='MovePage(2)'>Next</button>
                </center>
                </div>

                ";
?>

<script>
  $(document).ready(function(){
    $(".chosen1").chosen();

     $(document).ajaxStart(function(){
      //$("#wait").css("display", "block");
      $('#divPage').css('opacity', '0.2');

    });
    $(document).ajaxComplete(function(){
      //$("#wait").css("display", "none");
      $('#divPage').css('opacity', '1');
    });
  });

  function closeDetail(x,y){
    $('#hideminperson'+y).hide();
    $('#hidepurchaseprice'+y).hide();
    $('#divDetail'+y).html('');
  }
  function seeDetail(x,y){
   $("#hideminperson"+y).show();
   $('#hidepurchaseprice'+y).show();
   $.ajax({
          type:'POST',
          url:'seepricetourpackage.php',
          data:{'id':y,'tourpricepackage':y},
          success:function(data){
           $('#divDetail'+y).html(data);
         }
       });
  }

  function MovePage(x){
    if(x==0){
      var page_no = <?php echo $page_no; ?>;
      var total_records_per_page = <?php echo $total_records_per_page; ?>;
      var previous_page = <?php echo $previous_page; ?>;
      var next_page = <?php echo $next_page; ?>;
      var cekPageNo = page_no - 1;
      if(cekPageNo > 0){
         $.ajax({
          type:'POST',
          url:'landtourPage.php',
          data:{'typePage':x,'page_no':page_no,'total_records_per_page':total_records_per_page,'previous_page':previous_page,'next_page':next_page},
          success:function(data){
            $('#divPage').html(data);
          }
        });
      }else{
        alert("Tidak Bisa Back Lagi");
      }

    }else{
      var page_no = <?php echo $page_no; ?>;
      var total_records_per_page = <?php echo $total_records_per_page; ?>;
      var previous_page = <?php echo $previous_page; ?>;
      var next_page = <?php echo $next_page; ?>;
      $.ajax({
        type:'POST',
        url:'landtourPage.php',
        data:{'typePage':x,'page_no':page_no,'total_records_per_page':total_records_per_page,'previous_page':previous_page,'next_page':next_page},
        success:function(data){
          $('#divPage').html(data);
        }
      });
    }
   
  }


  function printItineraryStaff(x,y){
    window.open("https://www.2canholiday.com/printLandTourStaff.php?id="+x+"&id_package="+y,"Print");
  }

  function printItineraryPerforma(x,y){
    window.open("https://www.2canholiday.com/printLandTourPerforma.php?id="+x+"&id_package="+y,"Print");
  }

  function filter(x){
    $.ajax({
        url:"searchFilter.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
           $("#divFilter").html(data);
        }
      });
  }
  
  function search(){
    x = document.getElementById("minpersonFilter").value;
    y = document.getElementById("scountry").value;

  }
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
	
  function updateFlag(x,y){
    var txt;
    if(y==0){
      var r = confirm("Are you sure to Deactive this Package?");
    }else{
      var r = confirm("Are you sure to Active this Package?");
    }
    
    if (r == true) {
     $.ajax({
        url:"updateFlag.php",
        method: "POST",
        asynch: false,
        data:{id:x,flag:y},
        success:function(data){
          if(data=="success"){
            reloadPage(0,y,0);
          }else{
            alert("Fail to Update");
          }
        }
      });
    } 
  }
  function delTourPackage(x,y){
    var txt;
    var r = confirm("Are you sure to delete?");
    if (r == true) {
     $.ajax({
        url:"delTourPackage.php",
        method: "POST",
        asynch: false,
        data:{id:x},
        success:function(data){
          if(data=="success"){
            reloadPage(0,y,0);
          }else{
            alert("Fail to Delete");
          }
        }
      });
    } 
  }
</script>

