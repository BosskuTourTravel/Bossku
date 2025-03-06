<html>

<head>
    <title>Priview Itinerary</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<?php
include "../site.php";
include "../db=connection.php";
include "api_get_price_lt.php";

$master_id = $_GET['id'];
$tl_pax = $_POST['tl_pax'];
$tl_fee = $_POST['tl_fee'];
$tl_meal = $_POST['tl_meal'];
$tl_tlpn = $_POST['tl_tlpn'];
$tl_sfee = $_POST['tl_sfee'];
$lain = $_POST['lain'];

$data = array(
"master_id"=> $master_id,
"tl_pax"=> $tl_pax,
"tl_fee"=> $tl_fee,
"tl_meal"=> $tl_meal,
"tl_tlpn"=> $tl_tlpn,
"tl_sfee"=> $tl_sfee,
"lain"=> $lain  
);

$show = get_price_lain($data);
$result = json_decode($show, true);


?>

<body>

    <!-- <script>
        var kode = "<?php
                    $judul = "NO_CODE";
                    if ($row_data['landtour'] != "undefined") {
                        $judul = $row_data['landtour'];
                    }
                    echo $judul;
                    ?>";
        var judul = "<?php echo $row_data['judul'] ?>";
        document.title = kode + "-" + judul;
        window.print();
    </script> -->
</body>

</html>