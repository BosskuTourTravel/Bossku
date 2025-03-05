<?php
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM performa_price_range";
$rs=mysqli_query($con,$query);

$queryperforma = "SELECT * FROM performa_price_standart WHERE id = ".$_POST['id'];
$rsperforma=mysqli_query($con,$queryperforma);
$rowperforma = mysqli_fetch_array($rsperforma);

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
                      <button type='submit' onclick='reloadPage(-15,".$_POST['agent'].",".$_POST['country'].")' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                    <input name='tid' id='tid' value='".$_POST['country']."' type='hidden' >
                    <input name='tagent' id='tagent' value='".$_POST['agent']."' type='hidden' >
                    <input name='trange' id='trange' value='".$rowperforma['performa_price_range']."' type='hidden' >
                  </div>
                  <div class=form-group'>
                    <label>Persentase</label>
                    <input type='text' class='form-control' name='persentase' id='persentase' value='".$rowperforma['persentase']."' placeholder='Enter Persentase'>
                  </div>
                  <div class=form-group'>
                    <label>Nominal</label>
                    <input type='text' class='form-control' name='nominal' id='nominal' value='".$rowperforma['nominal']."' placeholder='Enter Nominal'>
                  </div>
                  <div class=form-group'>
                    <label>Agent Com</label>
                    <input type='text' class='form-control' name='agentcom' id='agentcom' value='".$rowperforma['agentcom']."' placeholder='Enter AgentCom'>
                  </div>
                  <div class=form-group'>
                    <label>Staff Com</label>
                    <input type='text' class='form-control' name='staffcom' id='staffcom' value='".$rowperforma['staffcom']."' placeholder='Enter StaffCom'>
                  </div>
                  <div class=form-group'>
                    <label>Sub Agent</label>
                    <input type='text' class='form-control' name='subagent' id='subagent' value='".$rowperforma['subagent']."' placeholder='Enter Sub Agent'>
                  </div>
                  <div class=form-group'>
                    <label>Marketing Com</label>
                    <input type='text' class='form-control' name='marketingcom' id='marketingcom' value='".$rowperforma['marketingcom']."' placeholder='Enter Marketing Com'>
                  </div>
                  <div class=form-group'>
                    <label>Discount</label>
                    <input type='text' class='form-control' name='discount' id='discount' value='".$rowperforma['discount']."' placeholder='Enter Marketing Com'>
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
    $("#range").val($("input[name=trange]").val());
    $("#flag").val($("input[name=tflag]").val());
  
   $("#but_upload").click(function(){
         var fd = new FormData();
         var x = $("input[name=id]").val();
         var y = $("input[name=persentase]").val();
         var z = $("input[name=nominal]").val();
         var c = $("input[name=agentcom]").val();
         var e = document.getElementById("range").options[document.getElementById("range").selectedIndex].value;
         var f = $("input[name=staffcom]").val();
         var g = $("input[name=subagent]").val();
         var h = $("input[name=marketingcom]").val();
         var i = $("input[name=discount]").val();

         var v = $("input[name=tid]").val();
         var p = $("input[name=tagent]").val();

         fd.append('id',x);
         fd.append('persentase',y);
         fd.append('nominal',z);
         fd.append('agentcom',c);
         fd.append('range',e);
         fd.append('staffcom',f);
         fd.append('subagent',g);
         fd.append('marketingcom',h);
         fd.append('discount',i);
         $.ajax({
          url: 'updatePerformaPriceAgent.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(response){
            reloadPage(-15,p,v);
          },
        });
     });
  });

</script>
