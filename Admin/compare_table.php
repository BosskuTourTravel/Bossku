<?php
include "../db=connection.php";
include "get_price_compare_table.php";
$id = $_POST['rent'];
$y = $_POST['tourid'];
$seat = 40;
$query_rent = "SELECT Rent_selected.id ,Rent_selected.id_package,Rent_selected.id_trans,Rent_selected.id_agent,Rent_selected.trans_type,Rent_selected.seat,Rent_selected.country,Rent_selected.city,Rent_selected.periode,Rent_selected.tipe,Rent_selected.kurs,Rent_selected.price,Rent_selected.status,agent_transport.name as agent FROM Rent_selected LEFT JOIN agent_transport ON Rent_selected.id_agent=agent_transport.id where Rent_selected.id_package=" . $id . "  order by Rent_selected.id ASC limit 1";
$rs_rent = mysqli_query($con, $query_rent);
$row_rent = mysqli_fetch_array($rs_rent);
// var_dump($query_rent);
if (isset($row_rent['id'])) {
?>

    <table class="table table-sm small" id="price-custom" style="width: 100%;">
        <thead class="bg-success">
            <tr>
                <th scope="col">#</th>
                <th scope="col">HOTEL</th>
                <th scope="col">Pax</th>
                <th scope="col">TWN</th>
                <th scope="col">SGL</th>
                <th scope="col">CNB</th>
                <th scope="col">INF</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $show_guest_meal = get_meal_price($id);
            $result_guest_meal = json_decode($show_guest_meal, true);

            $show_guest_adm = get_adm_price($id);
            $result_guest_adm = json_decode($show_guest_adm, true);

            $batas = $row_rent['seat'];
            for ($i = 1; $i <= $batas; $i++) {
                $val_pax = "";
                $pax_tour = $i;
                $bagi = intval($i);
                $val_pax .= $pax_tour . " Pax";
                if ($_POST['guide'] != '0') {
                    $val_pax .= " + " . $_POST['guide'] . " Guide";
                }
                if ($_POST['foc'] != '0') {
                    $val_pax .= " + " . $_POST['foc'] . " FOC";
                }

                $show_guide = get_price_guide($id, $y);
                $result_guide = json_decode($show_guide, true);

                $show_rent = get_price_rent($id);
                $result_rent = json_decode($show_rent, true);

                $val_guest_hotel = $_POST['hotel'];
                $show_guest_hotel = get_price_hotel($val_guest_hotel);
                $result_guest_hotel = json_decode($show_guest_hotel, true);
                // var_dump($result_guest_hotel);






                $val_hotel_twn = $result_guest_hotel['price'] / 2;
                $val_hotel_sgl = $result_guest_hotel['price'];
                $val_hotel_chd = 0;
                $val_hotel_inf = 0;

                $guide_adm = $_POST['guide'] * ($result_guest_adm['price'] / $bagi);
                $foc_adm = $_POST['foc'] * ($result_guest_adm['price'] / $bagi);
                $guide_hotel = $_POST['guide'] * ($val_hotel_sgl / $bagi);
                $foc_hotel = $_POST['foc'] * ($val_hotel_twn / $bagi);
                $rent_guest = intval($result_rent['price']) / $bagi;





                $val_guide_custom = $_POST['guide'] * ($result_guide['guide'] / $bagi);
                $val_foc_custom = $_POST['foc'] * ($result_guide['foc'] / $pax_tour);

                $gt_twn_custom = $rent_guest + $val_hotel_twn + $val_guide_custom + $val_foc_custom + $result_guest_meal['price'] + $result_guest_adm['price'] + $guide_adm + $foc_adm + $guide_hotel + $foc_hotel;

                $gt_sgl_custom =  $rent_guest + $val_hotel_sgl + $val_guide_custom + $val_foc_custom +  $result_guest_meal['price'] + $result_guest_adm['price'] + $guide_adm + $foc_adm + $guide_hotel + $foc_hotel;

                $gt_cnb_custom =  $rent_guest + $val_guide_custom + $val_foc_custom +  $result_guest_meal['price'] + $result_guest_adm['price'] + $guide_adm + $foc_adm + $guide_hotel + $foc_hotel;

                $gt_inf_custom =  $val_guide_custom + $val_foc_custom + $result_guest_meal['price'] + $guide_adm + $foc_adm + $guide_hotel + $foc_hotel;

                $twn_sp = get_pembulatan($gt_twn_custom);
                $twn_rp = json_decode($twn_sp, true);

                $sgl_sp = get_pembulatan($gt_sgl_custom);
                $sgl_rp = json_decode($sgl_sp, true);

                $cnb_sp = get_pembulatan($gt_cnb_custom);
                $cnb_rp = json_decode($cnb_sp, true);

                $inf_sp = get_pembulatan($gt_inf_custom);
                $inf_rp = json_decode($inf_sp, true);


                if($i == '3'){
                    echo "Rent : ".$rent_guest ."+ Hotel : ". $val_hotel_twn ."+ Guide : ". $val_guide_custom ."+ foc: ".$val_foc_custom ."+ meal: ". $result_guest_meal['price'] ."+ adm:". $result_guest_adm['price'] ."+ guide adm:". $guide_adm ."+ foc adm :".$foc_adm ."+ hotel guide:". $guide_hotel ."+ foc hotel:". $foc_hotel;
                }
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $result_guest_hotel['hotel'] ?></td>
                    <td><?php echo $val_pax ?></td>
                    <td><?php echo "Rp." . number_format($twn_rp['value'], 0, ",", ".") ?></td>
                    <td><?php echo "Rp." . number_format($sgl_rp['value'], 0, ",", ".") ?></td>
                    <td><?php echo "Rp." . number_format($cnb_rp['value'], 0, ",", ".") ?></td>
                    <td><?php echo "Rp." . number_format($inf_rp['value'], 0, ",", ".") ?></td>
                    <td class="d-flex justify-content-center align-items-center">
                        <form action="cetak_LT_custom.php?id=<?php echo $id ?>&tour_id=<?php echo $y ?>&pax=<?php echo $i  ?>" target="_blank" method="POST">
                            <input type="hidden" name="guest_meal" id="guest_meal" value="<?php echo $result_guest_meal['price'] ?>">
                            <input type="hidden" name="adm_price" id="adm_price" value="<?php echo $result_guest_adm['price'] ?>">
                            <input type="hidden" name="guest_hotel" id="guest_hotel" value="<?php echo $_POST['hotel'] ?>">
                            <input type="hidden" name="guide_hotel" id="guide_hotel" value="<?php echo  '0' ?>">
                            <input type="hidden" name="foc_hotel" id="foc_hotel" value="<?php echo '0' ?>">
                            <input type="hidden" name="val_meal" id="val_meal" value="<?php echo '1' ?>">
                            <input type="hidden" name="val_adm" id="val_adm" value="<?php echo '1' ?>">

                            <input type="hidden" name="guide" id="guide" value="<?php echo  $_POST['guide'] ?>">
                            <input type="hidden" name="foc" id="foc" value="<?php echo $_POST['foc'] ?>">
                            <input type="hidden" name="val_adm_price" id="val_adm_price" value="<?php echo $result_guest_adm['price'] ?>">
                            <input type="hidden" name="val_guest_meal_price" id="val_guest_meal_price" value="<?php echo $result_guest_meal['price'] ?>">
                            <button type="submit" class="btn btn-warning btn-sm" onclick=""><i class="fa fa-print"></i> Print</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
} else {
?>
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
            <use xlink:href="#exclamation-triangle-fill" />
        </svg>
        <div>
            Data Rent Transport kosong
        </div>
    </div>
<?php
}
?>
<script>
    $(document).ready(function() {
        $('#price-custom').DataTable({
            "aLengthMenu": [
                [5, 10, 25, -1],
                [5, 10, 25, "All"]
            ],
            "iDisplayLength": 5
        });
    });
</script>