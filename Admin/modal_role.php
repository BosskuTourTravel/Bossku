<?php
include "../site.php";
include "../db=connection.php";

$query = "SELECT * FROM login_staff where id=" . $_POST['id'];
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);

$query_lvl2 = "SELECT * FROM level where id=" . $row['type'];
$rs_lvl2 = mysqli_query($con, $query_lvl2);
$row_lvl2 = mysqli_fetch_array($rs_lvl2);

$query_st = "SELECT * FROM Staff_role where staff_id='" . $_POST['id'] . "'";
$rs_st = mysqli_query($con, $query_st);
$row_st = mysqli_fetch_array($rs_st);
$menu_check = explode(",", $row_st['menu']);
$role_check = explode(",", $row_st['menu_sub']);
// var_dump($role_check);

?>
<div>
	<div style="text-align: center;"><?php echo $row['name'] ?></div>
	<div class="form-group">
		<label>Pilih Role Type</label>
		<select class="form-control form-control-sm" id="item" name="item">
			<option value="<?php echo $row_lvl2['id'] ?>" selected><?php echo $row_lvl2['level'] ?></option>
			<?php
			$query_lvl = "SELECT * FROM level order by id ASC ";
			$rs_lvl = mysqli_query($con, $query_lvl);
			while ($row_lvl = mysqli_fetch_array($rs_lvl)) {
			?>
				<option value="<?php echo $row_lvl['id'] ?>"><?php echo $row_lvl['level'] ?></option>
			<?php
			}
			?>
		</select>
	</div>
	<input type="hidden" id="id" name="id" value="<?php echo $_POST['id'] ?>">
	<div class="content">
		<?php
		$query_menu = "SELECT * FROM Master_menu order by id ASC ";
		$rs_menu = mysqli_query($con, $query_menu);
		while ($row_menu = mysqli_fetch_array($rs_menu)) {

		?>
			<div class="row" style="border: solid 1px; margin: 5px 10px; padding: 5px;">
				<div class="col-md-6">
					<?php
					$key_menu = array_search($row_menu['id'], $menu_check);
					if ($key_menu !== false) {
					?>
						<div>
							<input type="checkbox" id="chck-<?php echo $row_menu['id'] ?>" name="chck" value="<?php echo $row_menu['id'] ?>" onclick="add_chck(this.value)" checked />
							<label for="chck"><?php echo $row_menu['menu'] ?></label>
						</div>
					<?php
					} else {
					?>
						<div>
							<input type="checkbox" id="chck-<?php echo $row_menu['id'] ?>" name="chck" value="<?php echo $row_menu['id'] ?>" onclick="add_chck(this.value)" />
							<label for="chck"><?php echo $row_menu['menu'] ?></label>
						</div>
					<?php
					}
					?>

				</div>
				<div class="col-md-6">
					<?php
					$query_menu_sub = "SELECT * FROM Mater_menu_sub where menu='" . $row_menu['id'] . "'";
					$rs_menu_sub = mysqli_query($con, $query_menu_sub);
					while ($row_menu_sub = mysqli_fetch_array($rs_menu_sub)) {
						$key = array_search($row_menu_sub['id'], $role_check);
						//  var_dump($role_check[$key]);
						if ($key !== false) {
					?>
							<div>
								<input type="checkbox" class="chck-cls-<?php echo $row_menu['id'] ?>" id="chck-chd-<?php echo $row_menu_sub['id'] ?>" name="chck-chd" value="<?php echo $row_menu_sub['id'] ?>" checked />
								<label for="chck-chd-<?php echo $row_menu_sub['id'] ?>"><?php echo $row_menu_sub['menu_sub']  ?></label>
							</div>
						<?php
						} else {
						?>
							<div>
								<input type="checkbox" class="chck-cls-<?php echo $row_menu['id'] ?>" id="chck-chd-<?php echo $row_menu_sub['id'] ?>" name="chck-chd" value="<?php echo $row_menu_sub['id'] ?>" />
								<label for="chck-chd-<?php echo $row_menu_sub['id'] ?>"><?php echo $row_menu_sub['menu_sub']  ?></label>
							</div>
					<?php
						}
					}
					?>
				</div>
			</div>

		<?php
		}
		?>
		<div style="padding: 10px;">
			<input type="hidden" id="staff" value="<?php echo $_POST['id'] ?>">
			<button type="button" class="btn btn-success" data-dismiss="modal" onclick="add_role()">Submit</button>
		</div>
	</div>
</div>

<script>
	function add_chck(x) {
		if ($("#chck-" + x).is(':checked')) {
			$(".chck-cls-" + x).prop("checked", true);
		} else {
			$(".chck-cls-" + x).prop("checked", false);
		}

	}

	function add_role() {
		let formData = new FormData();
		var staff = document.getElementById("staff").value;
		var tipe = document.getElementById("item").value;
		var role = [];
		var menu = [];
		$('[name="chck-chd"]').each(function() {
			if ($(this).prop('checked') == true) {
				role.push($(this).val());
			}
		});
		$('[name="chck"]').each(function() {
			if ($(this).prop('checked') == true) {
				menu.push($(this).val());
			}
		});
		formData.append('menu', menu);
		formData.append('role', role);
		formData.append('staff', staff);
		formData.append('tipe', tipe);
		// console.log(role);
		$.ajax({
			type: 'POST',
			url: "insert_role.php",
			data: formData,
			cache: false,
			processData: false,
			contentType: false,
			success: function(msg) {
				alert(msg);
				OT_Package(0,0,0);
			},
			error: function() {
				alert("Data Gagal Diupload");
			}
		});
	}
</script>