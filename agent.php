<?php
include "header.php";
include "navbar.php";
?>

<div class="container mx-auto px-4 py-16 mt-10">
    <div class="min-h-screen flex flex-col items-center">
        <h1 class="text-4xl font-extrabold text-[#02335B] tracking-tight">Form Pendaftaran BossKu Travel Partner</h1>
        <h2 class="text-lg font-medium text-[#02335B] mb-4">Gabung jadi Mitra, Raih Komisi & Bangun Jaringan Bisnis Wisata Bersama BossKu Tour & Travel!</h2>

        <div class="w-full max-w-5xl mx-auto mb-10">
            <img src="img/Alur.jpeg" alt="Alur BossKu Travel Partner" class="rounded-xl shadow-lg w-full object-cover mb-3">
        </div>

        <div class="arrow-bounce-smooth flex justify-center" onclick="scrollToSection()">
            <svg xmlns="http://www.w3.org/2000/svg" height="50" width="45" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                <path fill="#02335b" d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
            </svg>
        </div>

        <!-- FORM PENDAFTARAN -->
        <div id="nextSection" class="grid grid-cols-1 md:grid-cols-2 gap-10 w-full max-w-5xl mx-auto p-8 bg-white/90 rounded-3xl shadow-2xl border border-gray-100 backdrop-blur-lg mt-10">
            <!-- Form -->
            <div class="flex flex-col p-4">
                <div class="mb-8 flex items-center gap-4">
                    <div class="bg-[#FFCA10] rounded-full p-3 shadow-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#02335B]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-extrabold text-[#02335B]">BossKu Travel Partner</h3>
                        <p class="text-gray-500 text-sm">Isi data dengan benar untuk bergabung</p>
                    </div>
                </div>
                <form id="mitraform" class="space-y-6">
                    <div>
                        <label for="name" class="block font-semibold mb-2 text-[#02335B]">Nama Lengkap</label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FFCA10] focus:outline-none shadow-sm bg-white/95 transition placeholder-gray-400"
                            placeholder="Nama sesuai KTP">
                    </div>
                    <div>
                        <label for="phone" class="block font-semibold mb-2 text-[#02335B]">Nomor WhatsApp</label>
                        <div class="flex rounded-xl shadow-sm overflow-hidden border border-gray-200 bg-white/95 focus-within:ring-2 focus-within:ring-[#FFCA10] transition">
                            <span class="flex items-center px-3 text-gray-600 bg-gray-100 border-r font-medium">+62</span>
                            <input type="tel" id="phone" name="phone_display" required
                                class="w-full px-4 py-3 focus:outline-none placeholder-gray-400 bg-transparent"
                                placeholder="81234567890"
                                pattern="[0-9]{8,13}"
                                inputmode="numeric"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </div>
                        <p id="phone-error" class="text-red-600 text-sm mt-1 hidden">Nomor WhatsApp wajib diisi dengan angka yang valid.</p>
                    </div>
                    <div>
                        <label for="city" class="block font-semibold mb-2 text-[#02335B]">Kota/Kabupaten</label>
                        <input type="text" id="city" name="city" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FFCA10] focus:outline-none shadow-sm bg-white/95 transition placeholder-gray-400"
                            placeholder="Contoh: Surabaya">
                    </div>
                    <div>
                        <label for="source" class="block font-semibold mb-2 text-[#02335B]">Dapat info dari mana?</label>
                        <select id="source" name="source" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FFCA10] focus:outline-none shadow-sm bg-white/95 transition text-gray-700">
                            <option value="">-- Pilih --</option>
                            <option value="instagram">Instagram</option>
                            <option value="tiktok">TikTok</option>
                            <option value="teman">Teman</option>
                            <option value="whatsapp">WhatsApp</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="inline-flex items-start gap-2 mt-2">
                            <input type="checkbox" id="terms" name="terms" required class="mt-1 accent-[#FFCA10] w-5 h-5 rounded border-gray-300">
                            <span class="text-sm text-gray-700">
                                Saya telah membaca dan menyetujui
                                <button type="button" onclick="document.querySelector('[x-data*=open]').__x.$data.open=true;" class="underline text-[#02335B] hover:text-[#FFCA10] font-semibold focus:outline-none">
                                    Syarat &amp; Ketentuan
                                </button>
                                BossKu Travel Partner.
                            </span>
                        </label>
                    </div>
                    <div class="pt-6">
                        <button type="submit"
                            class="w-full bg-[#02335B] text-[#FFCA10] font-bold py-3 rounded-xl shadow-lg hover:bg-white hover:text-[#02335B] hover:from-[#02335B] hover:to-[#02335B] transition duration-200 text-lg tracking-wide flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="#FFCA10">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Kirim Pendaftaran
                        </button>
                    </div>
                </form>
            </div>

            <!-- Kontak & Info -->
            <div class="flex flex-col p-4">
                <div class="mb-8 flex items-center gap-4">
                    <i class="fa-solid fa-grip-lines-vertical fa-2xl" style="color: #ffca10; padding: 3px;"></i>
                    <div>
                        <h3 class="text-2xl font-extrabold text-[#02335B]">Kontak Kami</h3>
                        <p class="text-gray-500 text-sm">Hubungi kami untuk informasi lebih lanjut</p>
                    </div>
                </div>
                <div class="space-y-5 text-[#02335B] text-base leading-relaxed ">
                    <div class="flex items-start gap-3 mb-2">
                        <div class="bg-[#FFCA10] rounded-full p-2 flex items-center justify-center shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-[#02335B]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-semibold">Alamat:</span>
                            <a href="https://maps.app.goo.gl/hpzYLpMATJo556P66" target="_blank"
                                class="underline font-semibold hover:text-[#FFCA10] transition break-all">
                                Jl. Mulyosari Baru No. 42-44 Kav. 89, Surabaya
                            </a>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 mb-2">
                        <div class="bg-[#FFCA10] rounded-full p-2 flex items-center justify-center shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-[#02335B]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-semibold">WhatsApp:</span>
                            <a href="https://wa.me/628112557728" target="_blank"
                                class="underline font-semibold hover:text-[#FFCA10] transition break-all">0811 2557 728</a>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 mb-2">
                        <div class="bg-[#FFCA10] rounded-full p-2 flex items-center justify-center shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-[#02335B]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-semibold">Email:</span>
                            <a href="mailto:partner@bosskujalanjalan.com"
                                class="underline font-semibold hover:text-[#FFCA10] transition break-all">
                                partner@bosskujalanjalan.com
                            </a>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 mb-2">
                        <div class="bg-[#FFCA10] rounded-full p-2 flex items-center justify-center shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 448 512">
                                <path fill="#02335b" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7-74.7-33.5-74.7-74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-semibold">Instagram:</span>
                            <a href="https://instagram.com/bosskutourtravel" target="_blank"
                                class="underline font-semibold hover:text-[#FFCA10] transition break-all">@bosskutourtravel</a>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 mb-2">
                        <div class="bg-[#FFCA10] rounded-full p-2 flex items-center justify-center shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-[#02335B]">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-semibold">Jam Operasional:</span>
                            <ul class="list-disc pl-5">
                                <li>Senin - Jumat: 08.00 - 17.00 WIB</li>
                                <li>Sabtu: 08.00 - 16.00 WIB</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Tombol FAQ dan S&K -->
                <div class="mt-8 flex flex-col space-y-3">
                    <div class="relative" x-data="{ faqOpen: false }">
                        <button @click="faqOpen = !faqOpen"
                            class="w-full text-center bg-[#FFCA10] text-[#02335B] font-bold py-3 px-6 rounded-xl shadow-md hover:bg-[#02335B] hover:text-[#FFCA10] transition duration-200 flex items-center gap-2 justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                            </svg>
                            FAQ
                        </button>
                        <div
                            x-show="faqOpen"
                            @click.outside="faqOpen = false"
                            x-transition
                            x-cloak
                            class="absolute z-50 mt-2 right-0 w-[370px] bg-white border border-gray-200 shadow-2xl rounded-2xl p-6 text-sm text-gray-700 leading-relaxed ring-2 ring-[#FFCA10] ring-opacity-30"
                            style="max-height: 380px; overflow-y: auto; scrollbar-width: thin; scrollbar-color: #FFCA10 #f3f4f6;">
                            <h2 class="text-xl font-extrabold text-[#02335B] mb-4 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FFCA10]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 14v.01M16 10h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                                </svg>
                                FAQ - Pertanyaan yang Sering Ditanyakan
                            </h2>
                            <ol class="list-decimal space-y-5 pl-5">
                                <!-- FAQ items as before -->
                                <li><span class="font-semibold text-[#02335B]">Apakah harus bayar untuk daftar jadi BossKu Travel Partner?</span><br><span class="text-gray-600">Tidak. Daftar BossKu Travel Partner 100% gratis.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Siapa saja yang bisa jadi BossKu Travel Partner?</span><br><span class="text-gray-600">Siapa saja! Ibu rumah tangga, karyawan, mahasiswa, bahkan influencer bisa ikut.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Apa tugas BossKu Travel Partner?</span><br><span class="text-gray-600">Kamu cukup bantu promosikan paket tour ke teman, keluarga, atau followers.<br>
                                        Kamu akan mendapatkan materi promosi tanpa logo Bossku, supaya calon customer tetap fokus ke kamu, bukan langsung ke pusat.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Bagaimana cara promosinya?</span><br><span class="text-gray-600">Kamu bisa share lewat WA, IG Story, broadcast, grup Facebook, TikTok, dll.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Dari mana saya dapat materi promosi?</span><br><span class="text-gray-600">Kami akan sediakan link berisi itinerary, caption siap pakai, dan gambar promo yang bisa langsung kamu bagikan.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Bagaimana saya tahu ada customer yang mendaftar lewat saya?</span><br><span class="text-gray-600">Customer akan menyebut nama kamu saat mendaftar.<br>
                                        Kamu juga bisa bantu kawal mereka langsung ke kantor Bossku, dan pastikan mereka menyebut kamu sebagai referensinya.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Berapa komisi yang saya dapat?</span><br><span class="text-gray-600">Rp400.000 per customer yang berhasil ikut tour tanpa cancel hingga keberangkatan dan sudah bayar penuh.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Kapan komisi dibayar?</span><br><span class="text-gray-600">Maksimal 14 hari kerja setelah tour berangkat, asalkan customer tidak cancel.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Boleh jual ke lebih dari satu customer?</span><br><span class="text-gray-600">Sangat boleh! Semakin banyak yang ikut, semakin besar komisi kamu.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Apakah saya harus ikut tour juga?</span><br><span class="text-gray-600">Tidak. Kamu bisa promosiin walau kamu sendiri tidak ikut.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Apa ada target penjualan?</span><br><span class="text-gray-600">Tidak ada target. Bisa jalan santai sesuai waktu dan kapasitasmu.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Apa saya bisa pakai materi promosi pakai nama saya sendiri?</span><br><span class="text-gray-600">Boleh banget. Branding bisa pakai nama pribadi kamu, seolah kamu agen travel.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Kalau customer yang saya ajak cancel, apakah saya tetap dapat komisi?</span><br><span class="text-gray-600">Tidak. Komisi hanya diberikan kalau customer ikut tour tanpa cancel sampai keberangkatan.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Boleh gak kasih diskon pribadi ke calon customer?</span><br><span class="text-gray-600">Boleh, asal diskon itu diambil dari bagian komisi kamu, bukan minta potongan ke BossKu Tour & Travel.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Bagaimana kalau 2 BossKu Travel Partner klaim 1 customer?</span><br><span class="text-gray-600">BossKu Tour & Travel tidak ikut campur. Customer akan ditanya siapa yang benar-benar membimbing mereka. Karena itu, penting kamu jaga komunikasi dan dokumentasi dengan customer.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Kalau saya berhasil bawa banyak customer, apa dapat bonus ekstra?</span><br><span class="text-gray-600">Untuk saat ini tidak ada bonus tambahan, namun kamu akan tetap dapat Rp400.000 per customer yang berangkat tanpa cancel.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Apa saya bisa lihat contoh itinerary dulu?</span><br><span class="text-gray-600">Sangat bisa. Kami siapkan link dengan semua itinerary yang bisa kamu akses dan download, Setelah kamu jadi bagian dari BossKu Travel Partner.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Bagaimana jika saya belum pernah jualan tour sebelumnya?</span><br><span class="text-gray-600">Tidak masalah. Kami akan bantu dari awal. Sistem kami sangat ramah untuk pemula.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Apakah BossKu Travel Partner boleh masuk ke dalam grup WA untuk update info tour?</span><br><span class="text-gray-600">Ya, setelah daftar kamu akan masuk ke grup BossKu Travel Partner aktif dan dapat update promo.</span></li>
                                <li><span class="font-semibold text-[#02335B]">Kalau ada pertanyaan dari customer yang saya tidak bisa jawab, apa saya bisa minta bantuan?</span><br><span class="text-gray-600">Bisa banget. Kamu bisa hubungi admin BossKu Tour & Travel, kami bantu follow up langsung ke calon customer kamu.</span></li>
                            </ol>
                        </div>
                    </div>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-full text-center bg-[#FFCA10] text-[#02335B] font-bold py-3 px-6 rounded-xl hover:bg-[#02335B] hover:text-[#FFCA10] transition duration-200 flex items-center gap-2 justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            Syarat & Ketentuan
                        </button>
                        <div x-show="open"
                            @click.outside="open = false"
                            x-transition
                            class="absolute mt-2 right-0 w-[350px] bg-white border border-gray-200 shadow-xl rounded-xl p-4 text-sm text-gray-700 leading-relaxed z-50"
                            style="max-height: 380px; overflow-y: auto; scrollbar-width: thin; scrollbar-color: #FFCA10 #f3f4f6;">
                            <h2 class="text-lg font-bold text-[#02335B] mb-2">Syarat & Ketentuan - BossKu Travel Partner </h2>
                            <div class="space-y-3">
                                <p><strong>1. Pendaftaran</strong><br>
                                    Program BossKu Travel Partner terbuka untuk umum tanpa batas usia atau latar belakang.
                                    Pendaftaran BossKu Travel Partner dilakukan secara online melalui link resmi dari BossKu Tour & Travel.
                                </p>
                                <p><strong>2. Sistem Kerja</strong><br>
                                    BossKu Travel Partner bertugas mempromosikan paket tour dari BossKu Tour & Travel kepada calon customer.
                                    Komisi dihitung berdasarkan setiap customer yang berhasil ikut tour hingga hari keberangkatan tanpa pembatalan.
                                </p>
                                <p><strong>3. Komisi</strong><br>
                                    Komisi sebesar Rp400.000 per customer akan diberikan kepada BossKu Travel Partner, jika customer ikut tour tanpa pembatalan dan bayar lunas.
                                    Komisi dibayar maksimal 14 hari kerja setelah keberangkatan.
                                </p>
                                <p><strong>4. Tracking Referral</strong><br>
                                    Tracking dilakukan melalui laporan BossKu Travel Partner dan info dari customer saat daftar.
                                    Kalau ada dua BossKu Travel Partner klaim, BossKu Tour & Travel nggak ikut campur.
                                </p>
                                <p><strong>5. Tanggung Jawab BossKu Travel Partner</strong><br>
                                    Dilarang menyebar info palsu, janji diskon abal-abal, atau merusak citra BossKu Tour & Travel.
                                    Jaga etika dan profesionalisme ya!
                                </p>
                                <p><strong>6. Pemberhentian BossKu Travel Partner</strong><br>
                                    Bisa diberhentikan kalau terbukti salah gunakan sistem atau merugikan BossKu Tour & Travel.
                                </p>
                                <p><strong>7. Perubahan Aturan</strong><br>
                                    BossKu Tour & Travel boleh ubah aturan kapan aja, info resminya lewat grup BossKu Travel Partner.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function scrollToSection() {
        const section = document.getElementById("nextSection");
        if (section) {
            section.scrollIntoView({
                behavior: "smooth"
            });
        }
    }

    document.getElementById('mitraform').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = e.target;
        const phoneInput = document.getElementById('phone');
        const phoneError = document.getElementById('phone-error');
        const phoneVal = phoneInput.value.trim();
        const phonePattern = /^[0-9]{8,13}$/;

        if (!phonePattern.test(phoneVal)) {
            phoneError.classList.remove('hidden');
            phoneInput.focus();
            return false;
        } else {
            phoneError.classList.add('hidden');
        }

        // Proses FormData
        const formData = new FormData(form);
        const fullPhone = '+62' + phoneVal;

        // Tambahin ke FormData dengan nama field baru (atau timpa yang lama kalau mau)
        formData.append('phone', fullPhone); // 'phone' ini yang dikirim ke Google Script
        formData.delete('phone_display'); // opsional: hapus input tampilan dummy

        Swal.fire({
            title: 'Mengirim...',
            text: 'Harap tunggu sebentar...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch("https://script.google.com/macros/s/AKfycbx1iIs1TwAIbFnHxDw9CdQ-XRDXIpFIfUAOIAIjUEwAXiI7fE14dCKf2jAImk9UBGMLFA/exec", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(msg => {
                Swal.fire({
                    icon: 'success',
                    title: 'Pendaftaran Berhasil!',
                    html: `Data kamu sudah dikirim ke BossKu Tour & Travel.<br><br>
                    <a href="https://wa.me/8112557728?text=Halo%20min,%20saya%20sudah%20daftar.%20Boleh%20minta%20link%20aksesnya?" 
                       target="_blank"
                       style="
                            display: inline-block;
                            background-color: #25D366;
                            color: white;
                            padding: 10px 24px;
                            font-weight: bold;
                            border-radius: 5px;
                            text-decoration: none;
                            font-size: 16px;
                            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
                            margin-top: 10px;
                       ">
                       📲 Minta Akses via WhatsApp
                    </a>`,
                    showConfirmButton: false
                });
                form.reset();
            })
            .catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal mengirim',
                    text: 'Silakan cek koneksi atau coba beberapa saat lagi.',
                    confirmButtonColor: '#d33'
                });
            });
    });
</script>


<style>
    @keyframes smoothBounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(10px);
        }
    }

    .arrow-bounce-smooth {
        animation: smoothBounce 1.5s ease-in-out infinite;
    }
</style>



<?php
include "footer.php";
?>