<?php
//export.php  

if (!empty($_FILES["excel_hotel_lt"])) {
     //   $connect = mysqli_connect("localhost", "root", "", "testing");  
     include "../site.php";
     include "../db=connection.php";
     include("Classes/PHPExcel/IOFactory.php");

     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_hotel_lt"]["name"]);
     if ($file_array[1] == "xlsx") {
          echo '<label class="text-danger">File Format Done</label>';
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered table-sm'>  
                     <tr> 
                          <th>Countinent</th> 
                          <th>Country</th>
                          <th>City</th> 
                          <th>Hotel Name</th>
                          <th>Periode</th> 
                          <th>Type</th>
                          <th>Kurs</th>
                          <th>Low Rate</th>
                          <th>High Rate</th>   
                     </tr>  
                     ";
?>
          <label class="text-danger">File Format Done</label></br>
          <div class="card">
               <div class="card-body">
               <?php
               $object = PHPExcel_IOFactory::load($_FILES["excel_hotel_lt"]["tmp_name"]);
               $berhasil = 0;
               $update = 0;
               $gagal = 0;
               $update = 0;
               $gagalupdate = 0;
               $halaman = 1;
               $worksheet = $object->getSheetByName('main');
               $date = date("Y-m-d");
               $s = 0;
               foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    if ($halaman > 1) {
                         $p = 1;
                         for ($row = 2; $row <= $highestRow; $row++) {
                              $continent = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                              $country = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                              $city = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                              $hotel_name = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                              $address = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                              $contract_rate = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                              $period = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                              $website = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
                              $email = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
                              $phone = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(10, $row)->getValue());
                              $class = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(11, $row)->getValue());
                              $kurs = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(12, $row)->getValue());
                              $room_type = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(13, $row)->getValue());
                              $occ = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(14, $row)->getValue());
                              $rate_low = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(15, $row)->getValue());
                              $rate_high = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(16, $row)->getValue());
                              $extra_bed = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(17, $row)->getValue());
                              $inclusive = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(18, $row)->getValue());
                              $remarks = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(19, $row)->getValue());
                              $quote = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(20, $row)->getValue());
                              $status = "";


                              if ($continent != '' && $country != '' && $city != '' && $hotel_name != '' && $class != ''  && $room_type != '') {
                                   $query_update = "SELECT id FROM hotel_lt where continent ='" . $continent . "' &&  country='" . $country . "' && city='" . $city . "' && name='" . $hotel_name . "' && periode='".$period."' && class='" . $class . "' && type='" . $room_type . "'";
                                   $rs_update = mysqli_query($con, $query_update);
                                   $row_update = mysqli_fetch_array($rs_update);
                                   if ($row_update['id'] == "") {
                                        $sql = "INSERT INTO hotel_lt VALUES ('','$continent','$country','$city','$hotel_name','$address','$contract_rate','$period','$website','$email','$phone','$kurs','$class','$room_type','$occ','$rate_low','$rate_high','$extra_bed','$inclusive','$remarks','$quote','$date','$status')";
                                        if (mysqli_query($con, $sql)) {
                                             $output .= '  
                                             <tr>  
                                                  <td>' . $continent . '</td> 
                                                  <td>' . $country . '</td>
                                                  <td>' . $city . '</td> 
                                                  <td>' . $hotel_name . '</td>
                                                  <td>' . $period . '</td>
                                                  <td>' . $room_type . '</td>
                                                  <td>' . $kurs . '</td> 
                                                  <td>' . $rate_low . '</td>
                                                  <td>' . $rate_high . '</td>
                                             </tr>  
                                             ';
                                             $berhasil++;
                                        } else {
                                             $gagal++;
                                        }
                                   } else {
                                        $sql2 = "UPDATE hotel_lt SET continent='$continent', country='$country', city='$city',name='$hotel_name', addres='$address' , contract_rate='$contract_rate',periode='$period',website='$website',email='$email',phone='$phone',kurs='$kurs',class='$class',type='$room_type',occ='$occ',rate_low='$rate_low',rate_high='$rate_high',extra_bed='$extra_bed',inclusive='$inclusive',remarks='$remarks',quote='$quote' WHERE id='".$row_update['id']."'";
                                        if (mysqli_query($con, $sql2)) {
                                             $update++;
                                        }else{
                                             $gagalupdate++;
                                        }
                                   }
                              }
                              $p++;
                         }
                    }
                    $halaman++;
               }

               $output .= '</table>';
               $output .= "<label class='text-success'>Data berhasil : " . $berhasil . "</label>  ";
               $output .= "</br><label class='text-danger'>Data gagal : " . $gagal . "</label>  ";
               $output .= "</br><label class='text-success'>Data Update : " . $update . "</label>  ";
               $output .= "</br><label class='text-danger'>Data gagal update : " . $gagalupdate . "</label>  ";
               echo $output;

          }else{
               echo '<label class="text-danger">Invalid File</label>';
          }


}
