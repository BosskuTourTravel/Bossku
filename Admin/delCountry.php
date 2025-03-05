<?php
include "../site.php";
include "../db=connection.php";

$id = $_POST['id'];

$query = "SELECT * FROM country WHERE id=".$id;
$rs=mysqli_query($con,$query);
$row = mysqli_fetch_array($rs);

$sql = "DELETE FROM country WHERE id=".$id;

if ($con->query($sql) === TRUE) {
	unlink("../".$row['img']);
	unlink("../".$row['img_head']);
    echo "success";
} else {
    echo "error";
}

$con->close();


?>