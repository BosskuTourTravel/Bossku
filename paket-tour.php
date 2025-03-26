<?php
include(__DIR__ . '/db=connection.php');
include "slug.php";
//include "API/Api_LT_total_baru.php";

$limit = 9;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, $page);
$offset = ($page - 1) * $limit;

// Validasi input country
$country = isset($_GET['country']) ? mysqli_real_escape_string($con, $_GET['country']) : '';

// Hitung total data
$totalQuery = "SELECT COUNT(*) as total FROM paket_tour_online";
if (!empty($country)) {
    $totalQuery .= " WHERE negara = '$country'";
}
$totalResult = mysqli_query($con, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$totalData = $totalRow['total'] ?? 0;
$totalPages = max(1, ceil($totalData / $limit));

// Query untuk mendapatkan paket tour
$query = "SELECT DISTINCT paket_tour_online.id, 
                    paket_tour_online.gt,
                    paket_tour_online.*, 
                    LTSUB_itin.judul, 
                    LTSUB_itin.landtour, 
                    paket_tour_online.negara, 
                    LT_change_judul.nama AS change_judul, 
                    LTP_insert_sfee.ket AS staff_id, 
                    login_staff.name AS staff_name, 
                    login_staff.phone 
          FROM paket_tour_online 
          INNER JOIN LTSUB_itin ON paket_tour_online.tour_id = LTSUB_itin.id 
          LEFT JOIN LT_change_judul ON paket_tour_online.tour_id = LT_change_judul.copy_id 
              AND paket_tour_online.grub_id = LT_change_judul.grub_id 
          INNER JOIN LTP_insert_sfee ON paket_tour_online.sfee_id = LTP_insert_sfee.id 
          INNER JOIN login_staff ON LTP_insert_sfee.ket = login_staff.id";


if (!empty($country)) {
    $query .= " WHERE paket_tour_online.negara LIKE '%$country%'";
}

$query .= " GROUP BY paket_tour_online.id LIMIT $limit OFFSET $offset";
$rs = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<?php
include "header.php";
include "navbar.php";
?>

<head>
    <title>Paket Tour</title>
</head>

<body>
    <div class="container mx-auto py-10 px-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Paket Tour <?= !empty($country) ? "untuk " . htmlspecialchars($country) : "" ?>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while ($row = mysqli_fetch_assoc($rs)) {
                $judul = !empty($row['change_judul']) ? $row['change_judul'] : $row['judul'];

                // Query keberangkatan
                $query_cek = "SELECT DISTINCT paket_tour_online.start, paket_tour_online.promo 
                              FROM paket_tour_online 
                              LEFT JOIN LTSUB_itin ON paket_tour_online.tour_id = LTSUB_itin.id 
                              WHERE LTSUB_itin.landtour = '" . mysqli_real_escape_string($con, $row['landtour']) . "' 
                              ORDER BY paket_tour_online.start ASC, paket_tour_online.promo ASC";

                $rs_cek = mysqli_query($con, $query_cek);
                $keberangkatan = [];

                while ($row_cek = mysqli_fetch_assoc($rs_cek)) {
                    $start = !empty($row_cek['start']) ? $row_cek['start'] : 'Undefined';
                    switch ($start) {
                        case "BTH":
                            $kota = "Batam";
                            break;
                        case "SUB":
                            $kota = "Surabaya";
                            break;
                        case "CGK":
                            $kota = "Jakarta";
                            break;
                        case "DPS":
                            $kota = "Denpasar";
                            break;
                        default:
                            $kota = "Tidak diketahui";
                    }


                    $promoType = !empty($row_cek['promo']) ? $row_cek['promo'] : 'Undefined';
                    switch ($promoType) {
                        case "p_ls":
                            $promo = "Low Seasons";
                            break;
                        case "p_ny":
                            $promo = "New Years";
                            break;
                        case "p_lebaran":
                            $promo = "Lebaran";
                            break;
                        case "p_sh":
                            $promo = "School Holiday";
                            break;
                        default:
                            $promo = "Tidak diketahui";
                    }


                    $keberangkatan[] = "$kota - $promo";
                }

                $keberangkatan = array_unique($keberangkatan); // Menghapus duplikat

            ?>
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 border border-gray-200">
                    <!-- Judul Paket -->
                    <h3 class="text-xl font-semibold text-blue-700 mb-2">
                        <?= htmlspecialchars($judul) ?>
                    </h3>

                    <!-- Harga Paket -->
                    <p class="text-lg font-bold text-red-500">
                        IDR <?= isset($row['gt']) ? number_format($row['gt'], 0, ',', '.') : 'Harga tidak tersedia' ?>
                    </p>

                    <div class="space-y-3 mt-3">
                        <!-- Landtour -->
                        <p class="text-gray-600 flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 12l4.243-4.243m-6.829 8.486L6.343 12l4.243-4.243"></path>
                            </svg>
                            <strong>Kode Tour : </strong> <?= htmlspecialchars($row['landtour']) ?>
                        </p>

                        <!-- Keberangkatan -->
                        <p class="text-gray-600 flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m9-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <strong>Keberangkatan:</strong> <?= implode(" | ", $keberangkatan) ?>
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2 mt-3">
                        <!-- Tombol WhatsApp -->
                        <a href="https://wa.me/628112557728?text=<?= urlencode('Saya tertarik dengan paket: ' . $judul) ?>" target="_BLANK"
                            class="px-3 py-2 bg-[#FFCA10] text-black font-bold rounded-md shadow-md hover:bg-[#02335B] hover:text-[#FFCA10] focus:outline-none focus:ring-2 focus:ring-[#FFCA10] transition-all duration-200 flex items-center gap-2">
                            <i class="fa-brands fa-whatsapp text-lg"></i> WhatsApp
                        </a>

                        <!-- Tombol Print -->
                        <a href="Admin/cetak_pt_website.php?id=<?= $row['id'] ?>" target="_BLANK"
                            class="px-3 py-2 bg-[#02335B] text-white font-semibold rounded-md shadow-md hover:bg-white hover:text-[#02335B] border border-[#02335B] focus:outline-none focus:ring-2 focus:ring-[#02335B] transition-all duration-200 flex items-center gap-2">
                            <i class="fa fa-print text-lg"></i> Print
                        </a>

                        <!-- Tombol Detail -->
                        <a href="<?= $domain_web ?>detail-paket-tour.php?id=<?= $row['id'] ?>&master=<?= $row['tour_id'] ?>"
                            class="px-3 py-2 text-white font-semibold rounded-md shadow-md hover:bg-white focus:outline-none focus:ring-2 focus:ring-[#60033B] transition-all duration-300 transform hover:scale-105 flex items-center gap-2"
                            style="background-color: #60033B;">
                            <i class="fa fa-info-circle text-lg"></i> Detail
                        </a>
                    </div>


                </div>
            <?php } ?>
        </div>
        <!-- Pagination -->
        <div class="flex justify-center mt-8">
            <nav class="inline-flex space-x-2">
                <!-- Tombol Previous -->
                <?php if ($page > 1) : ?>
                    <a href="?page=<?= $page - 1 ?>&country=<?= urlencode($country) ?>"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                        « Previous
                    </a>
                <?php endif; ?>

                <!-- Nomor Halaman dengan Ellipsis -->
                <?php
                $range = 2; // Banyaknya angka di sekitar halaman aktif
                $ellipsisAdded = false;

                for ($i = 1; $i <= $totalPages; $i++) :
                    if ($i == 1 || $i == $totalPages || ($i >= $page - $range && $i <= $page + $range)) :
                        $ellipsisAdded = false; ?>
                        <a href="?page=<?= $i ?>&country=<?= urlencode($country) ?>"
                            class="px-4 py-2 rounded-md <?= $i == $page ? 'bg-[#02335B] text-white font-bold' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' ?>">
                            <?= $i ?>
                        </a>
                    <?php elseif (!$ellipsisAdded) :
                        $ellipsisAdded = true; ?>
                        <span class="px-3 py-2 text-gray-500">...</span>
                <?php endif;
                endfor; ?>

                <!-- Tombol Next -->
                <?php if ($page < $totalPages) : ?>
                    <a href="?page=<?= $page + 1 ?>&country=<?= urlencode($country) ?>"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                        Next »
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</body>

</html>