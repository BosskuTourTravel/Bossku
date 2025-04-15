<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<body>
    <div class="container mx-auto py-12 px-6" x-data="visaApp()">
        <div class="flex justify-between items-center mb-6 pb-4">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-wide">Visa</h1>
        </div>

        <!-- Input Pencarian -->
        <div class="mb-6">
            <input type="text" placeholder="Cari visa berdasarkan negara..." 
                x-model="searchQuery" 
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-gray-700">
        </div>

        <!-- Grid Visa -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 px-4">
            <template x-for="(data, negara) in filteredVisaData()" :key="negara">
                <div class="relative bg-white shadow-md rounded-2xl overflow-hidden transform">
                    
                    <!-- Gambar Visa -->
                    <div class="h-96 flex items-center justify-center bg-gray-100 relative">
                        <img :src="`img/Visa${negara}.jpg`" :alt="`Visa ${negara}`" 
                            class="h-full object-cover w-full hover:scale-105 transition-transform duration-300">

                        <!-- Tombol Booking -->
                        <a :href="`detail-visa.php?country=${encodeURIComponent(negara)}`"
                            class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-[#FFCA10] text-[#02335B]  
                            px-4 py-2 rounded-lg text-sm font-bold hover:bg-[#02335B] hover:text-[#FFCA10] 
                            transition w-11/12 text-center">
                            Booking →
                        </a>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <script>
        function visaApp() {
            return {
                searchQuery: '',
                visaData: {
                    'Japan': [
                        { jenis: 'Visa Turis', harga: 'Rp 500.000' },
                        { jenis: 'Visa Bisnis', harga: 'Rp 1.200.000' }
                    ],
                    'Amerika': [
                        { jenis: 'Visa Pelajar', harga: 'Rp 2.000.000' },
                        { jenis: 'Visa Kerja', harga: 'Rp 3.500.000' }
                    ],
                    'Korea Selatan': [
                        { jenis: 'Visa Turis', harga: 'Rp 800.000' },
                        { jenis: 'Visa Bisnis', harga: 'Rp 1.500.000' }
                    ],
                    'Australia': [
                        { jenis: 'Visa Pelajar', harga: 'Rp 1.800.000' },
                        { jenis: 'Visa PR', harga: 'Rp 5.000.000' }
                    ],
                    'Jerman': [
                        { jenis: 'Visa Pelajar', harga: 'Rp 2.500.000' },
                        { jenis: 'Visa Kerja', harga: 'Rp 4.000.000' }
                    ],
                    'Prancis': [
                        { jenis: 'Visa Turis', harga: 'Rp 1.200.000' },
                        { jenis: 'Visa Bisnis', harga: 'Rp 1.800.000' }
                    ],
                    'Singapura': [
                        { jenis: 'Visa Turis', harga: 'Rp 500.000' },
                        { jenis: 'Visa Bisnis', harga: 'Rp 1.000.000' }
                    ],
                    'Italia': [
                        { jenis: 'Visa Pelajar', harga: 'Rp 2.200.000' },
                        { jenis: 'Visa Kerja', harga: 'Rp 3.500.000' }
                    ],
                    'China': [
                        { jenis: 'Visa Kunjungan', harga: 'Rp 600.000' },
                        { jenis: 'Visa Bisnis', harga: 'Rp 1.400.000' }
                    ],
                    'Kanada': [
                        { jenis: 'Visa Pelajar', harga: 'Rp 2.700.000' },
                        { jenis: 'Visa PR', harga: 'Rp 6.000.000' }
                    ],
                    'Swiss': [
                        { jenis: 'Visa Turis', harga: 'Rp 1.500.000' },
                        { jenis: 'Visa Kerja', harga: 'Rp 3.800.000' }
                    ],
                    'Spanyol': [
                        { jenis: 'Visa Pelajar', harga: 'Rp 2.300.000' },
                        { jenis: 'Visa Bisnis', harga: 'Rp 2.000.000' }
                    ],
                    'Thailand': [
                        { jenis: 'Visa Turis', harga: 'Rp 400.000' },
                        { jenis: 'Visa Kerja', harga: 'Rp 1.200.000' }
                    ],
                    'Malaysia': [
                        { jenis: 'Visa Turis', harga: 'Rp 350.000' },
                        { jenis: 'Visa Bisnis', harga: 'Rp 900.000' }
                    ],
                    'Belanda': [
                        { jenis: 'Visa Pelajar', harga: 'Rp 2.800.000' },
                        { jenis: 'Visa Kerja', harga: 'Rp 4.500.000' }
                    ],
                    'Rusia': [
                        { jenis: 'Visa Kunjungan', harga: 'Rp 900.000' },
                        { jenis: 'Visa Bisnis', harga: 'Rp 2.500.000' }
                    ],
                    'India': [
                        { jenis: 'Visa Turis', harga: 'Rp 300.000' },
                        { jenis: 'Visa Bisnis', harga: 'Rp 700.000' }
                    ],
                    'Afrika Selatan': [
                        { jenis: 'Visa Kunjungan', harga: 'Rp 1.000.000' },
                        { jenis: 'Visa Kerja', harga: 'Rp 3.000.000' }
                    ],
                    'Argentina': [
                        { jenis: 'Visa Turis', harga: 'Rp 750.000' },
                        { jenis: 'Visa Bisnis', harga: 'Rp 1.300.000' }
                    ]
                },
                filteredVisaData() {
                    if (!this.searchQuery) {
                        return this.visaData;
                    }
                    let query = this.searchQuery.toLowerCase();
                    return Object.fromEntries(
                        Object.entries(this.visaData).filter(([negara]) => 
                            negara.toLowerCase().includes(query)
                        )
                    );
                }
            };
        }
    </script>
</body>
