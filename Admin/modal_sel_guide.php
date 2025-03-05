<?php
include "../site.php";
include "../db=connection.php";
if ($_POST['id'] != "") {
	for ($i = 1; $i <= $_POST['id']; $i++) {
?>
		<div class="row">
			<div class="col">
				<div class="form-group">
					<input class="form-control form-control-sm" list="sel_list<?php echo $i ?>" name="sel<?php echo $i ?>" id="sel<?php echo $i ?>" autocomplete="off" placeholder="Negara" onchange="show_sel(this.value,<?php echo $i ?>);">
					<datalist id="sel_list<?php echo $i ?>">
						<?php
						$query_guide = "SELECT DISTINCT negara FROM Guide_Meal Order by negara ASC";
						$rs_guide = mysqli_query($con, $query_guide);
						while ($row_guide = mysqli_fetch_array($rs_guide)) {
						?>
							<option value="<?php echo $row_guide['negara'] ?>"></option>
						<?php
						}
						?>
					</datalist>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<select class="form-control form-control-sm" name="fee<?php echo $i ?>" id="fee<?php echo $i ?>">
						<option value="">Pilih Fee</option>
					</select>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<select class="form-control form-control-sm" name="sfee<?php echo $i ?>" id="sfee<?php echo $i ?>">
						<option value="">Pilih S Fee</option>
					</select>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<select class="form-control form-control-sm" name="bf<?php echo $i ?>" id="bf<?php echo $i ?>">
						<option value="">Pilih Breakfast</option>
					</select>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
				<select class="form-control form-control-sm" name="ln<?php echo $i ?>" id="ln<?php echo $i ?>">
						<option value="">Pilih Lunch</option>
					</select>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
				<select class="form-control form-control-sm" name="dn<?php echo $i ?>" id="dn<?php echo $i ?>">
						<option value="">Pilih Dinner</option>
					</select>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
				<select class="form-control form-control-sm" name="vt<?php echo $i ?>" id="vt<?php echo $i ?>">
						<option value="">Pilih VT</option>
					</select>
				</div>
			</div>
		</div>

<?php
	}
}

?>
<script>
	function show_sel(x,y) {
		show_fee(x,y);
		show_sfee(x,y);
		show_bf(x,y);
		show_ln(x,y);
		show_dn(x,y);
		show_vt(x,y);
	}

	function show_fee(x,y) {
		$("#fee"+y).empty();
		$.post('get_fee_sel.php', {
			'negara': x,
			'tipe': '1'
		}, function(data) {
			var jsonData = JSON.parse(data);
			// console.log(jsonData);
			if (jsonData != '') {
				$('#fee'+y).append('<option value="">Pilih FEE</option>');
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					// console.log(counter.id);
					if (counter.id != "") {
						$('#fee'+y).append('<option value="' + counter.id + '">' + counter.nama +" "+counter.kurs+" "+counter.harga+" "+ '</option>');
					}
				}
			} else {
				$("#fee"+y).empty().append('<option selected="selected" value="">Tidak ada data tersedia</option>');
			}
		});
	}

	function show_sfee(x,y) {
		$("#sfee"+y).empty();
		$.post('get_fee_sel.php', {
			'negara': x,
			'tipe': '2'
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				$('#sfee'+y).append('<option value="">Pilih S FEE</option>');
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					// console.log(counter.id);
					if (counter.id != "") {
						$('#sfee'+y).append('<option value="' + counter.id + '">' + counter.kurs + " " + counter.harga + '</option>');
					}
				}
			} else {
				$("#sfee"+y).empty().append('<option selected="selected" value="">Tidak ada data tersedia</option>');
			}
		});
	}

	function show_bf(x,y) {
		$("#bf"+y).empty();
		$.post('get_fee_sel.php', {
			'negara': x,
			'tipe': '3'
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				$('#bf'+y).append('<option value="">Pilih Breakfast</option>');
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					// console.log(counter.id);
					if (counter.id != "") {
						$('#bf'+y).append('<option value="' + counter.id + '">' + counter.kurs + " " + counter.harga + '</option>');
					}
				}
			} else {
				$("#bf"+y).empty().append('<option selected="selected" value="">Tidak ada data tersedia</option>');
			}
		});
	}
	function show_ln(x,y) {
		$("#ln"+y).empty();
		$.post('get_fee_sel.php', {
			'negara': x,
			'tipe': '4'
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				$('#ln'+y).append('<option value="">Pilih Lunch</option>');
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					// console.log(counter.id);
					if (counter.id != "") {
						$('#ln'+y).append('<option value="' + counter.id + '">' + counter.kurs + " " + counter.harga + '</option>');
					}
				}
			} else {
				$("#ln"+y).empty().append('<option selected="selected" value="">Tidak ada data tersedia</option>');
			}
		});
	}
	function show_dn(x,y) {
		$("#dn"+y).empty();
		$.post('get_fee_sel.php', {
			'negara': x,
			'tipe': '5'
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				$('#dn'+y).append('<option value="">Pilih Dinner</option>');
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					// console.log(counter.id);
					if (counter.id != "") {
						$('#dn'+y).append('<option value="' + counter.id + '">' + counter.kurs + " " + counter.harga + '</option>');
					}
				}
			} else {
				$("#dn"+y).empty().append('<option selected="selected" value="">Tidak ada data tersedia</option>');
			}
		});
	}
	function show_vt(x,y) {
		$("#vt"+y).empty();
		$.post('get_fee_sel.php', {
			'negara': x,
			'tipe': '6'
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				$('#vt'+y).append('<option value="">Pilih VT</option>');
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					// console.log(counter.id);
					if (counter.id != "") {
						$('#vt'+y).append('<option value="' + counter.id + '">' + counter.kurs + " " + counter.harga + '</option>');
					}
				}
			} else {
				$("#vt"+y).empty().append('<option selected="selected" value="">Tidak ada data tersedia</option>');
			}
		});
	}
</script>