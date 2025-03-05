
<?php

function get_paket_tour()
{
    include "../db=connection.php";
    $query = "SELECT LTSUB_itin.id,LTSUB_itin.master_id,LTP_grub_flight.id AS grub_id,LTSUB_itin.judul,LT_change_judul.nama as change_judul,LTSUB_itin.landtour,LT_itinnew.city_in,LT_itinnew.city_out ,LTP_grub_flight.grub_name,login_staff.name as staff FROM LTSUB_itin LEFT JOIN login_staff ON LTSUB_itin.status=login_staff.id LEFT JOIN LT_itinnew ON LTSUB_itin.landtour=LT_itinnew.kode LEFT JOIN LTP_grub_flight ON LT_itinnew.city_in=LTP_grub_flight.city_in && LT_itinnew.city_out=LTP_grub_flight.city_out LEFT JOIN LT_change_judul ON LT_change_judul.grub_id=LTP_grub_flight.id && LT_change_judul.copy_id=LTSUB_itin.id GROUP by LTSUB_itin.id order by id ASC";
    $rs = mysqli_query($con, $query);
    $data = [];
    while ($row = mysqli_fetch_array($rs)) {
        if ($row['grub_id'] != NULL) {
            // $judul = $row['judul'];
            // if($row['change_judul'] !=null){
            //     $judul = $row['change_judul'];
            // }
            // echo $row['id']." ". $row['grub_id']." ". $row['grub_id']." ".$judul." ". $row['grub_name']." by ". $row['staff']."</br>";
            array_push($data, $row);
        }
    }
    return json_encode($data, true);
}
function get_rent()
{
    include "../db=connection.php";
    $query = " SELECT Transport_new.id,agent_transport.company,Transport_new.country,Transport_new.city,Transport_new.periode,Transport_new.trans_type,Transport_new.seat,Transport_new.kurs,Transport_new.oneway,Transport_new.twoway,Transport_new.hd1,Transport_new.hd2,Transport_new.fd1,Transport_new.fd2,Transport_new.kaisoda,Transport_new.luarkota,Transport_new.img FROM  Transport_new LEFT JOIN agent_transport ON Transport_new.agent=agent_transport.id  order by id ASC";
    $rs = mysqli_query($con, $query);
    $data = [];
    while ($row = mysqli_fetch_array($rs)) {
        array_push($data, $row);
    }
    return json_encode($data, true);
}
function get_landtour()
{
    include "../db=connection.php";
    $query = "SELECT LT_itinerary2.id,LT_itinerary2.judul,LT_itinerary2.landtour,LT_itinnew.no_urut,LT_itinnew.negara,LT_itinnew.kota,LT_itinnew.kurs,LT_itinnew.pax,LT_itinnew.pax_u,LT_itinnew.pax_b,LT_itinnew.twn,LT_itinnew.sgl,LT_itinnew.cnb,LT_itinnew.sgl_sub,LT_itinnew.infant,LT_itinnew.agent_twn,LT_itinnew.agent_sgl,LT_itinnew.agent_cnb,LT_itinnew.agent_sglsub,LT_itinnew.agent_infant,LT_itinnew.hotel1,LT_itinnew.hotel2,LT_itinnew.hotel3,LT_itinnew.hotel4,LT_itinnew.hotel5,LT_itinnew.hotel6,LT_itinnew.hotel7,LT_itinnew.hotel8,LT_itinnew.hotel9,LT_itinnew.hotel10,LT_itinnew.statuss FROM LT_itinerary2 INNER JOIN LT_itinnew ON LT_itinerary2.landtour=LT_itinnew.kode ORDER by LT_itinerary2.id ASC";
    $rs = mysqli_query($con, $query);
    $data = [];
    while ($row = mysqli_fetch_array($rs)) {
        array_push($data, $row);
    }
    return json_encode($data, true);
}
?>