
<?php
include "../db=connection.php";
$query_hotel = "SELECT * FROM LAN_Hotel_List WHERE id='" . $_POST['id'] . "'";
$rs_hotel = mysqli_query($con, $query_hotel);
$row_hotel = mysqli_fetch_array($rs_hotel);
?>
<div style="padding: 20px;">
    <div class="form-group">
        <label>Hari</label>
        <input type="text" class="form-control" id="hari" value="<?php echo $row_hotel['hari'] ?>">
    </div>
    <div class="form-group">
        <label>Urutan</label>
        <input type="text" class="form-control" id="urutan" value="<?php echo $row_hotel['urutan'] ?>">
        <input type="hidden" id="id_hotel" value="<?php echo $_POST['id'] ?>">
    </div>
</div>