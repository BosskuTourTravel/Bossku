<!DOCTYPE html>
<html lang="en">
<?php
include "../db=connection.php";
include "header.php";
error_reporting(0);
session_start();
include "reload_page.php";
if (($_SESSION['staff_id'] == '') || (!isset($_SESSION['staff_id'])) || $_SESSION['staff_id'] == 'undefined') {
	echo "<script>alert('Session Berakhir, Harap Login Kembali!');</script>";
}
?>

<body class="hold-transition sidebar-mini layout-fixed">
	<?php
	include "navbar.php";
	?>
	<div class="wrapper">
		<div id="loading" style="padding: 20px; display: none;">
			<div class="d-flex justify-content-center">
				<h2><strong>Loading Page </strong></h2>
				<div style="padding: 10px;">
					<div class="spinner-grow text-muted"></div>
					<div class="spinner-grow text-primary"></div>
					<div class="spinner-grow text-success"></div>
				</div>
			</div>
		</div>
		<div id="divDashboard">
			<?php
			include "dashboard.php";
			?>
		</div>
		<div id="divReloadPage"></div>

	</div>
	<script src="plugins/jquery/jquery.min.js"></script>
	<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="plugins/chart.js/Chart.min.js"></script>
	<script src="plugins/sparklines/sparkline.js"></script>
	<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="plugins/jqvmap/maps/jquery.vmap.world.js"></script>
	<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
	<script src="plugins/moment/moment.min.js"></script>
	<script src="plugins/summernote/summernote-bs4.min.js"></script>
	<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<script src="dist/js/adminlte.js"></script>
	<script src="dist/js/demo.js"></script>
	<script src="https://cdn.datatables.net/v/bs4/dt-2.0.2/datatables.min.js"></script>

	<script>
		$(document).ready(function() {

			$("#divLandTour").hide();
			$("#li1").addClass('active');
			$("#li1").addClass('menu-open');
			$("#ali1").addClass('active');
			$("#a11").addClass('active');

		});
	</script>
</body>
<footer class="main-footer">
	<strong>Copyright &copy; 2019 <a href="http://holidaymyboss.com">holidaymyboss.com</a>.</strong>
	All rights reserved.
</footer>
</html>