<?php
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM tour_price_detail WHERE id=".$_POST['id'];
$rs=mysqli_query($con,$query);
$row = mysqli_fetch_array($rs);

$querykurs = "SELECT * FROM kurs_bank";
$rskurs=mysqli_query($con,$querykurs);


echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>UPDATE DETAIL PRICE PACKAGE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(3,".$_POST['tid'].",".$_POST['tourpricepackage'].")' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                    <label>Person</label>
                    <input type='text' name='person' id='person' value='".$row['person']."' placeholder='Enter Person'>
                    <input type='text' name='tag' id='tag' value='-' placeholder='Until' value='-' disabled>
                    <input type='text' name='personplus' value='".$row['personplus']."' id='personplus' placeholder='Enter Person'>

                    <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                    <input name='tid' id='tid' value='".$_POST['tid']."' type='hidden' >
                    <input name='tkurs' id='tkurs' value='".$row['kurs']."' type='hidden' >
                    <input name='tourpricepackage' id='tourpricepackage' value='".$_POST['tourpricepackage']."' type='hidden' >
                  </div>
                  <div class='form-group'>
                    <label>Free Person</label>
                    <input type='text' name='tag2' id='tag2' value='+' placeholder='+' value='+' disabled>
                    <input type='text' name='personplus2' id='personplus2' value='".$row['personplus2']."' placeholder='Enter Free Person'>
                  </div>
                  <div class=form-group'>
                    <label>Kurs</label>
                    <select class='form-control select2' name='kurs' id='kurs' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";

                    while($rowkurs = mysqli_fetch_array($rskurs)){
                      echo "<option value=".$rowkurs['id'].">".$rowkurs['name']."</option>";
                    }
                    echo"</select>
                  </div>
                  <div class='form-group'>
                    <label>Price Package</label>
                    <input type='text' class='form-control' name='price' id='price' value=".$row['price']." placeholder='Enter Price Package'>
                  </div>
                  <div class='form-group'>
                    <label>Child With Bed</label>
                    <input type='text' class='form-control' name='cwb' id='cwb' value=".$row['cwb']." placeholder='Enter Price Child With Bed ( Diisi Nominal / Persentase dengan 100% )'>
                  </div>
                  <div class='form-group'>
                    <label>Child No Bed</label>
                    <input type='text' class='form-control' name='cnb' id='cnb' value=".$row['cnb']." placeholder='Enter Price Child No Bed( Diisi Nominal / Persentase dengan contoh : 75% )'>
                  </div>
                  <div class='form-group'>
                    <label>Infant</label>
                    <input type='text' class='form-control' name='inf' id='inf' value=".$row['inf']." placeholder='Enter Price Infant ( Diisi Nominal / Persentase dengan contoh : 30% )'>
                  </div>
                  <div class='form-group'>
                    <label>Single</label>
                    <input type='text' class='form-control' name='adt' id='adt' value=".$row['adt']." placeholder='Enter Price Single ( Diisi Nominal / Persentase dengan contoh : 130% )'>
                  </div>
                  <div class='form-group'>
                    <label>Single Supp</label>
                    <input type='text' class='form-control' name='adt_sub' id='adt_sub' value=".$row['adt_sub']." placeholder='Enter Price Single Supp'>
                  </div>
                  <div class='form-group'>
                    <label>Surcharge Weekend</label>
                    <input type='text' class='form-control' name='surcharge' id='surcharge' value='".$row['surcharge_weekend']."' placeholder='Enter Surcharge Weekend'>
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
    $("#kurs").val($("input[name=tkurs]").val());

    $("#but_upload").click(function(){
         var fd = new FormData();
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

         var x = $("input[name=tid]").val();

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

        }

         fd.append('id',a);
         fd.append('tourpricepackage',b);
         fd.append('price',c);
         fd.append('adt',d);
         fd.append('cwb',e);
         fd.append('cnb',f);
         fd.append('inf',g);
         fd.append('person',h);
         fd.append('kurs',i);
         fd.append('adt_sub',j);
         fd.append('personplus',k);
         fd.append('tag',l);
         fd.append('personplus2',m);
         fd.append('tag2',n);
         fd.append('surcharge',o);

         

         $.ajax({
          url: 'updateDetailPrice.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
            if(response=="success"){
            reloadPage(3,x,b)
            }else{
              alert(response);
            }
          },
        });
     });
         

       
});
</script>
