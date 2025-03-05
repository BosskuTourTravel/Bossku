<?php
if (isset($_POST['room'])) {
    // $sisa = intval($_POST['adt']) - intval($_POST['room']);
    // $sisa_anak = intval($_POST['chd']);
    // echo "dewasa : " . $_POST['adt'];
    // echo "sisa : " . $sisa;
    // echo "sisa anak : " . $sisa_anak;

?>
    <input type="hidden" id="room_val" value="<?php echo $_POST['room'] ?>">
    <!-- <input type="hidden" id="total_adt" value="<?php echo $_POST['adt'] ?>"> -->
    <div class="card p-1">
        <div class="card-header" style="text-align: center; font-weight: bold;">
            ROOM
        </div>
        <div class="card-body p-1">
            <ul class="list-group list-group-flush">
                <?php
                for ($i = 1; $i <= $_POST['room']; $i++) {
                    $val_dewasa = 1;
                    $val_anak = 0;
                    // if ($sisa > 0) {
                    //     $val_dewasa++;
                    // }
                    // if ($sisa_anak > 0) {
                    //     $val_anak = $val_anak + 2;
                    // }
                ?>
                    <li class="list-group-item px-0">
                        <div class="font-weight-bold"><b><?php echo "ROOM " . $i ?></b></div>
                        <div class="d-flex flex-row justify-content-between align-items-center gap-2">
                            <div class="d-flex flex-row justify-content-between align-items-center gap-1">
                                <div class="form-group">
                                    <label>Dewasa</label>
                                    <div class="d-flex flex-row justify-content-between gap-1">
                                        <button type="button" class="btn btn-warning btn-sm" onclick="kurang_adt_room(<?php echo $i ?>)"><i class="fa fa-minus"></i></button>
                                        <input type="text" class="form-control form-control-sm" id="adt_room_<?php echo $i ?>" disabled value="<?php echo $val_dewasa ?>">
                                        <button type="button" class="btn btn-warning btn-sm" onclick="tambah_adt_room(<?php echo $i ?>)"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-between align-items-center gap-1">
                                <div class="form-group">
                                    <label>Anak-anak</label>
                                    <div class="d-flex flex-row justify-content-between gap-1">
                                        <button type="button" class="btn btn-warning btn-sm" onclick="kurang_chd_room(<?php echo $i ?>)"><i class="fa fa-minus"></i></button>
                                        <input type="text" class="form-control form-control-sm" id="chd_room_<?php echo $i ?>" disabled value="<?php echo $val_anak ?>">
                                        <button type="button" class="btn btn-warning btn-sm" onclick="tambah_chd_room(<?php echo $i ?>)"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php
                    // if ($sisa > 0) {
                    //     $sisa--;
                    // }
                    // if ($sisa_anak > 0) {
                    //     $sisa_anak = $sisa_anak - 2;
                    // }
                }
                ?>
                <li class="list-group-item px-0 align-items-center d-flex justify-content-center">
                    <button type="button" class="btn btn-success btn-sm" onclick="add_val_hotel(<?php echo $_POST['id'] ?>,<?php echo $_POST['master'] ?>)">Check Price</button>
                </li>
            </ul>
        </div>
    </div>
<?php
}
?>
<script>
    // function cek_total_adt() {
    //     var room = document.getElementById("room_val").value;
    //     var total = 0;
    //     for (i = 1; i <= room; i++) {
    //         var adt = document.getElementById("adt_room_" + i).value;
    //         var adt_int = parseInt(adt);
    //         total = total + adt_int;
    //     }
    //     return total;
    // }

    // function cek_total_chd() {
    //     var room = document.getElementById("room_val").value;
    //     var total = 0;
    //     for (i = 1; i <= room; i++) {
    //         var chd = document.getElementById("chd_room_" + i).value;
    //         var chd_int = parseInt(chd);
    //         total = total + chd_int;
    //     }
    //     return total;
    // }

    function tambah_adt_room(x) {

        // var total_adt = document.getElementById("total_adt").value;
        // var total_adt_int = parseInt(total_adt);
        // const total = cek_total_adt();
        // if (total_adt_int > total) {
            var adt_room = document.getElementById("adt_room_" + x).value;
            var cek = parseInt(adt_room);
            var tambah = cek + 1;
            if (tambah >= 3) {
                alert("Maksimal Orang Dewasa dalam kamar, 2 orang !");
            } else {
                document.getElementById("adt_room_" + x).value = tambah;
            }
        // } else {
        //     alert("Total Peserta Tidak Sesuai !");
        // }
    }

    function kurang_adt_room(x) {
        var adt_room = document.getElementById("adt_room_" + x).value;
        var cek = parseInt(adt_room);
        var kurang = cek - 1;
        if (cek <= 1) {
            alert("Minimal Orang Dewasa dalam kamar, 1 orang !");
        } else {
            document.getElementById("adt_room_" + x).value = kurang;
        }
    }

    function tambah_chd_room(x) {

        // var total_chd = document.getElementById("total_chd").value;
        // var total_chd_int = parseInt(total_chd);
        // const total = cek_total_chd();
        // if (total_chd_int > total) {
            var chd_room = document.getElementById("chd_room_" + x).value;
            var cek = parseInt(chd_room);
            var tambah = cek + 1;
            if (tambah >= 3) {
                alert("Maksimal Anak-anak dalam kamar, 2 orang !");
            } else {
                document.getElementById("chd_room_" + x).value = tambah;
            }
        // } else {
        //     alert("Total Peserta Tidak Sesuai !");
        // }
    }

    function kurang_chd_room(x) {
        var chd_room = document.getElementById("chd_room_" + x).value;
        var cek = parseInt(chd_room);
        var kurang = cek - 1;
        if (cek <= 1) {
            alert("Minimal Orang Dewasa dalam kamar, 1 orang !");
        } else {
            document.getElementById("chd_room_" + x).value = kurang;
        }
    }

    function add_val_hotel(x, y) {
        let formData = new FormData();
        var tgl = document.getElementById("tgl").value;
        var room = document.getElementById("room").value;

        for(i=1; i<= room ; i++){
            var adt = document.getElementById('adt_room_' + i).value;
            var chd = document.getElementById('chd_room_' + i).value;

            formData.append('adt' + i, adt);
            formData.append('chd' + i, chd);

        }
        formData.append('room',room);
        formData.append('tgl', tgl);
        formData.append('id',x);
        formData.append('master',y);
        $.ajax({
                  type: 'POST',
                  url: "booking-content.php",
                  data: formData,
                  cache: false,
                  processData: false,
                  contentType: false,
                  success: function(msg) {
                    $('.content-booking').html(msg);
                        // LT_Package(15, 0, 0);
                  }
            });
    }
</script>