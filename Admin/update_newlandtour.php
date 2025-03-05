<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";

$querydata = "SELECT * FROM Upload_Drive WHERE id=".$_POST['id'];
$rsdata = mysqli_query($con,$querydata);
$rowdata = mysqli_fetch_array($rsdata);

$querycn = "SELECT * FROM country where id=".$rowdata['country'];
$rscn = mysqli_query($con, $querycn);
$rowcn = mysqli_fetch_array($rscn);

$queryct= "SELECT * FROM city where id=".$rowdata['city'];
$rsct = mysqli_query($con, $queryct);
$rowct = mysqli_fetch_array($rsct);

$querytourtype = "SELECT * FROM agent";
$rstourtype = mysqli_query($con, $querytourtype);

$querycountry = "SELECT * FROM country";
$rscountry = mysqli_query($con, $querycountry);

$query_continent = "SELECT * FROM continent";
$rs_continent = mysqli_query($con, $query_continent);

$query_kurs = "SELECT * FROM kurs_bank";
$rs_kurs = mysqli_query($con, $query_kurs);

echo "<div class='content-wrapper'>
 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM UPDATE ITINERARY DRIVE</h3>
                <div class='card-tools'>
                </div>
              </div>
              <!-- /.card-header -->
              <div class='card-body table-responsive p-0'>
                  <div class='card card-primary' style='padding:20px;'>
              
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form  role='form' method='post' action='insertPricePackage.php'>
                        <div class='form-group'>
                        <label>Continent</label>
                        <input type='text' name='tid' id='tid' value='".$_POST['id']."' hidden>
                        <select class='form-control select' required name='continent' id='continent'  value='".$rowdata['continent']."' style='width: 100%;'>";
                                while ($row_continent = mysqli_fetch_array($rs_continent)) {
                                //   echo "<option value=" . $row_continent['id'] . ">" . $row_continent['name'] . "</option>";
                                  if($row_continent['id']==$rowdata['continent']){
                                    echo "<option selected='selected' value=".$row_continent['id'].">".$row_continent['name']."</option>";
                                  }else{
                                    echo "<option value=" . $row_continent['id'] . ">" . $row_continent['name'] . "</option>";
                                  }
                                }
                                echo "
                      </select>
                        </div>
                        <div class='form-group'>
                        <label>Country</label>
                        <select class='form-control select' required name='country' id='country' style='width: 100%;'>
                            <option selected='selected' value=".$rowdata['country'].">".$rowcn['name']."</option>
                      </select>
                        </div>
                        <div class='form-group'>
                        <label>City</label>
                        <select class='form-control select' required name='city' id='city' style='width: 100%;'>
                            <option selected='selected' value=".$rowdata['city'].">".$rowct['name']."</option>
                      </select>
                        </div>
                        <div class='form-group'>
                            <label for='judul'>Text Judul</label>
                            <input type='text' class='form-control' id='judul' name='judul' aria-describedby='' value=".$rowdata['judul']." placeholder='Masukkan judul file'>
                         </div>
                         <div class='form-group'>
                         <label>Kurs</label>
                         <select class='form-control select' required name='kurs' id='kurs' value=".$rowdata['kurs']." style='width: 100%;'>";
                                 while ($row_kurs = mysqli_fetch_array($rs_kurs)) {
                                    if( $row_kurs['id']==$rowdata['kurs']){
                                        echo "<option selected='selected' value=".$row_kurs['id'].">".$row_kurs['name']."</option>";
                                      }else{
                                        echo "<option value=" . $row_kurs['id'] . ">" . $row_kurs['name'] . "</option>";
                                      }
                                //    echo "<option value=" . $row_kurs['id'] . ">" . $row_kurs['name'] . "</option>";
                                 }
                                 echo "
                       </select>
                         </div>
                         <div class='form-group'>
                         <label for='price'>Price</label>
                         <input type='text' class='form-control' id='price' name='price' aria-describedby=''  value=".$rowdata['price']." placeholder='Masukkan Price'>
                      </div>
                          <div class='form-group'>
                                <label for='Thumbnail'>Thumbnail</label>
                                <input type='text' class='form-control' id='Thumbnail' name='Thumbnail' aria-describedby='LinkGambar value=".$rowdata['thumbnail']."' placeholder='Masukkan Link gambar'>
                          </div>
                          <div class='form-group'>
                                <label for='LinkGambar'>Link Gambar</label>
                               <input type='text' class='form-control' id='LinkGambar' name='LinkGambar' value=".$rowdata['name']." aria-describedby='LinkGambar placeholder='Masukkan Link gambar'>
                                   <small id='LinkGambar' class='form-text text-muted'><a href='https://drive.google.com/drive/folders/17QVHbyuUm_yQvXu4TzvQ9L3lTHLYA_NU' target='_blank'>Clik disini</a> 
                  menuju google drive file</small>
                          </div>
                          <div class='form-group'>
                                 <label for='LinkDocs'>Link Document</label>
                                <input type='text' class='form-control' id='LinkDocs'  name='LinkDocs' value=".$rowdata['documents']." aria-describedby='LinkDocs' placeholder='Masukkan Link Document'>
                                    <small id='LinkDocs' class='form-text text-muted'><a href='https://drive.google.com/drive/folders/17QVHbyuUm_yQvXu4TzvQ9L3lTHLYA_NU' target='_blank'>Clik disini</a> 
                                     menuju google drive file</small>
                        </div>
                        <div class='form-group'>
                        <label for='sosmed'>Sosial Media </label>
                        <div class='form-row'>
                        <div class='col'>
                          <input type='text' id='youtube' name='youtube' class='form-control' value='".$rowdata['youtube']."' placeholder='Youtube'>
                        </div>
                        <div class='col'>
                          <input type='text' id='ig' name='ig' class='form-control' value='".$rowdata['ig']."' placeholder='IG'>
                        </div>
                        <div class='col'>
                        <input type='text' id='tt' name='tt' class='form-control' value='".$rowdata['tiktok']."' placeholder='Tiktok'>
                      </div>
                      </div>
                        </div>         
                        <button type='submit' class='btn btn-primary' id='but_upload'>Submit</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
