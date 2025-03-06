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
                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_tempat"]["tmp_name"]);
          $berhasil = 0;
          $gagal = 0;
          $update = 0;
          $double = 0;
          $gagal_update = 0;
          $worksheet = $object->getSheetByName('main');
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               for ($row = 3; $row <= $highestRow; $row++) {

                    $id = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                    $continent = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                    $negara = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                    $city = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                    $tempat = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                    $tempat2 = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                    $keterangan = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(6, $row)->getValue());
                    $kurs = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
                    $price = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
                    $chd = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
                    $inf = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(10, $row)->getValue());
                    $senior = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(11, $row)->getValue());
                    $junior = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(12, $row)->getValue());
                    // var_dump($id);
                    if ($continent != "" && $negara != "" && $city != "" && $tempat != "") {

                         $query_update = "SELECT * FROM List_tempat where id=" . $id;
                         $rs_update = mysqli_query($con, $query_update);
                         $row_update = mysqli_fetch_array($rs_update);
                         // var_dump($query_update);

                         if ($row_update['id'] == "") {

                              $query_per = "SELECT * FROM List_tempat where continent='" . $continent . "' && negara='" . $negara . "' && city='" . $city . "' && tempat='" . $tempat . "'";
                              $rs_per = mysqli_query($con, $query_per);
                              $row_per = mysqli_fetch_array($rs_per);
                              // var_dump($query_per);

                              if ($row_per['id'] == "") {
                                   $sql = "INSERT INTO List_tempat VALUES ('','$continent','$negara','$city','$tempat','$tempat2','$keterangan','$kurs','$price','$chd','$inf','$senior','$junior')";
                                   if (mysqli_query($con, $sql)) {
                                        $output .= '  
                                        <tr>  
                                             <td>' . $continent . '</td> 
                                             <td>' . $negara . '</td>
                                             <td>' . $city . '</td> 
                                             <td>' . $tempat . '</td>
                                        </tr>  
                                        ';
                                        $berhasil++;
                                   } else {
                                        $gagal++;
                                   }
                              } else {
                                   $double++;
                              }
                         } else {
                              $sql2 = "UPDATE List_tempat SET continent='".$continent."', negara='".$negara."', city='".$city."',tempat='".$tempat."',tempat2='".$tempat2."', keterangan='".$keterangan."', kurs='".$kurs."' , price='$price',chd='$chd',infant='$inf',senior='$senior',junior='$junior' WHERE id=" . $row_update['id'];
                              // var_dump($sql2);
                              if (mysqli_query($con, $sql2)) {
                                   $output .= '  
                                   <tr>  
                                        <td>' . $continent . '</td> 
                                        <td>' . $negara . '</td>
                                        <td>' . $city . '</td> 
                                        <td>' . $tempat . '</td>
                                   </tr>  
                                   ';
                                   $update++;
                              } else {
                                   $gagal_update++;
                              }
                         }
                    }
               }
          }
          $output .= '</table>';
          $output .= "<label class='text-success'>Data berhasil : " . $berhasil . "</label>  ";
          $output .= "</br><label class='text-danger'>Data gagal : " . $gagal . "</label>  ";
          $output .= "</br><label class='text-success'>Data update : " . $update . "</label>  ";
          $output .= "</br><label class='text-danger'>Data gagal update : " . $gagal_update . "</label>  ";
          $output .= "</br><label class='text-warning'>Data Double : " . $double . "</label>  ";
          echo $output;
     } else {
          echo '<label class="text-danger">Invalid File</label>';
     }
}
