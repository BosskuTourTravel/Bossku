<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
$query = "SELECT * FROM  List_tempat where id=" . $_POST['id'];
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);
?>
<div class="content-wrapper" style="padding: 5px;">
	<div class="card text-center">
		<div class="card-header" style="background-color: darkslategray; color:white">
			<div class="row">
				<div class="col-6" style="text-align: left;">FORM UPDATE LIST TEMPAT</div>
				<div class="col-6">
					<div style="text-align: right;">
						<button type="button" class="btn btn-warning btn-sm" onclick="LT_Package(0,0,0)"><i class="fa fa-arrow-left"></i></button>
						<button type="button" class="btn btn-primary btn-sm" onclick="LT_Package(21,<?php echo $_POST['id'] ?>,0)"><i class="fa fa-sync"></i></button>
					</div>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div>
				<div style="padding: 10px; border: 2px solid; border-radius: 25px; margin:5px">
					<div class="row" style="text-align: left;">
						<div class="col" style="max-width: 170px;">
							<label style="font-size: 9pt;">Continent</label>
							<input type="text" class="form-control form-control-sm" list="con_list" id="con" name="con" autocomplete="off" value="<?php echo $row['continent'] ?>">
							<datalist id="con_list">
								<?php
								$query_con = "SELECT name FROM continent Order by name ASC";
								$rs_con = mysqli_query($con, $query_con);
								while ($row_con = mysqli_fetch_array($rs_con)) {
								?>
									<option value="<?php echo $row_con['name'] ?>"></option>
								<?php
								}
								?>
							</datalist>
						</div>
						<div class="col" style="max-width: 170px;">
							<label style="font-size: 9pt;">Country</label>
							<input type="text" class="form-control form-control-sm" list="cou_list" id="cou" name="cou" autocomplete="off" value="<?php echo $row['negara'] ?>">
							<datalist id="cou_list">
								<?php
								$query_cou = "SELECT name FROM country Order by name ASC";
								$rs_cou = mysqli_query($con, $query_cou);
								while ($row_cou = mysqli_fetch_array($rs_cou)) {
								?>
									<option value="<?php echo $row_cou['name'] ?>"></option>
								<?php
								}
								?>
							</datalist>
						</div>
						<div class="col" style="max-width: 170px;">
							<label style="font-size: 9pt;">City</label>
							<input type="text" class="form-control form-control-sm" list="cit_list" id="cit" name="cit" autocomplete="off" value="<?php echo $row['city'] ?>">
							<datalist id="cit_list">
								<?php
								$query_cit = "SELECT name FROM city Order by name ASC";
								$rs_cit = mysqli_query($con, $query_cit);
								while ($row_cit = mysqli_fetch_array($rs_cit)) {
								?>
									<option value="<?php echo $row_cit['name'] ?>"></option>
								<?php
								}
								?>
							</datalist>
						</div>
						<div class="col">
							<label style="font-size: 9pt;">Place Name</label>
							<input type="text" class="form-control form-control-sm" id="pn" value="<?php echo $row['tempat'] ?>">
						</div>
						<div class="col">
							<label style="font-size: 9pt;">Place Name Detail</label>
							<input type="text" class="form-control form-control-sm" id="pnd" value="<?php echo $row['tempat2'] ?>">
						</div>
					</div>
					<div class="row" style="text-align: left;">
						<div class="col" style="max-width: 100px;">
							<label style="font-size: 9pt;">KURS</label>
							<select class="form-control form-control-sm" id="kurs" value="<?php echo $row['kurs'] ?>">
								<option value="">Kurs </option>
								<!-- kurs_bca_field -->
								<?php
								$query_kurs = "SELECT nama FROM kurs_bca_field Order by nama ASC";
								$rs_kurs = mysqli_query($con, $query_kurs);
								while ($row_kurs = mysqli_fetch_array($rs_kurs)) {
								?>
									<option value="<?php echo $row_kurs['nama'] ?>"><?php echo $row_kurs['nama'] ?></option>
								<?php
								}
								?>
							</select>
						</div>
						<div class="col" style="max-width: 100px;">
							<label style="font-size: 9pt;">ADT</label>
							<input type="text" class="form-control form-control-sm" id="adt" value="<?php echo $row['price'] ?>">
						</div>
						<div class="col" style="max-width: 100px;">
							<label style="font-size: 9pt;">CHD</label>
							<input type="text" class="form-control form-control-sm" id="chd" value="<?php echo $row['chd'] ?>">
						</div>
						<div class="col" style="max-width: 100px;">
							<label style="font-size: 9pt;">INF</label>
							<input type="text" class="form-control form-control-sm" id="inf" value="<?php echo $row['infant'] ?>">
						</div>
						<div class="col">
							<label style="font-size: 9pt;">ket</label>
							<?php
							$text = htmlentities(substr($row['keterangan'], 0, 1));
							// var_dump($text);
							if ($text == htmlentities("<")) {
							?>
								<textarea class="summernote" id="ket"><?php echo $row['keterangan'] ?></textarea>
							<?php
							} else {
							?>
								<input type="text" class="form-control form-control-sm" id="ket" value="<?php echo $row['keterangan'] ?>">
							<?php
							}
							?>


						</div>
					</div>
					<div class="row" style="padding-top: 10px;">
						<div class="col-md-6" style="max-width: 300px; text-align: left;">
							<div class="form-group">
								<select class="form-control form-control-sm" id="pro" onchange="add_pro(this.value,<?php echo $_POST['id'] ?>)">
									<option value="">Ganti Properti Keterangan</option>
									<option value="0">Text Area to input</option>
									<option value="1">Input to Text Area</option>
								</select>
							</div>
						</div>
					</div>
					<div class="content-addPro"></div>
				</div>
			</div>
		</div>
		<div class="card-footer text-muted">
			<button type="button" class="btn btn-success btn-sm" onclick="update_tmp(<?php echo $_POST['id'] ?>)">UPDATE LIST TEMPAT</button>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('.summernote').summernote();
	});
</script>
<script>
	function update_tmp(x) {
		let formData = new FormData();
		var con = document.getElementById("con").value;
		var cou = document.getElementById("cou").value;
		var cit = document.getElementById("cit").value;
		var pn = document.getElementById("pn").value;
		var pnd = document.getElementById("pnd").value;
		var kurs = document.getElementById("kurs").value;
		var adt = document.getElementById("adt").value;
		var chd = document.getElementById("chd").value;
		var inf = document.getElementById("inf").value;
		var ket = document.getElementById("ket").value;
		formData.append('id', x);
		formData.append('con', con);
		formData.append('cou', cou);
		formData.append('cit', cit);
		formData.append('pn', pn);
		formData.append('pnd', pnd);
		formData.append('kurs', kurs);
		formData.append('adt', adt);
		formData.append('chd', chd);
		formData.append('inf', inf);
		formData.append('ket', ket);
		// console.log(formData);
		$.ajax({
			type: 'POST',
			url: "update_list_tmp.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
				LT_Package(0, 0, 0);
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});
	}

	function add_pro(x, y) {
		if (x == '0') {
			$.ajax({
				url: "content-addPro.php",
				method: "POST",
				asynch: false,
				data: {
					id: y,
				},
				success: function(data) {
					$('.content-addPro').html(data);
				}
			});
		} else if(x=='1') {
			$.ajax({
				url: "content-addPro2.php",
				method: "POST",
				asynch: false,
				data: {
					id: y,
				},
				success: function(data) {
					$('.content-addPro').html(data);
				}
			});

		}else{
			$('.content-addPro').html("");
		}
	}
</script>