</div>";
?>
<script>
  $("#but_upload").click(function() {
    var b = $("input[name=Thumbnail]").val();
    var c = $("input[name=LinkGambar]").val();
    var d = $("input[name=LinkDocs]").val();
    var e = document.getElementById("continent").options[document.getElementById("continent").selectedIndex].value;
    var f = document.getElementById("city").options[document.getElementById("city").selectedIndex].value;
    var g = $("input[name=judul]").val();
    var h = $("input[name=youtube]").val();
    var i = $("input[name=ig]").val();
    var j = $("input[name=tt]").val();
    var k = document.getElementById("country").options[document.getElementById("country").selectedIndex].value;
    var l = $("input[name=price]").val();
    var m = document.getElementById("kurs").options[document.getElementById("kurs").selectedIndex].value;
    //alert(e);
    $.ajax({
      url: "Update_NewLandtour2.php",
      method: "POST",
      asynch: false,
      data: {
        Thumbnail: b,
        LinkGambar: c,
        LinkDocs: d,
        continent: e,
        country: k,
        city: f,
        judul: g,
        youtube: h,
        ig: i,
        tt: j,
        price:l,
        kurs:m
      },
      success: function(data) {
        if (data == 'success') {
          alert(data);
          reloadManual(9, 0, 0);
        }
      }
    });
  });


  $("#continent").change(function() {
    // variabel dari nilai combo box kendaraan
    var id_continent = $("#continent").val();

    // Menggunakan ajax untuk mengirim dan dan menerima data dari server
    $.ajax({
      type: "POST",
      dataType: "html",
      url: "get_country.php",
      data: "continent=" + id_continent,
      success: function(data) {
        $("#country").html(data);
      }
    });
  });
  $("#country").change(function() {
    // variabel dari nilai combo box merk
    var id_country = $("#country").val();

    // Menggunakan ajax untuk mengirim dan dan menerima data dari server
    $.ajax({
      type: "POST",
      dataType: "html",
      url: "get_country.php",
      data: "country=" + id_country,
      success: function(data) {
        $("#city").html(data);
      }
    });
  });
</script>