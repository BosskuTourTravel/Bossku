<div class="card">
    <div class="card-header">
        Book Noow
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div class="form-group" style="padding: 5px;">
                <label>Room</label>
                <div class="d-flex flex-row justify-content-between gap-1">
                    <button type="button" class="btn btn-warning" onclick="kurang_room()"><i class="fa fa-minus"></i></button>
                    <input type="text" class="form-control" id="room" disabled value="1">
                    <button type="button" class="btn btn-warning" onclick="tambah_room()"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </li>
        <li class="list-group-item" id="room-list">
            <?php
            for ($i = 1; $i <= 1; $i++) {
                $val_dewasa = 1;
                $val_anak = 0;
            ?>
                <div class="p-2">
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
                </div>
            <?php
            }
            ?>
        </li>
        <li class="list-group-item align-items-center d-flex justify-content-center">
            <button type="button" class="btn btn-success btn-sm" onclick="chck_price(<?php echo $_POST['id'] ?>)">Check Price</button>
        </li>
    </ul>
</div>