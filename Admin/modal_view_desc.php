<?php
include "../db=connection.php";
if ($_POST['id'] != "") {
    $query = "SELECT * FROM Upload_tokopedia  where id='" . $_POST['id'] . "'";
    $rs = mysqli_query($con, $query);
    $row = mysqli_fetch_array($rs);

    echo $row['deskripsi'];

?>
    <!-- <div class="form-group">
        <label>Note</label>
        <textarea id="note" name="note"><?php echo $row['note'] ?></textarea>
    </div>
    <input type="hidden" id="id" name="id" value="<?php echo  $_POST['id'] ?>"> -->
<?php
}
?>

