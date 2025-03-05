<?php
include "../site.php";
include "../db=connection.php";

$query_data = "SELECT * FROM LTSUB_itin WHERE id=" . $_POST['id'];
$rs_data = mysqli_query($con, $query_data);
$row_data = mysqli_fetch_array($rs_data);

$query_cek = "SELECT * FROM LT_change_judul WHERE copy_id='".$_POST['id']."' && grub_id='".$_POST['grub_id']."' order by id DESC";
$rs_cek = mysqli_query($con, $query_cek);
$row_cek = mysqli_fetch_array($rs_cek);
// var_dump($query_cek);


?>
<div class='content-wrapper'>
	<div class='row'>
		<div class='col-12'>
			<div class='card'>
				<div class='card-body table-responsive p-0' style="padding: 20px !important;">
					FORM UPDATE JUDUL LANDTOUR
				</div>
			</div>
			<div class="container" style="max-width: 760px; padding: 20px;">
				<div class="card">
					<div class="card-header">
					<a class="btn btn-warning btn-sm" onclick="MN_Package(0,<?php echo $_POST['id'] ?>,<?php echo $row_data['master_id'] ?>)"><i class="fa fa-arrow-left"></i></a>
					<a class="btn btn-info btn-sm" onclick="LT_Get_Judul(0,<?php echo $row_data['id'] ?>,<?php echo  $_POST['grub_id'] ?>,<?php echo $_POST['sfee_id'] ?>)"><i class="fas fa-sync-alt"></i></a>
					</div>
					<div class="card-body">
						<form>
							<div class="form-group">
								<label style="font-size: 11px;">JUDUL TOUR </label>
								<input class="form-control form-control-sm" type="text" name="j_tour" id="j_tour" value="<?php echo $row_cek['nama'] ?>">
							</div>
							<input type="hidden" id="master" name="master" value="<?php echo  $row_data['master_id'] ?>">
							<button type="button" class="btn btn-primary" id='but_upload' onclick="update_itin(<?php echo $_POST['id'] ?>,<?php echo $_POST['grub_id'] ?>,<?php echo $_POST['sfee_id'] ?>)">CREATE</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function update_itin(x,y,z) {
		let formData = new FormData();

		var judul = $("input[name=j_tour]").val();
		var master = $("input[name=master]").val();
		formData.append('copy_id',x);
		formData.append('judul', judul);
		formData.append('grub_id',y);
		formData.append('sfee_id',z);

		$.ajax({
			type: 'POST',
			url: "update_ListPT_judul.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
				MN_Package(0,x,master);
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});
	}
</script>