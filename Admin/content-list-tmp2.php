<?php
include "../db=connection.php";
?>
<script>
	$(document).ready(function() {
		$('.summernote').summernote();
	});
</script>
<?php
if ($_POST['id'] != "") {

	for ($i = 1; $i <= $_POST['id']; $i++) {
?>
		<div style="padding: 10px; border: 2px solid; border-radius: 25px; margin:5px">
			<div class="row" style="text-align: left;">
				<div class="col" style="max-width: 170px;">
					<label style="font-size: 9pt;">Continent</label>
					<input type="text" class="form-control form-control-sm"  id="con<?php echo $i ?>" name="con<?php echo $i ?>" disabled>
				</div>
				<div class="col" style="max-width: 170px;">
					<label style="font-size: 9pt;">Country</label>
					<input type="text" class="form-control form-control-sm" id="cou<?php echo $i ?>" name="cou<?php echo $i ?>" disabled>
				</div>
				<div class="col" style="max-width: 170px;">
					<label style="font-size: 9pt;">City</label>
					<input type="text" class="form-control form-control-sm" list="cit_list<?php echo $i ?>" id="cit<?php echo $i ?>" name="cit<?php echo $i ?>" autocomplete="off" onchange="set_val(this.value,<?php echo $i ?>)">
					<datalist id="cit_list<?php echo $i ?>">
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
					<input type="text" class="form-control form-control-sm" id="pn<?php echo $i ?>">
				</div>
				<div class="col">
					<label style="font-size: 9pt;">Place Name Detail</label>
					<input type="text" class="form-control form-control-sm" id="pnd<?php echo $i ?>">
				</div>
			</div>
			<div class="row" style="text-align: left;">
				<div class="col" style="max-width: 100px;">
					<label style="font-size: 9pt;">KURS</label>
					<select class="form-control form-control-sm" id="kurs<?php echo $i ?>">
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
					<input type="text" class="form-control form-control-sm" id="adt<?php echo $i ?>">
				</div>
				<div class="col" style="max-width: 100px;">
					<label style="font-size: 9pt;">CHD</label>
					<input type="text" class="form-control form-control-sm" id="chd<?php echo $i ?>">
				</div>
				<div class="col" style="max-width: 100px;">
					<label style="font-size: 9pt;">INF</label>
					<input type="text" class="form-control form-control-sm" id="inf<?php echo $i ?>">
				</div>
				<div class="col">
					<label style="font-size: 9pt;">ket</label>
					<!-- <textarea class="summernote" id="ket<?php echo $i ?>"></textarea> -->
					<input type="text" class="form-control form-control-sm" id="ket<?php echo $i ?>">
				</div>
			</div>
		</div>
<?php
	}
} else {
	echo "Silakan Pilih Jumlah data !!";
}
?>
<script>
	function set_val(x, y) {
		$.post('get-con-city.php', {
			'key': x,
		}, function(data) {
			var jsonData = JSON.parse(data);
			console.log(jsonData);
			if (jsonData != '') {
				var counter = jsonData;
				document.getElementById("con"+y).value = counter.con;
				document.getElementById("cou"+y).value = counter.cou;
			} else {
				
			}
		});
	}
</script>