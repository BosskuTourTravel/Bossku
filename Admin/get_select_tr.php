<?php
include "../site.php";
include "../db=connection.php";
//export.php  
$data =[];
if ($_POST['negara']) {
      $sql_tr = "SELECT * FROM Transport_new WHERE country ='".$_POST['negara']."' order by city ASC";
      $result_tr = mysqli_query($con, $sql_tr);
      while ($row_tr =  mysqli_fetch_assoc($result_tr)) {
            $query_agent = "SELECT * FROM agent_transport where id='".$row_tr['id']."'";
            $rs_agent = mysqli_query($con,$query_agent);
            $row_agent = mysqli_fetch_array($rs_agent);
            $agent = $row_agent['company'];

            $detail = $row_tr['city']." | ".$row_tr['trans_type']." | ".$row_tr['seat']." seat | ".$row_tr['periode'];
           array_push($data,(object)[
            "id" => $row_tr['id'],
            "detail" => $detail,
            "agent" => $agent
           ]);
      }
      echo json_encode($data);
}
?>