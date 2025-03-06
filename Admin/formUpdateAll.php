<link href="dist/css/summernote/summernote.css" rel="stylesheet">
<script src="dist/css/summernote/summernote.js"></script>

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

#checkboxes2 {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes2 label {
  display: block;
}

#checkboxes2 label:hover {
  background-color: #1e90ff;
}


</style>
<script>
var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

function showCheckboxes2() {
  var checkboxes = document.getElementById("checkboxes2");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

</script>

<?php
include "../site.php";
include "../db=connection.php";

$querytour = "SELECT * FROM price_package";
$rstour=mysqli_query($con,$querytour);

$query_package = "SELECT * FROM tour_package WHERE id = ".$_POST['id'];
$rs_package=mysqli_query($con,$query_package);
$row_package = mysqli_fetch_array($rs_package);

$query_exclusion_plus = "SELECT * FROM exclusion_plus WHERE tour_package = ".$_POST['id'];
$rs_exclusion_plus=mysqli_query($con,$query_exclusion_plus);
$row_exclusion_plus = mysqli_fetch_array($rs_exclusion_plus);

$query_exclusion_tourpackage_plus = "SELECT * FROM exclusion_tourpackage_plus WHERE tour_package = ".$_POST['id'];
$rs_exclusion_tourpackage_plus=mysqli_query($con,$query_exclusion_tourpackage_plus);
$row_exclusion_tourpackage_plus = mysqli_fetch_array($rs_exclusion_tourpackage_plus);

$query_inclusion = "SELECT * FROM inclusion WHERE tour_package = ".$_POST['id'];
$rs_inclusion=mysqli_query($con,$query_inclusion);
$row_inclusion = mysqli_fetch_array($rs_inclusion);

$query_exclusion = "SELECT * FROM exclusion WHERE tour_package = ".$_POST['id'];
$rs_exclusion=mysqli_query($con,$query_exclusion);
$row_exclusion = mysqli_fetch_array($rs_exclusion);

$query_remark = "SELECT * FROM remark WHERE tour_package = ".$_POST['id'];
$rs_remark=mysqli_query($con,$query_remark);
$row_remark = mysqli_fetch_array($rs_remark);

$query_termsandconditions = "SELECT * FROM termsandconditions WHERE tour_package = ".$_POST['id'];
$rs_termsandconditions=mysqli_query($con,$query_termsandconditions);
$row_termsandconditions = mysqli_fetch_array($rs_termsandconditions);

if($row_exclusion_plus['bullettrain_name']!=''){
    $tempBulletName = preg_split ("/[;]+/", $row_exclusion_plus['bullettrain_name']);
    $tempBulletPrice = preg_split ("/[;]+/", $row_exclusion_plus['bullettrain_price']);

  }
if($row_exclusion_plus['admission_name']!=''){
    $tempAdmissionName = preg_split ("/[;]+/", $row_exclusion_plus['admission_name']);
    $tempAdmissionPrice = preg_split ("/[;]+/", $row_exclusion_plus['admission_price']);
}

if($row_exclusion_plus['flight_name']!=''){
    $tempFlightName = preg_split ("/[;]+/", $row_exclusion_plus['flight_name']);
    $tempFlightPrice = preg_split ("/[;]+/", $row_exclusion_plus['flight_price']);
}



if($row_exclusion_tourpackage_plus['visa_id']!=''){
    $tempVisa = preg_split ("/[;]+/", $row_exclusion_tourpackage_plus['visa_id']);

  }
if($row_exclusion_tourpackage_plus['border_city']!=''){
    $tempBorderCity = preg_split ("/[;]+/", $row_exclusion_tourpackage_plus['border_city']);
    $tempBorderKurs = preg_split ("/[;]+/", $row_exclusion_tourpackage_plus['border_kurs']);
    $tempBorderPrice = preg_split ("/[;]+/", $row_exclusion_tourpackage_plus['border_price']);
}

if($row_exclusion_tourpackage_plus['guide_language']!=''){
    $tempGuide = preg_split ("/[;]+/", $row_exclusion_tourpackage_plus['guide_language']);
}

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM UPDATE ALL</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(1,".$_POST['id'].",0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                  <input name='id' id='id' value='".$_POST['id']."' type='hidden' >";
                  echo "<form>
                    <div class='multiselect' id='divselect'>
                    <div class='selectBox' onclick='showCheckboxes()'>
                    <select>
                    <option>Inclusion</option>
                    </select>
                    <div class='overSelect'></div>
                    </div>
                    <div id='checkboxes'>";
                    // echo "<label>
                    // <input type='checkbox' id='selectAll' name='selectAll' />Select All</label>";
                    $query_inclusion = "SELECT * FROM inclusion_tourpackagebase ORDER BY name ASC";
                    $rs_inclusion=mysqli_query($con,$query_inclusion);
                    
                    while($row_inclusion = mysqli_fetch_array($rs_inclusion)){

                     $query_inclusionbase = "SELECT COUNT(*) as total FROM inclusion_tourpackage WHERE inclusion_tourpackagebase_id=".$row_inclusion['id']." AND tour_package=".$_POST['id'];
                     $rs_inclusionbase=mysqli_query($con,$query_inclusionbase);
                     $row_inclusionbase = mysqli_fetch_assoc($rs_inclusionbase);
                     if($row_inclusionbase['total']==0){
                      if($row_inclusion['auto']==0){
                        echo "
                        <label>
                        <input type='checkbox' id='checkboxinvoice' name='checkboxinvoice' value='".$row_inclusion['id']."' />".$row_inclusion['name']."</label>";
                      }else{
                        echo "
                        <label>
                        <input type='checkbox' id='checkboxinvoice' name='checkboxinvoice' value='".$row_inclusion['id']."' checked disabled/>".$row_inclusion['name']."</label>";
                      }
                    }else{
                      if($row_inclusion['auto']==0){
                        echo "
                        <label>
                        <input type='checkbox' id='checkboxinvoice' name='checkboxinvoice' value='".$row_inclusion['id']."' checked/>".$row_inclusion['name']."</label>";
                      }else{
                        echo "
                        <label>
                        <input type='checkbox' id='checkboxinvoice' name='checkboxinvoice' value='".$row_inclusion['id']."' checked disabled/>".$row_inclusion['name']."</label>";
                      }

                    }
                  }

                  echo " </div>
                  </div>
                  </form></br>";


                  echo "<form>
                  <div class='multiselect' id='divselect'>
                  <div class='selectBox' onclick='showCheckboxes2()'>
                  <select>
                  <option>Exclusion</option>
                  </select>
                  <div class='overSelect'></div>
                  </div>
                  <div id='checkboxes2'>";
                  // echo "<label>
                  // <input type='checkbox' id='selectAll2' name='selectAll2' />Select All</label>";
                  $query_exclusion = "SELECT * FROM exclusion_tourpackagebase ORDER BY name ASC";
                  $rs_exclusion=mysqli_query($con,$query_exclusion);

                  while($row_exclusion = mysqli_fetch_array($rs_exclusion)){
                    $query_exclusionbase = "SELECT COUNT(*) as total FROM exclusion_tourpackage WHERE exclusion_tourpackagebase_id=".$row_exclusion['id']." AND tour_package=".$_POST['id'];
                    $rs_exclusionbase=mysqli_query($con,$query_exclusionbase);
                    $row_exclusionbase = mysqli_fetch_assoc($rs_exclusionbase);
                    while($row_exclusion = mysqli_fetch_array($rs_exclusion)){
                    $query_exclusionbase = "SELECT COUNT(*) as total FROM exclusion_tourpackage WHERE exclusion_tourpackagebase_id=".$row_exclusion['id']." AND tour_package=".$_POST['id'];
                    $rs_exclusionbase=mysqli_query($con,$query_exclusionbase);
                    $row_exclusionbase = mysqli_fetch_assoc($rs_exclusionbase);
                    if($row_exclusionbase['total']==0){
                      if($row_exclusion['auto']==0){
                        echo "
                        <label>
                        <input type='checkbox' id='checkboxinvoice2' name='checkboxinvoice2' value='".$row_exclusion['id']."'/>".$row_exclusion['name']."</label>";
                      }else{
                        echo "
                        <label>
                        <input type='checkbox' id='checkboxinvoice2' name='checkboxinvoice2' value='".$row_exclusion['id']."' checked disabled/>".$row_exclusion['name']."</label>";
                      }
                    }else{
                      if($row_exclusion['auto']==0){
                        echo "
                        <label>
                        <input type='checkbox' id='checkboxinvoice2' name='checkboxinvoice2' value='".$row_exclusion['id']."' checked/>".$row_exclusion['name']."</label>";  
                      }else{
                        echo "
                        <label>
                        <input type='checkbox' id='checkboxinvoice2' name='checkboxinvoice2' value='".$row_exclusion['id']."' checked disabled/>".$row_exclusion['name']."</label>";  
                      }
                      
                    }
                    
                  }

                  }

                   echo " </div>
                   </div>
                   </form></br>";

                  // echo "<div class='form-group'>
                  //   <label>Inclusion Description</label>
                  //   <!-- <textarea class='form-control' name='idesc' id='idesc' placeholder='Enter Inclusion Description'> </textarea> -->
                  //   <textarea id='summernote' name='editordata'>".$row_inclusion['name']."</textarea>
                  // </div>";

                  echo "<label>Exclusion</label>";
                  echo "<div class='form-group'>
                    <label>Visa : </label>
                    <select name='visa_count' id='visa_count'>
                    <option selected='selected' value=0>Jumlah Visa</option>";
                    for ($x = 1; $x <= 20; $x++){
                      if($x==count($tempVisa)){
                         echo "<option selected='selected' value=".$x.">".$x."</option>";
                      }else{
                        echo "<option value=".$x.">".$x."</option>";
                      }
                    }
                    echo"</select>
                    </div>
                    <div class=form-group' name='divvisa' id='divvisa'>";
                    if($tempVisa!=''){
                      for ($i = 0; $i < count($tempVisa); $i++){
                        echo "<div class='form-group'><input type='text' style='margin-right:10px;' name='visaname".$i."' id='visaname".$i."' value='Visa' disabled>";


                        echo "<select name='visa".$i."' id='visa".$i."'>
                        <option selected='selected' value=0>Pilihan Visa</option>";
                        $query_visi = "SELECT * FROM visa ORDER BY continent ASC, country ASC, id DESC";
                        $rs_visi=mysqli_query($con,$query_visi);
                        while($row_visi = mysqli_fetch_array($rs_visi)){
                          $querycountry2 = "SELECT * FROM country WHERE id=".$row_visi['country'];
                          $rscountry2=mysqli_query($con,$querycountry2);
                          $rowcountry2 = mysqli_fetch_array($rscountry2);

                          $queryembassy = "SELECT * FROM embassy WHERE id=".$row_visi['embassy'];
                          $rsembassy=mysqli_query($con,$queryembassy);
                          $rowembassy = mysqli_fetch_array($rsembassy);

                          $query_city = "SELECT * FROM city WHERE id=".$rowembassy['city'];
                          $rs_city=mysqli_query($con,$query_city);
                          $row_city = mysqli_fetch_array($rs_city);
                          if($row_visi['id']==$tempVisa[$i]){
                            echo "<option selected='selected' value=".$row_visi['id'].">".$rowcountry2['name']." - ".$row_visi['type']." - ".$row_visi['day']."days - Rp ".number_format($row_visi['price'], 0, ".", ".")."</option>";
                          }else{
                            echo "<option value=".$row_visi['id'].">".$rowcountry2['name']." - ".$row_visi['type']." - ".$row_visi['day']."days - Rp ".number_format($row_visi['price'], 0, ".", ".")."</option>";
                          }
                          
                        }
                        echo"</select>";
                      }
                    }
                    echo "</div>";
                    echo "<div class='form-group'>
                    <label>Tax Border City : </label>
                    <select name='border_count' id='border_count'>
                    <option selected='selected' value=0>Jumlah Border City</option>";

                    for ($x = 1; $x <= 20; $x++){
                      if($x==count($tempBorderCity)){
                         echo "<option selected='selected' value=".$x.">".$x."</option>";
                      }else{
                        echo "<option value=".$x.">".$x."</option>";
                      }
                    }
                    echo"</select>
                    </div>
                    <div class=form-group' name='divborder' id='divborder'>";
                     if($tempBorderCity!=''){
                      for ($i = 0; $i < count($tempBorderCity); $i++){
                        echo "<div class='form-group'><input type='text' style='margin-right:10px;' name='bordername".$i."' id='bordername".$i."' value='".$tempBorderCity[$i]."'>";
                        echo "<select name='borderkurs".$i."' id='borderkurs".$i."' style='margin-right:10px;'>
                        <option selected='selected' value=0>Pilihan Kurs</option>";
                        $querykurs = "SELECT * FROM kurs_bank";
                        $rskurs=mysqli_query($con,$querykurs);
                        while($rowkurs2 = mysqli_fetch_array($rskurs)){
                          if($rowkurs2['id']==$tempBorderKurs[$i]){
                            echo "<option selected='selected' value=".$rowkurs2['id'].">".$rowkurs2['name']."</option>";
                          }else{
                            echo "<option value=".$rowkurs2['id'].">".$rowkurs2['name']."</option>";
                          }
                          
                        }
                        echo"</select>";
                        echo "<input type='text'  name='borderprice'".$i." id='borderprice".$i."' value='".$tempBorderPrice[$i]."'></div>";
                      }
                    }
                    echo "</div>";

                    echo "<div class='form-group'>
                    <label>Guide : </label>
                    <select name='guide_count' id='guide_count'>
                    <option selected='selected' value=0>Jumlah Guide</option>";

                    for ($x = 1; $x <= 20; $x++){
                      if($x==count($tempGuide)){
                         echo "<option selected='selected' value=".$x.">".$x."</option>";
                      }else{
                        echo "<option value=".$x.">".$x."</option>";
                      }
                    }
                    echo"</select>
                    </div>
                    <div class=form-group' name='divguide' id='divguide'>";
                    if($tempGuide!=''){
                      for ($i = 0; $i < count($tempGuide); $i++){
                        echo "<div class='form-group'><input type='text' style='margin-right:10px;' name='guidename".$i."' id='guidename".$i."' value='Guide berbahasa' disabled><input type='text'  name='guidevalue'".$i." id='guidevalue".$i."' value='".$tempGuide[$i]."'></div>";
                      }
                    }
                    echo "</div>";

                  echo "<div class='form-group'>
                    <label>Tipping :</label>
                    <select name='kurs' id='kurs' style='margin-right:5px;'>
                    <option selected='selected' value=0>Pilihan Kurs</option>";
                    $querykurs = "SELECT * FROM kurs_bank";
                    $rskurs=mysqli_query($con,$querykurs);

                    while($rowkurs = mysqli_fetch_array($rskurs)){
                      if($rowkurs['id']==$row_package['kurs'] || $rowkurs['id']==$row_exclusion_plus['kurs']){
                        echo "<option selected='selected' value=".$rowkurs['id'].">".$rowkurs['name']."</option>";
                      }else{
                        echo "<option value=".$rowkurs['id'].">".$rowkurs['name']."</option>";
                      }
                      
                    }
                    echo"</select>
                    <input type='text' style='margin-right:10px;' name='tipping' id='tipping' value='".$row_package['tipping']."' placeholder='Tipping Price'>

                    <label>Tipping (10-14 pax) :</label>
                    <input type='text' style='margin-right:10px;' name='tipping2' id='tipping2' value='".$row_exclusion_plus['tipping2']."' placeholder='Tipping Price'>

                    <label>Tipping (>15 pax) :</label>
                    <input type='text' style='margin-right:10px;' name='tipping3' id='tipping3' value='".$row_exclusion_plus['tipping3']."' placeholder='Tipping Price'>
                  </div>
                  <div class='form-group'>
                    <label>Ferry :</label>
                    <select name='kurs4' id='kurs4' style='margin-right:5px;'>
                    <option selected='selected' value=0>Pilihan Kurs</option>";
                    $querykurs = "SELECT * FROM kurs_bank";
                    $rskurs=mysqli_query($con,$querykurs);

                    while($rowkurs = mysqli_fetch_array($rskurs)){
                      if($rowkurs['id'] == $row_exclusion_plus['ferry_kurs']){
                        echo "<option selected='selected' value=".$rowkurs['id'].">".$rowkurs['name']."</option>";
                      }else{
                        echo "<option value=".$rowkurs['id'].">".$rowkurs['name']."</option>";
                      }
                      
                    }
                    echo"</select>
                    <input type='text' style='margin-right:10px;' name='ferryname' id='ferryname' value='".$row_exclusion_plus['ferry_name']."' placeholder='Ferry Name'>
                    <input type='text' style='margin-right:10px;' name='ferry' id='ferry' value='".$row_exclusion_plus['ferry_price']."' placeholder='Ferry Price'>
                  </div>
                  <div class='form-group'>
                    <label>Bullet Train : </label>
                    <select name='bullettrain_count' id='bullettrain_count'>
                    <option selected='selected' value=0>Jumlah BulletTrain</option>";

                    for ($x = 1; $x <= 20; $x++){
                      if($x==count($tempBulletName)){
                         echo "<option selected='selected' value=".$x.">".$x."</option>";
                      }else{
                        echo "<option value=".$x.">".$x."</option>";
                      }
                    }
                    echo"</select>
                    <select name='kurs2' id='kurs2'>
                    <option selected='selected' value=0>Pilihan Kurs</option>";
                    $querykurs = "SELECT * FROM kurs_bank";
                    $rskurs=mysqli_query($con,$querykurs);
                    while($rowkurs2 = mysqli_fetch_array($rskurs)){
                      if($rowkurs2['id']==$row_exclusion_plus['bullettrain_kurs']){
                        echo "<option selected='selected' value=".$rowkurs2['id'].">".$rowkurs2['name']."</option>";
                      }else{
                        echo "<option value=".$rowkurs2['id'].">".$rowkurs2['name']."</option>";
                      }
                      
                    }
                    echo"</select></div>
                    <div class=form-group' name='divbulletrain' id='divbulletrain'>";
                    if($tempBulletName!=''){
                      for ($x = 0; $x < count($tempBulletName); $x++){
                        echo "<div class='form-group'><input type='text' style='margin-right:10px;' name='bulletrainname".$x."' id='bulletrainname".$x."' value=".$tempBulletName[$x]." placeholder='BulletTrain Name'><input type='text'  name='bulletrain'".$x." id='bulletrain".$x."' value=".$tempBulletPrice[$x]." placeholder='BulletTrain Price'></div>";
                      }
                    }
                    echo"</div>
                   <div class='form-group'>
                    <label>Admission </label>
                    <select name='admission_count' id='admission_count'>
                    <option selected='selected' value=0>Jumlah Admission</option>";

                    for ($x = 1; $x <= 20; $x++){
                       if($x==count($tempAdmissionName)){
                         echo "<option selected='selected' value=".$x.">".$x."</option>";
                      }else{
                        echo "<option value=".$x.">".$x."</option>";
                      }
                    }
                    echo"</select>
                    <select name='kurs3' id='kurs3'>
                    <option selected='selected' value=0>Pilihan Kurs</option>";
                    $querykurs = "SELECT * FROM kurs_bank";
                    $rskurs=mysqli_query($con,$querykurs);
                    while($rowkurs3 = mysqli_fetch_array($rskurs)){
                      if($rowkurs3['id']==$row_exclusion_plus['admission_kurs']){
                        echo "<option selected='selected' value=".$rowkurs3['id'].">".$rowkurs3['name']."</option>";
                      }else{
                        echo "<option value=".$rowkurs3['id'].">".$rowkurs3['name']."</option>";
                      }
                      
                    }
                    echo"</select></div>
                    <div class=form-group' name='divadmission' id='divadmission'>";
                    if($tempAdmissionName!=''){
                      for ($x = 0; $x < count($tempAdmissionName); $x++){
                        echo "<div class='form-group'><input type='text' style='margin-right:10px;' name='admissionname".$x."' id='admissionname".$x."' value=".$tempAdmissionName[$x]." placeholder='Admission Name'><input type='text'  name='admission'".$x." id='admission".$x."' value=".$tempAdmissionPrice[$x]." placeholder='Admission Price'></div>";
                      }
                    }
                    echo "</div>
                  <div class='form-group'>
                    <label>Flight </label>
                    <select name='flight_count' id='flight_count'>
                    <option selected='selected' value=0>Jumlah Flight</option>";

                    for ($x = 1; $x <= 20; $x++){
                       if($x==count($tempFlightName)){
                         echo "<option selected='selected' value=".$x.">".$x."</option>";
                      }else{
                        echo "<option value=".$x.">".$x."</option>";
                      }
                    }
                    echo"</select>
                    <select name='kurs5' id='kurs5'>
                    <option selected='selected' value=0>Pilihan Kurs</option>";
                    $querykurs = "SELECT * FROM kurs_bank";
                    $rskurs=mysqli_query($con,$querykurs);
                    while($rowkurs3 = mysqli_fetch_array($rskurs)){
                      if($rowkurs3['id']==$row_exclusion_plus['flight_kurs']){
                        echo "<option selected='selected' value=".$rowkurs3['id'].">".$rowkurs3['name']."</option>";
                      }else{
                        echo "<option value=".$rowkurs3['id'].">".$rowkurs3['name']."</option>";
                      }
                      
                    }
                    echo"</select></div>
                    <div class=form-group' name='divflight' id='divflight'>";

                    $query_flightdomestic = "SELECT * FROM flight_domestic_tourpackage WHERE tour_package=".$_POST['id'];
                    $rs_flightdomestic=mysqli_query($con,$query_flightdomestic);
                    $row_flightdomestic = mysqli_fetch_array($rs_flightdomestic);
                    $xDomestic = 0;

                    $query_flightdomestic2 = "SELECT COUNT(*) as total FROM flight_domestic_tourpackage WHERE tour_package=".$_POST['id'];
                    $rs_flightdomestic2=mysqli_query($con,$query_flightdomestic2);
                    $row_flightdomestic2 = mysqli_fetch_assoc($rs_flightdomestic2);
                    echo "<div class='form-group'>
                    <label>Flight Domestic </label>
                    <select name='flightdomestic_count' id='flightdomestic_count'>
                    <option selected='selected' value=0>Jumlah Flight Domestic</option>";

                    for ($x = 1; $x <= 20; $x++){
                      if($row_flightdomestic2['total']==$x){
                        echo "<option selected='selected' value=".$x.">".$x."</option>";
                      }else{
                        echo "<option value=".$x.">".$x."</option>";
                      }
                      
                    }
                    echo"</select>
                    <select name='kursDomestic' id='kursDomestic'>
                    <option selected='selected' value=0>Pilihan Kurs</option>";
                    $querykurs = "SELECT * FROM kurs_bank";
                    $rskurs=mysqli_query($con,$querykurs);
                    while($rowkurs3 = mysqli_fetch_array($rskurs)){
                      if($row_flightdomestic['kurs']==$rowkurs3['id']){
                        echo "<option selected='selected' value=".$rowkurs3['id'].">".$rowkurs3['name']."</option>";
                      }else{
                        echo "<option value=".$rowkurs3['id'].">".$rowkurs3['name']."</option>";
                      }
                      
                    }
                    echo"</select></div>
                    <div class=form-group' name='divflightDomestic' id='divflightDomestic'>";
                    $query_flightdomestic = "SELECT * FROM flight_domestic_tourpackage WHERE tour_package=".$_POST['id'];
                    $rs_flightdomestic=mysqli_query($con,$query_flightdomestic);
                    while($row_flightdomestic = mysqli_fetch_array($rs_flightdomestic)){

                      $tempFrom = $row_flightdomestic['destination_from'] . " () - " . $row_flightdomestic['froms'];
                      $tempTo = $row_flightdomestic['destination_to'] . " () - " . $row_flightdomestic['tos'];

                      echo "
                      <div class='form-row align-items-center'>
                      <div class='col-3'>
                      <label>From</label>
                      <input class='form-control' type='text' onkeyup='getFromTransit(this.value,".$xDomestic.")' name='tags1".$xDomestic."' id='tags1".$xDomestic."' value='".$tempFrom."' style='height:2%;'/>
                      </div>
                      <div class='col-3'>
                      <label>To</label>
                      <input class='form-control' type='text' onkeyup='getToTransit(this.value,".$xDomestic.")' name='tags2".$xDomestic."' id='tags2".$xDomestic."' value='".$tempTo."'  style='height:2%;'/>
                      </div>
                      <div class='col-3'>
                      <label>Price</label>
                      <input class='form-control' type='text' name='price".$xDomestic."' id='price".$xDomestic."' value='".$row_flightdomestic['price']."' style='height:2%;'/>
                      </div>

                      </div>";
                      $xDomestic = $xDomestic + 1;
                    }



                    echo "</div>";




                    if($tempFlightName!=''){
                      for ($x = 0; $x < count($tempFlightName); $x++){
                        echo "<div class='form-group'><input type='text' style='margin-right:10px;' name='flightname".$x."' id='flightname".$x."' value=".$tempFlightName[$x]." placeholder='Flight Name'><input type='text'  name='flight'".$x." id='flight".$x."' value=".$tempFlightPrice[$x]." placeholder='Flight Price'></div>";
                      }
                    }
                    echo "</div>";

                  // echo "<div class='form-group'>
                  //   <label>Exclusion Description</label>
                  //   <!-- <textarea class='form-control' name='edesc' id='edesc' placeholder='Enter Exclusion Description'> </textarea> -->
                  //   <textarea id='summernote2' name='editordata2'>".$row_exclusion['name']."</textarea>
                  // </div>";
                

                  echo "<div class='form-group'>
                    <label>Remark Description</label>
                    <!-- <textarea class='form-control' name='rdesc' id='rdesc' placeholder='Enter Remarks Description'> </textarea> -->
                    <textarea id='summernote3' name='editordata3'>".$row_remark['description']."</textarea>
                  </div>
                

                  <div class='form-group'>
                    <label>Terms & Conditions Description</label>
                    <!-- <textarea class='form-control' name='tdesc' id='tdesc' placeholder='Enter Terms & Conditions Description'> </textarea> -->
                    <textarea id='summernote4' name='editordata4'>".$row_termsandconditions['name']."</textarea>
                  </div>
                  </div>

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
?>

<script>


  $(document).ready(function(){
    $('#summernote').summernote();
    $('#summernote2').summernote();
    $('#summernote3').summernote();
    $('#summernote4').summernote();
    var availableTags = [];

    $('#visa_count').on('change', function() {
        var count = this.value;
        $.ajax({
          type:'POST',
          url:'getExclusionVisa.php',
          data:{'count':count},
          success:function(data){
           $('#divvisa').html(data);
         }
       });
      });

    $('#border_count').on('change', function() {
        var count = this.value;
        $.ajax({
          type:'POST',
          url:'getExclusionBorder.php',
          data:{'count':count},
          success:function(data){
           $('#divborder').html(data);
         }
       });
      });

    $('#guide_count').on('change', function() {
        var count = this.value;
        var str = "";
        var i;
        for (i = 0; i < count; i++) {
         str = str + "<div class='form-group'><input type='text' style='margin-right:10px;' name='guidename"+i+"' id='guidename"+i+"' value='Guide berbahasa' disabled><input type='text'  name='guidevalue'"+i+" id='guidevalue"+i+"' placeholder='Input Bahasa Guide'></div>";
        }
        $('#divguide').html(str);
      });

    $('#bullettrain_count').on('change', function() {
        var count = this.value;
        var str = "";
        var i;
        for (i = 0; i < count; i++) {
         str = str + "<div class='form-group'><input type='text' style='margin-right:10px;' name='bulletrainname"+i+"' id='bulletrainname"+i+"' placeholder='BulletTrain Name'><input type='text'  name='bulletrain'"+i+" id='bulletrain"+i+"' placeholder='BulletTrain Price'></div>";
        }
        $('#divbulletrain').html(str);
      });

    $('#admission_count').on('change', function() {
        var count = this.value;
        var str = "";
        var i;
        for (i = 0; i < count; i++) {
         str = str + "<div class='form-group'><input type='text' style='margin-right:10px;' name='admissionname"+i+"' id='admissionname"+i+"' placeholder='Admission Name'><input type='text' name='admission'"+i+" id='admission"+i+"' placeholder='Admission Price'></div>";
        }
        $('#divadmission').html(str);
      });

    $('#flight_count').on('change', function() {
        var count = this.value;
        var str = "";
        var i;
        for (i = 0; i < count; i++) {
         str = str + "<div class='form-group'><input type='text' style='margin-right:10px;' name='flightname"+i+"' id='flightname"+i+"' placeholder='Flight Name'><input type='text'  name='flight'"+i+" id='flight"+i+"' placeholder='Flight Price'></div>";
        }
        $('#divflight').html(str);
      });

    $('#flightdomestic_count').on('change', function() {
        var count = this.value;
        $.ajax({
          type:'POST',
          url:'getFlightDomestic.php',
          data:{'count':count},
          success:function(data){
           $('#divflightDomestic').html(data);
         }
       });
      });

     $("#selectAll").click(function() {
      $("input[name=checkboxinvoice]").prop("checked", $(this).prop("checked"));
    });
    $("#selectAll2").click(function() {
      $("input[name=checkboxinvoice2]").prop("checked", $(this).prop("checked"));
    });

    $("#but_upload").click(function(){

        var fd = new FormData();
        var a = $("input[name=id]").val();
        // var b = $("textarea[name=editordata]").val();
        // var c = $("textarea[name=editordata2]").val();
        var d = $("textarea[name=editordata3]").val();
        var e = $("textarea[name=editordata4]").val();
        var f = $("input[name=tipping]").val();
        var g = document.getElementById("kurs").options[document.getElementById("kurs").selectedIndex].value;
        var h = $("input[name=ferryname]").val();
        var i = $("input[name=ferry]").val();
        var j = document.getElementById("kurs4").options[document.getElementById("kurs4").selectedIndex].value;
        var k = document.getElementById("kurs2").options[document.getElementById("kurs2").selectedIndex].value;
        var l = document.getElementById("kurs3").options[document.getElementById("kurs3").selectedIndex].value;
        var m = document.getElementById("kurs5").options[document.getElementById("kurs5").selectedIndex].value;
        var n = $("input[name=tipping2]").val();
        var o = $("input[name=tipping3]").val();

        if(f==''){
          f=0;
        }
        if(n==''){
          n=0;
        }
        if(o==''){
          o=0;
        }
        if(h==''){
          h='';
        }
        if(i==''){
          i='';
        }

        var flightdomestic_count = document.getElementById("flightdomestic_count").options[document.getElementById("flightdomestic_count").selectedIndex].value;
        var kursDomestic = document.getElementById("kursDomestic").options[document.getElementById("kursDomestic").selectedIndex].value;
        fd.append('flightdomestic_count',flightdomestic_count);
        fd.append('kursDomestic',kursDomestic);


        for (i = 0; i < flightdomestic_count; i++) {
          var tags = $("input[name=tags1"+i+"]").val();
          var tags2 = $("input[name=tags2"+i+"]").val();
          var price = $("input[name=price"+i+"]").val();

          var n = tags.indexOf("-")+1;
          var len = tags.length;
          var from = tags.substring(n, len);
          var n2 = tags2.indexOf("-")+1;
          var len2 = tags2.length;
          var to = tags2.substring(n2, len2);

          var find = tags.indexOf("(");
          var find2 = tags2.indexOf("(");
          var destination_from = tags.substring(0,find-1);
          var destination_to = tags2.substring(0,find2-1);

          fd.append('from'+i,from);
          fd.append('to'+i,to);
          fd.append('destination_from'+i,destination_from);
          fd.append('destination_to'+i,destination_to);
          fd.append('price'+i,price);

        }

        fd.append('id',a);
        // fd.append('inclusion',b);
        // fd.append('exclusion',c);
        fd.append('remark',d);
        fd.append('term',e);
        fd.append('title','');
        fd.append('tipping',f);
        fd.append('kurs',g);
        fd.append('ferryname',h);
        fd.append('ferry',i);
        fd.append('ferrykurs',j);
        fd.append('admissionkurs',l);
        fd.append('flightkurs',m);
        fd.append('bulletkurs',k);
        fd.append('tipping2',n);
        fd.append('tipping3',o);

        var strbullet = "";
        var strbulletprice = "";
        var stradmission = "";
        var stradmissionprice = "";
        var strflight = "";
        var strflightprice = "";

        var bulletCount = document.getElementById("bullettrain_count").options[document.getElementById("bullettrain_count").selectedIndex].value;
        var admissionCount = document.getElementById("admission_count").options[document.getElementById("admission_count").selectedIndex].value;
        var flightCount = document.getElementById("flight_count").options[document.getElementById("flight_count").selectedIndex].value;
        fd.append('bulletCount',bulletCount);
        fd.append('admissionCount',admissionCount);
        fd.append('flightCount',flightCount);

        if(bulletCount>0){
          for (i = 0; i < bulletCount; i++) {
            if(i==0){
                strbullet = strbullet + $("#bulletrainname"+i).val();
                strbulletprice = strbulletprice + $("#bulletrain"+i).val();
              }
                else{
                strbullet = strbullet + ";" + $("#bulletrainname"+i).val();
                strbulletprice = strbulletprice + ";" + $("#bulletrain"+i).val();
              }
          }
        }else{
          strbullet='';
          strbulletprice='';
        }

        if(admissionCount>0){

          for (i = 0; i < admissionCount; i++) {
            if(i==0){
                stradmission = stradmission + $("#admissionname"+i).val();
                stradmissionprice = stradmissionprice + $("#admission"+i).val();
              }
                else{
                stradmission = stradmission + ";" + $("#admissionname"+i).val();
                stradmissionprice = stradmissionprice + ";" + $("#admission"+i).val();
              }
          }
        }else{
          stradmission='';
          stradmissionprice='';
        }

        if(flightCount>0){
          for (i = 0; i < flightCount; i++) {
            if(i==0){
                strflight = strflight + $("#flightname"+i).val();
                strflightprice = strflightprice + $("#flight"+i).val();
              }
                else{
                strflight = strflight + ";" + $("#flightname"+i).val();
                strflightprice = strflightprice + ";" + $("#flight"+i).val();
              }
          }
        }else{
          strflight='';
          strflightprice='';
        }

        fd.append('bulletname',strbullet);
        fd.append('bulletprice',strbulletprice);
        fd.append('admissionname',stradmission);
        fd.append('admissionprice',stradmissionprice);
        fd.append('flightname',strflight);
        fd.append('flightprice',strflightprice);

        var inclusion = [];
        var exclusion = [];
        $.each($("input[name='checkboxinvoice']:checked"), function(){
          inclusion.push($(this).val());
        });

        $.each($("input[name='checkboxinvoice2']:checked"), function(){
          exclusion.push($(this).val());
        });

      // for (i = 0; i < inclusion.length; i++) {
      //  alert(inclusion[i]);
      // }

      inclusion = JSON.stringify(inclusion);
      exclusion = JSON.stringify(exclusion);

      fd.append('inclusion',inclusion);
      fd.append('exclusion',exclusion);

        $.ajax({
            url: 'updateAll.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
              	alert(response);
                reloadPage(1,a,0);
              }
            },
        });
    });
});


function getFromTransit(x,y){

    $.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
      var i=0;
      for(i=0;i<data.length;i++){
        availableTags[i]=data[i].PlaceName + " ( "+ data[i].CountryName +" ) " + " - " + data[i].PlaceId;
      }

    });

    $( "#tags1"+y ).autocomplete({
      source: availableTags
    });

  }

  function getToTransit(x,y){

    $.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/'+x+'?isDestination=true&enable_general_search_v2=true',function(data){
      var i=0;
      for(i=0;i<data.length;i++){
        availableTags[i]=data[i].PlaceName  + " ( "+ data[i].CountryName +" ) " + " - " + data[i].PlaceId;
      }

    });

    $( "#tags2"+y ).autocomplete({
      source: availableTags
    });

  }  

</script>
