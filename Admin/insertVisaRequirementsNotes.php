<?php
include "../site.php";
include "../db=connection.php";

$requirements = $_POST['requirements'];
$notes = $_POST['notes'];

$sql = "INSERT INTO visa_requirements VALUES ('','".$requirements."')";
$sql2 = "INSERT INTO visa_notes VALUES ('','".$notes."')";
if (mysqli_query($con, $sql) && mysqli_query($con, $sql2)) {
	echo"Success";
} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}
$con->close();

?>