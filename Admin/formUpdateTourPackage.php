<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<style>

  .tableFixHead          { overflow-y: auto; height: 100px; }
  .tableFixHead thead th { position: sticky; top: 0; }

  /* Just common table stuff. Really. */
  th     { background:#ffff; }



  .multiselect {
    width: 100%;
  }

  .selectBox {
    position: relative;
  }

  .selectBox select {
    width: 100%;
    font-weight: bold;
  }

  .overSelect {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
  }

  #checkboxes {
    display: none;
    border: 1px #dadada solid;
  }

  #checkboxes label {
    display: block;
  }

  #checkboxes label:hover {
    background-color: #1e90ff;
  }
  .ui-autocomplete {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  float: left;
  display: none;
  min-width: 160px;
  padding: 10px;
  _width: 160px;
  list-style: none;
 background-color: #f1f1f1;
  border-color: #ccc;
  border-color: rgba(0, 0, 0, 0.2);
  border-style: solid;
  border-width: 1px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  -webkit-background-clip: padding-box;
  -moz-background-clip: padding;
  background-clip: padding-box;
  *border-right-width: 2px;
  *border-bottom-width: 2px;

  }

.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
}
input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}
input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}
input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
}
.ui-autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9;
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important;
  color: #ffffff;
}
</style>
<?php
session_start();
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM tour_package WHERE id = ".$_POST['id'];
$rs=mysqli_query($con,$query);
$row = mysqli_fetch_array($rs);

$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);

$querycategory = "SELECT * FROM tour_category";
$rscategory=mysqli_query($con,$querycategory);

$querytourtype = "SELECT * FROM tour_type";
$rstourtype=mysqli_query($con,$querytourtype);

$querytype = "SELECT * FROM tour_type";
$rstype=mysqli_query($con,$querytype);
$rowtype = mysqli_fetch_array($rstype);

$querycity = "SELECT * FROM city";
$rscity=mysqli_query($con,$querycity);

$querykurs = "SELECT * FROM kurs_bank";
$rskurs=mysqli_query($con,$querykurs);

$query_agent = "SELECT * FROM agent";
$rs_agent=mysqli_query($con,$query_agent);

$tempCity = preg_split ("/[;]+/", $row['city']);
$tempCityCount = preg_split ("/[;]+/", $row['city_count']);
$tempCountry = preg_split ("/[;]+/", $row['country']);
$tempString = "";
$tempString2 = ""; 

// $string = $row['departure'];
// $tempString = "";
// $tempString2 = "";
// $tempCount = 0;
// for ($x = 0; $x < strlen($string); $x++) {
//    if($string[x]=='-'){
//       $tempCount = x;
//       break;
//    }else{
//     $tempString = $tempString + $string[x];
//    }
// }


// for ($x = $tempCount; $x < strlen($string); $x++) {

// }
// $date = $row['departure'];

