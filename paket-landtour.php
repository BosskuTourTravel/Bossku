<?php
include "header.php";
include "db=connection.php";
include "slug.php";
include "navbar.php";
include "API/Price/Api_LT_total_baru.php";
?>

<?php
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;  // Jika tidak ada parameter 'page', set default ke 1
$limit = 10;  // Jumlah data per halaman
$offset = ($page - 1) * $limit;

// Ambil total data dari database
$query_total_data = "SELECT COUNT(*) AS total FROM paket_tour_online";  // Sesuaikan dengan nama tabel Anda
$result_total_data = mysqli_query($con, $query_total_data);
$row_total_data = mysqli_fetch_assoc($result_total_data);
$total_data = $row_total_data['total'];

// Hitung total halaman
$total_pages = ceil($total_data / $limit);

$query = "SELECT LT_itinerary2.id as tour_id, LT_itinerary2.judul, LT_itinerary2.landtour, LT_itinerary2.hari, LT_itinerary2.status, itin.*, LT_add_Category.category, login_staff.name as staff_name, login_staff.phone FROM (SELECT * FROM LT_itinnew WHERE LT_itinnew.agent_twn !='0' AND LT_itinnew.statuss !='E' GROUP BY LT_itinnew.kode) AS itin INNER JOIN LT_itinerary2 ON itin.kode = LT_itinerary2.landtour LEFT JOIN LT_add_Category ON LT_itinerary2.id = LT_add_Category.tour_id INNER JOIN login_staff ON LT_itinerary2.status = login_staff.id WHERE LT_itinerary2.landtour !='undefined' ORDER BY itin.benua, itin.negara ASC LIMIT $limit OFFSET $offset ";

$rs = mysqli_query($con, $query);
?>

<div class="container mx-auto px-4 py-16 mt-10">
    <!-- Title -->
    <h1 class="text-[#02335B] text-lg font-semibold tracking-wide text-center mb-2">Paket Land Tour</h1>
    <h2 class="text-3xl font-bold tracking-wide text-center">Jelajahi Destinasi Menarik Bersama Kami</h2>
    <p class="font-medium text-sm tracking-wide text-center text-gray-500">Temukan paket wisata menarik di berbagai belahan dunia.</p>

    <div class="pt-5">
        <div class="overflow-x-auto">
            <table id="tb-lt-web" class="min-w-full text-sm border border-gray-300 shadow-lg rounded-lg">
                <thead class="bg-blue-600 text-white text-left">
                    <tr>
                        <th class="p-3 border-b">No</th>
                        <th class="p-3 border-b max-w-xs">Nama Paket</th>
                        <th class="p-3 border-b">Pax</th>
                        <th class="p-3 border-b">Price</th>
                        <th class="p-3 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = $offset + 1; // Menghitung nomor urut
                    while ($row = mysqli_fetch_array($rs)) {
                        $url_encode = urldecode("Haii " . $row['staff_name'] . ", Saya ingin Memesan LandTour : https://www.holidaymyboss.com/Admin/cetak_all_LTnew.php?id=" . $row['id']);
                        $data_twn = array("kurs" => $row['kurs'], "nominal" => $row['agent_twn']);
                        $show_kurs_twn = get_kurs($data_twn);
                        $rs_kurs_twn = json_decode($show_kurs_twn, true);
                        $agent_twn = $rs_kurs_twn['data'];

                        $sql_profit = "SELECT * FROM LT_itin_profit_range where price1 <='" . $agent_twn . "' && price2 >='" . $agent_twn . "'";
                        $rs_profit = mysqli_query($con, $sql_profit);
                        $row_profit = mysqli_fetch_array($rs_profit);

                        $pr = isset($row_profit['id']) ? $row_profit['profit'] : 5;
                        $twin = ($agent_twn * $pr / 100) + $agent_twn;
                        $twn_sp = get_pembulatan($twin);
                        $twn_rp = json_decode($twn_sp, true);
                    ?>
                        <tr class="border-t border-gray-300 hover:bg-gray-50">
                            <td class="p-3 text-center"><?php echo $no ?></td>
                            <td class="p-3">
                                <div class="font-semibold"><?php echo $row['judul'] ?></div>
                                <div class="text-sm text-gray-600"><?php echo $row['landtour'] ?></div>
                            </td>
                            <td class="p-3 text-center">
                                <?php
                                $pax_u = $row['pax_u'] != 0 ? "-" . $row['pax_u'] : "";
                                $pax_b = $row['pax_b'] != 0 ? "+" . $row['pax_b'] : "";
                                echo $row['pax'] . $pax_u . $pax_b;
                                ?>
                            </td>
                            <td class="p-3 text-center font-semibold text-green-600"><?php echo "Rp." . number_format($twn_rp['value'], 0, ",", ".") ?></td>
                            <td class="p-3 space-y-2">
                                <a class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs" href="Admin/cetak_all_LTnew.php?id=<?php echo $row['tour_id'] ?>" target="_BLANK"><i class="fa fa-print"></i> Print</a>
                                <a class="inline-block bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs" href="https://wa.me/<?php echo $row['phone'] . '?text=' . $url_encode ?>" target="_BLANK"><i class="fa fa-whatsapp"></i> Whatsapp</a>
                                <a class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs" href="<?php echo $domain_web ?>detail-landtour.php?id=<?php echo $row['id'] ?>&master=<?php echo $row['tour_id'] ?>"><i class="fa fa-info-circle"></i> Detail</a>
                            </td>
                        </tr>
                    <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
    <!-- Pagination -->
    <div class="mt-4 text-center text-sm text-gray-600">
        Menampilkan <?php echo mysqli_num_rows($rs); ?> dari <?php echo $total_data; ?> data.
    </div>
    <div class="mt-4 flex justify-center space-x-2 text-sm">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1 ?>" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Previous</a>
        <?php endif; ?>

        <?php
        $range = 1;
        $dots = false;
        for ($i = 1; $i <= $total_pages; $i++) {
            if (
                $i == 1 || $i == $total_pages ||
                ($i >= $page - $range && $i <= $page + $range)
            ) {
                if ($i == $page) {
                    echo '<span class="px-3 py-1 bg-blue-600 text-white rounded">' . $i . '</span>';
                } else {
                    echo '<a href="?page=' . $i . '" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">' . $i . '</a>';
                }
                $dots = true;
            } elseif ($dots) {
                echo '<span class="px-3 py-1">...</span>';
                $dots = false;
            }
        }
        ?>

        <?php if ($page < $total_pages): ?>
            <a href="?page=<?php echo $page + 1 ?>" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">Next</a>
        <?php endif; ?>
    </div>

</div>
