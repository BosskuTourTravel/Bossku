<?php
include "../site.php";
include "../db=connection.php";

?>
<div>
	<div class="form-group">
		<label>Hari</label>
		<input type="number" class="form-control form-control-sm" name="hari" id="hari">
	</div>
	<div class="form-group">
		<label>Negara</label>
		<input class="form-control form-control-sm" list="sel_list" name="sel" id="sel" autocomplete="off" placeholder="Negara" onchange="show_sel(this.value,);">
		<datalist id="sel_list">
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
	<div class="form-group">
		<label>Fee Guide</label>
		<select class="form-control form-control-sm" name="fee" id="fee">
			<option value="">Pilih Fee</option>
		</select>
	</div>
	<div class="form-group">
		<label>Surcharge Fee Guide</label>
		<select class="form-control form-control-sm" name="sfee" id="sfee">
			<option value="">Pilih S Fee</option>
		</select>
	</div>
	<div class="form-group">
		<label>Breakfast</label>
		<select class="form-control form-control-sm" name="bf" id="bf">
			<option value="">Pilih Breakfast</option>
		</select>
	</div>
	<div class="form-group">
		<label>Lunch</label>
		<select class="form-control form-control-sm" name="ln" id="ln">
			<option value="">Pilih Lunch</option>
		</select>
	</div>
	<div class="form-group">
		<label>Dinner</label>
		<select class="form-control form-control-sm" name="dn" id="dn">
			<option value="">Pilih Dinner</option>
		</select>
	</div>
	<div class="form-group">
		<label>Voucher Telepon</label>
		<select class="form-control form-control-sm" name="vt" id="vt">
			<option value="">Pilih VT</option>
		</select>
	</div>
	<div>
		<button type="button" class="btn btn-success" onclick="add_fee(<?php echo $_POST['id'] ?>,<?php echo $_POST['tourid'] ?>)">SUBMIT</button>
	</div>
</div>
<!-- <div class="modal_sel_guide">
</div> -->
<script>
	function add_fee(x,y) {
		var hari = document.getElementById("hari").value;
		if (hari === "") {
			alert("kolom hari harus di isi !!");
		} else {
			var sel = document.getElementById("sel").value;
			var fee = document.getElementById("fee").value;
			var sfee = document.getElementById("sfee").value;
			var bf = document.getElementById("bf").value;
			var ln = document.getElementById("ln").value;
			var dn = document.getElementById("dn").value;
			var vt = document.getElementById("vt").value;

			$.ajax({
				url: "insert_guide_rent.php",
				method: "POST",
				asynch: false,
				data: {
					id:x,
					tourid:y,
					hari: hari,
					sel:sel,
					fee:fee,
					sfee:sfee,
					bf:bf,
					ln:ln,
					dn:dn,
					vt:vt
				},
				success: function(data) {
					alert(data);
				}
			});
		}
	}

	function show_sel(x) {
		show_fee(x);
		show_sfee(x);
		show_bf(x);
		show_ln(x);
		show_dn(x);
		show_vt(x);
	}

	function show_fee(x) {
		$("#fee").empty();
		$.post('get_fee_sel.php', {
			'negara': x,
			'tipe': '1'
		}, function(data) {
			var jsonData = JSON.parse(data);
			// console.log(jsonData);
			if (jsonData != '') {
				$('#fee').append('<option value="">Pilih FEE</option>');
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					// console.log(counter.id);
					if (counter.id != "") {
						$('#fee').append('<option value="' + counter.id + '">' + counter.nama + " " + counter.kurs + " " + counter.harga + " " + '</option>');
					}
				}
			} else {
				$("#fee").empty().append('<option selected="selected" value="">Tidak ada data tersedia</option>');
			}
		});
	}

	function show_sfee(x) {
		$("#sfee").empty();
		$.post('get_fee_sel.php', {
			'negara': x,
			'tipe': '2'
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				$('#sfee').append('<option value="">Pilih S FEE</option>');
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					// console.log(counter.id);
					if (counter.id != "") {
						$('#sfee').append('<option value="' + counter.id + '">' + counter.kurs + " " + counter.harga + '</option>');
					}
				}
			} else {
				$("#sfee").empty().append('<option selected="selected" value="">Tidak ada data tersedia</option>');
			}
		});
	}

	function show_bf(x) {
		$("#bf").empty();
		$.post('get_fee_sel.php', {
			'negara': x,
			'tipe': '3'
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				$('#bf').append('<option value="">Pilih Breakfast</option>');
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					// console.log(counter.id);
					if (counter.id != "") {
						$('#bf').append('<option value="' + counter.id + '">' + counter.kurs + " " + counter.harga + '</option>');
					}
				}
			} else {
				$("#bf").empty().append('<option selected="selected" value="">Tidak ada data tersedia</option>');
			}
		});
	}

	function show_ln(x) {
		$("#ln").empty();
		$.post('get_fee_sel.php', {
			'negara': x,
			'tipe': '4'
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				$('#ln').append('<option value="">Pilih Lunch</option>');
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					// console.log(counter.id);
					if (counter.id != "") {
						$('#ln').append('<option value="' + counter.id + '">' + counter.kurs + " " + counter.harga + '</option>');
					}
				}
			} else {
				$("#ln").empty().append('<option selected="selected" value="">Tidak ada data tersedia</option>');
			}
		});
	}

	function show_dn(x) {
		$("#dn").empty();
		$.post('get_fee_sel.php', {
			'negara': x,
			'tipe': '5'
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				$('#dn').append('<option value="">Pilih Dinner</option>');
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					// console.log(counter.id);
					if (counter.id != "") {
						$('#dn').append('<option value="' + counter.id + '">' + counter.kurs + " " + counter.harga + '</option>');
					}
				}
			} else {
				$("#dn").empty().append('<option selected="selected" value="">Tidak ada data tersedia</option>');
			}
		});
	}

	function show_vt(x) {
		$("#vt").empty();
		$.post('get_fee_sel.php', {
			'negara': x,
			'tipe': '6'
		}, function(data) {
			var jsonData = JSON.parse(data);
			if (jsonData != '') {
				$('#vt').append('<option value="">Pilih VT</option>');
				for (var i = 0; i < jsonData.length; i++) {
					var counter = jsonData[i];
					// console.log(counter.id);
					if (counter.id != "") {
						$('#vt').append('<option value="' + counter.id + '">' + counter.kurs + " " + counter.harga + '</option>');
					}
				}
			} else {
				$("#vt").empty().append('<option selected="selected" value="">Tidak ada data tersedia</option>');
			}
		});
	}
</script>