<?php include "slug.php"; ?>
<nav class="bg-[#02335B] py-4 shadow-lg">
    <div class="container mx-auto flex items-center justify-between px-4">
        <!-- Logo -->
        <a href="<?php echo $domain_web ?>" class="flex-shrink-0">
            <img src="img/LogoWeb.png" alt="Bossku Tour & Travel" class="w-[120px] md:w-[100px] transition-transform duration-300 hover:scale-105">
        </a>
        
        <!-- Tombol Toggle -->
        <button id="menu-toggle" class="md:hidden text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
        
        <!-- Menu Tengah -->
        <div id="navbarNav" class="hidden md:flex md:items-center md:space-x-6 text-white text-center">
            <a href="<?php echo $domain_web ?>" class="font-bold text-white transition-colors duration-300 hover:text-[#FFCA10] relative overflow-hidden after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-[#FFCA10] after:scale-x-0 after:origin-left after:transition-transform after:duration-300 hover:after:scale-x-100">HOME</a>
            <a href="<?php echo $domain_web ?>about.php" class="font-bold text-white transition-colors duration-300 hover:text-[#FFCA10] relative overflow-hidden after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-[#FFCA10] after:scale-x-0 after:origin-left after:transition-transform after:duration-300 hover:after:scale-x-100">ABOUT</a>
            <a href="<?php echo $domain_web ?>faq.php" class="font-bold text-white transition-colors duration-300 hover:text-[#FFCA10] relative overflow-hidden after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-[#FFCA10] after:scale-x-0 after:origin-left after:transition-transform after:duration-300 hover:after:scale-x-100">FAQ</a>
            <a href="<?php echo $domain_web ?>terms_condition.php" class="font-bold text-white transition-colors duration-300 hover:text-[#FFCA10] relative overflow-hidden after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-[#FFCA10] after:scale-x-0 after:origin-left after:transition-transform after:duration-300 hover:after:scale-x-100">TERMS & CONDITIONS</a>
            <a href="<?php echo $domain_web ?>privacy_policy.php" class="font-bold text-white transition-colors duration-300 hover:text-[#FFCA10] relative overflow-hidden after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-[#FFCA10] after:scale-x-0 after:origin-left after:transition-transform after:duration-300 hover:after:scale-x-100">PRIVACY POLICY</a>
        </div>
        
        <!-- Button di Kanan -->
        <div class="hidden md:flex gap-2">
            <a href="<?php echo $domain_web ?>member/" class="bg-[#FFCA10] text-[#02335B] border-2 border-[#02335B] rounded-full px-6 py-2 font-bold transition duration-300 hover:bg-[#02335B] hover:text-[#FFCA10] shadow-md">Login</a>
        </div>
    </div>
    
    <!-- Menu Mobile -->
    <div id="mobile-menu" class="hidden md:hidden flex flex-col items-center bg-[#02335B] text-white py-4 space-y-4 transition-all duration-300">
        <a href="<?php echo $domain_web ?>" class="font-bold text-white hover:text-gray-300">HOME</a>
        <a href="<?php echo $domain_web ?>about.php" class="font-bold text-white hover:text-gray-300">ABOUT</a>
        <a href="<?php echo $domain_web ?>faq.php" class="font-bold text-white hover:text-gray-300">FAQ</a>
        <a href="<?php echo $domain_web ?>terms_condition.php" class="font-bold text-white hover:text-gray-300">TERMS & CONDITIONS</a>
        <a href="<?php echo $domain_web ?>privacy_policy.php" class="font-bold text-white hover:text-gray-300">PRIVACY POLICY</a>
        <a href="<?php echo $domain_web ?>member/" class="bg-white text-[#02335B] border-2 border-[#02335B] rounded-full px-6 py-2 font-bold transition duration-300 hover:bg-[#02335B] hover:text-white shadow-md">Login</a>
    </div>
</nav>

<!-- JavaScript untuk Toggle Menu -->
<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>

<style>
a {
    text-decoration: none !important;
}
</style>