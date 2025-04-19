<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<div class="container mx-auto px-4 py-16 mt-10">
    <!-- Title -->
    <div class="text-center mb-8">
        <h1 class="text-[#02335B] text-lg font-semibold tracking-wide">About Us</h1>
        <h2 class="text-4xl font-bold tracking-wide text-[#02335B]">Embark on a Journey with Us</h2>
        <p class="font-medium text-sm tracking-wide text-gray-500 mt-2">Your gateway to unforgettable travel experiences.</p>
    </div>

    <!-- Image -->
    <div class="flex justify-center mb-8">
        <img src="img/aboutthumb.jpg" alt="About Us" class="rounded-lg shadow-md w-full h-80 max-w-3xl">
    </div>

    <!-- Content -->
    <div class="mt-8 space-y-6 text-gray-700 text-md leading-relaxed">
        <p class="text-justify">
            <span class="font-semibold text-[#02335B]">Welcome to our travel agency,</span> where every journey becomes a new chapter in your story. With years of expertise, we specialize in crafting tailor-made travel plans that align perfectly with your dreams and aspirations.
        </p>
        <p class="text-justify">
            Our <span class="font-semibold text-[#02335B]">dedicated team of travel enthusiasts</span> ensures your adventures are seamless and extraordinary. Whether you're seeking serene beaches, thrilling mountain escapades, or cultural immersions, we have it all covered.
        </p>
        <p class="text-justify">
            Let us guide you as we explore the wonders of the world together, <span class="italic">crafting memories</span> that will stay with you forever.
        </p>
        <p class="text-justify">
            We pride ourselves on offering <strong class="font-bold text-[#FFCA10]">exclusive deals and packages</strong> designed to suit your budget and expectations. Whether you're traveling with loved ones, or in a group, we handle every detail so you can focus on enjoying the journey.
        </p>
        <p class="text-justify">
            Through our partnerships with <span class="font-semibold text-[#02335B]">top-rated hotels, airlines, and local experts,</span> we bring you unparalleled services and experiences. From luxurious stays to authentic cultural encounters, we aim to exceed your expectations at every turn.
        </p>
        <p class="text-justify">
            Let us ignite your wanderlust and help you uncover the beauty and diversity of our planet. Together, we can transform your travel dreams into reality.
        </p>
    </div>

    <!-- Button -->
    <div class="flex justify-center mt-10">
        <p class="text-sm font-medium text-gray-600">
            For inquiries, feel free to reach out to us via our <a href="contact.php" class="text-[#02335B] font-semibold hover:underline">contact page</a>.
        </p>
    </div>
</div>
<?php
include "footer.php";
?>