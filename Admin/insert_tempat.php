<?php
//export.php  

if (!empty($_FILES["excel_tempat"])) {
     //   $connect = mysqli_connect("localhost", "root", "", "testing");  
     include "../site.php";
     include "../db=connection.php";

     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_tempat"]["name"]);
     if ($file_array[1] == "xlsx") {
          echo '<label class="text-danger">File Format Done</label>';
          include("Classes/PHPExcel/IOFactory.php");
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr> 
                          <th>Continent</th> 
                          <th>Negara</th>
                          <th>City</th> 
                          <th>Tempat</th>
                          <th>Keterangan</th>    
                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_tempat"]["tmp_name"]);
          $berhasil = 0;
          $gagal = 0;
          $update = 0;
          $gagal_update =0;
          $worksheet = $object->getSheetByName('main');
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               for ($row = 2; $row <= $highestRow; $row++) {
                    $continent = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                    $negara = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                    $city = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                    $tempat = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                    $keterangan = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                    $kurs = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                    $price = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                    $chd = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                    $inf = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
                    if ($continent != "" && $negara != "" && $city != "" && $tempat != "") {

                         $query_update = "SELECT * FROM List_tempat where tempat like'%" . $tempat . "%' && city='" . $city . "'";
                         $rs_update = mysqli_query($con, $query_update);
                         $row_update = mysqli_fetch_array($rs_update);

                         if ($row_update['id'] == "") {
                              $sql = "INSERT INTO List_tempat VALUES ('','$continent','$negara','$city','$tempat','$keterangan','$kurs','$price','$chd','$inf')";
                              if (mysqli_query($con, $sql)) {
                                   $output .= '  
                                   <tr>  
                                        <td>' . $continent . '</td> 
                                        <td>' . $negara . '</td>
                                        <td>' . $city . '</td> 
                                        <td>' . $tempat . '</td>
                                        <td>' . $keterangan . '</td>
                                        <td>' . $kurs . '</td>
                                        <td>' . $price . '</td>
                                   </tr>  
                                   ';
                                   $berhasil++;
                              } else {
                                   $gagal++;
                              }
                         } else {
                              $sql = "UPDATE List_tempat SET continent='$continent', negara='$negara', city='$city',tempat='$tempat', kurs='$kurs' , price='$price',chd='$chd',infant='$inf' WHERE id='".$row_update['id']."'";
                              if (mysqli_query($con, $sql)) {
                                   $output .= '  
                                   <tr>  
                                        <td>' . $continent . '</td> 
                                        <td>' . $negara . '</td>
                                        <td>' . $city . '</td> 
                                        <td>' . $tempat . '</td>
                                        <td>' . $keterangan . '</td>
                                        <td>' . $kurs . '</td>
                                        <td>' . $price . '</td>
                                   </tr>  
                                   ';
                                   $berhasil++;
                              }else{
                                   $gagal++;
                              }
                         }

                    }
               }
          }
          $output .= '</table>';
          $output .= "<label class='text-success'>Data berhasil : " . $berhasil . "</label>  ";
          $output .= "</br><label class='text-danger'>Data gagal : " . $gagal . "</label>  ";
          $output .= "<label class='text-success'>Data update : " . $update . "</label>  ";
          $output .= "</br><label class='text-danger'>Data gagal update : " . $gagal_update . "</label>  ";
          echo $output;
     } else {
          echo '<label class="text-danger">Invalid File</label>';
     }
}
