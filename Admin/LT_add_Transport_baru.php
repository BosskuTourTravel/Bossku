<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<?php
include "../site.php";
include "../db=connection.php";

$query_sub =  "SELECT id,master_id,landtour  FROM LTSUB_itin where id=" . $_POST['id'];
$rs_sub = mysqli_query($con, $query_sub);
$row_sub = mysqli_fetch_array($rs_sub);
$in = "";
$out = "";

if ($row_sub['landtour'] != "") {
	$query_itin = "SELECT city_in, city_out FROM LT_itinnew where kode ='" . $row_sub['landtour'] . "' order by id ASC limit 1";
	$rs_itin = mysqli_query($con, $query_itin);
	$row_itin = mysqli_fetch_array($rs_itin);
	$in = $row_itin['city_in'];
	$out = $row_itin['city_out'];
}

?>
<div class='content-wrapper' style="width: 130%;">
	<div class='row'>
		<div class='col-12'>
			<div class="card">
				<div class="card-header">
					<div class="input-group input-group-sm">
						<div class="input-group-append" style="text-align: left;">
							<div style="padding-right: 5px;"> <button type="button" onclick="LT_itinerary(25,<?php echo $row_sub['id']  ?>,<?php echo $row_sub['master_id'] ?>)" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i></button></div>
							<div style="padding-right: 5px;"> <button type="button" onclick="LT_itinerary(22,<?php echo $_POST['id'] ?>,0)" class="btn btn-primary btn-sm"><i class="fas fa-sync"></i></button></div>
							<h3 class="card-title" style="font-weight:bold;">LT FLIGHT PACKAGE</h3>
						</div>
					</div>
				</div>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-5">
								<div class="card">
									<h5 class="card-header">FORM NEW GROUP (<?php echo $in . " - " . $out ?>)</h5>
									<div class="card-body">
										<form>
											<div class="form-group">
												<label for="">Name Group</label>
												<input type="text" class="form-control form-control-sm" id="grub" name="grub" placeholder="Example : SQ Flight A SUB">
											</div>
											<!-- <div class="form-group">
												<label for="exampleFormControlSelect1">Group Name</label>
												<select class="form-control" id="grub" name="grub">
													<option value="Flight A" selected>Flight A</option>
													<option value="Flight B">Flight B</option>
													<option value="Flight C">Flight C</option>
													<option value="Flight D">Flight D</option>
													<option value="Flight E">Flight E</option>
													<option value="Flight F">Flight F</option>
													<option value="Flight G">Flight G</option>
													<option value="Flight H">Flight H</option>
													<option value="Flight I">Flight I</option>
													<option value="Flight J">Flight J</option>
												</select>
											</div> -->
											<input type="hidden" id="city_in" name="city_in" value="<?php echo $row_itin['city_in'] ?>">
											<input type="hidden" id="city_out" name="city_out" value="<?php echo $row_itin['city_out'] ?>">
											<button type="button" class="btn btn-info btn-sm" onclick="add_new_grub(<?php echo $_POST['id'] ?>,<?php echo $_POST['master_id'] ?>)">Add New Group</button>
										</form>
										<div class="div" style="padding-top: 20px;"></div>
										<table class="table table-bordered table-sm" style="font-size: 12px;">
											<thead>
												<tr style="background-color: #008080; color: white;">
													<th scope="col">NO</th>
													<th scope="col" style="max-width: 70px;">GROUP NAME</th>
													<th scope="col">PRICE</th>
													<th scope="col">ACTION</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$query_grub = "SELECT * FROM LTP_grub_flight where city_in='" . $in . "' && city_out='" . $out . "' order by grub_name ASC";
												$rs_grub = mysqli_query($con, $query_grub);
												$no = 1;
												while ($row_grub = mysqli_fetch_array($rs_grub)) {
													// var_dump($row_grub['id']);
												?>
													<tr>
														<td><?php echo $no ?></td>
														<td><?php echo $row_grub['grub_name'] ?></td>
														<td><?php echo number_format($result_price['adt'], 0, ",", ".") ?></td>
														<td>
															<input type="hidden" id="price" name="price" value="<?php echo $result_price['adt'] ?>">
															<input type="hidden" id="price_chd" name="price_chd" value="<?php echo $result_price['chd'] ?>">
															<input type="hidden" id="price_inf" name="price_inf" value="<?php echo $result_price['inf'] ?>">
															<a class="btn btn-info btn-sm" onclick="add_form_edit(<?php echo $row_grub['id'] ?>,<?php echo $_POST['id'] ?>)"><i class="far fa-edit"></i></a>
															<a class="btn btn-warning btn-sm" onclick="add_form_sfee(<?php echo $row_grub['id'] ?>,<?php echo $_POST['id'] ?>)"><i class="fa fa-credit-card"></i></a>
															<a class="btn btn-success btn-sm" data-toggle="modal" data-target="#renameModal" data-id="<?php echo $row_grub['id'] ?>" data-copy="<?php echo $_POST['id'] ?>"><i class="fa fa-tools"></i></a>
															<a class="btn btn-danger btn-sm" onclick="del_grub(<?php echo $row_grub['id'] ?>,<?php echo $_POST['id'] ?>)"><i class="fa fa-trash"></i></a>
														</td>
													</tr>
												<?php
												$no++;
												}
												?>
											</tbody>
										</table>
									</div>
								</div>
								<div id="form-sfee">

								</div>
							</div>
							<div class="col-md-7">
								<div id="form-edit">

								</div>
							</div>
							<div class="modal fade" id="renameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Rename Groub Flight </h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="modal-data-rename"></div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
											<button type="button" class="btn btn-success btn-sm" onclick="add_rename()" data-dismiss="modal">Submit</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<!-- <li class="list-group-item">Dapibus ac facilisis in</li>
					<li class="list-group-item">Vestibulum at eros</li> -->
				</ul>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#renameModal').on('show.bs.modal', function(e) {
			var id = $(e.relatedTarget).data('id');
			var copy = $(e.relatedTarget).data('master');
			$.ajax({
				url: "rename_modal.php",
				method: "POST",
				asynch: false,
				data: {
					id: id,
					copy: copy
				},
				success: function(data) {
					$('.modal-data-rename').html(data);
				}
			});
		});
	});
