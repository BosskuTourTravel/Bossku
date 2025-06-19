<?php
include "header.php";
include "navbar.php";
include "slug.php";
include "db=connection.php"; // Perbaiki nama file koneksi

// Ambil ID tiket dari parameter URL
$ticketId = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($ticketId <= 0) {
    echo "<div class='text-center mt-10 text-red-600 font-bold'>Tiket tidak ditemukan.</div>";
    exit;
}

// Fungsi untuk konversi link Google Drive
function getGoogleDriveDirectLink($url)
{
    if (strpos($url, 'drive.google.com') !== false) {
        preg_match('/d\/([^\/]+)/', $url, $matches);
        if (!empty($matches[1])) {
            return "https://lh3.googleusercontent.com/d/{$matches[1]}=s0";
        }
    }
    return $url;
}

// Query detail tiket
$sql = "SELECT lt.id, lt.tempat AS name, lt.city AS location, lt.price, lt.keterangan ,
        lti.summer_img, lti.winter_img, lti.autumn_img
    FROM List_tempat AS lt
    LEFT JOIN List_tempat_img AS lti ON lt.id = lti.tmp_id
    WHERE lt.id = $ticketId
    LIMIT 1";
$result = $con->query($sql);

if ($result && $result->num_rows > 0) {
    $ticket = $result->fetch_assoc();
    $img = getGoogleDriveDirectLink($ticket['summer_img'] ?? $ticket['winter_img'] ?? $ticket['autumn_img'] ?? 'https://via.placeholder.com/400x250');
?>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-16 mt-10">
        <div class="mb-8 text-center">
            <h1 class="text-[#02335B] text-base font-semibold tracking-wide mb-1">Jelajahi Destinasi</h1>
            <h2 class="text-3xl font-bold tracking-wide mb-2">Temukan Tiket Wisata Impian Anda</h2>
            <p class="font-medium text-sm tracking-wide text-gray-500">Kami siap membantu Anda mendapatkan pengalaman wisata terbaik sesuai keinginan.</p>
        </div>
        <a href="tiket.php" class="text-blue-600 font-semibold hover:underline mb-6 inline-block">&larr; Kembali ke Daftar Tiket</a>
        <div class="bg-white shadow-xl rounded-2xl flex flex-col md:flex-row overflow-hidden">
            <img src="<?= htmlspecialchars($img); ?>" alt="Gambar Tiket" class="w-full md:w-1/2 h-72 object-cover">
            <div class="flex-1 p-8 flex flex-col">
                <div>
                    <h2 class="text-2xl font-bold mb-2"><?= htmlspecialchars($ticket['name']); ?></h2>
                    <p class="text-gray-600 mb-2">
                        Lokasi: <span class="inline-block px-2 py-0.5 rounded bg-blue-600 text-white"><?= htmlspecialchars($ticket['location']); ?></span>
                    </p>
                    <div class="text-yellow-500 font-semibold text-xl mb-4">
                        IDR <?= number_format($ticket['price'], 0, ',', '.'); ?>
                    </div>
                    <div class="mb-4 text-gray-700 leading-relaxed">
                        <?= !empty($ticket['keterangan']) ? nl2br(htmlspecialchars($ticket['keterangan'])) : 'Deskripsi belum tersedia untuk tiket ini.'; ?>
                    </div>
                </div>
                <div class="flex gap-3 mt-6">
                    <a href="https://wa.me/628112557728?text=Halo, saya tertarik membeli tiket <?= urlencode($ticket['name']); ?>"
                        class="flex-1 py-3 bg-[#FFCA10] text-[#02335B] text-center text-base font-semibold rounded-lg hover:bg-black hover:text-[#FFCA10] transition-all duration-200 ease-in-out transform hover:scale-105">
                        Pesan Sekarang
                    </a>
                    <a href="tiket.php"
                        class="flex-1 py-3 bg-[#02335B] text-white text-center text-base font-semibold rounded-lg hover:bg-[#FFCA10] hover:text-[#02335B] transition-all duration-200 ease-in-out transform hover:scale-105">
                        Lihat Tiket Lain
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
} else {
    echo "<div class='text-center mt-10 text-red-600 font-bold'>Tiket tidak ditemukan.</div>";
}
$con->close();
?>
