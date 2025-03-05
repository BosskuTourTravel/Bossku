<?php
include "header.php";
include "navbar.php";
include "db=connection.php";
include "Admin/Api_LT_total.php";

$query_itin5 = "SELECT * FROM LT_itinnew where id=" . $_GET['id'];
$rs_itin5 = mysqli_query($con, $query_itin5);
$row_itin5 = mysqli_fetch_array($rs_itin5);
$adt = 0;
$chd = 0;
$detail = [];
if (isset($_POST['room'])) {
    for ($i = 1; $i <= $_POST['room']; $i++) {
        $val_adt = $_POST['adt_' . $i];
        $val_chd = $_POST['chd_' . $i];
        $adt = $adt + $val_adt;
        $chd = $chd + $val_chd;
        array_push($detail, array("room" => $i, "adt" => $val_adt, "chd" => $chd));
    }
}
// var_dump($_POST['cnb_price']);
?>
<div class="content" style="margin:auto;">
    <div class="card" style="padding: 10px; margin: 20px;">
        <div class="card-body">
            <div style="text-align: center; font-size: 24pt; font-weight: bold;">Data Pemesanan</div>
            <div class="alert-modal">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="checkout.php?id=<?php echo $_GET['id'] ?>&master=<?php echo $_GET['master'] ?>" method="post">
                        <div class="form-group" style="padding: 10px 0px;">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group" style="padding: 10px 0px;">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="form-group" style="padding: 10px 0px;">
                            <label>No Tlpn</label>
                            <input type="text" class="form-control" id="tlpn" name="tlpn">
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" id="ket" name="ket" rows="3"></textarea>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" style="font-size: 11pt; color: grey;">Saya sudah membaca dan setuju syarat dan ketentuan yang diberlakukan</label>
                        </div>
                        <input type="hidden" id="judul" name="judul" value="<?php echo  $_POST['judul'] ?>">
                        <input type="hidden" id="tgl" name="tgl" value="<?php echo  $_POST['tgl'] ?>">
                        <input type="hidden" id="adt" name="adt" value="<?php echo  $adt ?>">
                        <input type="hidden" id="chd" name="chd" value="<?php echo $chd ?>">
                        <input type="hidden" id="adt_price" name="adt_price" value="<?php echo  $_POST['adt_price'] ?>">
                        <input type="hidden" id="cnb_price" name="cnb_price" value="<?php echo  $_POST['cnb_price'] ?>">
                        <input type="hidden" id="sgl_price" name="sgl_price" value="<?php echo  $_POST['sgl_price'] ?>">
                        <input type="hidden" id="detail" name="detail" value="<?php echo json_encode($detail) ?>">
                        <input type="hidden" id="room" name="room" value="<?php echo  $_POST['room'] ?>">
                        <input type="hidden" id="price" name="price" value="<?php echo  $_POST['price'] ?>">
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div style="padding: 20px;"></div>
                    <div class="card">
                        <div class="card-header" style="text-align: center; font-weight: bold;">
                            BOOKING SUMMARY
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div><?php echo $_POST['judul'] ?></div>
                                <div style="padding-top: 20px;">
                                    <div class="row">
                                        <div class="col-md-6">Nama Paket</div>
                                        <div class="col-md-6">: <?php echo $_POST['judul'] ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">Tgl Berangkat</div>
                                        <div class="col-md-6">: <?php echo date('D, d M Y', strtotime($_POST['tgl'])) ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">Total Kamar</div>
                                        <div class="col-md-6">: <?php echo $_POST['room'] ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">Total Tamu</div>
                                        <div class="col-md-6">: <?php echo $adt . " adt, " . $chd . " chd" ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">Hotel</div>
                                        <div class="col-md-6">:
                                            <ul>
                                                <?php
                                                if ($row_itin5['hotel1'] != "") {
                                                    echo "<li>" . $row_itin5['hotel1'] . "</li>";
                                                }
                                                if ($row_itin5['hotel2'] != "") {
                                                    echo "<li>" . $row_itin5['hotel2'] . "</li>";
                                                }
                                                if ($row_itin5['hotel3'] != "") {
                                                    echo "<li>" . $row_itin5['hotel3'] . "</li>";
                                                }
                                                if ($row_itin5['hotel4'] != "") {
                                                    echo "<li>" . $row_itin5['hotel4'] . "</li>";
                                                }
                                                if ($row_itin5['hotel5'] != "") {
                                                    echo "<li>" . $row_itin5['hotel5'] . "</li>";
                                                }
                                                if ($row_itin5['hotel6'] != "") {
                                                    echo "<li>" . $row_itin5['hotel6'] . "</li>";
                                                }
                                                if ($row_itin5['hotel7'] != "") {
                                                    echo "<li>" . $row_itin5['hotel7'] . "</li>";
                                                }
                                                if ($row_itin5['hotel8'] != "") {
                                                    echo "<li>" . $row_itin5['hotel8'] . "</li>";
                                                }
                                                if ($row_itin5['hotel9'] != "") {
                                                    echo "<li>" . $row_itin5['hotel9'] . "</li>";
                                                }
                                                if ($row_itin5['hotel10'] != "") {
                                                    echo "<li>" . $row_itin5['hotel10'] . "</li>";
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">Tour Type</div>
                                        <div class="col-md-6">: SIC</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">Flight</div>
                                        <div class="col-md-6">: Belum Termasuk</div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-6" style="font-weight: bold;">TOTAL</div>
                                    <div class="col-md-6" style="font-weight: bold;">IDR <?php echo number_format($_POST['price'], 0, ",", ".") ?></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js">
</script>
<script type="text/javascript">
    (function() {
        emailjs.init({
            publicKey: "D6GrddZ46tGTax1MJ",
        });
    })();
</script>
<script>
    function alert_berhasil() {
        $.ajax({
            url: "alert_page.php",
            method: "POST",
            asynch: false,
            data: {
                x: '1',
            },
            success: function(data) {
                $('.alert-modal').html(data);
            }
        });
    }

    function sendMail() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = dd + '/' + mm + '/' + yyyy;

        var params = {
            to_email: document.getElementById("email").value,
            reply_to: "performa.tourtravel@gmail.com",
            cc_email: "performa.tourtravel@gmail.com",
            to_name: document.getElementById("nama").value,
            tgl_pesan: today,
            paket_name: document.getElementById("judul").value,
            checkin: document.getElementById("tgl").value,
            adt: document.getElementById("adt").value,
            chd: document.getElementById("chd").value,
            price: document.getElementById("price").value,
            email: document.getElementById("email").value,
            phone: document.getElementById("tlpn").value,
            ket: document.getElementById("ket").value,
        }
        emailjs.send("service_p7xt80g", "template_x7d2zbm", params).then(function(res) {
            alert("Detail pemesanan dikirimkan via Email anda");
        })
    }

    function alert_gagal() {
        $.ajax({
            url: "alert_page.php",
            method: "POST",
            asynch: false,
            data: {
                x: '0',
            },
            success: function(data) {
                $('.alert-modal').html(data);
            }
        });
    }

    function to_order(x, y) {


        var judul = document.getElementById("judul").value;
        var tgl = document.getElementById("tgl").value;
        var adt = document.getElementById("adt").value;
        var chd = document.getElementById("chd").value;
        var price = document.getElementById("price").value;
        var email = document.getElementById("email").value;
        var nama = document.getElementById("nama").value;
        var tlpn = document.getElementById("tlpn").value;
        var ket = document.getElementById("ket").value;

        if (nama == "") {
            alert("nama tidak boleh kosong !");
        } else if (email == "") {
            alert("email tidak boleh kosong !");
        } else if (tlpn == "") {
            alert("no tlpn tidak boleh kosong !");
        } else {
            $.ajax({
                url: "insert_booking.php",
                method: "POST",
                asynch: false,
                data: {
                    id: x,
                    master: y,
                    judul: judul,
                    tgl: tgl,
                    adt: adt,
                    chd: chd,
                    price: price,
                    email: email,
                    nama: nama,
                    tlpn: tlpn,
                    ket: ket
                },
                success: function(data) {
                    if (data == "success") {
                        // alert("Success");
                        alert_berhasil();
                        sendMail();
                    } else {
                        alert_gagal();
                    }
                }
            });
        }



    }
</script>