<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<body class="bg-gray-100">

    <!-- Hero Section -->
    <div class="relative">
    <img src="img/About.jpg" alt="Europe Map" class="w-full h-64 object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-50"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white text-center z-10">
            <h1 class="text-4xl font-extrabold shadow-lg text-shadow-lg">ABOUT US</h1>
        </div>
    </div>

    <!-- About Content Section -->
    <div class="px-6 py-12 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Tentang Bossku Tour & Travel</h2>
        <p class="max-w-3xl mx-auto text-lg text-gray-600 leading-relaxed">
            Bossku Tour & Travel adalah agen perjalanan yang menyediakan berbagai paket wisata domestik dan internasional dengan harga terbaik. Kami berkomitmen untuk memberikan pengalaman perjalanan yang nyaman, aman, dan berkesan bagi setiap pelanggan dengan layanan profesional dan fasilitas terbaik.
        </p>
    </div>

    <!-- Services Section -->
    <div class="container mx-auto px-4 py-12 text-center">
        <h3 class="text-2xl font-bold text-gray-800 mb-8">Layanan Kami</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            <!-- Service Card 1 -->
            <div class="service-card bg-white shadow-lg rounded-lg overflow-hidden hover:transform hover:scale-105 transition-all duration-300">
                <img src="img/Map.jpg" class="w-full h-48 object-cover" alt="Customized Holiday">
                <div class="p-6">
                    <h5 class="text-xl font-semibold text-gray-800">Customized Holiday</h5>
                    <p class="text-gray-600 mt-2">Liburan yang bisa disesuaikan sesuai keinginan Anda.</p>
                </div>
            </div>
            <!-- Service Card 2 -->
            <div class="service-card bg-white shadow-lg rounded-lg overflow-hidden hover:transform hover:scale-105 transition-all duration-300">
                <img src="img/Group.jpg" class="w-full h-48 object-cover" alt="Group Incentives">
                <div class="p-6">
                    <h5 class="text-xl font-semibold text-gray-800">Group Incentives</h5>
                    <p class="text-gray-600 mt-2">Paket perjalanan untuk perusahaan atau grup.</p>
                </div>
            </div>
            <!-- Service Card 3 -->
            <div class="service-card bg-white shadow-lg rounded-lg overflow-hidden hover:transform hover:scale-105 transition-all duration-300">
                <img src="img/Paspor.jpg" class="w-full h-48 object-cover" alt="Travel Document">
                <div class="p-6">
                    <h5 class="text-xl font-semibold text-gray-800">Travel Document</h5>
                    <p class="text-gray-600 mt-2">Membantu dalam pengurusan paspor dan visa.</p>
                </div>
            </div>
            <!-- Service Card 4 -->
            <div class="service-card bg-white shadow-lg rounded-lg overflow-hidden hover:transform hover:scale-105 transition-all duration-300">
                <img src="img/Insurance.jpg" class="w-full h-48 object-cover" alt="Travel Insurance">
                <div class="p-6">
                    <h5 class="text-xl font-semibold text-gray-800">Travel Insurance</h5>
                    <p class="text-gray-600 mt-2">Perlindungan asuransi perjalanan bagi pelancong.</p>
                </div>
            </div>
        </div>
    </div>

</body>

<?php
include "footer.php";
?>