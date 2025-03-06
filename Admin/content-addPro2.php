<?php
include "../db=connection.php";

if ($_POST['id'] != "") {
?>
	<div class="row" style="text-align: left;">
		<div class="col-md-8">
			<textarea class="summernote" id="ket_pro"></textarea>
			<!-- <input type="text" class="form-control form-control-sm" id="ket_pro"> -->
		</div>
		<div class="col-md-4" style="text-align: left;">
			<button type="button" class="btn btn-warning btn-sm" onclick="change_ket(<?php echo $_POST['id'] ?>)">Change </button>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			$('.summernote').summernote();
		});

		function change_ket(x) {
			let formData = new FormData();
			var ket = document.getElementById("ket_pro").value;
			formData.append('ket', ket);
			formData.append('id', x);
			$.ajax({
				type: 'POST',
				url: "update_ket_list_tmp.php",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function(msg) {
					alert(msg);
					LT_Package(21, x, 0);
				},
				error: function() {
					alert("Data Gagal Diupload");
				}
			});
		}
	</script>
<?php
}
?>