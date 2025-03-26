<?php
$query = "SELECT itin.negara, LT_itinerary2.id as tour_id, LT_itinerary2.judul, 
          LT_itinerary2.landtour, LT_itinerary2.hari, LT_add_Category.category, 
          login_staff.name as staff_name, login_staff.phone 
          FROM ( SELECT * FROM LT_itinnew WHERE LT_itinnew.agent_twn != '0' 
          AND LT_itinnew.statuss != 'E' GROUP BY LT_itinnew.kode ) AS itin 
          INNER JOIN LT_itinerary2 ON itin.kode = LT_itinerary2.landtour 
          LEFT JOIN LT_add_Category ON LT_itinerary2.id = LT_add_Category.tour_id 
          INNER JOIN login_staff ON LT_itinerary2.status = login_staff.id 
          WHERE LT_itinerary2.landtour != 'undefined' 
          ORDER BY itin.negara ASC";

$rs = mysqli_query($con, $query);
$data_negara = [];

while ($row = mysqli_fetch_assoc($rs)) {
    $negara_bersih = str_replace([' – ', '—', '-'], ',', $row['negara']);
    $list_negara = explode(',', $negara_bersih);

    foreach ($list_negara as $negara) {
        $negara = trim($negara);
        if (!empty($negara) && !isset($data_negara[$negara])) {
            $data_negara[$negara] = [];
        }
        $data_negara[$negara][] = $row;
    }
}
?>
<div class="container mx-auto py-10 px-6">
    <div class="flex items-center justify-between mb-6">
        <!-- Title (Left) -->
        <h1 class="text-2xl font-bold text-gray-800">Eksplorasi Dunia dengan Harga Terjangkau: Daftar Paket Landtour</h1>

        <!-- Search Form (Right) -->
        <div class="relative w-full max-w-xs">
            <!-- Search Label -->
            <label for="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-600 font-medium transition-all duration-300 ease-in-out opacity-70 hover:opacity-100"></label>

            <!-- Search Input -->
            <input type="text" id="search" class="w-full py-3 pl-10 pr-4 border rounded-lg bg-gray-100 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-md hover:shadow-lg transition-all duration-300 ease-in-out" placeholder="Search by country..." onkeyup="searchCountry()">
        </div>
    </div>

    <!-- Swiper -->
    <div class="swiper landtourSwiper">
        <div class="swiper-wrapper">
            <?php
            foreach ($data_negara as $negara => $paket) {
                $imageName = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '_', $negara)) . ".jpg";
                $imagePath = "img/flag/" . $imageName;

                if (!file_exists($imagePath)) {
                    $imagePath = "img/flag/default.jpg";
                }
            ?>
                <div class="swiper-slide relative group cursor-pointer transition-all rounded-lg shadow-md overflow-hidden w-72 h-[380px] bg-white border border-gray-200 flex flex-col" data-country="<?php echo $negara; ?>">
                    <img src="<?= htmlspecialchars($imagePath) ?>" class="w-full h-64 object-cover transition duration-300 group-hover:scale-105" alt="Paket <?php echo htmlspecialchars($negara); ?>">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col items-left justify-end text-white p-4">
                        <h5 class="text-xl font-bold"><?php echo htmlspecialchars($negara); ?></h5>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Navigation Buttons -->
        <div class="swiper-button-prev prev-landtour"></div>
        <div class="swiper-button-next next-landtour"></div>
    </div>

    <!-- Tempat untuk menampilkan hasil landtour -->
    <div id="landtour-container" class="mt-6"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper2 = new Swiper(".landtourSwiper", {
        slidesPerView: 1.1,
        spaceBetween: 10,
        navigation: {
            nextEl: ".next-landtour",
            prevEl: ".prev-landtour",
        },
        breakpoints: {
            640: {
                slidesPerView: 4.2
            },
            1024: {
                slidesPerView: 6.2
            },
        },
    });

    function searchCountry() {
        const searchQuery = document.getElementById('search').value.toLowerCase();
        const items = document.querySelectorAll('.country-item');

        items.forEach(item => {
            const countryName = item.getAttribute('data-country');
            if (countryName.includes(searchQuery)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
<script>
    document.querySelectorAll('.swiper-slide').forEach(card => {
        card.addEventListener('click', function() {
            const country = this.getAttribute('data-country');
            window.location.href = `land-tour.php?negara=${encodeURIComponent(country)}`;
        });
    });
</script>