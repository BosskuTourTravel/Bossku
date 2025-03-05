<?php
include "../site.php";
include "../db=connection.php";


$staff = $_POST['staff'];
$sql = "SELECT * FROM jobdesk WHERE nama=".$_POST['staff'];
//$sql = "select * from jobdesk2 where id_staff=$staff";
$hasil = mysqli_query($con, $sql);
    while ($row= mysqli_fetch_array($hasil)) {
        $data= explode(",",$row['job']); 
        for($i=0; $i < count($data); $i++){
            $queryjob = "SELECT * FROM jenisgaji WHERE id=".$data[$i];
            $rsjob=mysqli_query($con,$queryjob);
            $rowjob = mysqli_fetch_array($rsjob);
            if($rowjob['id']==1 or $rowjob['id']==26 or $rowjob['id']==28){
                echo"<option value=".$rowjob['id']." disabled>".$rowjob['nama_job']." : Rp ".$rowjob['harga']."</option>";
            }else{ 
                echo"<option value=".$rowjob['id'].">".$rowjob['nama_job']." : Rp ".$rowjob['harga']."</option>";}
            }
}
?>