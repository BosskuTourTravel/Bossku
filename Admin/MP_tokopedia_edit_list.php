<?php
include "../db=connection.php";
$i = 0;
// var_dump($_POST['id']);
$arr = explode(",", $_POST['id']);
$berhasil = 0;
$gagal = 0;
foreach ($arr as $id) {

    $produk_name = $_POST['produk_name'][$i];
    $desc = $_POST['deskripsi'][$i];
    $kategori = $_POST['kategori'][$i];
    $berat = $_POST['berat'][$i];
    $min_pembelian = $_POST['min_pembelian'][$i];
    $etalase = $_POST['etalase'][$i];
    $preorder = $_POST['preorder'][$i];
    $kondisi = $_POST['kondisi'][$i];
    $img1 = $_POST['img1'][$i];
    $img2 = $_POST['img2'][$i];
    $img3 = $_POST['img3'][$i];
    $img4 = $_POST['img4'][$i];
    $img5 = $_POST['img5'][$i];
    $vid1 = $_POST['vid1'][$i];
    $vid2 = $_POST['vid2'][$i];
    $vid3 = $_POST['vid3'][$i];
    $sku = $_POST['sku'][$i];
    $status = $_POST['status'][$i];
    $stok = $_POST['stok'][$i];
    $harga = $_POST['harga'][$i];
    $kurir = $_POST['kurir'][$i];
    $asuransi = $_POST['asuransi'][$i];
    $varian = $_POST['varian'][$i];

    $sql = "UPDATE Upload_tokopedia SET 
    produk_name='" . $produk_name . "',
    deskripsi ='".$desc."',
    kategori = '".$kategori."',
    berat = '".$berat."',
    min_pembelian = '".$min_pembelian."',
    etalase = '".$etalase."',
    preorder = '".$preorder."',
    kondisi = '".$kondisi."',
    img1 = '".$img1."',
    img2 = '".$img2."',
    img3 = '".$img3."',
    img4 = '".$img4."',
    img5 = '".$img5."',
    vid1 = '".$vid1."',
    vid2 = '".$vid2."',
    vid3 = '".$vid3."',
    sku = '".$sku."',
    status = '".$status."',
    stok = '".$stok."',
    Harga = '".$harga."',
    kurir = '".$kurir."',
    asuransi = '".$asuransi."',
    varian = '".$varian."'
    WHERE id='" . $id . "'";
    if (mysqli_query($con, $sql)) {
        $berhasil++;
    } else {
        $gagal++;
    }
    $i++;
}
echo "berhasil : ".$berhasil;
