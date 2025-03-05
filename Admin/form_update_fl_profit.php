<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";
if ($_POST['z'] == '0') {
	$data =  explode(",", $_POST['id']);
} else {
	$query2 = "SELECT id FROM LT_profit_range order by id ASC";
	$rs2 = mysqli_query($con, $query2);
	$data = [];
	while ($row2 = mysqli_fetch_array($rs2)) {
		array_push($data, $row2['id']);
	};
}

?>
<div class="content-wrapper" style="width: 100%;">
	<div class='row'>
		<div class='col-12'>
			<div class="card">
				<div class="card-header">
					<div class="card-title">FROM Update Profit Flight</div>
					<div class="card-tools"></div>
				</div>
				<div class="card-body">
					<!-- <div class="container" style="padding: 10px; margin: 5px;"> -->
					<form>
						<div id="dynamic_field">
							<?php
							$u = 1;
							foreach ($data as $value) {
								$query = "SELECT * FROM LT_profit_range where id='" . $value . "'";
								$rs = mysqli_query($con, $query);
								$row = mysqli_fetch_array($rs);
							?>
								<input type="hidden" name="id[]" id="id" value="<?php echo $row['id'] ?>">
								<div class="row">
									<div class="col" style="max-width: 150px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label>Start From</label>
											<?php
											} ?>
											<input type="text" class="form-control form-control-sm" id="start" name="start[]" value="<?php echo $row['price1'] ?>">
										</div>
									</div>
									<div class="col" style="max-width: 250px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label>Until </label>
											<?php
											} ?>
											<input type="text" class="form-control form-control-sm" id="until" name="until[]" value="<?php echo $row['price2'] ?>">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Profit</label>
											<?php
											} ?>
											<input type="text" class="form-control form-control-sm" id="profit" name="profit[]" value="<?php echo $row['profit'] ?>">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Admin</label>
											<?php
											} ?>
											<input type="text" class="form-control form-control-sm" id="admin" name="admin[]" value="<?php echo $row['adm_mkp'] ?>">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Marketing</label>
											<?php
											} ?>
											<input type="text" class="form-control form-control-sm" id="marketing" name="marketing[]" value="<?php echo $row['marketing'] ?>">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Sub Agent</label>
											<?php
											} ?>
											<input type="text" class="form-control form-control-sm" id="sub_agent" name="sub_agent[]" value="<?php echo $row['sub_agent'] ?>">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Staff Eks</label>
											<?php
											} ?>
											<input type="text" class="form-control form-control-sm" id="staff" name="staff" value="<?php echo $row['staff_eks'] ?>">
										</div>
									</div>
									<div class="col" style="max-width: 200px;">
										<div class="form-group">
											<?php if ($u == 1) {
											?>
												<label for="tipe">Nominal</label>
											<?php
											} ?>
											<input type="text" class="form-control form-control-sm" id="nominal" name="nominal[]" value="<?php echo $row['nominal'] ?>">
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
					<button type="button" class="btn btn-success btn-sm" onclick="update_profit()">UPDATE</button>
				</div>
			</div>
		</div>
	</div>


	<script>
		function update_profit() {
			let formData = new FormData();
			var id = $('input[name="id[]"]').map(function() {
				return this.value; // $(this).val()
			}).get();
			var start = $('input[name="start[]"]').map(function() {
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



			formData.append("id", id);
			formData.append("start", start);
			formData.append("until", until);
			formData.append("profit", profit);
			formData.append("admin", admin);
			formData.append("marketing", marketing);
			formData.append("sub_agent", sub_agent);
			formData.append("staff", staff);
			formData.append("nominal", nominal);
			$.ajax({
				type: 'POST',
				url: "update_FL_profit.php",
				data: formData,
				cache: false,
				processData: false,
				contentType: false,
				success: function(msg) {
					alert(msg);
					PR_Package(1, 0, 0);
				},
				error: function() {
					alert("Data Gagal Diupload");
				}
			});
		}
	</script>