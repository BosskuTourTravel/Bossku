<?php
include "../site.php";
include "../db=connection.php";
session_start();

$name = $_POST['name'];
$category = $_POST['category'];
$desc = $_POST['desc'];
$type = $_POST['type'];
$duration = $_POST['duration'];
$departure = $_POST['departure'];
$minperson = $_POST['minperson'];
$tipping = $_POST['tipping'];
$country = $_POST['country'];
$city = $_POST['city'];
$kurs = $_POST['kurs'];
$agent = $_POST['agent'];
$city_count = $_POST['city_count'];
date_default_timezone_set('Asia/Jakarta');
$timedate = date("Y-m-d H:i:s");
$date = date('Y/m/d');
//*** edit neno */
// $staff =$_SESSION['staff_id'];
// $job = '28';
// $keterangan = "input Lantour";
// $jumlah = '1';
// $queryjob = "SELECT * FROM jenisgaji WHERE id = ".$job;
// $rsj=mysqli_query($con,$queryjob);
// $rowj = mysqli_fetch_array($rsj);
// $harga = $rowj['harga'];
// $total=$jumlah * $harga;
//*************/
$tempCountry = preg_split ("/[;\s]+/", $country);

$query_country = "SELECT * FROM country WHERE id=".$tempCountry[0];
$rs_country=mysqli_query($con,$query_country);
$row_country = mysqli_fetch_array($rs_country);


if($_SESSION['staff_id']=='null' || $_SESSION['staff_id']=='undefined' || $_SESSION['staff_id']==''){
	 echo "<script>alert('Session Login Berakhir, Harap Login Kembali!');</script>";
     echo "<script>window.location='https://www.2canholiday.com/member/';</script>";
}
if($_POST['files_id']!=0){
    $files_id = $_POST['files_id'];

    $query_agentfiles = "SELECT * FROM agent_files WHERE id=".$files_id;
    $rs_agentfiles=mysqli_query($con,$query_agentfiles);
    $row_agentfiles = mysqli_fetch_array($rs_agentfiles);

    $country = $row_agentfiles['country'];
    $city = $row_agentfiles['city'];
    $city_count = $row_agentfiles['city_count'];
}else{
    $files_id = 0;
}



// $date2 = date('Y-m-d');
// $to = $_POST['to'];
// $out = $_POST['out'];
// $destination_to = $_POST['destination_to'];
// $destination_out = $_POST['destination_out'];
// $query_flight_city = "SELECT COUNT(*) as total FROM tour_package_flight_city WHERE tour_package=".$id;
// $rs_flight_city=mysqli_query($con,$query_flight_city);
// $row_flight_city = mysqli_fetch_assoc($rs_flight_city);
// if($row_flight_city['total']>0){
//   $sql_flight = "UPDATE tour_package_flight_city SET tos='".$to."', outs='".$out."', destination_to='".$destination_to."', destination_out='".$destination_out."', stamp_update='".$date2."' WHERE tour_package=".$id;
//   if (mysqli_query($con, $sql_flight)) {

//   } else {
//     echo "Error: " . $sql_flight . "" . mysqli_error($con);
//   }
// }else{
//     $sql_flight = "INSERT INTO tour_package_flight_city values('',".$id.",'".$to."','".$out."','".$destination_to."','".$destination_out."',".$_SESSION['staff_id'].",'0000-00-00','".$date2."')";
//     if (mysqli_query($con, $sql_flight)) {

//     } else {
//         echo "Error: " . $sql_flight . "" . mysqli_error($con);
//     }
// }


