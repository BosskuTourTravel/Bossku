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
session_start();

$querytour = "SELECT * FROM price_package";
$rstour=mysqli_query($con,$querytour);

$querytourpackage = "SELECT * FROM tour_package WHERE id=".$_POST['id'];
$rstourpackage=mysqli_query($con,$querytourpackage);
$rowtourpackage = mysqli_fetch_array($rstourpackage);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT ITINERARY PACKAGE</h3>
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
                      if($row_inclusion['auto']==0){
                        echo "
                       <label>
                       <input type='checkbox' id='checkboxinvoice' name='checkboxinvoice' value='".$row_inclusion['id']."' />".$row_inclusion['name']."</label>";
                     }else{
                      echo "
                       <label>
                       <input type='checkbox' id='checkboxinvoice' name='checkboxinvoice' value='".$row_inclusion['id']."' checked disabled/>".$row_inclusion['name']."</label>";
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
                    // <input type='checkbox' id='selectAll2' name='selectAll2' checked/>Select All</label>";
                    $query_exclusion = "SELECT * FROM exclusion_tourpackagebase ORDER BY name ASC";
                    $rs_exclusion=mysqli_query($con,$query_exclusion);
                    
                    while($row_exclusion = mysqli_fetch_array($rs_exclusion)){
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

                   echo " </div>
                   </div>
                   </form></br>";
                 
                   

                  // echo "<div class='form-group'>
                  //   <label>Inclusion Description</label>
                  //   <!-- <textarea class='form-control' name='idesc' id='idesc' placeholder='Enter Inclusion Description'> </textarea> -->
                  //   <textarea id='summernote' name='editordata'></textarea>
                  // </div>";

                  echo "<label>Exclusion</label>";
                    echo "<div class='form-group'>
                    <label>Visa : </label>
                    <select name='visa_count' id='visa_count'>
                    <option selected='selected' value=0>Jumlah Visa</option>";

                    for ($x = 1; $x <= 20; $x++){
                      echo "<option value=".$x.">".$x."</option>";
                    }
                    echo"</select>
                    </div>
                    <div class=form-group' name='divvisa' id='divvisa'></div>";
                    echo "<div class='form-group'>
                    <label>Tax Border City : </label>
                    <select name='border_count' id='border_count'>
                    <option selected='selected' value=0>Jumlah Border City</option>";

                    for ($x = 1; $x <= 20; $x++){
                      echo "<option value=".$x.">".$x."</option>";
                    }
                    echo"</select>
                    </div>
                    <div class=form-group' name='divborder' id='divborder'></div>";

                    echo "<div class='form-group'>
                    <label>Guide : </label>
                    <select name='guide_count' id='guide_count'>
                    <option selected='selected' value=0>Jumlah Guide</option>";

                    for ($x = 1; $x <= 20; $x++){
                      echo "<option value=".$x.">".$x."</option>";
                    }
                    echo"</select>
                    </div>
                    <div class=form-group' name='divguide' id='divguide'></div>";
                  
                   
                  
                  echo "<div class='form-group'>
                    <label>Tipping :</label>
                    <select name='kurs' id='kurs' style='margin-right:5px;'>
                    <option selected='selected' value=0>Pilihan Kurs</option>";
                    $querykurs = "SELECT * FROM kurs_bank";
                    $rskurs=mysqli_query($con,$querykurs);

                    while($rowkurs = mysqli_fetch_array($rskurs)){
                      echo "<option value=".$rowkurs['id'].">".$rowkurs['name']."</option>";
                    }
                    echo"</select>
                    <input type='text' style='margin-right:10px;' name='tipping' id='tipping' placeholder='Tipping Price'>

                    <label>Tipping (10-14 pax) :</label>
                    <input type='text' style='margin-right:10px;' name='tipping2' id='tipping2' placeholder='Tipping Price'>

                    <label>Tipping (>15 pax) :</label>
                    <input type='text' style='margin-right:10px;' name='tipping3' id='tipping3' placeholder='Tipping Price'>
                  </div>
                  <div class='form-group'>
                    <label>Ferry :</label>
                    <select name='kurs4' id='kurs4' style='margin-right:5px;'>
                    <option selected='selected' value=0>Pilihan Kurs</option>";
                    $querykurs = "SELECT * FROM kurs_bank";
                    $rskurs=mysqli_query($con,$querykurs);

                    while($rowkurs = mysqli_fetch_array($rskurs)){
                      echo "<option value=".$rowkurs['id'].">".$rowkurs['name']."</option>";
                    }
                    echo"</select>
                    <input type='text' style='margin-right:10px;' name='ferryname' id='ferryname' placeholder='Ferry Name'>
                    <input type='text' style='margin-right:10px;' name='ferry' id='ferry' placeholder='Ferry Price'>
                  </div>
                  <div class='form-group'>
                    <label>Bullet Train : </label>
                    <select name='bullettrain_count' id='bullettrain_count'>
                    <option selected='selected' value=0>Jumlah BulletTrain</option>";

                    for ($x = 1; $x <= 20; $x++){
                      echo "<option value=".$x.">".$x."</option>";
                    }
                    echo"</select>
                    <select name='kurs2' id='kurs2'>
                    <option selected='selected' value=0>Pilihan Kurs</option>";
                    $querykurs = "SELECT * FROM kurs_bank";
                    $rskurs=mysqli_query($con,$querykurs);
                    while($rowkurs2 = mysqli_fetch_array($rskurs)){
                      echo "<option value=".$rowkurs2['id'].">".$rowkurs2['name']."</option>";
                    }
                    echo"</select></div>
                    <div class=form-group' name='divbulletrain' id='divbulletrain'></div>
                   <div class='form-group'>
                    <label>Admission </label>
                    <select name='admission_count' id='admission_count'>
                    <option selected='selected' value=0>Jumlah Admission</option>";

                    for ($x = 1; $x <= 20; $x++){
                      echo "<option value=".$x.">".$x."</option>";
                    }
                    echo"</select>
                      <select name='kurs3' id='kurs3'>
                      <option selected='selected' value=0>Pilihan Kurs</option>";
                      $querykurs = "SELECT * FROM kurs_bank";
                      $rskurs=mysqli_query($con,$querykurs);
                      while($rowkurs3 = mysqli_fetch_array($rskurs)){
                        echo "<option value=".$rowkurs3['id'].">".$rowkurs3['name']."</option>";
                      }
                      echo"</select></div>
                    <div class=form-group' name='divadmission' id='divadmission'></div>
                  <div class='form-group'>
                    <label>Flight </label>
                    <select name='flight_count' id='flight_count'>
                    <option selected='selected' value=0>Jumlah Flight</option>";

                    for ($x = 1; $x <= 20; $x++){
                      echo "<option value=".$x.">".$x."</option>";
                    }
                    echo"</select>
                    <select name='kurs5' id='kurs5'>
                    <option selected='selected' value=0>Pilihan Kurs</option>";
                    $querykurs = "SELECT * FROM kurs_bank";
                    $rskurs=mysqli_query($con,$querykurs);
                    while($rowkurs3 = mysqli_fetch_array($rskurs)){
                      echo "<option value=".$rowkurs3['id'].">".$rowkurs3['name']."</option>";
                    }
                    echo"</select></div>
                    <div class=form-group' name='divflight' id='divflight'></div>

                    <div class='form-group'>
                    <label>Flight Domestic </label>
                    <select name='flightdomestic_count' id='flightdomestic_count'>
                    <option selected='selected' value=0>Jumlah Flight Domestic</option>";

                    for ($x = 1; $x <= 20; $x++){
                      echo "<option value=".$x.">".$x."</option>";
                    }
                    echo"</select>
                    <select name='kursDomestic' id='kursDomestic'>
                    <option selected='selected' value=0>Pilihan Kurs</option>";
                    $querykurs = "SELECT * FROM kurs_bank";
                    $rskurs=mysqli_query($con,$querykurs);
                    while($rowkurs3 = mysqli_fetch_array($rskurs)){
                      echo "<option value=".$rowkurs3['id'].">".$rowkurs3['name']."</option>";
                    }
                    echo"</select></div>
                    <div class=form-group' name='divflightDomestic' id='divflightDomestic'></div>";

                  // echo "<div class='form-group'>
                  //   <label>Exclusion Description</label>
                  //   <!-- <textarea class='form-control' name='edesc' id='edesc' placeholder='Enter Exclusion Description'> </textarea> -->
                  //   <textarea id='summernote2' name='editordata2'></textarea>
                  // </div>";
                

                  echo "<div class='form-group'>
                    <label>Remark Description</label>
                    <!-- <textarea class='form-control' name='rdesc' id='rdesc' placeholder='Enter Remarks Description'> </textarea> -->
                    <textarea id='summernote3' name='editordata3'></textarea>
                  </div>
                

                  <div class='form-group'>
                    <label>Terms & Conditions Description</label>
                    <!-- <textarea class='form-control' name='tdesc' id='tdesc' placeholder='Enter Terms & Conditions Description'> </textarea> -->
                    <textarea id='summernote4' name='editordata4'></textarea>
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


        var strvisa = "";
        var visa_count = document.getElementById("visa_count").options[document.getElementById("visa_count").selectedIndex].value;
        if(visa_count>0){
          for (i = 0; i < visa_count; i++) {
            if(i==0){
              strvisa = strvisa + $("#visa"+i).val();
            }
            else{
              strvisa = strvisa + ";" + $("#visa"+i).val();
            }
          }
        }
        fd.append('strvisa',strvisa);
        var strbordercity = "";
        var strborderkurs = "";
        var strborderprice = "";
        var border_count = document.getElementById("border_count").options[document.getElementById("border_count").selectedIndex].value;
        if(border_count>0){
          for (i = 0; i < border_count; i++) {
            if(i==0){
                strbordercity = strbordercity + $("#bordername"+i).val();
                strborderkurs = strborderkurs + $("#borderkurs"+i).val();
                strborderprice = strborderprice + $("#borderprice"+i).val();
              }
                else{
                strbordercity = strbordercity + ";" + $("#bordername"+i).val();
                strborderkurs = strborderkurs + ";" + $("#borderkurs"+i).val();
                strborderprice = strborderprice + ";" + $("#borderprice"+i).val();
              }
          }
        }
        fd.append('strbordercity',strbordercity);
        fd.append('strborderkurs',strborderkurs);
        fd.append('strborderprice',strborderprice);
        var strguide = "";
        var guide_count = document.getElementById("guide_count").options[document.getElementById("guide_count").selectedIndex].value;
        if(guide_count>0){
          for (i = 0; i < guide_count; i++) {
            if(i==0){
              strguide = strguide + $("#guidevalue"+i).val();
            }
            else{
              strguide = strguide + ";" + $("#guidevalue"+i).val();
            }
          }
        }
        fd.append('strguide',strguide);


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
            url: 'insertAll.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              if(response=="success"){
                alert(response);
                reloadPage(1,a,0);
              }else{
                alert(response);
              }
            },
        });
    });
});

</script>
