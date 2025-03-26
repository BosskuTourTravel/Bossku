<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<body class="bg-gray-100 text-gray-800">

    <!-- Main content wrapper -->
    <div class="max-w-5xl mx-auto p-6">
        <!-- Card with shadow for better focus -->
        <div class="bg-white shadow-xl rounded-lg p-8 space-y-6">

            <!-- Title -->
            <h1 class="text-4xl font-bold text-center text-blue-600 mb-6">Kebijakan Privasi</h1>

            <!-- Intro text -->
            <p class="text-lg text-gray-600">
                Selamat datang di Bossku Tour & Travel. Kami menghormati privasi Anda dan berkomitmen untuk melindungi informasi pribadi Anda.
            </p>

            <!-- Section 1 -->
            <div>
                <h4 class="text-2xl font-semibold text-blue-500 mt-6">1. Informasi yang Kami Kumpulkan</h4>
                <p class="text-lg text-gray-600 mt-2">
                    Kami dapat mengumpulkan informasi pribadi seperti nama, email, nomor telepon, dan informasi pembayaran saat Anda menggunakan layanan kami. Data ini dikumpulkan untuk memastikan pengalaman perjalanan yang lebih baik dan personal bagi pelanggan kami.
                </p>
            </div>

            <!-- Section 2 -->
            <div>
                <h4 class="text-2xl font-semibold text-blue-500 mt-6">2. Penggunaan Informasi</h4>
                <p class="text-lg text-gray-600 mt-2">
                    Informasi yang kami kumpulkan digunakan untuk memproses pemesanan, meningkatkan layanan kami, dan berkomunikasi dengan Anda. Selain itu, data ini dapat digunakan untuk memberikan rekomendasi perjalanan yang sesuai dengan preferensi Anda serta menginformasikan tentang promosi terbaru.
                </p>
            </div>

            <!-- Section 3 -->
            <div>
                <h4 class="text-2xl font-semibold text-blue-500 mt-6">3. Keamanan Data</h4>
                <p class="text-lg text-gray-600 mt-2">
                    Kami menjaga keamanan data Anda dengan menggunakan teknologi enkripsi dan tindakan keamanan lainnya. Kami juga melakukan audit berkala untuk memastikan bahwa data pelanggan tetap aman dan terlindungi dari akses yang tidak sah.
                </p>
            </div>

            <!-- Section 4 -->
            <div>
                <h4 class="text-2xl font-semibold text-blue-500 mt-6">4. Perubahan Kebijakan</h4>
                <p class="text-lg text-gray-600 mt-2">
                    Kebijakan ini dapat diperbarui sewaktu-waktu. Kami akan memberi tahu Anda tentang perubahan melalui situs web kami. Kami menyarankan untuk memeriksa halaman ini secara berkala agar tetap mendapatkan informasi terbaru tentang bagaimana kami melindungi privasi Anda.
                </p>
            </div>

            <!-- Contact Info -->
            <p class="text-lg mt-4 text-gray-600">
                Jika Anda memiliki pertanyaan mengenai kebijakan privasi ini, silakan hubungi kami melalui email di 
                <a href="mailto:bosskutourandtravel@gmail.com" class="font-semibold text-blue-600 hover:text-blue-800">bosskutourandtravel@gmail.com</a>.
            </p>

        </div>
    </div>

    <!-- Footer inclusion -->
<?php
include "footer.php";
?>

</body>
