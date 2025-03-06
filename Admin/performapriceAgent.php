<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

$querycountry = "SELECT * FROM country";
$rscountry=mysqli_query($con,$querycountry);


echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM PERFORMA PRICE AGENT COUNTRY</h3>
                <div class='card-tools'>
                  <div class='input-group input-group-sm' style='width: 150px;'>
                    <input type='text' name='table_search' class='form-control float-right' placeholder='Search'>
                    
                    <div class='input-group-append'>
                      <button type='submit' onclick='reloadPage(-13,0,0)' class='btn btn-default'><i class='fa fa-arrow-left'></i></button>
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
                 <div class='form-group'>
                    <label>Country</label>
                    <select class='chosen' name='country' id='country' onchange='getAgent(this.value)' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    $query_packageX = "SELECT * FROM tour_package";
                    $rs_packageX=mysqli_query($con,$query_packageX);
                    $arr = [];
                    while($row_packageX = mysqli_fetch_array($rs_packageX)){
                      $tempCountryX = preg_split ("/[\s;]+/", $row_packageX['country']);
                      for($i=0; $i<count($tempCountryX); $i++){
                         echo $tempCountryX[$i];
                         array_push($arr,$tempCountryX[$i]);
                      }
                      
                    }


                     //$arr = array_unique($arr,SORT_REGULAR);

                    $arr2 = array();

                    foreach($arr as $element1)
                    {
                      foreach($arr as $element2)
                      {
                        if ($element1 != $element2 && !in_array($element1,$arr2))
                        {
                          array_push($arr2,$element1);
                        }
                      }
                    }
                    //  for($i=0; $i<count($arr2); $i++){
                    //    echo "<option value='".$arr2[$i]."'>".$arr2[$i]."</option>";
                    // }
                    

                    while($rowcountry = mysqli_fetch_array($rscountry)){
                      for($i=0; $i<count($arr2); $i++){
                        if($rowcountry['id']==$arr2[$i]){
                          echo "<option value='".$rowcountry['id']."'>".$rowcountry['name']."</option>";
                        }
                      }
                      
                    }
                    echo"</select>
                  </div>
                  <div class=form-group' name='divcountry' id='divcountry'></div>

                  <div class=form-group'>
                    <label>Persentase</label>
                    <input type='text' class='form-control' name='persentase' id='persentase' placeholder='Enter Persentase ( Diisi Tanpa % )'>
                  </div>
                  <div class=form-group'>
                    <label>Nominal</label>
                    <input type='text' class='form-control' name='nominal' id='nominal' placeholder='Enter Nominal ( Diisi Tanpa % )'>
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
                    <label>Agent Com ( Profit yang didapat oleh PTT dari travel Agent lain )</label>
                    <input type='text' class='form-control' name='agentcom' id='agentcom' placeholder='Enter AgentCom ( Diisi Dengan % )'>
                  </div>
                  <div class=form-group'>
                    <label>Staff Com</label>
                    <input type='text' class='form-control' name='staffcom' id='staffcom' placeholder='Enter StaffCom ( Diisi Dengan % )'>
                  </div>
                  <div class=form-group'>
                    <label>Staff Com2</label>
                    <input type='text' class='form-control' name='staffcom2' id='staffcom2' placeholder='Enter StaffCom2 ( Diisi Dengan %  - Digunakan untuk ambil profit staff dari laba kotor penjualan pembelian)'>
                  </div>
                  
                  <div class=form-group'>
                    <label>Marketing Com</label>
                    <input type='text' class='form-control' name='marketingcom' id='marketingcom' placeholder='Enter Marketing Com ( Diisi Dengan % )'>
                  </div>
                  <div class=form-group'>
                    <label>Supplier</label>
                    <input type='text' class='form-control' name='subagent' id='subagent' placeholder='Enter Supplier ( Diisi Dengan % )'>
                  </div>
                  <div class=form-group'>
                    <label>Discount</label>
                    <input type='text' class='form-control' name='discount' id='discount' placeholder='Enter Marketing Com ( Diisi Dengan % )'>
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

   function getAgent(x) {
    $.ajax({
      type:'POST',
      url:'getAgent.php',
      data:{'country':x},
      success:function(data){
        $('#divcountry').html(data);
      }
    });
  }

  $(document).ready(function(){
    $(".chosen").chosen();
    $("#but_upload").click(function(){
        var fd = new FormData();
     
        var a = document.getElementById("agent").options[document.getElementById("agent").selectedIndex].value;
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
