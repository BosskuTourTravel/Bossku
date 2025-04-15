<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "slug.php";
?>

<body>
    <div class="p-5">
        <div class="flex flex-row justify-center p-4">
            <h2 class="text-2xl font-semibold">Perhitungan Paket Tour Bossku</h2>
        </div>
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-6">
                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block mb-1">Jumlah Peserta</label>
                            <input type="number" id="peserta" name="peserta" onchange="add_peserta(this.value)" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block mb-1">Jumlah TL</label>
                            <input type="number" id="tl" name="tl" value="0" onchange="add_peserta2(this.value)" class="w-full border rounded px-3 py-2">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div>
                            <label class="block mb-1">Tiket Pesawat Customer PP</label>
                            <input type="text" id="pesawat_peserta" name="pesawat_peserta" onchange="add_total_pesawat_peserta(this.value)" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block mb-1">Detail</label>
                            <input type="text" id="pesawat_detail_peserta" name="pesawat_detail_peserta" disabled class="w-full border rounded px-3 py-2 bg-gray-100">
                        </div>
                        <div>
                            <label class="block mb-1">Total</label>
                            <input type="text" id="pesawat_total_peserta" name="pesawat_total_peserta" disabled class="w-full border rounded px-3 py-2 bg-gray-100">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div>
                            <label class="block mb-1">Tiket Pesawat TL PP</label>
                            <input type="text" id="pesawat_tl" name="pesawat_tl" onchange="add_total_pesawat()" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block mb-1">Detail</label>
                            <input type="text" id="pesawat_detail_tl" name="pesawat_detail_tl" disabled class="w-full border rounded px-3 py-2 bg-gray-100">
                        </div>
                        <div>
                            <label class="block mb-1">Total</label>
                            <input type="text" id="pesawat_total_tl" name="pesawat_total_tl" disabled class="w-full border rounded px-3 py-2 bg-gray-100">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                        <div>
                            <label class="block mb-1">FEE TL</label>
                            <input type="text" id="fee_tl" name="fee_tl" onchange="add_total_feetl()" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label class="block mb-1">Detail</label>
                            <input type="text" id="fee_detail_tl" name="fee_detail_tl" disabled class="w-full border rounded px-3 py-2 bg-gray-100">
                        </div>
                        <div>
                            <label class="block mb-1">Total</label>
                            <input type="text" id="fee_total_tl" name="fee_total_tl" disabled class="w-full border rounded px-3 py-2 bg-gray-100">
                        </div>
                    </div>

                    <div class="my-4">
                        <select id="loopHotel" onchange="loop_hotel(this.value)" class="w-full border rounded px-3 py-2">
                            <option value="0" selected>Pilih jumlah Coloumn Hotel</option>
                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php } ?>
                        </select>
                        <div id="hotel-show" class="mt-3"></div>
                    </div>

                    <div class="my-4">
                        <select id="loopTransport" onchange="loop_transport(this.value)" class="w-full border rounded px-3 py-2">
                            <option value="0" selected>Pilih jumlah Coloumn Transport</option>
                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php } ?>
                        </select>
                        <div id="transport-show" class="mt-3"></div>
                    </div>

                    <div class="my-4">
                        <select id="loopAdm" onchange="loop_adm(this.value)" class="w-full border rounded px-3 py-2">
                            <option value="0" selected>Pilih jumlah Coloumn Admission</option>
                            <?php for ($i = 1; $i <= 10; $i++) { ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php } ?>
                        </select>
                        <div id="adm-show" class="mt-3"></div>
                    </div>

                    <div class="flex flex-col md:flex-row justify-between items-center mt-6 gap-4">
                        <button type="button" onclick="add_gt()" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
                            Submit
                        </button>
                        <div id="gt" class="text-lg font-medium"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#pesawat_tl").keyup(function() {
                $(this).val(formatAngka($(this).val()));
            });
            $("#pesawat_peserta").keyup(function() {
                $(this).val(formatAngka($(this).val()));
            });
            $("#fee_tl").keyup(function() {
                $(this).val(formatAngka($(this).val()));
            });

        });

        function formatAngka(angka) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
        }

        function add_peserta(x) {
            var y = document.getElementById("tl").value;
            var loop_transport = document.getElementById("loopTransport").value;
            $("#pesawat_detail_tl").val(" : " + x + " ) x " + y);
            $("#fee_detail_tl").val(" : " + x + " ) x " + y);
            add_total_pesawat();
            add_total_feetl();
            for (i = 1; i <= loop_transport; i++) {
                add_total_transport(i);
            }

        }

        function add_peserta2(x) {
            var y = document.getElementById("peserta").value;
            $("#pesawat_detail_tl").val(" : " + y + " ) x " + x);
            $("#fee_detail_tl").val(" : " + y + " ) x " + x);
            add_total_pesawat();
            add_total_feetl();

        }

        function add_total_pesawat() {
            var tl_pesawat = document.getElementById("pesawat_tl").value;
            let angka = parseInt(tl_pesawat.replace(/\./g, ''));
            var peserta = document.getElementById("peserta").value;
            var tl = document.getElementById("tl").value;

            var total = (angka / parseInt(peserta)) / parseInt(tl);
            let valuez = Math.ceil(total).toString();
            let hasil = formatAngka(valuez);

            $("#pesawat_total_tl").val(hasil);
        }

        function add_total_feetl() {
            var tl_fee = document.getElementById("fee_tl").value;
            let angka = parseInt(tl_fee.replace(/\./g, ''));
            var peserta = document.getElementById("peserta").value;
            var tl = document.getElementById("tl").value;

            var total = (angka / parseInt(peserta)) / parseInt(tl);
            let valuez = Math.ceil(total).toString();
            let hasil = formatAngka(valuez);

            $("#fee_total_tl").val(hasil);
        }



        function add_total_pesawat_peserta(x) {
            let angka = parseInt(x.replace(/\./g, ''));
            var total = angka;
            let valuez = Math.ceil(total).toString();
            let hasil = formatAngka(valuez);
            $("#pesawat_detail_peserta").val(" x 1 ");
            $("#pesawat_total_peserta").val(hasil);

        }

        function add_total_hotel(x) {
            let hotel = document.getElementById("hotel" + x).value;
            let angka = parseInt(hotel.replace(/\./g, ''));
            var total = angka / 2;
            let valuez = Math.ceil(total).toString();
            let hasil = formatAngka(valuez);
            $("#hotel_detail" + x).val(" : 2 ");
            $("#hotel_total" + x).val(hasil);

        }

        function add_total_adm(x) {
            let adm = document.getElementById("adm" + x).value;
            let angka = parseInt(adm.replace(/\./g, ''));
            var total = angka;
            let valuez = Math.ceil(total).toString();
            let hasil = formatAngka(valuez);
            $("#adm_detail" + x).val(" x 1 ");
            $("#adm_total" + x).val(hasil);

        }

        function add_total_transport(x) {
            let transport = document.getElementById("transport" + x).value;
            let peserta = document.getElementById("peserta").value;
            let angka = parseInt(transport.replace(/\./g, ''));
            var total = angka / peserta;
            let valuez = Math.ceil(total).toString();
            let hasil = formatAngka(valuez);
            $("#transport_detail" + x).val(" : " + peserta);
            $("#transport_total" + x).val(hasil);

        }

        function loop_hotel(x) {
            $.ajax({
                url: "hotel-show.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x,
                },
                success: function(data) {
                    $('#hotel-show').html(data);
                }
            });
        }

        function loop_transport(x) {
            $.ajax({
                url: "show-transport.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x,
                },
                success: function(data) {
                    $('#transport-show').html(data);
                }
            });
        }

        function loop_adm(x) {
            $.ajax({
                url: "show_adm.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x,
                },
                success: function(data) {
                    $('#adm-show').html(data);
                }
            });
        }

        function add_gt() {
            var pesawat = document.getElementById("pesawat_total_peserta").value;
            var pesawat_tl = document.getElementById("pesawat_total_tl").value;
            var feetl = document.getElementById("fee_total_tl").value;
            var loop_hotel = document.getElementById("loopHotel").value;
            var loop_transport = document.getElementById("loopTransport").value;
            var loop_adm = document.getElementById("loopAdm").value;

            var total_hotel = 0;
            var total_transport = 0;
            var total_adm = 0;
            var total_pesawat = 0;
            var total_pesawat_tl = 0;
            var total_feetl = 0;
            for (i = 1; i <= loop_hotel; i++) {
                var hotel = document.getElementById("hotel_total" + i).value;
                var hotel_angka = parseInt(hotel.replace(/\./g, ''));
                total_hotel += hotel_angka;

            }
            for (i = 1; i <= loop_transport; i++) {
                var transport = document.getElementById("transport_total" + i).value;
                var transport_angka = parseInt(transport.replace(/\./g, ''));
                total_transport += transport_angka;
            }
            for (i = 1; i <= loop_adm; i++) {
                var adm = document.getElementById("adm_total" + i).value;
                var adm_angka = parseInt(adm.replace(/\./g, ''));
                total_adm += adm_angka;
            }
            if (pesawat !== "") {
                total_pesawat = parseInt(pesawat.replace(/\./g, ''));
            }
            if (pesawat_tl !== "") {
                total_pesawat_tl = parseInt(pesawat_tl.replace(/\./g, ''));
            }
            if (feetl !== "") {
                total_feetl = parseInt(feetl.replace(/\./g, ''));
            }

            console.log(total_pesawat + " " + total_pesawat_tl + " " + total_feetl + " " + total_hotel + " " + total_transport + " " + total_adm);

            var gt = total_pesawat + total_pesawat_tl + total_feetl + total_hotel + total_transport + total_adm;
            $.ajax({
                url: "show_gt.php",
                method: "POST",
                asynch: false,
                data: {
                    id: gt,
                },
                success: function(data) {
                    $('#gt').html(data);
                }
            });

        }
    </script>
</body>


<?php
include "footer.php"
?>