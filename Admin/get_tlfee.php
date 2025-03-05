<?php
include "../site.php";
include "../db=connection.php";
//export.php  

$datax = [];
// $fee = '';
// $sfee = '';
// $vocer = '';
// $meal = '';
// var_dump($_POST['data']);
$data = json_decode($_POST['data'], true);
$day = $_POST['day'];
$peserta = $_POST['peserta'];
$total_fee = 0;
$total_sfee = 0;
$total_meal = 0;
$total_vocer = 0;
$total_hotel = 0;
$total_transport = 0;
for ($i = 0; $i < $day; $i++) {

      if ($data['fee'][$i] != null) {
            $sql_fee = "SELECT * FROM TL_itin WHERE id='" . $data['fee'][$i] . "'";
            $result_fee = mysqli_query($con, $sql_fee);
            // var_dump( $sql_bf);
            while ($row_fee = mysqli_fetch_array($result_fee)) {
                  $fee = $row_fee['price'];
                  $total_fee = $total_fee + $fee;
                  
            }
      }
      if ($data['sfee'][$i] != null) {
            $sql_sfee = "SELECT * FROM TL_itin WHERE id='" . $data['sfee'][$i] . "'";
            $result_sfee = mysqli_query($con, $sql_sfee);
            while ($row_sfee = mysqli_fetch_array($result_sfee)) {
                  $sfee = $row_sfee['price'];
                  $total_sfee = $total_sfee + $sfee;
            }
      }
      if ($data['meal'][$i] != null) {
            $sql_meal = "SELECT * FROM TL_itin WHERE id='" . $data['meal'][$i] . "'";
            $result_meal = mysqli_query($con, $sql_meal);
            while ($row_meal = mysqli_fetch_array($result_meal)) {
                  $meal = $row_meal['price'];
                  $total_meal = $total_meal + $meal;
            }
      }
      if ($data['vocer'][$i] != null) {
            $sql_vocer = "SELECT * FROM TL_itin WHERE id='" . $data['vocer'][$i] . "'";
            $result_vocer = mysqli_query($con, $sql_vocer);
            while ($row_vocer = mysqli_fetch_array($result_vocer)) {
                  $vocer = $row_vocer['price'];
                  $total_vocer = $total_vocer + $vocer;
            }
      }
      if ($data['hotel'][$i] != null) {
            $sql_hotel = "SELECT * FROM TL_itin WHERE id='" . $data['hotel'][$i] . "'";
            $result_hotel = mysqli_query($con, $sql_hotel);
            while ($row_hotel = mysqli_fetch_array($result_hotel)) {
                  $hotel = $row_hotel['price'];
                  $total_hotel = $total_hotel + $hotel;
            }
      }
      if ($data['transport'][$i] != null) {
            $sql_transport = "SELECT * FROM TL_itin WHERE id='" . $data['transport'][$i] . "'";
            $result_transport = mysqli_query($con, $sql_transport);
            while ($row_transport = mysqli_fetch_array($result_transport)) {
                  $transport = $row_transport['price'];
                  $total_transport = $total_transport + $transport;
            }
      }
}
$total = ($total_transport+$total_hotel+$total_meal+$total_vocer) / $peserta;
$totalx = ($total_transport+$total_hotel+$total_meal+$total_vocer+$total_fee+$total_sfee) / $peserta;
array_push($datax, array("tl" => $totalx, "bp" => $total));
echo json_encode($datax);


// if ($_POST['fee']) {
//       $sql_fee = "SELECT * FROM TL_itin WHERE id='" . $_POST['fee'] . "'";
//       $result_fee = mysqli_query($con, $sql_fee);
//       // var_dump( $sql_bf);
//       while ($row_fee = mysqli_fetch_array($result_fee)) {
//             $fee = $row_fee['price'];
//       }
// }

// if ($_POST['sfee']) {
//       $sql_sfee = "SELECT * FROM TL_itin WHERE id='" . $_POST['sfee'] . "'";
//       $result_sfee = mysqli_query($con, $sql_sfee);
//       // var_dump( $sql_bf);
//       while ($row_sfee = mysqli_fetch_array($result_sfee)) {
//             //      array_push($data,array("id" => $row_bf['id'],"kurs" => $row_bf['kurs'],"price" => $row_bf['price']));
//             $sfee = $row_sfee['price'];
//       }
//       // // var_dump($sql_guide);
//       // echo json_encode($data);

// }
// if ($_POST['vocer']) {
//       $sql_vocer = "SELECT * FROM TL_itin WHERE id='" . $_POST['vocer'] . "'";
//       $result_vocer = mysqli_query($con, $sql_vocer);
//       // var_dump( $sql_bf);
//       while ($row_vocer = mysqli_fetch_array($result_vocer)) {
//             //      array_push($data,array("id" => $row_bf['id'],"kurs" => $row_bf['kurs'],"price" => $row_bf['price']));
//             $vocer = $row_vocer['price'];
//       }
//       // // var_dump($sql_guide);
//       // echo json_encode($data);

// }
// if ($_POST['meal']) {
//       $sql_meal = "SELECT * FROM TL_itin WHERE id='" . $_POST['meal'] . "'";
//       $result_meal = mysqli_query($con, $sql_meal);
//       // var_dump( $sql_bf);
//       while ($row_meal = mysqli_fetch_array($result_meal)) {
//             //      array_push($data,array("id" => $row_bf['id'],"kurs" => $row_bf['kurs'],"price" => $row_bf['price']));
//             $meal = $row_meal['price'];
//       }
//       // // var_dump($sql_guide);
//       // echo json_encode($data);

// }
// array_push($data, array("fee" => $fee, "sfee" => $sfee,"vocer" => $vocer,"meal" =>$meal));
// echo json_encode($data);
