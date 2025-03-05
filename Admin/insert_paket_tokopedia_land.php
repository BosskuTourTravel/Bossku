
<?php
include "../db=connection.php";
// include "Api_LT_total_baru.php";
include "Api_LT_total.php";
session_start();
// $id = "835-953-19";
$id = $_POST['paket'];
$no = $_POST['no'];
$mp_id = $_POST['id'];
if ($id != "") {
    $date = date("Y-m-d");
    $staff =  $_SESSION['staff_id'];

    $query_itin = "SELECT * FROM  LT_itinerary2 where id=" . $_POST['lt'];
    $rs_itin = mysqli_query($con, $query_itin);
    $row_itin = mysqli_fetch_assoc($rs_itin);
    $json_day = $row_itin['hari'];

    $query_u = "SELECT * FROM Upload_tokopedia_land where kode='" . $id . "' && mp_id='" . $mp_id . "' && urutan='".$no."'";
    $rs_u = mysqli_query($con, $query_u);
    $row_u = mysqli_fetch_array($rs_u);
    $berhasil = 0;
    $gagal = 0;
    if ($row_u['id'] == "") {

        $query_lt2 = "SELECT * FROM  LT_itinnew where kode = '" . $id . "' && no_urut='".$no."' order by no_urut ASC";
        $rs_lt2 = mysqli_query($con, $query_lt2);
        // var_dump($query_lt2);
        // $no = 1;
        while ($row_lt2 = mysqli_fetch_array($rs_lt2)) {
            $desc = "";
            $hotel = "<ul>";
            if($row_lt2['hotel1']!=""){
                $hotel .= "<li>".$row_lt2['hotel1']."</li>";
            }
            if($row_lt2['hotel2']!=""){
                $hotel .= "<li>".$row_lt2['hotel2']."</li>";
            }
            if($row_lt2['hotel3']!=""){
                $hotel .= "<li>".$row_lt2['hotel3']."</li>";
            }
            if($row_lt2['hotel4']!=""){
                $hotel .= "<li>".$row_lt2['hotel4']."</li>";
            }
            if($row_lt2['hotel5']!=""){
                $hotel .= "<li>".$row_lt2['hotel5']."</li>";
            }
            if($row_lt2['hotel6']!=""){
                $hotel .= "<li>".$row_lt2['hotel6']."</li>";
            }
            if($row_lt2['hotel7']!=""){
                $hotel .= "<li>".$row_lt2['hotel7']."</li>";
            }
            if($row_lt2['hotel8']!=""){
                $hotel .= "<li>".$row_lt2['hotel8']."</li>";
            }
            if($row_lt2['hotel9']!=""){
                $hotel .= "<li>".$row_lt2['hotel9']."</li>";
            }
            if($row_lt2['hotel10']!=""){
                $hotel .= "<li>".$row_lt2['hotel10']."</li>";
            }
            $hotel .= "</ul><br>";
            for ($c = 1; $c <= $json_day; $c++) {
                $queryRute = "SELECT * FROM  LT_add_rute where tour_id='" .$row_itin['id'] . "' && hari='" . $c. "'";
                $rsRute = mysqli_query($con, $queryRute);
                $rowRute = mysqli_fetch_array($rsRute);
                $rute =  $rowRute['nama'];
                $desc .= "<div><b># Day " . $c . " " . $rute . "</b></div></br>";

                $queryTmp = "SELECT LT_add_listTmp.id,LT_add_listTmp.tempat,List_tempat.tempat2 FROM LT_add_listTmp LEFT JOIN List_tempat ON LT_add_listTmp.tempat=List_tempat.id  where LT_add_listTmp.tour_id='" . $row_itin['id'] . "' && LT_add_listTmp.hari='" . $c . "' order by urutan ASC";
                $rsTmp = mysqli_query($con, $queryTmp);
                $arr_tmp_list = [];
                while ($rowTmp = mysqli_fetch_array($rsTmp)) {
                    $desc .= "<div>   " . $rowTmp['tempat2'] . "</div></br>";
                }

            }

            $detail = $desc."<br>". $hotel;
            

            $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $row_lt2['agent_twn'] . "' && price2 >='" . $row_lt2['agent_twn'] . "'";
            $rs_profit = mysqli_query($con, $sql_profit);
            $row_profit = mysqli_fetch_array($rs_profit);

            $pr = 0;
            if ($row_profit['id'] != "") {
                $pr = $row_profit['profit'];
            } else {
                $pr = 5;
            }

            $adm_tokped_twn = $row_lt2 ['agent_twn'] * $row_profit['adm_tokped'] / 100;
            $adm_tokped_sgl = $row_lt2 ['agent_sgl'] * $row_profit['adm_tokped'] / 100;
            $adm_tokped_cnb = $row_lt2 ['agent_cnb'] * $row_profit['adm_tokped'] / 100;
            $adm_tokped_inf = $row_lt2 ['agent_inf'] * $row_profit['adm_tokped'] / 100;
        

            $twin = ($row_lt2['agent_twn'] * $pr / 100) + $row_lt2['agent_twn'] +$adm_tokped_twn; 
            $chd = ($row_lt2['agent_cnb'] * $pr / 100) + $row_lt2['agent_cnb'] + $adm_tokped_cnb;
            $inf = ($row_lt2['agent_inf'] * $pr / 100) + $row_lt2['agent_inf'] + $adm_tokped_inf;
            $sgl = ($row_lt2['agent_sgl'] * $pr / 100) + $row_lt2['agent_sgl'] + $adm_tokped_sgl;

            $twn_sp = get_pembulatan($twin);
            $twn_rp = json_decode($twn_sp, true);

            $sgl_sp = get_pembulatan($sgl);
            $sgl_rp = json_decode($sgl_sp, true);

            $cnb_sp = get_pembulatan($chd);
            $cnb_rp = json_decode($cnb_sp, true);

            $inf_sp = get_pembulatan($inf);
            $inf_rp = json_decode($inf_sp, true);

            $pax_u = "";
            $pax_b = "";
            $pax = "";
            if ($row_lt2['pax_u'] != 0) {
                $pax_u = " - " . $row_lt2['pax_u'];
            }
            if ($row_lt2['pax_b'] != 0) {
                $pax_b = " + " . $row_lt2['pax_b'];
            }
            $pax = $row_lt2['pax'] . $pax_u . $pax_b;
            $code = str_pad($no, 3, '0', STR_PAD_LEFT);

            $p_twn = 1;
            $p_cnb = 1;
            $p_inf = 1;
            $p_sgl = 1;
           


            if($p_twn !=0){
                $judul = "LANDTOUR ".$row_itin['judul']." ( Paket ".$row_lt2['no_urut']." : ".$pax." pax)";
                $sku = $id."ADT-".$code;
                $harga = $twn_rp['value'];
                $sql_adt = "INSERT INTO Upload_tokopedia_land VALUES ('','" . $mp_id . "','".$_POST['lt']."','".$id."','".$no."','" . $judul . "','" . $detail . "','4583','10','1','34655567','30','Baru','".$img."','','','','','','','','" . $sku . "','Aktif','50','" . $harga . "','50','Opsional','Twin')";
                // var_dump($sql);
                if (mysqli_query($con, $sql_adt)) {
                    $berhasil++;
                } else {
                    $gagal++;
                }

            }
            if($p_cnb !=0){
                $judul = "LANDTOUR ".$row_itin['judul']." ( Paket ".$row_lt2['no_urut']." : ".$pax." pax)";
                $sku = $id."CNB-".$code;
                $harga = $cnb_rp['value'];
                $sql_cnb = "INSERT INTO Upload_tokopedia_land VALUES ('','" . $mp_id . "','".$_POST['lt']."','".$id."','".$no."','" . $judul . "','" . $detail . "','4583','10','1','34655567','30','Baru','".$img."','','','','','','','','" . $sku . "','Aktif','50','" . $harga . "','50','Opsional','Child No Bed')";
                // var_dump($sql);
                if (mysqli_query($con, $sql_cnb)) {
                    $berhasil++;
                } else {
                    $gagal++;
                }
                
            }
            if($p_inf !=0){
                $judul = "LANDTOUR ".$row_itin['judul']." ( Paket ".$row_lt2['no_urut']." : ".$pax." pax)";
                $sku = $id."INF-".$code;
                $harga = $inf_rp['value'];
                $sql_inf = "INSERT INTO Upload_tokopedia_land VALUES ('','" . $mp_id . "','".$_POST['lt']."','".$id."','".$no."','" . $judul . "','" . $detail . "','4583','10','1','34655567','30','Baru','".$img."','','','','','','','','" . $sku . "','Aktif','50','" . $harga . "','50','Opsional','Infant')";
                // var_dump($sql);
                if (mysqli_query($con, $sql_inf)) {
                    $berhasil++;
                } else {
                    $gagal++;
                }
                
            }
            if($p_sgl !=0){

                $judul = "LANDTOUR ".$row_itin['judul']." ( Paket ".$row_lt2['no_urut']." : ".$pax." pax)";
                $sku = $id."SGL-".$code;
                $harga = $sgl_rp['value'];
                $sql_sgl = "INSERT INTO Upload_tokopedia_land VALUES ('','" . $mp_id . "','".$_POST['lt']."','".$id."','".$no."','" . $judul . "','" . $detail . "','4583','10','1','34655567','30','Baru','".$img."','','','','','','','','" . $sku . "','Aktif','50','" . $harga . "','50','Opsional','Single')";
                // var_dump($sql);
                if (mysqli_query($con, $sql_sgl)) {
                    $berhasil++;
                } else {
                    $gagal++;
                }
            }
        }

        echo "Berhasil : " . $berhasil;
    } else {
        echo "data sudah tersedia dalam package ini !";
    }
} else {
    echo "data ID tidak tersedia";
}
?>