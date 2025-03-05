<?php
//export.php  

if (!empty($_FILES["excel_meal"])) {
     //   $connect = mysqli_connect("localhost", "root", "", "testing");  
     include "../site.php";
     include "../db=connection.php";

     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_meal"]["name"]);
     if ($file_array[1] == "xlsx") {
          echo '<label class="text-danger">File Format Done</label>';
          include("Classes/PHPExcel/IOFactory.php");
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr> 
                          <th>Negara</th> 
                          <th>BLD</th>
                          <th>Harga</th> 
                          <th>Kurs</th>
                          <th>Harga IDR</th>  
                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_meal"]["tmp_name"]);
          $berhasil = 0;
          $gagal = 0;
          $halaman = 1;
          $worksheet = $object->getSheetByName('main');
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               if ($halaman == 1) {
                    for ($row = 2; $row <= $highestRow; $row++) {
                         $date = date('Y-m-d');
                         $negara = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                         $bld = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                         $ket = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                         $kurs = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                         $harga_idr = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                         // $kurs_idr = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());

                         if ($negara != '' && $bld != '' && $kurs != '') {
                              $query_update = "SELECT * FROM Guest_meal2 where negara like '$negara' and meal_type like '$bld'";
                              $rs_update = mysqli_query($con, $query_update);
                              $row_update = mysqli_fetch_array($rs_update);
                              if ($row_update['id'] == "") {
                                   $sql = "INSERT INTO Guest_meal2 VALUES ('','$date','$negara','$bld','$ket','$kurs','$harga_idr','')";
                                   // var_dump($sql);
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                             <tr>  
                                                  <td>' . $negara . '</td> 
                                                  <td>' . $bld . '</td>
                                                  <td>' . $ket . '</td> 
                                                  <td>' . $kurs . '</td>
                                                  <td>' . $harga_idr . '</td>
                                             </tr>  
                                             ';
                                        $berhasil++;
                                   } else {
                                        $gagal++;
                                   }
                              } else {
                                   $sql = "UPDATE Guest_meal2 SET negara='$negara',meal_type='$bld',ket='".$ket."',kurs='$kurs',price='$harga_idr' where id='" . $row_update['id'] . "'";
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                             <tr>  
                                                  <td>' . $negara . '</td> 
                                                  <td>' . $bld . '</td>
                                                  <td>' . $ket . '</td> 
                                                  <td>' . $kurs . '</td>
                                                  <td>' . $harga_idr . '</td>
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