if($_SESSION['type']!=5){
	echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>UPDATE TOUR PACKAGE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>
                  <div class='form-group'>";
                  if($_SESSION['type']==1 or $_SESSION['staff']=="Joana" or $_SESSION['staff']=="Antonio Chandra"){
                     echo "<div class='form-group'>
                        <label>Agent</label>
                        <input name='tagent' id='tagent' value='1' type='hidden' >
                        <select class='chosen' name='agent' id='agent' class='form-control'>
                        <option selected='selected' value=0>Pilihan</option>";

                        while($row_agent = mysqli_fetch_array($rs_agent)){
                          if($row['agent']==$row_agent['id']){
                              echo "<option selected='selected' value='".$row_agent['id']."'>".$row_agent['company']."</option>";
                          }else{
                              echo "<option value='".$row_agent['id']."'>".$row_agent['company']."</option>";
                          }
                        }
                        echo"</select>
                      </div>";
                    }else{
                      echo "<input name='tagent' id='tagent' value='0' type='hidden' >";
                    }
                  
                   echo "<label>Tour Name</label>
                    <input type='text' class='form-control' name='name' id='name' value='".$row['tour_name']."' placeholder='Enter Name'>
                    <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                  </div>";


                  // echo "<div class=form-group'>
                  // <label>Country</label>
                  // <select name='country_count' id='country_count'>
                  // <option selected='selected' value=0>Jumlah Country</option>";

                  // for ($x = 1; $x <= 20; $x++){
                  //   echo "<option value=".$x.">".$x."</option>";
                  // }
                  // echo "</select></div>
                  // <div class=form-group' name='divcountry' id='divcountry'></div>
                  //  </br>";



                  echo "<div class='form-group'>
                    <label>Description</label>
                    <textarea class='form-control' name='desc' id='desc' value='".$row['description']."' placeholder='Enter Description'>".$row['description']."</textarea>
                  </div>
                  <div class='form-group'>
                    <label>Category</label>
                    <select name='category' id='category' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcategory = mysqli_fetch_array($rscategory)){
                      if($rowcategory['name']==$row['category']){
                        echo "<option selected='selected' value='".$rowcategory['name']."'>".$rowcategory['name']."</option>";
                      }else{
                        echo "<option value='".$rowcategory['name']."'>".$rowcategory['name']."</option>";
                      }
                      
                    }
                    echo"</select>
                  </div>
                  <div class='form-group'>
                    <label>Tour Type</label>
                    <select name='type1' id='type1' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowtourtype = mysqli_fetch_array($rstourtype)){
                      if($rowtourtype['name']==$row['tour_type']){
                        echo "<option selected='selected' value='".$rowtourtype['name']."'>".$rowtourtype['name']."</option>";
                      }else{
                        echo "<option value='".$rowtourtype['name']."'>".$rowtourtype['name']."</option>";
                      }
                    }
                    echo"</select>
                  </div>
                  <div class='form-group'>
                    <label>Duration Tour</label>
                    <input type='text' class='form-control' name='duration' id='duration' value='".$row['duration_tour']."' placeholder='Enter Duration'>
                  </div>
                  <div class='form-group'>
                    <label>Validity : ".$row['departure']."</label>
                    <input class='form-control' type='text' name='tdeparture' value='".$row['departure']."' hidden />
                    <input class='form-control' type='text' name='departure' value='".$row['departure']."' style='width: 100%;' />
                  </div>
                  <div class='form-group'>
                    <label>Min Person</label>
                    <input type='text' class='form-control' name='minperson' id='minperson' value='".$row['minperson']."' placeholder='Enter Min Person'>
                  </div>";

                  // echo "<div class='form-row align-items-center'>
                  //              <div class='col-4'>
                  //                <label>Flight To</label>
                  //                <input class='form-control' type='text' onkeyup='getFromX(this.value,7)' name='tags7' id='tags7' style='height:2%;'/>
                                 
                  //              </div>
                  //              <div class='col-4'>
                  //                <label>Flight Out</label>
                  //                <input class='form-control' type='text' onkeyup='getFromX(this.value,8)' name='tags8' id='tags8' style='height:2%;'/>
                  //              </div>
                  //            </div></br>";

                  echo "<div class=form-group'>
                    <label>Country</label>
                    <select name='country_count' id='country_count'>
                    <option selected='selected' value=0>Jumlah Country</option>";

                    for ($x = 1; $x <= 20; $x++){
                      if($x==count($tempCountry)){
                        echo "<option selected='selected' value=".$x.">".$x."</option>";
                      }else{
                        echo "<option value=".$x.">".$x."</option>";
                      }
                      
                    }
                   echo "</select></div>
                   <div class=form-group' name='divcountry' id='divcountry'>";
                   $countTemp = 0;
                   for ($x = 1; $x <= count($tempCountry); $x++){
                    $cekTemp = $x - 1;
                    $querycity = "SELECT * FROM country";
                    $rscity=mysqli_query($con,$querycity);
                    echo"<div class=form-group' style='margin-bottom:10px;'>
                    <label>Country ".$x."</label>
                    <select class='chosen' name='country".$x."' id='country".$x."' style='width: 100%;' onchange=getCity(".$x.")>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcity = mysqli_fetch_array($rscity)){
                      if($rowcity['id']==$tempCountry[$cekTemp]){
                        echo "<option selected='selected' value=".$rowcity['id'].">".$rowcity['name']."</option>";
                      }else{
                        echo "<option value=".$rowcity['id'].">".$rowcity['name']."</option>";
                      }
                      
                    }
                    echo"</select></div>
                    <div class=form-group'>
                    <label>City ".$x."</label>
                    <select name='city_count".$x."' id='city_count".$x."' onchange=getCity(".$x.")>
                    <option selected='selected' value=0>Jumlah City</option>";

                    for ($y = 1; $y <= 20; $y++){
                      if($y==$tempCityCount[$cekTemp]){
                        echo "<option selected='selected' value=".$y.">".$y."</option>";
                      }else{
                        echo "<option value=".$y.">".$y."</option>";
                      }
                      
                    }
                    echo "</select></div>
                    <div class=form-group' name='divcity".$x."' id='divcity".$x."'>";
                    echo"<div class=form-group' style='margin-bottom:10px;'>";
                    for ($y2 = 1; $y2 <= $tempCityCount[$cekTemp]; $y2++){

                    $cekTemp2 = $y2-1;
                    
                    $querycity = "SELECT * FROM city WHERE country=".$tempCountry[$cekTemp];
                    $rscity=mysqli_query($con,$querycity);
                    
                    echo "<select class='chosen' name='city".$x.$y2."' id='city".$x.$y2."' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcity = mysqli_fetch_array($rscity)){
                      if($rowcity['id']==$tempCity[$countTemp]){
                        echo "<option selected='selected' value=".$rowcity['id'].">".$rowcity['name']."</option>";
                      }else{
                        echo "<option value=".$rowcity['id'].">".$rowcity['name']."</option>";
                      }
                      
                    }
                    echo"</select>";
                    $countTemp = $countTemp + 1;
                  }

                    echo "</div>";
                    

                  }

                   echo "</div>";

                 //   echo "<div class=form-group'>
                 //    <label>Country</label>
                 //    <select class='chosen' name='country' id='country' style='width: 100%;'>
                 //    <option selected='selected' value=0>Pilihan</option>";

                 //    while($rowcountry = mysqli_fetch_array($rscountry)){
                 //      echo "<option value=".$rowcountry['id'].">".$rowcountry['name']."</option>";
                 //    }
                 //    echo"</select>
                 //  </div>
                 //  </br>
                 //  <div class=form-group'>
                 //    <label>City</label><select name='city_count' id='city_count'>
                 //    <option selected='selected' value=0>Jumlah City</option>";

                 //    for ($x = 1; $x <= 20; $x++){
                 //      echo "<option value=".$x.">".$x."</option>";
                 //    }
                 //   echo "</select><div class=form-group' name='divcity' id='divcity'>";
                 //    for($i=0; $i<count($tempCity); $i++){
                 //      $query_city = "SELECT * FROM city WHERE id=".$tempCity[$i];
                 //      $rs_city=mysqli_query($con,$query_city);
                 //      echo "<select class='chosen' name='city".$i."' id='city".$i."' style='width: 100%;'>";

                 //      while($row_city = mysqli_fetch_array($rs_city)){
                 //        echo "<option id=city".$row_city['id']." value=".$row_city['id'].">".$row_city['name']."</option>";
                 //      }
                 //      echo"</select>";
                 //    }
                 // echo "</div></div>";




                  echo "<div class='form-group' hidden>
                    <label>Img</label>
                    <input type='text' class='form-control' name='img' id='img' value='".$row['img']."' placeholder='Enter Img'>
                  </div>

                  <div class='form-group' hidden>
                    <label>Img Head</label>
                    <input type='text' class='form-control' name='imghead' id='imghead' value='".$row['img_head']."' placeholder='Enter Img Head'>
                  </div>
                  
                  <div class='form-group' hidden>
                    <label for='exampleInputFile'>File input</label>
                    <div class='input-group'>
                      <div class='custom-file'>
                        <input name='fileToUpload2' id='fileToUpload2' accept='image/*' type='file' />
                      </div>
                      
                    </div>
                  </div><div class='form-group' hidden>
                    <label for='exampleInputFile'>File input Img Head</label>
                    <div class='input-group'>
                      <div class='custom-file'>
                        <input name='fileToUpload' id='fileToUpload' accept='image/*' type='file' />
                      </div>
                      
                    </div>
                  </div>";
                  
                  
                echo "</div>

                <div class='card-footer'>
                  <button type='button' class='btn btn-primary' id='but_upload'>Submit</button>
                </div>
              </form>
            </div>

            
                

              </div>
            </div>
          </div>
        </div>
