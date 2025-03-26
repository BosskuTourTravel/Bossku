<?php
$query = "SELECT itin.negara, COUNT(LT_itinerary2.id) AS total_trip, 
LT_itinerary2.id as tour_id, LT_itinerary2.judul, 
LT_itinerary2.landtour, LT_itinerary2.hari, LT_add_Category.category, 
login_staff.name as staff_name, login_staff.phone 
FROM ( SELECT * FROM LT_itinnew WHERE LT_itinnew.agent_twn != '0' 
AND LT_itinnew.statuss != 'E' GROUP BY LT_itinnew.kode ) AS itin 
INNER JOIN LT_itinerary2 ON itin.kode = LT_itinerary2.landtour 
LEFT JOIN LT_add_Category ON LT_itinerary2.id = LT_add_Category.tour_id 
INNER JOIN login_staff ON LT_itinerary2.status = login_staff.id 
WHERE LT_itinerary2.landtour != 'undefined' 
GROUP BY itin.negara, LT_itinerary2.id
HAVING COUNT(LT_itinerary2.id) > 0
ORDER BY itin.negara ASC";

$rs = mysqli_query($con, $query);
$data_negara = [];

while ($row = mysqli_fetch_assoc($rs)) {
    $negara_bersih = str_replace([' – ', '—', '-'], ',', $row['negara']);
    $list_negara = array_map('trim', explode(',', $negara_bersih));

    foreach ($list_negara as $negara) {
        $negara = trim($negara); // Bersihkan spasi

        if (!empty($negara) && !empty($row['tour_id'])) { // Hanya negara dengan trip
            if (!isset($data_negara[$negara])) {
                $data_negara[$negara] = [];
            }
            $data_negara[$negara][] = $row;
        }
    }
}

// Debugging untuk memastikan data trip benar-benar ada
// echo "<pre>";
// print_r($data_negara);
// echo "</pre>";
// exit;
?>

<div class="container mx-auto py-10 px-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Eksplorasi Dunia dengan Harga Terjangkau: Daftar Paket Landtour</h1>

        <div class="relative w-full max-w-xs">
            <input type="text" id="search" class="w-full py-3 pl-10 pr-4 border rounded-lg bg-gray-100 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-md hover:shadow-lg transition-all duration-300 ease-in-out" placeholder="Search by country..." onkeyup="searchCountry()">
        </div>
    </div>

    <div class="swiper landtourSwiper">
        <div class="swiper-wrapper">
            <?php foreach ($data_negara as $negara => $paket) { 
                if (empty($paket)) continue; // Lewati negara tanpa trip
                
                $imageName = strtolower(preg_replace('/[^a-zA-Z0-9]+/', '_', $negara)) . ".jpg";
                $imagePath = "img/flag/" . $imageName;

                if (!file_exists($imagePath)) {
                    $imagePath = "img/flag/default.jpg";
                }
            ?>
                <div class="swiper-slide relative group cursor-pointer transition-all rounded-lg shadow-md overflow-hidden w-72 h-[380px] bg-white border border-gray-200 flex flex-col" data-country="<?php echo htmlspecialchars($negara); ?>">
                    <img src="<?= htmlspecialchars($imagePath) ?>" class="w-full h-64 object-cover transition duration-300 group-hover:scale-105" alt="Paket <?php echo htmlspecialchars($negara); ?>">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col items-left justify-end text-white p-4">
                        <h5 class="text-xl font-bold"><?php echo htmlspecialchars($negara); ?></h5>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="swiper-button-prev prev-landtour"></div>
        <div class="swiper-button-next next-landtour"></div>
    </div>

    <!-- Container untuk menampilkan hasil trip ketika card diklik -->
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

    // JavaScript untuk menampilkan daftar trip ketika card diklik
    document.querySelectorAll('.swiper-slide').forEach(card => {
    card.addEventListener('click', function() {
        const country = this.getAttribute('data-country');
        window.location.href = `land-tour.php?negara=${encodeURIComponent(country)}`;
    });
});

</script>