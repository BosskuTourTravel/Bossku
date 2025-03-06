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
include "../site.php";
include "../db=connection.php";

session_start();

if($_SESSION['staff_id']=='null' || $_SESSION['staff_id']=='undefined' || $_SESSION['staff_id']==''){
  echo "<script>alert('Session Login Berakhir, Harap Login Kembali!');</script>";
  echo "<script>window.location='https://www.2canholiday.com/member/';</script>";
}

$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);

$querycategory = "SELECT * FROM tour_category";
$rscategory=mysqli_query($con,$querycategory);

$querytourtype = "SELECT * FROM tour_type";
$rstourtype=mysqli_query($con,$querytourtype);

$querycity = "SELECT * FROM city";
$rscity=mysqli_query($con,$querycity);

$querykurs = "SELECT * FROM kurs_bank";
$rskurs=mysqli_query($con,$querykurs);

$query_agent = "SELECT * FROM agent";
$rs_agent=mysqli_query($con,$query_agent);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM INSERT TOUR PACKAGE</h3>
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
               <button type='submit' onclick='insertPage(10,".$_POST['id'].",0)' class='btn btn-primary'>MULTIPLE LANDTOUR</button>


              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='' name='form' id='form' enctype='multipart/form-data'>
                <div class='card-body'>";
                if($_POST['id']!=0){
                    echo "<input type='text' class='form-control' name='files_id' id='files_id' value='".$_POST['id']."' hidden>";
                }else{
                  echo "<input type='text' class='form-control' name='files_id' id='files_id' value='0' hidden>";
                }
                if($_POST['id2']==0){
                  if($_SESSION['type']==1 or $_SESSION['staff']=="Joana" or $_SESSION['staff']=="Antonio Chandra"){
                     echo "<div class='form-group'>
                        <label>Agent</label>
                        <select class='chosen' name='agent' id='agent' class='form-control'>
                        <option selected='selected' value=0>Pilihan</option>";

                        while($row_agent = mysqli_fetch_array($rs_agent)){
                          echo "<option value='".$row_agent['id']."'>".$row_agent['company']."</option>";
                        }
                        echo"</select>
                      </div>";
                    }
                  }
                  if($_POST['id2']!=0){
                    echo "<input type='text' class='form-control' name='agent_post' id='agent_post' value='".$_POST['id2']."' hidden>";
                  }else{
                    echo "<input type='text' class='form-control' name='agent_post' id='agent_post' value='-1' hidden>";
                  }
                  
                  echo "<div class='form-group'>
                    <label>Tour Name</label>
                    <input type='text' class='form-control' name='name' id='name' placeholder='Enter Name'>
                  </div>
                  <div class='form-group'>
                    <label>Description</label>
                    <textarea class='form-control' name='desc' id='desc' placeholder='Enter Description'> </textarea>
                  </div>
                  <div class='form-group'>
                    <label>Category</label>
                    <select name='category' id='category' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowcategory = mysqli_fetch_array($rscategory)){
                      echo "<option value='".$rowcategory['name']."'>".$rowcategory['name']."</option>";
                    }
                    echo"</select>
                  </div>
                  <div class='form-group'>
                    <label>Tour Type</label>
                    <select name='type' id='type' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowtourtype = mysqli_fetch_array($rstourtype)){
                      echo "<option value='".$rowtourtype['name']."'>".$rowtourtype['name']."</option>";
                    }
                    echo"</select>
                  </div>
                  <div class='form-group'>
                    <label>Duration Tour</label>
                    <input type='text' class='form-control' name='duration' id='duration' placeholder='Enter Duration'>
                  </div>
                  <div class='form-group'>
                    <label>Validity</label>
                    <input class='form-control' type='text' name='departure' value='' style='width: 100%;' />
                  </div>
                  <div class='form-group'>
                    <label>Min Person</label>
                    <input type='text' class='form-control' name='minperson' id='minperson' placeholder='Enter Min Person'>
                  </div>
                  <div class='form-group' hidden>
                    <label>Tipping</label>
                    <select name='kurs' id='kurs'>
                    <option selected='selected' value=0>Pilihan Kurs</option>";

                    while($rowkurs = mysqli_fetch_array($rskurs)){
                      echo "<option value=".$rowkurs['id'].">".$rowkurs['name']."</option>";
                    }
                    echo"</select>
                    <input type='text' class='form-control' name='tipping' id='tipping' placeholder='Enter Tipping Tour Per Person'>
                  </div>
                  </br>
                  <div class='form-row align-items-center'>";

                  // echo "<div class='col-4'>
                  // <label>Flight To</label>
                  // <input class='form-control' type='text' onkeyup='getFromX(this.value,7)' name='tags7' id='tags7' style='height:2%;'/>

                  // </div>";
                  // <div class='col-4'>
                  // <label>Flight Out</label>
                  // <input class='form-control' type='text' onkeyup='getFromX(this.value,8)' name='tags8' id='tags8' style='height:2%;'/>
                  // </div>
                  // </div></br>
                  // <div class=form-group'>
                  //   <label>Country</label>
                  //   <select name='country_count' id='country_count'>
                  //   <option selected='selected' value=0>Jumlah Country</option>";

                  //   for ($x = 1; $x <= 20; $x++){
                  //     echo "<option value=".$x.">".$x."</option>";
                  //   }
                  //  echo "</select></div>
                  //  <div class=form-group' name='divcountry' id='divcountry'></div>
                  //  </br>
                    
                  echo "<div class='form-group'>
                    <label for='exampleInputFile'>File input</label>
                    <div class='input-group'>
                      <div class='custom-file'>
                        <input name='fileToUpload' id='fileToUpload' accept='image/*' type='file' />
                      </div>
                  </div>
                  </div><div class='form-group'>
                    <label for='exampleInputFile'>File input Img Head</label>
                    <div class='input-group'>
                      <div class='custom-file'>
                        <input name='fileToUpload2' id='fileToUpload2' accept='image/*' type='file' />
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
?>

