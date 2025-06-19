<?php
include "header.php";
include "navbar.php";
?>

<div class="container mx-auto px-4 py-16 mt-10">
    <div class="min-h-screen flex flex-col items-center gap-12">

        <!-- FORM PENDAFTARAN -->
        <div class="bg-white rounded-2xl w-full max-w-2xl p-10 transition">
            <h1 class="text-4xl font-extrabold mb-8 text-center text-[#02335B] tracking-tight">Form Pendaftaran Mitra Bossku Tour</h1>

            <form id="mitraform" class="space-y-6">
                <div>
                    <label for="name" class="block font-semibold mb-2 text-[#02335B]">Nama Lengkap</label>
                    <input type="text" id="name" name="name" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFCA10] focus:outline-none shadow-sm transition">
                </div>
                <div>
                    <label for="phone" class="block font-semibold mb-2 text-[#02335B]">Nomor WhatsApp</label>
                    <input type="tel" id="phone" name="phone" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFCA10] focus:outline-none shadow-sm transition">
                </div>
                <div>
                    <label for="city" class="block font-semibold mb-2 text-[#02335B]">Kota/Kabupaten</label>
                    <input type="text" id="city" name="city" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFCA10] focus:outline-none shadow-sm transition">
                </div>
                <div>
                    <label for="source" class="block font-semibold mb-2 text-[#02335B]">Dapat info dari mana?</label>
                    <select id="source" name="source" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#FFCA10] focus:outline-none shadow-sm transition">
                        <option value="">-- Pilih --</option>
                        <option value="instagram">Instagram</option>
                        <option value="tiktok">TikTok</option>
                        <option value="teman">Teman</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="pt-6">
                    <button type="submit"
                        class="w-full bg-[#FFCA10] text-[#02335B] font-bold py-3 rounded-xl shadow-md hover:bg-[#02335B] hover:text-[#FFCA10] transition duration-200">
                        Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>

        <!-- TERMS & CONDITIONS -->
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-4xl p-8 text-sm text-gray-700 leading-relaxed">
            <h2 class="text-2xl font-bold text-[#02335B] mb-6">Syarat & Ketentuan - Mitra Bossku Tour</h2>
            <p><strong>1. Pendaftaran</strong><br>
                Program Mitra Bossku Tour terbuka untuk umum tanpa batas usia atau latar belakang.<br>
                Pendaftaran mitra dilakukan secara online melalui link resmi dari Bossku Tour.</p>

            <p class="mt-4"><strong>2. Sistem Kerja</strong><br>
                Mitra bertugas mempromosikan paket tour dari Bossku Tour kepada calon customer.<br>
                Komisi diberikan untuk setiap orang yang berhasil ikut tour hingga hari keberangkatan tanpa pembatalan.<br>
                Mitra diperbolehkan mempromosikan tour dengan gaya dan jaringan pribadi masing-masing, menggunakan materi promosi dari Bossku Tour.</p>

            <p class="mt-4"><strong>3. Komisi</strong><br>
                Komisi sebesar Rp400.000 per orang akan diberikan kepada mitra jika customer tersebut ikut tour tanpa pembatalan dan telah melakukan pembayaran penuh.<br>
                Pembayaran komisi dilakukan maksimal 14 hari kerja setelah tanggal keberangkatan tour.</p>

            <p class="mt-4"><strong>4. Tracking Referral</strong><br>
                Tracking dilakukan melalui:<br>
                - Nama customer yang dicatat oleh admin berdasarkan laporan dari mitra.<br>
                - Nama mitra yang dicantumkan oleh customer saat pendaftaran.<br>
                - Bukti komunikasi yang disampaikan mitra kepada Bossku Tour.<br><br>

                Dalam kasus dua mitra mengklaim satu customer, Bossku Tour berhak:<br>
                - Tidak ikut campur, dan menyerahkan kepada customer untuk memilih mitra yang ia anggap mereferensikannya.<br>
                - Bossku Tour tidak bertanggung jawab atas perselisihan antara mitra.<br><br>

                <em>Solusi:</em> Edukasi mitra sejak awal agar segera lapor saat memprospek calon customer, dan minta customer menyebutkan nama mitra saat deal.
            </p>

            <p class="mt-4"><strong>5. Tanggung Jawab Mitra</strong><br>
                Mitra tidak diperkenankan memberikan informasi palsu, menjanjikan diskon tidak sah, menyesatkan customer, atau menyebarkan konten yang merusak citra Bossku Tour.<br>
                Mitra wajib menjaga etika, sopan santun, dan profesionalisme.<br>
                Materi promosi tanpa logo Bossku disediakan agar mitra bisa branding secara mandiri.</p>

            <p class="mt-4"><strong>6. Pemberhentian Mitra</strong><br>
                Bossku Tour berhak menghentikan kemitraan jika mitra terbukti melakukan:<br>
                - Penyalahgunaan sistem dalam bentuk apapun.<br>
                - Tindakan yang merugikan reputasi dan operasional Bossku Tour.</p>

            <p class="mt-4"><strong>7. Perubahan Aturan</strong><br>
                Bossku Tour berhak mengubah syarat & ketentuan sewaktu-waktu. Perubahan akan diumumkan secara resmi melalui grup mitra.</p>
        </div>

        <!-- FAQ -->
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-4xl p-8 text-sm text-gray-800 leading-relaxed">
            <h2 class="text-2xl font-bold text-[#02335B] mb-6">FAQ - Pertanyaan yang Sering Ditanyakan</h2>

            <ol class="list-decimal space-y-6 pl-4">
                <li><strong>Apakah harus bayar untuk daftar jadi mitra?</strong><br>Tidak. Daftar mitra 100% gratis.</li>

                <li><strong>Siapa saja yang bisa jadi mitra?</strong><br>Siapa saja! Ibu rumah tangga, karyawan, mahasiswa, bahkan influencer bisa ikut.</li>

                <li><strong>Apa tugas mitra?</strong><br>Kamu cukup bantu promosikan paket tour ke teman, keluarga, atau followers.<br>
                    Kamu akan mendapatkan materi promosi tanpa logo Bossku, supaya calon customer tetap fokus ke kamu, bukan langsung ke pusat.</li>

                <li><strong>Bagaimana cara promosinya?</strong><br>Kamu bisa share lewat WA, IG Story, broadcast, grup Facebook, TikTok, dll.</li>

                <li><strong>Dari mana saya dapat materi promosi?</strong><br>Kami akan sediakan link berisi itinerary, caption siap pakai, dan gambar promo yang bisa langsung kamu bagikan.</li>

                <li><strong>Bagaimana saya tahu ada orang yang mendaftar lewat saya?</strong><br>Customer akan menyebut nama kamu saat mendaftar.<br>
                    Kamu juga bisa bantu kawal mereka langsung ke kantor Bossku, dan pastikan mereka menyebut kamu sebagai referensinya.</li>

                <li><strong>Berapa komisi yang saya dapat?</strong><br>Rp400.000 per orang yang berhasil ikut tour tanpa cancel hingga keberangkatan dan sudah bayar penuh.</li>

                <li><strong>Kapan komisi dibayar?</strong><br>Maksimal 14 hari kerja setelah tour berangkat, asalkan peserta tidak cancel.</li>

                <li><strong>Boleh jual ke lebih dari satu orang?</strong><br>Sangat boleh! Semakin banyak yang ikut, semakin besar komisi kamu.</li>

                <li><strong>Apakah saya harus ikut tour juga?</strong><br>Tidak. Kamu bisa promosiin walau kamu sendiri tidak ikut.</li>

                <li><strong>Apa ada target penjualan?</strong><br>Tidak ada target. Bisa jalan santai sesuai waktu dan kapasitasmu.</li>

                <li><strong>Apa saya bisa pakai materi promosi pakai nama saya sendiri?</strong><br>Boleh banget. Branding bisa pakai nama pribadi kamu, seolah kamu agen travel.</li>

                <li><strong>Kalau customer yang saya ajak cancel, apakah saya tetap dapat komisi?</strong><br>Tidak. Komisi hanya diberikan kalau customer ikut tour tanpa cancel sampai keberangkatan.</li>

                <li><strong>Boleh gak kasih diskon pribadi ke calon customer?</strong><br>Boleh, asal diskon itu diambil dari bagian komisi kamu, bukan minta potongan ke Bossku Tour.</li>

                <li><strong>Bagaimana kalau 2 mitra klaim 1 customer?</strong><br>Bossku Tour tidak ikut campur. Customer akan ditanya siapa yang benar-benar membimbing mereka. Karena itu, penting kamu jaga komunikasi dan dokumentasi.</li>

                <li><strong>Kalau saya berhasil bawa banyak orang, apa dapat bonus ekstra?</strong><br>Untuk saat ini tidak ada bonus tambahan, namun kamu akan tetap dapat Rp400.000 per orang yang berangkat tanpa cancel.</li>

                <li><strong>Apa saya bisa lihat contoh itinerary dulu?</strong><br>Sangat bisa. Kami siapkan link dengan semua itinerary yang bisa kamu akses dan download.</li>

                <li><strong>Bagaimana jika saya belum pernah jualan tour sebelumnya?</strong><br>Tidak masalah. Kami akan bantu dari awal. Sistem kami sangat ramah untuk pemula.</li>

                <li><strong>Apakah mitra boleh masuk ke dalam grup WA untuk update info tour?</strong><br>Ya, setelah daftar kamu akan masuk ke grup mitra aktif dan dapat update promo.</li>

                <li><strong>Kalau ada pertanyaan dari customer yang saya tidak bisa jawab, apa saya bisa minta bantuan?</strong><br>Bisa banget. Kamu bisa hubungi admin Bossku Tour, kami bantu follow up langsung ke calon customer kamu.</li>
            </ol>
        </div>

    </div>
</div>

<script>
    document.getElementById('mitraform').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);
        Swal.fire({
            title: 'Mengirim...',
            text: 'Harap tunggu sebentar...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch("https://script.google.com/macros/s/AKfycbzxhLMQEPRC__l5D5Arq5LeuG8EXTtBbVz6nOMZzGe9CNIucX5zoMiOppWh-_Rpn1zHTA/exec", {
                method: "POST",
                body: formData
            })
            .then(res => res.text())
            .then(msg => {
                Swal.fire({
                    icon: 'success',
                    title: 'Pendaftaran Berhasil!',
                    text: 'Data kamu sudah dikirim ke Bossku Tour.',
                    confirmButtonColor: '#FFCA10'
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




<?php
include "footer.php";
?>