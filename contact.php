<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<body>
    <style>
        .contact-section {
            background-color: #f4f4f4;
            padding: 60px 0;
        }

        .contact-container {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.15);
        }

        .btn-custom {
            background-color: #02335B;
            color: #fff;
            font-weight: bold;
        }

        .btn-custom:hover {
            background-color: #011f3a;
        }

        .contact-info {
            background-color: #02335B;
            color: #fff;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 20px;
        }

        iframe {
            width: 100%;
            border-radius: 15px;
        }
    </style>
    </head>

    <body>
        <section class="contact-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 contact-container">
                        <h2 class="text-center text-dark mb-4">Hubungi Kami</h2>
                        <p class="text-center text-muted">Silakan isi formulir di bawah atau hubungi kami melalui kontak yang tersedia.</p>
                        <form onsubmit="event.preventDefault(); sendToWhatsApp();">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" placeholder="Masukkan nama Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Masukkan email Anda" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Pesan</label>
                                <textarea class="form-control" id="message" rows="4" placeholder="Tulis pesan Anda" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-custom w-100">Kirim Pesan</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="contact-info text-center">
                            <h5 class="mb-3">Informasi Kontak</h5>
                            <p>Email: <span class="fw-semibold">bosskutourandtravel@gmail.com</span></p>
                            <p>Telepon: <span class="fw-semibold">+62 811-2557-728</span></p>
                            <p>Alamat: <span class="fw-semibold">Jl. Mulyosari Baru No 42 - 44, Kav 89, Kota Surabaya</span></p>
                        </div>
                        <div class="contact-info text-center">
                            <h5 class="mb-3">Lokasi Kami</h5>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.806769828841!2d112.79571827476042!3d-7.262819092743979!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f90043dffc1f%3A0x909c5b4c3d9400a5!2sBossku%20Tour%20%26%20travel!5e0!3m2!1sid!2sid!4v1741419748755!5m2!1sid!2sid" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>


    <?php
    include "footer.php"
    ?>
    <script>
        function sendToWhatsApp() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var message = document.getElementById("message").value;
            var phoneNumber = "628112557728";

            var whatsappMessage = "Halo, saya " + name + "%0A" + message;

            var whatsappURL = "https://wa.me/" + phoneNumber + "?text=" + whatsappMessage;
            window.open(whatsappURL, "_blank");
        }
    </script>