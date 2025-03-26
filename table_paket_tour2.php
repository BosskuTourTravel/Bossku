<?php
// Pastikan koneksi database ($conn atau $con) sudah didefinisikan sebelumnya
$countries = [];
$country = isset($_GET['country']) ? $con->real_escape_string($_GET['country']) : '';

// Query untuk mendapatkan jumlah trip per negara
$query = "SELECT negara, COUNT(*) as total_trip FROM paket_tour_online GROUP BY negara ORDER BY negara ASC";
$result = $con->query($query); // Gunakan $conn agar konsisten

// Debug: Cek apakah query benar
// echo "<pre>$query</pre>";

while ($row = $result->fetch_assoc()) {
    $splitCountries = explode(" - ", $row['negara']); // Pisahkan negara yang digabung
    foreach ($splitCountries as $country) {
        $country = trim($country);
        if (!isset($countries[$country])) {
            $countries[$country] = $row['total_trip']; // Simpan jumlah trip
        } else {
            $countries[$country] += $row['total_trip']; // Tambah jumlah trip jika ada negara yang sama
        }
    }
}
?>

<div class="container mx-auto py-10 px-6">
    <!-- Search Form -->
    <div class="flex justify-between items-center mb-5">
        <!-- Title (Left) -->
        <h2 class="text-2xl font-bold mb-5">Eksplorasi Dunia dengan Paket Tour Kami</h2>

        <!-- Search Form (Right) -->
        <div class="relative w-full max-w-xs">
            <!-- Search Label -->
            <label for="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-pink-600 font-medium transition-all duration-300 ease-in-out opacity-70 hover:opacity-100"></label>

            <!-- Search Input -->
            <input type="text" id="search" class="w-full py-3 pl-10 pr-4 border rounded-lg bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-700 shadow-md hover:shadow-lg transition-all duration-300 ease-in-out" placeholder="Search by country..." onkeyup="searchCountry()">
        </div>
    </div>

    <!-- Swiper Slider -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php
            foreach ($countries as $country => $totalTrip) {
                $imageName = strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '_', $country), '_')) . ".jpg";
                $imagePath = "img/flag/" . $imageName;

                // Cek apakah gambar ada
                if (!file_exists($imagePath)) {
                    $imagePath = "img/flag/default.jpg";
                }
                // echo $imagePath;
            ?>
                <div class="swiper-slide relative hover:scale-105 transition-all overflow-hidden rounded-lg shadow-lg">
                    <a href="paket-tour.php?country=<?php echo urlencode($country); ?>" class="block">
                        <img src="<?= htmlspecialchars($imagePath) ?>" class="w-full h-64 object-cover" alt="Paket <?php echo htmlspecialchars($country); ?>">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col items-left justify-end text-white p-4">
                            <h5 class="text-xl font-bold"><?php echo htmlspecialchars($country); ?></h5>
                            <p class="text-xs font-medium"><?php echo $totalTrip; ?> Paket Tour Tersedia</p>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <!-- Navigasi Swiper -->
        <div class="swiper-button-prev prev-myswiper"></div>
        <div class="swiper-button-next next-myswiper"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper1 = new Swiper(".mySwiper", {
        slidesPerView: 1.1,
        spaceBetween: 10,
        navigation: {
            nextEl: ".next-myswiper",
            prevEl: ".prev-myswiper",
        },
        breakpoints: {
            640: {
                slidesPerView: 3.2
            },
            1024: {
                slidesPerView: 4.2
            },
        },
    });

    // Function to search countries
    function searchCountry() {
        const searchQuery = document.getElementById('search').value.toLowerCase();
        const items = document.querySelectorAll('.swiper-slide');

        items.forEach(item => {
            const countryName = item.getAttribute('data-country').toLowerCase();
            if (countryName.includes(searchQuery)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>

<style>
    .swiper-button-next,
    .swiper-button-prev {
        width: 48px !important;
        height: 48px !important;
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background-color: rgba(0, 0, 0, 0.8);
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 24px !important;
        color: white !important;
    }
</style>