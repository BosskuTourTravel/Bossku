<?php
include "header.php";
include "navbar.php";
include "slug.php";
include "data-mobil.php";
?>

<div class="container mx-auto px-4 py-16 mt-10">
    <!-- Title -->
    <h1 class="text-[#02335B] text-sm font-semibold tracking-wide text-center mb-2">Rental Mobil</h1>
    <h2 class="text-3xl font-bold tracking-wide text-center">Mobil Terbaik untuk Perjalanan Anda</h2>
    <p class="font-medium text-sm tracking-wide text-center text-gray-500">Pilih mobil yang sesuai dengan kebutuhan perjalanan Anda.</p>

    <!-- Rental Mobil -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-10">
        <?php foreach ($rental as $item) : ?>
            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 flex flex-col">
                <div class="overflow-hidden">
                    <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="w-full h-60 object-cover transform hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-[#02335B] mb-3"><?= htmlspecialchars($item['name']) ?></h3>

                    <!-- Harga yang lebih menonjol -->
                    <div class="text-2xl font-extrabold text-[#FFCA10] mb-4">
                        <?= htmlspecialchars($item['Harga']) ?>
                    </div>

                    <p class="text-gray-700 mb-1"><span class="font-semibold">Kapasitas:</span> <?= htmlspecialchars($item['seat']) ?></p>
                    <p class="text-gray-700 mb-4"><span class="font-semibold">Transmisi:</span> <?= htmlspecialchars($item['transmisi']) ?></p>

                    <div class="mt-auto flex flex-wrap gap-2">
                        <a href="detail-rental.php?id=<?= urlencode($item['id']) ?>" class="flex-1 text-center bg-[#FFCA10] text-[#112A46] px-4 py-2 rounded-full font-semibold hover:bg-white hover:text-[#FFCA10] border-2 border-[#FFCA10] transition-all">
                            Lihat Detail
                        </a>
                        <a href="https://wa.me/628112557728?text=Saya%20ingin%20menyewa%20mobil%20<?= urlencode($item['name']) ?>%20dengan%20harga%20<?= urlencode($item['Harga']) ?>" target="_blank" class="flex-1 text-center bg-[#02335B] text-white px-4 py-2 rounded-full font-semibold hover:bg-white hover:text-[#02335B] border-2 border-[#02335B] transition-all">
                            Sewa Sekarang
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<?php
include "footer.php";
?>