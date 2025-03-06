<?php
//export.php  

if (!empty($_FILES["excel_tips"])) {

     include "../site.php";
     include "../db=connection.php";
     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_tips"]["name"]);
     if ($file_array[1] == "xlsx") {
          echo '<label class="text-danger">File Format Done</label>';
          include("Classes/PHPExcel/IOFactory.php");
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr> 
                          <th>Negara</th> 
                          <th>TL</th> 
                          <th>GUIDE</th>
                          <th>ASSISTANT/th>
                          <th>DRIVER</th>
                          <th>PORTER</th>
                          <th>RESTAURANT</th>
                          <th>KURS</th>
                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_tips"]["tmp_name"]);
          $berhasil = 0;
          $gagal = 0;
          $halaman = 1;
          $worksheet = $object->getSheetByName('Sheet1');
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               if ($halaman == 1) {
                    for ($row = 2; $row <= $highestRow; $row++) {
                         $negara = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                         $tl = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                         $guide = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                         $asistant = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                         $driver = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                         $porter = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                         $restaurant = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                         $kurs = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
                         if ($negara != '') {
                              // var_dump($tc);
                              $query_update = "SELECT * FROM Tips_Landtour where negara ='$negara'";
                              $rs_update = mysqli_query($con, $query_update);
                              $row_update = mysqli_fetch_array($rs_update);

                              if ($row_update['id'] == "") {
                                   $sql = "INSERT INTO Tips_Landtour VALUES ('','$negara','$tl','$guide','$asistant','$driver','$porter','$restaurant','$kurs')";
                                   // var_dump($sql);
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                   <tr>  
                                        <td>' . $negara . '</td> 
                                        <td>' . $tl . '</td>
                                        <td>' . $guide . '</td> 
                                        <td>' . $asistant . '</td>
                                        <td>' . $driver . '</td>
                                        <td>' . $porter . '</td>
                                        <td>' . $restaurant . '</td>
                                        <td>' . $kurs . '</td>
                                   </tr>  
                                   ';
                                        $berhasil++;
                                   } else {
                                        $gagal++;
                                   }
                              } else {
                                   $sql = "UPDATE Tips_Landtour SET negara='$negara',tl='$tl',guide='$guide',assistant='$asistant',driver='$driver',porter='$porter',restaurant='$restaurant',kurs='$kurs' where id=".$row_update['id'];
                                   // var_dump($sql);
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                   <tr>  
                                   <td>' . $negara . '</td> 
                                   <td>' . $tl . '</td>
                                   <td>' . $guide . '</td> 
                                   <td>' . $asistant . '</td>
                                   <td>' . $driver . '</td>
                                   <td>' . $porter . '</td>
                                   <td>' . $restaurant . '</td>
                                   <td>' . $kurs . '</td>
                                   </tr>  
                                   ';
                                        $berhasil++;
                                   } else {
                                        $gagal++;
                                   }
                              }
                         }
                    }
                    $halaman++;
               }
          }
          $output .= '</table>';
          $output .= "<label class='text-success'>Data berhasil : " . $berhasil . "</label>  ";
          $output .= "</br><label class='text-danger'>Data gagal : " . $gagal . "</label>  ";
          echo $output;
     } else {
          echo '<label class="text-danger">Invalid File</label>';
     }
}
