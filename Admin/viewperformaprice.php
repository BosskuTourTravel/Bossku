<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>

<?php
include "../site.php";
include "../db=connection.php";

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>VIEW PERFORMA PRICE AGENT COUNTRY</h3>
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


              <div class='card card-primary' style='height:700px;'>
              
              <!-- /.card-header -->
                <div class='card-body'>
                 <div class='form-group' >
                    <label>Country</label>
                    <select class='chosen' name='country' id='country' onchange='getAgent(this.value)' class='form-control'>
                    <option selected='selected' value=0>Pilihan</option>";

                    $query_packageX = "SELECT * FROM tour_package";
                    $rs_packageX=mysqli_query($con,$query_packageX);
                    $arr = [];
                    while($row_packageX = mysqli_fetch_array($rs_packageX)){
                      $tempCountryX = preg_split ("/[\s;]+/", $row_packageX['country']);
                      for($i=0; $i<count($tempCountryX); $i++){
                         array_push($arr,$tempCountryX[$i]);
                      
                      }
                      
                    }

                    //   for($i=0; $i<count($arr); $i++){
                    //    echo "<option value='".$arr[$i]."'>".$arr[$i]."</option>";
                    // }


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
                   

                    $querycountry = "SELECT * FROM country";
                    $rscountry=mysqli_query($con,$querycountry);
                    
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
                  <div class=form-group' name='divPrice' id='divPrice'></div>

                  
                  <div class=form-group'>
                   
                  </div>
                  <div class=form-group'>
                   
                  </div>
                  <div class=form-group'>
                    
                  </div>
                  <div class=form-group'>
                   
                  </div>

               
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

  function getPerformaPrice(x,y){
  	$.ajax({
      type:'POST',
      url:'getPerformaPriceAgent.php',
      data:{'id':x,'country':y},
      success:function(data){
        $('#divPrice').html(data);
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
        var h = $("#subagent").val();
        var i = $("#marketingcom").val();
       
        fd.append('agent',a);
        fd.append('country',b);
        fd.append('persentase',c);
        fd.append('nominal',d);
        fd.append('flag',e);
        fd.append('agentcom',f);
        fd.append('staffcom',g);
        fd.append('subagent',h);
        fd.append('marketingcom',i);


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
