<?php
include "../db=connection.php";
$query2 = "SELECT * FROM MP_tokopedia_rent where id=".$_POST['id'];
$rs2 = mysqli_query($con, $query2);
$row2 = mysqli_fetch_array($rs2);
?>
<div class="form-group">
    <label>Package Name</label>
    <input type="text" class="form-control" id="edit" value="<?php echo $row2['nama'] ?>">
    <input type="hidden" id="mp_id" value="<?php echo $_POST['id'] ?>">
</div>