<script>

  $(document).ready(function(){
    var availableTags = [];
  	$(".chosen").chosen();
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
        var fd = new FormData();
        var a = $("input[name=name]").val();
        var b = document.getElementById("category").options[document.getElementById("category").selectedIndex].value;
        var c = $("textarea[name=desc]").val();
        var d = $("input[name=duration]").val();
        var f = $("input[name=minperson]").val();
        //var g = $("input[name=tipping]").val();
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
        var j = document.getElementById("type").options[document.getElementById("type").selectedIndex].value;
        // var k = document.getElementById("kurs").options[document.getElementById("kurs").selectedIndex].value;
        var cek = $("input[name=agent_post]").val();
        if(cek==-1){
          var k = document.getElementById("agent").options[document.getElementById("agent").selectedIndex].value;
        }else{
          var k = $("input[name=agent_post]").val();
        }
        var m = $("input[name=files_id]").val();
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

        var files = $('#fileToUpload')[0].files[0];
        var files2 = $('#fileToUpload2')[0].files[0];
        fd.append('fileToUpload',files);
        fd.append('fileToUpload2',files2);
        fd.append('name',a);
        fd.append('category',b);
        fd.append('desc',c);
        fd.append('duration',d);
        fd.append('departure',e);
        fd.append('minperson',f);
        fd.append('tipping',0);
        fd.append('country',h);
        fd.append('city',x);
        fd.append('type',j);
        fd.append('kurs',1);
        fd.append('agent',k);
        fd.append('city_count',l);
        fd.append('files_id',m);

        if($('#fileToUpload')[0].files.length<1 && $('#fileToUpload2')[0].files.length<1){
          fd.append('code',0);
        }else if($('#fileToUpload')[0].files.length<1 && $('#fileToUpload2')[0].files.length>0){
          fd.append('code',2);
        }else if($('#fileToUpload')[0].files.length>0 && $('#fileToUpload2')[0].files.length<1){
          fd.append('code',3);
        }else{
          fd.append('code',1);
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


        $.ajax({
            url: 'insertTourPackage.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
            	if(response=="success"){
                alert(response);
            		reloadPage(0,0,0);
            	}else{
                alert(response);
              }
              
            },
        });
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

</script>
