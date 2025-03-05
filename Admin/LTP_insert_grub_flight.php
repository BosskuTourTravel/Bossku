<?php
include "../db=connection.php";
$id = $_POST['grub_fl'];
session_start();
$date =  date('Y-m-d');
$staff = $_SESSION['staff_id'];
$berhasil = 0;
$gagal = 0;
$berhasil_rr = 0;
$gagal_rr = 0;
if ($_POST['chck'] != "") {
     $status = 0;
     $p = 1;
     foreach ($_POST['chck'] as $value) {
          $cek_fl = "SELECT rute, id_grub FROM LTP_route_detail where id='" . $value . "'";
          $rs_fl = mysqli_query($con, $cek_fl);
          $row_fl = mysqli_fetch_array($rs_fl);

          if ($row_fl['rute'] == "FIG") {
               $query_add = "SELECT id ,maskapai,dept FROM LTP_route_detail where id_grub='" . $row_fl['id_grub'] . "'";
               $rs_add = mysqli_query($con, $query_add);
               while ($row_add = mysqli_fetch_array($rs_add)) {
                    if ($p == 1) {

                         $query_cek = "SELECT * FROM LTP_grub_flight where id=" . $id;
                         $rs_cek = mysqli_query($con, $query_cek);
                         $row_cek = mysqli_fetch_array($rs_cek);

                         $arr_fl = explode(" ", $row_add['maskapai']);

                         $queryflight_logo = "SELECT nama FROM LT_flight_logo WHERE kode='" . $arr_fl[0] . "'";
                         $rsflight_logo = mysqli_query($con, $queryflight_logo);
                         $rowflight_logo = mysqli_fetch_array($rsflight_logo);

                         $nama = "START " . $row_add['dept'] . " - " . $rowflight_logo['nama'];

                         $sql_upd = "UPDATE  LTP_grub_flight SET grub_name='" . $nama . "'  WHERE id=" . $id;
                         if (mysqli_query($con, $sql_upd)) {
                              // $berhasil++;
                         }
                         // var_dump($sql_upd);
                    }



                    $sql2 = "INSERT INTO LTP_grub_flight_value VALUE ('','" . $date . "','" . $id . "','" . $row_add['id'] . "','" . $status . "')";
                    if (mysqli_query($con, $sql2)) {
                         $berhasil++;
                    } else {
                         $gagal++;
                    }
                    $p++;
               }
          } else {
               $cek_fl2 = "SELECT id ,maskapai,dept FROM LTP_route_detail where id_grub='" . $row_fl['id_grub'] . "'";
               $rs_fl2 = mysqli_query($con, $cek_fl2);
               while ($row_fl2 = mysqli_fetch_array($rs_fl2)) {

                    if ($p == 1) {
                         $query_gf_cek = "SELECT id FROM LTP_grub_flight_value where grub_id='" . $id . "' order by id ASC";
                         $rs_gf_cek = mysqli_query($con, $query_gf_cek);
                         $row_gf_cek = mysqli_fetch_array($rs_gf_cek);

                         //  var_dump($query_gf_cek);
                         if ($row_gf_cek == "") {

                              $query_cek = "SELECT * FROM LTP_grub_flight where id=" . $id;
                              $rs_cek = mysqli_query($con, $query_cek);
                              $row_cek = mysqli_fetch_array($rs_cek);

                              $arr_fl = explode(" ", $row_fl2['maskapai']);

                              $queryflight_logo = "SELECT nama FROM LT_flight_logo WHERE kode='" . $arr_fl[0] . "'";
                              $rsflight_logo = mysqli_query($con, $queryflight_logo);
                              $rowflight_logo = mysqli_fetch_array($rsflight_logo);

                              $nama = "START " . $row_fl2['dept'] . " - " . $rowflight_logo['nama'];
                              // var_dump($nama);

                              $sql_upd = "UPDATE  LTP_grub_flight SET grub_name='" . $nama . "'  WHERE id=" . $id;
                              if (mysqli_query($con, $sql_upd)) {
                                   // $berhasil++;
                              }
                         }
                         // var_dump($cek_fl2);
                    }

                    $sql = "INSERT INTO LTP_grub_flight_value VALUE ('','" . $date . "','" . $id . "','" . $row_fl2['id'] . "','" . $status . "')";
                    if (mysqli_query($con, $sql)) {
                         $berhasil++;
                    } else {
                         $gagal++;
                    }
                    $p++;
               }
          }
     }
     echo "berhasil : " . $berhasil . " , Gagal : " . $gagal;
} else if ($_POST['chck_rr'] != "") {

     $status = 1;
     $p = 1;
     foreach ($_POST['chck_rr'] as $value_rr) {

          if ($p == 1) {
               $query_gf_cek = "SELECT id FROM LTP_grub_flight_value where grub_id='" . $id . "' order by id ASC";
               $rs_gf_cek = mysqli_query($con, $query_gf_cek);
               $row_gf_cek = mysqli_fetch_array($rs_gf_cek);
               // var_dump($query_gf_cek);
               if ($row_gf_cek == "") {
                    $cek_fl3 = "SELECT id ,maskapai,dept FROM LTP_route_detail where id='" . $value_rr . "'";
                    $rs_fl3 = mysqli_query($con, $cek_fl3);
                    $row_fl3 = mysqli_fetch_array($rs_fl3);

                    $query_cek = "SELECT * FROM LTP_grub_flight where id=" . $id;
                    $rs_cek = mysqli_query($con, $query_cek);
                    $row_cek = mysqli_fetch_array($rs_cek);

                    $arr_fl = explode(" ", $row_fl3['maskapai']);
                    $queryflight_logo = "SELECT nama FROM LT_flight_logo WHERE kode='" . $arr_fl[0] . "'";
                    $rsflight_logo = mysqli_query($con, $queryflight_logo);
                    $rowflight_logo = mysqli_fetch_array($rsflight_logo);

                    $nama = "START " . $row_fl3['dept'] . " - " . $rowflight_logo['nama'];

                    $sql_upd = "UPDATE  LTP_grub_flight SET grub_name='" . $nama . "'  WHERE id=" . $id;
                    if (mysqli_query($con, $sql_upd)) {
                         // $berhasil++;
                    }
               }
               //  var_dump($sql_upd);
          }



          $sql3 = "INSERT INTO LTP_grub_flight_value VALUE ('','" . $date . "','" . $id . "','" . $value_rr . "','" . $status . "')";
          if (mysqli_query($con, $sql3)) {
               $berhasil_rr++;
          } else {
               $gagal_rr++;
          }
          $p++;
     }
     echo "berhasil : " . $berhasil_rr . " , Gagal : " . $gagal_rr;
} else {
     echo "Silakan Pilih Flight !! ";
}
$con->close();
