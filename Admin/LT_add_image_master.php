<?php
session_start();
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM  LT_itinerary2 where id =" . $_POST['id'];
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);

$queryTmp = "SELECT * FROM  LT_add_listTmp where tour_id='" . $_POST['id'] . "'  order by hari ASC, urutan ASC";
$rsTmp = mysqli_query($con, $queryTmp);
$rsTmp2 = mysqli_query($con, $queryTmp);
$rsTmp3 = mysqli_query($con, $queryTmp);
$rsTmp4 = mysqli_query($con, $queryTmp);

$query_cek = "SELECT * FROM LT_insert_from_list_tmp where tour_id='" . $_POST['id'] . "'";
$rs_cek = mysqli_query($con, $query_cek);
$row_cek = mysqli_fetch_array($rs_cek);

?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Add Image From List Tempat</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append">
                                <!-- <button type="button" onclick="insertPage(26,0,0)" class="btn btn-primary"><i class="fa fa-plus"></i></button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div style="padding: 20px;">
                        <form action="">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Image 1</label>
                                        <select class="form-control" id="tmp1" onchange="add_img(this.value,1)">
                                            <option value="">Pilih Tempat</option>
                                            <?php
                                            while ($row_tmp1 = mysqli_fetch_array($rsTmp)) {

                                                $query_tmp_name1 = "SELECT * FROM List_tempat where id='" . $row_tmp1['tempat'] . "'";
                                                $rs_tmp_name1 = mysqli_query($con, $query_tmp_name1);
                                                $row_tmp_name1 = mysqli_fetch_array($rs_tmp_name1);
                                            ?>
                                                <option value="<?php echo $row_tmp_name1['id'] ?>"><?php echo $row_tmp_name1['tempat'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="img-1">
                                        <?php
                                        if ($row_cek['id'] != "") {
                                            $link = $row_cek['img1'];
                                            $headers = explode('/', $link);
                                            $thumbnail = $headers[5];
                                        ?>
                                            <div class="card" style="width: 160px;">
                                                <img class="card-img-top" src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" alt="Card image cap">
                                                <div class="card-body acd" style="text-align: center; padding: 5px;">
                                                    <p class="card-text">Active</p>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Image 2</label>
                                        <select class="form-control" id="tmp2" onchange="add_img(this.value,2)">
                                            <option value="">Pilih Tempat</option>
                                            <?php
                                            while ($row_tmp2 = mysqli_fetch_array($rsTmp2)) {
                                                // var_dump($row_tmp2['tempat']);

                                                $query_tmp_name2 = "SELECT * FROM List_tempat where id='" . $row_tmp2['tempat'] . "'";
                                                $rs_tmp_name2 = mysqli_query($con, $query_tmp_name2);
                                                $row_tmp_name2 = mysqli_fetch_array($rs_tmp_name2);
                                            ?>
                                                <option value="<?php echo $row_tmp_name2['id'] ?>"><?php echo $row_tmp_name2['tempat'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="img-2">
                                        <?php
                                        if ($row_cek['id'] != "") {
                                            $link = $row_cek['img2'];
                                            $headers = explode('/', $link);
                                            $thumbnail = $headers[5];
                                        ?>
                                            <div class="card" style="width: 160px;">
                                                <img class="card-img-top" src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" alt="Card image cap">
                                                <div class="card-body acd" style="text-align: center; padding: 5px;">
                                                    <p class="card-text">Active</p>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Image 3</label>
                                        <select class="form-control" id="tmp3" onchange="add_img(this.value,3)">
                                            <option value="">Pilih Tempat</option>
                                            <?php
                                            while ($row_tmp3 = mysqli_fetch_array($rsTmp3)) {
                                                // var_dump($row_tmp2['tempat']);

                                                $query_tmp_name3 = "SELECT * FROM List_tempat where id='" . $row_tmp3['tempat'] . "'";
                                                $rs_tmp_name3 = mysqli_query($con, $query_tmp_name3);
                                                $row_tmp_name3 = mysqli_fetch_array($rs_tmp_name3);
                                            ?>
                                                <option value="<?php echo $row_tmp_name3['id'] ?>"><?php echo $row_tmp_name3['tempat'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="img-3">
                                        <?php
                                        if ($row_cek['id'] != "") {
                                            $link = $row_cek['img3'];
                                            $headers = explode('/', $link);
                                            $thumbnail = $headers[5];
                                        ?>
                                            <div class="card" style="width: 160px;">
                                                <img class="card-img-top" src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" alt="Card image cap">
                                                <div class="card-body acd" style="text-align: center; padding: 5px;">
                                                    <p class="card-text">Active</p>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Image 4</label>
                                        <select class="form-control" id="tmp4" onchange="add_img(this.value,4)">
                                            <option value="">Pilih Tempat</option>
                                            <?php
                                            while ($row_tmp4 = mysqli_fetch_array($rsTmp4)) {
                                                // var_dump($row_tmp2['tempat']);

                                                $query_tmp_name4 = "SELECT * FROM List_tempat where id='" . $row_tmp4['tempat'] . "'";
                                                $rs_tmp_name4 = mysqli_query($con, $query_tmp_name4);
                                                $row_tmp_name4 = mysqli_fetch_array($rs_tmp_name4);
                                            ?>
                                                <option value="<?php echo $row_tmp_name4['id'] ?>"><?php echo $row_tmp_name4['tempat'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="img-4">
                                        <?php
                                        if ($row_cek['id'] != "") {
                                            $link = $row_cek['img4'];
                                            $headers = explode('/', $link);
                                            $thumbnail = $headers[5];
                                        ?>
                                            <div class="card" style="width: 160px;">
                                                <img class="card-img-top" src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail ?>" alt="Card image cap">
                                                <div class="card-body acd" style="text-align: center; padding: 5px;">
                                                    <p class="card-text">Active</p>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="gambar1" value="<?php echo $row_cek['img1'] ?>">
                            <input type="hidden" id="gambar2" value="<?php echo $row_cek['img2'] ?>">
                            <input type="hidden" id="gambar3" value="<?php echo $row_cek['img3'] ?>">
                            <input type="hidden" id="gambar4" value="<?php echo $row_cek['img4'] ?>">

                            <input type="hidden" id="tp1" value="<?php echo $row_cek['tp1'] ?>">
                            <input type="hidden" id="tp2" value="<?php echo $row_cek['tp2'] ?>">
                            <input type="hidden" id="tp3" value="<?php echo $row_cek['tp3'] ?>">
                            <input type="hidden" id="tp4" value="<?php echo $row_cek['tp4'] ?>">

                            <button type="button" class="btn btn-primary" onclick="insert_image(<?php echo $_POST['id'] ?>)">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
<script>
    function add_img(x, y) {
        $.ajax({
            url: "img_page.php",
            method: "POST",
            asynch: false,
            data: {
                id: x,
                col: y
            },
            success: function(data) {
                $('.img-' + y).html(data);
            }
        })
    }

    function change_card(x, y, z) {
        var bd = document.getElementsByClassName("d-" + x);
        var bw = document.getElementsByClassName("w-" + x);
        var bs = document.getElementsByClassName("s-" + x);
        var ba = document.getElementsByClassName("a-" + x);
        var bgcolor = "darkgreen";
        if (y === "d") {
            for (var i = 0; i < bd.length; i++) {
                bd[i].style.backgroundColor = bgcolor;
            }
            for (var i = 0; i < bw.length; i++) {
                bw[i].style.backgroundColor = "white";
            }
            for (var i = 0; i < bs.length; i++) {
                bs[i].style.backgroundColor = "white";
            }
            for (var i = 0; i < ba.length; i++) {
                ba[i].style.backgroundColor = "white";
            }


        } else if (y === "w") {
            for (var i = 0; i < bd.length; i++) {
                bd[i].style.backgroundColor = "white";
            }
            for (var i = 0; i < bw.length; i++) {
                bw[i].style.backgroundColor = bgcolor;
            }
            for (var i = 0; i < bs.length; i++) {
                bs[i].style.backgroundColor = "white";
            }
            for (var i = 0; i < ba.length; i++) {
                ba[i].style.backgroundColor = "white";
            }

        } else if (y === "s") {
            for (var i = 0; i < bd.length; i++) {
                bd[i].style.backgroundColor = "white";
            }
            for (var i = 0; i < bw.length; i++) {
                bw[i].style.backgroundColor = "white";
            }
            for (var i = 0; i < bs.length; i++) {
                bs[i].style.backgroundColor = bgcolor;
            }
            for (var i = 0; i < ba.length; i++) {
                ba[i].style.backgroundColor = "white";
            }

        } else if (y === "a") {
            for (var i = 0; i < bd.length; i++) {
                bd[i].style.backgroundColor = "white";
            }
            for (var i = 0; i < bw.length; i++) {
                bw[i].style.backgroundColor = "white";
            }
            for (var i = 0; i < bs.length; i++) {
                bs[i].style.backgroundColor = "white";
            }
            for (var i = 0; i < ba.length; i++) {
                ba[i].style.backgroundColor = bgcolor;
            }

        } else {
            for (var i = 0; i < bd.length; i++) {
                bd[i].style.backgroundColor = "white";
            }
            for (var i = 0; i < bw.length; i++) {
                bw[i].style.backgroundColor = "white";
            }
            for (var i = 0; i < bs.length; i++) {
                bs[i].style.backgroundColor = "white";
            }

        }
        document.getElementById('gambar' + x).value = z;
        document.getElementById('tp' + x).value = y;
    }

    function insert_image(x) {
        var img1 = document.getElementById("gambar1").value;
        var img2 = document.getElementById("gambar2").value;
        var img3 = document.getElementById("gambar3").value;
        var img4 = document.getElementById("gambar4").value;

        var tp1 = document.getElementById("tp1").value;
        var tp2 = document.getElementById("tp2").value;
        var tp3 = document.getElementById("tp3").value;
        var tp4 = document.getElementById("tp4").value;

        if (img1 === "" && img2 === "" && img3 === "" && img1 === "") {
            alert("Mohon isi link gambar !!");
        } else {
            $.ajax({
                url: "insert_image_from.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x,
                    img1: img1,
                    img2: img2,
                    img3: img3,
                    img4: img4,
                    tp1: tp1,
                    tp2: tp2,
                    tp3: tp3,
                    tp4: tp4
                },
                success: function(data) {
                    alert(data);
                    LT_itinerary(27, x, 0);
                }
            });
        }



    }
</script>