<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">Landtour Date List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ADD DAY </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="hari">Tgl Keberangkatan </label>
                                                    <input type="date" class="form-control" id="hari" name="hari" multiple>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-success btn-sm submit" data-id="<?php echo $_POST['id'] ?>" data-master="<?php echo  $_POST['master_id'] ?>" data-dismiss="modal">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <?php
                    include "../site.php";
                    include "../db=connection.php";
                    $query = "SELECT * FROM  LT_Date_list where master_id='" . $_POST['master_id'] . "' && copy_id='" . $_POST['id'] . "' order by tgl ASC";
                    $rs = mysqli_query($con, $query);
                    var_dump($query);
                    $no = 1
                    ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Start From</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($rs)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['tgl'] ?></td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md">
                                                <div class="form-check">
                                                    <?php
                                                    if ($row['ket'] == '1') {
                                                    ?>
                                                        <input class="form-check-input" type="radio" value="<?php echo $row['id'] ?>" id="chck" name="chck" checked onclick="fungsi_set(<?php echo $row['copy_id'] ?>,<?php echo $row['master_id'] ?>)">
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <input class="form-check-input" type="radio" value="<?php echo $row['id'] ?>" id="chck" name="chck" onclick="fungsi_set(<?php echo $row['copy_id'] ?>,<?php echo $row['master_id'] ?>)">
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md"><a class="btn btn-danger btn-sm" onclick="fungsi_delete(<?php echo $row['id'] ?>,<?php echo $row['copy_id'] ?>,<?php echo $row['master_id'] ?>)"><i class="fas fa-trash"></i></a></div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
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
            "iDisplayLength": 5
        });
    });
</script>
<script>
    function fungsi_delete(x,y,z) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "LT_delete_tgl_set.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x,
                },
                success: function(data) {
                    if (data == "success") {
                        LT_itinerary(19, y, z);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
</script>
<script>
    $(document).ready(function() {

        $('.submit').on('click', e => {
            // alert("on");
            const $button = $(e.target);
            const $modalBody = $button.closest('.modal-footer').prev('.modal-body');
            const id = $button.data('id');
            const master = $button.data('master');
            const hari = $modalBody.find($("input[name=hari]")).val();

            let formData = new FormData();
            formData.append('id', id);
            formData.append('hari', hari);

            // work with the values here:
            $.ajax({
                type: 'POST',
                url: "add_LT_tgl.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert(msg);
                    LT_itinerary(19, id, master);
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
            //  console.log(id, hari, rute);

        });
    });

    function fungsi_set(x, y) {
        var copy_id = x;
        var master_id = y;
        var value = document.querySelector('input[name="chck"]:checked').value;
        let formData = new FormData();
        formData.append('copy_id', copy_id);
        formData.append('master_id', master_id);
        formData.append('chck_id', value);
        $.ajax({
            type: 'POST',
            url: "add_LT_tgl_set.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                LT_itinerary(19, copy_id, master_id);
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });

    }
</script>