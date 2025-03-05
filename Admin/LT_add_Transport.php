<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";



$query_data = "SELECT * FROM LTSUB_itin WHERE id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);
?>
<div class='content-wrapper'>
	<div class='row'>
		<div class='col-12'>
			<div class='card'>
				<div class='card-body table-responsive p-0' style="padding: 20px !important;">
					FORM INSERT COMPONENT LANDTOUR
				</div>
			</div>
			<div class="container" style="max-width: 760px; padding: 20px;">
				<div class="card">
					<div class="card-header">

						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="pilihan" id="pilihan0" value="0" checked>
							<label class="form-check-label" for="pilihan0">FLIGHT</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="pilihan" id="pilihan1" value="1">
							<label class="form-check-label" for="pilihan1">FERRY</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="pilihan" id="pilihan2" value="2">
							<label class="form-check-label" for="pilihan2">TRAIN</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="pilihan" id="pilihan3" value="3">
							<label class="form-check-label" for="pilihan3">LAND TRANS</label>
						</div>
						<!-- <div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="pilihan" id="pilihan4" value="4">
							<label class="form-check-label" for="pilihan4">TL Fee</label>
						</div> -->
					</div>

					<div class="card-body">
						<div class="flight" id="flight">
							<form>
								<?php $i = 1; ?>
								<div id="dynamic_field">
									<div class="form-row">
										<div class="form-group col-md-1">
											<label for="">Hari</label>
										</div>
										<div class="form-group col-md-1">
											<label for="">Urutan</label>
										</div>
										<div class="form-group col-md-2">

											<label for="">Flight Type</label>
										</div>
										<div class="form-group col-md-4">
											<label for="">Flight Rute</label>
										</div>
										<div class="form-group col-md-2">
											<label for="">Flight Name</label>
										</div>
										<div class="form-group col-md-2">
											<label for="">Action</label>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-1">
											<input type="text" class="form-control  form-control-sm" id="hari<?php echo $i ?>" name="hari<?php echo $i ?>">
										</div>
										<div class="form-group col-md-1">
											<input type="text" class="form-control  form-control-sm" id="urutan<?php echo $i ?>" name="urutan<?php echo $i ?>">
										</div>
										<div class="form-group col-md-2">
											<select class="form-control form-control-sm" name="f_type<?php echo $i ?>" id="f_type<?php echo $i ?>" onchange="fungsi_fl(<?php echo $f ?>)">
												<option selected>Pilih</option>
												<option value="ONE WAY">ONE WAY</option>
												<option value="RETURN">RETURN</option>
												<option value="MULTI">MULTI</option>
											</select>
										</div>
										<div class="form-group col-md-4">
											<select class="form-control form-control-sm" id="f_rute<?php echo $i ?>" name="f_rute<?php echo $i ?>" onchange="fungsi_fval(<?php echo $f ?>)">
												<option value="">Rute Name</option>
											</select>
										</div>
										<div class="form-group col-md-2">
											<select class="form-control form-control-sm" id="f_name<?php echo $i ?>" name="f_name<?php echo $i ?>">
												<option value="">Flight Name</option>
											</select>
										</div>
										<div class="form-group col-md-2">
											<button type="button" name="add" id="add" class="btn btn-primary btn-sm">Add More</button>
										</div>
									</div>
								</div>
								<div class="meal-button-add" id="meal-button-add">
									<input type="hidden" id="copy_id" name="copy_id" value="<?php echo  $row_data['id'] ?>">
									<input type="hidden" id="master_id" name="master_id" value="<?php echo  $row_data['master_id'] ?>">
									<input type="hidden" id="jml" name="jml" value="<?php echo  $i ?>">
									<button type="button" class="btn btn-warning" onclick="fungsi_add_flight()">ADD</button>
								</div>
							</form>
						</div>
						<div class="ferry" id="ferry" style="display: none;">
							<form>
								<?php $f = 1; ?>
								<div id="dynamic_ferry">
									<div class="form-row">
										<div class="form-group col-md-1">
											<label for="">Hari</label>
										</div>
										<div class="form-group col-md-1">
											<label for="">Urutan</label>
										</div>
										<div class="form-group col-md-2">

											<label for="">Ferry Type</label>
										</div>
										<div class="form-group col-md-4">
											<label for="">Ferry Rute</label>
										</div>
										<div class="form-group col-md-2">
											<label for="">Ferry Name</label>
										</div>
										<div class="form-group col-md-2">
											<label for="">Action</label>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-1">
											<input type="text" class="form-control  form-control-sm" id="fer_hari<?php echo $f ?>" name="fer_hari<?php echo $f ?>">
										</div>
										<div class="form-group col-md-1">
											<input type="text" class="form-control  form-control-sm" id="fer_urutan<?php echo $f ?>" name="fer_urutan<?php echo $f ?>">
										</div>
										<div class="form-group col-md-2">
											<select class="form-control form-control-sm" name="fer_type<?php echo $f ?>" id="fer_type<?php echo $f ?>" onchange="ferry_type(<?php echo $f ?>)">
												<option value="" selected>Pilih</option>
												<option value="ONE WAY">ONE WAY</option>
												<option value="ROUND TRIP">ROUND TRIP</option>
											</select>
										</div>
										<div class="form-group col-md-4">
											<select class="form-control form-control-sm" id="fer_rute<?php echo $f ?>" name="fer_rute<?php echo $f ?>" onchange="ferry_rute(<?php echo $f ?>)">
												<option value="">Rute Name</option>
											</select>
										</div>
										<div class="form-group col-md-2">
											<select class="form-control form-control-sm" id="fer_name<?php echo $f ?>" name="fer_name<?php echo $f ?>">
												<option value="">Ferry Name</option>
											</select>
										</div>
										<div class="form-group col-md-2">
											<button type="button" name="add_fer" id="add_fer" class="btn btn-primary btn-sm">Add More</button>
										</div>
									</div>
								</div>
								<div class="meal-button-add" id="meal-button-add">
									<input type="hidden" id="copy_id" name="copy_id" value="<?php echo  $row_data['id'] ?>">
									<input type="hidden" id="master_id" name="master_id" value="<?php echo  $row_data['master_id'] ?>">
									<input type="hidden" id="jml_fer" name="jml_fer" value="<?php echo  $f ?>">
									<button type="button" class="btn btn-warning" onclick="fungsi_add_ferry()">ADD</button>
								</div>
							</form>
						</div>
						<!-- meal package -->
						<div class="train" id="train" style="display: none;">
							<form>

							</form>
						</div>
						<div class="land" id="land" style="display: none;">
							<from>

							</from>
						</div>
						<!-- <div class="tl-fee" id="tl-fee" style="display: none;">tl hhsuhdsud</div> -->

					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	$(document).ready(function() {
		$('.form-check-input').click(function() {

			var target = $(this).val();
			if (target == 0) {
				$('.flight').show();
				$('.ferry').hide();
				$('.train').hide();
				$('.land').hide();
				// $('.tl-fee').hide();

			} else if (target == 1) {
				$('.flight').hide();
				$('.ferry').show();
				$('.train').hide();
				$('.land').hide();
				// $('.tl-fee').hide();
			} else if (target == 2) {
				$('.rute').hide();
				$('.ferry').hide();
				$('.train').show();
				$('.land').hide();
				// $('.tl-fee').hide();
			} else if (target == 3) {
				$('.rute').hide();
				$('.ferry').hide();
				$('.train').hide();
				$('.land').show();
				// $('.tl-fee').hide();
			} else {

			}
		});

	});
