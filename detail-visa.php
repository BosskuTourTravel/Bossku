<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";

$country = isset($_GET['country']) ? urldecode($_GET['country']) : '';

// Data dummy visa berdasarkan negara
$visaData = [
    'Japan' => [
        ['jenis' => 'Visa Turis', 'harga' => 'Rp 500.000', 'deskripsi' => 'Visa ini diperuntukkan bagi wisatawan yang ingin berlibur ke Jepang.'],
        ['jenis' => 'Visa Bisnis', 'harga' => 'Rp 1.200.000', 'deskripsi' => 'Visa ini untuk keperluan bisnis, seperti pertemuan atau konferensi.']
    ],
    'Amerika' => [
        ['jenis' => 'Visa Pelajar', 'harga' => 'Rp 2.000.000', 'deskripsi' => 'Visa ini untuk pelajar yang ingin belajar di Amerika.'],
        ['jenis' => 'Visa Kerja', 'harga' => 'Rp 3.500.000', 'deskripsi' => 'Visa ini bagi yang ingin bekerja di Amerika.']
    ],
    'Korea Selatan' => [
        ['jenis' => 'Visa Turis', 'harga' => 'Rp 800.000', 'deskripsi' => 'Visa ini untuk wisatawan yang ingin berlibur ke Korea Selatan.'],
        ['jenis' => 'Visa Bisnis', 'harga' => 'Rp 1.500.000', 'deskripsi' => 'Visa ini untuk tujuan bisnis seperti pertemuan atau pameran dagang.']
    ],
    'Australia' => [
        ['jenis' => 'Visa Pelajar', 'harga' => 'Rp 1.800.000', 'deskripsi' => 'Visa ini diperuntukkan bagi pelajar yang ingin menempuh pendidikan di Australia.'],
        ['jenis' => 'Visa PR', 'harga' => 'Rp 5.000.000', 'deskripsi' => 'Visa ini memungkinkan pemegangnya untuk menetap secara permanen di Australia.']
    ]
];

// Cek apakah data visa tersedia untuk negara yang dipilih
$visaList = isset($visaData[$country]) ? $visaData[$country] : [];

?>

<body class="bg-gray-100">
    <div class="container mx-auto py-10 px-6">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-6">Detail Visa untuk <?php echo htmlspecialchars($country); ?></h1>

        <?php if (!empty($visaList)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <?php foreach ($visaList as $visa): ?>
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h2 class="text-2xl font-semibold text-blue-700 mb-2"> <?php echo $visa['jenis']; ?> </h2>
                        <p class="text-gray-700 mb-4"> <?php echo $visa['deskripsi']; ?> </p>
                        <p class="text-lg font-bold text-gray-800"> 💰 Harga: <?php echo $visa['harga']; ?> </p>
                        <a href="visa.php?visa=<?php echo urlencode($visa['jenis']); ?>&country=<?php echo urlencode($country); ?>"
                            class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                            Booking →
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-red-600 font-semibold">Maaf, tidak ada data visa untuk negara ini.</p>
        <?php endif; ?>

        <a href="index.php" class="mt-6 inline-block text-blue-600 hover:underline">← Kembali ke daftar visa</a>
    </div>
</body>