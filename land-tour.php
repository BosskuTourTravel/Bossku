<?php
include 'db=connection.php'; // Pastikan koneksi database benar

// Ambil negara dari URL dan filter input
$negara = isset($_GET['negara']) ? mysqli_real_escape_string($con, $_GET['negara']) : '';

// Query untuk mendapatkan landtour berdasarkan negara yang dipilih
$query = "SELECT itin.negara, LT_itinerary2.id as tour_id, LT_itinerary2.judul, 
          LT_itinerary2.landtour, LT_itinerary2.hari, LT_add_Category.category, 
          login_staff.name as staff_name, login_staff.phone 
          FROM ( SELECT * FROM LT_itinnew WHERE LT_itinnew.agent_twn != '0' 
          AND LT_itinnew.statuss != 'E' GROUP BY LT_itinnew.kode ) AS itin 
          INNER JOIN LT_itinerary2 ON itin.kode = LT_itinerary2.landtour 
          LEFT JOIN LT_add_Category ON LT_itinerary2.id = LT_add_Category.tour_id 
          INNER JOIN login_staff ON LT_itinerary2.status = login_staff.id 
          WHERE LT_itinerary2.landtour != 'undefined'
          AND FIND_IN_SET('$negara', REPLACE(itin.negara, ' - ', ','))
          ORDER BY itin.negara ASC";

$rs = mysqli_query($con, $query);
$data_landtour = mysqli_fetch_all($rs, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<?php
include "header.php";
include "navbar.php";
?>

<body class="bg-gray-50">
    <div class="container mx-auto py-12 px-4 sm:px-6">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-3">
                Paket Landtour di <?= htmlspecialchars($negara) ?>
            </h1>
            <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full"></div>
        </div>

        <?php if (empty($data_landtour)) { ?>
            <div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-md text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-red-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-lg font-medium text-gray-700">
                    Maaf, saat ini tidak ada paket landtour untuk negara ini.
                </p>
                <p class="text-gray-500 mt-2">
                    Silakan cek kembali nanti atau hubungi kami untuk informasi lebih lanjut.
                </p>
            </div>
        <?php } else { ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($data_landtour as $tour) {
                    $url_encode = urlencode("Halo, saya tertarik dengan paket landtour *{$tour['judul']}* di *{$negara}*. Bisa minta informasi lebih lanjut?");
                ?>
                    <div class="card group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition-transform duration-300 transform hover:-translate-y-2 hover:scale-105">
                        <div class="relative h-48 bg-gradient-to-r from-blue-500 to-blue-700 flex flex-col justify-between px-6 py-4">
                            <!-- Overlay Gelap -->
                            <div class="absolute inset-0 bg-black opacity-20"></div>

                            <!-- Judul -->
                            <h3 class="relative z-10 text-xl sm:text-2xl font-bold text-white text-center px-4 leading-tight max-h-16 min-h-12 overflow-hidden whitespace-normal break-words line-clamp-2">
                                <?= htmlspecialchars($tour['judul']) ?>
                            </h3>

                            <!-- Label Hari (di bagian bawah) -->
                            <div class="relative z-10 self-end bg-white text-blue-700 px-3 py-1 rounded-full text-sm font-semibold shadow-md">
                                <?= htmlspecialchars($tour['hari']) ?> hari
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <p class="text-sm text-gray-500 font-medium">Kode Tour</p>
                                    <p class="text-gray-700 font-semibold"><?= htmlspecialchars($tour['landtour']) ?></p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500 font-medium">Destinasi</p>
                                    <p class="text-gray-700 font-semibold"><?= htmlspecialchars($negara) ?></p>
                                </div>
                            </div>

                            <!-- Hidden details on hover -->
                            <div class="mt-4 pt-4 border-t border-gray-100 group-hover:block hidden transition-all duration-300">
                                <p class="text-gray-600 text-sm mb-2">
                                    <span class="font-medium">Highlight:</span> Deskripsi singkat tentang tour bisa ditambahkan di sini.
                                </p>
                                <p class="text-gray-600 text-sm">
                                    <span class="font-medium">Include:</span> Transportasi, Hotel, Makan, dll.
                                </p>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="px-6 pb-6">
                            <div class="flex justify-center gap-3 px-6 mb-6"> <!-- Tambahkan `mb-6` di sini -->
                                <!-- Print Button -->
                                <a href="<?= $domain_web ?>Admin/cetak_all_LTnew.php?id=<?= $tour['tour_id'] ?>" target="_blank"
                                    class="px-3 py-2 bg-[#02335B] text-white font-semibold rounded-md shadow-md hover:bg-white hover:text-[#02335B] border border-[#02335B] focus:outline-none focus:ring-2 focus:ring-[#02335B] transition-all duration-200 flex items-center gap-2">
                                    <i class="fa fa-print text-lg"></i>
                                        <span>Print</span>
                                </a>

                                <!-- WhatsApp Button -->
                                <a href="https://wa.me/628112557728?text=<?= $url_encode ?>" target="_blank"
                                    class="px-3 py-2 bg-[#FFCA10] text-black font-bold rounded-md shadow-md hover:bg-[#02335B] hover:text-[#FFCA10] focus:outline-none focus:ring-2 focus:ring-[#FFCA10] transition-all duration-200 flex items-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-lg"></i>
                                    <span>WhatsApp</span>
                                </a>

                                <!-- Detail Button -->
                                <a href="<?= $domain_web ?>detail-landtour.php?id=<?= isset($tour['id']) ? htmlspecialchars($tour['id']) : '' ?>&master=<?= isset($tour['tour_id']) ? htmlspecialchars($tour['tour_id']) : '' ?>"
                                    class="px-3 py-2 text-white font-semibold rounded-md shadow-md hover:bg-white focus:outline-none focus:ring-2 focus:ring-[#60033B] transition-all duration-300 transform hover:scale-105 flex items-center gap-2"
                                    style="background-color: #60033B;">
                                    <i class="fa fa-info-circle text-lg"></i>
                                    <span>Detail</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</body>



</html>