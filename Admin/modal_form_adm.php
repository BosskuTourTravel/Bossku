<?php
include "../site.php";
include "../db=connection.php";
$query_cek = "SELECT * FROM tour_adm_chck where tour_id='" . $_POST['id'] . "' && master_id='" . $_POST['master_id'] . "'";
$rs_cek = mysqli_query($con, $query_cek);
$row_cek = mysqli_fetch_array($rs_cek);
$include = explode(",", $row_cek['include']);
$exclude = explode(",", $row_cek['exclude']);

?>
<div>
	<div class="row" style="font-size: 10pt;">
		<div class="col-md-6">
			<div><b>INCLUDE</b></div>
			<div>
				<?php
				$query_master = "SELECT tempat from LT_add_listTmp where tour_id ='" . $_POST['master_id'] . "' order by hari ASC,urutan ASC";
				$rs_master = mysqli_query($con, $query_master);
				while ($row_master = mysqli_fetch_array($rs_master)) {
					$query_tempat = "SELECT id,tempat,price,keterangan FROM List_tempat where id=" . $row_master['tempat'];
					$rs_tempat = mysqli_query($con, $query_tempat);
					$row_tempat = mysqli_fetch_array($rs_tempat);
				?>
					<div class="form-check">
						<?php
						if (in_array($row_tempat['id'], $include)) {
							// var_dump($row_tempat['id']);
						?>
							<input type="checkbox" class="form-check-input" id="tmp" name="tmp" value="<?php echo $row_tempat['id'] ?>" checked>
						<?php
						} else {
						?>
							<input type="checkbox" class="form-check-input" id="tmp" name="tmp" value="<?php echo $row_tempat['id'] ?>">
						<?php
						}
						?>

						<?php
						if ($row_tempat['price'] != 0 or $row_tempat['price'] == "") {
						?>
							<label style="color: green;" class="form-check-label" for="exampleCheck1"><?php echo $row_tempat['tempat'] ?></label>
						<?php

						} else {
						?>
							<label class="form-check-label" for="exampleCheck1"><?php echo $row_tempat['tempat'] ?></label>
						<?php
						} ?>
						<!-- <label class="form-check-label" for="exampleCheck1"><?php echo $row_tempat['tempat'] ?></label> -->
					</div>
				<?php
				}

				?>
			</div>
		</div>
		<div class="col-md-6">
			<div><b>EXCLUDE</b></div>
			<div>
				<?php
				$query_master2 = "SELECT tempat from LT_add_listTmp where tour_id ='" . $_POST['master_id'] . "' order by hari ASC,urutan ASC";
				$rs_master2 = mysqli_query($con, $query_master2);
				while ($row_master2 = mysqli_fetch_array($rs_master2)) {
					$query_tempat2 = "SELECT id,tempat,price,keterangan FROM List_tempat where id=" . $row_master2['tempat'];
					$rs_tempat2 = mysqli_query($con, $query_tempat2);
					$row_tempat2 = mysqli_fetch_array($rs_tempat2);
				?>
					<div class="form-check">
						<?php
						if (in_array($row_tempat2['id'], $exclude)) {
							
						?>
							<input type="checkbox" class="form-check-input" id="tmp_ex" name="tmp_ex[]" value="<?php echo $row_tempat2['id'] ?>" checked>
						<?php
						} else {
						?>
							<input type="checkbox" class="form-check-input" id="tmp_ex" name="tmp_ex[]" value="<?php echo $row_tempat2['id'] ?>">
						<?php
						}
						?>
						<?php if ($row_tempat2['price'] != 0 or $row_tempat2['price'] == "") {
						?>
							<label style="color: green;" class="form-check-label" for="exampleCheck1"><?php echo $row_tempat2['tempat'] ?></label>
						<?php

						} else {
						?>
							<label class="form-check-label" for="exampleCheck1"><?php echo $row_tempat2['tempat'] ?></label>
						<?php
						} ?>

					</div>
				<?php
				}

				?>
			</div>
		</div>
	</div>
	<div style="padding: 20px; text-align: center;"><button type="button" class="btn btn-warning btn-sm" onclick="add_adm(<?php echo $_POST['id'] ?>,<?php echo $_POST['master_id'] ?>)" data-dismiss="modal">Submit</button></div>
</div>

<script>
	function add_adm(x, y) {
		let formData = new FormData();
		var arr_adm_inc = [];
		var arr_adm_ex = [];
		$("input:checkbox[name=tmp]:checked").each(function () {
            // alert("Id: " + $(this).attr("id") + " Value: " + $(this).val());
			$val = $(this).val();
			arr_adm_inc.push($val);
			console.log($val);
        });
		$("[name='tmp_ex[]']:checked").each(function() {
			$val = $(this).val();
			arr_adm_ex.push($val);
		});
		formData.append('adm_inc', arr_adm_inc);
		formData.append('adm_ex', arr_adm_ex);
		formData.append('tour_id', x);
		formData.append('master_id', y);
		// alert(arr_adm_inc);
		
		$.ajax({
			type: 'POST',
			url: "insert_adm.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(data) {
				// $('#show_pricelist').html(data);
				alert(data);
			}
		});
	}
</script>