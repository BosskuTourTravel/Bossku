<script src="dist/css/style.css"></script>
<script src="dist/js/choosen.js"></script>
<?php
include "../site.php";
include "../db=connection.php";

$querytourtype = "SELECT * FROM agent";
$rstourtype = mysqli_query($con, $querytourtype);

$querycountry = "SELECT * FROM country";
$rscountry = mysqli_query($con, $querycountry);

$query_continent = "SELECT * FROM continent";
$rs_continent = mysqli_query($con, $query_continent);

$query_kurs = "SELECT * FROM kurs_bank";
$rs_kurs = mysqli_query($con, $query_kurs);
// $link = 'https://drive.google.com/file/d/15RIt-3SHpQkDQUIiH3Af_dadYoIPBPNw/view?usp=sharing';
//  $headers = explode('/', $link);
//  echo $headers[5];

echo "<div class='content-wrapper'>

 <div class='row'>
          <div class='col-12'>
            <div class='card'>
              <div class='card-header'>
                <h3 class='card-title'>FORM UPLOAD ITINERARY DRIVE</h3>
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
                        <select class='form-control select' required name='continent' id='continent' style='width: 100%;'>
                            <option selected='selected' value=0>Pilihan</option>";

                                while ($row_continent = mysqli_fetch_array($rs_continent)) {
                                  echo "<option value=" . $row_continent['id'] . ">" . $row_continent['name'] . "</option>";
                                }
                                echo "
                      </select>
                        </div>
                        <div class='form-group'>
                        <label>Country</label>
                        <select class='form-control select' required name='country' id='country' style='width: 100%;'>
                            <option selected='selected' value=0>Pilihan</option>
                      </select>
                        </div>
                        <div class='form-group'>
                        <label>City</label>
                        <select class='form-control select' required name='city' id='city' style='width: 100%;'>
                            <option selected='selected' value=0>Pilihan</option>
                      </select>
                        </div>
                        <div class='form-group'>
                            <label for='judul'>Text Judul</label>
                            <input type='text' class='form-control' id='judul' name='judul' aria-describedby='' placeholder='Masukkan judul file'>
                         </div>
                         <div class='form-group'>
                         <label>Kurs</label>
                         <select class='form-control select' required name='kurs' id='kurs' style='width: 100%;'>
                             <option selected='selected' value=0>Pilihan</option>";
 
                                 while ($row_kurs = mysqli_fetch_array($rs_kurs)) {
                                   echo "<option value=" . $row_kurs['id'] . ">" . $row_kurs['name'] . "</option>";
                                 }
                                 echo "
                       </select>
                         </div>
                         <div class='form-group'>
                         <label for='price'>Price</label>
                         <input type='text' class='form-control' id='price' name='price' aria-describedby='' placeholder='Masukkan Price'>
                      </div>
                          <div class='form-group'>
                                <label for='Thumbnail'>Thumbnail</label>
                                <input type='text' class='form-control' id='Thumbnail' name='Thumbnail' aria-describedby='LinkGambar' placeholder='Masukkan Link gambar'>
                          </div>
                          <div class='form-group'>
                                <label for='LinkGambar'>Link Gambar</label>
                               <input type='text' class='form-control' id='LinkGambar' name='LinkGambar' aria-describedby='LinkGambar placeholder='Masukkan Link gambar'>
                                   <small id='LinkGambar' class='form-text text-muted'><a href='https://drive.google.com/drive/folders/17QVHbyuUm_yQvXu4TzvQ9L3lTHLYA_NU' target='_blank'>Clik disini</a> 
                  menuju google drive file</small>
                          </div>
                          <div class='form-group'>
                                 <label for='LinkDocs'>Link Document</label>
                                <input type='text' class='form-control' id='LinkDocs'  name='LinkDocs' aria-describedby='LinkDocs' placeholder='Masukkan Link Document'>
                                    <small id='LinkDocs' class='form-text text-muted'><a href='https://drive.google.com/drive/folders/17QVHbyuUm_yQvXu4TzvQ9L3lTHLYA_NU' target='_blank'>Clik disini</a> 
                                     menuju google drive file</small>
                        </div>
                        <div class='form-group'>
                        <label for='sosmed'>Sosial Media </label>
                        <div class='form-row'>
                        <div class='col'>
                          <input type='text' id='youtube' name='youtube' class='form-control' placeholder='Youtube'>
                        </div>
                        <div class='col'>
                          <input type='text' id='ig' name='ig' class='form-control' placeholder='IG'>
                        </div>
                        <div class='col'>
                        <input type='text' id='tt' name='tt' class='form-control' placeholder='Tiktok'>
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
      url: "insertUploadDrive.php",
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