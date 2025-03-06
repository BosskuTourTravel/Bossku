<?php
//export.php  


if ($_POST['brand']) {
     include "../site.php";
     include "../db=connection.php";
     $sql = "SELECT * FROM Guest_meal WHERE id= '" . $_POST['brand'] . "'";
     $result = mysqli_query($con, $sql);
     $row = mysqli_fetch_assoc($result);

     $sql2 = "SELECT * FROM Guide_Meal WHERE negara= '" . $row['negara'] . "' && kode='E'";
     $result2 = mysqli_query($con, $sql2);
     $row2 = mysqli_fetch_assoc($result2);
      echo json_encode($row2); // This will encode the data into a variable that JavaScript can decode.
}