</script>
<script>
	function fungsi_fl(x) {
		//// guide fee
		var type = document.getElementById("f_type" + x).options[document.getElementById("f_type" + x).selectedIndex].value;
		// alert(type);
		$.post('get_transport_list.php', {
			'brand': type
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					$('#f_rute' + x).append('<option value=' + counter.rute + '>' + counter.rute + '</option>');
				}
			} else {
				$("#f_rute" + y).empty().append('<option selected="selected" value="">Tidak ada Data</option>');
			}
		});
	}

	function fungsi_fval(x) {
		//// guide fee
		var type = document.getElementById("f_type" + x).options[document.getElementById("f_type" + x).selectedIndex].value;
		var rute = document.getElementById("f_rute" + x).options[document.getElementById("f_rute" + x).selectedIndex].value;
		// alert(rute);
		$.post('get_flight_val.php', {
			'brand': rute,
			'type': type
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					$('#f_name' + x).append('<option value=' + counter.id + '>' + counter.inter + ' ' + counter.maskapai + ' ' + counter.dept + '-' + counter.arr + ' ' + counter.take + ':' + counter.landing + '</option>');
				}
			} else {
				$("#f_name" + x).empty().append('<option selected="selected" value="">Tidak ada Data</option>');
			}
		});
	}

	function ferry_type(x) {
		var type = document.getElementById("fer_type" + x).options[document.getElementById("fer_type" + x).selectedIndex].value;
		$.post('get_ferry_rute.php', {
			'brand': type
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					$('#fer_rute' + x).append('<option value=' + counter.nama + '>' + counter.nama + '</option>');
				}
			} else {
				$("#fer_rute" + x).empty().append('<option selected="selected" value="">Tidak ada Data</option>');
			}
		});
	}

	function ferry_rute(x) {
		var type = document.getElementById("fer_type" + x).options[document.getElementById("fer_type" + x).selectedIndex].value;
		var rute = document.getElementById("fer_rute" + x).options[document.getElementById("fer_rute" + x).selectedIndex].value;
		$.post('get_ferry_rute2.php', {
			'type': type,
			'rute': rute
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					$('#fer_name' + x).append('<option value=' + counter.id + '>' + counter.ferry_name + ' ' + counter.ferry_class + ' ' + counter.jam_dept + ' ' + counter.jam_arr + '</option>');
				}
			} else {
				$("#fer_name" + x).empty().append('<option selected="selected" value="">Tidak ada Data</option>');
			}
		});
	}
