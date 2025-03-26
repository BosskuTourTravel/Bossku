<?php
include "db=connection.php";
include "slug.php";
include "API/Price/Api_LT_total_baru.php";
?>
<!DOCTYPE html>
<html lang="en">

<?php
include "header.php";
include "navbar.php";
$query = "SELECT consortium_list.*, country.img 
          FROM consortium_list 
          LEFT JOIN country ON consortium_list.country = country.name 
          WHERE consortium_list.continent='" . $_GET['id'] . "' 
          AND consortium_list.detail='" . $_GET['region'] . "' 
          AND consortium_list.country = '" . $_GET['country'] . "'";

$rs = mysqli_query($con, $query);
?>

<body class="bg-gray-50">
    <div class="relative">
        <img src="img/asia/IndonesiaThumb.jpg" alt="Region Map" class="w-full h-96 object-cover">
        <div class="absolute top-0 left-0 w-full h-full bg-black opacity-50"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center text-white z-10">
            <h1 class="text-4xl font-bold"><?php echo $_GET['country'] ?></h1>
        </div>
    </div>

    <div class="container mx-auto my-8 px-4">
        <h2 class="text-center text-3xl font-extrabold mb-6 text-gray-800">Trip <?php echo $_GET['country'] ?></h2>

        <!-- Search Input -->
        <div class="flex justify-center mb-6">
            <div class="relative">
                <input type="text" id="searchInput" class="w-full max-w-md py-3 px-4 pl-12 border border-gray-300 rounded-xl shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300" placeholder="Cari trip...">
                <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2.5-5.5a8.5 8.5 0 111-1 8.5 8.5 0 011 1z" />
                    </svg>
                </span>
            </div>
        </div>

        <!-- Trip Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8" id="tripContainer">
            <?php
            function getStartColor($start)
            {
                $colors = [
                    "Surabaya" => "#007bff",  // Biru
                    "Jakarta" => "#dc3545",  // Merah
                    "Bali" => "#28a745",  // Hijau
                    "Bandung" => "#17a2b8",  // Biru Muda
                    "Yogyakarta" => "#ffc107",  // Kuning
                ];
                return isset($colors[$start]) ? $colors[$start] : "#6c757d"; // Default Abu-abu
            }

            while ($row = mysqli_fetch_array($rs)) {
                // Konversi kurs
                $adt = 0;
                if ($row['kurs'] != "IDR") {
                    $datareq = array(
                        "kurs" => $row['kurs'],
                        "nominal" => $row['adt'],
                    );
                    $adt_kurs = get_kurs($datareq);
                    $rs_adt_kurs = json_decode($adt_kurs, true);
                    $adt = $rs_adt_kurs['data'];
                } else {
                    $adt = $row['adt'];
                }

                $link_gambar = $row['link_gambar'];

                if (strpos($link_gambar, 'drive.google.com') !== false) {
                    if (preg_match('/\/d\/(.*?)\//', $link_gambar, $matches) || preg_match('/id=([a-zA-Z0-9_-]+)/', $link_gambar, $matches)) {
                        if (!empty($matches[1])) {
                            $link_gambar = "https://lh3.googleusercontent.com/d/{$matches[1]}=s0";
                        }
                    }
                }
            ?>
                <div class="card bg-white rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <!-- Thumbnail Flyer -->
                    <?php if (!empty($link_gambar)) { ?>
                        <img src="<?php echo htmlspecialchars($link_gambar, ENT_QUOTES, 'UTF-8'); ?>" alt="Flyer <?php echo htmlspecialchars($row['nama'], ENT_QUOTES, 'UTF-8'); ?>" class="w-full h-64 object-cover rounded-t-lg">
                    <?php } ?>

                    <div class="p-6 text-center">
                        <!-- Nama Paket -->
                        <h5 class="text-xl font-semibold text-gray-800"><?php echo $row['nama'] ?></h5>

                        <!-- Start Location -->
                        <p class="text-sm text-gray-500 mt-2">
                            Start from:
                            <span class="px-3 py-1 rounded-full text-black font-bold" style="background-color: <?php echo getStartColor($row['start']); ?>;">
                                <?php echo $row['start']; ?>
                            </span>
                        </p>

                        <!-- Harga -->
                        <div class="mt-4 bg-yellow-500 text-white py-2 px-4 rounded-full mx-auto">
                            <span class="text-lg font-semibold"><?php echo "IDR " . number_format($adt); ?></span>
                        </div>

                        <!-- Tombol -->
                        <div class="mt-4 space-y-3">
                            <a href="https://wa.me/628112557728?text=Halo Bossku" target="_blank" class="block bg-[#02335B] text-white py-2 px-6 rounded-lg text-lg font-semibold hover:bg-[#FFCA10] hover:text-[#02335B] transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-xl">
                                <i class="bi bi-whatsapp"></i> Pesan via WhatsApp
                            </a>

                            <?php if (!empty($row['link_pdf'])) { ?>
                                <a href="<?php echo $row['link_pdf']; ?>" target="_blank" class="block border border-[#02335B] text-[#02335B] py-2 px-6 rounded-lg text-lg font-semibold hover:bg-[#FFCA10] hover:text-[#02335B] transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-xl">
                                    <i class="bi bi-file-earmark-text"></i> Lihat Itinerary
                                </a>
                            <?php } ?>

                            <?php if (!empty($row['link_gambar'])) { ?>
                                <a href="<?php echo $row['link_gambar']; ?>" target="_blank" class="block border border-[#02335B] text-[#02335B] py-2 px-6 rounded-lg text-lg font-semibold hover:bg-[#FFCA10] hover:text-[#02335B] transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-xl">
                                    <i class="bi bi-image"></i> Lihat Flyer
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script>
        document.getElementById("searchInput").addEventListener("keyup", function() {
            let searchText = this.value.toLowerCase();
            let cards = document.querySelectorAll(".card");

            cards.forEach(card => {
                let title = card.querySelector("h5").innerText.toLowerCase();
                if (title.includes(searchText)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        });
    </script>
</body>

<?php
include "footer.php";
?>