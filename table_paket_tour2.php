<?php
// include "API/Price/Api_LT_total_baru.php";
// include "slug.php";
?>
<div style="padding-top: 20px;">
    <div style="text-align: center;">
        <h3>PAKET TOUR PRICE LIST</h3>
    </div>
    <div class="table-responsive">
        <table id="tb-pt-web" class="table table-striped table-bordered table-sm" style="width:100% ;font-size: 10pt; padding: 20px;">
            <thead style="background-color: darkgreen; color: white;">
                <tr>
                    <th>No</th>
                    <th style="max-width: 350px;">Nama Paket</th>
                    <th>Pax</th>
                    <th>Code</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = "SELECT * FROM(SELECT paket_tour_online.*, LTSUB_itin.judul,LTSUB_itin.landtour,LT_change_judul.nama as change_judul,LTP_insert_sfee.ket as staff_id,login_staff.name as staff_name ,login_staff.phone FROM paket_tour_online INNER JOIN LTSUB_itin ON paket_tour_online.tour_id=LTSUB_itin.id lEFT JOIN LT_change_judul ON paket_tour_online.tour_id=LT_change_judul.copy_id && paket_tour_online.grub_id=LT_change_judul.grub_id INNER JOIN LTP_insert_sfee ON paket_tour_online.sfee_id=LTP_insert_sfee.id INNER JOIN login_staff ON LTP_insert_sfee.ket=login_staff.id order by paket_tour_online.gt ASC) as itin GROUP BY itin.landtour order by itin.negara ASC";
                $rs = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($rs)) {
                    $judul = "";
                    $url_encode = urldecode("Haii " . $row['staff_name'] . ", Saya ingin Memesan Paket Tour : https://www.holidaymyboss.com/Admin/cetak_pt_website.php?id=" . $row['id']);

                    $query_cek = "SELECT paket_tour_online.start, paket_tour_online.promo,LTSUB_itin.landtour FROM paket_tour_online LEFT JOIN LTSUB_itin ON paket_tour_online.tour_id=LTSUB_itin.id where LTSUB_itin.landtour='" . $row['landtour'] . "' GROUP BY paket_tour_online.start , paket_tour_online.promo ORDER BY paket_tour_online.start, paket_tour_online.promo ASC";
                    $rs_cek = mysqli_query($con, $query_cek);
                    $gabung_kota = "";
                    $gabung_promo = "";
                    $cek_kota = "";
                    $cek_promo = "";
                    while ($row_cek = mysqli_fetch_array($rs_cek)) {
                        $kota = "";
                        if ($row_cek['start'] == "BTH") {
                            $kota = "Batam";
                        } else if ($row_cek['start'] == "SUB") {
                            $kota = "Surabaya";
                        } else if ($row_cek['start'] == "CGK") {
                            $kota = "Jakarta";
                        } else if ($row_cek['start'] == "DPS") {
                            $kota = "Denpasar";
                        } else {
                            $kota = "Undefined";
                        }


                        if ($row_cek['promo'] == "p_ls") {
                            $detail = "Low Seasons";
                        } else if ($row_cek['promo'] == "p_ny") {
                            $detail = "New Years";
                        } else if ($row_cek['promo'] == "p_lebaran") {
                            $detail = "Lebaran";
                        } else if ($row_cek['promo'] == "p_sh") {
                            $detail = "School Holiday";
                        } else {
                            $detail = "Undefined";
                        }

                        if ($cek_kota == "") {
                            $gabung_kota .=  $kota . " " . $detail;
                            $cek_promo = $row_cek['promo'];
                            $cek_kota = $row_cek['start'];
                        } else {
                            if ($cek_kota == $row_cek['start']) {
                                if ($cek_promo != $row_cek['promo']) {
                                    $gabung_kota .= " / " . $detail;
                                    $cek_promo = $row_cek['promo'];
                                }
                            } else {
                                $gabung_kota .= " || " . $kota . " " . $detail;
                                $cek_kota = $row_cek['start'];
                            }
                        }
                    }

                    if (isset($row['change_judul'])) {
                        $judul = $row['change_judul'];
                    } else {
                        $judul = $row['judul'];
                    }



                ?>
                    <tr>
                        <th><?php echo $no ?></th>
                        <td>
                            <div>
                                <a href="<?php echo $domain_web ?>detail-paket-tour.php?id=<?php echo $row['id'] ?>&master=<?php echo $row['tour_id'] ?>" class="link-body-emphasis link-offset-2 link-underline-opacity-0 link-underline-opacity-75-hover" style="color: black;"><b><?php echo $judul ?></b></a>
                            </div>
                            <div><?php echo $row['negara'] ?></div>
                            <div><?php echo "<b>Start From :</b> " . $gabung_kota ?></div>
                        </td>
                        <td><?php echo $row['pax_tour'] ?></td>
                        <td>
                            <?php echo $row['landtour'] ?>
                        </td>
                        <td><?php echo "IDR " . number_format($row['gt'], 0, ".", ".") ?></td>
                        <td>
                            <a class="btn btn-warning btn-sm tip my-1" href="Admin/cetak_pt_website.php?id=<?php echo $row['id'] ?>" target="_BLANK"><i class="fa fa-print"></i> Print</a>
                            <a class="btn btn-success btn-sm tip my-1" href="https://wa.me/<?php echo $row['phone'] . '?text=' . $url_encode ?>" target="_BLANK"><i class="fa fa-whatsapp"></i> Whatsapp</a>
                            <a class="btn btn-primary btn-sm tip my-1" href="<?php echo $domain_web ?>detail-paket-tour.php?id=<?php echo $row['id'] ?>&master=<?php echo $row['tour_id'] ?>"><i class="fa fa-info-circle"></i> detail</a>
                        </td>
                    </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tb-pt-web').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 10,
            "bDestroy": true
        });
    });
</script>