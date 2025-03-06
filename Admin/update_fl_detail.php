<?php
include "../site.php";
include "../db=connection.php";
$id= $_POST['id'];
$sql = "UPDATE LTP_route_detail SET musim='".$_POST['musim']."', type='".$_POST['trip']."' , rute='".$_POST['rute']."',maskapai='".$_POST['kode']."', dept='".$_POST['dept']."', arr='".$_POST['arr']."',tgl='".$_POST['tgl']."', take='".$_POST['etd']."', landing='".$_POST['eta']."',transit='".$_POST['transit']."',adt='".$_POST['adt']."',chd='".$_POST['chd']."',inf='".$_POST['inf']."',bf='".$_POST['bf']."',ln='".$_POST['ln']."',dn='".$_POST['dn']."',bagasi='".$_POST['bagasi']."',bagasi_price='".$_POST['bagasi_price']."',seat_price='".$_POST['seat']."',tax='".$_POST['tax']."' WHERE id=".$id;
if (mysqli_query($con, $sql)) {
    echo "success";
} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}
$con->close();

?>