</script>
<script>
	$(document).ready(function() {
		var i = 1;
		$('#add').click(function() {
			var jml = $("input[name=jml]").val();
			var val_jml = parseInt(jml) + 1;
			var type = "flight";
			i++;
			$.ajax({
				url: "LT_transport_field.php",
				method: "POST",
				asynch: false,
				data: {
					i: i,
					type: type
				},
				success: function(data) {
					$('#dynamic_field').append(data);
					$('#jml').val(val_jml);
				}
			});
		});

		$(document).on('click', '.btn_remove', function() {
			var button_id = $(this).attr("id");
			var jml = $("input[name=jml]").val();
			var val_jml = parseInt(jml) - 1;
			$('#row' + button_id + '').remove();
			$('#jml').val(val_jml);

		});

		$('#add_fer').click(function() {
			var jml = $("input[name=jml_fer]").val();
			var val_jml = parseInt(jml) + 1;
			var type = "ferry";
			i++;
			$.ajax({
				url: "LT_transport_field.php",
				method: "POST",
				asynch: false,
				data: {
					i: i,
					type: type
				},
				success: function(data) {
					$('#dynamic_ferry').append(data);
					$('#jml_fer').val(val_jml);
				}
			});
		});

		$(document).on('click', '.btn_remove_ferry', function() {
			var button_id = $(this).attr("id");
			var jml = $("input[name=jml_fer]").val();
			var val_jml = parseInt(jml) - 1;
			$('#row_ferry' + button_id + '').remove();
			$('#jml_fer').val(val_jml);

		});

	});
</script>
<script>
	function fungsi_add_flight() {
		var jml = $("input[name=jml]").val();
		var copy_id = $("input[name=copy_id]").val();
		var master_id = $("input[name=master_id]").val();

		let formData = new FormData();
		for (let i = 1; i <= jml; i++) {

			var hari = $("input[name=hari" + i + "]").val();
			var urutan = $("input[name=urutan" + i + "]").val();
			var f_type = document.getElementById("f_type" + i).options[document.getElementById("f_type" + i).selectedIndex].value;
			var f_rute = document.getElementById("f_rute" + i).options[document.getElementById("f_rute" + i).selectedIndex].value;
			var f_name = document.getElementById("f_name" + i).options[document.getElementById("f_name" + i).selectedIndex].value;

			if ((hari == "") || (urutan == "") || (f_type == "") || (f_rute == "" ) || (f_name == "")) {
				alert("Silakan isi semua form fields");
				return false;
			}
			formData.append('hari[]', hari);
			formData.append('urutan[]', urutan);
			formData.append('f_type[]', f_type);
			formData.append('f_rute[]', f_rute);
			formData.append('f_name[]', f_name);
		}
		formData.append('id', '1');
		formData.append('jml', jml);
		formData.append('copy_id', copy_id);
		formData.append('master_id', master_id);
		$.ajax({
			type: 'POST',
			url: "insert_add_LTtransport.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
				// LT_itinerary(0, 0, 0);
				$('.list-button-update').show();
				$('.list-button-add').hide();
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});
	}

	function fungsi_add_ferry() {

		var jml = $("input[name=jml_fer]").val();
		var copy_id = $("input[name=copy_id]").val();
		var master_id = $("input[name=master_id]").val();
		let formData = new FormData();
		for (let i = 1; i <= jml; i++) {
			var hari = $("input[name=fer_hari" + i + "]").val();
			var urutan = $("input[name=fer_urutan" + i + "]").val();
			var f_type = document.getElementById("fer_type" + i).options[document.getElementById("fer_type" + i).selectedIndex].value;
			var f_rute = document.getElementById("fer_rute" + i).options[document.getElementById("fer_rute" + i).selectedIndex].value;
			var f_name = document.getElementById("fer_name" + i).options[document.getElementById("fer_name" + i).selectedIndex].value;

			if ((hari == "") || (urutan == "") || (f_type == "") || (f_rute == "" ) || (f_name == "")) {
				alert("Silakan isi semua form fields");
				return false;
			}

			formData.append('hari[]', hari);
			formData.append('urutan[]', urutan);
			formData.append('f_type[]', f_type);
			formData.append('f_rute[]', f_rute);
			formData.append('f_name[]', f_name);
		}
		// alert("gagal");
		formData.append('id', '2');
		formData.append('jml', jml);
		formData.append('copy_id', copy_id);
		formData.append('master_id', master_id);
		$.ajax({
			type: 'POST',
			url: "insert_add_LTtransport.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
				// LT_itinerary(0, 0, 0);
				$('.list-button-update').show();
				$('.list-button-add').hide();
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});
	}
</script>