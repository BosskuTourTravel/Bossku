<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
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
		<textarea id="note" name="note"><?php echo $row_cek['note'] ?></textarea>
	</div>
	<div style="padding: 20px; text-align: center;"><button type="button" class="btn btn-warning btn-sm" onclick="add_note(<?php echo $_POST['id'] ?>,<?php echo $_POST['master_id'] ?>)" data-dismiss="modal">Submit</button></div>
</div>
<script>
    $(document).ready(function() {
        $('#note').summernote();
    });
</script>
<script>
	function add_note(x, y) {
		let formData = new FormData();
		var note = document.getElementById("note").value;

		formData.append('note', note);
		formData.append('tour_id', x);
		formData.append('master_id', y);
		// alert(y);
		$.ajax({
			type: 'POST',
			url: "insert_note_tour.php",
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