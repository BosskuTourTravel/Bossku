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
    <p class="font-medium text-sm tracking-wide text-center text-gray-500 mb-4">Pilih mobil yang sesuai dengan kebutuhan perjalanan Anda.</p>

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
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mt-12 items-center">
        <div class="rounded-2xl shadow-lg">
            <img src="<?= $item['image'] ?>" alt="<?= $item['name'] ?>" class="w-full h-72 object-cover hover:scale-105 transition-transform duration-300">
        </div>
        <div class="p-6">
            <h1 class="text-3xl font-bold text-[#02335B] mb-4"><?= htmlspecialchars($item['name']) ?></h1>

            <!-- Harga -->
            <div class="text-2xl font-extrabold text-[#FFCA10] mb-6">
                <?= htmlspecialchars($item['Harga']) ?>
            </div>

            <!-- Detail Mobil -->
            <div class="text-gray-700 space-y-2 mb-8">
                <p><strong>Seat:</strong> <?= htmlspecialchars($item['seat']) ?></p>
                <p><strong>Transmisi:</strong> <?= htmlspecialchars($item['transmisi']) ?></p>
            </div>

            <!-- Include Section -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-[#02335B] mb-2">Include:</h3>
                <ul class="list-disc list-inside text-md text-gray-600 space-y-1">
                    <li>Driver</li>
                    <li>BBM</li>
                </ul>
            </div>

            <!-- Melayani Section -->
            <div class="mb-10">
                <h3 class="text-lg font-semibold text-[#02335B] mb-2">Melayani:</h3>
                <ul class="list-disc list-inside text-md text-gray-600 space-y-1">
                    <li>Full Day Tour</li>
                    <li>Half Day Tour</li>
                    <li>Pickup Transfer</li>
                    <li>Hotel &minus; Airport PP</li>
                </ul>
            </div>

            <!-- Sewa Sekarang Button -->
            <div class="text-center">
                <a href="https://wa.me/628112557728?text=Halo, Saya%20ingin%20menyewa%20mobil%20<?= urlencode($item['name']) ?>%20dengan%20harga%20<?= urlencode($item['Harga']) ?>"
                    class="inline-block bg-[#FFCA10] text-[#112A46] px-4 py-2 rounded-full font-bold text-lg hover:bg-white hover:text-[#FFCA10] border-2 border-[#FFCA10] transition-all">
                    Sewa Sekarang
                </a>
            </div>
        </div>
    </div>


</div>

<?php
include "footer.php";
?>