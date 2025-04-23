<?php
include "db=connection.php";
include "header.php";
include "navbar.php";
include "slug.php";

function slugify($string)
{
    $string = strtolower(trim($string));
    $string = preg_replace('/[^a-z0-9-]/', '-', $string);
    $string = preg_replace('/-+/', '-', $string);
    return rtrim($string, '-');
}

function formatRupiah($angka)
{
    return 'Rp' . number_format($angka, 0, ',', '.');
}
?>

<div class="container mx-auto px-4 py-16 mt-10">
    <!-- Title -->
    <h1 class="text-[#02335B] text-sm font-semibold tracking-wide text-center mb-2">Explore Cruises</h1>
    <h2 class="text-3xl font-bold tracking-wide text-center">Discover Your Perfect Cruise</h2>
    <p class="font-medium text-sm tracking-wide text-center text-gray-500">Let us help you find the ideal cruise experience tailored to your needs.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-10">
        <?php include 'cruise-data.php'; ?>

        <?php foreach ($cruises as $cruise):
            $cruiseName = $cruise['name'];
            $cruiseImage = $cruise['image'];
            $cruiseDescription = $cruise['description'];
            $cruisePrice = $cruise['price'];
            $cruiseCountry = $cruise['country'];
            $cruiseSlug = slugify($cruiseName);
        ?>
            <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col h-full">
                <img src="<?php echo $cruiseImage; ?>" alt="<?php echo $cruiseName; ?>" class="w-full h-48 object-cover">

                <div class="p-4 flex flex-col flex-grow">
                    <!-- Judul -->
                    <h3 class="text-xl font-bold text-[#02335B] leading-snug"><?php echo $cruiseName; ?></h3>

                    <!-- Deskripsi -->
                    <p class="text-sm text-gray-600 mt-2 tracking-wide leading-relaxed"><?php echo $cruiseDescription; ?></p>

                    <!-- Negara -->
                    <div class="mt-3">
                        <span class="inline-block bg-[#02335B] text-[#FFCA10] text-xs font-semibold px-3 py-1 rounded-full">
                            <?php echo $cruiseCountry; ?>
                        </span>
                    </div>

                    <!-- Harga -->
                    <div class="mt-3">
                        <span class="block text-lg font-semibold text-[#02335B] tracking-wide">
                            <?php echo formatRupiah($cruisePrice); ?>
                        </span>
                    </div>

                    <!-- Spacer agar tombol tetap di bawah -->
                    <div class="flex-grow"></div>

                    <!-- Tombol Aksi -->
                    <div class="mt-4 flex gap-2 flex-wrap justify-end">
                        <button onclick="openModal('<?php echo $cruiseImage; ?>')" class="text-sm font-semibold text-[#02335B] bg-[#FFCA10] px-4 py-2 rounded hover:bg-yellow-500 transition-all duration-200">
                            Lihat Gambar
                        </button>
                        <a href="cruise-details.php?slug=<?php echo $cruiseSlug; ?>" class="text-sm font-semibold text-white bg-[#02335B] px-4 py-2 rounded hover:bg-[#035a8b] transition-all duration-200">
                            View Details
                        </a>
                    </div>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

    <!-- Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 opacity-0 pointer-events-none transition-opacity duration-300">
        <div class="relative bg-white rounded-lg w-100 mx-4 p-4 transform scale-95 transition-transform duration-300" onclick="event.stopPropagation()">
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-black text-xl font-bold">&times;</button>
            <img id="modalImage" src="" alt="Cruise Image" class="w-auto h-100 mx-auto rounded-lg">
        </div>
    </div>


</div>

<script>
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');

    function openModal(imageUrl) {
        modalImg.src = imageUrl;
        modal.classList.remove('pointer-events-none');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modal.classList.remove('opacity-0');
            modal.querySelector('div').classList.add('scale-100');
            modal.querySelector('div').classList.remove('scale-95');
        }, 10);
    }

    function closeModal() {
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0');
        modal.querySelector('div').classList.remove('scale-100');
        modal.querySelector('div').classList.add('scale-95');

        setTimeout(() => {
            modal.classList.add('pointer-events-none');
        }, 300);
    }

    // Tutup modal jika klik di luar isi modal
    modal.addEventListener('click', closeModal);
</script>

<?php
include "footer.php";
?>