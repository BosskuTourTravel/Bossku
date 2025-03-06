<?php
include "../site.php";
include "../db=connection.php";

?>
<div>
	<div style="text-align: center; font-weight: bold;">DAY <?php echo $_POST['id'] ?></div>
	<div class="form-group">
		<label>Pilih Item</label>
		<select class="form-control form-control-sm" id="item" name="item" style="max-width: 200px;" onchange="sel_item(this.value)">
			<option value="">Pilih Item</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
		</select>
	</div>
	<input type="hidden" id="hari" name="hari" value="<?php echo $_POST['id'] ?>">
</div>
<div class="modal_sel_guide">
</div>
<script>
	function sel_item(x) {
		$.ajax({
			url: "modal_sel_guide.php",
			method: "POST",
			asynch: false,
			data: {
				id: x,
			},
			success: function(data) {
				$('.modal_sel_guide').html(data);
			}
		});
	}
</script>