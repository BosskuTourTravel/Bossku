<?php
include "../site.php";
include "../db=connection.php";

$querytour = "SELECT * FROM price_package";
$rstour=mysqli_query($con,$querytour);
$querykurs = "SELECT * FROM kurs_bank";
$rskurs=mysqli_query($con,$querykurs);


echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM DETAIL PRICE PACKAGE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(3,".$_POST['id'].",".$_POST['tourpricepackage'].")' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>

              <div class='card card-primary'>
              
              <!-- /.card-header -->
              <!-- form start -->
              <form role='form' method='post' action='insertPricePackage.php'>
                <div class='card-body'>
                  <div class='form-group'>
                    <label>Total Person</label>
                    <input type='text' name='person' id='person' placeholder='Enter Person'>
                    <input type='text' name='tag' id='tag' placeholder='Until' value='-' disabled>
                    <input type='text' name='personplus' id='personplus' value='0' placeholder='Enter Person'>

                    <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                    <input name='tourpricepackage' id='tourpricepackage' value='".$_POST['tourpricepackage']."' type='hidden' >
                  </div>
                 
                  <div class='form-group'>
                    <label>Free Person</label>
                    <input type='text' name='tag2' id='tag2' placeholder='+' value='+' disabled>
                    <input type='text' name='personplus2' id='personplus2' value='0' placeholder='Enter Free Person'>
                  </div>
                  <div class=form-group'>
                    <label>Kurs</label>
                    <select class='chosen' name='kurs' id='kurs' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowkurs = mysqli_fetch_array($rskurs)){
                      echo "<option value=".$rowkurs['id'].">".$rowkurs['name']."</option>";
                    }
                    echo"</select>
                  </div>
                  <div class='form-group'>
                    <label>Adult</label>
                    <input type='text' class='form-control' name='price' id='price' placeholder='Enter Price Adult'>
                  </div>
                  <div class='form-group'>
                    <label>Child With Bed</label>
                    <input type='text' class='form-control' name='cwb' id='cwb' placeholder='Enter Price Child With Bed ( Diisi Nominal / Persentase dengan 100% )'>
                  </div>
                  <div class='form-group'>
                    <label>Child No Bed</label>
                    <input type='text' class='form-control' name='cnb' id='cnb' placeholder='Enter Price Child No Bed ( Diisi Nominal / Persentase dengan contoh : 75% )'>
                  </div>
                  <div class='form-group'>
                    <label>Infant</label>
                    <input type='text' class='form-control' name='inf' id='inf' placeholder='Enter Price Infant ( Diisi Nominal / Persentase dengan contoh : 30% )'>
                  </div>
                  <div class='form-group'>
                    <label>Single</label>
                    <input type='text' class='form-control' name='adt' id='adt' placeholder='Enter Price Single ( Diisi Nominal / Persentase dengan contoh : 130% )'>
                  </div>
                  <div class='form-group'>
                    <label>Single Supp</label>
                    <input type='text' class='form-control' name='adt_sub' id='adt_sub' placeholder='Enter Price Single Supp'>
                  </div>
                   <div class='form-group'>
                    <label>Surcharge Weekend</label>
                    <input type='text' class='form-control' name='surcharge' id='surcharge' placeholder='Enter Surcharge Weekend'>
                  </div>
                <div class='card-footer'>
                  <button type='button' class='btn btn-primary' onclick='insertDetailPricePackage()'>Submit</button>
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
    $(".chosen").chosen();
  });
  function insertDetailPricePackage(){
    var a = $("input[name=id]").val();
    var b = $("input[name=tourpricepackage]").val();
    var c = $("input[name=price]").val();
    var d = $("input[name=adt]").val();
    var e = $("input[name=cwb]").val();
    var f = $("input[name=cnb]").val();
    var g = $("input[name=inf]").val();
    var h = $("input[name=person]").val();
    var i = document.getElementById("kurs").options[document.getElementById("kurs").selectedIndex].value;
    var j = $("input[name=adt_sub]").val();
    var k = $("input[name=personplus]").val();
    var l = $("input[name=tag]").val();
    var m = $("input[name=personplus2]").val();
    var n = $("input[name=tag2]").val();
    var o = $("input[name=surcharge]").val();

    if(d==''){
      d = 0;
    }

    if(e==''){
      e = '100%';
    }

    if(f==''){
      f = '75%';
    }

    if(g==''){
      g = '30%';
    }
    if(j==''){
    	j = 0;
    }

    if(o==''){
    	o = 0;
    }

    if(d==0 && j==0){
    	d = c * 130 / 100;
      $.ajax({
        url:"insertDetailPricePackage.php",
        method: "POST",
        asynch: false,
        data:{id:a,person:h,tourpricepackage:b,price:c,adt:d,cwb:e,cnb:f,inf:g,kurs:i,adt_sub:j,personplus:k,tag:l,personplus2:m,tag2:n,surcharge:o},
        success:function(data){
          if(data=="success"){
            reloadPage(3,a,b);
          }else{
            alert(data);
          }
        }
      });
    }else{
    	$.ajax({
        url:"insertDetailPricePackage.php",
        method: "POST",
        asynch: false,
        data:{id:a,person:h,tourpricepackage:b,price:c,adt:d,cwb:e,cnb:f,inf:g,kurs:i,adt_sub:j,personplus:k,tag:l,personplus2:m,tag2:n,surcharge:o},
        success:function(data){
          if(data=="success"){
            reloadPage(3,a,b);
          }else{
            alert(data);
          }
        }
      });
    }

    
    
  }
</script>
