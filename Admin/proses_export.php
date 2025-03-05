
<?php

include "../site.php";
include "../db=connection.php";
include "../Activity/Api/Api_request.php";
session_start();
$id = $_POST['country'];
if ($_POST['page'] == "") {
    $page = 1;
} else {
    $page = $_POST['page'];
}
$kata = $_POST['kata'];
$category = $_POST['category'];
$nama_cat = "";

if ($category == "1") {
    $nama_cat = "F&B";
} else if ($category == "2") {
    $nama_cat = "Attraction";
} else if ($category == "3") {
    $nama_cat = "WiFi & SIM Card";
} else if ($category == "4") {
    $nama_cat = "Others";
} else if ($category == "5") {
    $nama_cat = "Lifestyle";
} else if ($category == "6") {
    $nama_cat = "Entertainment";
} else if ($category == "7") {
    $nama_cat = "Events";
} else if ($category == "8") {
    $nama_cat = "Tours";
} else if ($category == "9") {
    $nama_cat = "Transportation";
} else {
    $nama_cat = "All";
}
$datareq3 = array(
    "type" => $_SESSION['type'],
    "token" => $_SESSION['token'],
    "url" => "https://sg-api.globaltix.com/api/country/getAllListingCountry"
);
$country = get_country($datareq3);
$result_country = json_decode($country, true);
$negara = "";
// var_dump($result_country['data']['id']);
foreach ($result_country['data'] as $val_country) {
    $idn = $val_country['id'];
    if ($id == strval($idn)) {
        $negara = $val_country['name'];
    }
}
$jud = $negara . " " . $nama_cat . " " . " Page " . $page . " " . $kata;

$columnHeader = '';
$columnHeader = "No" . "\t" . "Nama Produk" . "\t" . "Deskripsi" . "\t" . "Kategori" . "\t" . "Berat" . "\t" . "Minimum Pemesanan" . "\t" . "NO Etalase" . "\t" . "Waktu Proses" . "\t" . "Kondisi" . "\t" . "Foto P1" . "\t" . "Fota P2" . "\t" . "Foto P3" . "\t" . "Foto P4" . "\t" . "Foto P5" . "\t" . "Vidio P1" . "\t" . "Vidio P2" . "\t" . "Vidio P3" . "\t" . "SKU Produk" . "\t" . "Status" . "\t" . "Stok" . "\t" . "Harga" . "\t" . "Kurir" . "\t" . "Asuransi" . "\t";
$setData = '';

