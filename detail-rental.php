<?php
include "navbar.php";
include "slug.php";
include "header.php";
include 'navbar.php';
include "data-mobil.php";
?>

<div class="container mx-auto px-4 py-16 mt-10">
    <!-- Title -->
    <h1 class="text-[#02335B] text-sm font-semibold tracking-wide text-center mb-2">Detail Rental Mobil</h1>
    <h2 class="text-3xl font-bold tracking-wide text-center">Mobil Terbaik untuk Perjalanan Anda</h2>
    <p class="font-medium text-sm tracking-wide text-center text-gray-500">Pilih mobil yang sesuai dengan kebutuhan perjalanan Anda.</p>

    <a href="javascript:history.back()" class="text-center mt-6 text-md font-semibold tracking-wide hover:underline ">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <!-- Detail Rental Mobil -->
    <?php
    $id = $_GET['id'];
    $item = array_filter($rental, function ($rental) use ($id) {
        return $rental['id'] == $id;
    });
    $item = reset($item); // Get the first element of the filtered array
    ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">
        <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="w-full h-64 object-cover rounded-lg shadow-md">
        <div class="p-6">
            <h3 class="text-2xl font-semibold text-[#02335B] mb-3"><?= $item['name'] ?></h3>
            <p class="text-lg text-gray-500 mb-2"><?= $item['Harga'] ?></p>
            <p class="text-gray-500 mb-2"><strong>Seat:</strong> <?= $item['seat'] ?></p>
            <p class="text-gray-500 mb-4"><strong>Transmisi:</strong> <?= $item['transmisi'] ?></p>

            <!-- Include Section -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-[#02335B] mb-2">Include:</h3>
                <ul class="list-disc list-inside text-md text-gray-600 space-y-1 font-medium">
                    <li>Driver</li>
                    <li>BBM</li>
                </ul>
            </div>

            <!-- Melayani Section -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-[#02335B] mb-2">Melayani:</h3>
                <ul class="list-disc list-inside text-md text-gray-600 space-y-1 font-medium">
                    <li>Full Day Tour</li>
                    <li>Half Day Tour</li>
                    <li>Pickup Transfer</li>
                    <li>Hotel &minus; Airport PP</li>
                </ul>
            </div>

            <!-- Sewa Sekarang Button -->
            <a href="https://wa.me/628112557728?text=Halo, Saya%20ingin%20menyewa%20mobil%20<?= urlencode($item['name']) ?>%20dengan%20harga%20<?= urlencode($item['Harga']) ?>" class="mt-6 inline-block bg-[#FFCA10] text-[#112A46] px-6 py-3 rounded-full font-semibold hover:bg-white hover:text-[#FFCA10] transition">Sewa Sekarang</a>
        </div>
    </div>

</div>

<?php
include "footer.php";
?>