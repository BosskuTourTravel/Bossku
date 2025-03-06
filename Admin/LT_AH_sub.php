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
                    <h3 class="card-title" style="font-weight:bold;">Landtour ADD Hari List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm" onclick="LT_itinerary(3,0,0)"><i class="fa fa-chevron-circle-left"></i></a>
                                <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="far fa-calendar-plus"></i></a>
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
                                                        <label for="hari">day </label>
                                                        <input type="text" class="form-control" id="hari" name="hari" placeholder="Select Day">
                                                    </div>
                                                    <div class="col">
                                                        <label for="rutet">Rute</label>
                                                        <input type="text" class="form-control" id="rute" name="rute" placeholder="rute">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-success btn-sm submit" data-id="<?php echo $_POST['id'] ?>" data-dismiss="modal">Submit</button>
                                        </div>
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
                    $query = "SELECT * FROM  LT_add_hari WHERE copy_id='" . $_POST['id'] . "' order by hari ASC";
                    $rs = mysqli_query($con, $query);
                    $no = 1
                    ?>
                    <table id="example" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
                        <thead>
                            <tr>
                                <th>HARI</th>
                                <th>RUTE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($rs)) {

                                $queryStaff = "SELECT * FROM  login_staff WHERE id=" . $row['ket'];
                                $rsStaff = mysqli_query($con, $queryStaff);
                                $rowStaff = mysqli_fetch_array($rsStaff);
                                // var_dump($data);
                            ?>
                                <tr>
                                    <td><?php echo  $row['hari'] ?></td>
                                    <td><?php echo  $row['rute'] ?>
                                    <td>
                                        <a class="btn btn-success btn-sm" onclick="LT_itinerary(9,<?php echo $_POST['id'] ?>,<?php echo $row['id'] ?>)"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-danger btn-sm" onclick="del_AH(<?php echo $row['id']?>,<?php echo $_POST['id'] ?>)"><i class="fas fa-trash"></i></a>
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
    function del_AH(x,y) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "del_AH_rute.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        LT_itinerary(8,y,0);
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
            const hari = $modalBody.find($("input[name=hari]")).val();
            const rute = $modalBody.find($("input[name=rute]")).val();

            let formData = new FormData();
            formData.append('id', id);
            formData.append('hari', hari);
            formData.append('rute', rute);
            // work with the values here:
            $.ajax({
                type: 'POST',
                url: "add_LT_hari.php",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert(msg);
                    LT_itinerary(8,id,0);
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
            //  console.log(id, hari, rute);

        });
    });
</script>