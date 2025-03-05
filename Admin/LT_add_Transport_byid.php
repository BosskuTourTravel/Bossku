<?php
session_start();
include "../site.php";
include "../db=connection.php";

$query_sub = "SELECT * FROM  LTSUB_itin where  id =" . $_POST['id'];
$rs_sub = mysqli_query($con, $query_sub);
$row_sub = mysqli_fetch_array($rs_sub);

$query_sfee = "SELECT * FROM LTP_insert_sfee where id='" . $_POST['sfee_id'] . "'";
$rs_sfee = mysqli_query($con, $query_sfee);
$row_sfee = mysqli_fetch_array($rs_sfee);

?>
<div class="content-wrapper">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title" style="font-weight:bold;">Landtour Transport List</h3>
					<div class="card-tools">
						<div class="input-group input-group-sm" style="width: 150px;">
							<div class="input-group-append" style="text-align: right;">
								<a class="btn btn-warning btn-sm" onclick="MN_Package(0,<?php echo $_POST['id'] ?>,<?php echo $row_sub['master_id'] ?>)"><i class="fa fa-arrow-left"></i></a>
								<!-- <a class="btn btn-warning btn-sm" onclick="LT_itinerary(24,<?php echo $_POST['id'] ?>,0)"><i class="fa fa-plus"></i></a> -->
								<a class="btn btn-info btn-sm" onclick="LT_Get_Flight(0,<?php echo $_POST['id'] ?>,<?php echo $_POST['grub_id'] ?>,<?php echo $_POST['sfee_id'] ?>)"><i class="fas fa-sync-alt"></i></a>
								<!-- <a class="btn btn-info btn-sm" onclick="LT_itinerary(22,<?php echo $row_sub['id'] ?>,<?php echo $row_sub['master_id'] ?>)"><i class="fa fa-plane-departure"></i></a> -->
							</div>
						</div>
					</div>
				</div>
				<!-- /.card-header -->
				<div class="card-body table-responsive p-0">
					<div style="padding: 20px;">
						<table id="example" class="table table-striped table-bordered" style="width:100%; font-size: 12px;">
							<thead>
								<tr>
									<th>Id</th>
									<th>hari ke</th>
									<th>Urutan</th>
									<th>Type </th>
									<th>Detail</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$query_atr = "SELECT * FROM LT_add_transport_baru where master_id='" . $row_sub['master_id'] . "' && copy_id='" . $row_sub['id'] . "' && grub_id='" . $_POST['grub_id'] . "'  order by hari ASC,urutan ASC";
								$rs_atr = mysqli_query($con, $query_atr);
								// var_dump($query_atr);
								while ($row_atr = mysqli_fetch_array($rs_atr)) {
									$type = "";
									if ($row_atr['type'] == '1') {
										$type = "Flight";
										$queryflight = "SELECT * FROM  LTP_route_detail where id='" . $row_atr['transport'] . "'";
										$rsflight = mysqli_query($con, $queryflight);
										$rowflight = mysqli_fetch_array($rsflight);

										$detail = $rowflight['maskapai'] . " " . $rowflight['dept'] . " - " . $rowflight['arr'] . " (" . $rowflight['take'] . " - " . $rowflight['landing'] . ") " . $rowflight['rute'];
									} else if ($row_atr['type'] == '2') {
										$type = "Ferry";
										$query_ferry = "SELECT * FROM ferry_LT  where id=" . $row_atr['transport'];
										$rs_ferry = mysqli_query($con, $query_ferry);
										$row_ferry = mysqli_fetch_array($rs_ferry);
										$detail = $row_ferry['nama'] . " " . $row_ferry['ferry_name'] . " " . $row_ferry['ferry_class'] . " (" . $row_ferry['jam_dept'] . " - " . $row_ferry['jam_arr'] . ") " . $row_ferry['type'];
									} else if ($row_atr['type'] == '4') {
										$type = "Train";
										$query_train = "SELECT * FROM train_LTnew where id=" . $row_atr['transport'];
										$rs_train = mysqli_query($con, $query_train);
										$row_train = mysqli_fetch_array($rs_train);

										$detail = $row_train['nama'] . " (" . $row_train['tgl'] . ")";
									}
								?>
									<tr>
										<td><?php echo  $row_atr['id'] ?></td>
										<td><?php echo $row_atr['hari'] ?></td>
										<td><?php echo $row_atr['urutan'] ?></td>
										<td><?php echo $type ?></td>
										<td><?php echo $detail ?></td>
										<td>
										<a class="btn btn-danger btn-sm" onclick="del_trans(<?php echo $row_atr['id']  ?>,<?php echo $_POST['id'] ?>,<?php echo  $_POST['grub_id'] ?>,<?php echo  $_POST['sfee_id'] ?>)"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php
								}
								?>
							</tbody>
						</table>
					</div>
					<div class="set_flight" style="padding: 20px;">
						<div class="card">
							<div class="card-header" style="background-color: green; color: white;">
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
							</div>
							<div class="card-body">
								<div class="flight" id="flight">

									<?php
									$query_gf = "SELECT LTP_grub_flight_value.id,LTP_grub_flight_value.tgl,LTP_grub_flight_value.grub_id,LTP_grub_flight_value.flight_id,LTP_route_detail.maskapai,LTP_route_detail.dept,LTP_route_detail.arr,LTP_route_detail.take,LTP_route_detail.landing FROM LTP_grub_flight_value INNER JOIN LTP_route_detail ON LTP_grub_flight_value.flight_id = LTP_route_detail.id where LTP_grub_flight_value.grub_id='" . $_POST['grub_id'] . "' order by id ASC;";
									$rs_gf = mysqli_query($con, $query_gf);
									// var_dump($query_gf);
									$i = 1;
									$tgl_vl = "";
									while ($row_gf = mysqli_fetch_array($rs_gf)) {

										$query_cek = "SELECT * FROM LT_add_transport_baru where grub_id='" . $_POST['grub_id'] . "' && transport='" . $row_gf['flight_id'] . "'";
										$rs_cek = mysqli_query($con, $query_cek);
										$row_cek = mysqli_fetch_array($rs_cek);
										// var_dump($query_cek);

										$detail = $row_gf['maskapai'] . " " . $row_gf['dept'] . " - " . $row_gf['arr'] . " (" . $row_gf['take'] . " : " . $row_gf['landing'] . ")";
									?>
										<input type="hidden" name="val_fl<?php echo $i ?>" id="val_fl<?php echo $i ?>" value="<?php echo $row_gf['flight_id'] ?>">
										<div class="form-row" style="padding-bottom: 10px;">
											<div class="col-md-6">
												<label for="">Flight Detail</label>
												<input type="text" class="form-control  form-control-sm" id="detail_fl<?php echo $i ?>" name="detail_fl<?php echo $i ?>" value="<?php echo $detail ?>" disabled>
											</div>
											<div class="col-md-3">
												<label for="">Hari</label>
												<input type="text" class="form-control  form-control-sm" id="f_hari<?php echo $i ?>" name="f_hari<?php echo $i ?>" value="<?php echo $row_cek['hari'] ?>">
											</div>
											<div class="col-md-3">
												<label for="">Urutan</label>
												<input type="text" class="form-control  form-control-sm" id="f_urutan<?php echo $i ?>" name="f_urutan<?php echo $i ?>" value="<?php echo $row_cek['urutan'] ?>">
											</div>
										</div>
									<?php
										$i++;
										$tgl_vl = $row_gf['tgl'];
									}

									?>
									<div style="text-align: right; padding: 10px;">
										<input type="hidden" id="loop" name="loop" value="<?php echo $i ?>">
										<input type="hidden" id="copy_id" name="copy_id" value="<?php echo $row_sub['id'] ?>">
										<input type="hidden" id="master_id" name="master_id" value="<?php echo  $row_sub['master_id'] ?>">
										<input type="hidden" id="tgl" name="tgl" value="<?php echo $row_sfee['date_set'] ?>">
										<button type="button" class="btn btn-warning" onclick="fungsi_add_flight_new(<?php echo  $_POST['grub_id'] ?>,<?php echo  $_POST['sfee_id'] ?>)">ADD</button>
									</div>
								</div>
								<div class="ferry" id="ferry" style="display: none;">
									<form>
										<div class="row">
											<div class="col-md-4">
												<select class="form-control form-control-sm" name="item_fer" id="item_fer" onchange="fungsi_item_fer()">
													<option selected value="">Pilih Jumlah Item</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
												</select>
											</div>
											<div class="col-md-4">
												<input type="date" name='tgl_fr' id='tgl_vr'>
											</div>
										</div>
										<?php $f = 1; ?>
										<div id="dynamic_ferry" style="padding-top: 10px;">

										</div>
										<div class="meal-button-add" id="meal-button-add">
											<input type="hidden" id="copy_id" name="copy_id" value="<?php echo  $row_data['id'] ?>">
											<input type="hidden" id="master_id" name="master_id" value="<?php echo  $row_data['master_id'] ?>">
											<input type="hidden" id="jml_fer" name="jml_fer" value="<?php echo  $f ?>">
											<button type="button" class="btn btn-warning" onclick="fungsi_add_ferry(<?php echo  $_POST['grub_id'] ?>,<?php echo  $_POST['sfee_id'] ?>)">ADD</button>
										</div>
									</form>
								</div>
								<!-- meal package -->
								<div class="train" id="train" style="display: none;">
									<form>
										<div class="row">
											<div class="col-md-4">
												<select class="form-control form-control-sm" name="item_tra" id="item_tra" onchange="fungsi_item_tra()">
													<option selected value="">Pilih Jumlah Item</option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
												</select>
											</div>
										</div>
										<div id="dynamic_train" style="padding-top: 10px;">
										</div>
										<div class="meal-button-add" id="meal-button-add">
											<input type="hidden" id="copy_id" name="copy_id" value="<?php echo  $row_sub['id'] ?>">
											<input type="hidden" id="master_id" name="master_id" value="<?php echo  $row_sub['master_id'] ?>">
											<button type="button" class="btn btn-warning" onclick="add_train(<?php echo  $_POST['grub_id'] ?>,<?php echo  $_POST['sfee_id'] ?>)">ADD</button>
										</div>
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
					<div class="set_itin" style="padding: 20px;">

					</div>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
	</div>

	<!-- /.row -->
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable({
			"aLengthMenu": [
				[5, 10, 25, -1],
				[5, 10, 25, "All"]
			],
			"iDisplayLength": 5
		});
		$('.form-check-input').click(function() {
			var target = $(this).val();
			// alert(target);
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
				$('.flight').hide();
				$('.ferry').hide();
				$('.train').show();
				$('.land').hide();
				// $('.tl-fee').hide();
			} else if (target == 3) {
				$('.flight').hide();
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
	function del_trans(x, y, z,u) {
		var txt;
		var r = confirm("Are you sure to delete?");
		if (r == true) {
			$.ajax({
				url: "LT_delete_transport2.php",
				method: "POST",
				asynch: false,
				data: {
					id: x,
				},
				success: function(data) {
					if (data == "success") {
						LT_Get_Flight(0,y, z,u);
					} else {
						alert("Fail to Delete");
					}
				}
			});
		}
	}
	$(document).ready(function() {

		$('.submit').on('click', e => {
			// alert("on");
			const $button = $(e.target);
			const $modalBody = $button.closest('.modal-footer').prev('.modal-body');
			const id = $button.data('id');
			const master = $button.data('master');
			const copy = $button.data('copy');
			const hari = $modalBody.find($("input[name=hari]")).val();
			const urutan = $modalBody.find($("input[name=urutan]")).val();

			let formData = new FormData();
			formData.append('id', '3');
			formData.append('master_id', master);
			formData.append('copy_id', copy);
			formData.append('hari', hari);
			formData.append('urutan', urutan);
			formData.append('flight_id', id);
			// work with the values here:
			$.ajax({
				type: 'POST',
				url: "insert_add_LTtransport.php",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function(msg) {
					alert(msg);
					LT_itinerary(25, copy, master);
				},
				error: function() {
					alert("Data Gagal Diupload");
				}
			});
			//  console.log(id, hari, rute);

		});
	});
</script>
<script>
	function fungsi_add_flight_new(x, y) {
		let formData = new FormData();
		var copy_id = $("input[name=copy_id]").val();
		var master_id = $("input[name=master_id]").val();
		var sfee_id = y;
		var tgl = $("input[name=tgl]").val();
		var loop = $("input[name=loop]").val();
		var hasil = [];
		var cek = 0;
		var cek_urutan = 0;
		var cek_hari = 0;
		// 
		if (tgl === '') {
			alert("Tgl Keberangkatan Harus di isi ....!");
		} else {
			for (var i = 1; i < loop; i++) {
				var detail = $("input[name=val_fl" + i + "]").val();
				var urutan = $("input[name=f_urutan" + i + "]").val();
				var hari = $("input[name=f_hari" + i + "]").val();
				if (detail != "") {
					formData.append('detail[]', detail);
					cek_urutan++;
				}
				if (urutan != "") {
					formData.append('urutan[]', urutan);
					cek_urutan++;
				}
				if (hari != "") {
					formData.append('hari[]', hari);
					cek_hari++;
				}
				cek++;
			}
			if (cek_hari != 0 || cek_urutan != 0) {
				formData.append('id', '7');
				formData.append('copy_id', copy_id);
				formData.append('master_id', master_id);
				formData.append('jml', '');
				formData.append('grub_id', x);
				formData.append('sfee_id', y);
				formData.append('tgl', tgl);
				$.ajax({
					type: 'POST',
					url: "insert_add_LTtransport.php",
					data: formData,
					cache: false,
					processData: false,
					contentType: false,
					success: function(msg) {
						alert(msg);
						LT_Get_Flight(0, copy_id, x, y);
					},
					error: function() {
						alert("Data Gagal Diupload");
					}
				});

			} else {
				alert("Silakan Mengisi Kolom urutan atau hari !!");
			}
		}

	}

	function fungsi_item_fer() {
		var item = document.getElementById("item_fer").options[document.getElementById("item_fer").selectedIndex].value;
		$.ajax({
			url: "LT_addferry_field.php",
			method: "POST",
			asynch: false,
			data: {
				loop: item,
			},
			success: function(data) {
				$('#dynamic_ferry').html(data);
			}
		})

	}

	function ferry_type(x) {
		var type = document.getElementById("fer_type" + x).options[document.getElementById("fer_type" + x).selectedIndex].value;
		$("#fer_rute" + x).empty();
		$.post('get_ferry_rute.php', {
			'brand': type
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				$('#fer_rute' + x).append('<option value="">Pilih Rute</option>');
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
		$("#fer_name" + x).empty();
		$.post('get_ferry_rute2.php', {
			'type': type,
			'rute': rute
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				$('#fer_name' + x).append('<option value="">Pilih Detail</option>');
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					$('#fer_name' + x).append('<option value=' + counter.id + '>' + counter.ferry_name + ' ' + counter.ferry_class + ' ' + counter.jam_dept + ' ' + counter.jam_arr + '</option>');
				}
			} else {
				$("#fer_name" + x).empty().append('<option selected="selected" value="">Tidak ada Data</option>');
			}
		});
	}

	function fungsi_add_ferry(x, y) {

		var jml = document.getElementById("item_fer").options[document.getElementById("item_fer").selectedIndex].value;
		var copy_id = $("input[name=copy_id]").val();
		var master_id = $("input[name=master_id]").val();
		var date_fr = $("input[name=tgl_fr]").val();
		let formData = new FormData();
		for (let i = 1; i <= jml; i++) {
			var hari = $("input[name=fer_hari" + i + "]").val();
			var urutan = $("input[name=fer_urutan" + i + "]").val();
			var f_type = document.getElementById("fer_type" + i).options[document.getElementById("fer_type" + i).selectedIndex].value;
			var f_rute = document.getElementById("fer_rute" + i).options[document.getElementById("fer_rute" + i).selectedIndex].value;
			var f_name = document.getElementById("fer_name" + i).options[document.getElementById("fer_name" + i).selectedIndex].value;

			if ((hari == "") || (urutan == "") || (f_type == "") || (f_rute == "") || (f_name == "")) {
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
		formData.append('id', '8');
		formData.append('jml', jml);
		formData.append('copy_id', copy_id);
		formData.append('master_id', master_id);
		formData.append('date_fr', date_fr);
		formData.append('grub_id', x);
		formData.append('sfee_id', y);
		$.ajax({
			type: 'POST',
			url: "insert_add_LTtransport.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
				LT_Get_Flight(0, copy_id, x, y);
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});

	}

	function fungsi_item_tra() {
		var item = document.getElementById("item_tra").options[document.getElementById("item_tra").selectedIndex].value;
		// alert(item);
		$.ajax({
			url: "LT_addtrain_field.php",
			method: "POST",
			asynch: false,
			data: {
				loop: item,
			},
			success: function(data) {
				$('#dynamic_train').html(data);
			}
		})

	}

	function add_train(x, y) {
		var jml = document.getElementById("item_tra").options[document.getElementById("item_tra").selectedIndex].value;
		var copy_id = $("input[name=copy_id]").val();
		var master_id = $("input[name=master_id]").val();
		let formData = new FormData();
		for (let i = 1; i <= jml; i++) {
			var t_tgl = $("input[name=t_tgl" + i + "]").val();
			var hari = $("input[name=t_hari" + i + "]").val();
			var urutan = $("input[name=t_urutan" + i + "]").val();
			var t_name = $("input[name=t_name" + i + "]").val();
			var t_adult = $("input[name=t_adt" + i + "]").val();
			var t_child = $("input[name=t_chd" + i + "]").val();
			var t_infant = $("input[name=t_inf" + i + "]").val();

			formData.append('t_name[]', t_name);
			formData.append('t_tgl[]', t_tgl);
			formData.append('hari[]', hari);
			formData.append('urutan[]', urutan);
			formData.append('t_adult[]', t_adult);
			formData.append('t_child[]', t_child);
			formData.append('t_infant[]', t_infant);

		}
		formData.append('id', '9');
		formData.append('jml', jml);
		formData.append('copy_id', copy_id);
		formData.append('master_id', master_id);
		formData.append('grub_id', x);
		formData.append('sfee_id', y);
		$.ajax({
			type: 'POST',
			url: "insert_add_LTtransport.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
				// LT_itinerary(4, copy_id, 0);
				// LT_itinerary(25, copy_id, 0);
				LT_Get_Flight(0, copy_id, x, y);
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});
	}
</script>