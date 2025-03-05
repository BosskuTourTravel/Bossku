<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
 include "../site.php";
 include "../db=connection.php";
 $count = $_POST['count'];
 $total = explode(";", $_POST['total']);
 echo"<form>";
 $d=0;
 $z=1;
 for($i=0; $i < count($total); $i++) {
     $total2[$i]= explode(",", $total[$i]);
    $d = $d + $total2[$i][1];
    $kurs_tour=$total2[$i][2];
echo" 
<div class='form-row'>
<div class='col'>
        <label for='topax'>Jumlah Pax</label>
        <input type='text' class='form-control'  name='topax[]' style='width:200px;'>
</div>
<div class='col'>
<label><center><h2><b>PAKET TOUR : ".$total2[$i][0]." / ".$total2[$i][1]." days<b></h2></center></label></br>
</div>
</div>
<div class='form-row'>
    <div class='col'>
        <label for='foc'>Foc</label>
        <input type='text' class='form-control'  name='foc[]' style='width:200px;'>
    </div>
    <div class='col'>
        <label for='bonus'>Bonus Pax</label>
        <input type='text' class='form-control'  name='bonus[]' style='width:200px;'>
    </div>
    <div class='col'>
        <label for='tl'>TL</label>
        <input type='text' class='form-control'  name='tl[]' style='width:200px;'>
    </div>  
</div>
<div class='form-row'>
    <div class='col'>
        <label>Type Room</label>
        <select class='form-control' id='ftipe_room".$i."'>
        <option value='0'>Single Room</option>
        <option value='1'>Twin Share</option>";
        echo"
        </select>
    </div>
    <div class='col'>
        <label>Type Room</label>
        <select class='form-control' id='btipe_room".$i."'>
        <option value='0'>Single Room</option>
        <option value='1'>Twin Share</option>";
        echo"
        </select>
    </div>
    <div class='col'>
        <label>Type Room</label>
        <select class='form-control' id='ttipe_room".$i."'>
        <option value='0'>Single Room</option>
        <option value='1'>Twin Share</option>";
        echo"
        </select>
    </div>     
</div>";
//var_dump($kurs_tour);
if($kurs_tour=='0' ){
    $kurs_tour='17';
}
for ($y = $z; $y <=$d; $y++ ){
    $kurs1 = "SELECT * FROM kurs_bank where id=".$kurs_tour;
    $rs1=mysqli_query($con,$kurs1);
    $kurs2 = "SELECT * FROM kurs_bank where id=".$kurs_tour;
    $rs2=mysqli_query($con,$kurs2);
    $kurs3 = "SELECT * FROM kurs_bank where id=".$kurs_tour;
    $rs3=mysqli_query($con,$kurs3);
    $kurs4 = "SELECT * FROM kurs_bank where id=".$kurs_tour;
    $rs4=mysqli_query($con,$kurs4);
    $kurs5 = "SELECT * FROM kurs_bank where id=".$kurs_tour;
    $rs5=mysqli_query($con,$kurs5);

echo"<div class='card'>
    <div class='card-body'>
            <label><h2>Days ".$y."</h2></label>
                 <div class='form-group'>
                 <label style='color:red;'>GUIDE</label>
                    <div class='row'>
                        <div class='col-4'>
                            <label>biaya :</label>
                            <input type='text' class='form-control' id='guidebiaya".$y."'>
                        </div>
                        <div class='col-2'>
                        <label>kurs :</label>
                        <select class='form-control' id='guidekurs".$y."'>";
                        while($rowkurs1 = mysqli_fetch_array($rs1)){
                        echo"
                        <option value='".$rowkurs1['id']."'>".$rowkurs1['name']."</option>";
                        }
                        echo"
                        </select>
                    </div>
                    <div class='col-6'>
                        <label>keterangan :</label>
                        <textarea class='form-control' id='guideket".$y."'rows='3'></textarea>
                    </div>
                    </div>
                </div>
                <div class='form-group'>
                <label style='color:red;'>BREAKFAST</label>
                   <div class='row'>
                       <div class='col-4'>
                           <label>biaya :</label>
                           <input type='text' class='form-control' id='bfbiaya".$y."'>
                       </div>
                       <div class='col-2'>
                       <label>kurs :</label>
                       <select class='form-control' id='bfkurs".$y."'>";
                       while($rowkurs5 = mysqli_fetch_array($rs5)){
                       echo"
                       <option value='".$rowkurs5['id']."'>".$rowkurs5['name']."</option>";
                       }
                       echo"
                       </select>
                   </div>
                       <div class='col-6'>
                       <label>keterangan :</label>
                       <textarea class='form-control' id='bfket".$y."'rows='3'></textarea>
                   </div>
                   </div>
               </div>
                <div class='form-group'>
                 <label style='color:red;'>LUNCH</label>
                    <div class='row'>
                        <div class='col-4'>
                            <label>biaya :</label>
                            <input type='text' class='form-control' id='lunchbiaya".$y."'>
                        </div>
                        <div class='col-2'>
                        <label>kurs :</label>
                        <select class='form-control' id='lunchkurs".$y."'>";
                        while($rowkurs2 = mysqli_fetch_array($rs2)){
                        echo"
                        <option value='".$rowkurs2['id']."'>".$rowkurs2['name']."</option>";
                        }
                        echo"
                        </select>
                         </div>
                        <div class='col-6'>
                        <label>keterangan :</label>
                        <textarea class='form-control' id='lunchket".$y."'rows='3'></textarea>
                    </div>
                    </div>
                </div>
                <div class='form-group'>
                 <label style='color:red;'>DINNER</label>
                    <div class='row'>
                        <div class='col-4'>
                            <label>biaya :</label>
                            <input type='text' class='form-control' id='dinnerbiaya".$y."'>
                        </div>
                        <div class='col-2'>
                        <label>kurs :</label>
                        <select class='form-control' id='dinnerkurs".$y."'>";
                        while($rowkurs3 = mysqli_fetch_array($rs3)){
                        echo"
                        <option value='".$rowkurs3['id']."'>".$rowkurs3['name']."</option>";
                        }
                        echo"
                        </select>
                         </div>
                        <div class='col-6'>
                        <label>keterangan :</label>
                        <textarea class='form-control' id='dinnerket".$y."'rows='3'></textarea>
                    </div>
                    </div>
                </div>
                <div class='form-group'>
                 <label style='color:red;'>HOTEL</label>
                    <div class='row'>
                        <div class='col-3'>
                            <label>biaya :</label>
                            <input type='text' class='form-control' id='hotelbiaya".$y."'>
                        </div>
                        <div class='col-3'>
                        <label>kurs :</label>
                        <select class='form-control' id='hotelkurs".$y."'>";
                        while($rowkurs4 = mysqli_fetch_array($rs4)){
                        echo"
                        <option value='".$rowkurs4['id']."'>".$rowkurs4['name']."</option>";
                        }
                        echo"
                        </select>
                        </div>
                        <div class='col-3'>
                        <label>Tipe</label>
                        <select class='form-control' id='hoteltipe".$y."'>
                        <option value='0'>Pax</option>
                        <option value='1'>Room</option>";
                        echo"
                        </select>
                        </div>
                        <div class='col-3'>
                        <label>Value Room</label>
                            <input type='text' class='form-control' id='hotelpax".$y."'>
                        </div>
                    </div>
                </div>
                <div class='form-group'>
                <label>keterangan :</label>
                        <textarea class='form-control' id='hotelket".$y."'rows='3'></textarea>
                </div>

     </div>
     </div>";
    }
    $z= $z + $total2[$i][1];
 }
 
                echo"
                <div class='form-group'>
                <input type='hidden' id='harit' name='harit' value='".$count."'>
                <input type='hidden' id='count' name='count' value='".count($total)."'>
                <input type='hidden' id='total' name='total' value='".$_POST['total']."'>
                </div>";
                echo"
                <button type='button' id='submit' class='btn btn-warning' >Submit</button>
                </form>";


 ?>
