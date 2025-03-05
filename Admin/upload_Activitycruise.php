<?php
include "../site.php";
include "../db=connection.php";
include "excel_reader2.php";
///// case 1 //////////////////////////////////////////////////////////////////////////////
// upload file xls
if (!empty($_FILES["fileToUpload"])) {
    $target = basename($_FILES["fileToUpload"]["name"]);
    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target);
    // beri permisi agar file xls dapat di baca
    chmod($_FILES['fileToUpload']['name'], 0777);
    // mengambil isi file xls
    $data = new Spreadsheet_Excel_Reader($_FILES['fileToUpload']['name'], false);
    // menghitung jumlah baris data yang ada
    $jumlah_baris = $data->rowcount($sheet_index = 0);

    // jumlah default data yang berhasil di import
    $berhasil = 0;
    $gagal = 0;
    for ($i = 2; $i <= $jumlah_baris; $i++) {

        // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
        $pack_id     = $data->val($i, 1);
        $day   = $data->val($i, 2);
        $poc  = $data->val($i, 3);
        $arrival  = $data->val($i, 4);
        $depature  = $data->val($i, 5);
        $activity  = $data->val($i, 6);

         $sql = "INSERT INTO cruise_activity VALUES ('','" . $pack_id  . "','" . $day . "','" . $poc . "','" . $arrival . "','','" . $depature . "','" . $activity . "')";
         $hasil = mysqli_query($con, $sql);
         $berhasil++;

}
unlink($_FILES['fileexcel']['name']);
}
echo "succes";
////////////////////////////////////////////////////////////////////////////////////////////////
?>