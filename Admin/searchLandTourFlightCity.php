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


echo "
          <div>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>LAND TOUR</h3>
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

                  <select class='chosen1' name='filterC' id='filterC' onchange='filter(this.value)' class='form-control'>
                    <option selected='selected' value=0>Pilihan Filter</option>
                    <option value='1'>All</option>
                    <option value='2'>Staff</option>
                    <option value='8'>Tanggal Input Data</option>";


                    
                    echo"</select>
                    <div id='divFilter'></div>
                    
                </div>
              </div>
              </div>
              <!-- /.card-header -->
              <div id='myMidBody'>";
            

               
              $query = "SELECT * FROM tour_package ORDER BY dateInsert DESC";
              $rs=mysqli_query($con,$query);
                
                


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
                <th>Min Person</th>
                <th>Hotel Rating</th>";
                
                if($_SESSION['type']==1 or $_SESSION['staff']=="Antonio Chandra"){
                	echo "<th>Purchase Price</th>";
                }
                echo "<th colspan='2'>Selling Price</th>
                <th>Tipping</th>
                
                <th>Img</th>
                <th>Staff</th>
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

                  while ($row_package2 = mysqli_fetch_array($rs_package2)) {
                    $cekPerson = 0;
                    $query_min_price = "SELECT * FROM tour_price_detail WHERE tour_price_package =".$row_package2['id'];
                    $rs_min_price=mysqli_query($con,$query_min_price);

                    while($row_min_price = mysqli_fetch_array($rs_min_price)){
                      if($_POST['flight_type']=='FIT'){
                        if($row_min_price['person']<=10){
                          $cekPerson = $cekPerson + 1;
                        }else{
                          $cekPerson = $cekPerson - 1;
                        }
                      }else{
                        if($row_min_price['person']>=10){
                          $cekPerson = $cekPerson +1;
                        }
                      }
                      
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

                  $cekFlightCity = 0;
                  $countFlightCity = count($tempCity)-1;
                  $tempCity = preg_split ("/[;]+/", $row['city']);
                  $countFlightCity2 = count($tempCity)-1;
                  $cekFlightType = 0;
                  if($_POST['airlines_type']=='Group'){
                    $query_hotel = "SELECT * FROM tour_price_package WHERE tour_package=".$row['id'];
                    $rs_hotel=mysqli_query($con,$query_hotel);
                    while($row_hotel = mysqli_fetch_array($rs_hotel)){
                      $query_pricedetail = "SELECT COUNT(*) as total FROM tour_price_detail WHERE person>=10 AND tour_price_package=".$row_hotel['id'];
                      $rs_pricedetail=mysqli_query($con,$query_pricedetail);
                      $row_pricedetail = mysqli_fetch_assoc($rs_pricedetail);
                      
                      if($row_pricedetail['total']==0){
                        $cekFlightType = $cekFlightType + 1;
                      }
                      
                    }

                  }
                  $cekOut = 0;
                  if($_POST['city_out']==-1){
                    $queryOut = $tempCity[$countFlightCity]."==".$tempCity[$countFlightCity];
                    if($tempCity[$countFlightCity]==$tempCity[$countFlightCity]){
                      $cekOut = $cekOut + 1;
                    }
                  }else{
                    $queryOut = $tempCity[$countFlightCity]."==".$_POST['city_out'];
                    if($tempCity[$countFlightCity]==$_POST['city_out']){
                      $cekOut = $cekOut + 1;
                    }
                  }
                  $cekTo = 0;

                  if($_POST['city_to']==0){
                    for($i=0; $i<count($tempCountry); $i++){
                      if($tempCountry[$i]==$_POST['country_to']){
                        $cekTo = $cekTo + 1;

                      }
                    }

                  }else{
                    if($tempCity[0]==$_POST['city_to']){
                      $cekTo = $cekTO + 1;
                    }
                  }

                  // if($_POST['flight_type']=='FIT'){
                  //   $cekPerson = 1;
                  // }
                  
                  
                  if($cekTo > 0 AND $cekOut > 0 AND $cekFlightType==0 AND $cekPerson>0){


                echo"
                <tr style='font-weight:bold;'>";
                echo "<td>888".$row['id']."</br></br>
                <input type='text' name='airlines_type".$row['id']."' value='".$_POST['airlines_type']."' hidden>
                <input type='text' name='flight_type".$row['id']."' value='".$_POST['flight_type']."' hidden>
                <input type='text' name='type_price".$row['id']."' value='".$_POST['type_price']."' hidden>
                <input type='text' name='city_from' value='".$_POST['city_from']."' hidden>
                <button type='submit' style='font-size:10px;' onclick='printItineraryStaff(2,".$row['id'].",".$_POST['airlines_id'].",".$_POST['country_to'].",".$_POST['city_to'].",".$_POST['city_out'].")' class='btn btn-primary'>Sell Tour Brosur</button></br></br>";
                if($_SESSION['type']==1 or $_SESSION['type']==2){
                  echo "<button type='submit' style='font-size:10px;' onclick='printItineraryPerforma(2,".$row['id'].",".$_POST['airlines_id'].",".$_POST['country_to'].",".$_POST['city_to'].",".$_POST['city_out'].")' class='btn btn-primary'>Buy&Sell Tour Brosur</button>";
                }
                echo "</td>";
                echo "<td>".$row['agent']."-".$row['tour_files']."</br></br>
                 <button type='submit' style='font-size:10px;' onclick='printItineraryTLStaff(2,".$row['id'].",".$_POST['airlines_id'].",".$_POST['country_to'].",".$_POST['city_to'].",".$_POST['city_out'].")' class='btn btn-primary'>Sell Tour Brosur include 1 TL</button></br></br>";
                if($_SESSION['type']==1 or $_SESSION['type']==2){
                  echo "<button type='submit' style='font-size:10px;' onclick='printItineraryTLPerforma(2,".$row['id'].",".$_POST['airlines_id'].",".$_POST['country_to'].",".$_POST['city_to'].",".$_POST['city_out'].")' class='btn btn-primary'>Buy&Sell Tour Brosur Include 1 TL</button>";
                }
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
                

                <td>".$tempMinPerson."</br>

                 <button type='submit' style='font-size:8px;' onclick='seeDetail(".$row['id'].",".$row['id'].")' class='btn btn-success'>Open</button> <button type='submit' style='font-size:8px;' onclick='closeDetail(".$row['id'].",".$row['id'].")' class='btn btn-danger'>Close</button></td>";
                $queryrating = "SELECT * FROM hotel_rating WHERE id=".$tempHotelRating;
                $rsrating=mysqli_query($con,$queryrating);
                $rowrating = mysqli_fetch_array($rsrating);
                echo "<td>".$rowrating['name']."</td>";
                if($_SESSION['type']==1 or $_SESSION['staff']=="Antonio Chandra"){
                	echo "<td>Rp ".number_format($purchaseprice, 0, ".", ".")."</td>";
                }

                  //flightprice
                if($_POST['airlines_id']==0){
                  $airlinesArray = json_decode(stripslashes($_POST['airlinesArray']));
                  $tempPrice = 99999999999;
                  $tempAirlinesID = 0;
                  for ($x = 0; $x < count($airlinesArray); $x++) {
                    if($airlinesArray[$x]!=0 OR $airlinesArray[$x]!='0'){
                      if($_POST['city_to']==0){
                        $queryTo = "country_to=".$_POST ['country_to'];
                      }else{
                        $queryTo = "city_to=".$_POST['city_to'];
                      }
                      if($_POST['city_out']=='-1'){
                        $query_ceklowestprice = "SELECT * FROM flight_quotation WHERE ".$queryTo." AND airlines_id = ".$airlinesArray[$x]." AND flight_type LIKE '".$_POST['flight_type']."' AND type LIKE '".$_POST['type_price']."'";
                      }else{
                        $query_ceklowestprice = "SELECT * FROM flight_quotation WHERE ".$queryTo." AND city_out = ".$_POST['city_out']." AND airlines_id = ".$airlinesArray[$x]." AND flight_type LIKE '".$_POST['flight_type']."' AND type LIKE '".$_POST['type_price']."'";
                      }
                      
                      $rs_ceklowestprice=mysqli_query($con,$query_ceklowestprice);
                      $row_ceklowestprice = mysqli_fetch_array($rs_ceklowestprice);
                      if($row_ceklowestprice['kurs_price']=='IDR'){
                        $flight_adt_price = $row_ceklowestprice['adt_price'] + $row_ceklowestprice['adt_tax'];
                      }else{
                        $query_kursflight = "SELECT * FROM kurs_live WHERE name LIKE '".$row_ceklowestprice['kurs_price']."'";
                        $rs_kursflight=mysqli_query($con,$query_kursflight);
                        $row_kursflight = mysqli_fetch_array($rs_kursflight);
                        $flightAdt = $row_ceklowestprice['adt_price'] * $row_kursflight['jual'];
                        $flightAdtTax = $row_ceklowestprice['adt_tax'] * $row_kursflight['jual'];
                        $flight_adt_price = $flightAdt + $flightAdtTax;
                      }
                      
                      if($tempPrice<=$flight_adt_price){
                        $tempPrice = $tempPrice;
                      }else{
                        $tempPrice = $flight_adt_price;
                        $tempAirlinesID = $airlinesArray[$x];
                        
                      }
                    }


                  }
                   
                  $airlines_id = $tempAirlinesID;


                }else{
                  $airlines_id = $_POST['airlines_id'];
                }
                if($_POST['city_to']==0){
                  $queryTo = "country_to=".$_POST ['country_to'];
                }else{
                  $queryTo = "city_to=".$_POST['city_to'];
                }
                if($_POST['city_out']=='-1'){
                  $query_flightquotation = "SELECT * FROM flight_quotation WHERE ".$queryTo." AND airlines_id = ".$airlines_id." AND flight_type LIKE '".$_POST['flight_type']."' AND type LIKE '".$_POST['type_price']."'";
                }else{
                  $query_flightquotation = "SELECT * FROM flight_quotation WHERE ".$queryTo." AND city_out = ".$_POST['city_out']." AND airlines_id = ".$airlines_id." AND flight_type LIKE '".$_POST['flight_type']."' AND type LIKE '".$_POST['type_price']."'";
                }
                $rs_flightquotation=mysqli_query($con,$query_flightquotation);
                $row_flightquotation = mysqli_fetch_array($rs_flightquotation);
                                    if($tempMinPerson>=15 AND $tempMinPerson<=19 AND $row_flightquotation['total_foc']>0){

                                      if($row_flightquotation['kurs_price']=='IDR'){

                                        //
                                       $flight_adt_price = $row_flightquotation['adt_price'] + $row_flightquotation['adt_tax'];
                                       $flight_chd_price = $row_flightquotation['chd_price'] + $row_flightquotation['chd_tax'];
                                       $flight_inf_price = $row_flightquotation['inf_price'] + $row_flightquotation['inf_tax'];


                                        //start
                                   $query_range_flight = "SELECT * FROM performa_price_range_flight";
                                   $rs_range_flight=mysqli_query($con,$query_range_flight);
                                   $pId_flight_adt = 0;


                                   while($row_range_flight = mysqli_fetch_array($rs_range_flight)){
                                    if($row_range_flight['price2']==1){
                                      if($flight_adt_price<=$row_range_flight['price1']){
                                        $pId_flight_adt = $row_range_flight['id'];
                                      }
                                    }else if($row_range_flight['price2']==0){
                                      if($flight_adt_price>=$row_range_flight['price1']){
                                        $pId_flight_adt = $row_range_flight['id'];
                                      }
                                    }else{
                                      if($flight_adt_price>$row_range_flight['price1'] && $flight_adt_price<=$row_range_flight['price2']){
                                        $pId_flight_adt = $row_range_flight['id'];
                                      }

                                    }

                                  }
                                  $query_performa_flight_adt = "SELECT * FROM performa_price_standart_flight WHERE performa_price_range_flight=".$pId_flight_adt." AND flight_type LIKE '".$_POST['flight_type']."'";
                                  $rs_performa_flight_adt=mysqli_query($con,$query_performa_flight_adt);
                                  $row_performa_flight_adt = mysqli_fetch_array($rs_performa_flight_adt);

                                  $query_range_flight = "SELECT * FROM performa_price_range_flight";
                                  $rs_range_flight=mysqli_query($con,$query_range_flight);
                                  $pId_flight_chd = 0;


                                  while($row_range_flight = mysqli_fetch_array($rs_range_flight)){
                                    if($row_range_flight['price2']==1){
                                      if($flight_chd_price<=$row_range_flight['price1']){
                                        $pId_flight_chd = $row_range_flight['id'];
                                      }
                                    }else if($row_range_flight['price2']==0){
                                      if($flight_chd_price>=$row_range_flight['price1']){
                                        $pId_flight_chd = $row_range_flight['id'];
                                      }
                                    }else{
                                      if($flight_chd_price>$row_range_flight['price1'] && $flight_chd_price<=$row_range_flight['price2']){
                                        $pId_flight_chd = $row_range_flight['id'];
                                      }

                                    }

                                  }
                                  $query_performa_flight_chd = "SELECT * FROM performa_price_standart_flight WHERE performa_price_range_flight=".$pId_flight_chd." AND flight_type LIKE '".$_POST['flight_type']."'";
                                  $rs_performa_flight_chd=mysqli_query($con,$query_performa_flight_chd);
                                  $row_performa_flight_chd = mysqli_fetch_array($rs_performa_flight_chd);

                                  $query_range_flight = "SELECT * FROM performa_price_range_flight";
                                  $rs_range_flight=mysqli_query($con,$query_range_flight);
                                  $pId_flight_inf = 0;


                                  while($row_range_flight = mysqli_fetch_array($rs_range_flight)){
                                    if($row_range_flight['price2']==1){
                                      if($flight_inf_price<=$row_range_flight['price1']){
                                        $pId_flight_inf = $row_range_flight['id'];
                                      }
                                    }else if($row_range_flight['price2']==0){
                                      if($flight_inf_price>=$row_range_flight['price1']){
                                        $pId_flight_inf = $row_range_flight['id'];
                                      }
                                    }else{
                                      if($flight_inf_price>$row_range_flight['price1'] && $flight_inf_price<=$row_range_flight['price2']){
                                        $pId_flight_inf = $row_range_flight['id'];
                                      }

                                    }

                                  }
                                  $query_performa_flight_inf = "SELECT * FROM performa_price_standart_flight WHERE performa_price_range_flight=".$pId_flight_inf." AND flight_type LIKE '".$_POST['flight_type']."'";
                                  $rs_performa_flight_inf=mysqli_query($con,$query_performa_flight_inf);
                                  $row_performa_flight_inf = mysqli_fetch_array($rs_performa_flight_inf);
                                      //end


                                      
                                  if($row_performa_flight_adt['option_price'] == 1){
                                    $flight_adt_price = $flight_adt_price + ($flight_adt_price * $row_performa_flight_adt['persentase']/100);
                                  }elseif ($row_performa_flight_adt['option_price'] == 2) {
                                    $flight_adt_price = $flight_adt_price + $row_performa_flight_adt['nominal'];
                                  }
                                  if($row_performa_flight_chd['option_price'] == 1){
                                    $flight_chd_price = $flight_chd_price + ($flight_chd_price * $row_performa_flight_chd['persentase']/100);
                                  }elseif ($row_performa_flight_chd['option_price'] == 2) {
                                    $flight_chd_price = $flight_chd_price + $row_performa_flight_chd['nominal'];
                                  }
                                  if($row_performa_flight_inf['option_price'] == 1){
                                    $flight_inf_price = $flight_inf_price + ($flight_inf_price * $row_performa_flight_inf['persentase']/100);
                                  }elseif ($row_performa_flight_chd['option_price'] == 2) {
                                    $flight_inf_price = $flight_inf_price + $row_performa_flight_inf['nominal'];
                                  }
                                      //

                                      $flightAdt = ($flight_adt_price * ($row_flightquotation['total_seat'] + $row['personplus2']) / ($row_flightquotation['total_foc'] + $row_flightquotation['total_seat'])) + (($row_flightquotation['tax_foc']*$row_flightquotation['total_foc'])/$tempMinPerson) ;
                                      $flightChd = ($flight_chd_price * ($row_flightquotation['total_seat'] + $row['personplus2']) / ($row_flightquotation['total_foc'] + $row_flightquotation['total_seat'])) + (($row_flightquotation['tax_foc']*$row_flightquotation['total_foc'])/$tempMinPerson) ;
                                      $flightInf = ($flight_inf_price * ($row_flightquotation['total_seat'] + $row['personplus2']) / ($row_flightquotation['total_foc'] + $row_flightquotation['total_seat'])) + (($row_flightquotation['tax_foc']*$row_flightquotation['total_foc'])/$tempMinPerson) ;

                                    }else{
                                      $query_kursflight = "SELECT * FROM kurs_live WHERE name LIKE '".$row_flightquotation['kurs_price']."'";
                                      $rs_kursflight=mysqli_query($con,$query_kursflight);
                                      $row_kursflight = mysqli_fetch_array($rs_kursflight);

                                        //

                                      $flightAdt = $row_flightquotation['adt_price'] * $row_kursflight['jual'];
                                      $flightChd = $row_flightquotation['chd_price'] * $row_kursflight['jual'];
                                      $flightInf = $row_flightquotation['inf_price'] * $row_kursflight['jual'];

                                      $flightAdtTax = $row_flightquotation['adt_tax'] * $row_kursflight['jual'];
                                      $flightChdTax = $row_flightquotation['chd_tax'] * $row_kursflight['jual'];
                                      $flightInfTax = $row_flightquotation['inf_tax'] * $row_kursflight['jual'];

                                      $flight_adt_price = $flightAdt + $flightAdtTax;
                                      $flight_chd_price = $flightChd + $flightChdTax;
                                      $flight_inf_price = $flightInf + $flightInfTax;

                                          //start
                                   $query_range_flight = "SELECT * FROM performa_price_range_flight";
                                   $rs_range_flight=mysqli_query($con,$query_range_flight);
                                   $pId_flight_adt = 0;


                                   while($row_range_flight = mysqli_fetch_array($rs_range_flight)){
                                    if($row_range_flight['price2']==1){
                                      if($flight_adt_price<=$row_range_flight['price1']){
                                        $pId_flight_adt = $row_range_flight['id'];
                                      }
                                    }else if($row_range_flight['price2']==0){
                                      if($flight_adt_price>=$row_range_flight['price1']){
                                        $pId_flight_adt = $row_range_flight['id'];
                                      }
                                    }else{
                                      if($flight_adt_price>$row_range_flight['price1'] && $flight_adt_price<=$row_range_flight['price2']){
                                        $pId_flight_adt = $row_range_flight['id'];
                                      }

                                    }

                                  }
                                  $query_performa_flight_adt = "SELECT * FROM performa_price_standart_flight WHERE performa_price_range_flight=".$pId_flight_adt." AND flight_type LIKE '".$_POST['flight_type']."'";
                                  $rs_performa_flight_adt=mysqli_query($con,$query_performa_flight_adt);
                                  $row_performa_flight_adt = mysqli_fetch_array($rs_performa_flight_adt);

                                  $query_range_flight = "SELECT * FROM performa_price_range_flight";
                                  $rs_range_flight=mysqli_query($con,$query_range_flight);
                                  $pId_flight_chd = 0;


                                  while($row_range_flight = mysqli_fetch_array($rs_range_flight)){
                                    if($row_range_flight['price2']==1){
                                      if($flight_chd_price<=$row_range_flight['price1']){
                                        $pId_flight_chd = $row_range_flight['id'];
                                      }
                                    }else if($row_range_flight['price2']==0){
                                      if($flight_chd_price>=$row_range_flight['price1']){
                                        $pId_flight_chd = $row_range_flight['id'];
                                      }
                                    }else{
                                      if($flight_chd_price>$row_range_flight['price1'] && $flight_chd_price<=$row_range_flight['price2']){
                                        $pId_flight_chd = $row_range_flight['id'];
                                      }

                                    }

                                  }
                                  $query_performa_flight_chd = "SELECT * FROM performa_price_standart_flight WHERE performa_price_range_flight=".$pId_flight_chd." AND flight_type LIKE '".$_POST['flight_type']."'";
                                  $rs_performa_flight_chd=mysqli_query($con,$query_performa_flight_chd);
                                  $row_performa_flight_chd = mysqli_fetch_array($rs_performa_flight_chd);

                                  $query_range_flight = "SELECT * FROM performa_price_range_flight";
                                  $rs_range_flight=mysqli_query($con,$query_range_flight);
                                  $pId_flight_inf = 0;


                                  while($row_range_flight = mysqli_fetch_array($rs_range_flight)){
                                    if($row_range_flight['price2']==1){
                                      if($flight_inf_price<=$row_range_flight['price1']){
                                        $pId_flight_inf = $row_range_flight['id'];
                                      }
                                    }else if($row_range_flight['price2']==0){
                                      if($flight_inf_price>=$row_range_flight['price1']){
                                        $pId_flight_inf = $row_range_flight['id'];
                                      }
                                    }else{
                                      if($flight_inf_price>$row_range_flight['price1'] && $flight_inf_price<=$row_range_flight['price2']){
                                        $pId_flight_inf = $row_range_flight['id'];
                                      }

                                    }

                                  }
                                  $query_performa_flight_inf = "SELECT * FROM performa_price_standart_flight WHERE performa_price_range_flight=".$pId_flight_inf." AND flight_type LIKE '".$_POST['flight_type']."'";
                                  $rs_performa_flight_inf=mysqli_query($con,$query_performa_flight_inf);
                                  $row_performa_flight_inf = mysqli_fetch_array($rs_performa_flight_inf);
                                      //end


                                     
                                  if($row_performa_flight_adt['option_price'] == 1){
                                    $flight_adt_price = $flight_adt_price + ($flight_adt_price * $row_performa_flight_adt['persentase']/100);
                                  }elseif ($row_performa_flight_adt['option_price'] == 2) {
                                    $flight_adt_price = $flight_adt_price + $row_performa_flight_adt['nominal'];
                                  }
                                  if($row_performa_flight_chd['option_price'] == 1){
                                    $flight_chd_price = $flight_chd_price + ($flight_chd_price * $row_performa_flight_chd['persentase']/100);
                                  }elseif ($row_performa_flight_chd['option_price'] == 2) {
                                    $flight_chd_price = $flight_chd_price + $row_performa_flight_chd['nominal'];
                                  }
                                  if($row_performa_flight_inf['option_price'] == 1){
                                    $flight_inf_price = $flight_inf_price + ($flight_inf_price * $row_performa_flight_inf['persentase']/100);
                                  }elseif ($row_performa_flight_chd['option_price'] == 2) {
                                    $flight_inf_price = $flight_inf_price + $row_performa_flight_inf['nominal'];
                                  }

                                        //


                                      $flightAdt = ($flight_adt_price * ($row_flightquotation['total_seat'] + $row['personplus2']) / ($row_flightquotation['total_foc'] + $row_flightquotation['total_seat'])) + (($row_flightquotation['tax_foc']*$row_flightquotation['total_foc'])/$tempMinPerson) ;
                                      $flightChd = ($flight_chd_price * ($row_flightquotation['total_seat'] + $row['personplus2']) / ($row_flightquotation['total_foc'] + $row_flightquotation['total_seat'])) + (($row_flightquotation['tax_foc']*$row_flightquotation['total_foc'])/$tempMinPerson) ;
                                      $flightInf = ($flight_inf_price * ($row_flightquotation['total_seat'] + $row['personplus2']) / ($row_flightquotation['total_foc'] + $row_flightquotation['total_seat'])) + (($row_flightquotation['tax_foc']*$row_flightquotation['total_foc'])/$tempMinPerson) ;

                                    }

                                  }elseif($tempMinPerson>=20){

                                    if($row_flightquotation['kurs_price']=='IDR'){

                                        //
                                     $flight_adt_price = $row_flightquotation['adt_price'] + $row_flightquotation['adt_tax'];
                                     $flight_chd_price = $row_flightquotation['chd_price'] + $row_flightquotation['chd_tax'];
                                     $flight_inf_price = $row_flightquotation['inf_price'] + $row_flightquotation['inf_tax'];


                                         //start
                                   $query_range_flight = "SELECT * FROM performa_price_range_flight";
                                   $rs_range_flight=mysqli_query($con,$query_range_flight);
                                   $pId_flight_adt = 0;


                                   while($row_range_flight = mysqli_fetch_array($rs_range_flight)){
                                    if($row_range_flight['price2']==1){
                                      if($flight_adt_price<=$row_range_flight['price1']){
                                        $pId_flight_adt = $row_range_flight['id'];
                                      }
                                    }else if($row_range_flight['price2']==0){
                                      if($flight_adt_price>=$row_range_flight['price1']){
                                        $pId_flight_adt = $row_range_flight['id'];
                                      }
                                    }else{
                                      if($flight_adt_price>$row_range_flight['price1'] && $flight_adt_price<=$row_range_flight['price2']){
                                        $pId_flight_adt = $row_range_flight['id'];
                                      }

                                    }

                                  }
                                  $query_performa_flight_adt = "SELECT * FROM performa_price_standart_flight WHERE performa_price_range_flight=".$pId_flight_adt." AND flight_type LIKE '".$_POST['flight_type']."'";
                                  $rs_performa_flight_adt=mysqli_query($con,$query_performa_flight_adt);
                                  $row_performa_flight_adt = mysqli_fetch_array($rs_performa_flight_adt);

                                  $query_range_flight = "SELECT * FROM performa_price_range_flight";
                                  $rs_range_flight=mysqli_query($con,$query_range_flight);
                                  $pId_flight_chd = 0;


                                  while($row_range_flight = mysqli_fetch_array($rs_range_flight)){
                                    if($row_range_flight['price2']==1){
                                      if($flight_chd_price<=$row_range_flight['price1']){
                                        $pId_flight_chd = $row_range_flight['id'];
                                      }
                                    }else if($row_range_flight['price2']==0){
                                      if($flight_chd_price>=$row_range_flight['price1']){
                                        $pId_flight_chd = $row_range_flight['id'];
                                      }
                                    }else{
                                      if($flight_chd_price>$row_range_flight['price1'] && $flight_chd_price<=$row_range_flight['price2']){
                                        $pId_flight_chd = $row_range_flight['id'];
                                      }

                                    }

                                  }
                                  $query_performa_flight_chd = "SELECT * FROM performa_price_standart_flight WHERE performa_price_range_flight=".$pId_flight_chd." AND flight_type LIKE '".$_POST['flight_type']."'";
                                  $rs_performa_flight_chd=mysqli_query($con,$query_performa_flight_chd);
                                  $row_performa_flight_chd = mysqli_fetch_array($rs_performa_flight_chd);

                                  $query_range_flight = "SELECT * FROM performa_price_range_flight";
                                  $rs_range_flight=mysqli_query($con,$query_range_flight);
                                  $pId_flight_inf = 0;


                                  while($row_range_flight = mysqli_fetch_array($rs_range_flight)){
                                    if($row_range_flight['price2']==1){
                                      if($flight_inf_price<=$row_range_flight['price1']){
                                        $pId_flight_inf = $row_range_flight['id'];
                                      }
                                    }else if($row_range_flight['price2']==0){
                                      if($flight_inf_price>=$row_range_flight['price1']){
                                        $pId_flight_inf = $row_range_flight['id'];
                                      }
                                    }else{
                                      if($flight_inf_price>$row_range_flight['price1'] && $flight_inf_price<=$row_range_flight['price2']){
                                        $pId_flight_inf = $row_range_flight['id'];
                                      }

                                    }

                                  }
                                  $query_performa_flight_inf = "SELECT * FROM performa_price_standart_flight WHERE performa_price_range_flight=".$pId_flight_inf." AND flight_type LIKE '".$_POST['flight_type']."'";
                                  $rs_performa_flight_inf=mysqli_query($con,$query_performa_flight_inf);
                                  $row_performa_flight_inf = mysqli_fetch_array($rs_performa_flight_inf);
                                      //end

                                  if($row_performa_flight_adt['option_price'] == 1){
                                    $flight_adt_price = $flight_adt_price + ($flight_adt_price * $row_performa_flight_adt['persentase']/100);
                                  }elseif ($row_performa_flight_adt['option_price'] == 2) {
                                    $flight_adt_price = $flight_adt_price + $row_performa_flight_adt['nominal'];
                                  }
                                  if($row_performa_flight_chd['option_price'] == 1){
                                    $flight_chd_price = $flight_chd_price + ($flight_chd_price * $row_performa_flight_chd['persentase']/100);
                                  }elseif ($row_performa_flight_chd['option_price'] == 2) {
                                    $flight_chd_price = $flight_chd_price + $row_performa_flight_chd['nominal'];
                                  }
                                  if($row_performa_flight_inf['option_price'] == 1){
                                    $flight_inf_price = $flight_inf_price + ($flight_inf_price * $row_performa_flight_inf['persentase']/100);
                                  }elseif ($row_performa_flight_chd['option_price'] == 2) {
                                    $flight_inf_price = $flight_inf_price + $row_performa_flight_inf['nominal'];
                                  }
                                      //

                                    $flightAdt = ($flight_adt_price * ($row_flightquotation['total_seat'] + $row['personplus2']) / ($row_flightquotation['total_foc'] + $row_flightquotation['total_seat'])) + (($row_flightquotation['tax_foc']*$row_flightquotation['total_foc'])/$tempMinPerson) ;
                                    $flightChd = ($flight_chd_price * ($row_flightquotation['total_seat'] + $row['personplus2']) / ($row_flightquotation['total_foc'] + $row_flightquotation['total_seat'])) + (($row_flightquotation['tax_foc']*$row_flightquotation['total_foc'])/$tempMinPerson) ;
                                    $flightInf = ($flight_inf_price * ($row_flightquotation['total_seat'] + $row['personplus2']) / ($row_flightquotation['total_foc'] + $row_flightquotation['total_seat'])) + (($row_flightquotation['tax_foc']*$row_flightquotation['total_foc'])/$tempMinPerson) ;

                                  }else{
                                    $query_kursflight = "SELECT * FROM kurs_live WHERE name LIKE '".$row_flightquotation['kurs_price']."'";
                                    $rs_kursflight=mysqli_query($con,$query_kursflight);
                                    $row_kursflight = mysqli_fetch_array($rs_kursflight);

                                        //

                                    $flightAdt = $row_flightquotation['adt_price'] * $row_kursflight['jual'];
                                    $flightChd = $row_flightquotation['chd_price'] * $row_kursflight['jual'];
                                    $flightInf = $row_flightquotation['inf_price'] * $row_kursflight['jual'];

                                    $flightAdtTax = $row_flightquotation['adt_tax'] * $row_kursflight['jual'];
                                    $flightChdTax = $row_flightquotation['chd_tax'] * $row_kursflight['jual'];
                                    $flightInfTax = $row_flightquotation['inf_tax'] * $row_kursflight['jual'];

                                    $flight_adt_price = $flightAdt + $flightAdtTax;
                                    $flight_chd_price = $flightChd + $flightChdTax;
                                    $flight_inf_price = $flightInf + $flightInfTax;

                                           //start
                                   $query_range_flight = "SELECT * FROM performa_price_range_flight";
                                   $rs_range_flight=mysqli_query($con,$query_range_flight);
                                   $pId_flight_adt = 0;


                                   while($row_range_flight = mysqli_fetch_array($rs_range_flight)){
                                    if($row_range_flight['price2']==1){
                                      if($flight_adt_price<=$row_range_flight['price1']){
                                        $pId_flight_adt = $row_range_flight['id'];
                                      }
                                    }else if($row_range_flight['price2']==0){
                                      if($flight_adt_price>=$row_range_flight['price1']){
                                        $pId_flight_adt = $row_range_flight['id'];
                                      }
                                    }else{
                                      if($flight_adt_price>$row_range_flight['price1'] && $flight_adt_price<=$row_range_flight['price2']){
                                        $pId_flight_adt = $row_range_flight['id'];
                                      }

                                    }

                                  }
                                  $query_performa_flight_adt = "SELECT * FROM performa_price_standart_flight WHERE performa_price_range_flight=".$pId_flight_adt." AND flight_type LIKE '".$_POST['flight_type']."'";
                                  $rs_performa_flight_adt=mysqli_query($con,$query_performa_flight_adt);
                                  $row_performa_flight_adt = mysqli_fetch_array($rs_performa_flight_adt);

                                  $query_range_flight = "SELECT * FROM performa_price_range_flight";
                                  $rs_range_flight=mysqli_query($con,$query_range_flight);
                                  $pId_flight_chd = 0;


                                  while($row_range_flight = mysqli_fetch_array($rs_range_flight)){
                                    if($row_range_flight['price2']==1){
                                      if($flight_chd_price<=$row_range_flight['price1']){
                                        $pId_flight_chd = $row_range_flight['id'];
                                      }
                                    }else if($row_range_flight['price2']==0){
                                      if($flight_chd_price>=$row_range_flight['price1']){
                                        $pId_flight_chd = $row_range_flight['id'];
                                      }
                                    }else{
                                      if($flight_chd_price>$row_range_flight['price1'] && $flight_chd_price<=$row_range_flight['price2']){
                                        $pId_flight_chd = $row_range_flight['id'];
                                      }

                                    }

                                  }
                                  $query_performa_flight_chd = "SELECT * FROM performa_price_standart_flight WHERE performa_price_range_flight=".$pId_flight_chd." AND flight_type LIKE '".$_POST['flight_type']."'";
                                  $rs_performa_flight_chd=mysqli_query($con,$query_performa_flight_chd);
                                  $row_performa_flight_chd = mysqli_fetch_array($rs_performa_flight_chd);

                                  $query_range_flight = "SELECT * FROM performa_price_range_flight";
                                  $rs_range_flight=mysqli_query($con,$query_range_flight);
                                  $pId_flight_inf = 0;


                                  while($row_range_flight = mysqli_fetch_array($rs_range_flight)){
                                    if($row_range_flight['price2']==1){
                                      if($flight_inf_price<=$row_range_flight['price1']){
                                        $pId_flight_inf = $row_range_flight['id'];
                                      }
                                    }else if($row_range_flight['price2']==0){
                                      if($flight_inf_price>=$row_range_flight['price1']){
                                        $pId_flight_inf = $row_range_flight['id'];
                                      }
                                    }else{
                                      if($flight_inf_price>$row_range_flight['price1'] && $flight_inf_price<=$row_range_flight['price2']){
                                        $pId_flight_inf = $row_range_flight['id'];
                                      }

                                    }

                                  }
                                  $query_performa_flight_inf = "SELECT * FROM performa_price_standart_flight WHERE performa_price_range_flight=".$pId_flight_inf." AND flight_type LIKE '".$_POST['flight_type']."'";
                                  $rs_performa_flight_inf=mysqli_query($con,$query_performa_flight_inf);
                                  $row_performa_flight_inf = mysqli_fetch_array($rs_performa_flight_inf);
                                      //end

                                
                                  if($row_performa_flight_adt['option_price'] == 1){
                                    $flight_adt_price = $flight_adt_price + ($flight_adt_price * $row_performa_flight_adt['persentase']/100);
                                  }elseif ($row_performa_flight_adt['option_price'] == 2) {
                                    $flight_adt_price = $flight_adt_price + $row_performa_flight_adt['nominal'];
                                  }
                                  if($row_performa_flight_chd['option_price'] == 1){
                                    $flight_chd_price = $flight_chd_price + ($flight_chd_price * $row_performa_flight_chd['persentase']/100);
                                  }elseif ($row_performa_flight_chd['option_price'] == 2) {
                                    $flight_chd_price = $flight_chd_price + $row_performa_flight_chd['nominal'];
                                  }
                                  if($row_performa_flight_inf['option_price'] == 1){
                                    $flight_inf_price = $flight_inf_price + ($flight_inf_price * $row_performa_flight_inf['persentase']/100);
                                  }elseif ($row_performa_flight_chd['option_price'] == 2) {
                                    $flight_inf_price = $flight_inf_price + $row_performa_flight_inf['nominal'];
                                  }

                                        //


                                    $flightAdt = ($flight_adt_price * ($row_flightquotation['total_seat'] + $row['personplus2']) / ($row_flightquotation['total_foc'] + $row_flightquotation['total_seat'])) + (($row_flightquotation['tax_foc']*$row_flightquotation['total_foc'])/$tempMinPerson) ;
                                    $flightChd = ($flight_chd_price * ($row_flightquotation['total_seat'] + $row['personplus2']) / ($row_flightquotation['total_foc'] + $row_flightquotation['total_seat'])) + (($row_flightquotation['tax_foc']*$row_flightquotation['total_foc'])/$tempMinPerson) ;
                                    $flightInf = ($flight_inf_price * ($row_flightquotation['total_seat'] + $row['personplus2']) / ($row_flightquotation['total_foc'] + $row_flightquotation['total_seat'])) + (($row_flightquotation['tax_foc']*$row_flightquotation['total_foc'])/$tempMinPerson) ;

                                  }

                                }else{

                                  if($row_flightquotation['kurs_price']=='IDR'){
                                   $flight_adt_price = $row_flightquotation['adt_price'] + $row_flightquotation['adt_tax'];
                                   $flight_chd_price = $row_flightquotation['chd_price'] + $row_flightquotation['chd_tax'];
                                   $flight_inf_price = $row_flightquotation['inf_price'] + $row_flightquotation['inf_tax'];

                                        //start
                                   $query_range_flight = "SELECT * FROM performa_price_range_flight";
                                   $rs_range_flight=mysqli_query($con,$query_range_flight);
                                   $pId_flight_adt = 0;


                                   while($row_range_flight = mysqli_fetch_array($rs_range_flight)){
                                    if($row_range_flight['price2']==1){
                                      if($flight_adt_price<=$row_range_flight['price1']){
                                        $pId_flight_adt = $row_range_flight['id'];
                                      }
                                    }else if($row_range_flight['price2']==0){
                                      if($flight_adt_price>=$row_range_flight['price1']){
                                        $pId_flight_adt = $row_range_flight['id'];
                                      }
                                    }else{
                                      if($flight_adt_price>$row_range_flight['price1'] && $flight_adt_price<=$row_range_flight['price2']){
                                        $pId_flight_adt = $row_range_flight['id'];
                                      }

                                    }

                                  }
                                  $query_performa_flight_adt = "SELECT * FROM performa_price_standart_flight WHERE performa_price_range_flight=".$pId_flight_adt." AND flight_type LIKE '".$_POST['flight_type']."'";
                                  $rs_performa_flight_adt=mysqli_query($con,$query_performa_flight_adt);
                                  $row_performa_flight_adt = mysqli_fetch_array($rs_performa_flight_adt);

                                  $query_range_flight = "SELECT * FROM performa_price_range_flight";
                                  $rs_range_flight=mysqli_query($con,$query_range_flight);
                                  $pId_flight_chd = 0;


                                  while($row_range_flight = mysqli_fetch_array($rs_range_flight)){
                                    if($row_range_flight['price2']==1){
                                      if($flight_chd_price<=$row_range_flight['price1']){
                                        $pId_flight_chd = $row_range_flight['id'];
                                      }
                                    }else if($row_range_flight['price2']==0){
                                      if($flight_chd_price>=$row_range_flight['price1']){
                                        $pId_flight_chd = $row_range_flight['id'];
                                      }
                                    }else{
                                      if($flight_chd_price>$row_range_flight['price1'] && $flight_chd_price<=$row_range_flight['price2']){
                                        $pId_flight_chd = $row_range_flight['id'];
                                      }

                                    }

                                  }
                                  $query_performa_flight_chd = "SELECT * FROM performa_price_standart_flight WHERE performa_price_range_flight=".$pId_flight_chd." AND flight_type LIKE '".$_POST['flight_type']."'";
                                  $rs_performa_flight_chd=mysqli_query($con,$query_performa_flight_chd);
                                  $row_performa_flight_chd = mysqli_fetch_array($rs_performa_flight_chd);

                                  $query_range_flight = "SELECT * FROM performa_price_range_flight";
                                  $rs_range_flight=mysqli_query($con,$query_range_flight);
                                  $pId_flight_inf = 0;


                                  while($row_range_flight = mysqli_fetch_array($rs_range_flight)){
                                    if($row_range_flight['price2']==1){
                                      if($flight_inf_price<=$row_range_flight['price1']){
                                        $pId_flight_inf = $row_range_flight['id'];
                                      }
                                    }else if($row_range_flight['price2']==0){
                                      if($flight_inf_price>=$row_range_flight['price1']){
                                        $pId_flight_inf = $row_range_flight['id'];
                                      }
                                    }else{
                                      if($flight_inf_price>$row_range_flight['price1'] && $flight_inf_price<=$row_range_flight['price2']){
                                        $pId_flight_inf = $row_range_flight['id'];
                                      }

                                    }

                                  }
                                  $query_performa_flight_inf = "SELECT * FROM performa_price_standart_flight WHERE performa_price_range_flight=".$pId_flight_inf." AND flight_type LIKE '".$_POST['flight_type']."'";
                                  $rs_performa_flight_inf=mysqli_query($con,$query_performa_flight_inf);
                                  $row_performa_flight_inf = mysqli_fetch_array($rs_performa_flight_inf);
                                      //end

                                  if($row_performa_flight_adt['option_price'] == 1){
                                    $flight_adt_price = $flight_adt_price + ($flight_adt_price * $row_performa_flight_adt['persentase']/100);
                                  }elseif ($row_performa_flight_adt['option_price'] == 2) {
                                    $flight_adt_price = $flight_adt_price + $row_performa_flight_adt['nominal'];
                                  }

                                  if($row_performa_flight_chd['option_price'] == 1){
                                    $flight_chd_price = $flight_chd_price + ($flight_chd_price * $row_performa_flight_chd['persentase']/100);
                                  }elseif ($row_performa_flight_chd['option_price'] == 2) {
                                    $flight_chd_price = $flight_chd_price + $row_performa_flight_chd['nominal'];
                                  }
                                  if($row_performa_flight_inf['option_price'] == 1){
                                    $flight_inf_price = $flight_inf_price + ($flight_inf_price * $row_performa_flight_inf['persentase']/100);
                                  }elseif ($row_performa_flight_chd['option_price'] == 2) {
                                    $flight_inf_price = $flight_inf_price + $row_performa_flight_inf['nominal'];
                                  }


                                  $flightAdt = $flight_adt_price * ( $row_flightquotation['total_seat'] + $row['personplus2'] ) / $row_flightquotation['total_seat'];
                                  $flightChd = $flight_chd_price * ( $row_flightquotation['total_seat'] + $row['personplus2'] ) / $row_flightquotation['total_seat'];
                                  $flightInf = $flight_inf_price * ( $row_flightquotation['total_seat'] + $row['personplus2'] ) / $row_flightquotation['total_seat'];

                                }else{

                                  $query_kursflight = "SELECT * FROM kurs_live WHERE name LIKE '".$row_flightquotation['kurs_price']."'";
                                  $rs_kursflight=mysqli_query($con,$query_kursflight);
                                  $row_kursflight = mysqli_fetch_array($rs_kursflight);

                                  $flightAdt = $row_flightquotation['adt_price'] * $row_kursflight['jual'];
                                  $flightChd = $row_flightquotation['chd_price'] * $row_kursflight['jual'];
                                  $flightInf = $row_flightquotation['inf_price'] * $row_kursflight['jual'];

                                  $flightAdtTax = $row_flightquotation['adt_tax'] * $row_kursflight['jual'];
                                  $flightChdTax = $row_flightquotation['chd_tax'] * $row_kursflight['jual'];
                                  $flightInfTax = $row_flightquotation['inf_tax'] * $row_kursflight['jual'];

                                  $flight_adt_price = $flightAdt + $flightAdtTax;
                                  $flight_chd_price = $flightChd + $flightChdTax;
                                  $flight_inf_price = $flightInf + $flightInfTax;


                                  if($row_performa_flight_chd['option_price'] == 1){
                                    $flight_chd_price = $flight_chd_price + ($flight_chd_price * $row_performa_flight_chd['persentase']/100);
                                  }elseif ($row_performa_flight_chd['option_price'] == 2) {
                                    $flight_chd_price = $flight_chd_price + $row_performa_flight_chd['nominal'];
                                  }
                                  if($row_performa_flight_inf['option_price'] == 1){
                                    $flight_inf_price = $flight_inf_price + ($flight_inf_price * $row_performa_flight_inf['persentase']/100);
                                  }elseif ($row_performa_flight_chd['option_price'] == 2) {
                                    $flight_inf_price = $flight_inf_price + $row_performa_flight_inf['nominal'];
                                  }


                                  $flightAdt = $flight_adt_price * ( $row_flightquotation['total_seat'] + $row['personplus2'] ) / $row_flightquotation['total_seat'];
                                  $flightChd = $flight_chd_price * ( $row_flightquotation['total_seat'] + $row['personplus2'] ) / $row_flightquotation['total_seat'];
                                  $flightInf = $flight_inf_price * ( $row_flightquotation['total_seat'] + $row['personplus2'] ) / $row_flightquotation['total_seat'];

                                }

                              }

                              //flightprice
                              // echo $tempMinPerson."</br>";
                              // echo $query_flightquotation."</br>";
                              // echo $flightAdt."</br>";
                              $totalPrice = $price2 + $flightAdt;

                              $totalPricePurchase = $purchaseprice + $flightAdt;

                              if($price2>10000 && substr((int)$price2,-4)!='0000'){
                                $price2 = ((int)$price2 - substr((int)$price2,-4)) + 10000;
                              }
                              if($price2 >= 999999999999){
                                $price2 = 0;
                              }

                              if($price2>=1000000000000){
                                $price2 = 0;
                              }

                              if($flightAdt>10000 && substr((int)$flightAdt,-4)!='0000'){
                                $flightAdt = ((int)$flightAdt - substr((int)$flightAdt,-4)) + 10000;
                              }
                              if($flightAdt >= 999999999999){
                                $flightAdt = 0;
                              }

                              if($flightAdt>=1000000000000){
                                $flightAdt = 0;
                              }

                              if($totalPrice>10000 && substr((int)$totalPrice,-4)!='0000'){
                                $totalPrice = ((int)$totalPrice - substr((int)$totalPrice,-4)) + 10000;
                              }
                              if($totalPrice >= 999999999999){
                                $totalPrice = 0;
                              }

                              if($totalPrice>=1000000000000){
                                $totalPrice = 0;
                              }
                              

                              

                              if($totalPricePurchase>10000 && substr((int)$totalPricePurchase,-4)!='0000'){
                                $totalPricePurchase = ((int)$totalPricePurchase - substr((int)$totalPricePurchase,-4)) + 10000;
                              }
                              if($totalPricePurchase >= 999999999999){
                                $totalPricePurchase = 0;
                              }

                              if($totalPricePurchase>=1000000000000){
                                $totalPricePurchase = 0;
                              }

                              // if($totalPrice>10000 && substr((int)$totalPrice,-4)!='0000'){
                              //   $totalPrice = ((int)$totalPrice - substr((int)$totalPrice,-4)) + 10000;
                              // }
                              // if($totalPrice >= 999999999999){
                              //   $totalPrice = 0;
                              // }

                              // if($totalPrice>=1000000000000){
                              //   $totalPrice = 0;
                              // }




                echo "<td colspan='2' nowrap>Rp ".number_format($price2, 0, ".", ".")."</br>";

                echo "Rp ".number_format($flightAdt, 0, ".", ".")."</br>
                Total : 
                Rp ".number_format($totalPrice, 0, ".", ".")."</br>";


                echo "</br>Rp ".number_format($purchaseprice, 0, ".", ".")."</br>";

                echo "Rp ".number_format($flightAdt, 0, ".", ".")."</br>
                Total : 
                Rp ".number_format($totalPricePurchase, 0, ".", ".");

                echo "</td>
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

                

                echo "</td>
                <td>".$row_staff['name']."<br>".$row['timedate']."</br>";
                if($flag=="Active"){
                  echo "-";
                }else{
                  echo "-";
                }
                echo "</td>";
               
                
                echo "
                </tr>
                <tr><td colspan='18'><div name='divDetail".$row['id']."' id='divDetail".$row['id']."'></div></td></tr>";

                echo "<script>closeDetail(".$row['id'].",".$row['id'].");</script>";
                 }
                }

                echo "
                </tbody>
                </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        <!-- /.row -->
</div>";
?>

<script>
  $(document).ready(function(){
    $(".chosen1").chosen();
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


  function printItineraryStaff(x,y,v,k,n,m){
    var b = $("input[name=airlines_type"+y+"]").val();
    var z = $("input[name=flight_type"+y+"]").val();
    var q = $("input[name=type_price"+y+"]").val();
    var r = $("input[name=city_from]").val();
    if(v==0){
      var airlinesArray = <?php echo json_encode($airlinesArray); ?>;
      var airlineString = '';
      for (i = 0; i < airlinesArray.length; i++) {
        airlineString = airlineString + "&airlines_id"+i+"="+airlinesArray[i];
      }
      window.open("https://www.2canholiday.com/printLandTourSIC.php?id="+x+"&id_package="+y+"&airlinesCount="+airlinesArray.length+airlineString+"&airlines_type="+b+"&type_price="+q+"&flight_type="+z+"&city_from="+r+"&country_to="+k+"&city_to="+n+"&city_out="+m,'_blank');
    }else{
      window.open("https://www.2canholiday.com/printLandTourSIC.php?id="+x+"&id_package="+y+"&airlinesCount=0&airlines_id0="+v+"&airlines_type="+b+"&type_price="+q+"&flight_type="+z+"&city_from="+r+"&country_to="+k+"&city_to="+n+"&city_out="+m,"Print");
    }
    
  }

  function printItineraryPerforma(x,y,v,k,n,m){
    var b = $("input[name=airlines_type"+y+"]").val();
    var z = $("input[name=flight_type"+y+"]").val();
    var q = $("input[name=type_price"+y+"]").val();
    var r = $("input[name=city_from]").val();
    if(v==0){
      var airlinesArray = <?php echo json_encode($airlinesArray); ?>;
      var airlineString = '';
      for (i = 0; i < airlinesArray.length; i++) {
        airlineString = airlineString + "&airlines_id"+i+"="+airlinesArray[i];
      }
      window.open("https://www.2canholiday.com/printLandTourSICPerforma.php?id="+x+"&id_package="+y+"&airlinesCount="+airlinesArray.length+airlineString+"&airlines_type="+b+"&type_price="+q+"&flight_type="+z+"&city_from="+r+"&country_to="+k+"&city_to="+n+"&city_out="+m,'_blank');
    }else{
      window.open("https://www.2canholiday.com/printLandTourSICPerforma.php?id="+x+"&id_package="+y+"&airlines_id0="+v+"&airlinesCount=0&airlines_type="+b+"&type_price="+q+"&flight_type="+z+"&city_from="+r+"&country_to="+k+"&city_to="+n+"&city_out="+m,"Print");
    }
    
  }

  function printItineraryTLStaff(x,y,v,k,n,m){
    var b = $("input[name=airlines_type"+y+"]").val();
    var z = $("input[name=flight_type"+y+"]").val();
    var q = $("input[name=type_price"+y+"]").val();
    var r = $("input[name=city_from]").val();
    if(v==0){
      var airlinesArray = <?php echo json_encode($airlinesArray); ?>;
      var airlineString = '';
      for (i = 0; i < airlinesArray.length; i++) {
        airlineString = airlineString + "&airlines_id"+i+"="+airlinesArray[i];
      }
      window.open("https://www.2canholiday.com/printLandTourSICTL.php?id="+x+"&id_package="+y+"&airlinesCount="+airlinesArray.length+airlineString+"&airlines_type="+b+"&type_price="+q+"&flight_type="+z+"&city_from="+r+"&country_to="+k+"&city_to="+n+"&city_out="+m,'_blank');
    }else{
      window.open("https://www.2canholiday.com/printLandTourSICTL.php?id="+x+"&id_package="+y+"&airlinesCount=0&airlines_id0="+v+"&airlines_type="+b+"&type_price="+q+"&flight_type="+z+"&city_from="+r+"&country_to="+k+"&city_to="+n+"&city_out="+m,"Print");
    }
    
  }

  function printItineraryTLPerforma(x,y,v,k,n,m){
    var b = $("input[name=airlines_type"+y+"]").val();
    var z = $("input[name=flight_type"+y+"]").val();
    var q = $("input[name=type_price"+y+"]").val();
    var r = $("input[name=city_from]").val();
    if(v==0){
      var airlinesArray = <?php echo json_encode($airlinesArray); ?>;
      var airlineString = '';
      for (i = 0; i < airlinesArray.length; i++) {
        airlineString = airlineString + "&airlines_id"+i+"="+airlinesArray[i];
      }
      window.open("https://www.2canholiday.com/printLandTourSICTLPerforma.php?id="+x+"&id_package="+y+"&airlinesCount="+airlinesArray.length+airlineString+"&airlines_type="+b+"&type_price="+q+"&flight_type="+z+"&city_from="+r+"&country_to="+k+"&city_to="+n+"&city_out="+m,'_blank');
    }else{
      window.open("https://www.2canholiday.com/printLandTourSICTLPerforma.php?id="+x+"&id_package="+y+"&airlines_id0="+v+"&airlinesCount=0&airlines_type="+b+"&type_price="+q+"&flight_type="+z+"&city_from="+r+"&country_to="+k+"&city_to="+n+"&city_out="+m,"Print");
    }
    
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