<script>
$(document).ready(function(){
$("#submit").click(function(){
var fd = new FormData();
   var harit = $("input[name=harit]").val();
  var total = $("input[name=total]").val();
  var count = $("input[name=count]").val();

//    var strtotal = total.split(";");
//    for(var i = 0; i < strtotal.length; i++){
//         strtotal2[i] = strtotal[i].split(",");
//         for(var x = 0; x < strtotal.length; x++){
       
//         }
//    }
var topax = [];
var foc = [];
var  bonus= [];
var tl=[];


$('input[name="topax[]"]').each( function() {
        topax.push(this.value);
    });
$('input[name="foc[]"]').each( function() {
    foc.push(this.value);
});
$('input[name="bonus[]"]').each( function() {
    bonus.push(this.value);
});
$('input[name="tl[]"]').each( function() {
    tl.push(this.value);
});
// $('input[name="ftipe_room[]"]').each( function() {
//     ftr.push(this.value);
// });
// $('input[name="btipe_room[]"]').each( function() {
//     btr.push(this.value);
// });
// $('input[name="ttipe_room[]"]').each( function() {
//     ttr.push(this.value);
// });

   var gb="";
   var gk="";
   var gt="";

   var lb="";
   var lk="";
   var lt="";
   
   var db="";
   var dk="";
   var dt="";
   
   var hb="";
   var hk="";
   var hp="";
   var ht="";
   
   var bb="";
   var bk="";
   var bt="";
   var htipe="";

   var ftr="";
   var btr="";
   var ttr="";
   for (var i = 0; i < $("#count").val(); i++) {
    if(i==0){
        ftr = ftr + $("#ftipe_room"+i).val();
        btr = btr + $("#btipe_room"+i).val();
        ttr = ttr + $("#ttipe_room"+i).val();
    }else{
        ftr = ftr + ";" + $("#ftipe_room"+i).val();
        btr = btr + ";" + $("#btipe_room"+i).val();
        ttr = ttr + ";" + $("#ttipe_room"+i).val();
    }
   }

   for (var i = 1; i <= $("#harit").val(); i++) {
          if(i==1){
            gb = gb + $("#guidebiaya"+i).val();
            gk = gk + $("#guidekurs"+i).val();
            gt = gt + $("#guideket"+i).val();

            lb = lb + $("#lunchbiaya"+i).val();
            lk = lk + $("#lunchkurs"+i).val();
            lt = lt + $("#lunchket"+i).val();

            db = db + $("#dinnerbiaya"+i).val();
            dk = dk + $("#dinnerkurs"+i).val();
            dt = dt + $("#dinnerket"+i).val();

            hb = hb + $("#hotelbiaya"+i).val();
            hk = hk + $("#hotelkurs"+i).val();
            ht = ht + $("#hotelket"+i).val();
            hp = hp + $("#hotelpax"+i).val();
            htipe = htipe + $("#hoteltipe"+i).val();

            
            bb = bb + $("#bfbiaya"+i).val();
            bk = bk + $("#bfkurs"+i).val();
            bt = bt + $("#bfket"+i).val();
          }
          else{
            gb = gb + ";" + $("#guidebiaya"+i).val();
            gk = gk + ";" + $("#guidekurs"+i).val();
            gt = gt + ";" + $("#guideket"+i).val();

            lb = lb + ";" + $("#lunchbiaya"+i).val();
            lk = lk + ";" + $("#lunchkurs"+i).val();
            lt = lt + ";" + $("#lunchket"+i).val();

            db = db + ";" + $("#dinnerbiaya"+i).val();
            dk = dk + ";" + $("#dinnerkurs"+i).val();
            dt = dt + ";" + $("#dinnerket"+i).val();

            hb = hb + ";" + $("#hotelbiaya"+i).val();
            hk = hk + ";" + $("#hotelkurs"+i).val();
            ht = ht + ";" + $("#hotelket"+i).val();
            hp = hp + ";" + $("#hotelpax"+i).val();
            htipe = htipe + ";" + $("#hoteltipe"+i).val();
            
            bb = bb + ";" + $("#bfbiaya"+i).val();
            bk = bk + ";" + $("#bfkurs"+i).val();
            bt = bt + ";" + $("#bfket"+i).val();
          }
        }

fd.append('gb',gb);
fd.append('gk',gk);
fd.append('gt',gt);

fd.append('lb',lb);
fd.append('lk',lk);
fd.append('lt',lt);


fd.append('db',db);
fd.append('dk',dk);
fd.append('dt',dt);


fd.append('hb',hb);
fd.append('hk',hk);
fd.append('ht',ht);
fd.append('hp',hp);
fd.append('htipe',htipe);


fd.append('bb',bb);
fd.append('bk',bk);
fd.append('bt',bt);


fd.append('harit',harit);
fd.append('total',total);
fd.append('topax',topax);
fd.append('foc',foc);
fd.append('bonus',bonus);
fd.append('tl',tl);
fd.append('ftr',ftr);
fd.append('btr',btr);
fd.append('ttr',ttr);
//alert(ftipe_room);
        $.ajax({
            url: 'search_hotelq.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(data){
            $('#divjobi2').html(data);
            }
                 });
 
});
});
</script>
