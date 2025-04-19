<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<div class="container mx-auto px-4 py-16 mt-10">
    <!-- Title -->
    <h1 class="text-[#02335B] text-lg font-semibold tracking-wide text-center mb-2">Contact Us</h1>
    <h2 class="text-3xl font-bold tracking-wide text-center">Need Help? We're Here For You</h2>
    <p class="font-medium text-sm tracking-wide text-center text-gray-500">Feel free to reach out to us for any inquiries or assistance.</p>

    <!-- Button -->
    <div class="flex flex-wrap gap-4 justify-center mt-6">
        <button class="flex items-center gap-2 bg-[#FFCA10] font-semibold tracking-wide text-[#112A46] px-5 py-2 rounded-full shadow-lg hover:bg-white hover:text-[#FFCA10] transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
            </svg>
            WhatsApp
        </button>
        <button class="flex items-center gap-2 bg-[#02335B] font-semibold tracking-wide text-[#FFCA10] px-5 py-2 rounded-full shadow-lg hover:bg-white hover:text-[#FFCA10] transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z" />
            </svg>
            Email
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">
        <!-- FORM -->
        <div class="bg-white p-6 rounded-xl shadow-lg space-y-4">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="w-full md:w-1/2">
                    <label class="block font-medium mb-1">First Name</label>
                    <input type="text" class="w-full border border-gray-300 px-4 py-2 rounded-lg" placeholder="John">
                </div>
                <div class="w-full md:w-1/2">
                    <label class="block font-medium mb-1">Last Name</label>
                    <input type="text" class="w-full border border-gray-300 px-4 py-2 rounded-lg" placeholder="Doe">
                </div>
            </div>
            <div>
                <label class="block font-medium mb-1">Phone</label>
                <input type="tel" class="w-full border border-gray-300 px-4 py-2 rounded-lg" placeholder="+62">
            </div>
            <div>
                <label class="block font-medium mb-1">Email</label>
                <input type="email" class="w-full border border-gray-300 px-4 py-2 rounded-lg" placeholder="your@email.com">
            </div>
            <div>
                <label class="block font-medium mb-1">Message</label>
                <textarea class="w-full border border-gray-300 px-4 py-2 rounded-lg resize-none" rows="4" placeholder="Your message..."></textarea>
            </div>
            <button onclick="sendToWhatsApp()" class="bg-[#FFCA10] text-[#112A46] px-6 py-2 rounded-full font-semibold hover:bg-white hover:text-[#FFCA10] transition">
                Kirim via WhatsApp
            </button>
        </div>

        <!-- KONTAK -->
        <div class="p-6 flex flex-col gap-8">
            <div>
                <h2 class="text-lg font-semibold tracking-wide">Chat With Us</h2>
                <p class="text-gray-500 text-sm font-medium tracking-wide mb-3">Chat with our friendly team for any inquiries</p>
                <a href="https://wa.me/628112557728" target="_blank" class="flex items-center gap-2 font-semibold underline transition mb-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                    </svg>
                    Chat on WhatsApp</a>
                <a href="mailto:bosskutourandtravel@gmail.com" target="_blank" class="flex items-center gap-2 font-semibold underline transition mb-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z" />
                    </svg>
                    Send us an email</a>
                <a href="https://www.instagram.com/bosskutourtravel/" target="_blank" class="flex items-center gap-2 font-semibold underline transition mb-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-5 h-5">
                        <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                    </svg>DM us on Instagram</a>
            </div>

            <div>
                <h2 class="text-lg font-semibold tracking-wide">Call Us</h2>
                <p class="text-gray-500 text-sm font-medium tracking-wide mb-3">Call our team: Mon–Fri, 8AM–5PM | Sat, 8AM–4PM</p>
                <a href="tel:+628112557758" target="_blank" class="flex items-center gap-2 font-semibold underline transition mb-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                    +62 811 2557 758</a>
            </div>

            <div>
                <h2 class="text-lg font-semibold tracking-wide">Visit Us</h2>
                <p class="text-gray-500 text-sm font-medium tracking-wide mb-3">Come visit our office: Mon–Fri, 8AM–5PM | Sat, 8AM–4PM</p>
                <a href="https://maps.app.goo.gl/s4cWpmwAMvP95pam8" target="_blank" class="flex items-center gap-2 font-semibold underline transition mb-2"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    Jl. Mulyosari Baru No. 42 - 44, Kav. 89, Kota Surabaya</a>
            </div>
        </div>
    </div>



</div>

<?php include "footer.php"; ?>