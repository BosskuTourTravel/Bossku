<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
?>
<div class="content-wrapper" style="padding: 5px;">
	<div class="card text-center">
		<div class="card-header" style="background-color: darkslategray; color:white">
			<div class="row">
				<div class="col-6" style="text-align: left;">FORM INPUT LIST TEMPAT</div>
				<div class="col-6">
					<div style="text-align: right;">
						<button type="button" class="btn btn-warning btn-sm" onclick="LT_Package(0,0,0)"><i class="fa fa-arrow-left"></i></button>
						<button type="button" class="btn btn-primary btn-sm" onclick="LT_Package(20,0,0)"><i class="fa fa-sync"></i></button>
					</div>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group" style="max-width: 300px;">
							<select class="form-control form-control-sm" id="sel" name="sel" onchange="fungsi_change(this.value)">
								<option value="">Pilih jumlah data </option>
								<?php for ($i = 1; $i <= 20; $i++) {
								?>
									<option value="<?php echo $i ?>"><?php echo $i ?></option>
								<?php
								} ?>
							</select>
						</div>
					</div>
					<div class="col-md-6" style="text-align: left;">
						<div class="form-check">
							<input type="checkbox" class="form-check-input" id="chck_text">
							<label>Text Area</label>
						</div>
					</div>
				</div>
			</div>
			<div class="content-list-tmp"></div>
		</div>
		<div class="card-footer text-muted">
			<button type="button" class="btn btn-primary btn-sm" onclick="add_tmp()">ADD LIST TEMPAT</button>
		</div>
	</div>
</div>
<script>
	function fungsi_change(x) {
		if ($('#chck_text').is(':checked')) {
			$.ajax({
				url: "content-list-tmp.php",
				method: "POST",
				asynch: false,
				data: {
					id: x,
				},
				success: function(data) {
					$('.content-list-tmp').html(data);
				}
			});
		} else {
			$.ajax({
				url: "content-list-tmp2.php",
				method: "POST",
				asynch: false,
				data: {
					id: x,
				},
				success: function(data) {
					$('.content-list-tmp').html(data);
				}
			});
		}
	}

	function add_tmp() {
		var sel = document.getElementById("sel").value;
		if (sel == "") {
			alert("Select Data tidak boleh kosong !!");
		} else {
			let formData = new FormData();
			for (var i = 1; i <= sel; i++) {
				var con = document.getElementById("con" + i).value;
				var cou = document.getElementById("cou" + i).value;
				var cit = document.getElementById("cit" + i).value;
				var pn = document.getElementById("pn" + i).value;
				var pnd = document.getElementById("pnd" + i).value;
				var kurs = document.getElementById("kurs" + i).value;
				var adt = document.getElementById("adt" + i).value;
				var chd = document.getElementById("chd" + i).value;
				var inf = document.getElementById("inf" + i).value;
				var ket = document.getElementById("ket" + i).value;

				formData.append('con' + i, con);
				formData.append('cou' + i, cou);
				formData.append('cit' + i, cit);
				formData.append('pn' + i, pn);
				formData.append('pnd' + i, pnd);
				formData.append('kurs' + i, kurs);
				formData.append('adt' + i, adt);
				formData.append('chd' + i, chd);
				formData.append('inf' + i, inf);
				formData.append('ket' + i, ket);
			}
			formData.append('sel', sel);
			// console.log(formData);
			$.ajax({
				type: 'POST',
				url: "insert_list_tmp.php",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function(msg) {
					alert(msg);
					LT_Package(20, 0, 0);
				},
				error: function() {
					alert("Data Gagal Diupload");
				}
			});
		}
	}
</script>