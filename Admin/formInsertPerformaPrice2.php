<?php
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM performa_price_range";
$rs=mysqli_query($con,$query);

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM PRICE PACKAGE</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(-2,".$_POST['id'].",0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                <div class=form-group'>
                  <label>Range Price</label>
                    <select class='form-control select2' name='range' id='range' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";
                   while($row = mysqli_fetch_array($rs)) {
                      if($row['price2']==1){
                        echo "<option value=".$row['id']."> < ".number_format($row['price1'], 0, ".", ".")."</option>";
                      }else if($row['price2']==0){
                        echo "<option value=".$row['id'].">".number_format($row['price1'], 0, ".", ".")." > .. </option>";
                      }else{
                        echo "<option value=".$row['id'].">".number_format($row['price1'], 0, ".", ".")." - ".number_format($row['price2'], 0, ".", ".")."</option>";
                      }
                    }
                    echo"</select>

                  </div>
                  <div class='form-group'>
                    <input name='id' id='id' value='".$_POST['id']."' type='hidden' >
                  </div>
                  <div class=form-group'>
                    <label>Persentase</label>
                    <input type='text' class='form-control' name='persentase' id='persentase' placeholder='Enter Persentase'>
                  </div>
                  <div class=form-group'>
                    <label>Nominal</label>
                    <input type='text' class='form-control' name='nominal' id='nominal' placeholder='Enter Nominal'>
                  </div>
                  <div class=form-group'>
                  <label>Option Price</label>
                    <select class='form-control select2' name='flag' id='flag' style='width: 100%;'>
                    <option selected='selected' value=0>Pilihan</option>";
                    for ($x = 1; $x <3; $x++) {
                      echo "<option value=".$x.">".$x."</option>";
                    }
                    echo"</select>

                  </div>
                  <div class=form-group'>
                    <label>Agent Com</label>
                    <input type='text' class='form-control' name='agentcom' id='agentcom' placeholder='Enter AgentCom ( Diisi Nominal / Persentase dengan 100% )'>
                  </div>
                  <div class=form-group'>
                    <label>Staff Com</label>
                    <input type='text' class='form-control' name='staffcom' id='staffcom' placeholder='Enter StaffCom ( Diisi Nominal / Persentase dengan 100% )'>
                  </div>
                  <div class=form-group'>
                    <label>Sub Agent</label>
                    <input type='text' class='form-control' name='subagent' id='subagent' placeholder='Enter Sub Agent ( Diisi Nominal / Persentase dengan 100% )'>
                  </div>
                  <div class=form-group'>
                    <label>Marketing Com</label>
                    <input type='text' class='form-control' name='marketingcom' id='marketingcom' placeholder='Enter Marketing Com ( Diisi Nominal / Persentase dengan 100% )'>
                  </div>

                  <div class=form-group'>
                    <label>Discount</label>
                    <input type='text' class='form-control' name='discount' id='discount' placeholder='Enter Marketing Com'>
                  </div>
                <div class='card-footer'>
                  <button type='button' class='btn btn-primary'  id='but_upload'>Submit</button>
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
 // function insertPerformaPrice(){
   // var x = $("input[name=id]").val();
    //var y = $("input[name=persentase]").val();
   // var z = $("input[name=nominal]").val();
   // var c = $("input[name=agentcom]").val();
   // var d = document.getElementById("flag").options[document.getElementById("flag").selectedIndex].value;
    //var e = document.getElementById("range").options[document.getElementById("range").selectedIndex].value;
    //var f = $("input[name=staffcom]").val();
    //var g = $("input[name=subagent]").val();
    //var h = $("input[name=marketingcom]").val();
    //var i = $("input[name=discount]").val();
    //var j = $("#staffcom2").val();

    //$.ajax({
      //  url:"insertPerformaPrice.php",
       // method: "POST",
        //asynch: false,
        //data:{id:x,name:y,persentase:y,nominal:z,agentcom:c,flag:d,range:e,staffcom:f,subagent:g,marketingcom:h,discount:i},
        //success:function(data){
         // reloadPage(-2,x,0);
        //}
      //});
    
  //}

  $(document).ready(function(){
    $(".chosen").chosen();
    $("#but_upload").click(function(){
        var fd = new FormData();
     
        var a = $("#agent").val();
        var b = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;
        var c = $("#persentase").val();
        var d = $("#nominal").val();
        var e = $("#flag").val();
        var f = $("#agentcom").val();
        var g = $("#staffcom").val();
        var k = $("#staffcom2").val();
        var h = $("#subagent").val();
        var i = $("#marketingcom").val();
        var j = $("#discount").val();
       
        fd.append('agent',a);
        fd.append('country',b);
        fd.append('persentase',c);
        fd.append('nominal',d);
        fd.append('flag',e);
        fd.append('agentcom',f);
        fd.append('staffcom',g);
        fd.append('staffcom2',k);
        fd.append('subagent',h);
        fd.append('marketingcom',i);
        fd.append('discount',j);


        $.ajax({
            url: 'insertPerformaPriceAgent.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
            	if(response=="success"){
                alert(response);
            		reloadPage(-13,0,0);
            	}
              
            },
        });
    });
});
</script>
