<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";


$query = "SELECT * FROM LT_itinnew where id='" . $_POST['id'] . "'";
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);

?>
<div class='content-wrapper'>
	<div class='row'>
		<div class='col-12'>
			<div class='card'>
				<div class='card-body table-responsive p-0' style="padding: 20px !important;">
					FORM INSERT LANDTOUR
				</div>
			</div>
			<div class="container" style="max-width: 760px; padding: 20px;">
				<div class="card">
					<div class="card-header">
						<div style="text-align: center;"><b><?php echo $row['judul']?></b></div>
					</div>
					<div class="card-body">
						<form>
							<div class="form-group">
								<label style="font-size: 11px;">JUDUL TOUR </label>
								<input class="form-control form-control-sm" type="text" name="j_tour" id="j_tour" placeholder="Judul TOUR">
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<label style="font-size: 12px;">Landtour Name</label>
										<input class="form-control form-control-sm" type="text" name="LT_name" id="LT_name" value="<?php echo $row['kode'] ?>" disabled>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label style="font-size: 11px;">JUMLAH HARI</label>
								<input class="form-control form-control-sm" type="text" name="hari" id="hari" placeholder="Masukkan Jumlah Hari">
							</div>
							<div class="form-group">
								<input type="file" id="files" name="files[]" onchange="preview_image();" accept="image/*" multiple />
							</div>
							<div class="form-group">
								<div id="image_preview"></div>
							</div>
							<button type="button" class="btn btn-primary" id='but_upload' onclick="insert_itin()">CREATE</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function preview_image() {
		var total_file = document.getElementById("files").files.length;
		for (var i = 0; i < total_file; i++) {
			$('#image_preview')
				.append('<div class="col-md-3"')
				.append("<img src='" + URL.createObjectURL(event.target.files[i]) + "' style='width:150px; hight:150px; padding=10px'>")
				.append('</div>');
		}
	}

</script>
<script>
	function insert_itin() {
		var fileSelect = document.getElementById('files');
		var files = fileSelect.files;
		var total_file = document.getElementById("files").files.length;

		let formData = new FormData();
		var judul = $("input[name=j_tour]").val();
		var lt_name = $("#LT_name").val();
		var hari = $("input[name=hari]").val();
		if (total_file < 4) {
			alert("Gambar Kurang Dari 4");
		} else {
			if (hari == "") {
				alert("Hari Tidak Boleh Kosong");
			} else {
				// alert(hari);
				for (var i = 0; i < total_file; i++) {
					formData.append("fileToUpload[]", document.getElementById('files').files[i]);
				}

				formData.append('judul', judul);
				formData.append('landtour_name', lt_name);
				formData.append('hari', hari);
				$.ajax({
					type: 'POST',
					url: "insert_add_LT.php",
					data: formData,
					cache: false,
					processData: false,
					contentType: false,
					success: function(msg) {
						alert(msg);
						LT_itinerary(0, 0, 0);
					},
					error: function() {
						alert("Data Gagal Diupload");
					}
				});

			}
		}


	}
</script>