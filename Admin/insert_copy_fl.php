<?php
include "../site.php";
include "../db=connection.php";
$col = $_POST['col'];
$date = date("Y-m-d");
$status = $_SESSION['staff_id'];

if ($_POST['grub_id'] != "") {
    $arr_grub = explode(",", $_POST['grub_id']);
    // var_dump($_POST['grub_id']);
    $b_detail = 0;
    $g_detail = 0;
    foreach ($arr_grub as $grub) {
        $cek_id = "SELECT id_grub FROM LTP_route_detail ORDER BY id_grub DESC LIMIT 1";
        $rs_cek_id = mysqli_query($con, $cek_id);
        $row_cek_id = mysqli_fetch_array($rs_cek_id);
        $val_cek_id = $row_cek_id['id_grub'] + 1;

        $cek = "SELECT * FROM LTP_route_detail where id_grub='" . $grub . "' order by id ASC LIMIT 1";
        $rs_cek = mysqli_query($con, $cek);
        $row_cek = mysqli_fetch_array($rs_cek);
        if ($row_cek['id'] != "") {
            $index = $grub . "loop";
            $col = $_POST[$index];
            /// loop detai route
            for ($i = 1; $i < $col; $i++) {
                // echo $grub."ppp".$i."/";
                        $sql2 = "INSERT INTO LTP_route_detail VALUES ('','" . $row_cek['route_id'] . "','" . $row_cek['musim'] . "','" . $row_cek['type'] . "','" . $row_cek['rute'] . "','" . $val_cek_id . "','" . $_POST[$grub.'maskapai'.$i] . "','" . $_POST[$grub.'dept'.$i]. "','" . $_POST[$grub.'arr'.$i] . "','" . $_POST[$grub.'tgl'.$i] . "','" . $_POST[$grub.'etd'.$i]. "','" . $_POST[$grub.'eta'.$i]. "','" . $_POST[$grub.'transit'.$i]. "','" . $_POST[$grub.'adt'.$i]. "','" . $_POST[$grub.'chd'.$i]. "','" . $_POST[$grub.'inf'.$i]. "','" . $_POST[$grub.'bagasi'.$i]. "','" . $_POST[$grub.'bagasi_price'.$i]. "','" . $_POST[$grub.'seat'.$i]. "','" . $_POST[$grub.'bf'.$i]. "','" . $_POST[$grub.'ln'.$i]. "','" . $_POST[$grub.'dn'.$i]. "','" . $_POST[$grub.'tax'.$i]. "','$status')";
                        if (mysqli_query($con, $sql2)) {
                            $b_detail++;
                        } else {
                            $g_detail++;
                            // echo $sql2;
                        }
                   
            }
        } else {
            echo "ID Grub pada Route Detail tidak tersedia";
        }
    }
    echo "Data Berhasil : ".$b_detail.", Data Gagal : ".$g_detail;
} else {
    echo "Data kosong !!";
}

$con->close();
