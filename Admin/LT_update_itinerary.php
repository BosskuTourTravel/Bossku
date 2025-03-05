<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";

$query_data = "SELECT * FROM LT_itinerary2 WHERE id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);
$lt = "";
if ($row_data['landtour'] != "undefined") {
	$lt = $row_data['landtour'];
}

$query_LTNx = "SELECT DISTINCT judul,kode FROM LT_itinnew  Order by id ASC";
$rs_LTNx = mysqli_query($con, $query_LTNx);

?>
<div class='content-wrapper'>
	<div class='row'>
		<div class='col-12'>
			<div class='card'>
			<div class="card-header">
                    <h3 class="card-title" style="font-weight:bold;">FORM UPDATE LANDTOUR</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <div class="input-group-append" style="text-align: right;">
                                <a class="btn btn-warning btn-sm tip" onclick="LT_itinerary(27,<?php echo $_POST['id'] ?>,0)" title="Back"><i class="fas fa-arrow-left"></i></a>
                                <a class="btn btn-primary btn-sm tip" onclick="LT_itinerary(5,<?php echo $_POST['id'] ?>,0)" title="Refresh"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
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
								<input class="form-control form-control-sm" type="text" name="j_tour" id="j_tour" value="<?php echo $row_data['judul'] ?>">
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<label style="font-size: 12px;">Landtour Name</label>
										<input class="form-control form-control-sm" list="ltn_list" name="LT_name" id="LT_name" value="<?php echo $row_data['landtour'] ?>">
										<datalist id="ltn_list">
										<option data-customvalue="<?php echo $row_data['landtour'] ?>" value="<?php echo $row_data['landtour'] ?>" selected></option>
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
							<!-- <div class="form-group">
								<label style="font-size: 11px;">JUMLAH HARI</label>
								<input class="form-control form-control-sm" type="text" name="hari" id="hari" placeholder="Masukkan Jumlah Hari">
							</div> -->
							<div class="form-group">
								<label style="font-size: 12px;">Gambar 1</label>
								<input type="file" id="files1" name="files1"  accept="image/*" />
							</div>
							<div class="form-group">
								<label style="font-size: 12px;">Gambar 2</label>
								<input type="file" id="files2" name="files2" accept="image/*" />
							</div>
							<div class="form-group">
								<label style="font-size: 12px;">Gambar 3</label>
								<input type="file" id="files3" name="files3"  accept="image/*" />
							</div>
							<div class="form-group">
								<label style="font-size: 12px;">Gambar 4</label>
								<input type="file" id="files4" name="files4" accept="image/*" />
							</div>
							<input type="hidden" id="lt_id" name="lt_id" value="<?php echo  $_POST['id']?>">
							<button type="button" class="btn btn-primary" id='but_upload' onclick="update_itin(<?php echo  $_POST['id']?>)">CREATE</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function update_itin(x) {
		let formData = new FormData();

		var judul = $("input[name=j_tour]").val();
		var id = $("input[name=lt_id]").val();
		var gb = $("#LT_name").val();
		var lt_name = $('#ltn_list [value="' + gb + '"]').data('customvalue');

		var fileSelect1 = document.getElementById('files1');

		formData.append("gambar1", document.getElementById('files1').files[0]);
		formData.append("gambar2", document.getElementById('files2').files[0]);
		formData.append("gambar3", document.getElementById('files3').files[0]);
		formData.append("gambar4", document.getElementById('files4').files[0]);
		formData.append('id', id);
		formData.append('judul', judul);
		formData.append('landtour_name', lt_name);

		// alert(fileSelect1);
		$.ajax({
			type: 'POST',
			url: "update_add_LT.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
				// LT_itinerary(0, 0, 0);
				LT_itinerary(27,x,0);
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});
	}
</script>