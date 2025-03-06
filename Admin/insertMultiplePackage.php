<?php
include "../site.php";
include "../db=connection.php";

$name = $_POST['name'];
$category = $_POST['category'];
$desc = $_POST['desc'];
$type = $_POST['type'];
$duration = $_POST['duration'];
$departure = $_POST['departure'];
$minperson = $_POST['minperson'];
$tipping = $_POST['tipping'];
$tour_package = $_POST['tour_package'];
$tour_package_count = $_POST['tour_package_count'];
$kurs = $_POST['kurs'];

$tempTourPackage = preg_split ("/[\s;]+/", $tour_package);
$country = "";
$city = "";
$img = "";
$img_head = "";
for($i=0; $i<count($tempTourPackage); $i++){
    $query = "SELECT * FROM tour_package WHERE id = ".$tempTourPackage[$i];
    $rs=mysqli_query($con,$query);
    $row = mysqli_fetch_array($rs);

    if($i==0){
        $country = $country . $row['country'];
        $city = $city . $row['city'];
        $img = $row['img'];
        $img_head = $row['img_head'];
    }else{
        $country = $country .";". $row['country'];
        $city = $city .";". $row['city'];
    }

}
$sql = "INSERT INTO tour_package VALUES ('','".$name."','".$desc."','".$category."','".$type."',0,0,".$duration.",'".$departure."',".$minperson.",".$tipping.",".$kurs.",'".$country."','".$city."','','".$img."','".$img_head."',0,0)";
if (mysqli_query($con, $sql)) {

    $querylastid = "SELECT id FROM tour_package ORDER BY id DESC LIMIT 1";
    $rslastid=mysqli_query($con,$querylastid);
    $rowlastid = mysqli_fetch_array($rslastid);
    $lastId = $rowlastid['id'];

    for($i=0; $i<count($tempTourPackage); $i++){
        $queryitinerary = "SELECT * FROM itinerary WHERE tour_package = ".$tempTourPackage[$i];
        $rsitinerary=mysqli_query($con,$queryitinerary);
        while($rowitinerary = mysqli_fetch_array($rsitinerary)){
            $sqlitinerary = "INSERT INTO itinerary VALUES ('','".$rowitinerary['name']."',".$rowitinerary['day'].",'".$rowitinerary['description']."',".$lastId.",'".$rowitinerary['img']."')";
            mysqli_query($con, $sqlitinerary);
        }

        $queryinclusion = "SELECT * FROM inclusion WHERE tour_package = ".$tempTourPackage[$i];
        $rsinclusion=mysqli_query($con,$queryinclusion);
        while($rowinclusion = mysqli_fetch_array($rsinclusion)){
            $sqlinclusion = "INSERT INTO inclusion VALUES ('','".$rowinclusion['name']."',".$lastId.")";
             mysqli_query($con, $sqlinclusion);
        }

        $queryexclusion = "SELECT * FROM exclusion WHERE tour_package = ".$tempTourPackage[$i];
        $rsexclusion=mysqli_query($con,$queryexclusion);
        while($rowexclusion = mysqli_fetch_array($rsexclusion)){
            $sqlexclusion = "INSERT INTO exclusion VALUES ('','".$rowexclusion['name']."',".$lastId.")";
             mysqli_query($con, $sqlexclusion);
        }

        $querytermsandconditions = "SELECT * FROM termsandconditions WHERE tour_package = ".$tempTourPackage[$i];
        $rstermsandconditions=mysqli_query($con,$querytermsandconditions);
        while($rowtermsandconditions = mysqli_fetch_array($rstermsandconditions)){
            $sqltermsandconditions = "INSERT INTO termsandconditions VALUES ('','".$rowtermsandconditions['name']."',".$lastId.")";
             mysqli_query($con, $sqltermsandconditions);
        }

        $queryremark = "SELECT * FROM remark WHERE tour_package = ".$tempTourPackage[$i];
        $rsremark=mysqli_query($con,$queryremark);
        while($rowremark = mysqli_fetch_array($rsremark)){
            $sqlremark = "INSERT INTO remark VALUES ('','','".$rowremark['description']."',".$lastId.")";
             mysqli_query($con, $sqlremark);
        }

        $querytour_price_package = "SELECT * FROM tour_price_package WHERE tour_package = ".$tempTourPackage[$i];
        $rstour_price_package=mysqli_query($con,$querytour_price_package);
        while($rowtour_price_package = mysqli_fetch_array($rstour_price_package)){

            $sqltour_price_package = "INSERT INTO tour_price_package VALUES ('','".$rowtour_price_package['name']."',".$rowtour_price_package['price_package'].",".$lastId.",0)";
            mysqli_query($con, $sqltour_price_package);

            $querylastid2 = "SELECT id FROM tour_price_package ORDER BY id DESC LIMIT 1";
            $rslastid2=mysqli_query($con,$querylastid2);
            $rowlastid2 = mysqli_fetch_array($rslastid2);
            $lastId2 = $rowlastid2['id'];

            $querytour_price_detail = "SELECT * FROM tour_price_detail WHERE tour_price_package = ".$rowtour_price_package['id'];
            $rstour_price_detail=mysqli_query($con,$querytour_price_detail);

            while($rowtour_price_detail = mysqli_fetch_array($rstour_price_detail)){
                $sqltour_price_detail = "INSERT INTO tour_price_detail VALUES ('',".$rowtour_price_detail['person'].",".$rowtour_price_detail['personplus'].",".$rowtour_price_detail['price'].",".$rowtour_price_detail['cwb'].",".$rowtour_price_detail['cnb'].",".$rowtour_price_detail['inf'].",".$rowtour_price_detail['adt'].",".$rowtour_price_detail['adt_sub'].",".$rowtour_price_detail['kurs'].",".$lastId2.")";
                if(mysqli_query($con, $sqltour_price_detail)){

                }else{
                    echo "Error: " . $sql . "" . mysqli_error($con);
                }
            }   
        }
    }

    $query = "SELECT * FROM performa_price_range";
    $rs=mysqli_query($con,$query);
    while($row = mysqli_fetch_array($rs)){
        $sql2 = "INSERT INTO performa_price VALUES ('',".$row['id'].",5,0,0,1,0,0,0,".$lastId.")";
        mysqli_query($con, $sql2);
    }
    echo "success";

} else {
    echo "Error: " . $sql . "" . mysqli_error($con);
}
$con->close();


?>