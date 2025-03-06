<?php
include "../site.php";
include "../db=connection.php";
$query_tp = "SELECT * FROM  Transport_new where id='".$_POST['id']."'";
$rs_tp= mysqli_query($con, $query_tp);
$row_tp = mysqli_fetch_array($rs_tp);

?>
<div>
	<div class="form-group">
		<label>Link Image</label>
		<input type="text" class="form-control" id="img_link" value="<?php echo $row_tp['img'] ?>"  placeholder="Masukkan Link Gambar">
	</div>
	<input type="hidden" class="form-control" id="id" value="<?php echo $_POST['id'] ?>">
</div>