$url = "https://sg-api.globaltix.com/api/product/list?countryId=" . $id . "&cityIds=all&categoryIds=all&searchText=" . $kata . "&page=" . $page . "&lang=id";
$url = str_replace(" ", "%20", $url);
// var_dump($url);
$datareq = array(
    "type" => $_SESSION['type'],
    "token" => $_SESSION['token'],
    "url" => $url,
);
$atraction = get_actractions($datareq);
$result_atraction = json_decode($atraction, true);
$val_arr = [];
foreach ($result_atraction['data'] as $atc) {
    $datareq2 = array(
        "type" => $_SESSION['type'],
        "token" => $_SESSION['token'],
        "url" => $atc['id']
    );
    /// product info
    $info = get_product_info($datareq2);
    $result_info = json_decode($info, true);
    $hasil_info = $result_info['data'];

    /// product option
    $detail = get_detail($datareq2);
    $results_detail = json_decode($detail, true);
    foreach ($results_detail['data'] as $detail_value) {
        if ($detail_value != null) {
            foreach ($detail_value['ticketType'] as $ticket_type) {

                $up_ticket = $ticket_type['nettPrice'] * 0.15;
                $final_price_ticket = $ticket_type['nettPrice'] + $up_ticket;
                $up5 = $ticket_type['originalPrice'] * 0.05;
                $coret = $ticket_type['originalPrice'] + $up5;
                $coret = ceil($coret);

                $final_price = ceil($final_price);
                $final_price_ticket = ceil($final_price_ticket);

                if ($final_price_ticket > $ticket_type['originalPrice']) {
                    $final_price_ticket = $ticket_type['originalPrice'];
                }
                $des = $detail_value['description'];
                $des = str_replace("\n", "<br/>", $des);

                $trem = $detail_value['termsAndConditions'];
                $trem = str_replace("\n", "<br/>", $trem);

                $validity = $detail_value['ticketValidity'];
                $validity = str_replace("\n", "<br/>", $validity);



                $description = "";
                $description .= "<b>Description</b></br>";
                $description .= $des;
                $description .= "<br/></br>";
                $description .= "<b>Validity</b></br>";
                $description .= $validity;
                $description .= "</br></br>";
                $description .= "<b>Terms & Conditions</b></br>";
                $description .= $trem;

                $produk_name = $atc['name'] . " - " . $detail_value['name'] . "(" . $ticket_type['name'] . ")";

                $g1 = "";
                $g2 = "";
                $g3 = "";
                $g4 = "";
                $g5 = "";
                if ($id == "2") {
                    $kategori = 4588;
                } else {
                    $kategori = 4589;
                }
                if ($atc['image'] != "") {
                    $g1 = "https://sg-api.globaltix.com/api/image?name=" . $atc['image'];
                }
                if ($hasil_info['media'][0]['path'] != "") {
                    $g2 = "https://sg-api.globaltix.com/api/image?name=" . $hasil_info['media'][0]['path'];
                }
                if ($hasil_info['media'][1]['path'] != "") {
                    $g3 = "https://sg-api.globaltix.com/api/image?name=" . $hasil_info['media'][1]['path'];
                }
                if ($hasil_info['media'][2]['path'] != "") {
                    $g4 = "https://sg-api.globaltix.com/api/image?name=" . $hasil_info['media'][2]['path'];
                }
                if ($hasil_info['media'][3]['path'] != "") {
                    $g5 = "https://sg-api.globaltix.com/api/image?name=" . $hasil_info['media'][3]['path'];
                }
                $array = array(
                    "nama_produk" =>  $produk_name,
                    "deskripsi" => $description,
                    "kategori" => $kategori,
                    "berat" => "100",
                    "min_pesan" => 1,
                    "no_etalase" => 34655567,
                    "waktu_proses" => 7,
                    "kondisi" => "Baru",
                    "gambar_1" => $g1,
                    "gambar_2" => $g2,
                    "gambar_3" => $g3,
                    "gambar_4" => $g4,
                    "gambar_5" => $g5,
                    "vid_1" => "",
                    "vid_2" => "",
                    "vid_3" => "",
                    "sku" => $ticket_type['sku'],
                    "status" => "Aktif",
                    "stok" => "100",
                    "harga" => $final_price_ticket,
                    "kurir" => "50",
                    "asuransi" => "opsional",
                );
                array_push($val_arr, $array);
            }
        }
    }
}

$no = 1;
foreach ($val_arr as $value) {
    $valuex = $no . "\t" . $value['nama_produk'] . " \t" . $value['deskripsi'] . " \t".$value['kategori']."\t".$value['berat']."\t" . $value['min_pesan'] . " \t" . $value['no_etalase'] . " \t" . $value['waktu_proses'] . " \t" . $value['kondisi'] . " \t" . $value['gambar_1'] . " \t" . $value['gambar_2'] . " \t" . $value['gambar_3'] . "\t" . $value['gambar_4'] . "\t" . $value['gambar_5'] . " \t" . $value['vid_1'] . "\t" . $value['vid_2'] . " \t" . $value['vid_3'] . " \t" . $value['sku'] . "\t" . $value['status'] . "\t" . $value['stok'] . "\t" . $value['harga'] . "\t" . $value['kurir'] . " \t" . $value['asuransi'];
    $setData .= trim($valuex) . "\n";
    $no++;
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$jud.".xls");
header("Pragma: no-cache");
header("Expires: 0");
echo ucwords($columnHeader) . "\n" . $setData . "\n";
?>