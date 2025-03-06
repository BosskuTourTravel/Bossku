<?php
session_start();
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Landtour Package List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <div style="padding-right: 5px;"><a class="btn btn-success btn-sm" href="export_list_tempat.php" target="_BLANK"><i class="fa fa-file-excel"></i></a></div>
                                <div style="padding-right: 5px;"> <button type="button" onclick="LT_Package(2,0,0)" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></div>
                                <div style="padding-right: 5px;"> <button type="button" onclick="LT_Package(20,0,0)" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <?php
                    include "../site.php";
                    include "../db=connection.php";
                    $query = "SELECT * FROM  List_tempat";
                    $rs = mysqli_query($con, $query);
                    $no = 1;
                    ?>
                    <div style="padding: 10px;">
                        <table id="example" class="table table-striped table-bordered" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Region</th>
                                    <th>Place Name</th>
                                    <th>Desciption</th>
                                    <th>Price</th>
                                    <th>Img</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($rs)) {
                                    $query_img = "SELECT * FROM List_tempat_img where tmp_id=" . $row['id'];
                                    $rs_img = mysqli_query($con, $query_img);
                                    $row_img = mysqli_fetch_array($rs_img);

                                    $link = $row_img['link'];
                                    $smr = $row_img['summer_img'];
                                    $win = $row_img['winter_img'];
                                    $aut = $row_img['autumn_img'];
                                    $head_smr = explode('/', $smr);
                                    $head_win = explode('/', $win);
                                    $head_aut = explode('/', $aut);
                                    $headers = explode('/', $link);
                                    $thumbnail = $headers[5];
                                    $thumb_smr = $head_smr[5];
                                    $thumb_win = $head_win[5];
                                    $thumb_aut = $head_aut[5];
                                    // var_dump($thumbnail);
                                ?>
                                    <tr>
                                        <td><?php echo  $row['id'] ?></td>
                                        <td><?php echo $row['continent'] . " - " . $row['negara'] . " - " . $row['city'] ?></td>
                                        <td><?php echo $row['tempat'] ?></td>
                                        <td><?php
                                         echo "<div>". $row['keterangan'] ."</div>";
                                         if($row_img['vid'] !=""){
                                            echo "<div style='padding-top:10px'><a href='".$row_img['vid']."' target='_blank'>". $row_img['vid'] ."</a></div>";
                                         }
                                         ?></td>
                                        <td><?php echo $row['price'] ?></td>
                                        <td style="min-width: 200px;">
                                            <?php
                                            if ($thumbnail != "") { 
                                                ?><img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumbnail
                                                                            ?>" width="30" height="30" title="Spring" style="margin-left: 5px;"><?php 
                                            }
                                            if ($thumb_smr != "") { 
                                                ?><img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumb_smr
                                                                            ?>" width="30" height="30" title="Summer" style="margin-left: 5px;"><?php 
                                            } 
                                            if ($thumb_win != "") { 
                                                ?><img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumb_win
                                                                            ?>" width="30" height="30" title="Winter" style="margin-left: 5px;"><?php 
                                            } 
                                            if ($thumb_aut != "") { 
                                                ?><img src="<?php echo 'https://drive.google.com/thumbnail?id=' . $thumb_aut
                                                                            ?>" width="30" height="30" title="Auntumn" style="margin-left: 5px;"><?php 
                                            } 
                                            ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#img_modal" data-id="<?php echo $row['id']  ?>"><i class="fa fa-link"></i></a>
                                            <a class="btn btn-danger btn-sm" onclick="del_makelt(<?php echo $row['id'] ?>)"><i class="fa fa-trash"></i></a>
                                            <a class="btn btn-warning btn-sm" onclick="LT_Package(21,<?php echo $row['id'] ?>,0)"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
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
        $('#example').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 25
        });
        $('#img_modal').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "modal_img_tmpt.php",
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
    function del_makelt(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "del_list_tmp.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        LT_Package(0, 0, 0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
</script>