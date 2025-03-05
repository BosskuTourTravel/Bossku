<?php
include "../db=connection.php";
$query_cek = "SELECT * FROM promo_flight where id='" . $_POST['id'] . "'";
$rs_cek = mysqli_query($con, $query_cek);
$row_cek = mysqli_fetch_array($rs_cek);
?>
<div class="card">
    <div class="card-header d-flex justify-content-between bg-primary">
        <div>
            <h5><?php echo $row_cek['nama'] ?></h5>
        </div>
        <div>
            <button type="button" onclick="upload_fl(<?php echo $_POST['id'] ?>)" class="btn btn-warning btn-sm mr-1"><i class="fas fa-upload"></i> Upload</button>
            <button type="button" onclick="" class="btn btn-warning btn-sm mr-1"><i class="fas fa-print"></i> Print</button>
        </div>

    </div>
    <div class="card-body">
        <div>
            <table id="table-flight" class="table table-striped table-bordered table-sm p-2" style="font-size: 12px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Maskapai</th>
                        <th>City IN</th>
                        <th>City OUT</th>
                        <th>Musim</th>
                        <th>Tipe</th>
                        <th>Trip</th>
                        <th>Adt</th>
                        <th>Chd</th>
                        <th>Inf</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query_detail = "SELECT promo_flight_detail.*,LT_flight_logo.nama as maskapai,LT_flight_logo.kode,LTP_type_flight.nama as trip_type FROM promo_flight_detail LEFT JOIN LT_flight_logo ON promo_flight_detail.flight=LT_flight_logo.id LEFT JOIN LTP_type_flight ON promo_flight_detail.trip=LTP_type_flight.id where id_promo='" . $_POST['id'] . "' ORDER by promo_flight_detail.id ASC";
                    $rs_detail = mysqli_query($con, $query_detail);
                    // var_dump($query_detail);
                    while ($row_detail = mysqli_fetch_array($rs_detail)) {
                    ?>
                        <tr>
                            <td><?php echo $row_detail['id'] ?></td>
                            <td><?php echo $row_detail['maskapai'] . "(" . $row_detail['kode'] . ")" ?></td>
                            <td><?php echo $row_detail['city_in'] ?></td>
                            <td><?php echo $row_detail['city_out'] ?></td>
                            <td><?php echo $row_detail['musim'] ?></td>
                            <td><?php echo $row_detail['tipe'] ?></td>
                            <td><?php echo $row_detail['trip_type'] ?></td>
                            <td><?php echo "IDR " . number_format($row_detail['adt']) ?></td>
                            <td><?php echo "IDR " . number_format($row_detail['chd']) ?></td>
                            <td><?php echo "IDR " . number_format($row_detail['inf']) ?></td>
                            <td>
                                <?php
                                switch ($row_detail['status']) {
                                    case "online":
                                ?>
                                        <span class="badge rounded-pill bg-success"><?php echo $row_detail['status'] ?></span>
                                    <?php
                                        break;
                                    case "invalid":
                                    ?>
                                        <span class="badge rounded-pill bg-warning"><?php echo $row_detail['status'] ?></span>
                                    <?php
                                        break;
                                    default:
                                    ?>
                                        <span class="badge rounded-pill bg-danger"><?php echo $row_detail['status'] ?></span>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-link btn-sm" onclick="edit(<?php echo $row_detail['id'] ?>)"><i class="fa fa-edit"></i> Edit</button>
                                <button type="button" class="btn btn-link btn-sm" onclick="del(<?php echo $row_detail['id'] ?>)"><i class="fa fa-trash"></i> Hapus</button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table-flight').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 25
        });

    });

    function upload_fl(x) {
        $.ajax({
            url: "upload_promo_flight.php",
            method: "POST",
            asynch: false,
            data: {
                id: x
            },
            success: function(data) {
                alert(data);
            }
        });
    }

    function del(x) {
        var txt;
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            $.ajax({
                url: "delete_promo.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x
                },
                success: function(data) {
                    if (data == "success") {
                        LT_Package(24,0,0);
                    } else {
                        alert("Fail to Delete");
                    }
                }
            });
        }
    }
    function edit(x){
        
    }
</script>