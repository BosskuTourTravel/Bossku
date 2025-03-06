<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
session_start();
include "../db=connection.php";

$query_data = "SELECT * FROM LT_itinerary2 WHERE id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);
$hari = $row_data['hari'];
if ($row_data['landtour'] == "undefined") {
    $ket_hotel = "Berdasarkan Hotel Name TBA";
} else {
    $ket_hotel = "Berdasarkan Pilihan Itinerary";
}
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">KODE : <?php echo $row_data['landtour'] ?></h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm tip" onclick="LT_itinerary(23,<?php echo $_POST['id'] ?>,0)" title="Back"><i class="fas fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(31,<?php echo $_POST['id'] ?>,0)" title="Refresh"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="card text-left" style="padding: 20px;">
                        <div class="rute" id="rute">
                            <from>
                                <?php
                                $status = 0;
                                for ($x = 1; $x <= $hari; $x++) {
                                    $query = "SELECT * FROM  LT_add_rute where tour_id='" . $_POST['id'] . "' && hari='$x'";
                                    $rs = mysqli_query($con, $query);
                                    $row = mysqli_fetch_array($rs);
                                    if ($row['id'] != "") {
                                        $status = 1;
                                    }
                                ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Rute - Day <?php echo $x ?></label>
                                        <input type="text" class="form-control form-control-sm" id="rute<?php echo $x ?>" name="rute<?php echo $x ?>" value="<?php echo $row['nama'] ?>">
                                    </div>
                                <?php
                                }
                                ?>
                                <input type="hidden" id="hari" name="hari" value="<?php echo  $hari ?>">
                                <?php
                                if ($status == '1') {
                                ?>
                                    <div class="list-button-update" id="list-button-update">
                                        <button type="button" class="btn btn-success" id='but_upload2' onclick="fungsi_update_rute(<?php echo $row_data['id'] ?>)">UPDATE</button>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="list-button-add" id="list-button-add">
                                        <button type="button" class="btn btn-warning" id='but_upload' onclick="fungsi_rute(<?php echo $row_data['id'] ?>)">ADD</button>
                                    </div>
                                    <div class="list-button-update" id="list-button-update" style="display: none;">
                                        <button type="button" class="btn btn-success" id='but_upload2' onclick="fungsi_update_rute(<?php echo $row_data['id'] ?>)">UPDATE</button>
                                    </div>
                                <?php
                                }
                                ?>
                            </from>
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
            "iDisplayLength": 5
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".tip").tooltip({
            placement: 'top',
            trigger: "hover"
        });
    });
</script>
<script>
    function fungsi_rute(x) {
        var hari = $("input[name=hari]").val();
        let formData = new FormData();
        for (let i = 1; i <= hari; i++) {
            var rute = $("input[name=rute" + i + "]").val();
            formData.append("rute[]", rute);
        }

        formData.append('id', x);
        formData.append('hari', hari);
        $.ajax({
            type: 'POST',
            url: "insert_add_LTrute.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                // LT_itinerary(0, 0, 0);
                $('.list-button-update').show();
                $('.list-button-add').hide();
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }

    function fungsi_update_rute(x) {
        var hari = $("input[name=hari]").val();
        let formData = new FormData();
        for (let i = 1; i <= hari; i++) {
            var rute = $("input[name=rute" + i + "]").val();
            formData.append("rute[]", rute);
        }


        formData.append('id', x);
        formData.append('hari', hari);
        $.ajax({
            type: 'POST',
            url: "update_add_LTrute.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                // LT_itinerary(0, 0, 0);
                $('.list-button-update').show();
                // $('.list-button-add').hide();
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }
</script>