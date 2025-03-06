<?php
include "../site.php";
include "../db=connection.php";
include "../Activity/Api/Api_request.php";
session_start();
$date = date("Y-m-d H:i:s");
$id = $_POST['id'];

// var_dump($id);
$query = "SELECT * FROM  atraction_order where id=".$id;
$rs = mysqli_query($con, $query);
$row = mysqli_fetch_array($rs);
if($row['id'] != ""){
    if($row['bookid']==""){
        $data = stripslashes($row['produk']);
        $cart_data = json_decode($data, true);
        $arr_additional = array(
         "type" => "OTHERS",
         "name" => "ANY_NAME",
         "value" => "ANY_VALUE"
         );
        $cart_tiket = array();
        $i=0;
        foreach ($cart_data as $keys => $values) {
            $cart_tiket[] = array(
                "index" => $i,
                    "id"  => intval($values['item_id']),
                    "fromResellerId" => null,
                    "quantity" => intval($values["item_quantity"]),
                    "redeemStart" => null,
                    "redeemEnd" => null,
                    "additionalDetails" => array(
                        $arr_additional,
                    )
            );
            $i++;
        }
        // var_dump($cart_tiket);
        
        $data_check = array(
            "ticketTypes" => $cart_tiket,
            "customerName" => $row['customer'],
            "email" => $row['email'],
            "paymentMethod" => "CREDIT",
            "additionalDetails" => array(
                $arr_additional,
            )
        );
        $datareq = array(
            "type" => $_SESSION['type'],
            "token" => $_SESSION['token'],
            "data" => $data_check
        );
        //var_dump($datareq);
        $checkout = get_checkout($datareq);
        $result_checkout = json_decode($checkout, true);
        // var_dump($result_checkout);
        if($result_checkout['success']==true){
            $hasil = $result_checkout['data']['data'];
            // var_dump($hasil['reference_number']);
            $sql = "UPDATE atraction_order SET bookid='".$hasil['reference_number']."', status='1' WHERE id=".$id;
            if (mysqli_query($con, $sql)) {
                echo "success";
                // echo $sql;
            } else {
                echo "Error: " . $sql . "" . mysqli_error($con);
            }
            $con->close();
        }else{
        
        echo "failed";
        }
    }else{
        echo "sudah terbook !";
    }
}else{
    echo "gagal";
}

// var_dump($result_checkout['data']);
