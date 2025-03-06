<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
session_start();

$querycontinent = "SELECT * FROM continent";
$rscontinent=mysqli_query($con,$querycontinent);

$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);

$querystaff = "SELECT * FROM login_staff WHERE type=3 OR type=4";
$rsstaff=mysqli_query($con,$querystaff);

$querytourtype = "SELECT * FROM tour_type";
$rstourtype=mysqli_query($con,$querytourtype);

$querycity = "SELECT * FROM city";
$rscity=mysqli_query($con,$querycity);

$queryrating = "SELECT * FROM hotel_rating";
$rsrating=mysqli_query($con,$queryrating);

$querytimedate = "SELECT * FROM tour_package WHERE timedate LIKE '".$_GET['timedate']."'";
$rstimedate=mysqli_query($con,$querytimedate);

if($_POST['id']==1){

  echo "<select class='chosen1' name='scontinent' id='scontinent' class='form-control'>
  <option selected='selected' value=0>Search By Continent</option>";

  while($rowcontinent = mysqli_fetch_array($rscontinent)){
    echo "<option value='".$rowcontinent['id']."'>".$rowcontinent['name']."</option>";
  }
  echo"</select>";
  echo "<select class='chosen1' name='scountry' id='scountry' class='form-control' >
  <option selected='selected' value=0>Search By Country</option>";

  while($rowcountry = mysqli_fetch_array($rscountry)){
    echo "<option value='".$rowcountry['id']."'>".$rowcountry['name']."</option>";
  }
  echo"</select>";
  echo "<select class='chosen1' name='scity' id='scity' class='form-control'>
  <option selected='selected' value=0>Search By City</option>";

  while($rowcity = mysqli_fetch_array($rscity)){
    echo "<option value='".$rowcity['id']."'>".$rowcity['name']."</option>";
  }

  echo"</select>";

  echo "<select class='chosen1' name='stourtype' id='stourtype' class='form-control' >
  <option selected='selected' value=''>Search By TourType</option>";

  while($rowtourtype = mysqli_fetch_array($rstourtype)){
    echo "<option value='".$rowtourtype['name']."'>".$rowtourtype['name']."</option>";
  }

  echo"</select>";

  echo "<select class='chosen1' name='srating' id='srating' class='form-control'>
  <option selected='selected' value=0>Search By Rating</option>";

  while($rowrating = mysqli_fetch_array($rsrating)){
    echo "<option value='".$rowrating['id']."'>".$rowrating['name']."</option>";
  }

  echo"</select>";

  echo "<input type='text' name='minpersonFilter' id='minpersonFilter' placeholder='Search Min Person' >

  <button onclick='searchPage(-1,0)' class='btn btn-default' >Search Filter</button>";

}elseif ($_POST['id']==2) {

  echo "<select class='chosen1' name='sstaff' id='sstaff' class='form-control'>
  <option selected='selected' value=0>Search By Staff</option>";

  while($rowstaff = mysqli_fetch_array($rsstaff)){
    echo "<option value='".$rowstaff['id']."'>".$rowstaff['name']."</option>";
  }

  echo"</select>";

  echo "<select class='chosen1' name='stourtype' id='stourtype' class='form-control'>
  <option selected='selected' value=''>Search By TourType</option>";

  while($rowtourtype = mysqli_fetch_array($rstourtype)){
    echo "<option value='".$rowtourtype['name']."'>".$rowtourtype['name']."</option>";
  }

  echo"</select>";

  echo "<button onclick='searchPage(2,0)' class='btn btn-default' >Search Filter</button>";

}elseif ($_POST['id']==3) {
  echo "<select class='chosen1' name='scountry' id='scountry' class='form-control'>
  <option selected='selected' value=0>Search By Country</option>";

  while($rowcountry = mysqli_fetch_array($rscountry)){
    echo "<option value='".$rowcountry['id']."'>".$rowcountry['name']."</option>";
  }
  echo"</select>";
  echo "<select class='chosen1' name='scity' id='scity' class='form-control' disabled>
  <option selected='selected' value=0>Search By City</option>";

  while($rowcity = mysqli_fetch_array($rscity)){
    echo "<option value='".$rowcity['id']."'>".$rowcity['name']."</option>";
  }

  echo"</select>";
  echo "<select class='chosen1' name='stourtype' id='stourtype' class='form-control'>
  <option selected='selected' value=''>Search By TourType</option>";

  while($rowtourtype = mysqli_fetch_array($rstourtype)){
    echo "<option value='".$rowtourtype['name']."'>".$rowtourtype['name']."</option>";
  }

  echo"</select><input type='text' name='minpersonFilter' id='minpersonFilter' placeholder='Search Min Person'>

  <button onclick='searchPage(0,0)' class='btn btn-default' >Search Filter</button>";

}elseif ($_POST['id']==4) {
  echo "<select class='chosen1' name='scity' id='scity' class='form-control'>
  <option selected='selected' value=0>Search By City</option>";

  while($rowcity = mysqli_fetch_array($rscity)){
    echo "<option value='".$rowcity['id']."'>".$rowcity['name']."</option>";
  }

  echo"</select>";
  echo "<select class='chosen1' name='stourtype' id='stourtype' class='form-control'>
  <option selected='selected' value=''>Search By TourType</option>";

  while($rowtourtype = mysqli_fetch_array($rstourtype)){
    echo "<option value='".$rowtourtype['name']."'>".$rowtourtype['name']."</option>";
  }

  echo"</select><input type='text' name='minpersonFilter' id='minpersonFilter' placeholder='Search Min Person'>

  <button onclick='searchPage(3,0)' class='btn btn-default' >Search Filter</button>";
}elseif ($_POST['id']==5) {
  echo"</select>
  <input type='text' name='minpersonFilter' id='minpersonFilter'  placeholder='Search Min Person'>

  <button onclick='searchPage(0,0)'>Search Filter</button>";

}elseif ($_POST['id']==6) {
  echo "<select class='chosen1' name='stourtype' id='stourtype' onchange='searchPage(4,this.value)' class='form-control'>
  <option selected='selected' value=0>Search By TourType</option>";

  while($rowtourtype = mysqli_fetch_array($rstourtype)){
    echo "<option value='".$rowtourtype['name']."'>".$rowtourtype['name']."</option>";
  }

  echo"</select>";

}elseif ($_POST['id']==7) {

  echo "<select class='chosen1' name='scountry' id='scountry' class='form-control'>
  <option selected='selected' value=0>Search By Country</option>";

  while($rowcountry = mysqli_fetch_array($rscountry)){
    echo "<option value='".$rowcountry['id']."'>".$rowcountry['name']."</option>";
  }
  echo"</select>";
  echo "<select class='chosen1' name='scity' id='scity' class='form-control' disabled>
  <option selected='selected' value=0>Search By City</option>";

  while($rowcity = mysqli_fetch_array($rscity)){
    echo "<option value='".$rowcity['id']."'>".$rowcity['name']."</option>";
  }

  echo"</select>";
  echo "<select class='chosen1' name='srating' id='srating' class='form-control'>
  <option selected='selected' value=0>Search By Rating</option>";

  while($rowrating = mysqli_fetch_array($rsrating)){
    echo "<option value='".$rowrating['id']."'>".$rowrating['name']."</option>";
  }

  echo"</select><input type='text' name='minpersonFilter' id='minpersonFilter' placeholder='Search Min Person'>

  <button onclick='searchPage(5,0)' class='btn btn-default' >Search Filter</button>";

}elseif ($_POST['id']==8) {
  echo"</select>
  <input type='date' name='timedate' id='timedate'  placeholder='Search Date Input'>
  <button onclick='searchPage(0,0)'>Search Filter</button>";
  while ($row = mysqli_fetch_array($rstimedate)) {
     "<option value='".$row['timedate']."'>".$row['timedate']."</option>";
  }
}
?>

<script>
   $(document).ready(function(){
    $(".chosen1").chosen();
  });
</script>

