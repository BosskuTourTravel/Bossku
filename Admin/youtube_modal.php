<?php
$query_video = "SELECT * FROM YT_Landtour where tour_id='" . $_POST['id'] . "'";
$rs_video = mysqli_query($con, $query_video);
$row_video = mysqli_fetch_array($rs_video);
if (isset($row_video['id'])) {
?>
    <div class="form-group">
        <label>ID Video Youtube</label>
        <input type="text" class="form-control" id="link" value="<?php echo $row_video['link']  ?>">
    </div>
<?php
} else {
?>
    <div class="form-group">
        <label>ID Video Youtube</label>
        <input type="text" class="form-control" id="link">
    </div>
<?php
}
?>
<input type="text" name="id_tour" id="id_tour" value="<?php echo $_POST['id'] ?>">