if($_POST['code']==0){
// ///****** end neno edit ****
    $sql = "INSERT INTO tour_package VALUES ('',".$agent.",'".$name."','".$desc."','".$category."','".$type."',0,0,".$duration.",'".$departure."',".$minperson.",".$tipping.",".$kurs.",'".$row_country['continent']."','".$country."','".$city."','".$city_count."','','','',".$files_id.",0,".$_SESSION['staff_id'].",0,'".$timedate."','".$date."')";

    if (mysqli_query($con, $sql)) {
        // $sqljob = "INSERT INTO total_job VALUES ('','".$timedate."','".$staff."','".$job."','".$name."','','".$jumlah."','".$total."')";
        // mysqli_query($con, $sqljob);

        $query2 = "SELECT id FROM tour_package ORDER BY id DESC LIMIT 1";
        $rs2=mysqli_query($con,$query2);
        $row2 = mysqli_fetch_array($rs2);
        $tour_package = $row2['id'];


        $tempCountry = preg_split ("/[;]+/", $country);
        $check = 0;
        $i = 0;
        if(count($tempCountry)!=0){
            while($i<count($tempCountry) && $check!=1){
                $querypriceAgent2 = "SELECT COUNT(*) as total FROM performa_price_standart WHERE agent=".$agent." and country LIKE '%".$tempCountry[$i]."%'";
                $rspriceAgent2=mysqli_query($con,$querypriceAgent2);
                $rowpriceAgent2=mysqli_fetch_assoc($rspriceAgent2);

                if($rowpriceAgent2['total']==0){
                //standart taiwan - agent baodao
                    $querypriceAgent = "SELECT * FROM performa_price_standart WHERE agent=524 and country=158";
                    $rspriceAgent=mysqli_query($con,$querypriceAgent);
            //

                    $check = 1;
                    while($rowpriceAgent = mysqli_fetch_array($rspriceAgent)){
                        if(substr($rowpriceAgent['agentcom'],-1) == '%'){
                            $commision = substr($rowpriceAgent['agentcom'],0,-1);
                        }
                        $sql2 = "INSERT INTO performa_price VALUES ('',".$rowpriceAgent['performa_price_range'].",".$rowpriceAgent['persentase'].",".$rowpriceAgent['nominal'].",".$commision.",1,'".$rowpriceAgent['staffcom']."','".$rowpriceAgent['staffcom2']."','".$rowpriceAgent['subagent']."','".$rowpriceAgent['marketingcom']."',".$rowpriceAgent['discount'].",".$tour_package.")";
                        mysqli_query($con, $sql2);
                    }


                }else{
                   $check = 1;
                   $querypriceAgent = "SELECT * FROM performa_price_standart WHERE agent=".$agent." and country LIKE '%".$tempCountry[$i]."%'";
                   $rspriceAgent=mysqli_query($con,$querypriceAgent);
                   while($rowpriceAgent = mysqli_fetch_array($rspriceAgent)){
                    if(substr($rowpriceAgent['agentcom'],-1) == '%'){
                        $commision = substr($rowpriceAgent['agentcom'],0,-1);
                    }
                    $sql2 = "INSERT INTO performa_price VALUES ('',".$rowpriceAgent['performa_price_range'].",".$rowpriceAgent['persentase'].",".$rowpriceAgent['nominal'].",".$commision.",1,'".$rowpriceAgent['staffcom']."','".$rowpriceAgent['staffcom2']."','".$rowpriceAgent['subagent']."','".$rowpriceAgent['marketingcom']."',".$rowpriceAgent['discount'].",".$tour_package.")";
                    mysqli_query($con, $sql2);
                }
            }

            $i = $i+1;
        }

    }else{
        //standart taiwan - agent baodao
        $querypriceAgent = "SELECT * FROM performa_price_standart WHERE agent=524 and country=158";
        $rspriceAgent=mysqli_query($con,$querypriceAgent);
            //

        $check = 1;
        while($rowpriceAgent = mysqli_fetch_array($rspriceAgent)){
            if(substr($rowpriceAgent['agentcom'],-1) == '%'){
                $commision = substr($rowpriceAgent['agentcom'],0,-1);
            }
            $sql2 = "INSERT INTO performa_price VALUES ('',".$rowpriceAgent['performa_price_range'].",".$rowpriceAgent['persentase'].",".$rowpriceAgent['nominal'].",".$commision.",1,'".$rowpriceAgent['staffcom']."','".$rowpriceAgent['staffcom2']."','".$rowpriceAgent['subagent']."','".$rowpriceAgent['marketingcom']."',".$rowpriceAgent['discount'].",".$tour_package.")";
            mysqli_query($con, $sql2);
        }
    }

        if($check == 0){
            $query = "SELECT * FROM performa_price_range";
            $rs=mysqli_query($con,$query);
            while($row = mysqli_fetch_array($rs)){
                $sql2 = "INSERT INTO performa_price VALUES ('',".$row['id'].",0,0,0,1,0,0,0,0,0,".$tour_package.")";
                mysqli_query($con, $sql2);
            }
        }

        $sql_files = "UPDATE agent_files SET status=1 WHERE id=".$files_id;
        if (mysqli_query($con, $sql_files)) {
            echo "success";

          } else {
              echo "Error: " . $sql_files . "" . mysqli_error($con);
              header("location:https://www.2canholiday.com/Admin/#");
          }

    } else {
        echo "Error: " . $sql . "" . mysqli_error($con);
        header("location:https://www.2canholiday.com/Admin/#");
    }
    $con->close();
}else if($_POST['code']==2){

    $target_dir = "../assets/i/tour_package/";
    $target_dir2 = "assets/i/tour_package/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_file2 = $target_dir2 . basename($_FILES["fileToUpload"]["name"]);

    $target_filex = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
    $target_filex2 = $target_dir2 . basename($_FILES["fileToUpload2"]["name"]);

    $uploadOk = 1;
    $imageFileTypex = strtolower(pathinfo($target_filex,PATHINFO_EXTENSION));

    $checkx = getimagesize($_FILES["fileToUpload2"]["tmp_name"]);
    if($checkx !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
    if (file_exists($target_filex)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if($imageFileTypex != "jpg" && $imageFileTypex != "png" && $imageFileTypex != "jpeg"
        && $imageFileTypex != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_filex)) {

            $sql = "INSERT INTO tour_package VALUES ('',".$agent.",'".$name."','".$desc."','".$category."','".$type."',0,0,".$duration.",'".$departure."',".$minperson.",".$tipping.",".$kurs.",'".$row_country['continent']."','".$country."','".$city."','".$city_count."','','','".$target_filex2."',".$files_id.",0,".$_SESSION['staff_id'].",0,'".$timedate."','".$date."')";
            if (mysqli_query($con, $sql)) {
                // $sqljob = "INSERT INTO total_job VALUES ('','".$timedate."','".$staff."','".$job."','".$name."','','".$jumlah."','".$total."')";
                // mysqli_query($con, $sqljob);

                $query2 = "SELECT id FROM tour_package ORDER BY id DESC LIMIT 1";
                $rs2=mysqli_query($con,$query2);
                $row2 = mysqli_fetch_array($rs2);
                $tour_package = $row2['id'];
                
                $tempCountry = preg_split ("/[\s;]+/", $country);
                $check = 0;
                $i = 0;
                    //while($i<count($tempCountry) && $check!=1){
                        // $querypriceAgent = "SELECT * FROM performa_price_standart WHERE agent=".$agent." and country LIKE '%".$tempCountry[$i]."%'";
                // $rspriceAgent=mysqli_query($con,$querypriceAgent);

                // $querypriceAgent2 = "SELECT COUNT(*) as total FROM performa_price_standart WHERE agent=".$agent." and country LIKE '%".$tempCountry[$i]."%'";
                // $rspriceAgent2=mysqli_query($con,$querypriceAgent2);
                // $rowpriceAgent2=mysqli_fetch_assoc($rspriceAgent2);

                //standart taiwan - agent baodao
                    $querypriceAgent = "SELECT * FROM performa_price_standart WHERE agent=524 and country=158";
                    $rspriceAgent=mysqli_query($con,$querypriceAgent);

                    $querypriceAgent2 = "SELECT COUNT(*) as total FROM performa_price_standart WHERE agent=524 and country=158";
                    $rspriceAgent2=mysqli_query($con,$querypriceAgent2);
                    $rowpriceAgent2=mysqli_fetch_assoc($rspriceAgent2);
                //

                    if($rowpriceAgent2['total']>0){
                        $check = 1;
                        while($rowpriceAgent = mysqli_fetch_array($rspriceAgent)){
                            if(substr($rowpriceAgent['agentcom'],-1) == '%'){
                                $commision = substr($rowpriceAgent['agentcom'],0,-1);
                            }
                            $sql2 = "INSERT INTO performa_price VALUES ('',".$rowpriceAgent['performa_price_range'].",".$rowpriceAgent['persentase'].",".$rowpriceAgent['nominal'].",".$commision.",1,'".$rowpriceAgent['staffcom']."','".$rowpriceAgent['subagent']."','".$rowpriceAgent['marketingcom']."',".$rowpriceAgent['discount'].",".$tour_package.")";
                            mysqli_query($con, $sql2);
                        }
                    }else{
                        $check = 0;
                    }
                    $i = $i+1;
                //}

                if($check == 0){
                    $query = "SELECT * FROM performa_price_range";
                    $rs=mysqli_query($con,$query);
                    while($row = mysqli_fetch_array($rs)){
                        $sql2 = "INSERT INTO performa_price VALUES ('',".$row['id'].",0,0,0,1,0,0,0,0,".$tour_package.")";
                        mysqli_query($con, $sql2);
                    }
                }
               $sql_files = "UPDATE agent_files SET status=1 WHERE id=".$files_id;
               if (mysqli_query($con, $sql_files)) {
                echo "success";

                } else {
                  echo "Error: " . $sql_files . "" . mysqli_error($con);
                  header("location:https://www.2canholiday.com/Admin/#");
              }
                
            } else {
                echo "Error: " . $sql . "" . mysqli_error($con);
                header("location:https://www.2canholiday.com/Admin/#");
            }
            $con->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
            header("location:https://www.2canholiday.com/Admin/#");
        }
    }

}else if($_POST['code']==3){
    $target_dir = "../assets/i/tour_package/";
    $target_dir2 = "assets/i/tour_package/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_file2 = $target_dir2 . basename($_FILES["fileToUpload"]["name"]);

    $target_filex = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
    $target_filex2 = $target_dir2 . basename($_FILES["fileToUpload2"]["name"]);

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $checkx = getimagesize($_FILES["fileToUpload2"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            $sql = "INSERT INTO tour_package VALUES ('',".$agent.",'".$name."','".$desc."','".$category."','".$type."',0,0,".$duration.",'".$departure."',".$minperson.",".$tipping.",".$kurs.",'".$row_country['continent']."','".$country."','".$city."','".$city_count."','','".$target_file2."','',".$files_id.",0,".$_SESSION['staff_id'].",0,'".$timedate."','".$date."')";
            if (mysqli_query($con, $sql)) {
                // $sqljob = "INSERT INTO total_job VALUES ('','".$timedate."','".$staff."','".$job."','".$name."','','".$jumlah."','".$total."')";
                // mysqli_query($con, $sqljob);

                $query2 = "SELECT id FROM tour_package ORDER BY id DESC LIMIT 1";
                $rs2=mysqli_query($con,$query2);
                $row2 = mysqli_fetch_array($rs2);
                $tour_package = $row2['id'];
                
                $tempCountry = preg_split ("/[\s;]+/", $country);
                $check = 0;
                $i = 0;
                //while($i<count($tempCountry) && $check!=1){
                           // $querypriceAgent = "SELECT * FROM performa_price_standart WHERE agent=".$agent." and country LIKE '%".$tempCountry[$i]."%'";
                    // $rspriceAgent=mysqli_query($con,$querypriceAgent);

                    // $querypriceAgent2 = "SELECT COUNT(*) as total FROM performa_price_standart WHERE agent=".$agent." and country LIKE '%".$tempCountry[$i]."%'";
                    // $rspriceAgent2=mysqli_query($con,$querypriceAgent2);
                    // $rowpriceAgent2=mysqli_fetch_assoc($rspriceAgent2);

                    //standart taiwan - agent baodao
                        $querypriceAgent = "SELECT * FROM performa_price_standart WHERE agent=524 and country=158";
                        $rspriceAgent=mysqli_query($con,$querypriceAgent);

                        $querypriceAgent2 = "SELECT COUNT(*) as total FROM performa_price_standart WHERE agent=524 and country=158";
                        $rspriceAgent2=mysqli_query($con,$querypriceAgent2);
                        $rowpriceAgent2=mysqli_fetch_assoc($rspriceAgent2);
                    //

                    if($rowpriceAgent2['total']>0){
                        $check = 1;
                        while($rowpriceAgent = mysqli_fetch_array($rspriceAgent)){
                            if(substr($rowpriceAgent['agentcom'],-1) == '%'){
                                $commision = substr($rowpriceAgent['agentcom'],0,-1);
                            }
                            $sql2 = "INSERT INTO performa_price VALUES ('',".$rowpriceAgent['performa_price_range'].",".$rowpriceAgent['persentase'].",".$rowpriceAgent['nominal'].",".$commision.",1,'".$rowpriceAgent['staffcom']."','".$rowpriceAgent['staffcom2']."','".$rowpriceAgent['subagent']."','".$rowpriceAgent['marketingcom']."',".$rowpriceAgent['discount'].",".$tour_package.")";
                            mysqli_query($con, $sql2);
                        }
                    }else{
                        $check = 0;
                    }
                    $i = $i+1;
                //}

                if($check == 0){
                    $query = "SELECT * FROM performa_price_range";
                    $rs=mysqli_query($con,$query);
                    while($row = mysqli_fetch_array($rs)){
                        $sql2 = "INSERT INTO performa_price VALUES ('',".$row['id'].",0,0,0,1,0,0,0,0,0,".$tour_package.")";
                        mysqli_query($con, $sql2);
                    }
                }
                $sql_files = "UPDATE agent_files SET status=1 WHERE id=".$files_id;
                if (mysqli_query($con, $sql_files)) {
                    echo "success";

                  } else {
                      echo "Error: " . $sql_files . "" . mysqli_error($con);
                      header("location:https://www.2canholiday.com/Admin/#");
                  }
                
            } else {
                echo "Error: " . $sql . "" . mysqli_error($con);
                header("location:https://www.2canholiday.com/Admin/#");
            }
            $con->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
            header("location:https://www.2canholiday.com/Admin/#");
        }
    }
}else{
    $target_dir = "../assets/i/tour_package/";
    $target_dir2 = "assets/i/tour_package/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_file2 = $target_dir2 . basename($_FILES["fileToUpload"]["name"]);

    $target_filex = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
    $target_filex2 = $target_dir2 . basename($_FILES["fileToUpload2"]["name"]);

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $imageFileTypex = strtolower(pathinfo($target_filex,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    $checkx = getimagesize($_FILES["fileToUpload2"]["tmp_name"]);
    if($check !== false and $checkx !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
    if (file_exists($target_file) or file_exists($target_filex)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }


    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileTypex != "jpg" && $imageFileTypex != "png" && $imageFileTypex != "jpeg"
        && $imageFileTypex != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) && move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_filex)) {

            $sql = "INSERT INTO tour_package VALUES ('',".$agent.",'".$name."','".$desc."','".$category."','".$type."',0,0,".$duration.",'".$departure."',".$minperson.",".$tipping.",".$kurs.",'".$row_country['continent']."','".$country."','".$city."','".$city_count."','','".$target_file2."','".$target_filex2."',".$files_id.",0,".$_SESSION['staff_id'].",0,'".$timedate."','".$date."')";
            if (mysqli_query($con, $sql)) {
                // $sqljob = "INSERT INTO total_job VALUES ('','".$timedate."','".$staff."','".$job."','".$name."','','".$jumlah."','".$total."')";
                // mysqli_query($con, $sqljob);

                $query2 = "SELECT id FROM tour_package ORDER BY id DESC LIMIT 1";
                $rs2=mysqli_query($con,$query2);
                $row2 = mysqli_fetch_array($rs2);
                $tour_package = $row2['id'];
                
               $tempCountry = preg_split ("/[\s;]+/", $country);
               $check = 0;
               $i = 0;
               //while($i<count($tempCountry) && $check!=1){
                    // $querypriceAgent = "SELECT * FROM performa_price_standart WHERE agent=".$agent." and country LIKE '%".$tempCountry[$i]."%'";
                // $rspriceAgent=mysqli_query($con,$querypriceAgent);

                // $querypriceAgent2 = "SELECT COUNT(*) as total FROM performa_price_standart WHERE agent=".$agent." and country LIKE '%".$tempCountry[$i]."%'";
                // $rspriceAgent2=mysqli_query($con,$querypriceAgent2);
                // $rowpriceAgent2=mysqli_fetch_assoc($rspriceAgent2);

                //standart taiwan - agent baodao
                   $querypriceAgent = "SELECT * FROM performa_price_standart WHERE agent=524 and country=158";
                   $rspriceAgent=mysqli_query($con,$querypriceAgent);

                   $querypriceAgent2 = "SELECT COUNT(*) as total FROM performa_price_standart WHERE agent=524 and country=158";
                   $rspriceAgent2=mysqli_query($con,$querypriceAgent2);
                   $rowpriceAgent2=mysqli_fetch_assoc($rspriceAgent2);
                //

                if($rowpriceAgent2['total']>0){
                    $check = 1;
                    while($rowpriceAgent = mysqli_fetch_array($rspriceAgent)){
                        if(substr($rowpriceAgent['agentcom'],-1) == '%'){
                            $commision = substr($rowpriceAgent['agentcom'],0,-1);
                        }
                        $sql2 = "INSERT INTO performa_price VALUES ('',".$rowpriceAgent['performa_price_range'].",".$rowpriceAgent['persentase'].",".$rowpriceAgent['nominal'].",".$commision.",1,'".$rowpriceAgent['staffcom']."','".$rowpriceAgent['subagent']."','".$rowpriceAgent['marketingcom']."',".$rowpriceAgent['discount'].",".$tour_package.")";
                        mysqli_query($con, $sql2);
                    }
                }else{
                    $check = 0;
                }
                $i = $i+1;
            //}

                if($check == 0){
                    $query = "SELECT * FROM performa_price_range";
                    $rs=mysqli_query($con,$query);
                    while($row = mysqli_fetch_array($rs)){
                        $sql2 = "INSERT INTO performa_price VALUES ('',".$row['id'].",0,0,0,1,0,0,0,0,".$tour_package.")";
                        mysqli_query($con, $sql2);
                    }
                }
                $sql_files = "UPDATE agent_files SET status=1 WHERE id=".$files_id;
                if (mysqli_query($con, $sql_files)) {
                    echo "success";

                  } else {
                      echo "Error: " . $sql_files . "" . mysqli_error($con);
                      header("location:https://www.2canholiday.com/Admin/#");
                  }
                
            } else {
                echo "Error: " . $sql . "" . mysqli_error($con);
                header("location:https://www.2canholiday.com/Admin/#");
            }
            $con->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
            header("location:https://www.2canholiday.com/Admin/#");
        }
    }
}



?>