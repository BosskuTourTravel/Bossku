<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";

?>

<div class="content-wrapper" style="width: 110%;">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					FORM INSERT PROFIT FLIGHT RANGE
				</div>
				<div class="card-body table-responsive">
					<form>
						<div id="dynamic_field">
							<div class="row">
								<div class="col-md">
									<div class="form-group">
										<label>Start From</label>
										<input type="Text" class="form-control form-control-sm" id="mulai" name="mulai[]">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<label>Until </label>
										<input type="Text" class="form-control form-control-sm" id="until" name="until[]">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<label>Profit</label>
										<input type="Text" class="form-control form-control-sm" id="profit" name="profit[]">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<label>Admin </label>
										<input type="Text" class="form-control form-control-sm" id="admin" name="admin[]">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<label>Marketing</label>
										<input type="Text" class="form-control form-control-sm" id="marketing" name="marketing[]">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<label>Sub Agent</label>
										<input type="Text" class="form-control form-control-sm" id="sub_agent" name="sub_agent[]">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<label>Staff</label>
										<input type="Text" class="form-control form-control-sm" id="staff" name="staff[]">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group">
										<label>Nominal</label>
										<input type="Text" class="form-control form-control-sm" id="nominal" name="nominal[]">
									</div>
								</div>
								<div class="col-md">
									<button type="button" name="add" id="add" class="btn btn-primary btn-sm" onclick="add_row()">Add More</button>
								</div>
							</div>
						</div>
						<button type="button" class="btn btn-primary" id='but_upload' onclick="fungsi_add_range()">CREATE</button>
					</form>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
	</div>
	<!-- /.row -->
</div>
<script>
	var i = 1;

	function add_row() {
		i++;
		$.ajax({
			url: "PR_Flight_Range_field.php",
			method: "POST",
			asynch: false,
			data: {
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
	function fungsi_add_range() {
		let formData = new FormData();
		var mulai = $('input[name="mulai[]"]').map(function() {
			return this.value; // $(this).val()
		}).get();
		var until = $('input[name="until[]"]').map(function() {
			return this.value; // $(this).val()
		}).get();
		var profit = $('input[name="profit[]"]').map(function() {
			return this.value; // $(this).val()
		}).get();
		var admin = $('input[name="admin[]"]').map(function() {
			return this.value; // $(this).val()
		}).get();
		var marketing = $('input[name="marketing[]"]').map(function() {
			return this.value; // $(this).val()
		}).get();
		var sub_agent = $('input[name="sub_agent[]"]').map(function() {
			return this.value; // $(this).val()
		}).get();
		var staff = $('input[name="staff[]"]').map(function() {
			return this.value; // $(this).val()
		}).get();
		var nominal = $('input[name="nominal[]"]').map(function() {
			return this.value; // $(this).val()
		}).get();


		formData.append("mulai", mulai);
		formData.append("until", until);
		formData.append("profit", profit);
		formData.append("admin", admin);
		formData.append("marketing", marketing);
		formData.append("sub_agent", sub_agent);
		formData.append("staff", staff);
		formData.append("nominal", nominal);
		$.ajax({
			type: 'POST',
			url: "PR_insert_flight_range.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});
	}
</script>