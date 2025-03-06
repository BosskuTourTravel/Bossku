<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";


$query_LTNx = "SELECT DISTINCT judul,kode FROM LT_itinnew  Order by id ASC";
$rs_LTNx = mysqli_query($con, $query_LTNx);

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
										<input class="form-control form-control-sm" list="ltn_list" name="LT_name" id="LT_name" placeholder="Landtour Name" onchange="fungsi_ltpax()">
										<datalist id="ltn_list">
											<?php

											while ($row_ltn = mysqli_fetch_array($rs_LTNx)) {
												$kode = $row_ltn['kode'];
											?>
												<option data-customvalue="<?php echo $kode ?>" value="<?php echo $row_ltn['kode'] . " - " . $row_ltn['judul'] ?>"></option>
											<?php
											}
											?>
										</datalist>
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

	function fungsi_ltpax() {
		var gb = $("#LT_name").val();
		var h_gb = $('#ltn_list [value="' + gb + '"]').data('customvalue');
		// alert(h_gb);
		$.post('get_select_ltpax.php', {
			'brand': h_gb
		}, function(data) {
			var jsonData = JSON.parse(data);
			// console.log(jsonData);
			if (jsonData != '') {
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					$('#sel_pax').append('<option value=' + counter.pax + '>' + counter.pax + '</option>');
				}
			} else {
				$("#sel_pax").empty().append('<option selected="selected" value="">Tidak ada Hotel Tersedia</option>');
			}
		});
	}
</script>
<script>
	function insert_itin() {
		var fileSelect = document.getElementById('files');
		var files = fileSelect.files;
		var total_file = document.getElementById("files").files.length;

		let formData = new FormData();

		var judul = $("input[name=j_tour]").val();
		var gb = $("#LT_name").val();
		var lt_name = $('#ltn_list [value="' + gb + '"]').data('customvalue');
		var hari = $("input[name=hari]").val();
		// if (total_file < 4) {
		// 	alert("Gambar Kurang Dari 4");
		// } else {
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
		// }


	}
</script>