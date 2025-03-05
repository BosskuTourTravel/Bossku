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
                                <a class="btn btn-warning btn-sm tip" onclick="LT_itinerary(27,<?php echo $_POST['id'] ?>,0)" title="Back"><i class="fas fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(29,<?php echo $_POST['id'] ?>,0)" title="Refresh"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <div class="card text-left" style="padding: 20px;">
                        <div class="hotel" id="hotel">
                            <from>
                                <?php
                                $statusHotel = 0;
                                for ($x = 1; $x <= $hari; $x++) {
                                    $queryHotel = "SELECT * FROM  LT_add_pilihHotel where tour_id='" . $_POST['id'] . "' && hari='$x'";
                                    $rsHotel = mysqli_query($con, $queryHotel);
                                    $rowHotel = mysqli_fetch_array($rsHotel);
                                    if ($rowHotel['id'] != "") {
                                        $statusHotel = 1;

                                        if ($rowHotel['hotel'] == 1) {
                                ?>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="hotel<?php echo $x ?>" name="hotel<?php echo $x ?>" checked>
                                                <label class="form-check-label" for="hotel">Hotel Day <?php echo $x . " " . $ket_hotel ?></label>
                                            </div>
                                        <?php

                                        } else {
                                        ?>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="hotel<?php echo $x ?>" name="hotel<?php echo $x ?>">
                                                <label class="form-check-label" for="hotel">Hotel Day <?php echo $x . " " . $ket_hotel ?></label>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        if ($x == $hari) {
                                        ?>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="hotel<?php echo $x ?>" name="hotel<?php echo $x ?>">
                                                <label class="form-check-label" for="hotel">Hotel Day <?php echo $x . " " . $ket_hotel ?></label>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="hotel<?php echo $x ?>" name="hotel<?php echo $x ?>" checked>
                                                <label class="form-check-label" for="hotel">Hotel Day <?php echo $x . " " . $ket_hotel ?></label>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    }
                                    ?>

                                <?php
                                }
                                ?>
                                <input type="hidden" id="hari" name="hari" value="<?php echo  $hari ?>">
                                <?php
                                if ($statusHotel == '1') {
                                ?>
                                    <div class="hotel-button-update" id="hotel-button-update">
                                        <button type="button" class="btn btn-success" onclick="fungsi_update_hotel(<?php echo $row_data['id'] ?>)">UPDATE</button>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="hotel-button-add" id="hotel-button-add">
                                        <button type="button" class="btn btn-warning" onclick="fungsi_add_hotel(<?php echo $row_data['id'] ?>)">ADD</button>
                                    </div>
                                    <div class="hotel-button-update" id="hotel-button-update" style="display: none;">
                                        <button type="button" class="btn btn-success" onclick="fungsi_update_hotel(<?php echo $row_data['id'] ?>)">UPDATE</button>
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
            placement: 'top'
        });
    });
</script>
<script>
    function fungsi_add_hotel(x) {
        var hari = $("input[name=hari]").val();
        let formData = new FormData();
        for (let i = 1; i <= hari; i++) {
            ;
            if ($('#hotel' + i).is(":checked")) {
                formData.append("hotel[]", 1);
            } else {
                formData.append("hotel[]", 0);
            }

        }

        formData.append('id', x);
        formData.append('hari', hari);
        $.ajax({
            type: 'POST',
            url: "insert_add_LThotel.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                // LT_itinerary(0, 0, 0);
                $('.hotel-button-update').show();
                $('.hotel-button-add').hide();
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }

    function fungsi_update_hotel(x) {
        var hari = $("input[name=hari]").val();
        let formData = new FormData();
        for (let i = 1; i <= hari; i++) {
            if ($('#hotel' + i).is(":checked")) {
                formData.append("hotel[]", 1);
            } else {
                formData.append("hotel[]", 0);
            }
        }
        formData.append('id', x);
        formData.append('hari', hari);
        $.ajax({
            type: 'POST',
            url: "update_add_LThotel.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(msg) {
                alert(msg);
                // LT_itinerary(0, 0, 0);
                $('.hotel-button-update').show();
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    }
</script>