<?php
//export.php  
$date = date("Y-m-d");
if (!empty($_FILES["excel_tipsLT"])) {
     //   $connect = mysqli_connect("localhost", "root", "", "testing");  
     include "../site.php";
     include "../db=connection.php";

     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_tipsLT"]["name"]);
     if ($file_array[1] == "xlsx") {
          echo '<label class="text-danger">File Format Done</label>';
          include("Classes/PHPExcel/IOFactory.php");
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr> 
                          <th>Kode Agent</th> 
                          <th>Kode Tour</th>
                          <th>Negara</th>  
                          <th>Total Day</th>
                          <th>Total Pax</th>
                          <th>Until Pax</th>
                          <th>Guide</th>
                          <th>ASS</th>
                          <th>Driver</th>
                          <th>Porter</th>
                          <th>Restaurant</th>

                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_tipsLT"]["tmp_name"]);
          $berhasil = 0;
          $gagal = 0;
          $update = 0;
          $gagalupdate =0;
          $halaman = 1;
          $worksheet = $object->getSheetByName('main');
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               if ($halaman == 1) {
                    for ($row = 2; $row <= $highestRow; $row++) {
                         $kode_agent = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                         $kode_tour =  mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                         $negara = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                         $type = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                         $tt_day = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                         $tt_pax = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                         $until_pax = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                         $guide = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                         $ass = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
                         $driver = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
                         $porter = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(10, $row)->getValue());
                         $restaurant = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(11, $row)->getValue());
                         $kurs = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(12, $row)->getValue());
                         $remarks = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(13, $row)->getValue());
                         $status = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(14, $row)->getValue());


                         if ($kode_agent != '' && $negara != '' && $type != '' && $tt_pax !='') {

                              $query_update = "SELECT * FROM tips_LT where agent ='" . $kode_agent . "' &&  negara='$negara' && type='$type' && tt_hari='$tt_day' && tt_pax='$tt_pax' && until_pax='$until_pax' && tour_code='$kode_tour'";
                              $rs_update = mysqli_query($con, $query_update);
                              $row_update = mysqli_fetch_array($rs_update);
                              

                              if ($row_update['id'] == "") {
                                   $sql = "INSERT INTO tips_LT VALUES ('','$date','$kode_agent','$kode_tour','$negara','$type','$tt_day','$tt_pax','$until_pax','$guide','$ass','$driver','$porter','$restaurant','$kurs','$remarks','$status')";
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                        <tr>  
                                             <td>' . $kode_agent . '</td> 
                                             <td>' . $kode_tour. '</td> 
                                             <td>' . $negara . '</td>
                                             <td>' . $tt_day . '</td>
                                             <td>' . $tt_pax . '</td> 
                                             <td>' . $until_pax . '</td>
                                             <td>' . $guide . '</td> 
                                             <td>' . $ass . '</td> 
                                             <td>' . $driver . '</td> 
                                             <td>' . $porter . '</td>
                                             <td>' . $restaurant . '</td> 
                                        </tr>  
                                        ';
                                        $berhasil++;
                                   } else {
                                        $gagal++;
                                   }
                              } else {
                                   $sql2 = "UPDATE tips_LT SET  tour_code='$kode_tour', negara='$negara', type='$type',tt_hari='$tt_day',tt_pax='$tt_pax',until_pax='$until_pax',guide='$guide',ass='$ass',driver='$driver',porter='$porter',restaurant='$restaurant',kurs='$kurs',remarks='$remarks' WHERE id='" . $row_update['id'] . "'";
                                   //  var_dump($sql2);
                                  
                                   if (mysqli_query($con, $sql2)) {
                                        $output .= '  
                                        <tr>  
                                        <td>' . $kode_agent . '</td> 
                                        <td>' . $kode_tour. '</td> 
                                        <td>' . $negara . '</td>
                                        <td>' . $tt_day . '</td>
                                        <td>' . $tt_pax . '</td> 
                                        <td>' . $until_pax . '</td>
                                        <td>' . $guide . '</td> 
                                        <td>' . $ass . '</td> 
                                        <td>' . $driver . '</td> 
                                        <td>' . $porter . '</td>
                                        <td>' . $restaurant . '</td> 
                                        </tr>  
                                        ';
                                        $update++;
                                   } else {
                                        $gagalupdate++;
                                   }
                              }
                         }
                    }
               }

               $halaman++;
          }
          $output .= '</table>';
          $output .= "<label class='text-success'>Data berhasil : " . $berhasil . "</label>  ";
          $output .= "</br><label class='text-warning'>Data Update : " . $update . "</label>  ";
          $output .= "</br><label class='text-danger'>Data gagal : " . $gagal . "</label>  ";
          $output .= "</br><label class='text-danger'>Data gagal Update : " . $gagalupdate . "</label>  ";
          echo $output;
     } else {
          echo '<label class="text-danger">Invalid File</label>';
     }
}
