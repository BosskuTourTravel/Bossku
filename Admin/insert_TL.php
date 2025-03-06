<?php
//export.php  
$date = date("Y-m-d");
if (!empty($_FILES["excel_TL"])) {
     //   $connect = mysqli_connect("localhost", "root", "", "testing");  
     include "../site.php";
     include "../db=connection.php";

     //  $pack_id = $_POST['id'];
     $file_array = explode(".", $_FILES["excel_TL"]["name"]);
     if ($file_array[1] == "xlsx") {
          echo '<label class="text-danger">File Format Done</label>';
          include("Classes/PHPExcel/IOFactory.php");
          $output = '';
          $output .= "  
           <label class='text-success'>Data Inserted</label>  
                <table class='table table-bordered'>  
                     <tr> 
                          <th>Start</th>
                          <th>Benua</th> 
                          <th>Negara</th>
                          <th>Type</th> 
                          <th>Price</th> 
                          <th>Kurs</th>   
                     </tr>  
                     ";
          $object = PHPExcel_IOFactory::load($_FILES["excel_TL"]["tmp_name"]);
          $berhasil = 0;
          $gagal = 0;
          $worksheet = $object->getSheetByName('main');
          foreach ($object->getWorksheetIterator() as $worksheet) {
               $highestRow = $worksheet->getHighestRow();
               for ($row = 2; $row <= $highestRow; $row++) {
                    $start = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
                    $benua = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
                    $negara = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
                    $type = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
                    $price = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
                    $kurs = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(5, $row)->getValue());
                    // $link = mysqli_real_escape_string($con, $worksheet->getCellByColumnAndRow(9, $row)->getValue());
                    if ($start != '') {
                         $sql = "INSERT INTO TL_fee VALUES ('','$date','$start','$benua','$negara','$type','$price','$kurs')";
                         if (mysqli_query($con, $sql)) {
                              $output .= '  
                              <tr>  
                                   <td>' . $start . '</td>
                                   <td>' . $benua . '</td> 
                                   <td>' . $negara . '</td>
                                   <td>' . $type . '</td> 
                                   <td>' . $price . '</td> 
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
          $output .= '</table>';
          $output .= "<label class='text-success'>Data berhasil : " . $berhasil . "</label>  ";
          $output .= "</br><label class='text-danger'>Data gagal : " . $gagal . "</label>  ";
          echo $output;
     } else {
          echo '<label class="text-danger">Invalid File</label>';
     }
}
