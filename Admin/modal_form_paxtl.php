<?php
include "../site.php";
include "../db=connection.php";
$query_cek = "SELECT * FROM tour_node where copy_id='" . $_POST['id'] . "' && master_id='" . $_POST['master_id'] . "'";
$rs_cek = mysqli_query($con, $query_cek);
$row_cek = mysqli_fetch_array($rs_cek);
// var_dump($query_cek);


?>
<div>
	<div class="form-group">
		<input type="text" name="pax" id="pax">
	</div>
	<div style="padding: 20px; text-align: center;"><button type="button" class="btn btn-warning btn-sm" onclick="add_note(<?php echo $_POST['id'] ?>,<?php echo $_POST['master_id'] ?>)" data-dismiss="modal">Submit</button></div>
</div>
<script>
	function add_note(x, y) {
		let formData = new FormData();
		var pax = document.getElementById("pax").value;

		formData.append('note', pax);
		formData.append('tour_id', x);
		formData.append('master_id', y);
		// alert(y);
		$.ajax({
			type: 'POST',
			url: "insert_pax_tl.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data) {
				// $('#show_pricelist').html(data);
				alert(data);
			}
		});
	}
</script>