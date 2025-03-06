<?php
include "../site.php";
include "../db=connection.php";

$query_img2 = "SELECT * FROM List_tempat_img where tmp_id=" . $_POST['id'];
$rs_img2 = mysqli_query($con, $query_img2);
$row_img2 = mysqli_fetch_array($rs_img2);
var_dump($query_img2);

?>
<div class="form-group">
	<label for="exampleFormControlInput1" class="form-label">Link IMG Spring</label>
	<input type="text" class="form-control" id="link" value="<?php echo $row_img2['link'] ?>">
</div>
<div class="form-group">
	<label>Link IMG Winter</label>
	<input type="text" class="form-control" id="img_winter" value="<?php echo $row_img2['summer_img'] ?>" >
</div>
<div class="form-group">
	<label>Link IMG Summer</label>
	<input type="text" class="form-control" id="img_summer" value="<?php echo $row_img2['winter_img'] ?>">
</div>
<div class="form-group">
	<label>Link IMG Autumn</label>
	<input type="text" class="form-control" id="img_autumn" value="<?php echo $row_img2['autumn_img'] ?>" >
</div>
<div class="form-group">
	<label>Link Video</label>
	<input type="text" class="form-control" id="vid" value="<?php echo $row_img2['vid'] ?>">
</div>
<button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="add_img(<?php echo $_POST['id'] ?>)">Add</button>


<script>
	function add_img(x) {
		var link = document.getElementById("link").value;
		var winter = document.getElementById("img_winter").value;
		var summer = document.getElementById("img_summer").value;
		var autumn = document.getElementById("img_autumn").value;
		var vid = document.getElementById("vid").value;
		$.ajax({
			url: "LTP_insert_tmp_img.php",
			method: "POST",
			asynch: false,
			data: {
				id: x,
				link: link,
				winter:winter,
				summer:summer,
				autumn:autumn,
				vid:vid
			},
			success: function(data) {
				if (data == "success") {
					LT_Package(0, 0, 0);
				} else {
					alert("Fail to Input");
				}
			}
		});
	}
</script>