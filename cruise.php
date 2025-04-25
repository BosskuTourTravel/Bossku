<?php
include "header.php";
include "navbar.php";
include "slug.php";
include "cruise-data.php"; // pastikan ini array $cruises sudah didefinisikan

function slugify($string)
{
    $string = strtolower(trim($string));
    $string = preg_replace('/[^a-z0-9-]/', '-', $string);
    $string = preg_replace('/-+/', '-', $string);
    return rtrim($string, '-');
}

function formatRupiah($angka)
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}
function formatUSD($angka)
{
    return "USD " . number_format($angka, 2, '.', ',');
}

// Pencarian
$search = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
$filteredCruises = array_filter($cruises, function ($cruise) use ($search) {
    return $search === '' || strpos(strtolower($cruise['country']), $search) !== false;
});

// Pagination
$perPage = 6;
$totalData = count($filteredCruises);
$totalPages = ceil($totalData / $perPage);
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, min($totalPages, $page));

$offset = ($page - 1) * $perPage;
$displayCruises = array_slice($filteredCruises, $offset, $perPage);
?>


<div class="container mx-auto px-4 py-16 mt-10">
    <!-- Title -->
    <h1 class="text-[#02335B] text-sm font-semibold tracking-wide text-center mb-2">Explore Cruises</h1>
    <h2 class="text-3xl font-bold tracking-wide text-center">Discover Your Perfect Cruise</h2>
    <p class="font-medium text-sm tracking-wide text-center text-gray-500">Let us help you find the ideal cruise experience tailored to your needs.</p>

    <form method="GET" class="w-full max-w-md mx-auto flex flex-wrap sm:flex-nowrap items-center gap-2 mt-8 px-4">
        <input
            type="text"
            name="search"
            placeholder="Cari cruise berdasarkan negara tujuan..."
            value="<?php echo htmlspecialchars($search); ?>"
            class="w-full sm:w-auto flex-grow border border-gray-300 px-5 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#02335B] focus:border-transparent transition duration-200 text-sm" />

        <button
            type="submit"
            class="w-full md:w-auto bg-[#02335B] text-white px-6 py-2 rounded-lg shadow hover:bg-[#035a8b] transition-all duration-200 text-sm">
            Cari
        </button>
    </form>



    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-10">

        <?php foreach ($displayCruises as $cruise):
            $cruiseName = $cruise['name'];
            $cruiseImage = $cruise['image'];
            $cruiseDescription = $cruise['description'];
            $currency = $cruise['currency']; // misalnya, 'IDR' atau 'USD'
            $cruisePrice = $cruise['price'];
            $cruiseCountry = $cruise['country'];
            $cruiseSlug = slugify($cruiseName);
        ?>
            <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col h-full">
                <img src="<?php echo $cruiseImage; ?>" alt="<?php echo $cruiseName; ?>" class="w-full h-48 object-cover">

                <div class="p-4 flex flex-col flex-grow">
                    <!-- Judul -->
                    <h3 class="text-xl font-bold text-[#02335B] leading-snug"><?php echo $cruiseName; ?></h3>

                    <!-- Deskripsi -->
                    <p class="text-sm text-gray-600 mt-2 tracking-wide leading-relaxed"><?php echo $cruiseDescription; ?></p>

                    <!-- Negara -->
                    <div class="mt-3">
                        <span class="inline-block bg-[#02335B] text-[#FFCA10] text-xs font-semibold px-3 py-1 rounded-full">
                            <?php echo $cruiseCountry; ?>
                        </span>
                    </div>

                    <!-- Harga -->
                    <div class="mt-3">
                        <span class="block text-lg font-semibold text-[#02335B] tracking-wide">
                            <?php
                            if ($currency === 'IDR') {
                                echo formatRupiah($cruisePrice);
                            } elseif ($currency === 'USD') {
                                echo formatUSD($cruisePrice);
                            }
                            ?>
                        </span>
                    </div>

                    <!-- Spacer agar tombol tetap di bawah -->
                    <div class="flex-grow"></div>

                    <!-- Tombol Aksi -->
                    <div class="mt-4 flex gap-2 flex-wrap justify-end">
                        <button onclick="openModal('<?php echo $cruiseImage; ?>')" class="text-sm font-semibold text-[#02335B] bg-[#FFCA10] px-4 py-2 rounded hover:bg-yellow-500 transition-all duration-200">
                            Lihat Gambar
                        </button>
                        <a href="cruise-details.php?slug=<?php echo $cruiseSlug; ?>" class="text-sm font-semibold text-white bg-[#02335B] px-4 py-2 rounded hover:bg-[#035a8b] transition-all duration-200">
                            View Details
                        </a>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-6 flex flex-col items-center justify-between gap-2 text-sm text-gray-600">
        <p>
            Menampilkan <?php echo ($offset + 1); ?> &ndash; <?php echo min($offset + $perPage, $totalData); ?> dari <?php echo $totalData; ?> produk
        </p>

        <!-- Pagination -->
        <div class="flex justify-center items-center space-x-2 text-[#02335B] font-medium">
            <?php if ($page > 1): ?>
                <a href="?search=<?php echo urlencode($search); ?>&page=<?php echo $page - 1; ?>" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">&laquo;</a>
            <?php endif; ?>

            <?php
            $visiblePages = [];
            if ($totalPages <= 7) {
                $visiblePages = range(1, $totalPages);
            } else {
                $visiblePages = array_unique(array_merge(
                    [1, 2],
                    range(max(1, $page - 1), min($totalPages, $page + 1)),
                    [$totalPages - 1, $totalPages]
                ));
                sort($visiblePages);
            }

            $lastPageShown = 0;
            foreach ($visiblePages as $i):
                if ($lastPageShown + 1 < $i) echo "<span class='px-2'>...</span>";
                $lastPageShown = $i;
            ?>
                <a href="?search=<?php echo urlencode($search); ?>&page=<?php echo $i; ?>"
                    class="px-3 py-1 rounded <?php echo $i === $page ? 'bg-[#02335B] text-white font-bold' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' ?>">
                    <?php echo $i; ?>
                </a>
            <?php endforeach; ?>

            <?php if ($page < $totalPages): ?>
                <a href="?search=<?php echo urlencode($search); ?>&page=<?php echo $page + 1; ?>" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">&raquo;</a>
            <?php endif; ?>
        </div>
    </div>



    <!-- Modal ala Galeri Slim -->
    <div id="imageModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70 backdrop-blur-md opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="relative bg-transparent w-auto max-w-md p-0 transform scale-95 transition-transform duration-300 ease-out" onclick="event.stopPropagation()">

            <!-- Tombol Close -->
            <button onclick="closeModal()"
                class="absolute top-2 right-2 text-white bg-black bg-opacity-40 hover:bg-opacity-60 rounded-full p-1 text-xl font-bold transition">
                &times;
            </button>

            <!-- Gambar -->
            <img id="modalImage" src="" alt="Cruise Image"
                class="w-full max-h-[60vh] object-contain rounded-lg shadow-lg border border-white/20" />
        </div>
    </div>




</div>

<script>
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');

    function openModal(imageUrl) {
        modalImg.src = imageUrl;
        modal.classList.remove('pointer-events-none');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modal.classList.remove('opacity-0');
            modal.querySelector('div').classList.add('scale-100');
            modal.querySelector('div').classList.remove('scale-95');
        }, 10);
    }

    function closeModal() {
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0');
        modal.querySelector('div').classList.remove('scale-100');
        modal.querySelector('div').classList.add('scale-95');

        setTimeout(() => {
            modal.classList.add('pointer-events-none');
        }, 300);
    }

    // Tutup modal jika klik di luar isi modal
    modal.addEventListener('click', closeModal);
</script>

<?php
include "footer.php";
?>