<?php
include "navbar.php";
include "slug.php";
include "header.php";
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
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold"><?= $item['name'] ?></h3>
                    <p class="text-gray-500"><?= $item['Harga'] ?></p>
                    <p class="text-gray-500"><?= $item['seat'] ?></p>
                    <p class="text-gray-500"><?= $item['transmisi'] ?></p>
                    <a href="detail-rental.php?id=<?= $item['id'] ?>" class="mt-4 inline-block bg-[#FFCA10] text-[#112A46] px-4 py-2 rounded-full font-semibold hover:bg-white hover:text-[#FFCA10] transition">Lihat Detail</a>
                    <a href="https://wa.me/628112557728?text=Saya%20ingin%20menyewa%20mobil%20<?= urlencode($item['name']) ?>%20dengan%20harga%20<?= urlencode($item['Harga']) ?>" class="mt-4 inline-block bg-[#02335B] text-white px-4 py-2 rounded-full font-semibold hover:bg-white hover:text-[#02335B] transition">Sewa Sekarang</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
include "footer.php";
?>