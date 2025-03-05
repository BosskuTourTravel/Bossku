<?php
include "../site.php";
include "../db=connection.php";

$query_img2 = "SELECT selected_img_tmp.id,selected_img_tmp.tmp,selected_img_tmp.tmp_type,List_tempat_img.link,List_tempat_img.summer_img,List_tempat_img.winter_img,List_tempat_img.autumn_img FROM selected_img_tmp LEFT JOIN List_tempat_img ON selected_img_tmp.tmp=List_tempat_img.tmp_id WHERE selected_img_tmp.id ='" . $_POST['id'] . "'";
$rs_img2 = mysqli_query($con, $query_img2);
$row_img2 = mysqli_fetch_array($rs_img2);
$p = $row_img2['tmp_type'];
$link = $row_img2[$p];

?>
<div class="form-group">
	<label for="exampleFormControlInput1" class="form-label">Link IMG</label>
	<input type="text" class="form-control" id="link" value="<?php echo  $link ?>">
	<input type="hidden" id="tmp_type" value="<?php echo $p ?>">
</div>

<button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick="add_img(<?php echo $_POST['id'] ?>)">Add</button>


<script>
	function add_img(x) {
		var link = document.getElementById("link").value;
		var tmp_type = document.getElementById("tmp_type").value;
		$.ajax({
			url: "LTP_insert_tmp_img2.php",
			method: "POST",
			asynch: false,
			data: {
				id: x,
				link: link,
				tmp_type: tmp_type,
			},
			success: function(data) {
				alert("Success");
			}
		});
	}
</script>