<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
session_start();

$querycountall = "SELECT COUNT(*) as total FROM tour_package";
$rscountall=mysqli_query($con,$querycountall);
$rowcountall = mysqli_fetch_assoc($rscountall);

$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);

$querystaff = "SELECT * FROM login_staff WHERE type=3 OR type=4";
$rsstaff=mysqli_query($con,$querystaff);


echo "<div class='content-wrapper'>

 <div class='row'>
          <div>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title' style='font-weight:bold;'>TOUR PACKAGE ( TOTAL : ".$rowcountall['total'].")</h3>
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
                    <option value='1'>Continent</option>
                    <option value='2'>Staff</option>
                    <option value='3'>Country</option>
                    <option value='4'>City</option>
                    <option value='5'>Min Person</option>
                    <option value='6'>Tour Type</option>";
                    
                    echo"</select></br>
                    <div id='divFilter'></div>
                    
                </div>
              </div>
              </div>
              <!-- /.card-header -->
              <div>";
            
                include "../site.php";
                include "../db=connection.php";


                
                
                $countx = 0;

                echo "<table id='dtBasicExample' class='table table-striped table-bordered table-sm' style='font-size:14px; max-height:100px important;'>
                <thead>
                <tr>
                <th>Tour Code</th>
                <th>Landtour Files</th>";

                 if($_SESSION['type']==1 or $_SESSION['type']==2 or $_SESSION['staff']=="Joana"){
                   echo "<th>Agent Name</th>";
                 }
               echo "<th>Tour Name</th>
                <th>Tour Category</th>
                <th>Tour Type</th>
                <th>Departure Day</th>
                <th>Every</th>
                <th>Selling Date</th>
                <th>Min Person</th>";
                
                if($_SESSION['type']==1 or $_SESSION['staff']=="Antonio Chandra"){
                  echo "<th>Purchase Price</th>";
                }
                echo "<th>Selling Price</th>
                <th>Tipping</th>
                <th>City</th>
                <th>Tour Country</th>
                <th>Img</th>
                <th>Staff</th>
                <th>Date Files</th>
                <th>Option</th>
                </tr>
                </thead>
                <tbody id='myTable'>";
                

                if($_POST['tourtype']!=''){
                   if($_SESSION['type']!=1 and $_SESSION['type']!=2 and $_SESSION['type']!=5 and $_SESSION['staff']!="Joana" and $_SESSION['type']!=6){
                      $query = "SELECT * FROM tour_package WHERE staff=".$_SESSION['staff_id']." AND tour_type LIKE '".$_POST['tourtype']."' ORDER BY id DESC";
                    }else{
                      $query = "SELECT * FROM tour_package WHERE tour_type LIKE '".$_POST['tourtype']."' ORDER BY id DESC";
                    }
                }else{
                     if($_SESSION['type']!=1 and $_SESSION['type']!=2 and $_SESSION['type']!=5 and $_SESSION['staff']!="Joana" and $_SESSION['type']!=6){
                      $query = "SELECT * FROM tour_package WHERE staff=".$_SESSION['staff_id']." ORDER BY id DESC";
                    }else{
                      $query = "SELECT * FROM tour_package ORDER BY id DESC";
                    }
                }
                
                
                $rs=mysqli_query($con,$query);

                while($row = mysqli_fetch_array($rs)){

                   $price2 = 999999999999;

                  $query_package2 = "SELECT * FROM tour_price_package WHERE tour_package =".$row['id'];
                  $rs_package2 = mysqli_query($con,$query_package2);

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
                        if(!isset($row_kurs2['name'])){
                          $value_kurs2 = 1 * $row_min_price['price'];
                        }else{
                          $value_kurs2 = $row_kurs2['jual'] * $row_min_price['price'];
                        }
                        if($price2>$value_kurs2){
                          $price2 = $value_kurs2;
                        }


                      }

                    }
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
                  if($purchaseprice>1000){
                    $purchaseprice = ((int)$purchaseprice - substr((int)$purchaseprice,-3)) + 1000;
                  }
                  if($purchaseprice >= 999999999999){
                    $purchaseprice = 0;
                  }
                  $price2 = $price2 + $tempPerforma;
                  if($price2>1000){
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

                echo"
                <tr style='font-weight:bold;'>";
                 echo "<td>888".$row['id']."</br></br>
                <button type='submit' style='font-size:10px;' onclick='printItinerary(2,".$row['id'].")' class='btn btn-primary'>Print Itinerary</button></br>
                <button type='submit' style='font-size:8px;' onclick='seeDetail(".$row['id'].",".$row['id'].")' class='btn btn-success'>See Price</button> <button type='submit' style='font-size:8px;' onclick='closeDetail(".$row['id'].",".$row['id'].")' class='btn btn-danger'>Close Price</button></td>";
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
                
                echo "
                <td>".$row['tour_name']."</td>
                <td>".$row['category']."</td>
                <td>".$row['tour_type']."</td>
                <td>
                  ";

                $query_cekdate = "SELECT COUNT(*) as total FROM date_package WHERE tourpackage=".$row['id'];
                $rs_cekdate=mysqli_query($con,$query_cekdate);
                $row_cekdate = mysqli_fetch_assoc($rs_cekdate);
                if($row_cekdate['total']>0){
                  echo "<button type='submit' style='font-size:10px;' onclick='reloadPage(4,".$row['id'].",0)' class='btn btn-success'><i class='fa fa-calendar' aria-hidden='true''></i></button>";
                }else{
                  echo "<button type='submit' style='font-size:10px;' onclick='reloadPage(4,".$row['id'].",0)' class='btn btn-danger'><i class='fa fa-calendar' aria-hidden='true''></i></button>";
                }
                  
                echo "
                </td>
                <td style='font-size:12px;'>".$row['days']."</td>
                <td style='font-size:12px;'>".$row['departure']."</td>
                <td>".$row['minperson']."</td>";
                if($_SESSION['type']==1 or $_SESSION['staff']=="Antonio Chandra"){
                  echo "<td>Rp ".number_format($purchaseprice, 0, ".", ".")."</td>";
                }
                echo "<td>Rp ".number_format($price2, 0, ".", ".")."</td>
                <td>".$rowkurs['name']." ".$row['tipping']."</td>
                <td>";
                for($i=0; $i<count($tempCity); $i++){
                  $query_city = "SELECT * FROM city WHERE id = ".$tempCity[$i];
                  $rs_city=mysqli_query($con,$query_city);
                  $row_city = mysqli_fetch_array($rs_city);
                  if($i==0){
                    $tempString = $tempString . $row_city['name'];
                  }else{
                    $tempString = $tempString . " " . $row_city['name'];
                  }
                }
                echo $tempString;
                echo "</td>
                <td>";
                for($i=0; $i<count($tempCountry); $i++){
                  $query_country = "SELECT * FROM country WHERE id = ".$tempCountry[$i];
                  $rs_country=mysqli_query($con,$query_country);
                  $row_country = mysqli_fetch_array($rs_country);
                  if($i==0){
                    $tempString2 = $tempString2 . $row_country['name'];
                  }else{
                    $tempString2 = $tempString2 . " " . $row_country['name'];
                  }
                }
                echo $tempString2;
                echo "</br>";

                echo "</br> ( ";
                $query_itin = "SELECT DISTINCT(itinerary_category_arrival) FROM itinerary WHERE day=1 AND itinerary_category_arrival > 0 AND tour_package=".$row['id'];
                $rs_itin=mysqli_query($con,$query_itin);
                $row_itin = mysqli_fetch_array($rs_itin);

                $query_itinerary_category = "SELECT * FROM itinerary_category_arrival WHERE id=".$row_itin['itinerary_category_arrival'];
                $rs_itinerary_category=mysqli_query($con,$query_itinerary_category);
                $row_itinerary_category = mysqli_fetch_array($rs_itinerary_category);

                echo $row_itinerary_category['short']." ";
               
                echo " ) </br>";

                echo "</br> ( ";
                $query_itin2 = "SELECT DISTINCT(itinerary_category_departure) FROM itinerary WHERE day=".$row['duration_tour']." AND itinerary_category_departure > 0 AND tour_package=".$row['id'];
                $rs_itin2=mysqli_query($con,$query_itin2);
                $row_itin2 = mysqli_fetch_array($rs_itin2);

                $query_itinerary_category = "SELECT * FROM itinerary_category_departure WHERE id=".$row_itin2['itinerary_category_departure'];
                $rs_itinerary_category=mysqli_query($con,$query_itinerary_category);
                $row_itinerary_category = mysqli_fetch_array($rs_itinerary_category);
                echo $row_itinerary_category['short']." ";
               
                echo " )";


                echo "</td>
                <td style='font-size:10px;'><img src='../".$row['img']."' style='height:50px;weight:50px;'></td>";
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
                  
                  echo "
                  <button type='submit' onclick='editPage(3,".$row['id'].",0,0)' style='font-size:13px;' class='btn btn-warning'><i class='fa fa-edit' aria-hidden='true''></i></button>
                  <button type='submit' onclick='delTourPackage(".$row['id'].",0)' style='font-size:13px;' class='btn btn-danger'><i class='fa fa-trash' aria-hidden='true'></i></button>";
                  
                  

               echo "</td>
                </tr>
                <tr><td><div name='divDetail".$row['id']."' id='divDetail".$row['id']."'></div></td></tr>";
                }

                echo "
                </tbody>
                </table>";

              echo "</div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
</div>";
?>

<script>
  function closeDetail(x,y){
    $('#divDetail'+y).html('');
  }
  function seeDetail(x,y){
    $.ajax({
          type:'POST',
          url:'seepricetourpackage.php',
          data:{'id':y},
          success:function(data){
           $('#divDetail'+y).html(data);
         }
       });
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
  $(document).ready(function(){
    $(".chosen1").chosen();
  });
  function printItinerary(x,y){
    window.open("https://www.2canholiday.com/print.php?id="+x+"&id_package="+y,"Print");
  }
	// $(document).ready(function(){
	// 	$("#myInput").on('keyup', function() {
	// 		alert('aa');
	// 		var value = $(this).val().toLowerCase();
	// 		$("#myTable tr").filter(function() {
	// 			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	// 		});
	// 	});
	// });
	
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

