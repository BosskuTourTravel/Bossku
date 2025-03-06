<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
$data =  explode(",", $_POST['id']);
?>
<div class="content-wrapper" style="width: 250%;">
	<div class='row'>
		<div class='col-12'>
			<div class="card">
				<div class="card-header">
					<div class="card-title">FROM COPY FLIGHT</div>
					<div class="card-tools"></div>
				</div>
				<div class="card-body">
					<!-- <div class="container" style="padding: 10px; margin: 5px;"> -->
					<form>
						<div id="dynamic_field">
							<?php
							$u = 1;
							foreach ($data as $value) {
								$query = "SELECT * FROM  flight_LTnew where id='" . $value . "'";
								$rs = mysqli_query($con, $query);
								$row = mysqli_fetch_array($rs);
							?>
								<input type="hidden" name="tour_id[]" id="tour_id" value="<?php echo $row['id'] ?>">
								<div class="row">
									<div class="col" style="max-width: 150px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Type</label>
											<?php
											} ?>
											<select class="form-control form-control-sm" id="tipe" name="tipe[]">
												<option value="<?php echo $row['type'] ?>" selected><?php echo $row['type'] ?></option>
												<option value="ONE WAY">One Way</option>
												<option value="RETURN">Return</option>
												<option value="MULTI">Multi</option>
											</select>
										</div>
									</div>
									<div class="col" style="max-width: 250px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Code Tour</label>
											<?php
											} ?>
											<input class="form-control form-control-sm" list="tour_list" id="tour" name="tour[]" placeholder="Landtour Name" value="<?php echo  $row['tour_code'] ?>">
											<datalist id="tour_list">
												<?php
												$query_LTNx = "SELECT DISTINCT judul,kode FROM LT_itinnew  Order by id ASC";
												$rs_LTNx = mysqli_query($con, $query_LTNx);
												while ($row_ltn = mysqli_fetch_array($rs_LTNx)) {
													$kode = $row_ltn['kode'];
												?>
													<option data-customvalue="<?php echo $row_ltn['kode'] ?>" value="<?php echo $row_ltn['kode'] ?>"></option>
												<?php
												}
												?>
											</datalist>
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Rute</label>
											<?php
											} ?>
											<!-- <input type="text" class="form-control form-control-sm" id="rute" name="rute[]" value="<?php echo $row['rute'] ?>"> -->
											<select class="form-control form-control-sm" id="rute" name="rute[]">
												<option value="" selected>Pilih Rute</option>
												<option value="">Pilih Rute</option>
												<?php
												$query_type = "SELECT * FROM LT_Flight_Tag order by id ASC";
												$rs_type = mysqli_query($con, $query_type);
												while ($row_type = mysqli_fetch_array($rs_type)) {
												?>
													<option value="<?php echo $row_type['tag'] ?>"><?php echo $row_type['ket'] ?></option>
												<?php
												}
												?>
											</select>
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Type</label>
											<?php
											} ?>
											<select class="form-control form-control-sm" id="int" name="int[]">
												<option value="<?php echo $row['inter'] ?>" selected><?php echo $row['inter'] ?></option>
												<option value="INT">International</option>
												<option value="DOM">Domestic</option>
											</select>
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Maskapai</label>
											<?php
											} ?>
											<input type="text" class="form-control form-control-sm" id="maskapai" name="maskapai[]" value="<?php echo $row['maskapai'] ?>">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Depature</label>
											<?php
											} ?>
											<input type="text" class="form-control form-control-sm" list="dept_list<?php echo $u ?>" id="dept<?php echo $u ?>" name="dept[]" value="<?php echo $row['dept'] ?>" onkeyup="getFromX(this.value,<?php echo $u ?>)">
											<datalist id="dept_list<?php echo $u ?>"></datalist>
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Arrival</label>
											<?php
											} ?>
											<!-- <input type="text" class="form-control form-control-sm" id="arr" name="arr[]" value="<?php echo $row['arr'] ?>"> -->
											<input type="text" class="form-control form-control-sm" list="arr_list<?php echo $u ?>" id="arr" name="arr[]" value="<?php echo $row['arr'] ?>" onkeyup="getArr(this.value,<?php echo $u ?>)">
											<datalist id="arr_list<?php echo $u ?>"></datalist>
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Date</label>
											<?php
											} ?>
											<input type="date" class="form-control form-control-sm" id="tgl" name="tgl[]" value="<?php echo $row['tgl'] ?>">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Take Off</label>
											<?php
											} ?>
											<input type="time" class="form-control form-control-sm" id="take" name="take[]" value="<?php echo $row['take'] ?>">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Landing</label>
											<?php
											} ?>
											<input type="time" class="form-control form-control-sm" id="landing" name="landing[]" value="<?php echo $row['landing'] ?>">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Adult</label>
											<?php
											} ?>
											<input type="number" class="form-control form-control-sm" id="adt" name="adt[]" value="<?php echo $row['adt'] ?>">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Child</label>
											<?php
											} ?>
											<input type="number" class="form-control form-control-sm" id="chd" name="chd[]" value="<?php echo $row['chd'] ?>">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Infant</label>
											<?php
											} ?>
											<input type="number" class="form-control form-control-sm" id="inf" name="inf[]" value="<?php echo $row['inf'] ?>">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Baggage(kg)</label>
											<?php
											} ?>
											<input type="number" class="form-control form-control-sm" id="bagasi" name="bagasi[]">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Baggage Price</label>
											<?php
											} ?>
											<input type="number" class="form-control form-control-sm" id="bg_price" name="bg_price[]">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Seat Price</label>
											<?php
											} ?>
											<input type="number" class="form-control form-control-sm" id="st_price" name="st_price[]">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">B(on board)</label>
											<?php
											} ?>
											<input type="number" class="form-control form-control-sm" id="bf" name="bf[]">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">L(on board)</label>
											<?php
											} ?>
											<input type="number" class="form-control form-control-sm" id="ln" name="ln[]">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">D(on board)</label>
											<?php
											} ?>
											<input type="number" class="form-control form-control-sm" id="dn" name="dn[]">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<?php if ($u == 1) {
										?>
											<label for="tipe">Tax</label>
										<?php
										} ?>
										<div class="form-group">
											<input type="number" class="form-control form-control-sm" id="tax" name="tax[]">
										</div>
									</div>
								</div>
							<?php
								$u++;
							}
							?>
						</div>

					</form>
					<!-- </div> -->
				</div>
				<div class="card-footer">
					<button type="button" class="btn btn-warning btn-sm" onclick="copy_flight()">SET AS COPY</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			$('#excel_tempat').change(function() {
				$('#import_tempat').submit();
			});
			$('#import_tempat').on('submit', function(event) {
				event.preventDefault();
				$.ajax({
					url: "edit_tempat.php",
					method: "POST",
					data: new FormData(this),
					contentType: false,
					processData: false,
					success: function(data) {
						$('#result_tempat').html(data);
						$('#excel_tempat').val('');
					}
				});
			});
		});
	</script>
	<script>
		var i = 1;

		function add_row(x) {
			i++;
			$.ajax({
				url: "LT_flight_field.php",
				method: "POST",
				asynch: false,
				data: {
					x: x,
					i: i
				},
				success: function(data) {
					$('#dynamic_field').append(data);
				}
			});
		}

		function remove(y) {
			var button_id = y;
			$('#row' + button_id).remove();
		}
	</script>
	<script>
		function copy_flight() {
			let formData = new FormData();
			var tipe = $('select[name="tipe[]"] option:selected').map(function() {
				return this.value; // $(this).val()
			}).get();
			var rute = $('select[name="rute[]"] option:selected').map(function() {
				return this.value; // $(this).val()
			}).get();

			var values = $("input[name='tour[]']").map(function() {
				return this.value;
			}).get();
			var maskapai = $('input[name="maskapai[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();

			var int = $('select[name="int[]"] option:selected').map(function() {
				return this.value; // $(this).val()
			}).get();

			var dept = $('input[name="dept[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var arr = $('input[name="arr[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var tgl = $('input[name="tgl[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var take = $('input[name="take[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var landing = $('input[name="landing[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var adt = $('input[name="adt[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var chd = $('input[name="chd[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var inf = $('input[name="inf[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var bagasi = $('input[name="bagasi[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var bg_price = $('input[name="bg_price[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var st_price = $('input[name="st_price[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var bf = $('input[name="bf[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var ln = $('input[name="ln[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var dn = $('input[name="dn[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var tax = $('input[name="tax[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();


			formData.append("rute", rute);
			formData.append("tour", values);
			formData.append("tipe", tipe);
			formData.append("maskapai", maskapai);
			formData.append("int", int);
			formData.append("dept", dept);
			formData.append("arr", arr);
			formData.append("tgl", tgl);
			formData.append("take", take);
			formData.append("landing", landing);
			formData.append("adt", adt);
			formData.append("chd", chd);
			formData.append("inf", inf);
			formData.append("bagasi", bagasi);
			formData.append("bg_price", bg_price);
			formData.append("st_price", st_price);
			formData.append("bf", bf);
			formData.append("ln", ln);
			formData.append("dn", dn);
			formData.append("tax", tax);
			$.ajax({
				type: 'POST',
				url: "insert_flight_LTnew.php",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function(msg) {
					alert(msg);
					LT_Package(4, 0, 0);
				},
				error: function() {
					alert("Data Gagal Diupload");
				}
			});
		}
	</script>
	<script>
		function getFromX(x, y) {
			$("#dept_list" + y).empty();
			$.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/' + x + '?isDestination=true&enable_general_search_v2=true', function(data) {
				var i = 0;
				for (i = 0; i < data.length; i++) {
					if (data[i].PlaceId !== "undefined") {
						var detail = data[i].PlaceName + " ( " + data[i].CountryName + " ) ";
						var id = data[i].PlaceId;
						var option = "<option value='" + id + "'>" + detail + "</option>";
						$("#dept_list" + y).append(option);
					}

				}

			});
		}

		function getArr(x, y) {
			$("#arr_list" + y).empty();
			$.getJSON('https://www.skyscanner.net/g/autosuggest-flights/UK/en-GB/' + x + '?isDestination=true&enable_general_search_v2=true', function(data) {
				var i = 0;
				for (i = 0; i < data.length; i++) {
					if (data[i].PlaceId !== "undefined") {
						var detail = data[i].PlaceName + " ( " + data[i].CountryName + " ) ";
						var id = data[i].PlaceId;
						var option = "<option value='" + id + "'>" + detail + "</option>";
						$("#arr_list" + y).append(option);
					}

				}

			});
		}
	</script>