</div>";
}else{
	echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>UPDATE TOUR PACKAGE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(0,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>
                  <div class='form-group'>";
                  if($_SESSION['type']==1 or $_SESSION['staff']=="Joana" or $_SESSION['staff']=="Antonio Chandra"){
                     echo "<div class='form-group'>
                        <label>Agent</label>
                        <input name='tagent' id='tagent' value='1' type='hidden' >
                        <select class='chosen' name='agent' id='agent' class='form-control'>
                        <option selected='selected' value=0>Pilihan</option>";

                        while($row_agent = mysqli_fetch_array($rs_agent)){
                          if($row['agent']==$row_agent['id']){
                              echo "<option selected='selected' value='".$row_agent['id']."'>".$row_agent['company']."</option>";
                          }else{
                              echo "<option value='".$row_agent['id']."'>".$row_agent['company']."</option>";
                          }
                        }
                        echo"</select>
                      </div>";
                    }else{
                      echo "<input name='tagent' id='tagent' value='0' type='hidden' >";
                    }
                  
                   echo "<label>Tour Name</label>
                    <input type='text' class='form-control' name='name' id='name' value='".$row['tour_name']."' placeholder='Enter Name' disabled>
                    <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                  </div>";


                  // echo "<div class=form-group'>
                  // <label>Country</label>
                  // <select name='country_count' id='country_count'>
                  // <option selected='selected' value=0>Jumlah Country</option>";

                  // for ($x = 1; $x <= 20; $x++){
                  //   echo "<option value=".$x.">".$x."</option>";
                  // }
                  // echo "</select></div>
                  // <div class=form-group' name='divcountry' id='divcountry'></div>
                  //  </br>";



                  echo "<div class='form-group'>
                    <label>Description</label>
                    <textarea class='form-control' name='desc' id='desc' value='".$row['description']."' placeholder='Enter Description' disabled>".$row['description']."</textarea>
                  </div>
                  <div class='form-group'>
                    <label>Category</label>
                    <select name='category' id='category' class='form-control' disabled>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcategory = mysqli_fetch_array($rscategory)){
                      if($row['category']==$rowcategory['id']){
                        echo "<option selected='selected' value='".$rowcategory['name']."'>".$rowcategory['name']."</option>";
                      }else{
                        echo "<option value='".$rowcategory['name']."'>".$rowcategory['name']."</option>";
                      }
                      
                    }
                    echo"</select>
                  </div>
                  <div class='form-group'>
                    <label>Tour Type</label>
                    <select name='type1' id='type1' class='form-control' disabled>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowtourtype = mysqli_fetch_array($rstourtype)){
                      if($rowtourtype['name']==$row['tour_type']){
                        echo "<option selected='selected' value='".$rowtourtype['name']."'>".$rowtourtype['name']."</option>";
                      }else{
                        echo "<option value='".$rowtourtype['name']."'>".$rowtourtype['name']."</option>";
                      }
                    }
                    echo"</select>
                  </div>
                  <div class='form-group'>
                    <label>Duration Tour</label>
                    <input type='text' class='form-control' name='duration' id='duration' value='".$row['duration_tour']."' placeholder='Enter Duration' disabled>
                  </div>
                  <div class='form-group'>
                    <label>Validity : ".$row['departure']."</label>
                    <input class='form-control' type='text' name='tdeparture' value='".$row['departure']."' hidden />
                    <input class='form-control' type='text' name='departure' value='".$row['departure']."' style='width: 100%;' disabled/>
                  </div>
                  <div class='form-group'>
                    <label>Min Person</label>
                    <input type='text' class='form-control' name='minperson' id='minperson' value='".$row['minperson']."' placeholder='Enter Min Person' disabled>
                  </div>";

                  echo "<div class=form-group'>
                    <label>Country</label>
                    <select name='country_count' id='country_count' disabled>
                    <option selected='selected' value=0>Jumlah Country</option>";

                    for ($x = 1; $x <= 20; $x++){
                      if($x==count($tempCountry)){
                        echo "<option selected='selected' value=".$x.">".$x."</option>";
                      }else{
                        echo "<option value=".$x.">".$x."</option>";
                      }
                      
                    }
                   echo "</select></div>
                   <div class=form-group' name='divcountry' id='divcountry'>";
                   $countTemp = 0;
                   for ($x = 1; $x <= count($tempCountry); $x++){
                    $cekTemp = $x - 1;
                    $querycity = "SELECT * FROM country";
                    $rscity=mysqli_query($con,$querycity);
                    echo"<div class=form-group' style='margin-bottom:10px;'>
                    <label>Country ".$x."</label>
                    <select class='chosen' name='country".$x."' id='country".$x."' style='width: 100%;' onchange=getCity(".$x.") disabled>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcity = mysqli_fetch_array($rscity)){
                      if($rowcity['id']==$tempCountry[$cekTemp]){
                        echo "<option selected='selected' value=".$rowcity['id'].">".$rowcity['name']."</option>";
                      }else{
                        echo "<option value=".$rowcity['id'].">".$rowcity['name']."</option>";
                      }
                      
                    }
                    echo"</select></div>
                    <div class=form-group'>
                    <label>City ".$x."</label>
                    <select name='city_count".$x."' id='city_count".$x."' onchange=getCity(".$x.") disabled>
                    <option selected='selected' value=0>Jumlah City</option>";

                    for ($y = 1; $y <= 20; $y++){
                      if($y==$tempCityCount[$cekTemp]){
                        echo "<option selected='selected' value=".$y.">".$y."</option>";
                      }else{
                        echo "<option value=".$y.">".$y."</option>";
                      }
                      
                    }
                    echo "</select></div>
                    <div class=form-group' name='divcity".$x."' id='divcity".$x."'>";
                    echo"<div class=form-group' style='margin-bottom:10px;'>";
                    for ($y2 = 1; $y2 <= $tempCityCount[$cekTemp]; $y2++){

                    $cekTemp2 = $y2-1;
                    
                    $querycity = "SELECT * FROM city WHERE country=".$tempCountry[$cekTemp];
                    $rscity=mysqli_query($con,$querycity);
                    
                    echo "<select class='chosen' name='city".$x.$y2."' id='city".$x.$y2."' style='width: 100%;' disabled>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcity = mysqli_fetch_array($rscity)){
                      if($rowcity['id']==$tempCity[$countTemp]){
                        echo "<option selected='selected' value=".$rowcity['id'].">".$rowcity['name']."</option>";
                      }else{
                        echo "<option value=".$rowcity['id'].">".$rowcity['name']."</option>";
                      }
                      
                    }
                    echo"</select>";
                    $countTemp = $countTemp + 1;
                  }

                    echo "</div>";
                    

                  }

                   echo "</div>";

                  echo "<div class='form-group'>
                    <label>Img</label>
                    <input type='text' class='form-control' name='img' id='img' value='".$row['img']."' placeholder='Enter Img' disabled>
                  </div>

                  <div class='form-group'>
                    <label>Img Head</label>
                    <input type='text' class='form-control' name='imghead' id='imghead' value='".$row['img_head']."' placeholder='Enter Img Head' disabled>
                  </div>
                  
                  <div class='form-group'>
                    <label for='exampleInputFile'>File input</label>
                    <div class='input-group'>
                      <div class='custom-file'>
                        <input name='fileToUpload2' id='fileToUpload2' accept='image/*' type='file' />
                      </div>
                      
                    </div>
                  </div><div class='form-group'>
                    <label for='exampleInputFile'>File input Img Head</label>
                    <div class='input-group'>
                      <div class='custom-file'>
                        <input name='fileToUpload' id='fileToUpload' accept='image/*' type='file' />
                      </div>
                      
                    </div>
                  </div>";
                  
                  
                echo "</div>

                <div class='card-footer'>
                  <button type='button' class='btn btn-primary' id='but_upload'>Submit</button>
                </div>
              </form>
            </div>

            
                

              </div>
            </div>
          </div>
        </div>