</script>
<script>
	function del_grub(x, y) {
		var txt;
		var r = confirm("Are you sure to delete?");
		if (r == true) {
			$.ajax({
				url: "LTP_delete_grub.php",
				method: "POST",
				asynch: false,
				data: {
					id: x
				},
				success: function(data) {
					if (data == "success") {
						LT_itinerary(22, y, 0)
					} else {
						alert("Fail to Delete");
					}
				}
			});
		}
	}

	function add_form_edit(x, y) {
		// alert(x + ' ' + y);
		$.ajax({
			url: "LTP_formedit_field.php",
			method: "POST",
			asynch: false,
			data: {
				x: x,
				y: y,
				val_in: "Surabaya"
			},
			success: function(data) {
				$('#form-edit').html(data);
			}
		});
	}

	function add_form_sfee(x, y) {
		var price = document.getElementById("price").value;
		var price_chd = document.getElementById("price_chd").value;
		var price_inf = document.getElementById("price_inf").value;
		$.ajax({
			url: "LTP_formsfee_field.php",
			method: "POST",
			asynch: false,
			data: {
				x: x,
				y: y,
				price: price,
				price_chd: price_chd,
				price_inf: price_inf
			},
			success: function(data) {
				$('#form-sfee').html(data);
			}
		});
	}

	function add_new_grub(x, y) {
		var grub = document.getElementById("grub").value;
		// var grub = document.getElementById("grub").options[document.getElementById("grub").selectedIndex].value;
		var city_in = document.getElementById("city_in").value;
		var city_out = document.getElementById("city_out").value;
		if (grub == "") {
			alert("Grub tidak boleh kosong !!");
		} else {
			$.ajax({
				url: "LTP_formadd_grub.php",
				method: "POST",
				asynch: false,
				data: {
					id: x,
					master_id: y,
					grub: grub,
					city_in: city_in,
					city_out: city_out
				},

				success: function(data) {
					alert(data);
					LT_itinerary(22, x, 0);
				}
			});
		}

	}

	function add_rename() {
		var name = document.getElementById("grub_rename").value;
		var id = document.getElementById("id").value;
		$.ajax({
			url: "LTP_update_grub.php",
			method: "POST",
			asynch: false,
			data: {
				id: id,
				name:name
			},

			success: function(data) {
				 alert(data);
			}
		});
	}
</script>