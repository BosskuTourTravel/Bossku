<?php
session_start();
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM  LT_itinerary2 where id =" . $_POST['id'];
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);
$json_day = $row['hari'];

?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card" style="padding: 20px;">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Add Image From List Tempat</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px; text-align: right;">
                            <div class="input-group-append">
                                <a class="btn btn-warning btn-sm tip" onclick="LT_itinerary(27,<?php echo $_POST['id'] ?>,0)" title="Back"><i class="fas fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(42,<?php echo $_POST['id'] ?>,0)" title="Refresh"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div style="padding: 10px;">
                        <div class="card">
                            <div class="card-header" style="background-color: blueviolet;">
                                <h5 style="margin: 0px; text-transform: uppercase; color:whitesmoke">MAIN IMAGE</h5>
                            </div>
                            <div class="card-body">
                                <div style="padding: 20px;">
                                    <div class="row">
                                        <?php
                                        $link2 = "https://drive.google.com/file/d/1ZX73bzx42Ox7qNldS6kY_z6XogQmBesH/view?usp=sharing";
                                        $headers2 = explode('/', $link2);
                                        $thumbnail = $headers2[5];
                                        $thumbnail_gmb1 = $headers2[5];
                                        $thumbnail_gmb2 = $headers2[5];
                                        $thumbnail_gmb3 = $headers2[5];
                                        $thumbnail_gmb4 = $headers2[5];
                                        $id_val1 = "";
                                        $val1 = "";
                                        $id_val2 = "";
                                        $val2 = "";
                                        $id_val3 = "";
                                        $val3 = "";
                                        $id_val4 = "";
                                        $val4 = "";

                                        $query_main = "SELECT * FROM selected_img_main  where tour_id ='" . $_POST['id'] . "' order by id DESC limit 1";
                                        $rs_main = mysqli_query($con, $query_main);
                                        $row_main = mysqli_fetch_array($rs_main);
                                        // var_dump($query_main);
                                        // while ($row_main = mysqli_fetch_array($rs_main)) {
                                            if ($row_main['img1'] != "") {
                                                $query_sel_main1 = "SELECT selected_img_tmp.*,List_tempat_img.link,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where selected_img_tmp.id ='" . $row_main['img1'] . "'";
                                                $rs_sel_main1 = mysqli_query($con, $query_sel_main1);
                                                $row_sel_main1 = mysqli_fetch_array($rs_sel_main1);
                                                $s1 = $row_sel_main1['tmp_type'];

                                                // var_dump($query_sel_main1);

                                                $link_gmb1 = $row_sel_main1[$s1];
                                                $headers_gmb1 = explode('/', $link_gmb1);
                                                $thumbnail_gmb1 = $headers_gmb1[5];
                                                $val1 = $row_sel_main1['tempat'];
                                                $id_val1 = $row_sel_main1['id'];
                                            }
                                            if ($row_main['img2'] != "") {
                                                $query_sel_main2 = "SELECT selected_img_tmp.*,List_tempat_img.link,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where selected_img_tmp.id ='" . $row_main['img2'] . "'";
                                                $rs_sel_main2 = mysqli_query($con, $query_sel_main2);
                                                $row_sel_main2 = mysqli_fetch_array($rs_sel_main2);
                                                $s2 = $row_sel_main2['tmp_type'];

                                                $link_gmb2 = $row_sel_main2[$s2];
                                                $headers_gmb2 = explode('/', $link_gmb2);
                                                $thumbnail_gmb2 = $headers_gmb2[5];
                                                $val2 = $row_sel_main2['tempat'];
                                                $id_val2 = $row_sel_main2['id'];
                                            }
                                            if ($row_main['img3'] != "") {
                                                $query_sel_main3 = "SELECT selected_img_tmp.*,List_tempat_img.link,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where selected_img_tmp.id ='" . $row_main['img3'] . "'";
                                                $rs_sel_main3 = mysqli_query($con, $query_sel_main3);
                                                $row_sel_main3 = mysqli_fetch_array($rs_sel_main3);
                                                $s3 = $row_sel_main3['tmp_type'];

                                                $link_gmb3 = $row_sel_main3[$s3];
                                                $headers_gmb3 = explode('/', $link_gmb3);
                                                $thumbnail_gmb3 = $headers_gmb3[5];
                                                $val3 = $row_sel_main3['tempat'];
                                                $id_val3 = $row_sel_main3['id'];
                                            }
                                            if ($row_main['img4'] != "") {
                                                $query_sel_main4 = "SELECT selected_img_tmp.*,List_tempat_img.link,List_tempat_img.winter_img,List_tempat_img.autumn_img,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where selected_img_tmp.id ='" . $row_main['img4'] . "'";
                                                $rs_sel_main4 = mysqli_query($con, $query_sel_main4);
                                                $row_sel_main4 = mysqli_fetch_array($rs_sel_main4);
                                                $s4 = $row_sel_main4['tmp_type'];

                                                $link_gmb4 = $row_sel_main4[$s4];
                                                $headers_gmb4 = explode('/', $link_gmb4);
                                                $thumbnail_gmb4 = $headers_gmb4[5];
                                                $val4 = $row_sel_main4['tempat'];
                                                $id_val4 = $row_sel_main4['id'];
                                            }
                                        ?>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-img-top" src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb1 ?>" height="200" alt="Card image cap">
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" id="img1">
                                                        <?php
                                                        if ($id_val1 != "") {
                                                        ?>
                                                            <option value="<?php echo $id_val1 ?>" selected><?php echo $val1 ?></option>
                                                        <?php
                                                        }
                                                        $query_sel1 = "SELECT selected_img_tmp.*,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where tour_id ='" . $_POST['id'] . "'";
                                                        $rs_sel1 = mysqli_query($con, $query_sel1);
                                                        while ($row_sel1 = mysqli_fetch_array($rs_sel1)) {
                                                        ?>
                                                            <option value="<?php echo $row_sel1['id'] ?>"><?php echo $row_sel1['tempat'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-img-top" src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb2 ?>" height="200" alt="Card image cap">
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" id="img2">
                                                        <?php
                                                        if ($id_val2 != "") {
                                                        ?>
                                                            <option value="<?php echo $id_val2 ?>" selected><?php echo $val2 ?></option>
                                                        <?php
                                                        }

                                                        $query_sel2 = "SELECT selected_img_tmp.*,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where tour_id ='" . $_POST['id'] . "'";
                                                        $rs_sel2 = mysqli_query($con, $query_sel2);
                                                        while ($row_sel2 = mysqli_fetch_array($rs_sel2)) {
                                                        ?>
                                                            <option value="<?php echo $row_sel2['id'] ?>"><?php echo $row_sel2['tempat'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-img-top" src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb3 ?>" height="200" alt="Card image cap">
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" id="img3">
                                                        <?php
                                                        if ($id_val3 != "") {
                                                        ?>
                                                            <option value="<?php echo $id_val3 ?>" selected><?php echo $val3 ?></option>
                                                        <?php
                                                        }
                                                        $query_sel3 = "SELECT selected_img_tmp.*,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where tour_id ='" . $_POST['id'] . "'";
                                                        $rs_sel3 = mysqli_query($con, $query_sel3);
                                                        while ($row_sel3 = mysqli_fetch_array($rs_sel3)) {
                                                        ?>
                                                            <option value="<?php echo $row_sel3['id'] ?>"><?php echo $row_sel3['tempat'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="card">
                                                    <img class="card-img-top" src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail_gmb4 ?>" height="200" alt="Card image cap">
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control" id="img4">
                                                        <?php
                                                        if ($id_val4 != "") {
                                                        ?>
                                                            <option value="<?php echo $id_val4 ?>" selected><?php echo $val4 ?></option>
                                                        <?php
                                                        }

                                                        $query_sel4 = "SELECT selected_img_tmp.*,List_tempat.tempat FROM selected_img_tmp LEFT JOIN List_tempat ON selected_img_tmp.tmp=List_tempat.id where tour_id ='" . $_POST['id'] . "'";
                                                        $rs_sel4 = mysqli_query($con, $query_sel4);
                                                        while ($row_sel4 = mysqli_fetch_array($rs_sel4)) {
                                                        ?>
                                                            <option value="<?php echo $row_sel4['id'] ?>"><?php echo $row_sel4['tempat'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php
                                        // var_dump($val1." + ".$val2." + ".$val3." + ".$val4);
                                        // }
                                        ?>
                                    </div>
                                    <button type="button" class="btn btn-primary" onclick="add_main_img(<?php echo $_POST['id'] ?>)">ADD MAIN IMG</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding: 10px;">
                        <?php
                        for ($c = 1; $c <= $json_day; $c++) {
                            $queryRute = "SELECT * FROM  LT_add_rute where tour_id='" . $_POST['id'] . "' && hari='$c'";
                            $rsRute = mysqli_query($con, $queryRute);
                            $rowRute = mysqli_fetch_array($rsRute);
                        ?>
                            <div class="card">
                                <div class="card-header">
                                    <h5 style="margin: 0px; text-transform: uppercase;"><?php echo "DAY " . $c . " " . $rowRute['nama'] ?></h5>
                                </div>
                                <div class="card-body">
                                    <div style="padding: 20px;">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>List Tempat</label>
                                                    <select class="form-control form-control-sm" id="tmp<?php echo $c ?>">
                                                        <option value="">Select List Tempat</option>
                                                        <?php
                                                        $query_tmp = "SELECT LT_add_listTmp.tempat as id,List_tempat.tempat ,List_tempat_img.link,List_tempat_img.summer_img,List_tempat_img.winter_img,List_tempat_img.autumn_img FROM LT_add_listTmp LEFT JOIN List_tempat ON LT_add_listTmp.tempat=List_tempat.id LEFT JOIN List_tempat_img ON LT_add_listTmp.tempat=List_tempat_img.tmp_id where tour_id='" . $_POST['id'] . "' && hari='" . $c . "' order by hari ASC, urutan ASC";
                                                        $rs_tmp = mysqli_query($con, $query_tmp);


                                                        while ($row_tmp = mysqli_fetch_array($rs_tmp)) {
                                                            $img_link = "";
                                                            $img_summer = "";
                                                            $img_winter = "";
                                                            $img_autumn = "";
                                                            if ($row_tmp['link'] == "") {
                                                                $img_link = "NO IMAGE";
                                                            }
                                                            if ($row_tmp['summer_img'] == "") {
                                                                $img_summer = "NO IMAGE";
                                                            }
                                                            if ($row_tmp['winter_img'] == "") {
                                                                $img_winter = "NO IMAGE";
                                                            }
                                                            if ($row_tmp['autumn_img'] == "") {
                                                                $img_autumn = "NO IMAGE";
                                                            }
                                                        ?>
                                                            <option value="<?php echo $row_tmp['id'] . "," . "link" ?>"><?php echo $row_tmp['tempat'] . " Spring " . $img_link ?></option>
                                                            <option value="<?php echo $row_tmp['id'] . "," . "summer_img"  ?>"><?php echo $row_tmp['tempat'] . " Summer " . $img_summer ?></option>
                                                            <option value="<?php echo $row_tmp['id'] . "," . "winter_img"  ?>"><?php echo $row_tmp['tempat'] . " Winter " . $img_winter ?></option>
                                                            <option value="<?php echo $row_tmp['id'] . "," . "autumn_img"  ?>"><?php echo $row_tmp['tempat'] . " Autumn " . $img_autumn ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col" style="text-align: center;">
                                                <a class="btn btn-primary btn-sm tip" onclick="add_img(<?php echo $c ?>,<?php echo $_POST['id'] ?>)">Add Images</a>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-bordered table-sm" style="font-size: 10pt;">
                                        <thead>
                                            <tr>
                                                <th scope="col">List Tempat</th>
                                                <th scope="col">Image Type</th>
                                                <th scope="col">Image Link</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query_sel = "SELECT * FROM  selected_img_tmp where tour_id ='" . $_POST['id'] . "' && hari='" . $c . "'";
                                            $rs_sel = mysqli_query($con, $query_sel);
                                            while ($row_sel = mysqli_fetch_array($rs_sel)) {
                                                $query_tmp = "SELECT List_tempat.id,List_tempat.tempat,List_tempat_img.link,List_tempat_img.summer_img,List_tempat_img.winter_img,List_tempat_img.autumn_img FROM List_tempat LEFT JOIN List_tempat_img ON List_tempat.id = List_tempat_img.tmp_id where List_tempat.id='" . $row_sel['tmp'] . "'";

                                                $rs_tmp = mysqli_query($con, $query_tmp);
                                                $row_tmp = mysqli_fetch_array($rs_tmp);
                                                $s = $row_sel['tmp_type'];

                                            ?>
                                                <tr>
                                                    <td><?php echo $row_tmp['tempat'] ?></td>
                                                    <td><?php
                                                        if ($row_sel['tmp_type'] == "link") {
                                                            echo "Spring_img";
                                                        } else {
                                                            echo $row_sel['tmp_type'];
                                                        }
                                                        ?></td>
                                                    <td><?php echo $row_tmp[$s] ?></td>
                                                    <td>
                                                        <a class="btn btn-warning btn-sm tip" data-toggle="modal" data-target="#img_modal" data-id="<?php echo $row_sel['id']  ?>"><i class="fas fa-plus"></i></a>
                                                        <a class="btn btn-danger btn-sm tip" onclick="del_img(<?php echo $row_sel['id'] ?>,<?php echo $_POST['id'] ?>)"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="modal fade" id="img_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Input Link Image Drive</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-data"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#img_modal').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "modal_img_tmpt2.php",
                method: "POST",
                asynch: false,
                data: {
                    id: id,
                },
                success: function(data) {
                    $('.modal-data').html(data);
                }
            });
        });
    });
</script>
<script>
    function prev_img(x, y) {
        // var tmp = document.getElementById("tmp" + x).value;
        // alert(x);
        $.ajax({
            url: "prev_image_tmp.php",
            method: "POST",
            asynch: false,
            data: {
                id: x,
            },
            success: function(data) {
                $('#prev' + y).html(data);
            }
        });
        //  alert(y);
    }

    function add_img(x, y) {
        var tmp = document.getElementById("tmp" + x).value;
        $.ajax({
            url: "add_img_tmp.php",
            method: "POST",
            asynch: false,
            data: {
                id: tmp,
                tour_id: y,
                hari: x
            },
            success: function(data) {
                alert(data);
                // $('#prev').html(data);
                LT_itinerary(42, y, 0);
            }
        });
    }

    function del_img(x, y) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "del_img_itin.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        LT_itinerary(42, y, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }

    function add_main_img(x) {
        // alert(x);
        var img1 = document.getElementById("img1").value;
        var img2 = document.getElementById("img2").value;
        var img3 = document.getElementById("img3").value;
        var img4 = document.getElementById("img4").value;
        $.ajax({
            url: "add_img_main.php",
            method: "POST",
            asynch: false,
            data: {
                id: x,
                img1: img1,
                img2: img2,
                img3: img3,
                img4: img4,
            },
            success: function(data) {
                alert(data);
                LT_itinerary(42, x, 0);
            }
        });
    }
</script>