</div>";
}

?>

<script>

  $(document).ready(function(){
    var availableTags = [];
    $("#kurs").val($("input[name=tkurs]").val());
    $("#type").val($("input[name=ttype]").val());
    $('#country').val($("input[name=tcountry]").val());
    $(".chosen").chosen();
    var countCity = $("input[name=ccity]").val();
    // for (j = 0; j < countCity; j++) {
    //   alert($('#tcity'+j).val());
    //   $('#city'+j).val($('#tcity'+j).val());
    //    $('#city'+j).trigger('chosen:updated');
    // }

    $('#country_count').on('change', function() {
        var count = this.value;
        $.ajax({
          type:'POST',
          url:'country_count.php',
          data:{'count':count},
          success:function(data){
           $('#divcountry').html(data);
         }
       });
      });

    function getFromX(x,y){

      $.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
        var i=0;
        availableTags = [];
        for(i=0;i<data.length;i++){
          availableTags[i]=data[i].PlaceName + " ( "+ data[i].CountryName +" ) " + " - " + data[i].PlaceId;
        }

      });



      $( "#tags"+y ).autocomplete({
        source: availableTags
      });

    }

    function getCity(x) {
      var count = $("#city_count"+x).val();
      var id = $("#country"+x).val();
      $.ajax({
        type:'POST',
        url:'city_count.php',
        data:{'id':id,'count':count,'id_count':x},
        success:function(data){
          $('#divcity'+x).html(data);
        }
      });
    }

    function getCountry(x){
      $('#divcity'+x).html("");
      var id = $("#country"+x).val();
      $.ajax({
        type:'POST',
        url:'getCity.php',
        data:{'id':id},
        success:function(data){
                // the next thing you want to do 
                var obj = JSON.parse(data);
                var city = document.getElementById('city'+x);
                $(city).empty();
                //$(city).append("<option selected='selected' value=0>Pilihan</option>");
                for (var i = 0; i < obj.length; i++) {
                  $('#city'+x+i).append("<option value="+obj[i].id+">"+obj[i].name+"</option>");
                  $('#city'+x+i).trigger("chosen:updated");
                }
              }
            });
    }

    // $('#city_count').on('change', function() {
    //     var count = this.value;
    //     var id = $('#country').val();
    //     $.ajax({
    //       type:'POST',
    //       url:'city_count.php',
    //       data:{'id':id,'count':count},
    //       success:function(data){
    //        $('#divcity').html(data);
    //      }
    //    });
    //   });
    // $('#country').on('change', function() {
    //   var id = this.value;
    //   $.ajax({
    //     type:'POST',
    //     url:'getCity.php',
    //     data:{'id':id},
    //     success:function(data){
    //             // the next thing you want to do 
    //             var obj = JSON.parse(data);
    //             var countCity = $("input[name=ccity]").val();
    //             for (j = 0; j < countCity; j++) {
    //               $("#city"+j).empty();

    //               for (var i = 0; i < obj.length; i++) {
    //                 $("#city"+j).append("<option id=city"+j+obj[i].id+" value="+obj[i].id+">"+obj[i].name+"</option>");
    //                 $("#city"+j).trigger("chosen:updated");
    //               }

    //             }

    //           }
    //         });
    // });


    $('input[name="departure"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
        cancelLabel: 'Clear'
      }
    });

    $('input[name="departure"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('input[name="departure"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });

    $("#but_upload").click(function(){

        var countCity = $("input[name=ccity]").val();
        var fd = new FormData();
        var id = $("input[name=id]").val();
        var a = $("input[name=name]").val();
        var b = document.getElementById("category").options[document.getElementById("category").selectedIndex].value;
        var c = $("textarea[name=desc]").val();
        var d = $("input[name=duration]").val();
        var f = $("input[name=minperson]").val();
        var j1 = document.getElementById("type1").options[document.getElementById("type1").selectedIndex].value;
        var k = $("input[name=tdeparture]").val();
        var l1 = $("input[name=img]").val();
        var m = $("input[name=imghead]").val();
        
        if ($("input[name=tagent]").val()==1){
          var p = document.getElementById("agent").options[document.getElementById("agent").selectedIndex].value;
        }
        

        var files = $('#fileToUpload')[0].files[0];
        var files2 = $('#fileToUpload2')[0].files[0];
        fd.append('fileToUpload',files);
        fd.append('fileToUpload2',files2);
        if($('input[name="departure"]').val()==''){
           fd.append('departure',k);
        }else{
          var stringDate = String($('input[name="departure"]').val());
          var start = new Date(stringDate.substr(0, 10));
          var end = new Date(stringDate.substr(13, 24));
          var DateString = "";
          for (var i = 0; i < 2; i++) {
            if(i==0){
              date = new Date(start);
            }else{
              date = new Date(end);
            }
            var month = ((date.getMonth()+1)<10) ? "0" + (date.getMonth()+1) : (date.getMonth()+1);
            var day = (date.getDate() < 10) ? "0" + date.getDate() : date.getDate();
            var year = date.getFullYear();
            if(month==1){
              month = "Jan";
            }else if(month==2){
              month = "Feb";
            }else if(month==3){
              month = "Mar";
            }else if(month==4){
              month = "Apr";
            }else if(month==5){
              month = "May";
            }else if(month==6){
              month = "Jun";
            }else if(month==7){
              month = "Jul";
            }else if(month==8){
              month = "Aug";
            }else if(month==9){
              month = "Sep";
            }else if(month==10){
              month = "Oct";
            }else if(month==11){
              month = "Nov";
            }else if(month==12){
              month = "Dec";
            }
            if(i==0){
              dateString = day+" "+month+" "+year;
            }else{
              dateString = dateString +" - "+day+" "+month+" "+year;
            }
          }
          var e = dateString;
          fd.append('departure',e);
        }

        if($('#fileToUpload')[0].files.length<1 && $('#fileToUpload2')[0].files.length<1){
          fd.append('code',0);
        }else if($('#fileToUpload')[0].files.length<1 && $('#fileToUpload2')[0].files.length>0){
          fd.append('code',2);
        }else if($('#fileToUpload')[0].files.length>0 && $('#fileToUpload2')[0].files.length<1){
          fd.append('code',3);
        }else{
          fd.append('code',1);
        }
       
        fd.append('name',a);
        fd.append('category',b);
        fd.append('desc',c);
        fd.append('duration',d);
        fd.append('minperson',f);
        fd.append('tipping',0);

        var h = "";
        for (var i = 1; i <= $("#country_count").val(); i++) {
          if(i==1){
            h = h + $("#country"+i).val();
          }
          else{
            h = h + ";" + $("#country"+i).val();
          }
        }
        var x = "";
        var l = "";
        for (var j = 1; j <= $("#country_count").val(); j++) {
          if(j==1){
            l = l + $("#city_count"+j).val();
          }else{
            l = l + ";" + $("#city_count"+j).val();
          }

          for (var i = 1; i <= $("#city_count"+j).val(); i++) {
              if(j==1 && i==1){
                x = x + $("#city"+j+i).val();
              }
              else{
                x = x + ";" + $("#city"+j+i).val();
              }
            }
        }
        fd.append('country',h);
        fd.append('city',x);
        fd.append('city_count',l);
        fd.append('type',j1);
        fd.append('img',l1);
        fd.append('img_head',m);
        fd.append('id',id);
        fd.append('kurs',0);
        if($("input[name=tagent]").val()==1){
          fd.append('agent',p);
        }
        
        // var tags = $("input[name=tags7]").val();
        // var tags2 = $("input[name=tags8]").val();
        // var n = tags.indexOf("-")+1;
        // var len = tags.length;
        // var to = tags.substring(n, len);
        // var n2 = tags2.indexOf("-")+1;
        // var len2 = tags2.length;
        // var out = tags2.substring(n2, len2);

        // var find = tags.indexOf("(");
        // var find2 = tags2.indexOf("(");
        // var destination_to = tags.substring(0,find-1);
        // var destination_out = tags2.substring(0,find2-1);

        // fd.append('to',to);
        // fd.append('out',out);
        // fd.append('destination_to',destination_to);
        // fd.append('destination_out',destination_out);

        if(h!='' || h!=0 || x!='' || x!=0){
          $.ajax({
            url: 'updateTourPackage.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                reloadPage(0,0,0);
              }else{
                alert(response);
              }
            },
          });
        }else{
          alert('Tidak Boleh Mengosongi Country / City');
        }

        
    });
});

</script>
